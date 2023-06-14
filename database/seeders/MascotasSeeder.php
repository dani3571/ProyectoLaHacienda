<?php

namespace Database\Seeders;
use App\Models\Mascotas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MascotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Mascotas::create([
            'nombre' => 'Cachuchín',
            'tipo'=> 'Perro',
            'raza'=> 'Caniche Toy',
            'color'=> 'Blanco',
            'fechaNacimiento'=> '2021-04-14',
            'caracter'=> 'Amigable',
            'sexo'=> 'Macho',
            'estado'=> '1',
            'image'=>'napcRinIwR9BuQ0Yaqbyu8HA09Wb1D0ab4IOjmMP.jpg',
            'peso' => '15kg',
            'tamaño'=> 'Mediano',
            'usuario_id'=> '1',
        ]);
    }
}
