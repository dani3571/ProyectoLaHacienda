<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservacionVeterinaria;

class ReservasVeterinariaController extends Controller
{
    public function index($id)
    {
        $reservaciones = ReservacionVeterinaria::where('usuario_id',$id)
        ->get();
        return response()->json($reservaciones, 200);
    }
    public function history($id)
    {
        $reservaciones = ReservacionVeterinaria::where('usuario_id',$id)
            ->where('fecha', '<=', now()->format('Y-m-d'))
            ->where('horaRecepcion', '<=', now()->format('H:i'))
            ->get();
        return response()->json($reservaciones);
    }
    public function store(ReservacionPeluqueria $reservation)
    {

    }
}
