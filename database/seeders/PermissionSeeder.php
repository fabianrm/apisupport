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
            ['name' => 'Dashboard', 'description' => 'Panel general', 'icon' => 'dashboard', 'route' => '/dashboard', 'parent_id' => null, 'order' => 0, 'status' => true],
            ['name' => 'Serv. Técnico', 'description' => 'Servicio Técnico', 'icon' => 'manage_accounts', 'route' => 'null', 'parent_id' => null, 'order' => 1, 'status' => true],
            ['name' => 'Listar Reparaciones', 'description' => 'Listado de Reparaciones', 'icon' => 'lists', 'route' => '/support/repairs/list', 'parent_id' => 2, 'order' => 0, 'status' => true],
            ['name' => 'Nueva Reparación', 'description' => 'Registra nueva reparación', 'icon' => 'add_notes', 'route' => '/support/repairs/new-repair', 'parent_id' => 2, 'order' => 1, 'status' => true],
            ['name' => 'Listar Dispositivos', 'description' => 'Lista dispositivos de clientes', 'icon' => 'vibration', 'route' => '/support/devices/list', 'parent_id' => 2, 'order' => 2, 'status' => true],
            ['name' => 'Registrar Dispositivo', 'description' => 'Registra dispositivo de cliente', 'icon' => 'phone_iphone', 'route' => '/support/devices/new-device', 'parent_id' => 2, 'order' => 3, 'status' => true],
            ['name' => 'Ventas', 'description' => 'Panel ventas', 'icon' => 'point_of_sale', 'route' => 'null', 'parent_id' => null, 'order' => 2, 'status' => true],
            ['name' => 'Nueva Venta', 'description' => 'Registrar Venta', 'icon' => 'sell', 'route' => '/sails/new-sail', 'parent_id' => 7, 'order' => 0, 'status' => true],
            ['name' => 'Listar Ventas', 'description' => 'Listar Ventas', 'icon' => 'phone_iphone', 'route' => '/sails/list', 'parent_id' => 7, 'order' => 1, 'status' => true],
            ['name' => 'Administración', 'description' => 'Administrar', 'icon' => 'settings', 'route' => 'null', 'parent_id' => null, 'order' => 3, 'status' => true],
            ['name' => 'Tiendas', 'description' => 'Registro de Tiendas', 'icon' => 'store', 'route' => '/settings/stores/list', 'parent_id' => 10, 'order' => 0, 'status' => true],
            ['name' => 'Clientes', 'description' => 'Registro de Clientes', 'icon' => 'group', 'route' => '/settings/customers/list', 'parent_id' => 10, 'order' => 1, 'status' => true],
            ['name' => 'Proveedores', 'description' => 'Registro de Proveedores', 'icon' => 'local_shipping', 'route' => '/settings/suppliers/list', 'parent_id' => 10, 'order' => 2, 'status' => true],
            ['name' => 'Productos', 'description' => 'Registro de Productos', 'icon' => 'qr_code', 'route' => '/settings/products/list', 'parent_id' => 10, 'order' => 3, 'status' => true],
            ['name' => 'Marcas', 'description' => 'Registro de Marcas', 'icon' => 'inbox', 'route' => '/settings/brands/list', 'parent_id' => 10, 'order' => 4, 'status' => true],
            ['name' => 'Categorías', 'description' => 'Registro de Categorías', 'icon' => 'category', 'route' => '/settings/categories/list', 'parent_id' => 10, 'order' => 5, 'status' => true],
            ['name' => 'Tipo de Dispositivos', 'description' => 'Registro de Tipo de Disp.', 'icon' => 'devices_wearables', 'route' => '/settings/type-dispositives/list', 'parent_id' => 10, 'order' => 6, 'status' => true],
            ['name' => 'Usuarios', 'description' => 'Usuarios', 'icon' => 'manage_accounts', 'route' => null, 'parent_id' => null, 'order' => 7, 'status' => true],
            ['name' => 'Lista de Usuarios', 'description' => 'Usuarios', 'icon' => 'person_add', 'route' => '/users/list', 'parent_id' => 18, 'order' => 7, 'status' => true],
            ['name' => 'Roles', 'description' => 'Roles de Usuario', 'icon' => 'account_box', 'route' => '/users/roles/list', 'parent_id' => 18, 'order' => 7, 'status' => true],
            ['name' => 'Almacén', 'description' => 'Almacén', 'icon' => 'storefront', 'route' => null, 'parent_id' => null, 'order' => 5, 'status' => true],
            ['name' => 'Lista de ingresos', 'description' => 'Registro de Ingresos', 'icon' => 'storefront', 'route' => '/warehouse/entries/list', 'parent_id' => 21, 'order' => 1, 'status' => true],
            ['name' => 'Nuevo ingreso', 'description' => 'Registrar Ingreso', 'icon' => 'add_shopping_cart', 'route' => '/warehouse/entries/new-entry', 'parent_id' => 21, 'order' => 2, 'status' => true],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
