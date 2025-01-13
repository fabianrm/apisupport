<?php

namespace Database\Seeders;

use App\Models\SunatOperationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SunatOperationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operations = [
            ['code' => '0101','description' => 'Venta interna', 'status' => true],
            ['code' => '0102','description' => 'Exportación', 'status' => false],
            ['code' => '0103','description' => 'No domiciliados', 'status' => false],
            ['code' => '0104','description' => 'Venta interna - Anticipos', 'status' => true],
            ['code' => '0105','description' => 'Venta itinerante', 'status' => true],
            ['code' => '0106','description' => 'Factura guía', 'status' => true],
            ['code' => '0107','description' => 'Venta arroz pilado', 'status' => false],
            ['code' => '0108','description' => 'Factura - comprobante de percepción', 'status' => false],
            ['code' => '0110','description' => 'Factura - guía remitente', 'status' => true],
            ['code' => '0111','description' => 'Factura - guía transportista', 'status' => true],
        ];

        foreach ($operations as $operation) {
            SunatOperationType::create($operation);
        }
    }
}
