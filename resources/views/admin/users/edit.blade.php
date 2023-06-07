@extends('adminlte::page')

@section('title', 'Panel de administracion')
@section('content_header')
<h1>Establecer roles</h1>
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
        <p>Nombre completo:</p>
        <p class="form-control">{{$user->name}}</p>

        <h5>Roles</h5>
        <form action="{{route('users.update', $user->id)}}" method="POST">
          @csrf
          @method('PUT')
          @foreach ($roles as $role )
            <div>
                <label>
                    <!--Despues del value hacemos un condicional ternario que si tiene ya un rol asignado que el radio este checked si no nada-->
                    <input type="radio" name="role" id="role" value="{{$role->id}}" {{$user->roles->contains($role->id) ? 'checked': ''}} class="mr-1 mb-3">
                      {{$role->name}}
                </label>
            </div>
          @endforeach
            
            <input type="submit" value="Establecer rol" class="btn btn-primary">
        </form>
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