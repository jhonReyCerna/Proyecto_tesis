<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Limpiar caché y datos existentes
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Crear permisos
        Permission::firstOrCreate(['name' => 'manage sales']);
        Permission::firstOrCreate(['name' => 'manage inventory']);
        Permission::firstOrCreate(['name' => 'process payments']);
        Permission::firstOrCreate(['name' => 'manage categories']);  // Este es el nombre correcto
        Permission::firstOrCreate(['name' => 'manage suppliers']);
        Permission::firstOrCreate(['name' => 'manage clients']);    // Este es el nombre correcto

        // Crear roles y asignar permisos
        $gerente = Role::firstOrCreate(['name' => 'gerente']);
        $gerente->givePermissionTo([
            'manage sales',
            'manage inventory',
            'process payments',
            'manage categories',   // Corregido de 'manage categorias'
            'manage suppliers',
            'manage clients'       // Corregido de 'manage clientes'
        ]);

        $asesorVenta = Role::firstOrCreate(['name' => 'asesores de venta']);
        $asesorVenta->givePermissionTo('manage sales');

        $jefeAlmacen = Role::firstOrCreate(['name' => 'jefe de almacen']);
        $jefeAlmacen->givePermissionTo('manage inventory');

        $cajera = Role::firstOrCreate(['name' => 'cajera']);
        $cajera->givePermissionTo('process payments');
    }
}
