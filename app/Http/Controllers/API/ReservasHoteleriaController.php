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
