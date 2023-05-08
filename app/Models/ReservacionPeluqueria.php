<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservacionPeluqueria extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
  
     //relacion de 1 a muchos
     public function usuario_reservacion_peluquerias()
     {
        return $this->hasMany(UsuarioReseracionPeluqueria::class);
     }
}
