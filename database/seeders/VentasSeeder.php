<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;
class VentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //FEBRERO 

        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {
            $fechaVenta = Carbon::create(2023, 2, $faker->numberBetween(1, 28));
            $createdAt = Carbon::create(2023, 2, $faker->numberBetween(1, 28));

            DB::table('ventas')->insert([
                'usuario' => $faker->name,
                'cliente' => $faker->name,
                'cantidad' => $faker->numberBetween(1, 10),
                'total' => $faker->randomFloat(2, 10, 100),
                'fechaVenta' => $fechaVenta,
                'created_at' => $createdAt,
            ]);
        }

    }
}
