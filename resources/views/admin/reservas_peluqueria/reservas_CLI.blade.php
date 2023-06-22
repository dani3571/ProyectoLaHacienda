@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Mis Reservas</h1>
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
    <div class="card-header">
        <h3>RESERVAS ACTIVAS</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha de atencion</th>
                    <th>Mascota</th>
                    <th>Hora Recepcion</th>
                    <th>Hora Entrega (estimada)</th>
                    <th>corte de pelo</th>
                    <th>Baño simple</th>
                    <th>tranquilizante</th>
                    <th>observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reservas_activas as $reserva )
                <tr>
                    <td>{{date('d/m/Y', strtotime($reserva->fecha))}}</td>
                    <td>
                        @foreach ($mascotas as $mascota )
                            @if($mascota->id == $reserva->mascota_id) 
                                {{$mascota->nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$reserva->horaRecepcion}}</td>
                    <td>{{$reserva->horaEntrega}}</td>
                    <td>@if($reserva->corte == '1') Si @else No @endif</td>
                    <td>@if($reserva->BanoSimple == '1') Si @else No @endif</td>
                    <td>@if($reserva->tranquilizante == '1') Si @else No @endif</td>
                    <td>{{$reserva->Observaciones}}</td>

                    <td width="10px"><a href="{{route('reservas_peluqueria.edit', [$reserva, 'a'=>'asd'])}}" class="btn btn-primary">Modificar</a></td>
                    <td><button type="button" class="btn btn-danger cancelarReserva" value="{{$reserva->id}}" > Cancelar </button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center mt-3">
            {{ $reservas_activas->links() }}
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>RESERVAS COMPLETADAS</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha de atencion</th>
                    <th>Hora de atencion</th>
                    <th>Mascota</th>
                    <th>Costo de atencion</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reservas_completadas as $reserva )
                <tr>
                    <td>{{date('d/m/Y', strtotime($reserva->fecha))}}</td>
                    <td>{{$reserva->horaRecepcion}}</td>
                    <td>
                        @foreach ($mascotas as $mascota )
                            @if($mascota->id == $reserva->mascota_id) 
                                {{$mascota->nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if($reserva->costo > 0) 
                            {{$reserva->costo}} Bs
                        @else
                            <b class="text-danger">Sin registrar</b>
                        @endif
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center mt-3">
            {{ $reservas_completadas->links() }}
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>RESERVAS CANCELADAS</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha de atencion</th>
                    <th>Hora de atencion</th>
                    <th>Mascota</th>
                    <th>motivo</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reservas_canceladas as $reserva )
                <tr>
                    <td>{{date('d/m/Y', strtotime($reserva->fecha))}}</td>
                    <td>{{$reserva->horaRecepcion}}</td>
                    <td>
                        @foreach ($mascotas as $mascota )
                            @if($mascota->id == $reserva->mascota_id) 
                                {{$mascota->nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$reserva->motivoCancelacion}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center mt-3">
            {{ $reservas_canceladas->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="ModalCancelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('reservas_peluqueria.cancelar') }}" method="POST">
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
                    <br><label id="LabelMotivo" class="form-check-label">Motivo</label>
                    <input type="text" class="form-control" name="motivo" id="motivo" placeholder="Indique el motivo por el cancela la reservacion">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-sm">Si. cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/cancelar_reserva_peluqueria.js') }}"></script>
@endsection
@section('css')
    <style>
        .nav-item {
            background: dark;
        }

        .menu-open {
            background-color: #4d5059 !important;
        }
    </style>
@endsection