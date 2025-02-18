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
            ['code' => '060001', 'name' => 'iPhone 6s', 'description' => 'Pantalla IPS 4.7", cuerpo de aluminio, procesador A9, 2GB RAM, Touch ID, 3D Touch.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '060101', 'name' => 'iPhone 6s Plus', 'description' => 'Pantalla IPS 5.5", cuerpo de aluminio, procesador A9, 2GB RAM, Touch ID, 3D Touch, estabilización óptica.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '070001', 'name' => 'iPhone 7', 'description' => 'Pantalla IPS 4.7", cuerpo de aluminio resistente al agua, procesador A10 Fusion, 2GB RAM, sin jack de audio.", cuerpo de aluminio, procesador A9, 2GB RAM, Touch ID, 3D Touch, estabilización óptica.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '070101', 'name' => 'iPhone 7 Plus', 'description' => 'Pantalla IPS 5.5", cuerpo de aluminio resistente al agua, procesador A10 Fusion, 3GB RAM, doble cámara.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '080001', 'name' => 'iPhone 8', 'description' => 'Pantalla IPS 4.7", cuerpo de vidrio y aluminio, carga inalámbrica, procesador A11 Bionic, 2GB RAM.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '080101', 'name' => 'iPhone 8 Plus', 'description' => 'Pantalla IPS 5.5", cuerpo de vidrio y aluminio, carga inalámbrica, procesador A11 Bionic, 3GB RAM.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '100001', 'name' => 'iPhone X', 'description' => 'Pantalla OLED 5.8" Super Retina, cuerpo de vidrio y acero, Face ID, procesador A11 Bionic, 3GB RAM.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '100011', 'name' => 'iPhone XS', 'description' => 'Pantalla OLED 5.8" Super Retina, cuerpo de vidrio y acero, Face ID, procesador A12 Bionic, 4GB RAM.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '100101', 'name' => 'iPhone XS Max', 'description' => 'Pantalla OLED 6.5" Super Retina, cuerpo de vidrio y acero, Face ID, procesador A12 Bionic, 4GB RAM.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '110001', 'name' => 'iPhone 11', 'description' => 'Pantalla LCD 6.1" Liquid Retina, cuerpo de vidrio y aluminio, procesador A13 Bionic, 4GB RAM.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '110201', 'name' => 'iPhone 11 Pro', 'description' => 'Pantalla OLED 5.8" Super Retina XDR, cuerpo de vidrio y acero, procesador A13 Bionic, 6GB RAM, triple cámara.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '110301', 'name' => 'iPhone 11 Pro Max', 'description' => 'Pantalla OLED 6.5" Super Retina XDR, cuerpo de vidrio y acero, procesador A13 Bionic, 6GB RAM, triple cámara.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '120001', 'name' => 'iPhone 12', 'description' => 'Pantalla OLED 6.1" Super Retina XDR, Ceramic Shield, cuerpo de vidrio y aluminio, A14 Bionic, 4GB RAM.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '120201', 'name' => 'iPhone 12 Pro', 'description' => 'Pantalla OLED 6.1" Super Retina XDR, Ceramic Shield, cuerpo de vidrio y acero, A14 Bionic, 6GB RAM, LiDAR.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '120301', 'name' => 'iPhone 12 Pro Max', 'description' => 'Pantalla OLED 6.7" Super Retina XDR, Ceramic Shield, cuerpo de vidrio y acero, A14 Bionic, 6GB RAM, LiDAR.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '130001', 'name' => 'iPhone 13', 'description' => 'Pantalla OLED 6.1" Super Retina XDR, Ceramic Shield, cuerpo de vidrio y aluminio, A15 Bionic, 4GB RAM.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '130201', 'name' => 'iPhone 13 Pro', 'description' => 'Pantalla OLED 6.1" ProMotion 120Hz, Ceramic Shield, cuerpo de vidrio y acero, A15 Bionic, 6GB RAM, LiDAR.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '130301', 'name' => 'iPhone 13 Pro Max', 'description' => 'Pantalla OLED 6.7" ProMotion 120Hz, Ceramic Shield, cuerpo de vidrio y acero, A15 Bionic, 6GB RAM, LiDAR.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '140001', 'name' => 'iPhone 14', 'description' => 'Pantalla OLED 6.1" Super Retina XDR, Ceramic Shield, cuerpo de vidrio y aluminio, A15 Bionic, 6GB RAM.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '140201', 'name' => 'iPhone 14 Pro', 'description' => 'Pantalla OLED 6.1" ProMotion 120Hz, Dynamic Island, cuerpo de vidrio y acero, A16 Bionic, 6GB RAM, LiDAR.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '140301', 'name' => 'iPhone 14 Pro Max', 'description' => 'Pantalla OLED 6.7" ProMotion 120Hz, Dynamic Island, cuerpo de vidrio y acero, A16 Bionic, 6GB RAM, LiDAR.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '150001', 'name' => 'iPhone 15', 'description' => 'Pantalla OLED 6.1" Super Retina XDR, Ceramic Shield, cuerpo de vidrio y aluminio, A16 Bionic, 6GB RAM, Dynamic Island.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '150201', 'name' => 'iPhone 15 Pro', 'description' => 'Pantalla OLED 6.1" ProMotion 120Hz, Ceramic Shield, cuerpo de titanio, A17 Pro, 8GB RAM, USB-C, zoom óptico 3x.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '150301', 'name' => 'iPhone 15 Pro Max', 'description' => 'Pantalla OLED 6.7" ProMotion 120Hz, Ceramic Shield, cuerpo de titanio, A17 Pro, 8GB RAM, zoom óptico 5x.', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '160001', 'name' => 'iPhone 16', 'description' => 'Pantalla Super Retina XDR, Aluminio con parte posterior de vidrio con infusión de color, botón de acción, Chip A18, CPU de 6 núcleos, GPU de 5 núcleos, Neural Engine de 16 núcleos, Control de la Cámara', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '160002', 'name' => 'iPhone 16 Pro', 'description' => 'Pantalla Super Retina XDR, Aluminio con parte posterior de vidrio con infusión de color, botón de acción, Chip A18 Pro, CPU de 6 núcleos, GPU de 6 núcleos, Neural Engine de 16 núcleos, Control de la Cámara', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

            ['code' => '160003', 'name' => 'iPhone 16 Pro Max', 'description' => 'Pantalla Super Retina XDR, Aluminio con parte posterior de vidrio con infusión de color, botón de acción, Chip A18 Pro, CPU de 6 núcleos, GPU de 6 núcleos, Neural Engine de 16 núcleos, Control de la Cámara', 'type' => 'product', 'category_id' => '1', 'brand_id' => '1', 'sunat_unit' => 'NIU', 'current_stock' => 0, 'min_stock' => 2, 'image' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'store_id' => 1],

        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
