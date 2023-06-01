<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleCompras;
use App\Models\Proveedores;
use App\Models\Productos;
use App\Models\Compra;
use Illuminate\Support\Facades\Auth;

class ComprasController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:compras.index')->only('index');
      $this->middleware('can:compras.create')->only('create');
    }
    public function index()
    {
        $compras = Compra::all();
        $proveedores = Proveedores::all();
        return view('admin.compras.index', compact('compras', 'proveedores'));
    }
    public function show($id)
    {
        
        $compras = Compra::where('id', $id)
            ->get();
        $proveedores = Proveedores::all();
        $productos = Productos::all();
        $detalles = DetalleCompras::where('detalle_compras.id_compra',$id)
            ->get();
        return view('admin.compras.detail', compact('compras','detalles', 'proveedores', 'productos'));
    }
    public function create()
    {
        $productos = Productos::all();
        $proveedores = Proveedores::all();
        return view('admin.compras.create',compact('productos', 'proveedores'));
    }

    public function store(Request $request)
    {
        //dd( request()->all() );
        $detalleCompra = $request->input('compra');
        //dd($detalleCompra);
        $Fecha = $request->input('fechaCompra');
        $Total = $request->input('Total');
        $CantidadTotal = $request->input('CantidadTotal');
        $IdProveedor = $request->input('IdProveedor');
        $nuevaCompra = Compra::create(
            [
                'precioTotal' => $Total,
                'cantidadTotal' => $CantidadTotal,
                'fechaCompra' => $Fecha,
                'id_proveedor' => $IdProveedor
            ]
        );
        $idCompraGenerado = $nuevaCompra->id;
        foreach ($detalleCompra as $detalle) {
            $producto = Productos::findOrFail($detalle['IdProducto']);
            $producto->cantidad = $producto->cantidad + $detalle['Cantidad'];
            $producto->save();
            $detalleC = new DetalleCompras();
            $detalleC->id_compra = $idCompraGenerado;
            $detalleC->id_producto = $detalle['IdProducto'];
            $detalleC->precio = $detalle['Precio'];
            $detalleC->cantidad = $detalle['Cantidad'];
            $detalleC->save();
        }
        return redirect()->route('compras.index')->with('success', 'La compra se ha registrado con éxito');
    }
}
