<?php

namespace Database\Seeders;

use App\Models\SunatSerial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SerialSunatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serials = [
            ['store_id' => '1', 'code' => '01', 'document'=>'Factura', 'serial'=>'F001', 'correlative'=> 1 ],
            ['store_id' => '1', 'code' => '03', 'document'=>'Boleta de Venta', 'serial'=>'B001', 'correlative'=> 5 ],
        ];

        foreach ($serials as $serial) {
            SunatSerial::create($serial);
        }
    }
}
