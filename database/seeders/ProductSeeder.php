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
            ['code'=> 'IS001','name' => 'iPhone 11', 'description' => 'Normal', 'type'=> 'product', 'category_id'=> '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock'=>2, 'image'=>null, 'status' => 1, 'created_by' => 1,'updated_by' => 1, 'store_id'=> 1 ],

            ['code' => 'IS002','name' => 'iPhone 15', 'description' => 'Normal', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null,'status' => 1,'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],
           
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
