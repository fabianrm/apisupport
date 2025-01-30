<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Http\Requests\StoreRepairRequest;
use App\Http\Requests\UpdateRepairRequest;
use App\Http\Resources\RepairCollection;
use App\Http\Resources\RepairResource;
use App\Models\Device;
use App\Models\RepairFile;
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
        $user = auth()->user();
        $query = Repair::with(['device', 'technician', 'store']);

        // Verificamos si el usuario tiene el rol de admin
        $isAdmin = $user->roles()->where('name', 'admin')->exists();
        if (!$isAdmin) {
            $query->where('technician_id', $user->id);
        }
        $repairs = $query->get();
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
                'status' => 'pendiente',
                'comment' => 'Asignado el ' . $date,
                'changed_by' => auth()->user()->id,
                'store_id' => $repair->store_id,
            ]);

            // Actualizar el estado del dispositivo, primer evento
            $device = Device::findOrFail($repair['device_id']);
            $device->update(['status' => 'pendiente']);

            //Registramos files si vienen
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('files/store/repairs', $fileName, 'public');

                    RepairFile::create([
                        'repair_id' => $repair->id,
                        'file_path' => $filePath,
                        'store_id' => $repair->store_id,
                    ]);
                }
            }

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
        $repair->load(['device', 'technician', 'store']); // Carga las relaciones necesarias
        return new RepairResource($repair);
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
        $validatedData = $request->validated();

        try {
            // Log::info($validatedData);

            DB::beginTransaction();

            // Crear historial si hay cambios en prioridad o técnico
            if (
                (isset($validatedData['priority']) && $validatedData['priority'] !== $repair->priority) ||
                (isset($validatedData['technician_id']) && $validatedData['technician_id'] !== $repair->technician_id)
            ) {
                RepairHistory::create([
                    'repair_id' => $repair->id,
                    'status' => $repair->status,
                    'comment' => (isset($validatedData['priority']) && $validatedData['priority'] !== $repair->priority) &&
                        (isset($validatedData['technician_id']) && $validatedData['technician_id'] !== $repair->technician_id)
                        ? 'Prioridad cambió a ' . $validatedData['priority'] . ' y ' . 'técnico cambió a ' . $validatedData['technician_id'] . ''
                        : ($validatedData['priority'] !== $repair->priority
                            ? 'Prioridad cambió a ' . $validatedData['priority']
                            : 'Técnico cambió a ' . $validatedData['technician_id']),
                    'changed_by' => auth()->user()->id,
                    'store_id' => $repair->store_id,
                ]);
            }


            $repair->load(['device', 'technician', 'store']);

            DB::commit();

            return new RepairResource($repair);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error actualizando reparación: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error al actualizar la reparación.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repair $repair)
    {
        //
    }

    /**
     * Cambiar a atendiendo
     */
    public function  changeAtention(UpdateRepairRequest $request, Repair $repair)
    {

        $validatedData = $request->validated();
        try {
            DB::beginTransaction();

            //Caso estado atendiendo
            if (isset($validatedData['status']) && $validatedData['status'] === 'atendiendo') {
                Log::info('Actualizando');
                RepairHistory::create([
                    'repair_id' => $repair->id,
                    'status' => $validatedData['status'],
                    'comment' => 'Estado actualizado a ' . $validatedData['status'],
                    'changed_by' => auth()->user()->id,
                    'store_id' => $repair->store_id,
                ]);

                // Actualizar el estado del dispositivo si es necesario
                if ($validatedData['status'] === 'atendiendo') {
                    $repair->device->update(['status' => 'atendiendo']);
                }
            }

            // Actualizar la reparación
            $repair->update($validatedData);


            DB::commit();
            return response()->json([
                'message' => 'Datos actualizados.',
                'status' => '200'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error actualizando reparación: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error al actualizar la reparación.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
