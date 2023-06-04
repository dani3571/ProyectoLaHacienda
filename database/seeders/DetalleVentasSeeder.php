<?php

namespace Database\Seeders;

use App\Models\DetalleVentas;
use App\Models\Ventas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;
class DetalleVentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        $ventas = Ventas::all();
        
        foreach ($ventas as $venta) {
            $createdAt = Carbon::create(2023, 2, $faker->numberBetween(1, 28));
        
            $cantidad = $venta->cantidad;
            $subtotal = $cantidad * $venta->total;
        
            $detalleVenta = DetalleVentas::create([
                'id_venta' => $venta->id,
                'id_producto' => $faker->numberBetween(1, 6),
                'subtotal' => $subtotal,
                'cantidad_individual' => $cantidad,
                'created_at' => $createdAt,
            ]);
        }
    }
}
