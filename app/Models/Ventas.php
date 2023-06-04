<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{    
    use HasFactory;
     protected $guarded = ['id','created_at','updated_at'];
    /*
    public function users(){
        return $this->belongsTo(User::class);
    }
    */
    public function detalle_ventas(){
        return $this->hasMany(DetalleVentas::class, 'id_venta');
    }
}
