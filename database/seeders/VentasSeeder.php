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

        $faker = FakerFactory::create();
        //ENERO
        for ($i = 0; $i < 10; $i++) {
            $fechaVenta = Carbon::create(2023, 1, $faker->numberBetween(1, 31));
            $createdAt = Carbon::create(2023, 1, $faker->numberBetween(1, 31));
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
                'id_venta' => $ventaActual->id,
                'id_producto' => $id,
                'subtotal' => $subtotal,
                'cantidad_individual' => $cantidad,
                'created_at' => $createdAt,
            ]);
        }

        //FEBRERO 
        for ($i = 0; $i < 10; $i++) {
            $fechaVenta = Carbon::create(2023, 2, $faker->numberBetween(1, 28));
            $createdAt = Carbon::create(2023, 2, $faker->numberBetween(1, 28));
            $id = $faker->numberBetween(1, 6);
            $producto = Productos::find($id);
            $cantidad = $faker->numberBetween(1, 25);
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
                'id_venta' => $ventaActual->id,
                'id_producto' => $id,
                'subtotal' => $subtotal,
                'cantidad_individual' => $cantidad,
                'created_at' => $createdAt,
            ]);
        }
         //MARZO
         for ($i = 0; $i < 10; $i++) {
            $fechaVenta = Carbon::create(2023, 3, $faker->numberBetween(1, 31));
            $createdAt = Carbon::create(2023, 3, $faker->numberBetween(1, 31));
            $id = $faker->numberBetween(1, 6);
            $producto = Productos::find($id);
            $cantidad = $faker->numberBetween(1, 30);
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
                'id_venta' => $ventaActual->id,
                'id_producto' => $id,
                'subtotal' => $subtotal,
                'cantidad_individual' => $cantidad,
                'created_at' => $createdAt,
            ]);
        }

          //ABRIL
          for ($i = 0; $i < 10; $i++) {
            $fechaVenta = Carbon::create(2023, 4, $faker->numberBetween(1, 30));
            $createdAt = Carbon::create(2023, 4, $faker->numberBetween(1, 30));
            $id = $faker->numberBetween(1, 6);
            $producto = Productos::find($id);
            $cantidad = $faker->numberBetween(1, 40);
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
                'id_venta' => $ventaActual->id,
                'id_producto' => $id,
                'subtotal' => $subtotal,
                'cantidad_individual' => $cantidad,
                'created_at' => $createdAt,
            ]);
        }


        //MAYO
        for ($i = 0; $i < 10; $i++) {
            $fechaVenta = Carbon::create(2023, 5, $faker->numberBetween(1, 31));
            $createdAt = Carbon::create(2023, 5, $faker->numberBetween(1, 31));

            $id = $faker->numberBetween(1, 6);
            $producto = Productos::find($id);
            $cantidad = $faker->numberBetween(1, 50);
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
                'id_venta' => $ventaActual->id,
                'id_producto' => $id,
                'subtotal' => $subtotal,
                'cantidad_individual' => $cantidad,
                'created_at' => $createdAt,
            ]);
        }
          //JUNIO
          for ($i = 0; $i < 3; $i++) {
            $fechaVenta = Carbon::create(2023, 6, $faker->numberBetween(1, 20));
            $createdAt = Carbon::create(2023, 6, $faker->numberBetween(1, 30));

            $id = $faker->numberBetween(1, 6);
            $producto = Productos::find($id);
            $cantidad = $faker->numberBetween(1, 80);
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
                'id_venta' => $ventaActual->id,
                'id_producto' => $id,
                'subtotal' => $subtotal,
                'cantidad_individual' => $cantidad,
                'created_at' => $createdAt,
            ]);
        }


    }
}