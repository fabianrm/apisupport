<?php

namespace App\Http\Controllers;

use App\Models\PurchaseDetail;
use App\Http\Requests\StorePurchaseDetailRequest;
use App\Http\Requests\UpdatePurchaseDetailRequest;
use App\Http\Resources\PurchaseDetailCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener el parámetro de búsqueda desde la URL
        $search = $request->query('q');
        // Si no hay parámetro de búsqueda, listar todos los registros de PurchaseDetail con remaining_quantity > 0
        if (empty($search)) {
            $purchaseDetails = PurchaseDetail::where('remaining_quantity', '>', 0)->get();
        } else {
            // Buscar productos que coincidan con el nombre
            $products = Product::where('name', 'like', '%' . $search . '%')->get();
            // Obtener los IDs de los productos encontrados
            $productIds = $products->pluck('id');
            // Buscar los detalles de compra relacionados con los productos encontrados y con remaining_quantity > 0
            $purchaseDetails = PurchaseDetail::whereIn('product_id', $productIds)
                ->where('remaining_quantity', '>', 0)
                ->get();
        }
        // Cargar relaciones
        $purchaseDetails->load('product', 'store');
        // Retornar la colección de PurchaseDetail
        return new PurchaseDetailCollection($purchaseDetails);
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
    public function store(StorePurchaseDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseDetailRequest $request, PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseDetail $purchaseDetail)
    {
        //
    }
}
