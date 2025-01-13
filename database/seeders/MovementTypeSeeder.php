<?php

namespace Database\Seeders;

use App\Models\MovementType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movementTypes = [
            ['name' => 'compra', 'status' => true],
            ['name' => 'venta', 'status' => true],
            ['name' => 'reparacion', 'status' => true],
            ['name' => 'ajuste', 'status' => true],
            ['name' => 'transferencia', 'status' => true],
        ];

        foreach ($movementTypes as $movementType) {
            MovementType::create($movementType);
        }
    }
}
