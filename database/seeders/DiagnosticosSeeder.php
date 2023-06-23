<?php

namespace Database\Seeders;
use App\Models\Diagnostico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiagnosticosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Diagnostico::create([
            'descripcion' => 'Medición de pulso',
            'fecha' => '2023-06-15',
            'fechaVolver' => '2023-08-15',
            'costo' => 340.00,
            'mascota_id' => 1,
            'created_at' => '2023-05-30 15:45:14',
            'updated_at' => '2023-05-30 15:45:14',
        ]);

        Diagnostico::create([
            'descripcion' => 'Revisión de pupilas',
            'fecha' => '2023-06-16',
            'fechaVolver' => '2023-08-16',
            'costo' => 250.00,
            'mascota_id' => 1,
            'created_at' => '2023-06-01 09:30:00',
            'updated_at' => '2023-06-01 09:30:00',
        ]);

        Diagnostico::create([
            'descripcion' => 'Limpieza de dientes',
            'fecha' => '2023-06-17',
            'fechaVolver' => '2023-08-17',
            'costo' => 180.00,
            'mascota_id' => 1,
            'created_at' => '2023-06-02 14:15:22',
            'updated_at' => '2023-06-02 14:15:22',
        ]);
    }

}
