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
            'image' => '2LA39nUMIZzvhkglGKWd4uLYjXdKGQVRZ8MwzrrP.png',
            'estado' => '1',
            'categoria_id' => '1',
            
        ]);
        Productos::create([
            'nombre' => 'Croquetas',
            'descripcion'=> 'Croquetas para perro de 1kg',
            'precio' => '35.6',
            'cantidad' => '50',
            'image' => '2LA39nUMIZzvhkglGKWd4uLYjXdKGQVRZ8MwzrrP.png',
            'estado' => '1',
            'categoria_id' => '1',
        ]);
        Productos::create([
            'nombre' => 'Juguete para perro',
            'descripcion'=> 'Juguete pequeño para perro',
            'precio' => '70',
            'cantidad' => '50',
            'image' => '2LA39nUMIZzvhkglGKWd4uLYjXdKGQVRZ8MwzrrP.png',
            'estado' => '1',
            'categoria_id' => '1',
        ]);

        Productos::create([
            'nombre' => 'Chaqueta para perro',
            'descripcion' => 'Chaqueta abrigada para perro',
            'precio' => '120',
            'cantidad' => '30',
            'image' => 'C8ymEoxHNCUk0I7QzoEj73ffr6L49ti0LHZ0nD5T.png',
            'estado' => '1',
            'categoria_id' => 2,
        ]);
        
        Productos::create([
            'nombre' => 'Correa para perro',
            'descripcion' => 'Correa resistente para perro',
            'precio' => '50',
            'cantidad' => '80',
            'image' => '0a7pZfzibM8LYDbs8LPFJzOhe3PXYfgA8Qnl6Fzk.png',
            'estado' => '1',
            'categoria_id' => 3,
        ]);
        
        Productos::create([
            'nombre' => 'Juguete para gato',
            'descripcion' => 'Juguete interactivo para gato',
            'precio' => '40',
            'cantidad' => '60',
            'image' => 'BWBltygQeuMw25GtOJzI2y16lt0JY0GRpGkG2XOQ.png',
            'estado' => '1',
            'categoria_id' => 4,
        ]);
        
        Productos::create([
            'nombre' => 'Camisa para perro',
            'descripcion' => 'Camisa elegante para perro',
            'precio' => '90',
            'cantidad' => '25',
            'image' => '3J8sbDri7PJlAFrmm0tuZMlB2kyyynRB7qYkfvEm.png',
            'estado' => '1',
            'categoria_id' => 1,
        ]);
        
        Productos::create([
            'nombre' => 'Collar para perro',
            'descripcion' => 'Collar ajustable para perro',
            'precio' => '35',
            'cantidad' => '70',
            'image' => 'I1Z1By78pXKTlTmTTD7sXevS3cyz3ZLq2vsg9hf9.png',
            'estado' => '1',
            'categoria_id' => 2,
        ]);
        
        Productos::create([
            'nombre' => 'Ratón de juguete para gato',
            'descripcion' => 'Juguete con forma de ratón para gato',
            'precio' => '20',
            'cantidad' => '45',
            'image' => '4AhDj6wo3fHm97Vx5uxPhV9uVmtFg1CH1R2u7W2S.png',
            'estado' => '1',
            'categoria_id' => 3,
        ]);
        
        Productos::create([
            'nombre' => 'Cama para gato',
            'descripcion' => 'Cama suave y cómoda para gato',
            'precio' => '60',
            'cantidad' => '35',
            'image' => 'g1dz5P3p2ZV0fiup2Xb3kb30LqphCw6HHcZ4lb0V.png',
            'estado' => '1',
            'categoria_id' => 4,
        ]);




    }
}
