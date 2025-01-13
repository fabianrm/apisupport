<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            StoreSeeder::class,
            SupplierSeeder::class,
            MovementTypeSeeder::class,
            SunatOperationTypeSeeder::class,
            SunatDocumentTypeSeeder::class,
            SunatPaymentMethodSeeder::class,
            SunatCurrencySeeder::class,
            SunatUnitSeeder::class,
            SunatTaxTypeSeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}
