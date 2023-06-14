@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Modificar Rol</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="name" name='name' placeholder="Nombre del rol"
                        value="{{ $role->name }}">

                    @error('name')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="permissionType">Tipo de Permiso:</label>
                    <select class="form-control"  id="filtro_permisos">
                        <option value="Todos">Todos</option>
                        <option value="usuarios">Permisos de Usuarios</option>
                        <option value="roles">Permisos de roles</option>
                        <option value="veterinaria">Permisos de Reservacion veterinaria</option>
                        <option value="peluqueria">Permisos de reservacion peluqueria</option>
                        <option value="hotel">Permisos de reservacion hoteleria</option>
                        <option value="habitacion">Permisos de habitaciones</option>
                        <option value="proveedores">Permisos de proveedores</option>
                        <option value="categorias">Permisos de categorias</option>
                        <option value="productos">Permisos de productos</option>
                        <option value="compras">Permisos de compras</option>
                        <option value="ventas">Permisos de ventas</option>
                        <option value="mascotas">Permisos de mascotas</option>
                        <option value="dashboard">General</option>
                    </select>
                </div>
                
          
                @foreach ($permissions as $permission)
                <div class="permiso" data-description="{{$permission->description}}">
                    <label>
                        <input type="checkbox" name="permissions[]" id="" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}} class="mr-1">
                        {{$permission->description}}
                    </label>
                </div>
                @endforeach
   


                <input type="submit" value="Editar rol" class="btn btn-primary">
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