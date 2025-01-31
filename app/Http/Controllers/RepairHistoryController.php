<?php

namespace App\Http\Controllers;

use App\Models\RepairHistory;
use App\Http\Requests\StoreRepairHistoryRequest;
use App\Http\Requests\UpdateRepairHistoryRequest;
use App\Models\Device;
use App\Models\Repair;
use App\Models\RepairFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RepairHistoryController extends Controller
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
    public function store(StoreRepairHistoryRequest $request)
    {
        $validatedData = $request->validated();
        try {
            DB::beginTransaction();
            $history = RepairHistory::create($validatedData);

            //TODO:Subida de archivos

            // Procesar archivos nuevos si existen
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('files/store/repairs', $fileName, 'public');

                    RepairFile::create([
                        'repair_id' => $history->repair_id,
                        'store_id' => $history->store_id,
                        'file_path' => $filePath,
                    ]);
                }
            }

            if (isset($validatedData['status'])) {
                switch ($validatedData['status']) {
                    case 'solucionado':
                        $validatedData['resolved_at'] = Carbon::now();
                        break;
                    case 'cerrado':
                        $validatedData['closed_at'] = Carbon::now();
                        break;
                    case 'cancelada':
                        $validatedData['closed_at'] = Carbon::now();
                        break;
                }
            }

            // Actualizar el estado del dispositivo,
            $repair = Repair::findOrFail($history['repair_id']);

            $repair->update($validatedData);

            // $repair->update(['status' => $history->status]);

            // Actualizar el estado del dispositivo,
            $device = Device::findOrFail($repair['device_id']);
            $device->update(['status' => $history->status]);





            DB::commit();
            return response()->json([
                'message' => 'Datos guardados correctamente.',
                'status' => '201'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Error al registrar el evento.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RepairHistory $repairHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RepairHistory $repairHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepairHistoryRequest $request, RepairHistory $repairHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RepairHistory $repairHistory)
    {
        //
    }
}
