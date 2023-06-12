@extends('adminlte::page')

@section('title', 'Productos Eliminados')

@section('content_header')
<h1>Productos Desactivados</h1>
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
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DESCRIPCIÓN</th>             
                    <th scope="col">PROVEEDOR</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">FECHA VENCIMIENTO</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <th>{{$producto->id}}</th>
                    <td>{{$producto->nombre}}</td>
                    <td>{{$producto->descripcion}}</td>
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
                    <td>{{$producto->precio}}</td>
                    <td>{{$producto->cantidad}}</td>          
                    <td>{{$producto->fecha_vencimiento}}</td>
                    
  
                    <td width="10px">
                        @can('productos.restablecer-estado')
                        <form action="{{ route('productos.restablecer-estado', $producto->id) }}" method="POST">
                            @csrf
                            @method('PUT')      
                            <input type="submit" value="Activar" class="btn btn-primary btn-sm mb-2">
                        </form>
                        
                        @endcan
                    </td>

                    <td width="5px">
                    </td>
  
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
