<?php

namespace Database\Seeders;

use App\Models\SunatDocumentId;
use App\Models\SunatDocumentIdentification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SunatDocumentIDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            ['code' => '0', 'description' => 'DOC.TRIB.NO.DOM.SIN.RUC', 'status' => true],
            ['code' => '1', 'description' => 'DOC. NACIONAL DE IDENTIDAD', 'status' => true],
            ['code' => '4', 'description' => 'CARNET DE EXTRANJERIA', 'status' => true],
            ['code' => '6', 'description' => 'REG. UNICO DE CONTRIBUYENTES', 'status' => true],
            ['code' => '7', 'description' => 'PASAPORTE', 'status' => true],
            ['code' => 'A', 'description' => 'CED. DIPLOMATICA DE IDENTIDAD', 'status' => true],
            ['code' => 'B', 'description' => 'DOC.IDENT.PAIS.RESIDENCIA-NO.D', 'status' => true],
            ['code' => 'C', 'description' => 'Tax Identification Number - TIN - Doc Trib PP.NN', 'status' => true],
            ['code' => 'D', 'description' => 'Identification Number - IN - Doc Trib PP. JJ', 'status' => true],
        ];

        foreach ($documents as $document) {
            SunatDocumentId::create($document);
        }

    }
}
