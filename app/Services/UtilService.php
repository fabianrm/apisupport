<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Repair;

class UtilService
{


    public function generateUniqueCodeDevice(String $prefix)
    {
        // Obtiene el último código generado
        $lastDevice = Device::latest()->first();

        if ($lastDevice) {
            // Extrae el número del código existente y lo incrementa
            $lastNumber = intval(substr($lastDevice->code, 2)) + 1;
        } else {
            // Si no hay clientes previos, empieza desde 1
            $lastNumber = 1;
        }

        // Formatea el nuevo código con ceros a la izquierda
        $newCode = $prefix . str_pad($lastNumber, 5, '0', STR_PAD_LEFT);

        // Verifica si el nuevo código ya existe en la base de datos
        while (Device::where('code', $newCode)->exists()) {
            // Si existe, incrementa el número y vuelve a intentarlo
            $lastNumber++;
            $newCode = $prefix . str_pad($lastNumber, 5, '0', STR_PAD_LEFT);
        }

        return $newCode;
    }


    public function generateUniqueCodeRepair(String $prefix)
    {
        // Obtiene el último código generado
        $lastRepair = Repair::latest()->first();

        if ($lastRepair) {
            // Extrae el número del código existente y lo incrementa
            $lastNumber = intval(substr($lastRepair->code, 2)) + 1;
        } else {
            // Si no hay clientes previos, empieza desde 1
            $lastNumber = 1;
        }

        // Formatea el nuevo código con ceros a la izquierda
        $newCode = $prefix . str_pad($lastNumber, 5, '0', STR_PAD_LEFT);

        // Verifica si el nuevo código ya existe en la base de datos
        while (Repair::where('code', $newCode)->exists()) {
            // Si existe, incrementa el número y vuelve a intentarlo
            $lastNumber++;
            $newCode = $prefix . str_pad($lastNumber, 5, '0', STR_PAD_LEFT);
        }

        return $newCode;
    }

}