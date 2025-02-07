<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSunatDocumentIdRequest;
use App\Http\Requests\UpdateSunatDocumentIdRequest;
use App\Http\Resources\DocumentIDCollection;
use App\Models\SunatDocumentId;

class SunatDocumentIdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ids = SunatDocumentId::all();
        return new DocumentIDCollection($ids);
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
    public function store(StoreSunatDocumentIdRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SunatDocumentId $sunatDocumentId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SunatDocumentId $sunatDocumentId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSunatDocumentIdRequest $request, SunatDocumentId $sunatDocumentId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SunatDocumentId $sunatDocumentId)
    {
        //
    }
}
