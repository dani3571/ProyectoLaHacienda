@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Reservaciones Completadas - Hotel de mascotas</h1>
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
<style>
    /*Estilo de buscador*/
.filtro {
    display: none;
}
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        <!--BUSCADOR CON JS-->
                        <span id="card_title">
                                {{ __('Buscar reservación por usuario o cliente:') }}
                            </span>
                        <input type="text" name="buscador" id="buscador" placeholder="Buscar por nombre de cliente...">
                        <span id="card_title">
                                {{ __('Fecha Ingreso:') }}
                            </span>
                        <input type="date" name="buscadorDate" id="buscadorDate">
                        <span id="card_title">
                                {{ __('Salida:') }}
                            </span>
                        <input type="date" name="buscadorDateSalida" id="buscadorDateSalida">
                        <button type="button" id="cancelarBusqueda" class="btn btn-secondary btn-sm">x</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No de Registro</th>
                                        <th>Nombre Cliente</th>
                                        <th>Nombre Mascota</th>
                                        <th>Nro Habitación</th>
										<th>Fecha ingreso</th>
										<th>Fecha salida</th>
                                        <th>Hora entrega</th>
                                        <th>Servicio Tratamientos veterinarios</th>
										<th>Servicio de corte y baño</th>
										<th>Observaciones para reservación</th>
										<th>Zona recojo</th>
										<th>Dirección de recojo</th>
										<th>Costo transporte</th>
										<th>Costo comida</th>
                                        <th>Costo veterinaria</th>
                                        <th>Costo corte/baño</th>
                                        <th>Costos extras</th>
                                        <th>Costo Total</th>
                                        <th>Hora CheckIn</th>
                                        <th>Hora CheckOut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservacionHotel as $reservacionHotel)

                                        <tr class="reserva" id="{{ $reservacionHotel->fechaIngreso }}@foreach ($users as $user )
                                                @if($user->id == $reservacionHotel->usuario_id) 
                                                    {{$user->name}}
                                                @endif
                                            @endforeach
                                            @foreach ($mascotas as $mascota )
                                                @if($mascota->id == $reservacionHotel->mascota_id) 
                                                    {{$mascota->nombre}}
                                                @endif
                                            @endforeach">
                                        <span class="reserva1" id="{{ $reservacionHotel->fechaSalida }}">
                                            <td>{{ $reservacionHotel->id }}</td>
                                            <td>
                                            @foreach ($users as $user )
                                                @if($user->id == $reservacionHotel->usuario_id) 
                                                    {{$user->name}}
                                                @endif
                                            @endforeach
                                            </td>
                                            <td>
                                            @foreach ($mascotas as $mascota )
                                                @if($mascota->id == $reservacionHotel->mascota_id) 
                                                    {{$mascota->nombre}}
                                                @endif
                                            @endforeach
                                            </td>
                                            <td>
                                            @foreach ($habitaciones as $habitacion )
                                                @if($habitacion->id == $reservacionHotel->habitacion_id) 
                                                    {{$habitacion->nro_habitacion}}
                                                @endif
                                            @endforeach
                                            </td>
											<td>{{ $reservacionHotel->fechaIngreso }}</td>
											<td>{{ $reservacionHotel->fechaSalida }}</td>
											<td>{{ $reservacionHotel-> horaRecepcion}}</td>
                                            <td>@if($reservacionHotel-> tratamiento_veterinaria == '1') Si @else No @endif</td>
                                            <td>@if($reservacionHotel-> tratamiento_corte_banio == '1') Si @else No @endif</td>
                                            <td>{{ $reservacionHotel-> observaciones}}</td>
                                            <td>@if($reservacionHotel-> zona_direccion == null) No transporte @else {{ $reservacionHotel->zona_direccion }} @endif</td>
                                            <td>@if($reservacionHotel-> direccion == null) No transporte @else {{ $reservacionHotel->direccion }} @endif</td>
                                            <td>{{ $reservacionHotel-> costo_transporte}}</td>
                                            <td>{{ $reservacionHotel-> costo_comida}}</td>
                                            <td>{{ $reservacionHotel-> costo_veterinaria}}</td>
                                            <td>{{ $reservacionHotel-> costo_corte_banio}}</td>
                                            <td>{{ $reservacionHotel-> costo_extras}}</td>
											<td>{{ $reservacionHotel->costo_total }}</td>
                                            <td>{{ $reservacionHotel-> horaCheckin}}</td>
                                            <td>{{ $reservacionHotel-> horaCheckout}}</td>
                                        </td>
                                        </span>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection
@section('js')
<script src="{{ asset('js/buscadorReservas.js') }}"></script>
<script src="{{ asset('js/hoteleriaCancelar.js') }}"></script>
@endsection