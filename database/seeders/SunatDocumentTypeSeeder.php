<?php

namespace Database\Seeders;

use App\Models\SunatDocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SunatDocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            ['code' => '01', 'description' => 'Factura', 'status' => true],
            ['code' => '03', 'description' => 'Boleta de venta', 'status' => true],
            ['code' => '07', 'description' => 'Nota de crédito', 'status' => true],
            ['code' => '08', 'description' => 'Nota de debito', 'status' => true],
            ['code' => '09', 'description' => 'Guía remisión remitente', 'status' => true],
            ['code' => '12', 'description' => 'Ticket de maquina registradora', 'status' => true],
            ['code' => '31', 'description' => 'Guía de remisión transportista', 'status' => true],
          
        ];

        foreach ($documents as $document) {
            SunatDocumentType::create($document);
        }
    }
}
