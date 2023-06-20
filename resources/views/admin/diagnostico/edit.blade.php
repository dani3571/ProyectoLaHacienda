@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar nuevo diagnóstico</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('diagnostico.update', $diagnostico->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Mascota</label>
                <select class="form-control" id="mascota_id" name='mascota_id'>
                    <option value="">Seleccione la mascota</option>
                    @foreach ($mascotas as $mascota)
                        <option value="{{$mascota->id}}" @if($diagnostico->mascota_id == $mascota->id) selected @endif>{{$mascota->nombre}}</option>
                    @endforeach
                </select>
                    @error('mascota')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>Descripción del diagnóstico</label>
                <textarea class="form-control" id="descripcion" name="descripcion"
                    placeholder="Ingrese la descripción del diagnóstico">{{ $diagnostico-> descripcion ?? old('descripcion') }}</textarea>

                @error('descripcion')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Fecha del diagnóstico</label>
                <input type="date" class="form-control" id="fecha" name='fecha'
                    placeholder="Seleccione la fecha del diagnóstico" value="{{ $diagnostico-> fecha ?? old('fecha') }}">

                @error('fecha')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Fecha esperada para el siguiente diagnóstico</label>
                <input type="date" class="form-control" id="fechaVolver" name='fechaVolver'
                    placeholder="Seleccione la fecha esperada" value="{{ $diagnostico-> fechaVolver ?? old('fechaVolver') }}">

                @error('fechaVolver')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label>Costo de diagnóstico</label>
                <input type="number" class="form-control" id="costo" name='costo'
                    placeholder="Ingrese el costo de diagnóstico" value="{{ $diagnostico-> costo ?? old('costo') }}">

                @error('costo')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <input type="submit" value="Guardar cambios" class="btn btn-primary">
            <a class="btn btn-danger" href="{{ route('diagnostico.index') }}">Volver</a>
        </form>
    </div>
</div>
@endsection

@section('js')
@endsection
