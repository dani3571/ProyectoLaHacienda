@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Crear Nuevo Rol</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('roles.store')}}">
            @csrf 
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" id="name" name='name' placeholder="Nombre del rol"
                    value="{{ old('name') }}">

                    @error('name')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                        @enderror

            </div>

            <div class="form-group">
                <label for="permissionType">Tipo de Permiso:</label>
                <select class="form-control"  id="filtro_permisos">
                    <option value="">Todos</option>
                    <option value="usuarios">Permisos de usuariosUsuarios</option>
                    <option value="roles">Permisos de roles</option>
                    <option value="veterinaria">Permisos de Reservacion veterinaria</option>
                    <option value="peluqueria">Permisos de reservacion peluqueria</option>
                    <option value="hotel">Permisos de reservacion hoteleria</option>
                    <option value="habitacion">Permisos de habitaciones</option>
                    <option value="proveedores">Permisos de proveedores</option>
                    <option value="categorias">Permisos de categorias</option>
                    <option value="productos">Permisos de productos</option>
                    <option value="compras">Permisos de compras</option>
                    <option value="dashboard">General</option>
                </select>
            </div>

            <h3>Lista de permisos</h3>            
            @foreach ($permissions as $permission )
            <div class="permiso" data-description="{{$permission->description}}">
                <label>      
                    <!--Colocamos permissions[] porque tenemos varios-->
                    <input type="checkbox" name="permissions[]" id="" value="{{$permission->id}}" class="mr-1">
                    <!--Mostramos la descripcion de los permisos--> 
                    {{$permission->description}}
                </label>
            </div>
            @endforeach
            <input type="submit" value="Crear rol" class="btn btn-primary">
        </form>
    </div>
</div>



<script>
    var filtroSelect = document.getElementById("filtro_permisos");
    var permisos = document.getElementsByClassName("permiso");

    // Escuchar el evento change en el select
    filtroSelect.addEventListener("change", function() {
        var filtro = filtroSelect.value.toLowerCase();

        // Recorrer los permisos y mostrar/ocultar según el filtro
        for (var i = 0; i < permisos.length; i++) {
            var permisoDescripcion = permisos[i].getAttribute("data-description").toLowerCase();
            if (filtro === "" || permisoDescripcion.includes(filtro)) {
                permisos[i].style.display = "block";
            } else {
                permisos[i].style.display = "none";
            }
        }
    });
</script>
@endsection
