<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mascotas extends Model
{

    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    public $timestamps = true;
    //relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
    //relacion de uno a muchos (mascotas - diagnostico)
    public function diagnosticos(){
        return $this->hasMany(Diagnostico::class);
    }

    //relacion de uno a muchos (mascotas - vacuna)
    public function vacunas(){
        return $this->hasMany(Vacunas::class);
    }
     //relacion de uno a muchos (mascotas - pesos)
    public function pesos(){
      return $this->hasMany(Peso::class);
    }

    public function reservacion_hotels(){
        return $this->hasMany(ReservacionHotel::class);
    }
    public function reservacion_peluquerias(){
         return $this->hasMany(ReservacionPeluqueria::class);
    }
    public function reservacion_veterinarias(){
      return $this->hasMany(ReservacionVeterinaria::class);
   }
   
}
