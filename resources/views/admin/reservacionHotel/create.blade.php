@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Crear Nueva Reservación</h1>
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


@section('content')

<div class="card">
    <div class="card-body">
        <form id="formulario1" method="POST" action="{{route('reservacionHotel.ejecutarProcedimiento')}}">
            @csrf 
            <label>Seleccionar cliente:</label>
            <div class="form-group">
                <select class="form-control" name="usuario_id" id="usuario_id">
                    <option value="">Cliente</option>
                    @foreach ($users as $user )
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                @error('usuario_id')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            <label>Seleccionar mascota:</label>
            <div class="form-group">
                <select class="form-control" name="mascota_id" id="mascota_id">
                    <option value="">Mascota</option>
                    @foreach ($mascotas as $mascota )
                    <option value="{{$mascota->id}}">{{$mascota->nombre}}</option>
                    @endforeach
                </select>
                @error('mascota_id')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <!-- Resto del formulario -->
            
            <div class="form-group">
                <label>Fecha Ingreso</label>
                <input type="date" class="form-control" id="fechaIngreso" name='fechaIngreso' placeholder="Fecha de Ingreso"
                    value="2023-06-01">

                @error('fechaIngreso')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Fecha Salida</label>
                <input type="date" class="form-control" id="fechaSalida" name='fechaSalida' placeholder="Fecha de Salida"
                    value="2023-06-01">

                @error('fechaSalida')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>            

            <div class="form-group">
                <label>tratamientos</label>
                <input type="text" class="form-control" id="tratamientos" name='tratamientos' placeholder="tratamientos"
                    value="{{ old('tratamientos') ?? 1 }}">

                @error('tratamientos')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div> 
            <div class="form-group">
                <label>transporte</label>
                <input type="text" class="form-control" id="tranporte" name='tranporte' placeholder="transporte"
                    value="{{ old('tranporte') ?? 1 }}">

                @error('transporte')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div> 
            <div class="form-group">
                <label>comida</label>
                <input type="text" class="form-control" id="comida" name='comida' placeholder="comida de la mascota"
                    value="{{ old('comida') ?? 1 }}">

                @error('comida')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div> 
            <div class="form-group">
                <label>banioYCorte</label>
                <input type="text" class="form-control" id="banioYCorte" name='banioYCorte' placeholder="banioYCorte de la mascota"
                    value="{{ old('banioYCorte') ?? 1 }}">

                @error('banioYCorte')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div> 
            <div class="form-group">
                <label>tratamiento</label>
                <input type="text" class="form-control" id="tratamiento" name='tratamiento' placeholder="costo de tratamiento"
                    value="{{ old('tratamiento') ?? 1 }}">

                @error('tratamiento')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div> 
            <div class="form-group">
                <label>extras</label>
                <input type="text" class="form-control" id="extras" name='extras' placeholder="extras"
                    value="{{ old('extras') ?? 1 }}">

                @error('extras')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div> 
            <div class="form-group">
                <label>total</label>
                <input type="text" class="form-control" id="total" name='total' placeholder="total de la mascota"
                    value="{{ old('total') ?? 1 }}" readonly>

                @error('total')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>estado</label>
                <input type="hidden" class="form-control" id="estado" name='estado' placeholder="estado"
                    value="{{ old('estado') ?? 1}}">

                    @error('estado')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>

            <label>Seleccionar habitación:</label>
            <div class="form-group">
                <select class="form-control" name="habitacion_id" id="habitacion_id">
                    <option value="{{ old('habitacion_id') ?? 1}}">Habitación</option>
                    @foreach ($habitaciones as $habitacion)
                        <option value="{{ $habitacion->id }}">{{ $habitacion->nro_habitacion }}</option>
                    @endforeach
                </select>
                @error('reservacionHotel_id')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>

            <input type="submit" value="Registrar reservación" class="btn btn-primary">
        </form>
    </div>
</div>

@endsection

@section('js')
<script>
    // Código JavaScript para calcular el total en base a los valores ingresados
    $(document).ready(function() {
        $('#formulario1').on('change', function() {
            var tratamiento = parseFloat($('#tratamiento').val()) || 1;
            var extras = parseFloat($('#extras').val()) || 1;
            var total = tratamiento + extras;
            $('#total').val(total);
        });
    });
</script>
@endsection
