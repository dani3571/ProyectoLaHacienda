<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacunas extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];
    public $timestamps = true;
    //relacion inversa de uno a muchos (diagnostico - mascotas)
    public function mascotas(){
      return $this->belongsTo(Mascotas::class);
  }
}
