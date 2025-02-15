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
            ['code' => '0', 'description' => 'DOC.TRIB.NO.DOM.SIN.RUC', 'status' => true, 'lenght' => 1],
            ['code' => '1', 'description' => 'DOC. NACIONAL DE IDENTIDAD', 'status' => true, 'lenght' => 8],
            ['code' => '4', 'description' => 'CARNET DE EXTRANJERIA', 'status' => true, 'lenght' => 12],
            ['code' => '6', 'description' => 'REG. UNICO DE CONTRIBUYENTES', 'status' => true, 'lenght' => 11],
            ['code' => '7', 'description' => 'PASAPORTE', 'status' => true, 'lenght' => 12],
            ['code' => 'A', 'description' => 'CED. DIPLOMATICA DE IDENTIDAD', 'status' => true, 'lenght' => 20],
            ['code' => 'B', 'description' => 'DOC.IDENT.PAIS.RESIDENCIA-NO.D', 'status' => true, 'lenght' => 20],
            ['code' => 'C', 'description' => 'Tax Identification Number - TIN - Doc Trib PP.NN', 'status' => true, 'lenght' => 20],
            ['code' => 'D', 'description' => 'Identification Number - IN - Doc Trib PP. JJ', 'status' => true, 'lenght' => 20],
        ];

        foreach ($documents as $document) {
            SunatDocumentId::create($document);
        }
    }
}
