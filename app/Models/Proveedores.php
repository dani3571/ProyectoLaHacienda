<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'nombre',
        'telefono',
        'direccion',
        'ciudad',
        'url',
        'fecha_registro',
        'estado'
    ];
    public $timestamps = true;
    //relacion de 1 a muchos con productos_proveedores
    //(proveedores-productos_proveedores)

    public function proveedor_productos(){
        return $this->hasMany(ProveedorProductos::class);
    }

   //relacion inversa detalle_ventas - productos
    public function compras(){
           return $this->hasMany(Compras::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    

}
