<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            ['name' => 'iService Piura - Loreto', 'ruc'=>'20653453453', 'location'=>'Piura', 'ubigeo'=>'20001', 'department'=>'Piura', 'province'=>'Piura', 'district' => 'Piura', 'urbanization' => 'Piura', 'address' => 'Loreto 222', 'sunat_local_code' => '01' , 'phone' => '0000000', 'user_id' => 1 , 'status' => true],
            ['name' => 'iService Piura - Open Plaza', 'ruc'=>'20653453453', 'location'=>'Piura', 'ubigeo'=>'20001', 'department'=>'Piura', 'province'=>'Piura', 'district' => 'Piura', 'urbanization' => 'Piura', 'address' => 'Loreto 222', 'sunat_local_code' => '02' , 'phone' => '0000000', 'user_id' => 1 , 'status' => true],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }
    }
}
