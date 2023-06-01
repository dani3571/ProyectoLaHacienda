@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Detalle de la Venta</h1>
<a href="{{route('compras.index')}}">
    Volver
</a>
<br>
<br>
@endsection

@section('content')
@if (session('success-delete'))
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif
<div class="card">
    <div class="card-body">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Cantidad Total</th>
                    <th scope="col">Precio Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($compras as $compra )
                <tr>
                    <th>{{$compra->id}}</th>
                    <td>{{$compra->fechaCompra}}</td>
                    <td>
                        @foreach ($proveedores as $proveedor )
                            @if($proveedor->id == $compra->id_proveedor) 
                                {{$proveedor->nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$compra->cantidadTotal}}</td>
                    <td>{{$compra->precioTotal}} bs</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br>
<h4 class="text-center">Productos</h4>
<div class="card">
    <div class="card-body">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">Id Producto</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio unidad</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($detalles as $detalle)
                <tr>
                    <th>{{$detalle->id_producto}}</th>
                    <td>
                        @foreach ($productos as $producto )
                            @if($producto->id == $detalle->id_producto) 
                                {{$producto->nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$detalle->cantidad}}</td>
                    <td>{{$detalle->precio}}</td>
                    <td>{{$detalle->precio * $detalle->cantidad}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection