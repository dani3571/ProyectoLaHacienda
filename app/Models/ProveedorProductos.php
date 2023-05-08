<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorProductos extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    //relacion de 1 a muchos con productos_proveedores inversa
   //(proveedores-productos_proveedores)
   //relacion inversa ProveedorProductos - proveedor
   public function proveedor(){
       return $this->belongsTo(Proveedores::class);
   }
   //relacion inversa detalle_ventas - productos
   public function productos(){
   return $this->belongsTo(Productos::class);
   }
}
