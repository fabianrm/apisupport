<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'Dashboard', 'description' => 'Panel general', 'icon' => 'users', 'route' => '/dashboard', 'parent_id' => null, 'order' => 0, 'status' => true],
            ['name' => 'Ventas', 'description' => 'Panel ventas', 'icon' => 'users', 'route' => '/sales', 'parent_id' => null, 'order' => 1, 'status' => true],
            ['name' => 'Nueva Venta', 'description' => 'Registrar venta', 'icon' => 'users', 'route' => '/sales', 'parent_id' => 1, 'order' => 2, 'status' => true],
            ['name' => 'Reparaciones', 'description' => 'Registrar equipo', 'icon' => 'users', 'route' => '/sales', 'parent_id' => 1, 'order' => 3, 'status' => true],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
