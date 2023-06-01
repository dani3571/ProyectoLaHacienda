@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1 class ="text-muted">Compras realizadas</h1>
<br>
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
                    <th scope="col">Fecha</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Cantidad Total</th>
                    <th scope="col">Precio Total</th>
                    <th></th>
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
                    <td>
                        <a href="{{ route('compras.show', ['id' => $compra->id]) }}" class="btn btn-primary btn-sm mb-2">Detalle</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection