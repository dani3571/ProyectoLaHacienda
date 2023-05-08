<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{    
    use HasFactory;
     //usamos guared a las propiedades que no queremos que se asignen masivamente
     //es decir acepta todas exepto las que ponemos dentro
     protected $guarded = ['id','created_at','updated_at'];
    //relacion inversa ventas - users
  /*
    public function users(){
        return $this->belongsTo(User::class);
    }
    */
    //relacion inversa detalle_ventas - productos
    public function detalle_ventas(){
        return $this->hasMany(Productos::class);
    }
}
