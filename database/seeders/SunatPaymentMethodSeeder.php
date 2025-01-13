<?php

namespace Database\Seeders;

use App\Models\SunatPaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SunatPaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['code' => '01', 'description' => 'Contado', 'status' => true],
            ['code' => '02', 'description' => 'Crédito', 'status' => true],
        ];

        foreach ($methods as $method) {
            SunatPaymentMethod::create($method);
        }
    }
}
