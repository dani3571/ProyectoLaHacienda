@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Modificar Reservación - Hotel para mascotas</h1>
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
#datepicker {
  padding: 8px;
  font-size: 16px;
  cursor: pointer;
}

.date-input-wrapper {
  position: relative;
  display: inline-block;
}

.date-input-wrapper .input-icon {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  color: #999;
  cursor: pointer;
}

.date-input-wrapper .input-icon i {
  pointer-events: none;
}
</style>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-q2L6SWQ45vP/bfeF6y9zNc8Eu2o4zPNgc70pMOzAvzVlsfj2uEzgY/4b4SPS1cz9XNARgZ6GEGOer0Djn6Et2w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('reservacionHotel.editProcedimiento')}}">
        @csrf 
                <div class="form-group">
                    <input type="hidden" name="reservacionHotel_id" value="{{ $reservacionHotel->id }}">
                </div> 
                <div class="form-group">
                <label>Reservación No: {{ $reservacionHotel->id }}</label>
                <div class="form-group">
                
                @foreach ($users as $user )
                            @if($user->id == $reservacionHotel->usuario_id) 
                            <label>Cliente Id°{{$user->id}}:</label>
                            @endif
                @endforeach
                <script>
                </script>
            <div class="form-group">
                <select class="form-control" name="usuario_id" id="usuario_id" readonly>
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
                <select class="form-control" name="mascota_id" id="mascota_id" readonly>
                    <option value="">Mascota</option>
                    @foreach ($mascotas as $mascota )
                            @if($mascota->id == $reservacionHotel->mascota_id) 
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

            <!--<div class="form-group">-->

                <div class="form-group">
                <label>Seleccionar habitación</label>
                <input type="hidden" id="habitacion_id" name='habitacion_id' value="{{ $reservacionHotel->habitacion_id }}">
                <select class="form-control" id="habitacion_id_nuevo" name='habitacion_id_nuevo'>
                <option value="">Seleccione la habitacion</option>

                </select>
                    @error('habitacion_id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror

                    <b><i>Costo de habitación:</i></b>
                    <br>
                    <input type="text" class="form-control" id="costo_habitacion" name='costo_habitacion' placeholder="Costo de habitación"
                    value="{{ old('costo_habitacion') ?? 0 }}" readonly>
            </div>
            <div class="form-group">
                <label>Fecha Ingreso</label>
                <input type="date" class="form-control" id="fechaIngreso" name='fechaIngreso' placeholder="Fecha de Ingreso" onchange="dateDiff();"
                    value="{{ $reservacionHotel->fechaIngreso }}" min="{{ (new DateTime('tomorrow'))-> format('Y-m-d') }}">
                @error('fechaIngreso')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Fecha Salida</label>
                <input type="date" class="form-control" id="fechaSalida" name="fechaSalida" placeholder="Fecha de Salida" onchange="dateDiff();"
                    value="{{ $reservacionHotel->fechaSalida }}" min="{{ (new DateTime('+2 days'))->format('Y-m-d') }}">
                @error('fechaSalida')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <!--<div class="form-group">
                <label for="datepicker">Fecha Salida:</label>
                <br>
                    <div class="date-input-wrapper">
                        <input type="text" id="datepicker" data-min-date="{{ (new DateTime('+2 days'))->format('Y-m-d') }}" value="{{ (new DateTime('+2 days'))->format('d/m/Y') }}" readonly>
                        <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                <input type="hidden" id="fechaOculta"  name="fechaSalida" value="{{ (new DateTime('+2 days'))->format('Y-m-d') }}">
                @error('fechaSalida')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>  -->
            <div class="form-group">
                <label>Hora de recepción de mascota</label><br>
                <input type="time" id="horaRecepcion" name="horaRecepcion" min="9:00" max="20:00" value="{{ $reservacionHotel->horaRecepcion }}">
                @error('horaRecepcion')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>
            <label>Servicios extra</label><br>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for=""><b><i>Revisión veterinaria de rutina</i></b></label>
                    <input class="form-check-input ml-2" type="checkbox" id="check_veterinaria" value="1" {{ $reservacionHotel->tratamiento_veterinaria == 1 ? 'checked' : '' }}>
                    <input type="hidden" id="input_veterinaria" name="tratamiento_veterinaria" value="{{ $reservacionHotel->tratamiento_veterinaria }}">
                </div>
            </div>
            <div class="form-group">
                <label>Costo de veterinaria (Bs)</label>
                <input type="text" class="form-control" id="costo_veterinaria" name='costo_veterinaria' placeholder="costo_veterinaria" readonly>

                @error('costo_veterinaria')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
    <div class="form-check form-check-inline">
        <label class="form-check-label" for=""><b><i>Corte y baño en la estadía</i></b></label>
        <input class="form-check-input ml-2" type="checkbox" id="check_corte_banio" value="1"{{ $reservacionHotel->tratamiento_corte_banio == 1 ? 'checked' : '' }}>
        <input type="hidden" id="input_corte_banio" name="tratamiento_corte_banio" value="0">
    </div>
</div>

            <div class="form-group">
                <label>Costo de corte y baño (Bs)</label>
                <input type="text" class="form-control" id="costo_corte_banio" name='costo_corte_banio' placeholder="costo_corte_banio"
                    value="" readonly>

                @error('costo_corte_banio')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>           
            <div class="form-group">
                <label>Observaciones adicionales</label>
                <input type="text" class="form-control" id="observaciones" name='observaciones' placeholder="observaciones"
                    value="{{ $reservacionHotel->observaciones  ?? old('observaciones') ?? 'Sin observaciones'}}">
                @error('observaciones')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            <label>Servicio de transporte OJO (Transporte Ida y vuelta)  <input type="checkbox" id="transport" value="1"{{ $reservacionHotel->direccion != null ? 'checked' : '' }}></label>
            <br>
            <div id="camposTransporte">
            <label><b><i>Obtener dirección del perfil  </b></i><input type="checkbox" id="getUserAddress"></label>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" id="direccion" name='direccion' placeholder="Dirección"
                    value="{{ $reservacionHotel->direccion  ?? old('direccion') ?? ''}}">
                @error('direccion')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Zona</label>
                <select class="form-control" id="zona_direccion" name='zona_direccion'>
                    <option value="">Seleccionar zona</option>
                    <option value="Zona sur" {{ $reservacionHotel->zona_direccion == 'Zona sur' ? 'selected' : '' }}>Zona Sur</option>
                    <option value="Sopocachi" {{ $reservacionHotel->zona_direccion == 'Sopocachi' ? 'selected' : '' }}>Sopocachi</option>
                    <option value="Miraflores" {{ $reservacionHotel->zona_direccion == 'Miraflores' ? 'selected' : '' }}>Miraflores</option>
                    <option value="Centro" {{ $reservacionHotel->zona_direccion == 'Centro' ? 'selected' : '' }}>Centro</option>
                </select>
                @error('zona_direccion')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Costo de transporte</label>
                <input type="text" class="form-control" id="costo_transporte" name='costo_transporte' placeholder="costo_transporte"
                    value="{{ $reservacionHotel->costo_transporte  ?? old('costo_transporte') ?? 0}}" readonly>

                @error('costo_transporte')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            </div>
            <div class="form-group">
                <label>Costo de comida</label>
                <div><b><i>Detalle de costo comida: <br>
                <p>El precio de la comida es 40 Bs, multiplicado por <span id="detComida">x</span> días, resulta en un total de Bs: </p></b></i></div>
                <input type="text" class="form-control" id="costo_comida" name='costo_comida' placeholder="costo_comida"
                    value="{{ $reservacionHotel->costo_comida  ?? old('costo_comida') ?? 0}}" readonly>
                @error('costo_comida')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>        
            <div class="form-group">
                <label>Costos extra (Bs)</label>
                <input type="text" class="form-control" id="costo_extras" name='costo_extras' placeholder="costo_extras"
                    value="{{ $reservacionHotel->costo_extras  ?? old('costo_extras') ?? 0}}" readonly>

                @error('costo_extras')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div> 
            <div class="form-group">
                <label>Costo total (Bs)</label>
                <input type="text" class="form-control" id="costo_total" name='costo_total' placeholder="costo total"
                    value="{{ old('costo_total') ?? 0 }}" readonly>

                @error('total')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div id="hiddenAtributes">
                <div class="form-group">
                    <label>Hora de CheckIn</label><br>
                    <input type="hidden" id="horaCheckin" name="horaCheckin" min="9:00" max="19:00" value="{{ $reservacionHotel->horaCheckin }}" readonly>
                    @error('horaCheckin')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Hora de CheckOut</label><br>
                    <input type="hidden" id="horaCheckout" name="horaCheckout" min="9:00" max="19:00" value="{{ $reservacionHotel->horaCheckout }}" readonly>
                    @error('horaCheckout')
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
            </div>
            <input type="submit" value="Registrar reservación" class="btn btn-primary">
            <a class="btn btn-danger" href="{{route('reservacionHotel.index')}}">Volver</a>
        </form>
    </div>
</div>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/hoteleriaTotalesReservacion.js') }}"></script>
<script>
//CARGAR VALORES DE COSTO VETERINARIA
// Obtén el elemento de entrada
const inputCostoVeterinaria = document.getElementById('costo_veterinaria');
inputCostoVeterinaria.value = '{{ $reservacionHotel->costo_veterinaria  ?? old('costo_veterinaria') ?? 0}}';
calculateSum();
const inputCostoCorteBanio = document.getElementById('costo_corte_banio');
inputCostoCorteBanio.value = '{{ $reservacionHotel->costo_corte_banio  ?? old('costo_corte_banio') ?? 0}}';
calculateSum();
//TRANSPORTE EDIT REVISAR (SAME AS HOTELERIA TOTALES RESERVACION)
var chtransport = document.getElementById('transport');
const dct = document.getElementById('camposTransporte');
dct.style.display = 'block';
if (chtransport.checked == false){
    const dct = document.getElementById('camposTransporte');
    dct.style.display = 'none';
    calculateSum();
}
calculateSum();
//ACTIVAR O DESACTIVAR LOS CAMPOS DE TRANSPORTE - HOTELERÍA.
// Obtén el chtransport y el div

// Agrega un event listener al chtransport
chtransport.addEventListener('change', function() {
  if (chtransport.checked) {
    calculateSum();
    dct.style.display = 'block';
    selectZona.value = "";
    calculateSum();
  } else {
    calculateSum();
    dct.style.display = 'none';
    inputCostoTransporte.value = '0';
    calculateSum();
  }
  calculateSum();
});
//OBTENER DIRECCIÓN DEL USUARIO
const userAddress = document.getElementById('getUserAddress');
const direccion = document.getElementById('direccion');
userAddress.addEventListener('change', function() {
  if (userAddress.checked) {
    getUserAddress();
  } else {
    direccion.value = '';
  }
});
function getUserAddress(){
    var user_id = document.getElementById("usuario_id").value;
    const direccion = document.getElementById("direccion");
    @foreach ($users as $user )
        if ({{ $user->id }} == user_id){
            direccion.value = "{{ $user->direccion }}";
        }
    @endforeach
    }
</script>
<script>
habitacionsVal();
///CARGA DE HABITACIONES DISPONIBLES - HOTELERÍA.
function habitacionsVal() {
    var user_id = document.getElementById("usuario_id").value;
    var mascota_id = document.getElementById("mascota_id").value;
    var peso;
    var tamanio;
    var tipo;
        @foreach ($mascotas as $mascota)
        if({{ $mascota->usuario_id }} == user_id && {{ $mascota->id }} == mascota_id) {
            peso = '{{ $mascota->peso }}';
            tamanio = '{{ $mascota->tamaño }}';
            tipo = '{{ $mascota->tipo }}';
        }
        @endforeach
        //alert(""+peso+", "+tamanio+", "+tipo);
        var s = '<option value="">Seleccione la habitacion</option>';
        var count = 0;
        var tipocupante;
        var idhabres = "{{ $reservacionHotel->habitacion_id }}";
        var idhab = "";
        var costo_habitacion1 = document.getElementById("costo_habitacion");
            
        @foreach ($habitacions as $habitacion)
        tipocupante = '{{ $habitacion->tipo_ocupante }}';
        tamanohabitacion = '{{ $habitacion->tamano_habitacion }}';
        idhab = '{{ $habitacion->id }}';
        if(tipocupante == tipo && tamanio == tamanohabitacion) {
            console.log(""+idhab+"  "+idhabres);
            //alert(""+tipocupante+" = "+tipo+", "+tamanio+" = "+tamanohabitacion+"");
            if(idhab == idhabres){
                s += '<option selected value="{{ $habitacion->id }}">Habitación N°{{ $habitacion->nro_habitacion }} - Precio: {{ $habitacion->costo_habitacion }} Bs</option>';
                costo_habitacion1.value = "{{ $habitacion -> costo_habitacion }}";
                count++;
            }else {
                s += '<option value="{{ $habitacion->id }}">Habitación N°{{ $habitacion->nro_habitacion }} - Precio: {{ $habitacion->costo_habitacion }} Bs</option>';
                count++;
            }
        }
        @endforeach
        if(count < 1){
            s += '<option value="">No hay habitaciones disponibles</option>';
        }

    //console.log(mascota_id);
    const habitacion = document.getElementById("habitacion_id_nuevo");
    habitacion.innerHTML = s;
}
</script>
<script>
  // CARGAR COSTO DE HABITACIÓN
  var selectHabitacion = document.getElementById("habitacion_id_nuevo");

  selectHabitacion.addEventListener("change", function() {
    var selectedHabitacionId = selectHabitacion.options[selectHabitacion.selectedIndex].value;
    // console.log(selectedHabitacionId);
    var costo_habitacion = document.getElementById("costo_habitacion");
    @foreach ($habitacions as $habitacion)
      var habitacionId = "{{ $habitacion->id }}";
      var costoHabitacion = "{{ $habitacion->costo_habitacion }}";
      if (habitacionId == selectedHabitacionId) {
        //console.log(costoHabitacion);
        costo_habitacion.value = costoHabitacion;
        calculateSum();
      }
    @endforeach
  });
</script>
<script>
//FORMATO FECHA DATEPICKER ESPECIAL
$(function() {
  var disabledDates = ['12-25', '01-01', '07-17']; // Fechas deshabilitadas en formato MM-DD

  // Obtener la fecha mínima del atributo de datos en formato "yyyy-mm-dd"
  var minDateStr = $("#datepicker").data("min-date");
  var minDate = new Date(minDateStr);

  $("#datepicker").datepicker({
    dayNamesMin: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
    dateFormat: 'dd/mm/yy',
    beforeShowDay: function(date) {
      var day = date.getDay();
      var formattedDate = $.datepicker.formatDate('dd-mm-yy', date);

      // Deshabilitar fines de semana (0: Domingo, 6: Sábado)
      if (day === 0 || day === 6) {
        return [false];
      }

      // Deshabilitar fechas específicas
      if ($.inArray(formattedDate, disabledDates) != -1) {
        return [false];
      }

      // Habilitar solo fechas a partir de la fecha mínima
      if (date < minDate) {
        return [false];
      }

      return [true];
    },
    onSelect: function(dateText, inst) {
      var selectedDate = $.datepicker.parseDate('dd/mm/yy', dateText);
      var formattedDate = $.datepicker.formatDate('yy-mm-dd', selectedDate);
      $("#fechaOculta").val(formattedDate);
    }
  });
});

</script>
<script>
    // OBTENCIÓN DE LA DIRECCIÓN DE LA MASCOTA Y ASIGNACIÓN DEL COSTO DE TRANSPORTE - HOTELERÍA
// Obtén el select y el input
var selectZona1 = document.getElementById('zona_direccion');
var inputCostoTransporte1 = document.getElementById('costo_transporte');

// Agrega un event listener al select
selectZona1.addEventListener('change', function() {
    if (selectZona1.value === 'Zona sur') {
        inputCostoTransporte1.value = '100';
        calculateSum();
    } else if (selectZona1.value === 'Miraflores') {
        inputCostoTransporte1.value = '150';
        calculateSum();
    } else if (selectZona1.value === 'Sopocachi') {
        inputCostoTransporte1.value = '160';
        calculateSum();
    } else if (selectZona1.value === 'Centro') {
        inputCostoTransporte1.value = '180';
        calculateSum();
    } else {
        inputCostoTransporte1.value = '';
    }
});
</script>
<script src="https://www.tutorialspoint.com/jquery/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
@endsection
