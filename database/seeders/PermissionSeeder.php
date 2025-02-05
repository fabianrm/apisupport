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


            [
                'id' => 1,
                'name' => 'Dashboard',
                'description' => 'Panel general',
                'icon' => 'dashboard',
                'route' => '/dashboard',
                'parent_id' => null,
                'order' => 1,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 2,
                'name' => 'Serv. Técnico',
                'description' => 'Servicio Técnico',
                'icon' => 'manage_accounts',
                'route' => 'null',
                'parent_id' => null,
                'order' => 2,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 3,
                'name' => 'Listar Reparaciones',
                'description' => 'Listado de Reparaciones',
                'icon' => 'lists',
                'route' => '/support/repairs/list',
                'parent_id' => 2,
                'order' => 0,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 4,
                'name' => 'Nueva Reparación',
                'description' => 'Registra nueva reparación',
                'icon' => 'add_notes',
                'route' => '/support/repairs/new-repair',
                'parent_id' => 2,
                'order' => 1,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 5,
                'name' => 'Listar Dispositivos',
                'description' => 'Lista dispositivos de clientes',
                'icon' => 'vibration',
                'route' => '/support/devices/list',
                'parent_id' => 2,
                'order' => 2,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 6,
                'name' => 'Registrar Dispositivo',
                'description' => 'Registra dispositivo de cliente',
                'icon' => 'phone_iphone',
                'route' => '/support/devices/new-device',
                'parent_id' => 2,
                'order' => 3,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 7,
                'name' => 'Ventas',
                'description' => 'Panel ventas',
                'icon' => 'point_of_sale',
                'route' => 'null',
                'parent_id' => null,
                'order' => 3,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 8,
                'name' => 'Nueva Venta',
                'description' => 'Registrar Venta',
                'icon' => 'sell',
                'route' => '/sale/sales/new-sale',
                'parent_id' => 7,
                'order' => 0,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 9,
                'name' => 'Listar Ventas',
                'description' => 'Listar Ventas',
                'icon' => 'phone_iphone',
                'route' => '/sale/sales/list',
                'parent_id' => 7,
                'order' => 1,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 10,
                'name' => 'Administración',
                'description' => 'Administrar',
                'icon' => 'settings',
                'route' => 'null',
                'parent_id' => null,
                'order' => 6,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 11,
                'name' => 'Tiendas',
                'description' => 'Registro de Tiendas',
                'icon' => 'store',
                'route' => '/settings/stores/list',
                'parent_id' => 10,
                'order' => 0,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 12,
                'name' => 'Clientes',
                'description' => 'Registro de Clientes',
                'icon' => 'group',
                'route' => '/settings/customers/list',
                'parent_id' => 10,
                'order' => 1,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 13,
                'name' => 'Proveedores',
                'description' => 'Registro de Proveedores',
                'icon' => 'local_shipping',
                'route' => '/settings/suppliers/list',
                'parent_id' => 10,
                'order' => 2,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],

            [
                'id' => 14,
                'name' => 'Tipo de Dispositivos',
                'description' => 'Registro de Tipo de Disp.',
                'icon' => 'devices_wearables',
                'route' => '/settings/type-dispositives/list',
                'parent_id' => 10,
                'order' => 6,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 15,
                'name' => 'Compras',
                'description' => 'Compras',
                'icon' => 'local_mall',
                'route' => null,
                'parent_id' => null,
                'order' => 4,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 16,
                'name' => 'Lista de ingresos',
                'description' => 'Registro de Ingresos',
                'icon' => 'storefront',
                'route' => '/warehouse/entries/list',
                'parent_id' => 15,
                'order' => 1,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'name' => 'Nuevo ingreso',
                'description' => 'Registrar Ingreso',
                'icon' => 'add_shopping_cart',
                'route' => '/warehouse/entries/new-entry',
                'parent_id' => 15,
                'order' => 2,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 18,
                'name' => 'Almacén',
                'description' => 'Almacén',
                'icon' => 'storefront',
                'route' => null,
                'parent_id' => null,
                'order' => 5,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 19,
                'name' => 'Productos',
                'description' => 'Registro de Productos',
                'icon' => 'qr_code',
                'route' => '/settings/products/list',
                'parent_id' => 18,
                'order' => 1,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 20,
                'name' => 'Categorías',
                'description' => 'Registro de Categorías',
                'icon' => 'category',
                'route' => '/settings/categories/list',
                'parent_id' => 18,
                'order' => 2,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 21,
                'name' => 'Marcas',
                'description' => 'Registro de Marcas',
                'icon' => 'inbox',
                'route' => '/settings/brands/list',
                'parent_id' => 18,
                'order' => 3,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 22,
                'name' => 'Usuarios',
                'description' => 'Usuarios',
                'icon' => 'manage_accounts',
                'route' => null,
                'parent_id' => null,
                'order' => 7,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 23,
                'name' => 'Lista de Usuarios',
                'description' => 'Usuarios',
                'icon' => 'person_add',
                'route' => '/users/list',
                'parent_id' => 22,
                'order' => 7,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ],
            [
                'id' => 24,
                'name' => 'Roles',
                'description' => 'Roles de Usuario',
                'icon' => 'account_box',
                'route' => '/users/roles/list',
                'parent_id' => 22,
                'order' => 7,
                'status' => 1,
                'created_at' => '2025-02-04 17:07:50',
                'updated_at' => '2025-02-04 17:07:50'
            ]



        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
