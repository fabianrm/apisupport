<?php

namespace Database\Seeders;

use App\Models\DeviceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deviceTypes = [
            ['name' => 'iPhone',],
            ['name' => 'Macbook', ],
            ['name' => 'Laptop', ],
            ['name' => 'AppleWatch',],
        ];

        foreach ($deviceTypes as $type) {
            DeviceType::create($type);
        }
    }
}
