<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;
use App\Models\DetalleVentas;
use App\Models\Productos;
use App\Models\Ventas;
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
        //MAYO
        for ($i = 0; $i < 10; $i++) {
            $fechaVenta = Carbon::create(2023, 5, $faker->numberBetween(1, 31));
            $createdAt = Carbon::create(2023, 5, $faker->numberBetween(1, 31));
            
            $id = $faker->numberBetween(1, 6);
            $producto = Productos::find($id);
            $cantidad = $faker->numberBetween(1, 10);
            $subtotal = $producto->precio * $cantidad;

            $ventaActual = Ventas::create([
                'usuario' => $faker->name,
                'cliente' => $faker->name,
                'cantidad' => $cantidad,
                'total' => $subtotal,
                'fechaVenta' => $fechaVenta,
                'created_at' => $createdAt,
            ]);
            $ultimaVenta = Ventas::latest()->first();
            DetalleVentas::create([
                'id_venta' => $ventaActual -> id,
                'id_producto' => $id,
                'subtotal' => $subtotal,
                'cantidad_individual' => $cantidad,
                'created_at' => $createdAt,
            ]);
        }

        
    }
}
