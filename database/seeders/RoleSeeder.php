<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
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
        Permission::create([
            'name' => 'admin.index',
            'description' => 'Ver el dashboard'
        ])->syncRoles([$admin, $veterinario, $adiestrador, $recepcionista, $ayudanteCirugias, $cliente]);

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
            'name' => 'roles.inactivos',
            'description' => 'Ver roles inactivos'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'roles.cambiar-estado',
            'description' => 'Cambiar de estado al rol'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'roles.restablecer-estado',
            'description' => 'Restablecer rol inactivo'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'roles.getPDFRole',
            'description' => 'Ver reporte de roles'
        ])->assignRole($admin);

        //VENTAS
        Permission::create([
            'name' => 'ventas.index',
            'description' => 'Ver ventas'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'ventas.create',
            'description' => 'Crear ventas'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'ventas.edit',
            'description' => 'Editar ventas'
        ])->assignRole($admin);

        //usuarios
        Permission::create([
            'name' => 'users.index',
            'description' => 'Ver usuarios'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'users.edit',
            'description' => 'Editar usuarios'
        ])->assignRole($admin, $recepcionista);

        Permission::create([
            'name' => 'users.getPDFusuarios',
            'description' => 'Ver reporte de usuarios'
        ])->assignRole($admin);

        //PERMISOS PELUQUERIA
        Permission::create([
            'name' => 'reservas_peluqueria.index',
            'description' => 'Ver reservas de peluqueria'
        ])->assignRole($admin, $adiestrador);

        Permission::create([
            'name' => 'reservas_peluqueria.edit',
            'description' => 'Editar reservas de peluqueria'
        ])->assignRole($admin, $adiestrador);

        Permission::create([
            'name' => 'reservas_peluqueria.cancelar',
            'description' => 'Cancelar reservaciones de peluqueria'
        ])->assignRole($admin, $adiestrador);

        Permission::create([
            'name' => 'reservas_peluqueria.canceladas',
            'description' => 'Ver las reservaciones canceladas'
        ])->assignRole($admin, $adiestrador);

        Permission::create([
            'name' => 'reservas_peluqueria.completadas',
            'description' => 'Ver reservaciones de peluquerias completadas'
        ])->assignRole($admin, $adiestrador);


        //PERMSOS RESERVACION HOTELERIA 
        Permission::create([
            'name' => 'admin/reservacionHotel',
            'description' => 'Ver reservaciones del hotel'
        ])->assignRole($admin, $recepcionista);

        //Habitaciones
        Permission::create([
            'name' => 'habitacion',
            'description' => 'Ver Habitaciones'
        ])->assignRole($admin, $recepcionista);


        //Productos
        Permission::create([
            'name' => 'productos',
            'description' => 'Ver productos'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'productos.index',
            'description' => 'Ver productos'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'productos.create',
            'description' => 'Crear productos'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'productos.edit',
            'description' => 'Editar productos'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'productos.cambiarestado',
            'description' => 'Cambiar estado del producto'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'productos.restablecer-estado',
            'description' => 'Restablecer estado del producto'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'productos.inactivos',
            'description' => 'Ver Listado de productos inactivos'
        ])->assignRole($admin);


        //Categorias

        Permission::create([
            'name' => 'categorias',
            'description' => 'Ver categorias'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'categorias.index',
            'description' => 'Ver listado de categorias'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'categorias.create',
            'description' => 'Crear categorias'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'categorias.edit',
            'description' => 'Editar categorias'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'categorias.cambiarestado',
            'description' => 'Cambiar estado de categoria'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'categorias.restablecer-estado',
            'description' => 'Restablecer estado de categoria'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'categorias.inactivos',
            'description' => 'Ver Listado de categorias inactivas'
        ])->assignRole($admin);


        //COMPRAS
        Permission::create([
            'name' => 'compras',
            'description' => 'Ver Compras'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'compras.index',
            'description' => 'Ver listado de compras'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'compras.create',
            'description' => 'Crear compra'
        ])->assignRole($admin);

        //PROVEEDORES
        Permission::create([
            'name' => 'proveedores',
            'description' => 'Ver proveedores'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'proveedores.edit',
            'description' => 'Editar proveedores'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'proveedores.create',
            'description' => 'Crear proveedores'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'proveedores.cambiarestado',
            'description' => 'Cambiar estado de proveedores'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'proveedores.restablecer-estado',
            'description' => 'Restablecer estado de proveedores'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'proveedores.inactivos',
            'description' => 'Ver proveedores inactivos'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'proveedores.index',
            'description' => 'Ver listado de proveedores'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'proveedores.pdf',
            'description' => 'Ver reporte de proveedores'
        ])->assignRole($admin);
    }
}