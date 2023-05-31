@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Lista de usuarios</h1>
@endsection

@section('scripts')
<script>
document.addEventListener("keyup", e => {

if (e.target.matches("#buscadorUsuario")) {

    if (e.key === "Escape") e.target.value = ""

    document.querySelectorAll(".reserva").forEach(fruta => {

        fruta.id.toLowerCase().includes(e.target.value.toLowerCase())
            ? fruta.classList.remove("filtro")
            : fruta.classList.add("filtro")
    })
}
});
</script>
@endsection
@section('content')
@if (session('success-delete'))
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif
<div class="card">
<div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        <!--BUSCADOR CON JS-->
                        <input type="text" name="buscadorUsuario" id="buscadorUsuario" placeholder="Buscar por nombre...">
                        </div>
                    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                  <!--  <th scope="col">ID</th>-->
                    <th scope="col">Nombre completo</th>
                    <th scope="col">CI</th>
                    <th scope="col">Telefono</th>             
                    <th scope="col">Direccion</th>
                    <th scope="col">Email</th>
                    <th scope="col">persona de referencia</th>
                    <th scope="col">telefono de referencia</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($user as $users )
                <tr>
              <!--      <th>{{$users->id}}</th>-->  
                    <td>{{$users->name}}</td>
                    <td>{{$users->ci}}</td>
                    <td>{{$users->telefono}}</td>          
                    <td>{{$users->direccion}}</td>
                    <td>{{$users->email}}</td>          
                    <td>{{$users->personaResponsable}}</td>
                    <td>{{$users->telefonoResponsable}}</td>
          


                
                    <td width="10px"><a href="{{route('users.edit', $users)}}"
                            class="btn btn-primary btn-sm mb-2">Editar</a>
                    </td>

                    <!--
                    <td width="10px">
                        <form action="{{route('users.destroy', $users)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                -->
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center mt-3">
        
        </div>

    </div>
</div>
@endsection



