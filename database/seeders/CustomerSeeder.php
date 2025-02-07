<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'Lorenzo', 'document_id' => '1','document_number' => '45345343', 'email' => 'no@email.com', 'phone' => '999999999', 'address' => '-', 'status' => true, 'store_id' => 1],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
