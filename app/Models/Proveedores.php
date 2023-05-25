<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    //relacion de 1 a muchos con productos_proveedores
    //(proveedores-productos_proveedores)

    public function proveedor_productos(){
        return $this->hasMany(ProveedorProductos::class);
    }

   //relacion inversa detalle_ventas - productos
    public function compras(){
           return $this->hasMany(Compras::class);
    }

    

}
