<?php

namespace Database\Seeders;
use App\Models\Habitacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Habitacion::create([
            'nro_habitacion' => 1,
            'tipo_ocupante'=> "",
            'costo_habitacion'=> 35.0,
            'tamano_habitacion'=> 20,
            'estado' => 1
        ]);
    }
}
