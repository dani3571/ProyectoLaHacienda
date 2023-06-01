@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Reservaciones Activas - Hotel de mascotas</h1>
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
                        <input type="text" name="buscador" id="buscador" placeholder="Buscar...">
                        <input type="date" name="buscadorDate" id="buscadorDate">
                        <input type="date" name="buscadorDateSalida" id="buscadorDateSalida">
                            <span id="card_title">
                                {{ __('Reservacion Hotel') }}
                            </span>

                             <div class="float-right">
                             <a class="btn btn-primary" href="{{route('reservacionHotel.create')}}">Agregar reservación</a>
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Fechaingreso</th>
										<th>Fechasalida</th>
										<th>Tratamientos</th>
										<th>Tranporte</th>
										<th>Comida</th>
										<th>Banioycorte</th>
										<th>Tratamiento</th>
										<th>Extras</th>
										<th>Total</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservacionHotel as $reservacionHotel)

                                        <tr class="reserva" id="{{ $reservacionHotel->fechaIngreso }}">
                                        <span class="reserva1" id="{{ $reservacionHotel->fechaSalida }}">
                                            <td>{{ $reservacionHotel->id }}</td>
                                            
											<td>{{ $reservacionHotel->fechaIngreso }}</td>
											<td>{{ $reservacionHotel->fechaSalida }}</td>
											<td>{{ $reservacionHotel->tratamientos }}</td>
											<td>{{ $reservacionHotel->tranporte }}</td>
											<td>{{ $reservacionHotel->comida }}</td>
											<td>{{ $reservacionHotel->banioYCorte }}</td>
											<td>{{ $reservacionHotel->tratamiento }}</td>
											<td>{{ $reservacionHotel->extras }}</td>
											<td>{{ $reservacionHotel->total }}</td>

                                            <td width="10px"><a href="{{route('reservacionHotel.edit', $reservacionHotel)}}" class="btn btn-primary btn-sm mb-2">Modificar</a></td>
                                            <td width="10px"><a href="{{route('reservacionHotel.show', $reservacionHotel)}}" class="btn btn-secondary btn-sm mb-2">Detalles</a></td>
                                            <td width="10px">

                                            <td width="5px">
                                                <form action="{{route('reservacionHotel.destroy', $reservacionHotel->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Cancelar" class="btn btn-danger btn-sm">
                                                </form>
                                            </td>

                                            <!--<form action="{{ route('mascotas.cambiar-estado', $reservacionHotel->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')      
                                                <input type="submit" value="Cambiar Estado" class="btn btn-danger btn-sm">
                                            </form>-->
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
@endsection