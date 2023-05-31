@extends('adminlte::page')

@section('title', 'Lista de Proveedores')

@section('content_header')
<h1>Lista Proveedores</h1>
@endsection

@section('content')
@if (session('success-delete'))
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif
<div class="card">
<div class="card-header">
        <a class="btn btn-primary" href="{{ route('proveedores.pdf') }}" target="_blank">Reporte total</a>

    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">TELEFONO</th>             
                    <th scope="col">DIRECCION</th>
                    <th scope="col">CIUDAD</th>
                    <th scope="col">URL</th>
                    <th scope="col">FECHA REGISTRO</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($proveedores as $proveedor )
                <tr>
                    <th>{{$proveedor->id}}</th>
                    <td>{{$proveedor->nombre}}</td>
                    <td>{{$proveedor->telefono}}</td>
                    <td>{{$proveedor->direccion}}</td>          
                    <td>{{$proveedor->ciudad}}</td>
                    <td>{{$proveedor->url}}</td>          
                    <td>{{$proveedor->fecha_registro}}</td>
          


                
                    
                    <td width="10px"><a href="{{ route('proveedores.edit', $proveedor->id) }}"
                     class="btn btn-primary btn-sm mb-2">Modificar</a></td>

                    <td width="10px">
                       
                        <form method="POST" action="{{ route('proveedores.cambiarestado', $proveedor->id) }}">
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



