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
        <a class="btn btn-primary" href="{{route('categorias.index')}}">Proveedores registrados</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DESCRIPCION</th> 
                </tr>
            </thead>

            <tbody>
                @foreach ($categorias as $categoria)
                <tr>
                    <th>{{$categoria->id}}</th>
                    <td>{{$categoria->nombre}}</td>
                    <td>{{$categoria->descripcion}}</td>
                    
  
                    <td width="10px">
                        <form action="{{ route('categorias.restablecer-estado', $categoria->id) }}" method="POST">
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
