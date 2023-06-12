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
                @foreach ($mascotas as $mascota )
                <tr>
                   <td>{{$mascota->nombre}}</td>
                    <td>{{$mascota->tipo}}</td>
                    <td>{{$mascota->raza}}</td>
                    <td>{{$mascota->color}}</td>
                    <td>{{$mascota->fechaNacimiento}}</td>
                    <td>{{Str::limit($mascota->caracter, 4, '...')}}</td>
                    <td>{{$mascota->sexo}}</td>
                    <td>{{$mascota->peso}}</td>
                    <td>{{$mascota->tamaño}}</td>
           
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
        <div class="text-center mt-3">
            {{ $mascotas->links() }}
        </div>
    </div>
</div>
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


@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Ocultar el menú Veterinaria si no tiene submenús
        var submenuVeterinaria = $('#menuVeterinaria .treeview-menu');
        if (submenuVeterinaria.children().length === 0) {
            $('#menuVeterinaria').hide();
        }
    });
</script>
@endsection