<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseDetailRequest;
use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Http\Resources\PurchaseCollection;
use App\Models\InventoryMovement;
use App\Models\PurchaseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::all();
        return new PurchaseCollection($purchases);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        // Validar la solicitud completa utilizando el StorePurchaseRequest
        $validatedData = $request->validated();

        // Extraer los detalles
        $detailsRequest = $validatedData['details'] ?? [];

        try {
            DB::beginTransaction();

            // Calcular subtotal, IGV y total en base a los detalles
            $subtotal = 0;
            foreach ($detailsRequest as $detail) {
                $subtotal += $detail['purchase_price'] * $detail['quantity'];
            }

            $igv = $subtotal * 0.18; // 18% del subtotal
            $total = $subtotal + $igv;

            // Crear la compra principal con los valores calculados
            $purchase = Purchase::create(array_merge($validatedData, [
                'subtotal' => $subtotal,
                'igv' => $igv,
                'total' => $total,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]));

            // Procesar cada detalle
            foreach ($detailsRequest as $detail) {
                // Validar cada detalle usando un validador directamente
                $validator = Validator::make($detail, [
                    'product_id' => 'required|exists:products,id',
                    'store_id' => 'required|exists:stores,id',
                    'purchase_price' => 'required|numeric',
                    'sale_price' => 'required|numeric',
                    'quantity' => 'required|integer|min:1',
                ]);

                if ($validator->fails()) {
                    throw new \Exception($validator->errors()->first());
                }

                $purchaseDetail = PurchaseDetail::create(array_merge($detail, [
                    'purchase_id' => $purchase->id,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]));

                // Registrar movimiento de inventario
                InventoryMovement::create([
                    'purchase_detail_id' => $purchaseDetail->id,
                    'store_id' => $detail['store_id'],
                    'movement_type_id' => 1, // Tipo de movimiento "entrada"
                    'quantity' => $detail['quantity'],
                    'unit_price' => $detail['purchase_price'],
                    'description' => 'Ingreso por compra #' . $purchase->id,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Compra registrada exitosamente',
                'purchase' => $purchase->load(['details']),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Error al registrar la compra',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Buscar la compra existente
        $purchase = Purchase::findOrFail($id);

        //TODO: Actualizar sino hubo movimiento de salida de productos

        // Validar los datos de la cabecera
        $validatedPurchase = Validator::make(
            $request->all(),
            [
                'supplier_id' => 'required|exists:suppliers,id',
                'purchase_date' => 'required|date',
                'invoice_number' => 'required|string|unique:purchases,invoice_number,' . $id,
            ]
        )->validate();

        // Validar los detalles
        $validatedDetails = Validator::make(
            $request->all(),
            [
                'details.*.product_id' => 'required|exists:products,id',
                'details.*.store_id' => 'required|exists:stores,id',
                'details.*.purchase_price' => 'required|numeric',
                'details.*.sale_price' => 'required|numeric',
                'details.*.quantity' => 'required|integer|min:1',
                'details.*.remaining_quantity' => 'integer',
                'details.*.ubication_detail' => 'string'
            ]
        )->validate();

        DB::beginTransaction();

        Log::info('Details:', ['details' => $validatedDetails]);

        try {
            // Calcular subtotal, IGV y total a partir de los detalles
            $subtotal = collect($validatedDetails['details'])->sum(function ($detail) {
                return $detail['purchase_price'] * $detail['quantity'];
            });
            $igv = $subtotal * 0.18; // 18% de IGV
            $total = $subtotal + $igv;

            // Actualizar cabecera
            $purchase->update(array_merge($validatedPurchase, [
                'subtotal' => $subtotal,
                'igv' => $igv,
                'total' => $total,
                'updated_by' => auth()->user()->id,
            ]));

            // Manejar detalles: eliminar los que no están en la solicitud, actualizar o crear nuevos
            $existingDetailIds = $purchase->details->pluck('id')->toArray();
            $newDetailIds = collect($validatedDetails['details'])->pluck('id')->filter()->toArray();

            // Eliminar detalles que no están en la solicitud
            $detailsToDelete = array_diff($existingDetailIds, $newDetailIds);
            PurchaseDetail::whereIn('id', $detailsToDelete)->delete();

            // Crear o actualizar detalles
            foreach ($validatedDetails['details'] as $detail) {
                $purchaseDetail = PurchaseDetail::updateOrCreate(
                    ['id' => $detail['id'] ?? null],
                    array_merge($detail, [
                        'purchase_id' => $purchase->id,
                        'updated_by' => auth()->user()->id,
                    ])
                );

                // Registrar movimientos de inventario
                InventoryMovement::updateOrCreate(
                    ['purchase_detail_id' => $purchaseDetail->id],
                    [
                        'store_id' => $detail['store_id'],
                        'movement_type_id' => 1, // Suponiendo que 1 es tipo "entrada"
                        'quantity' => $detail['quantity'],
                        'unit_price' => $detail['purchase_price'],
                        'description' => 'Actualización de compra',
                        'updated_by' => auth()->user()->id,
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'message' => 'Compra actualizada correctamente',
                'purchase' => $purchase->load(['details']),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error al actualizar la compra: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error al actualizar la compra',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
