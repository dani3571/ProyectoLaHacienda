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
         ])->syncRoles([$admin, $veterinario, $adiestrador, $recepcionista, $ayudanteCirugias]);
 
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
             'description' => 'Cambiar de estado roles'
         ])->assignRole($admin);
 
         Permission::create([
             'name' => 'roles.restablecer-estado',
             'description' => 'Restablecer roles inactivos'
         ])->assignRole($admin);
 
         Permission::create([
             'name' => 'roles.getPDFRole',
             'description' => 'Ver reporte de roles'
         ])->assignRole($admin);


            //MASCOTAS
            Permission::create([
                'name' => 'mascotas.index',
                'description' => 'Listar mascotas'
            ])->assignRole($admin, $cliente, $veterinario, $recepcionista, $adiestrador, $ayudanteCirugias);
    
            Permission::create([
                'name' => 'mascotas.create',
                'description' => 'Crear mascotas'
            ])->assignRole($admin, $cliente, $veterinario, $recepcionista, $adiestrador, $ayudanteCirugias);
    
            Permission::create([
                'name' => 'mascotas.edit',
                'description' => 'Editar mascotas'
            ])->assignRole($admin, $cliente, $veterinario, $recepcionista, $adiestrador, $ayudanteCirugias);
    
            Permission::create([
                'name' => 'mascotas.inactivos',
                'description' => 'Ver mascotas inactivas'
            ])->assignRole($admin, $cliente, $veterinario, $recepcionista, $adiestrador, $ayudanteCirugias);
    
            Permission::create([
                'name' => 'mascotas.cambiar-estado',
                'description' => 'Cambiar de estado mascotas'
            ])->assignRole($admin, $cliente, $veterinario, $recepcionista, $adiestrador, $ayudanteCirugias);
    
            Permission::create([
                'name' => 'mascotas.restablecer-estado',
                'description' => 'Restablecer mascotas inactivos'
            ])->assignRole($admin, $cliente, $veterinario, $recepcionista, $adiestrador, $ayudanteCirugias);
    
 
         //VENTAS
         Permission::create([
             'name' => 'ventas.index',
             'description' => 'Ver listado de ventas'
         ])->assignRole($admin);
         Permission::create([
             'name' => 'ventas.create',
             'description' => 'Crear ventas'
         ])->assignRole($admin);

         Permission::create([
            'name' => 'ventas.show',
            'description' => 'Ver detalle de ventas'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'ventas.getPDFreciboventas',
            'description' => 'Sacar facturas de detalle ventas'
        ])->assignRole($admin);
       
         Permission::create([
            'name' => 'ventas.getPDFventas',
            'description' => 'Sacar reporte de ventas'
        ])->assignRole($admin);


         //usuarios
         Permission::create([
             'name' => 'users.index',
             'description' => 'Ver listado de usuarios'
         ])->assignRole($admin);
 
         Permission::create([
             'name' => 'users.inactivos',
             'description' => 'Ver listado de usuarios inactivos'
         ])->assignRole($admin, $recepcionista);
 
         Permission::create([
             'name' => 'users.edit',
             'description' => 'Editar usuarios'
         ])->assignRole($admin, $recepcionista);
 
         Permission::create([
             'name' => 'users.cambiar-estado',
             'description' => 'Cambiar de estado a usuarios'
         ])->assignRole($admin, $recepcionista);
 
         Permission::create([
             'name' => 'users.restablecer-estado',
             'description' => 'Restablecer estado a usuarios'
         ])->assignRole($admin, $recepcionista);
 
         Permission::create([
             'name' => 'getPD',
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
             'description' => 'Ver reservaciones de peluqueria canceladas'
         ])->assignRole($admin, $adiestrador);
 
         Permission::create([
             'name' => 'reservas_peluqueria.completadas',
             'description' => 'Ver reservaciones de peluquerias completadas'
         ])->assignRole($admin, $adiestrador);

         Permission::create([
            'name' => 'reservas_peluqueria.create',
            'description' => 'Crear reservaciones de peluqueria'
        ])->assignRole($admin, $adiestrador);

         Permission::create([
            'name' => 'reservas_peluqueria.create_CLI',
            'description' => 'Crear reservaciones de peluqueria - Cliente'
        ])->assignRole($admin, $adiestrador);
 
         //PERMSOS RESERVACION HOTELERIA 
         Permission::create([
             'name' => 'admin/reservacionHotel',
             'description' => 'Ver reservaciones del hotel'
         ])->assignRole($admin, $recepcionista);
         Permission::create([
             'name' => 'reservacionHotel.index',
             'description' => 'Ver reservaciones del hotel'
         ])->assignRole($admin, $recepcionista);
         Permission::create([
             'name' => 'reservacionHotel.create',
             'description' => 'Crear reservaciones del hotel'
         ])->assignRole($admin, $recepcionista);
 
         Permission::create([
             'name' => 'reservacionHotel.edit',
             'description' => 'Editar reservaciones del hotel'
         ])->assignRole($admin, $recepcionista);
 
 
 
 
         //Habitaciones
         Permission::create([
             'name' => 'habitacion',
             'description' => 'Ver Habitaciones'
         ])->assignRole($admin, $recepcionista);
 
         Permission::create([
             'name' => 'habitacion.create',
             'description' => 'Crear Habitaciones'
         ])->assignRole($admin, $recepcionista);
         Permission::create([
             'name' => 'habitacion.edit',
             'description' => 'Crear Habitaciones'
         ])->assignRole($admin, $recepcionista);
 
 
 
 
         //Productos
         Permission::create([
             'name' => 'productos.index',
             'description' => 'Ver listado de productos'
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
             'description' => 'Cambiar estado de productos'
         ])->assignRole($admin);
 
         Permission::create([
             'name' => 'productos.restablecer-estado',
             'description' => 'Restablecer estado de productos'
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
             'name' => 'compras.index',
             'description' => 'Ver listado de compras'
         ])->assignRole($admin);
 
         Permission::create([
             'name' => 'compras.create',
             'description' => 'Crear compras'
         ])->assignRole($admin);
         Permission::create([
            'name' => 'compras.show',
            'description' => 'Ver detalle de compras'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'compras.getPDFcompras',
            'description' => 'Sacar reporte de compras'
        ])->assignRole($admin);

