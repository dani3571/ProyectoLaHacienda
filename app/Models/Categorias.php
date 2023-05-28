<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    public $timestamps = true;
    
    public function productos(){
        return $this->hasMany(Productos::class);
    }
 
}
