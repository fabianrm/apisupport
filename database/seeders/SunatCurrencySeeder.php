<?php

namespace Database\Seeders;

use App\Models\SunatCurrency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SunatCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $currencies = [
            ['code' => 'PEN', 'description' => 'Nuevo Sol', 'status' => true],
            ['code' => 'USD', 'description' => 'Dólar', 'status' => true],
            ['code' => 'EUR', 'description' => 'Euro', 'status' => true],
        ];

        foreach ($currencies as $currency) {
            SunatCurrency::create($currency);
        }

    }
}
