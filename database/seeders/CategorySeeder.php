<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Moviles', 'status' => true],
            ['name' => 'Computadoras', 'status' => true],
            ['name' => 'Accesorios', 'status' => true],
            ['name' => 'Servicios', 'status' => true],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