/*
        Permission::create([
            'name' => 'compras.edit',
            'description' => 'Sacar facturas de detalle compras'
        ])->assignRole($admin);
*/

         //PROVEEDORES
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
 
 
         //VETERINARIA
         Permission::create([
             'name' => 'reservas_veterinaria.index',
             'description' => 'Ver listado de reservas activas de veterinaria'
         ])->assignRole($admin, $veterinario, $ayudanteCirugias, $recepcionista);
 
         Permission::create([
             'name' => 'reservas_veterinaria.create',
             'description' => 'Crear reservas de veterinaria'
         ])->assignRole($admin, $veterinario, $ayudanteCirugias, $recepcionista);
 
         Permission::create([
             'name' => 'reservas_veterinaria.edit',
             'description' => 'Editar reservas de veterinaria'
         ])->assignRole($admin, $veterinario, $ayudanteCirugias, $recepcionista);
         
         Permission::create([
             'name' => 'reservas_veterinaria.cancelar',
             'description' => 'Cancelar reservas de veterinaria'
         ])->assignRole($admin, $veterinario, $ayudanteCirugias, $recepcionista);
 
 
         Permission::create([
             'name' => 'reservas_veterinaria.completadas',
             'description' => 'Ver listado de reservas de veterinaria completadas'
         ])->assignRole($admin, $veterinario, $ayudanteCirugias, $recepcionista);
 
         Permission::create([
             'name' => 'reservas_veterinaria.canceladas',
             'description' => 'Ver listado de reservas de veterinaria canceladas'
         ])->assignRole($admin, $veterinario, $ayudanteCirugias, $recepcionista);
 
     
    }
}