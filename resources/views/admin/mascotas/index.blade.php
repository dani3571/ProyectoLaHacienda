@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Administra a tus mascotas</h1>
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
        <a class="btn btn-primary" href="{{route('mascotas.create')}}">Registrar mascota</a>
        <a class="btn btn-primary" href="{{route('mascotas.inactivos')}}">Mascotas inactivas</a>
        <a class="btn btn-primary" href="{{route('getPDF')}}">Reporte</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Raza</th>
                    <th>Color</th>
                    <th>fechaNacimiento</th>
                    <th>Caracter</th>
                    <th>Sexo</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($mascotas as $mascota )
                <tr>
                    <td>{{$mascota->id}}</td>
                    <td>{{$mascota->nombre}}</td>
                    <td>{{$mascota->tipo}}</td>
                    <td>{{$mascota->raza}}</td>
                    <td>{{$mascota->color}}</td>
                    <td>{{$mascota->fechaNacimiento}}</td>
                    <td>{{$mascota->caracter}}</td>
                    <td>{{$mascota->sexo}}</td>
                    
                    <td width="10px"><a href="{{route('mascotas.edit', $mascota)}}" class="btn btn-primary btn-sm mb-2">Editar</a></td>

                    <td width="10px">
                       
                        <form action="{{ route('mascotas.cambiar-estado', $mascota->id) }}" method="POST">
                            @csrf
                            @method('PUT')      
                            <input type="submit" value="Cambiar Estado" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection