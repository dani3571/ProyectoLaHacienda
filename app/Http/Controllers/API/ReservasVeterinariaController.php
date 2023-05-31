<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservacionVeterinaria;

class ReservasVeterinariaController extends Controller
{
    public function index()
    {
        $reservaciones = ReservacionVeterinaria::where('usuario_id',$id)
        ->get();
        return response()->json($reservaciones);
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
