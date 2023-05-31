<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ReservacionPeluqueria;
use Illuminate\Http\Request;

class ReservasPeluqueriaController extends Controller
{
    public function index()
    {
        $reservaciones = ReservacionPeluqueria::where('usuario_id',$id)
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
