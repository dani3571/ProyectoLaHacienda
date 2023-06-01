<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservacionHotel;

class ReservasHoteleriaController extends Controller
{
    public function index($id)
    {
        $reservaciones = ReservacionHotel::where('usuario_id',$id)
            ->get();
        return response()->json($reservaciones);
    }
    public function history($id)
    {
        $reservaciones = ReservacionHotel::where('usuario_id',$id)
        ->where('fechaSalida', '<=', now()->format('Y-m-d'))
        ->get();
        return response()->json($reservaciones);
    }
    public function store(ReservacionHotel $reservation)
    {
    }
}
