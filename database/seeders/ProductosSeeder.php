<?php

namespace Database\Seeders;

use App\Models\Productos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Productos::create([
            'nombre' => 'Correa',
            'descripcion'=> 'Correa pequeña para perro',
            'precio' => '45.5',
            'cantidad' => '50',
            'image' => '',
            'estado' => '1',
            'categoria_id' => '1',
            
        ]);
        Productos::create([
            'nombre' => 'Croquetas',
            'descripcion'=> 'Croquetas para perro de 1kg',
            'precio' => '35.6',
            'cantidad' => '50',
            'image' => '',
            'estado' => '1',
            'categoria_id' => '1',
        ]);
        Productos::create([
            'nombre' => 'Juguete para perro',
            'descripcion'=> 'Juguete pequeño para perro',
            'precio' => '70',
            'cantidad' => '50',
            'image' => '',
            'estado' => '1',
            'categoria_id' => '1',
        ]);
    }
}
