<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relacion 1:1 inversa (Habitacion-ReservacionHotel)
    public function reservacion_hotels()
    {
        return $this->belongsTo(ReservacionHotel::class);
    }
    
    public $timestamps = false;
}
