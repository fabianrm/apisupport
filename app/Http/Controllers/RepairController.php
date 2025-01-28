<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Http\Requests\StoreRepairRequest;
use App\Http\Requests\UpdateRepairRequest;
use App\Http\Resources\RepairCollection;
use App\Http\Resources\RepairResource;
use App\Models\Device;
use App\Models\RepairHistory;
use App\Services\UtilService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
        $utilService = app(UtilService::class);
        $uniqueCode = $utilService->generateUniqueCodeRepair('TK');

        $validatedData = $request->validated();
        $validatedData['code'] = $uniqueCode;
        $validatedData['assigned_at'] =  Carbon::now();

        try {
            DB::beginTransaction();

            $repair = Repair::create($validatedData);
            $date = Carbon::now();

            RepairHistory::create([
                'repair_id' => $repair->id,
                'status' => 'asignado',
                'comment' => 'Asignado el ' . $date,
                'changed_by' => auth()->user()->id,
                'store_id' => $repair->store_id,
            ]);

            // Actualizar el estado del dispositivo, primer evento
            $device = Device::findOrFail($repair['device_id']);
            $device->update(['status' => 'pendiente']);

            /**
             * TODO:
             * despues de actualizar el estado quiero que me permita recibir archivos(fotos, pdf, etc),
             * como evidencia del estado en que llega el dispositivo si en caso lo hubiera.
             * Se deben subir a 'files/store/repairs'
             */

           
            DB::commit();

            $repair->load(['device', 'technician', 'store']); // Carga las relaciones necesarias
            return new RepairResource($repair);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Error al asignar la tarea.',
                'error' => $e->getMessage(),
            ], 500);
        }
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
