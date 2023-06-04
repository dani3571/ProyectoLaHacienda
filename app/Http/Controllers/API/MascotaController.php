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

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
