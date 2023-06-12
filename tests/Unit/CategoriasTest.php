<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Categorias;

class CategoriasTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

     public function testCrearCategoria()
     {
         $categoriaData = [
             'nombre' => 'Alimentos',
             'descripcion' => 'Alimentos para animales caninos',
         ];
     
         $categoria = Categorias::create($categoriaData);
     
         $this->assertInstanceOf(Categorias::class, $categoria);
         $this->assertDatabaseHas('categorias', $categoriaData);
     }
     
    public function test_example()
    {
        $this->assertTrue(true);
    }
}
