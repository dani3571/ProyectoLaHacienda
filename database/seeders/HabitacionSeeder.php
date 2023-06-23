<?php

namespace Database\Seeders;
use App\Models\Habitacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    Habitacion::create([
        'nro_habitacion' => '123',
        'tipo_ocupante' => 'Perro',
        'costo_habitacion' => 120.00,
        'tamano_habitacion' => 'Mediano',
        'estado' => 2,
        'created_at' => '2023-06-14 14:55:03',
        'updated_at' => null,
    ]);

    Habitacion::create([
        'nro_habitacion' => '777',
        'tipo_ocupante' => 'Gato',
        'costo_habitacion' => 98.00,
        'tamano_habitacion' => 'Pequeño',
        'estado' => 1,
        'created_at' => null,
        'updated_at' => null,
    ]);

    Habitacion::create([
        'nro_habitacion' => '100',
        'tipo_ocupante' => 'Perro',
        'costo_habitacion' => 120.00,
        'tamano_habitacion' => 'Mediano',
        'estado' => 1,
        'created_at' => null,
        'updated_at' => null,
    ]);

    Habitacion::create([
        'nro_habitacion' => '99',
        'tipo_ocupante' => 'Gato',
        'costo_habitacion' => 98.00,
        'tamano_habitacion' => 'Pequeño',
        'estado' => 0,
        'created_at' => null,
        'updated_at' => null,
    ]);
}

}
