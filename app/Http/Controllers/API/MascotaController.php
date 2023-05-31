<?php

namespace App\Http\Controllers\API;

use App\Models\Mascotas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index()
    {
        $mascotas = Mascotas::where('usuario_id',$id)
        ->get();
        return response()->json($mascotas);
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
