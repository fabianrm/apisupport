<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Http\Requests\StoreRepairRequest;
use App\Http\Requests\UpdateRepairRequest;
use App\Http\Resources\RepairCollection;
use App\Http\Resources\RepairResource;
use App\Models\RepairHistory;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repairs = Repair::with(['device', 'technician', 'store'])->get();
        return new RepairCollection($repairs);
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
    public function store(StoreRepairRequest $request)
    {
        $validatedData = $request->validated();
        $repair = Repair::create($validatedData);

        RepairHistory::create([
            'repair_id' => $repair->id,
            'status' => 'asignado',
            'comment' => 'Cliente vendrá a las 2pm',
            'changed_by' => auth()->user()->id,
        ]);


        $repair->load(['device', 'technician', 'store']); // Carga las relaciones necesarias
        return new RepairResource($repair);
    }

    /**
     * Display the specified resource.
     */
    public function show(Repair $repair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repair $repair)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepairRequest $request, Repair $repair)
    {
        $repair->update($request->validated());
        $repair->load(['device', 'technician', 'store']); // Carga las relaciones necesarias
        return new RepairResource($repair);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repair $repair)
    {
        //
    }
}
