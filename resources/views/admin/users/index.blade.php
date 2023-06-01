@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Lista de usuarios</h1>
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
                            <td width="10px"><a href="{{ route('users.edit', $users) }}"
                                    class="btn btn-primary btn-sm mb-2">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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