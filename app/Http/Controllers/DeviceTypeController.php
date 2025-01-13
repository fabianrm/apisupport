<?php

namespace App\Http\Controllers;

use App\Models\DeviceType;
use App\Http\Requests\StoreDeviceTypeRequest;
use App\Http\Requests\UpdateDeviceTypeRequest;
use App\Http\Resources\DeviceTypeCollection;
use App\Http\Resources\DeviceTypeResource;

class DeviceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deviceType = DeviceType::all();
        return new DeviceTypeCollection($deviceType);
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
    public function store(StoreDeviceTypeRequest $request)
    {
        $deviceType = DeviceType::create($request->validated());
        return new DeviceTypeResource($deviceType);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceType $deviceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceType $deviceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceTypeRequest $request, DeviceType $deviceType)
    {
        $deviceType->update($request->validated());
        return new DeviceTypeResource($deviceType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceType $deviceType)
    {
        //
    }
}
