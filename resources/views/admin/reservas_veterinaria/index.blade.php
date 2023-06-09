@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Reservaciones Activas - Veterinaria</h1>
@endsection

@section('content')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Éxito',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        </script>
    @endif
    @if (session('fail'))
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
        <!--<div class="card-header">
            <a class="btn btn-primary" href="{{ route('reservas_veterinaria.create') }}">Registrar Reservación</a>
            <a class="btn btn-success" href="{{ route('reservas_veterinaria.completadas') }}">Reservaciones Completadas</a>
            <a class="btn btn-secondary" href="{{ route('reservas_veterinaria.canceladas') }}">Reservaciones Canceladas</a>
        </div>-->
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Fecha</th>
                        <th>Hora Recepcion</th>
                        <th>Motivo Reservación</th>
                        <th>Usuario</th>
                        <th>Mascota</th>
                        <!--<th>created_at</th>
                        <th>updated_at</th>-->
                    </tr>
                </thead>

                <tbody>
                    @foreach ($reservas_veterinaria as $reserva)
                        <tr>

                            <td>{{ $reserva->id }}</td>
                            <td>{{ date('d/m/Y', strtotime($reserva->fecha)) }}</td>
                            <td>{{ $reserva->horaRecepcion }}</td>
                            <td>{{ $reserva->motivoReservacion }}</td>
                            <!--<td>{{ $reserva->usuario_id }}</td>-->
                            <td>
                                @foreach ($users as $user)
                                    @if ($user->id == $reserva->usuario_id)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </td>
                            <!--<td>{{ $reserva->mascota_id }}</td>-->
                            <td>
                                @foreach ($mascotas as $mascota)
                                    @if ($mascota->id == $reserva->mascota_id)
                                        {{ $mascota->nombre }}
                                    @endif
                                @endforeach
                            </td>
                            @can('reservas_veterinaria.edit')
                                <td width="10px"><a href="{{ route('reservas_veterinaria.edit', $reserva) }}"
                                        class="btn btn-primary">Modificar</a></td>
                            @endcan

                            
                            <!--<td width="10px">
                           
                            <form action="{{ route('reservas_veterinaria.cancelar', $reserva->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="submit" value="Cancelar" class="btn btn-danger btn-sm">
                            </form>

                        </td>-->
                            <!--<td >
                            <button type="button" class="btn btn-danger cancelarReserva" value="{{ $reserva->id }}" > Cancelar </button>
                        </td>-->
                        @can('reservas_veterinaria.cancelar')
                            <td width="10px">
                                <button class="btn btn-danger btn-sm cancelarReserva"
                                    value="{{ $reserva->id }}">Cancelar</button>
                            </td>
                            
                        @endcan

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="ModalCancelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('reservas_veterinaria.cancelar') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Cancelar Reserva</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="Reserva_id" id="Reserva_id">
                        ¿Seguro que quiere cancelar su reserva?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-sm">Sí, cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.cancelarReserva').click(function(e) {
                e.preventDefault();
                var reserva_id = $(this).val();
                $('#Reserva_id').val(reserva_id);
                $('#ModalCancelar').modal('show');
            });
        });
    </script>

@endsection
