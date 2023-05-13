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
           'email' => 'dani@gmail.com',
           'direccion' => 'Miraflores',
           'telefono' => '77731872',
           'password' => Hash::make('12345678'),
       ])->assignRole('Administrador');

       User::create([
        'name' => 'Juan Perez',
        'email' => 'juanPer@gmail.com',
        'direccion' => 'Calle diaz romero',
        'telefono' => '3123124',
        'password' => Hash::make('12345678'),
    ])->assignRole('Cliente');

    }
}