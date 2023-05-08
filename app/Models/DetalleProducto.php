<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProducto extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];
  
       //relacion inversa detalle_ventas - productos
       public function productos(){
        return $this->belongsTo(Productos::class);
    }
}
