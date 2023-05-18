@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar nueva habitación</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('habitacion.store')}}">
            @csrf 
            <!--<div class="form-group">
                <label>No</label>
                <input type="text" class="form-control" id="id" name='id' placeholder="id"
                    value="{{ old('id') }}">

                    @error('id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> -->
            
            <div class="form-group">
                <label>nro_habitacion</label>
                <input type="number" class="form-control" id="nro_habitacion" name='nro_habitacion' placeholder="nro_habitacion"
                    value="{{ old('nro_habitacion') }}">

                    @error('nro_habitacion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>costo_habitacion</label>
                <input type="number" class="form-control" id="costo_habitacion" name='costo_habitacion' placeholder="costo_habitacion"
                    value="{{ old('costo_habitacion') }}">

                    @error('costo_habitacion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>capacidad</label>
                <input type="number" class="form-control" id="capacidad" name='capacidad' placeholder="capacidad"
                    value="{{ old('capacidad') }}">

                    @error('capacidad')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
                <label>reservacionHotel_id </label>
                <div class="form-group">
                    <select class="form-control" name="reservacionHotel_id" id="reservacionHotel_id">
                        <option value="">Seleccione el tipo</option>
                   
                            <option value="1">1</option>
                            <option value="2">2</option>
            
                    </select>
                    @error('reservacionHotel_id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <input type="submit" value="Registrar habitación" class="btn btn-primary">
     </form>
    </div>
</div>
@endsection
