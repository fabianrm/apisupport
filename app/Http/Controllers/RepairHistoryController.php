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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class RepairHistoryController extends Controller
{

    private ImageManager $imageManager;

    public function __construct()
    {
        // Inicializar ImageManager con el driver GD
        $this->imageManager = new ImageManager(new Driver());
    }

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

            // Procesar archivos nuevos si existen
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $store = $history->store_id;
                    $fileName = time() . '_' . $file->getClientOriginalName();
                   
                    $fileType = $file->getClientOriginalExtension();

                    // Verificar si es una imagen
                    if (in_array(strtolower($fileType), ['jpg', 'jpeg', 'png', 'gif'])) {
                        // Comprimir imagen
                        $image = $this->imageManager->read($file->getRealPath());
                     
                        // Redimensionar si la imagen es muy grande
                        if ($image->width() > 1920) {
                            $image->scale(width: 1920);
                        }

                        $filePath = 'files/' . $store . '/repairs/' . $fileName;

                        // Codificar y guardar la imagen con calidad específica
                        if ($fileType === 'png') {
                            $encodedImage = $image->toPng()->toFilePointer();
                        } else {
                            $encodedImage = $image->toJpeg(75)->toFilePointer();
                        }
                        // Guardar el archivo
                        Storage::disk('public')->put(
                            $filePath,
                            $encodedImage
                        );
                        // Liberar recursos
                        fclose($encodedImage);
                    } else {
                        // Si no es una imagen, guardar el archivo normal
                        $filePath = $file->storeAs('files/' . $store . '/repairs', $fileName, 'public');
                    }

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
