<?php

namespace App\Http\Controllers\API;

use App\Models\Mascotas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index($id)
    {
        $mascotas = Mascotas::where('usuario_id',$id)
        ->get();
        if($mascotas)
        {
            return response()->json($mascotas);
        }
        else
        {
            return response()->json(['no encontrados' => 'El usuario no tiene mascotas'], 201);
        }
    }

    public function create(Request $request)
    {
        $mascota = Mascotas::create([
            'nombre' => $request->input('nombre'),
            'tipo' => $request->input('tipo'),
            'raza' => $request->input('raza'),
            'color' => $request->input('color'),
            'fechaNacimiento' => $request->input('fechaNacimiento'),
            'caracter' => $request->input('caracter'),
            'sexo' => $request->input('sexo'),
            'estado' => $request->input('estado'),
            'peso' => $request->input('peso'),
            'tamaño' => $request->input('tamaño'),
            'image' => $request->input('image'),
            'usuario_id' => $request->input('usuario_id'),
        ]);
        if ($reserva) {
            $ultimaMascota = Mascotas::latest()->first();
            return response()->json($ultimaMascota, 201);
        } else {
            return response()->json(['error' => 'No se pudo crear la mascota'], 500);
        }
    }
}
