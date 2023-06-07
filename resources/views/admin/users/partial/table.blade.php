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
                <td width="10px">
                    <a href="{{ route('users.edit', $users) }}" class="btn btn-primary btn-sm mb-2">Editar</a>
                </td>
                <td width="10px">
                    <a href="{{ route('users.detalleMascotas', $users->id) }}" class="btn btn-primary btn-sm mb-2">Mascotas</a>
                </td>
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