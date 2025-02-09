<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Resources\PurchaseCollection;
use App\Http\Resources\PurchaseResource;
use App\Models\InventoryMovement;
use App\Models\Product;
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
        $purchases = Purchase::with(['supplier', 'store', 'details', 'details.store', 'details.product'])->get();
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
            $total = 0;
            foreach ($detailsRequest as $detail) {
                $total += $detail['purchase_price'] * $detail['quantity'];
            }
            $igv = $total - ($total / 1.18); // 18% del subtotal
            $subtotal = $total - $igv; //

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
                    'remaining_quantity' => $detail['quantity'],
                    'unit_price' => $detail['purchase_price'],
                    'description' => 'Ingreso por compra #' . $purchase->id,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]);

                // Actualizar el current_stock del producto
                $product = Product::findOrFail($detail['product_id']);

                $currentStock = $product->purchaseDetails()
                    ->with('inventoryMovements')
                    ->get()
                    ->sum(function ($purchaseDetail) {
                        return $purchaseDetail->inventoryMovements->sum('quantity');
                    });


                // Actualizar el stock actual del producto
                $product->update(['current_stock' => $currentStock]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Compra registrada exitosamente',
                'purchase' => $purchase->load(['supplier', 'details', 'details.store', 'details.product']),
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
        $purchase->load(['supplier', 'store', 'details', 'details.store', 'details.product']); // Carga las relaciones necesarias
        return new PurchaseResource($purchase);
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

        // Validar que no haya movimientos de inventario distintos a los de entrada por esta compra
        foreach ($purchase->details as $detail) {
            $hasOtherMovements = InventoryMovement::where('purchase_detail_id', $detail->id)
                ->where('movement_type_id', '!=', 1) // Suponiendo que "1" es el tipo de movimiento "entrada"
                ->exists();
            if ($hasOtherMovements) {
                return response()->json([
                    'message' => 'No se puede actualizar la orden de compra porque hay movimientos de inventario asociados a los productos.',
                ], 400);
            }
        }

        // Validar los datos de la cabecera
        $validatedPurchase = Validator::make(
            $request->all(),
            [
                'supplier_id' => 'required|exists:suppliers,id',
                'purchase_date' => 'required|date',
                'invoice_number' => 'required|string|unique:purchases,invoice_number,' . $id,
                'store_id' => 'required'
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
                'details.*.model' => 'string',
                'details.*.serial' => '',
                'details.*.imei' => '',
                'details.*.color' => '',
                'details.*.capacity' => '',
                'details.*.status' => 'required',
                'details.*.ubication_detail' => 'string'
            ]
        )->validate();

        DB::beginTransaction();
        try {
            // Calcular subtotal, IGV y total a partir de los detalles
            $total = collect($validatedDetails['details'])->sum(function ($detail) {
                return $detail['purchase_price'] * $detail['quantity'];
            });
            $igv = $total - ($total / 1.18);
            $subtotal = $total - $igv;

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

            // Obtener los detalles que se van a eliminar
            $deletedDetails = PurchaseDetail::whereIn('id', $detailsToDelete)->get();

            // Restar la cantidad de los detalles eliminados del current_stock del producto
            foreach ($deletedDetails as $deletedDetail) {
                $product = Product::findOrFail($deletedDetail->product_id);
                $product->decrement('current_stock', $deletedDetail->quantity);
            }

            // Eliminar los detalles
            PurchaseDetail::whereIn('id', $detailsToDelete)->delete();

            // Crear o actualizar detalles
            foreach ($validatedDetails['details'] as $detail) {
                $purchaseDetail = PurchaseDetail::updateOrCreate(
                    ['id' => $detail['id'] ?? null],
                    array_merge($detail, [
                        'purchase_id' => $purchase->id,
                        'remaining_quantity' => $detail['quantity'],
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
                        'description' => 'Actualización de compra' . $purchase->id,
                        'updated_by' => auth()->user()->id,
                    ]
                );

                // Actualizar el current_stock del producto
                $product = Product::findOrFail($detail['product_id']);
                $currentStock = $product->purchaseDetails()
                    ->with('inventoryMovements')
                    ->get()
                    ->sum(function ($purchaseDetail) {
                        return $purchaseDetail->inventoryMovements->sum('quantity');
                    });

                // Actualizar el stock actual del producto
                $product->update(['current_stock' => $currentStock]);
            }

            DB::commit();
            return response()->json([
                'message' => 'Compra actualizada correctamente',
                'purchase' => $purchase->load(['supplier', 'details', 'details.store', 'details.product']),
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
    public function destroy($id)
    {
        $purchase = Purchase::with('details')->findOrFail($id);

        DB::beginTransaction();

        try {
            // Validar que no haya movimientos de inventario distintos a los de entrada por esta compra
            foreach ($purchase->details as $detail) {
                $hasOtherMovements = InventoryMovement::where('purchase_detail_id', $detail->id)
                    ->where('movement_type_id', '!=', 1) // Suponiendo que "1" es el tipo de movimiento "entrada"
                    ->exists();

                if ($hasOtherMovements) {
                    return response()->json([
                        'message' => 'No se puede eliminar la orden de compra porque hay movimientos de inventario asociados a los productos.',
                    ], 400);
                }
            }

            // Eliminar movimientos de inventario relacionados con esta compra
            foreach ($purchase->details as $detail) {
                InventoryMovement::where('purchase_detail_id', $detail->id)->delete();
            }

            // Eliminar detalles de la compra
            PurchaseDetail::where('purchase_id', $purchase->id)->delete();

            // Eliminar la orden de compra
            $purchase->delete();

            DB::commit();

            return response()->json([
                'message' => 'Orden de compra eliminada correctamente.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error al eliminar la orden de compra: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error al eliminar la orden de compra.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
