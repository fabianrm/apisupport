<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'dni' => '12345678',
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'), // Cambia esto si necesitas un valor diferente
                'address' => '123 Admin Street',
                'phone' => '987654321',
                'status' => true,
            ],
            [
                'dni' => '87654321',
                'name' => 'Regular User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456'), // Cambia esto si necesitas un valor diferente
                'address' => '456 User Lane',
                'phone' => '912345678',
                'status' => true,
            ],
            [
                'dni' => '56543453',
                'name' => 'Tecnichian User',
                'email' => 'tec@gmail.com',
                'password' => Hash::make('123456'), // Cambia esto si necesitas un valor diferente
                'address' => '456 User Lane',
                'phone' => '912345678',
                'status' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
