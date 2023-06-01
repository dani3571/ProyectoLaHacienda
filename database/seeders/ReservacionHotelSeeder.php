<?php

namespace Database\Seeders;
use App\Models\ReservacionHotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservacionHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       ReservacionHotel::create([
            'fechaIngreso' => '2033-12-31',
            'fechaSalida'=> '2044-12-31',
            'tratamientos' => 'Ninguno',
            'tranporte' => '0',
            'comida' => '0',
            'banioYCorte' => '0',
            'tratamiento' => '0',
            'extras' => '0',
            'total' => '0',
            'estado' => '1',
            'usuario_id' => '1',
            'mascota_id' => '1',
        ]);
    }
}
