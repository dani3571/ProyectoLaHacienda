<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ReservacionHotel extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];
   
    //relacion inversa de uno a muchos (ReservacionHotel - UsuarioReservacionHotel)
    //relacion de 1 a muchos
    /*
    public function user_reservacion_hotels()
    {
        return $this->hasMany(UsuarioReseracionHotel::class);
    }*/
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    //Relacion 1:1 (ReservacionHotel-Habitacion)
    public function habitacion(){
        return $this->hasOne(Habitacion::class);
    }
  
    


}
