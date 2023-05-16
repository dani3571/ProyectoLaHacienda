@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Ventas realizadas</h1>
<br>
<a href="" class="btn btn-primary">Crear nueva venta</a>
@endsection

@section('content')
@if (session('success-delete'))
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Total</th>
                    <th scope="col">Fecha de la Venta</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($ventas as $venta )
                <tr>
                    <th>{{$venta->id}}</th>
                    <td>{{$venta->usuario}}</td>
                    <td>{{$venta->cliente}}</td>
                    <td>{{$venta->cantidad}}</td>
                    <td>{{$venta->total}}</td>
                    <td>{{$venta->fechaVenta}}</td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm mb-2">Detalle</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center mt-3">
        
        </div>

    </div>
</div>
@endsection



