@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Lista de usuarios</h1>
@endsection

@section('content')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Éxito',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        </script>
    @endif
    @if (session('fail'))
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
                <input type="text" name="buscadorUsuario" id="buscadorUsuario" placeholder="Buscar por nombre..."
                    oninput="buscarUsuarios()">
            </div>
        </div>
        <div class="card-body">
            <div id="tablaUsuarios">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">CI</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Email</th>
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
                                <td width="10px"><a href="{{ route('users.edit', $user) }}"
                                        class="btn btn-primary btn-sm mb-2">Editar</a></td>
                                <td width="10px"><a href="{{ route('users.detalleMascotas', $users->id) }}"
                                        class="btn btn-primary btn-sm mb-2">Mascotas</a></td>
                                <td width="10px">
                                    <form action="{{ route('users.cambiar-estado', $users) }}" method="POST">
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
            <div class="text-center mt-3">
                {{ $user->links() }}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /*
                    document.addEventListener('DOMContentLoaded', function() {
                        const buscadorUsuario = document.getElementById('buscadorUsuario');
                        const reservas = document.getElementsByClassName('reserva');

                        buscadorUsuario.addEventListener('input', function() {
                            const query = buscadorUsuario.value.toLowerCase();

                            for (let i = 0; i < reservas.length; i++) {
                                const nombreUsuario = reservas[i].getElementsByTagName('td')[0].textContent
                                    .toLowerCase();

                                if (nombreUsuario.includes(query)) {
                                    reservas[i].style.display = '';
                                } else {
                                    reservas[i].style.display = 'none';
                                }
                            }
                        });
                    });
                    */
        function buscarUsuarios() {
            const buscadorUsuario = document.getElementById('buscadorUsuario');
            const tablaUsuarios = document.getElementById('tablaUsuarios');

            const query = buscadorUsuario.value.toLowerCase();

            // Realizar la solicitud AJAX al servidor
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '/admin/users/buscar-usuarios?query=' + query);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Actualizar la tabla de usuarios con los resultados obtenidos
                    tablaUsuarios.innerHTML = xhr.responseText;
                } else {
                    // Manejar errores si es necesario
                }
            };
            xhr.send();
        }
    </script>

@endsection

@section('scripts')

@endsection
