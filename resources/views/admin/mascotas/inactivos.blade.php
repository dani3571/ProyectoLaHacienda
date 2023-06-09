@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Administra a tus mascotas</h1>
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
                    <th>Peso</th>
                    <th>Tamaño</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($mascotas as $mascota)
                <tr>
                
                    <td>{{$mascota->id}}</td>
                    <td>{{$mascota->nombre}}</td>
                    <td>{{$mascota->tipo}}</td>
                    <td>{{$mascota->raza}}</td>
                    <td>{{$mascota->color}}</td>
                    <td>{{$mascota->fechaNacimiento}}</td>
                    <td>{{$mascota->caracter}}</td>
                    <td>{{$mascota->sexo}}</td>
                    <td>{{$mascota->peso}}</td>
                    <td>{{$mascota->tamaño}}</td>
  
                    <td width="10px">
                        <form action="{{ route('mascotas.restablecer-estado', $mascota->id) }}" method="POST">
                            @csrf
                            @method('PUT')      
                            <input type="submit" value="Restablecer" class="btn btn-primary btn-sm mb-2">
                        </form>
                    </td>

                    <td width="5px">
                        <form action="{{route('mascotas.destroy', $mascota->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                        </form>
                    </td>
  
                </tr>
                
                @endforeach
            </tbody>
        </table>
        <div class="text-center mt-3">
            {{ $mascotas->links() }}
        </div>
    </div>
</div>
@endsection
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/logo.png') }}">
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
