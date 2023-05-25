<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    //relacion productos - proveedor_productos 
     public function proveedor_productos(){
        return $this->hasMany(ProveedorProductos::class);
    }
    //relacion productos - detalle_compra
    public function detalle_compras(){
        return $this->hasMany(DetalleCompras::class);
    }
    //relacion productos - detalle_producto
    public function detalle_productos(){
        return $this->hasMany(DetalleProducto::class);
    }
    
    //relacion productos - detalle_venta
    public function detalle_ventas(){
        return $this->hasMany(DetalleVentas::class);
    }
    public function categorias(){
        return $this->belongsTo(Categorias::class);
    }

    
}
  

