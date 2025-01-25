<?php

namespace App\Http\Controllers;

use App\Models\SunatUnit;
use App\Http\Requests\StoreSunatUnitRequest;
use App\Http\Requests\UpdateSunatUnitRequest;
use App\Http\Resources\SunatUnitCollection;
use App\Http\Resources\SunatUnitResource;

class SunatUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = SunatUnit::all();
        return new SunatUnitCollection($units);
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
    public function store(StoreSunatUnitRequest $request)
    {
        $unit = SunatUnit::create($request->validated());
        return new SunatUnitResource($unit);
    }

    /**
     * Display the specified resource.
     */
    public function show(SunatUnit $sunatUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SunatUnit $sunatUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSunatUnitRequest $request, SunatUnit $sunatUnit)
    {
        $sunatUnit->update($request->validated());
        return new SunatUnitResource($sunatUnit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SunatUnit $sunatUnit)
    {
        //
    }



    /**
     * Borrado logico de un cliente
     */
    public function deactivate(SunatUnit $unit)
    {
        // Cambiar el estado a "false" (desactivado)
        $unit->update(['status' => false]);

        // Retornar una respuesta JSON indicando éxito
        return response()->json([
            'message' => 'Marca desactivada exitosamente.',
            'brand' => new SunatUnitResource($unit)
        ], 200);
    }
}
