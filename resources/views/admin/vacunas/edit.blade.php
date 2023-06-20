@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Modificar vacuna</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('vacunas.update', $vacuna->id) }}">
        @csrf 
            @method('PUT')
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $vacuna->id }}">
            </div> 

            <div class="form-group">
                <label>Mascota</label>
                <select class="form-control" id="mascota_id" name='mascota_id'>
                    <option value="">Seleccione la mascota</option>
                    @foreach ($mascotas as $mascota)
                        <option value="{{$mascota->id}}" @if($vacuna->mascota_id == $mascota->id) selected @endif>{{$mascota->nombre}}</option>
                    @endforeach
                </select>
                    @error('mascota')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>

            <div class="form-group">
    <label>Mascota</label>
    @foreach ($mascotas as $mascota)
    @if ($vacuna->mascota_id == $mascota->id)
        <input type="text" class="form-control" id="mascota_id" name="mascota_id" value="{{ $mascota->nombre }}" readonly>
        <input type="hidden" name="mascota_id" value="{{ $vacuna->mascota_id }}">
    @endif
    @error('mascota_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    @endforeach
</div>


            <div class="form-group">
                <label>Nombre de la vacuna</label>
                <input type="text" class="form-control" id="nombre_vacuna" name='nombre_vacuna' placeholder="Ingrese el nombre de la vacuna"
                value="{{ $vacuna->nombre_vacuna }}">

                @error('nombre_vacuna')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div> 

            <div class="form-group">
                <label>Fecha de la vacuna</label>
                <input type="date" class="form-control" id="fecha_vacuna" name='fecha_vacuna' placeholder="Seleccione la fecha de la vacuna"
                value="{{ $vacuna->fecha_vacuna }}">

                @error('fecha_vacuna')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div> 
            <input type="submit" value="Guardar cambios" class="btn btn-primary">
            <a class="btn btn-danger" href="{{ route('vacunas.index') }}">Volver</a>
        </form>
    </div>
</div>
@endsection
