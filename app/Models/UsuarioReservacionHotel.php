<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioReservacionHotel extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
   
    //relacion inversa de uno a muchos (UsuarioReservacionHotel - User)
    public function user(){
      return $this->belongsTo(User::class);
    }

   //relacion inversa de uno a muchos (ReservacionHotel - UsuarioReservacionHotel)
   public function reservacion_hotels(){
    return $this->belongsTo(ReservacionHotel::class);
   }

}
