<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioReseracionPeluqueria extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
   
    //relacion inversa de uno a muchos (UsuarioReservacionHotel - User)
    public function user(){
      return $this->belongsTo(User::class);
    }

   //relacion inversa de uno a muchos (ReservacionPeluquerias - UsuarioReservacionHotel)
   public function reservacion_peluquerias(){
    return $this->belongsTo(ReservacionPeluqueria::class);
   }
}
