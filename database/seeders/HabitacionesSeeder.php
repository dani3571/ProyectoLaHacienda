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
            'costo_habitacion'=> 150,
            'capacidad'=> 20
        ]);
    }
}
