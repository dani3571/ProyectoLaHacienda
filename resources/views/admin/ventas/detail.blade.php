@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Detalle de la Venta</h1>
<a href="{{route('ventas.index')}}">
    Volver
</a>
<br>
<br>
@can('ventas.getPDFreciboventas')
<a href="{{ route('getPDFreciboventas', ['id' => $venta_individual[0]->id]) }}" class="btn btn-primary">Imprimir recibo</a>
@endcan
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
                    <th scope="col">Usuario</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Total</th>
                    <th scope="col">Fecha de la Venta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta_individual as $item)
                <tr>
                    <th>{{$item->id_venta}}</th>
                    <td>{{$item->usuario}}</td>
                    <td>{{$item->cliente}}</td>
                    <td>{{$item->cantidad}}</td>
                    <td>{{$item->total}}</td>
                    <td>{{$item->fechaVenta}}</td>
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
                    <th scope="col">Precio Individual</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($ventas as $venta)
                <tr>
                    <th>{{$venta->id_producto}}</th>
                    <td>{{$venta->nombre}}</td>
                    <td>{{$venta->cantidad_individual}}</td>
                    <td>{{$venta->precio}}</td>
                    <td>{{$venta->subtotal}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection