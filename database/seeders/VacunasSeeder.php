<?php

namespace Database\Seeders;
use App\Models\Vacunas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vacunas::create([
            'nombre_vacuna' => 'Vacuna Antiviral',
            'fecha_vacuna' => '2023-06-13',
            'mascota_id' => 1,
            'created_at' => '2023-05-30 15:45:14',
            'updated_at' => '2023-06-19 00:48:44',
        ]);

        Vacunas::create([
            'nombre_vacuna' => 'Vacuna Antirrábica',
            'fecha_vacuna' => '2023-06-19',
            'mascota_id' => 1,
            'created_at' => '2023-06-19 09:38:49',
            'updated_at' => '2023-06-19 09:38:49',
        ]);
    }

}
