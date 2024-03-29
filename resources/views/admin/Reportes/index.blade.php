@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Generar Reporte</h1>
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
        html: 'No existen registros de <strong>{{ session('tipo') }}</strong> entre las fechas <strong>{{ session('fechaInicio') }}</strong> y <strong>{{ session('fechaFin') }}</strong>',
        icon: 'error'
    });
</script>
@endif

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('generar.reporte')}}">
            @csrf 

            <div class="form-group">
                <label>Reporte</label>
                <select class="form-control" name="tipo" id="tipo">
                    <option value="">Seleccione el reporte</option>
                    <option value="users">Usuarios</option>
                    <option value="mascotas">Mascotas</option>
                    <option value="roles">Roles</option>
                    <option value="productos">Productos</option>
                    <option value="ventas">Ventas</option>
                    <option value="compras">Compras</option>
                    <option value="proveedores">Proveedores</option>
                    <option value="reservacion_peluquerias">Reservas Peluqueria</option>
                    <option value="reservacion_veterinarias">Reservas Veterinaria</option>
                    <option value="reservacion_hotels">Reservas del Hotel</option>
                    <option value="habitacions">Habitaciones</option>
                </select>
            </div>

            <div class="form-group">
                <fieldset>
                    <legend>Filtrado por fechas</legend>

                    <div class="form-group">
                        <label>Fecha Inicio</label>
                        <input type="date" class="form-control" id="fechaInicio" name='fechaInicio' placeholder="Fecha de Inicio"
                        max="{{ (new DateTime())-> format('Y-m-d') }}" value="{{ old('fechaInicio') }}">
                        @error('fechaInicio')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Fecha Fin</label>
                        <input type="date" class="form-control" id="fechaFin" name='fechaFin' placeholder="Fecha Fin"
                        max="{{ (new DateTime())-> format('Y-m-d') }}"  value="{{ old('fechaFin') }}">
                        @error('fechaFin')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                        @enderror
                    </div>
                </fieldset>
            </div>

            <input type="submit" value="Generar reporte" class="btn btn-primary">
        </form>
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
