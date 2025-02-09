<?php

namespace App\Http\Controllers;

use App\Models\SunatCurrency;
use App\Http\Requests\StoreSunatCurrencyRequest;
use App\Http\Requests\UpdateSunatCurrencyRequest;
use App\Http\Resources\CurrencyCollection;

class SunatCurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = SunatCurrency::all();
        return new CurrencyCollection($currencies);
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
    public function store(StoreSunatCurrencyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SunatCurrency $sunatCurrency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SunatCurrency $sunatCurrency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSunatCurrencyRequest $request, SunatCurrency $sunatCurrency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SunatCurrency $sunatCurrency)
    {
        //
    }
}
