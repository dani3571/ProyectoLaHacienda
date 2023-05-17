<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVentas;
use App\Models\Ventas;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $ventas = DetalleVentas::join('ventas','detalle_ventas.id','=','ventas.id')
            //->join('producto','detalle_ventas.id','=','ventas.id')
            ->select('detalle_ventas.*','ventas.*')
            ->get();
        return view('admin.ventas.index', compact('ventas'));
    }

    public function create()
    {
        return view('admin.ventas.create');
    }

    public function insertarVentas(Request $request)
    {
        
    }
}
