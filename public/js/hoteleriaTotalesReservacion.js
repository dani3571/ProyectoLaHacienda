//ATRIBUTOS AUXILIARES
const hidden = document.getElementById("hiddenAtributes")
hidden.style.display = 'none';


//SUMA DE COSTOS - RESERVACIÓN DE HOTELERÍA.
function calculateSum() {
    const num1 = parseFloat(document.getElementById("costo_transporte").value) || 0;
    const num2 = parseFloat(document.getElementById("costo_comida").value) || 0;
    const num3 = parseFloat(document.getElementById("costo_veterinaria").value) || 0;
    const num4 = parseFloat(document.getElementById("costo_corte_banio").value) || 0;
    const num5 = parseFloat(document.getElementById("costo_extras").value) || 0;
    const num6 = parseFloat(document.getElementById("costo_habitacion").value) || 0;

    const sum = num1 + num2 + num3 + num4 + num5 + num6;

    document.getElementById("costo_total").value = sum;
}

dateDiff();
//DIFERENCIA DE DÍAS ENTRE FECHA DE INGRESO Y FECHA DE SALIDA - RESERVACIÓN DE HOTELERÍA.
function dateDiff(){
    const fechaIngreso = new Date(document.getElementById("fechaIngreso").value);
    const fechaSalidaInput = document.getElementById("fechaSalida");
    const fechaSalida = new Date(fechaSalidaInput.value);

    if (fechaIngreso >= fechaSalida) {
    //alert("La fecha de ingreso es mayor que la fecha de salida.");
    fechaSalida.setDate(fechaIngreso.getDate() + 1);
    // Verificar si se cambió el mes
    if (fechaSalida.getMonth() !== fechaIngreso.getMonth()) {
        fechaSalida.setMonth(fechaIngreso.getMonth());
    }
    fechaSalidaInput.value = fechaSalida.toISOString().split("T")[0];
    }
    
    fechaSalidaInput.min = fechaSalida.toISOString().split("T")[0];

    const diffTime = Math.abs(fechaSalida - fechaIngreso);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    //console.log(diffDays + " days");
    document.getElementById("detComida").innerHTML = diffDays;
    calculateFood(diffDays + "");
}
function calculateFood(days){
    //alert(days);
    precioComida = parseFloat(days) * 40;
    //document.getElementById("detComida").innerHTML = precioComida;
    document.getElementById("costo_comida").value = precioComida;
    //CALCULAR SUMA DE COSTOS DE HOTELERÍA.
    calculateSum();
}

//COSTOS DE ESTADÍA VETERINARIA Y BAÑO_CORTE - HOTELERÍA.
$(document).ready(function() {
    // Obtener los elementos de entrada y los costos
    var checkVeterinaria = $("#check_veterinaria");
    var checkCorteBanio = $("#check_corte_banio");
    var costoVeterinaria = $("#costo_veterinaria");
    var costoCorteBanio = $("#costo_corte_banio");

    // Establecer el número por defecto
    var numeroPorDefecto = 100;

    // Función para actualizar los costos
    function actualizarCostos() {
        if (checkVeterinaria.prop("checked")) {
            costoVeterinaria.val(numeroPorDefecto);
            checkVeterinaria.prop("value", "1");
            calculateSum();
        } else {
            costoVeterinaria.val(0);
            checkVeterinaria.prop("value", "0");
            calculateSum();
        }

        if (checkCorteBanio.prop("checked")) {
            costoCorteBanio.val(numeroPorDefecto);
            checkCorteBanio.prop("value", "1");
            calculateSum();
        } else {
            costoCorteBanio.val(0);
            checkCorteBanio.prop("value", "0");
            calculateSum();
        }
    }


    // Escuchar el evento click de los checkboxes
    checkVeterinaria.on("click", actualizarCostos);
    checkCorteBanio.on("click", actualizarCostos);
});


//VALIDACIÓN DE LA HORA DE RECEPCIÓN DE LA MASCOTA - HOTELERÍA
  // Obtener referencia al elemento de entrada
  var inputHora = document.getElementById("horaRecepcion");
  //OBTENER HORA ACTUAL
  // Obtener la fecha y hora actual
    var fechaActual = new Date();

    // Obtener las horas y minutos
    var horas = fechaActual.getHours();
    var minutos = fechaActual.getMinutes();

    // Formatear las horas y minutos en el formato deseado
    var horaFormateada = (horas < 10 ? "0" : "") + horas + ":" + (minutos < 10 ? "0" : "") + minutos;

    //console.log(horaFormateada);

    inputHora.value = horaFormateada;
  // Agregar evento de escucha para cuando cambie el valor
  inputHora.addEventListener("change", function() {
    // Obtener el valor actual del elemento de entrada
    var horaSeleccionada = inputHora.value;

    // Verificar si la hora seleccionada está fuera del rango permitido
    if (horaSeleccionada < "09:00" || horaSeleccionada > "20:00") {
      // Restablecer el valor del elemento de entrada a la hora mínima permitida
      inputHora.value = "09:00";
    }
  });


// OBTENCIÓN DE LA DIRECCIÓN DE LA MASCOTA Y ASIGNACIÓN DEL COSTO DE TRANSPORTE - HOTELERÍA
// Obtén el select y el input
const selectZona = document.getElementById('zona_direccion');
const inputCostoTransporte = document.getElementById('costo_transporte');

// Agrega un event listener al select
selectZona.addEventListener('change', function() {
    // Verifica si la opción seleccionada es "Zona Sur"
    if (selectZona.value === 'Zona sur') {
        // Establece el valor del input a 100 (o cualquier otro número que desees)
        inputCostoTransporte.value = '100';
        calculateSum();
    } else {
        // Si no es "Zona Sur", borra el valor del input
        inputCostoTransporte.value = '';
    }
});


//ACTIVAR O DESACTIVAR LOS CAMPOS DE TRANSPORTE - HOTELERÍA.
// Obtén el checkbox y el div
const checkbox = document.getElementById('transport');
const divCamposTransporte = document.getElementById('camposTransporte');
divCamposTransporte.style.display = 'block';
// Agrega un event listener al checkbox
checkbox.addEventListener('change', function() {
  if (checkbox.checked) {
    divCamposTransporte.style.display = 'block';
    selectZona.value = "";
    calculateSum();
  } else {
    divCamposTransporte.style.display = 'none';
    inputCostoTransporte.value = '0';
    calculateSum();
  }
});

//OCULTAR/MOSTRAR MASCOTAS ACTIVAS ACTUALMENTE
const mascResLabel = document.getElementById('mascResLabel');
mascResLabel.style.cursor = "pointer";
mascResLabel.style.userSelect = "none";
mascResLabel.style.MozUserSelect = "none";
reserv.style.display = 'none';
// Agrega un event listener al checkbox
function showResPets() {
  var reserv = document.getElementById("reserv");

  if (reserv.style.display === 'none') {
    reserv.style.display = 'block';
    mascResLabel.innerHTML = "Ocultar mascotas del usuario con reservaciones activas actualmente";
  } else if (reserv.style.display === 'block') {
    reserv.style.display = 'none';
    mascResLabel.innerHTML = "Mostrar mascotas del usuario con reservaciones activas actualmente";
  }
}

//MANTENER DIV DE MASCOTAS OCULTO
mascResContaineR = document.getElementById('mascResContainer');
mascResContainer.style.display = 'none';