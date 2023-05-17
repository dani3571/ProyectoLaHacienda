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
    public function show($id)
    {
        return view('admin.ventas.index');
    }
    public function create()
    {
        return view('admin.ventas.create');
    }

    public function store(Request $request)
    {
        //$user = Auth::user();
        //$user->$id
        $detalleVentas = $request->input('venta');
        //dd($request->all());
        $Apellido = $request->input('Apellido');
        $Fecha = $request->input('Fecha');
        $Total = $request->input('Total');
        $CantidadTotal = $request->input('CantidadTotal');
        $nuevaVenta = Ventas::create(
            [
                'usuario' => "prueba",
                'cliente' => $Apellido,
                'cantidad' => $CantidadTotal,
                'total' => $Total,
                'fechaVenta' => $Fecha
            ]
        );
        $idVentaGenerado = $nuevaVenta->id;
        foreach ($detalleVentas as $detalleVenta) {
            $idProducto = $detalleVenta['IdProducto'];
            $detalle = new DetalleVentas();
            $detalle->id_venta = $idVentaGenerado;
            $detalle->id_producto = $idProducto;
            $detalle->save();
        }
        $ventas = DetalleVentas::join('ventas','detalle_ventas.id','=','ventas.id')
            //->join('producto','detalle_ventas.id','=','ventas.id')
            ->select('detalle_ventas.*','ventas.*')
            ->get();
        return redirect()->action([VentasController::class, 'index']);
        /*$nuevaVenta->usuario = "prueba";
        $nuevaVenta->cliente = $Apellido;
        $nuevaVenta->cantidad = $CantidadTotal;
        $nuevaVenta->total = $Total;
        $nuevaVenta->fechaVenta = $Fecha;
        $nuevaVenta->save();*/
    }
}
