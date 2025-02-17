<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Http\Resources\DeviceCollection;
use App\Http\Resources\DeviceResource;
use App\Services\UtilService;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $device = Device::all();
        $device = Device::with(['deviceType', 'customer'])->get();
        return new DeviceCollection($device);
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
    public function store(StoreDeviceRequest $request)
    {
        $utilService = app(UtilService::class);
        $uniqueCode = $utilService->generateUniqueCodeDevice('DV');
        // Agregar el uniqueCode al request
        $validatedData = $request->validated();
        $validatedData['code'] = $uniqueCode;
        // Crear el dispositivo con los datos validados y el código único
        $device = Device::create($validatedData);
        $device->load(['deviceType', 'customer']); // Carga las relaciones necesarias
        return new DeviceResource($device);
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        $device->load(['deviceType', 'customer']); // Carga las relaciones necesarias
        return new DeviceResource($device);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceRequest $request, Device $device)
    {
        $device->update($request->validated());
        $device->load(['deviceType', 'customer']); // Carga las relaciones necesarias
        return new DeviceResource($device);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        //
    }
}
