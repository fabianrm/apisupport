<?php

namespace App\Http\Controllers;

use App\Models\SunatDocumentType;
use App\Http\Requests\StoreSunatDocumentTypeRequest;
use App\Http\Requests\UpdateSunatDocumentTypeRequest;
use App\Http\Resources\DocumentTypeCollection;

class SunatDocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = SunatDocumentType::all();
        return new DocumentTypeCollection($documents);
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
    public function store(StoreSunatDocumentTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SunatDocumentType $sunatDocumentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SunatDocumentType $sunatDocumentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSunatDocumentTypeRequest $request, SunatDocumentType $sunatDocumentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SunatDocumentType $sunatDocumentType)
    {
        //
    }
}
