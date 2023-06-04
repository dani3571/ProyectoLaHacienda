@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Lista de Productos</h1>
@endsection

@section('content')
@if (session('success-delete'))
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                  
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DESCRIPCION</th>
                    <th scope="col">CATEGORIA</th>             
                    <th scope="col">PRECIO</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">IMAGEN</th>
                    <th scope="col">FECHA COMPRA</th>
                    <th scope="col">FECHA VENCIMIENTO</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($productos as $producto)
    <tr>
        <td>{{ $producto->id }}</td>
        <td>{{ $producto->nombre }}</td>
        <td>{{ $producto->descripcion }}</td>
        <td>
        @php
            $categoria = \App\Models\Categorias::find($producto->categoria_id);

            if ($categoria) {
                echo $categoria->nombre;
            } else {
                echo 'Sin categoria';
            }
        @endphp

        </td>
        <td>{{ $producto->precio }}</td>
        <td>{{ $producto->cantidad }}</td>
        
        <td>
            <img src="{{ asset('images/productos/' . basename($producto->image)) }}" alt="Imagen del producto"  width="100" height="100">
        </td>


        <td>{{ $producto->fecha_compra }}</td>
        <td>{{ $producto->fecha_vencimiento }}</td>
        <td>
            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-primary btn-sm mb-2">Modificar</a>
        </td>
        <td width="10px">
                       
        <form method="POST" action="{{ route('productos.cambiarestado', $producto->id) }}">
                @csrf
                @method('PUT')      
                <input type="submit" value="Cambiar Estado" class="btn btn-danger btn-sm">
            </form>
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


