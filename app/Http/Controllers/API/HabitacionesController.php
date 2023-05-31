<?php

namespace App\Http\Controllers\API;
use App\Models\Habitacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HabitacionesController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::all();
        return response()->json($habitaciones);
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
