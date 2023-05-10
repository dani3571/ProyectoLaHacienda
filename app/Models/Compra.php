<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];
  
    //relacion compra - detalle_compra
    public function detalle_compras(){
     return $this->hasMany(DetalleCompras::class);
    }

}