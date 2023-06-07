@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Administra los roles</h1>
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
        <a class="btn btn-primary" href="{{route('roles.index')}}">Roles registrados</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role )
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>

                 
                    <td width="10px">
                        <form action="{{ route('roles.restablecer-estado', $role->id) }}" method="POST">
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
            {{ $roles->links() }}
        </div>
    </div>
</div>
@endsection
