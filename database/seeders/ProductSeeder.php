<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'iPhone 11', 'description' => '128 GB, Color Azul', 'type'=> 'product', 'category_id'=> '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock'=>2, 'image'=>null,'available' => 1, 'status' => 'used', 'created_by' => 1,'updated_by' => 1, ],

            ['name' => 'iPhone 15', 'description' => '256 GB, Color Blanco', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'available'=>1, 'status' => 'new', 'created_by' => 1, 'updated_by' => 1,],
           
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
