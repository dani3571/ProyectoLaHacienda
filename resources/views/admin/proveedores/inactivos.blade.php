@extends('adminlte::page')

@section('title', 'Proveedores Eliminados')

@section('content_header')
<h1>Proveedores Inactivos</h1>
@endsection

@section('content')
@if(session('success-create'))
<div class="alert alert-info">
     {{ session('success-create') }}
</div>
@elseif (session('success-update'))
<div class="alert alert-info">
    {{ session('success-update') }}
</div>
@elseif (session('success-delete'))
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif

<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="{{route('proveedores.index')}}">Proveedores registrados</a>
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
                @foreach ($proveedores as $proveedor)
                <tr>
                    <th>{{$proveedor->id}}</th>
                    <td>{{$proveedor->nombre}}</td>
                    <td>{{$proveedor->telefono}}</td>
                    <td>{{$proveedor->direccion}}</td>          
                    <td>{{$proveedor->ciudad}}</td>
                    <td>{{$proveedor->url}}</td>          
                    <td>{{$proveedor->fecha_registro}}</td>
                    
  
                    <td width="10px">
                        <form action="{{ route('proveedores.restablecer-estado', $proveedor->id) }}" method="POST">
                            @csrf
                            @method('PUT')      
                            <input type="submit" value="Activar" class="btn btn-primary btn-sm mb-2">
                        </form>
                    </td>

                    
  
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
