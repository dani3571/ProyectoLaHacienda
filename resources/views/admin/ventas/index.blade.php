@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1 class ="text-muted">Ventas realizadas</h1>
<br>
@endsection
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/logo2.png') }}">
@section('css')
<style>
.nav-item {
    background: dark;
  }
  .menu-open{
     background-color: #4d5059 !important;  
  }
</style>
@endsection
@section('content')
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: 'Éxito',
        text: '{{ session('success') }}',
        icon: 'success'
    });
</script>
@endif
@if(session('fail'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: 'Error!',
        text: '{{ session('fail') }}',
        icon: 'error'
    });
</script>
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
                        @can('ventas.show')
                        <a href="{{ route('ventas.show', ['id' => $venta->id]) }}" class="btn btn-primary btn-sm mb-2">Detalle</a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>    
        <div class="text-center mt-3">
            {{ $ventas->links() }}
        </div>
    </div>
</div>
@endsection