<?php

namespace App\Http\Controllers;

use App\Models\SunatSerial;
use App\Http\Requests\StoreSunatSerialRequest;
use App\Http\Requests\UpdateSunatSerialRequest;
use App\Http\Resources\SunatSerialResource;

class SunatSerialController extends Controller
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
    public function store(StoreSunatSerialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SunatSerial $sunatSerial)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SunatSerial $sunatSerial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSunatSerialRequest $request, SunatSerial $sunatSerial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SunatSerial $sunatSerial)
    {
        //
    }

    public function getByCode($code)
    {
        // Buscar el registro por el campo 'code'
        $sunatSerial = SunatSerial::where('code', $code)->first();

        // Si no se encuentra el registro, devolver un error 404
        if (!$sunatSerial) {
            return response()->json(['message' => 'SunatSerial not found'], 404);
        }

        // Devolver el recurso SunatSerialResource
        return new SunatSerialResource($sunatSerial);
    }
}
