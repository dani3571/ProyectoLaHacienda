<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission ;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //Roles
        $cliente = Role::create(['name' => 'Cliente']);
        $admin = Role::create(['name' => 'Administrador']);
        $veterinario = Role::create(['name' => 'Veterinario']);
        $adiestrador = Role::create(['name' => 'AdiestradorPeluquero']);
        $recepcionista = Role::create(['name' => 'Recepcionista']);
        $ayudanteCirugias = Role::create(['name' => 'AyudanteCirugias']);

        //Permisos
        Permission::create(['name'=>'admin.index',
                            'description' => 'Ver el dashboard'])->syncRoles([$admin, $veterinario, $adiestrador, $recepcionista, $ayudanteCirugias]);

        //distintos permisos
        //permisos de rol
     //Roles
     Permission::create([
        'name' => 'roles.index',
        'description' => 'Ver roles'
    ])->assignRole($admin);

    Permission::create([
        'name' => 'roles.create',
        'description' => 'Crear roles'
    ])->assignRole($admin);

    Permission::create([
        'name' => 'roles.edit',
        'description' => 'Editar roles'
    ])->assignRole($admin);

    Permission::create([
        'name' => 'roles.destroy',
        'description' => 'Eliminar roles'
    ])->assignRole($admin);

    }
}
