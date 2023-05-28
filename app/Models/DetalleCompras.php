<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompras extends Model
{
    use HasFactory;
    
    protected $guarded = ['id','created_at','updated_at'];
    public $timestamps = true;
       //relacion inversa detalle_ventas - productos
       public function productos(){
        return $this->belongsTo(Productos::class);
       }
         
       //relacion compra - detalle_compra
       public function compras(){
        return $this->belongsTo(Compra::class);
       }
    }
