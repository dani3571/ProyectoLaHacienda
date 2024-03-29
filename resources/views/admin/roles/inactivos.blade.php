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
  
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rol</th>
                    @can('roles.restablecer-estado')
                    <th>Acciones</th>
                    @endcan
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role )
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>

                    @can('roles.restablecer-estado')
                    <td width="10px">
                        <form action="{{ route('roles.restablecer-estado', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')      
                            <input type="submit" value="Restablecer" class="btn btn-primary btn-sm mb-2">
                        </form>
                    </td>
                    @endcan

                
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