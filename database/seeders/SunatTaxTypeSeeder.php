<?php

namespace Database\Seeders;

use App\Models\SunatTaxType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SunatTaxTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['code' => '10', 'description' => 'Gravado - Operación Onerosa', 'status' => true],
            ['code' => '11', 'description' => 'Gravado - Retiro por premio', 'status' => false],
            ['code' => '12', 'description' => 'Gravado - Retiro por donación', 'status' => true],
            ['code' => '13', 'description' => 'Gravado - Retiro', 'status' => true],
            ['code' => '14', 'description' => 'Gravado - Retiro por publicidad', 'status' => true],
            ['code' => '15', 'description' => 'Gravado - Bonificaciones', 'status' => true],
            ['code' => '16', 'description' => 'Gravado - Retiro por entrega a trabajadores', 'status' => false],
            ['code' => '17', 'description' => 'Gravado - IVAP', 'status' => false],
            ['code' => '20', 'description' => 'Exonerado - Operación Onerosa', 'status' => true],
            ['code' => '21', 'description' => 'Exonerado - Transferencia Gratuita', 'status' => true],
            ['code' => '30', 'description' => 'Inafecto - Operación Onerosa', 'status' => true],
            ['code' => '31', 'description' => 'Inafecto - Retiro por Bonificación', 'status' => false],
            ['code' => '32', 'description' => 'Inafecto - Retiro', 'status' => true],
            ['code' => '33', 'description' => 'Inafecto - Retiro por Muestras Médicas', 'status' => false],
            ['code' => '34', 'description' => 'Inafecto - Retiro por Convenio Colectivo', 'status' => false],
            ['code' => '35', 'description' => 'Inafecto - Retiro por premio', 'status' => true],
            ['code' => '36', 'description' => 'Inafecto - Retiro por publicidad', 'status' => false],
            ['code' => '40', 'description' => 'Exportación', 'status' => false],
        ];

        foreach ($currencies as $currency) {
            SunatTaxType::create($currency);
        }
    }
}
