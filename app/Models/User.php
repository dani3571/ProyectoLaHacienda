<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'ci',
        'telefono',
        'direccion',
        'email',
        'personaResponsable',
        'telefonoResponsable',
        'password',
       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ventas()
    {
        return $this->hasMany(Ventas::class);
    }
    //relacion de 1 a muchos
    public function mascotas()
    {
        return $this->hasMany(Mascotas::class);
    }

    //relacion de 1 a muchos
    public function usuario_reservacion_hotels()
    {
        return $this->hasMany(UsuarioReseracionHotel::class);
    }
    
    //relacion de 1 a muchos
    public function usuario_reservacion_peluquerias()
    {
        return $this->hasMany(UsuarioReseracionPeluqueria::class);
    }
    
    //relacion de 1 a muchos
    public function usuario_reservacion_veterinarias()
    {
        return $this->hasMany(UsuarioReseracionVeterinaria::class);
    }

    //Relacion 1 a 1 user - profile 

    public function profile(){
        return $this->hasOne(Profile::class);
    }

}
