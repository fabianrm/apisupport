<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\InventoryMovement;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\SaleDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreSaleRequest $request)
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
                $total += $detail['unit_price'] * $detail['quantity'];
            }
            $igv = $total - ($total / 1.18); // 18% del subtotal
            $subtotal = $total - $igv; //

            // Crear la compra principal con los valores calculados
            $sale = Sale::create(array_merge($validatedData, [
                'mto_oper_gravadas' => $subtotal,
                'mto_igv' => 18.00,
                "total_taxes" => $igv,
                "valor_sale" => $total,
                'subtotal' => $subtotal,
                'total' => $total,
                'code_legend' => "1000",
                'value_legend' => "MONTO EN LETRAS",
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]));

            // Procesar cada detalle
            foreach ($detailsRequest as $detail) {
                // Validar cada detalle usando un validador directamente
                $validator = Validator::make($detail, [
                    'purchase_detail_id' => 'required|exists:purchase_details,id',
                    'store_id' => 'required|exists:stores,id',
                    'quantity' => 'required|integer|min:1',
                ]);

                if ($validator->fails()) {
                    throw new \Exception($validator->errors()->first());
                }

                $saleDetail = SaleDetail::create(array_merge($detail, [
                    'sale_id' => $sale->id,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]));

                // Registrar movimiento de inventario
                InventoryMovement::create([
                    'purchase_detail_id' => $saleDetail->purchase_detail_id,
                    'store_id' => $detail['store_id'],
                    'movement_type_id' => 2, // Tipo de movimiento "entrada"
                    'quantity' => -$detail['quantity'],
                    'unit_price' => $detail['unit_price'],
                    'description' => 'salida por venta #' . $sale->id,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]);

                //Encontrar el purchase
                $purchaseDetail = PurchaseDetail::findOrFail($saleDetail->purchase_detail_id);

                $purchaseDetail->update([
                    'remaining_quantity' => $purchaseDetail->remaining_quantity - $detail['quantity'],
                ]);

                // Actualizar el current_stock del producto
                $product = Product::findOrFail($purchaseDetail['product_id']);

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
                'message' => 'Venta registrada exitosamente',
                'sale' => $sale->load(['details']),
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
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
