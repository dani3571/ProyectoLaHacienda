<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservacionPeluqueria;

class ReservasPeluqueriaController extends Controller
{
    public function index($id)
    {
        $reservaciones = ReservacionPeluqueria::where('usuario_id', $id)->get();
        return response()->json($reservaciones);
    }
    public function history($id)
    {
        $reservaciones = ReservacionPeluqueria::where('usuario_id', $id)
            ->where('fecha', '<=', now()->format('Y-m-d'))
            ->where('horaEntrega', '<=', now()->format('H:i'))
            ->get();
        return response()->json($reservaciones);
    }
    public function store(ReservacionPeluqueria $reservation)
    {

    }
}
