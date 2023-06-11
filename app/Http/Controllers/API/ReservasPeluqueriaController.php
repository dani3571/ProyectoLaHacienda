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
    public function create(Request $request)
    {
        $reserva = ReservacionPeluqueria::create([
            'fecha' => $request->input('fecha'),
            'horaRecepcion' => $request->input('horaRecepcion'),
            'horaEntrega' => $request->input('horaEntrega'),
            'BanoSimple' => $request->input('BanoSimple'),
            'corte' => $request->input('corte'),
            'tranquilizante' => $request->input('tranquilizante'),
            'Observaciones' => $request->input('Observaciones'),
            'costo' => $request->input('costo'),
            'motivoCancelacion' => $request->input('motivoCancelacion'),
            'estado' => $request->input('estado'),
            'usuario_id' => $request->input('usuario_id'),
            'mascota_id' => $request->input('mascota_id'),
            'created_at' => $request->input('created_at'),
            'updated_at' => $request->input('updated_at'),
        ]);
        if ($reserva) {
            $ultimareserva = ReservacionPeluqueria::latest()->first();
            return response()->json($ultimareserva, 201);
        } else {
            return response()->json(['error' => 'No se pudo crear el usuario'], 500);
        }
    }
}
