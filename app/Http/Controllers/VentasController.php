<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVentas;
use App\Models\Productos;
use App\Models\Ventas;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use PDF;

class VentasController extends Controller
{
    public function index()
    {
        $ventas = DetalleVentas::join('ventas','detalle_ventas.id','=','ventas.id')
            ->select('detalle_ventas.*','ventas.*')
            ->get();
        return view('admin.ventas.index', compact('ventas'));
    }
    public function show($id)
    {
        $venta_individual = DetalleVentas::join('ventas','detalle_ventas.id','=','ventas.id')
            ->select('detalle_ventas.*','ventas.*')
            ->where('ventas.id',$id)
            ->get();
        $ventas = DetalleVentas::join('ventas','detalle_ventas.id_venta','=','ventas.id')
            ->join('productos','detalle_ventas.id_producto','=','productos.id')
            ->select('detalle_ventas.*','ventas.*','productos.*')
            ->where('detalle_ventas.id_venta',$id)
            ->get();
        return view('admin.ventas.detail', compact('ventas','venta_individual'));
    }
    public function create()
    {
        $productos = Productos::all();
        return view('admin.ventas.create',compact('productos'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        //dd($user->all());
        $detalleVentas = $request->input('venta');
        $Apellido = $request->input('Apellido');
        $Nit = $request->input('Nit');
        $Fecha = $request->input('Fecha');
        $Total = $request->input('Total');
        $CantidadTotal = $request->input('CantidadTotal');
        $cliente = Cliente::where('nit',$Nit)->first(); 
        if(!$cliente) {
            $nuevoCliente = new Cliente();
            $nuevoCliente->apellido = $Apellido;
            $nuevoCliente->nit = $Nit;
            $nuevoCliente->save();
        }
        $nuevaVenta = Ventas::create(
            [
                'usuario' => $user->name,
                'cliente' => $Apellido,
                'cantidad' => $CantidadTotal,
                'total' => $Total,
                'fechaVenta' => $Fecha
            ]
        );
        $idVentaGenerado = $nuevaVenta->id;
        foreach ($detalleVentas as $detalleVenta) {
            $producto = Productos::findOrFail($detalleVenta['IdProducto']);
            if($producto->cantidad - $detalleVenta['Cantidad'] >= 0)
            {
                $producto->cantidad = $producto->cantidad - $detalleVenta['Cantidad'];
                $producto->save();
            }   
            else
            {
                $ventas = DetalleVentas::join('ventas','detalle_ventas.id','=','ventas.id')
                ->select('detalle_ventas.*','ventas.*')
                ->get();
                return redirect()->route('ventas.index', compact('ventas'))->with('fail', 'A ocurrido un error con la venta');
            }
            $detalle = new DetalleVentas();
            $detalle->id_venta = $idVentaGenerado;
            $detalle->id_producto = $detalleVenta['IdProducto'];
            $detalle->subtotal = $detalleVenta['Subtotal'];
            $detalle->cantidad_individual = $detalleVenta['Cantidad'];
            $detalle->save();
        }
        $ventas = DetalleVentas::join('ventas','detalle_ventas.id','=','ventas.id')
            ->select('detalle_ventas.*','ventas.*')
            ->get();
        $ventas = DetalleVentas::join('ventas','detalle_ventas.id','=','ventas.id')
        ->select('detalle_ventas.*','ventas.*')
        ->get();
        return redirect()->route('ventas.index', compact('ventas'))->with('success', 'La venta se ha registrado con éxito');
    }

    public function buscarCliente($nit)
    {
      $cliente = Cliente::where('nit', $nit)->first();
      return response()->json($cliente);
    }

    public function getPDFventas(Request $request){
        $user = Auth::user();
        $name = $user->name;
        $nombreSistema = "SISTEMA GENESIS";
        $fecha = date('Y-m-d'); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        // Obtener la hora actual
        $hora = date('H:i'); // Obtiene la hora actual en formato 'HH:MM'
        $ventas = Ventas::all();
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        $view = view('admin.ventas.reporte', compact('name', 'ventas', 'nombreSistema', 'fecha', 'hora'));
         // Si se seleccionaron fechas de filtrado, pasarlas como variables a la vista
        if ($fechaInicio && $fechaFin) {
        $view->with('fechaInicio', $fechaInicio)->with('fechaFin', $fechaFin);
        }
        // Generar el PDF con la vista del reporte
        $pdf = PDF::loadHTML($view);
  
        return $pdf->stream('Reporte_Ventas.pdf');
      }
}
