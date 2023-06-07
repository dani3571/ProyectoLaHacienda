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
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Daniel Chavez',
            'ci' => '13761371',
            'telefono' => '77731872',
            'direccion' => 'Miraflores',
            'email' => 'dani@gmail.com',
            'personaResponsable' => 'Maria Gutierrez',
            'telefonoResponsable' => '13721353',
            'password' => Hash::make('12345678'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Juan Perez',
            'ci' => '13243252',
            'telefono' => '3123124',
            'direccion' => 'Calle diaz romero',
            'email' => 'juanPer@gmail.com',
            'personaResponsable' => 'Maria Gutierrez',
            'telefonoResponsable' => '12432354',
            'password' => Hash::make('12345678'),
        ])->assignRole('Cliente');

        User::create([
            'name' => 'María Lopez',
            'ci'=> '55443322',
            'telefono' => '99887766',
            'direccion' => 'Calle Secundaria',
            'email' => 'marialopez@gmail.com',
            'personaResponsable' => 'Ana Torres',
            'telefonoResponsable' => '87654321',
            'password' => Hash::make('12345678'),
        ])->assignRole('Cliente');
    
        User::create([
            'name' => 'Luis Ramirez',
            'ci'=> '77665544',
            'telefono' => '55443322',
            'direccion' => 'Avenida Central',
            'email' => 'luisramirez@gmail.com',
            'personaResponsable' => 'Carlos Sanchez',
            'telefonoResponsable' => '98765432',
            'password' => Hash::make('12345678'),
        ])->assignRole('Cliente');
    
   
        User::create([
            'name' => 'Ana Martinez',
            'ci'=> '99887766',
            'telefono' => '11223344',
            'direccion' => 'Calle Principal',
            'email' => 'anamartinez@gmail.com',
            'personaResponsable' => 'Laura Herrera',
            'telefonoResponsable' => '34567890',
            'password' => Hash::make('12345678'),
        ])->assignRole('Cliente');
    
        User::create([
            'name' => 'Pedro Rodriguez',
            'ci'=> '33445566',
            'telefono' => '66778899',
            'direccion' => 'Avenida Secundaria',
            'email' => 'pedrorodriguez@gmail.com',
            'personaResponsable' => 'José Gutierrez',
            'telefonoResponsable' => '09876543',
            'password' => Hash::make('12345678'),
        ])->assignRole('Cliente');
    
        User::create([
            'name' => 'Juan Pérez',
            'ci' => '11223344',
            'telefono' => '555-1234',
            'direccion' => 'Calle Principal 123',
            'email' => 'juan@example.com',
            'personaResponsable' => 'María Gómez',
            'telefonoResponsable' => '555-5678',
            'password' => Hash::make('contraseña1'),
        ])->assignRole('Cliente');
        
        // Crear usuario 3
        User::create([
            'name' => 'María Rodríguez',
            'ci' => '55667788',
            'telefono' => '555-4321',
            'direccion' => 'Avenida Secundaria 456',
            'email' => 'maria@example.com',
            'personaResponsable' => 'Pedro Gutiérrez',
            'telefonoResponsable' => '555-8765',
            'password' => Hash::make('contraseña2'),
        ])->assignRole('Cliente');
        
        // Crear usuario 4
        User::create([
            'name' => 'Luis García',
            'ci' => '99887766',
            'telefono' => '555-9876',
            'direccion' => 'Calle Principal 789',
            'email' => 'luis@example.com',
            'personaResponsable' => 'Ana López',
            'telefonoResponsable' => '555-2345',
            'password' => Hash::make('contraseña3'),
        ])->assignRole('Cliente');
        
        // Crear usuario 5
        User::create([
            'name' => 'Ana Pérez',
            'ci' => '55443322',
            'telefono' => '555-8765',
            'direccion' => 'Avenida Principal 567',
            'email' => 'ana@example.com',
            'personaResponsable' => 'Juan Gómez',
            'telefonoResponsable' => '555-6789',
            'password' => Hash::make('contraseña4'),
        ])->assignRole('Cliente');
        
        // Crear usuario 6
        User::create([
            'name' => 'Pedro López',
            'ci' => '33221144',
            'telefono' => '555-2345',
            'direccion' => 'Avenida Secundaria 789',
            'email' => 'pedro@example.com',
            'personaResponsable' => 'María García',
            'telefonoResponsable' => '555-4321',
            'password' => Hash::make('contraseña5'),
        ])->assignRole('Cliente');
    }
}
