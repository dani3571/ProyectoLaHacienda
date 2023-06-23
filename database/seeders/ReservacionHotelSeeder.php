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
            'fechaIngreso' => '2023-06-16',
            'fechaSalida' => '2023-06-17',
            'horaRecepcion' => '15:58',
            'tratamiento_veterinaria' => 1,
            'tratamiento_corte_banio' => 1,
            'observaciones' => 'Sin observaciones',
            'zona_direccion' => 'Zona sur',
            'direccion' => 'Miraflores',
            'costo_transporte' => 100.00,
            'costo_comida' => 40.00,
            'costo_veterinaria' => 100.00,
            'costo_corte_banio' => 100.00,
            'costo_extras' => 60.00,
            'costo_total' => 460.00,
            'horaCheckin' => '16:08',
            'horaCheckout' => '16:09',
            'estado' => 3,
            'usuario_id' => 1,
            'mascota_id' => 1,
            'habitacion_id' => 2,
            'created_at' => '2023-06-15 16:09:47',
            'updated_at' => '2023-06-15 16:09:47',
        ]);
    }
}
