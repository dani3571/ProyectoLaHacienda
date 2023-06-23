@extends('adminlte::page')

@section('title', 'Lista de Categorias')

@section('content_header')
<h1>Lista Categorias</h1>
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
                </tr>
            </thead>

            <tbody>
                @foreach ($categoria as $categoria )
                <tr>
                    <th>{{$categoria->id}}</th>
                    <td>{{$categoria->nombre}}</td>
                    <td>{{$categoria->descripcion}}</td>
          


                
                    
                    <td width="10px"><a href="{{ route('admin.categorias.edit', $categoria->id) }}"
                     class="btn btn-primary btn-sm mb-2">Editar</a></td>

                    <td width="10px">
                        <form method="POST" action="{{ route('categorias.cambiarestado', $categoria->id) }}">
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



