<?php

namespace Database\Seeders;

use App\Models\SunatUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SunatUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['code' => 'NIU', 'description' => 'Unidad (bienes)', 'status' => true],
            ['code' => 'ZZ', 'description' => 'Unidad (servicios)', 'status' => true],
            ['code' => 'PR', 'description' => 'Par', 'status' => true],
            ['code' => 'PK', 'description' => 'Paquete', 'status' => true],
            ['code' => 'SET', 'description' => 'Juego', 'status' => true],
            ['code' => 'BX', 'description' => 'Caja', 'status' => true],
            ['code' => 'BG', 'description' => 'Bolsa', 'status' => true],
        ];

        foreach ($units as $unit) {
            SunatUnit::create($unit);
        }
    }
}
