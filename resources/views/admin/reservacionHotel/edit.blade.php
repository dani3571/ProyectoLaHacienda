@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Modificar Reservación</h1>
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
        <form method="POST" action="{{route('reservacionHotel.editProcedimiento')}}">
        @csrf 
                <div class="form-group">
                    <input type="hidden" name="reservacionHotel_id" value="{{ $reservacionHotel->id }}">
                </div> 
                <div class="form-group">
                <label>No id:</label>
                <p>{{ $reservacionHotel->id }}<p>
                <div class="form-group">
                <label>Seleccionar cliente:</label>
            <div class="form-group">
                <select class="form-control" name="usuario_id" id="usuario_id">
                    <option value="">Cliente</option> 
                    @foreach ($users as $user )
                            @if($user->id == $reservacionHotel->usuario_id) 
                            <option value="{{$user->id}}" selected>{{$user->name}}</option>
                            @endif
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
                            @if($mascota->id == $reservacionHotel->usuario_id) 
                            <option value="{{$mascota->id}}" selected>{{$mascota->nombre}}</option>
                            @endif
                    @endforeach
                </select>
                @error('mascota_id')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <!--<div class="form-group">
                <label>No</label>
                <input type="text" class="form-control" id="id" name='id' placeholder="id"
                value="{{ $reservacionHotel->id }}">

                    @error('id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> -->
            <div class="form-group">
                <label>Fecha Ingreso</label>
                <input type="date" class="form-control" id="fechaIngreso" name='fechaIngreso' placeholder="Fecha de Ingreso"
                value="{{ $reservacionHotel->fechaIngreso }}">

                @error('fechaIngreso')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Fecha Salida</label>
                <input type="date" class="form-control" id="fechaSalida" name='fechaSalida' placeholder="Fecha de Salida"
                value="{{ $reservacionHotel->fechaSalida }}">

                @error('fechaSalida')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>tratamientos</label>
                <input type="text" class="form-control" id="tratamientos" name='tratamientos' placeholder="tratamientos"
                value="{{ $reservacionHotel->tratamientos }}">

                    @error('tratamientos')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>tranporte</label>
                <input type="number" class="form-control" id="tranporte" name='tranporte' placeholder="tranporte"
                value="{{ $reservacionHotel->tranporte }}">

                    @error('tranporte')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>comida</label>
                <input type="number" class="form-control" id="comida" name='comida' placeholder="comida de la mascota"
                value="{{ $reservacionHotel->comida }}">

                    @error('comida')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>banioYCorte</label>
                <input type="number" class="form-control" id="banioYCorte" name='banioYCorte' placeholder="banioYCorte de la mascota"
                value="{{ $reservacionHotel->banioYCorte }}">

                    @error('banioYCorte')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>tratamiento</label>
                <input type="number" class="form-control" id="tratamiento" name='tratamiento' placeholder="costo de tratamiento"
                value="{{ $reservacionHotel->tratamiento }}">

                    @error('tratamiento')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>extras</label>
                <input type="number" class="form-control" id="extras" name='extras' placeholder="extras"
                value="{{ $reservacionHotel->extras }}">

                    @error('extras')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>total</label>
                <input type="number" class="form-control" id="total" name='total' placeholder="total de la mascota"
                value="{{ $reservacionHotel->total }}" readonly>

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
                    @foreach ($habitacions as $habitacion )
                            @if($habitacion->id == $reservacionHotel->usuario_id) 
                            <option value="{{$habitacion->id}}" selected>{{$habitacion->nro_habitacion}}</option>
                            @endif
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
<script src="{{ asset('js/sumartotalesreservacion.js') }}"></script>
@endsection