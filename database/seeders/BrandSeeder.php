<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple', 'status' => true],
            ['name' => 'Samsung', 'status' => true],
            ['name' => 'NEO', 'status' => true],
            ['name' => 'Google', 'status' => true],
            ['name' => 'Huawei', 'status' => true],
            ['name' => 'iService', 'status' => true],
            ['name' => 'GX', 'status' => true],
            ['name' => 'Sin-Marca', 'status' => true],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
