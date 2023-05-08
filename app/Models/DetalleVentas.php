<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    //relacion inversa detalle_ventas - productos
    public function productos(){
        return $this->belongsTo(Productos::class);
    }
   //relacion inversa detalle_ventas - ventas
   public function ventas(){
    return $this->belongsTo(Ventas::class);
}
    
}
