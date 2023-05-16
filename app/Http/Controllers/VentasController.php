<?php

namespace App\Http\Controllers;

use App\Models\DetalleVentas;
use Illuminate\Http\Request;

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
}
