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
           'ci'=> '13761371',
           'telefono' => '77731872',
           'direccion' => 'Miraflores',
           'email' => 'dani@gmail.com',
           'personaResponsable' => 'Maria Gutierrez',
           'telefonoResponsable' => '13721353',
           'password' => Hash::make('12345678'),
       ])->assignRole('Administrador');

       User::create([
        'name' => 'Juan Perez',
        'ci'=> '13243252',
        'telefono' => '3123124',
        'direccion' => 'Calle diaz romero',
        'email' => 'juanPer@gmail.com',
        'personaResponsable' => 'Maria Gutierrez',
        'telefonoResponsable' => '12432354',
        'password' => Hash::make('12345678'),
    ])->assignRole('Cliente');
    }

}