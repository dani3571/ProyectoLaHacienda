@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Reservaciones completadas - Peluqueria</h1>
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
    <!--<div class="card-header">
        <a class="btn btn-primary" href="{{route('reservas_peluqueria.index')}}">Volver</a>
    </div>-->
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha de atencion</th>
                    <th>Hora de atencion</th>
                    <th>Cliente</th>
                    <th>Mascota</th>
                    <th>Costo de atencion</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reservas_peluqueria as $reserva )
                <tr>
                    <td>{{date('d/m/Y', strtotime($reserva->fecha))}}</td>
                    <td>{{$reserva->horaRecepcion}}</td>
                    <td>
                        @foreach ($users as $user )
                            @if($user->id == $reserva->usuario_id) 
                                {{$user->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($mascotas as $mascota )
                            @if($mascota->id == $reserva->mascota_id) 
                                {{$mascota->nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if($reserva->costo > 0) 
                            {{$reserva->costo}}
                        @else
                            <button type="button" class="btn btn-primary CostoReserva" value="{{$reserva->id}}" > Registrar costo </button>
                        @endif
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="ModalCancelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('reservas_peluqueria.registrarCosto') }}" method="POST" name="formCosto">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Resgistrar Costo de atencion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Reserva_id" id="Reserva_id">
                    <label>¿se realizo la atencion?</label><br>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="">Si</label>
                        <input class="form-check-input ml-2" type="radio" id="yes" name='confirmacion' value="1" >
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="">No</label>
                        <input class="form-check-input ml-2" type="radio" name='confirmacion' value="0" >
                    </div>
                    <label id="LabelCosto" class="form-check-label">Ingrese cuanto dinero se cobro</label>
                    <input type="number" class="form-control" name="costo" id="costo" step=".01" value = 0 min = 0>
                    <label id="LabelMotivo" class="form-check-label">Motivo</label>
                    <input type="text" class="form-control" name="motivo" id="motivo" placeholder="Indique el motivo por el cual no se realizo la atencion">
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm confirm" id="BTNconfirm">Confirmar costo</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var rad = document.formCosto.confirmacion;
        var prev = null;
        var estado = 1;
        var costo = document.getElementById("costo");
        var LabelCosto = document.getElementById("LabelCosto");
        var motivo = document.getElementById("motivo");
        var LabelMotivo = document.getElementById("LabelMotivo");
        var BTNconfirm = document.getElementById("BTNconfirm");
        $(document).ready(function () {
            $('.CostoReserva').click(function (e) {
                e.preventDefault();
                var reserva_id = $(this).val();
                $('#Reserva_id').val(reserva_id);
                $('#ModalCancelar').modal('show');
                var BTNyes = document.getElementById("yes");
                BTNyes.checked = true;
                costo.style.display = "block";
                LabelCosto.style.display = "block";
                costo.removeAttribute('disabled');
                costo.value = 0;
                motivo.style.display = "none";
                LabelMotivo.style.display = "none";
                motivo.setAttribute('disabled', '');
                motivo.value = "";
                $('.confirm').addClass('btn-primary').removeClass('btn-danger');
                BTNconfirm.innerHTML = "Confirmar costo";
            });
        });

        
        
        for (var i = 0; i < rad.length; i++) {
            rad[i].addEventListener('change', function() {
                if (this !== prev) {
                    prev = this;
                    estado = this.value;
                }
                if(estado == 1){
                    console.log(costo);
                    costo.style.display = "block";
                    LabelCosto.style.display = "block";
                    costo.removeAttribute('disabled');
                    costo.value = 0;
                    motivo.style.display = "none";
                    LabelMotivo.style.display = "none";
                    motivo.setAttribute('disabled', '');
                    motivo.value = "";
                    $('.confirm').addClass('btn-primary').removeClass('btn-danger');
                    BTNconfirm.innerHTML = "Confirmar costo";
                }
                else{
                    costo.style.display = "none";
                    LabelCosto.style.display = "none";
                    costo.setAttribute('disabled', '');
                    motivo.style.display = "block";
                    LabelMotivo.style.display = "block";
                    motivo.removeAttribute('disabled');
                    motivo.value = "";
                    $('.confirm').addClass('btn-danger').removeClass('btn-primary');
                    BTNconfirm.innerHTML = "Cancelar";
                }
            });
        }
        
    </script>
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