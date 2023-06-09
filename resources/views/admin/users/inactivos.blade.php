@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Lista de usuarios</h1>
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
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <input type="text" name="buscadorUsuario" id="buscadorUsuario" placeholder="Buscar por nombre...">
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">CI</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Email</th>
                        <th scope="col">persona de referencia</th>
                        <th scope="col">telefono de referencia</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($user as $users)
                        <tr class="reserva">
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->ci }}</td>
                            <td>{{ $users->telefono }}</td>
                            <td>{{ $users->direccion }}</td>
                            <td>{{ $users->email }}</td>
                            <td>{{ $users->personaResponsable }}</td>
                            <td>{{ $users->telefonoResponsable }}</td>
                            <td>
                                @foreach ($users->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </td>
                            <td width="10px">
                        <form action="{{ route('users.restablecer-estado', $users->id) }}" method="POST">
                            @csrf
                            @method('PUT')      
                            <input type="submit" value="Restablecer" class="btn btn-primary btn-sm mb-2">
                        </form>
                    </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center mt-3">
                {{ $user->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buscadorUsuario = document.getElementById('buscadorUsuario');
            const reservas = document.getElementsByClassName('reserva');

            buscadorUsuario.addEventListener('input', function() {
                const query = buscadorUsuario.value.toLowerCase();

                for (let i = 0; i < reservas.length; i++) {
                    const nombreUsuario = reservas[i].getElementsByTagName('td')[0].textContent.toLowerCase();

                    if (nombreUsuario.includes(query)) {
                        reservas[i].style.display = '';
                    } else {
                        reservas[i].style.display = 'none';
                    }
                }
            });
        });
    </script>
@endsection

@section('scripts')
    
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