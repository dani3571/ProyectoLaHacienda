const horaRecepcionSelect = document.getElementById("horaRecepcion");
const horaEntregaSelect = document.getElementById("horaEntrega");

horaRecepcionSelect.addEventListener("change", function () {
    var horaRecepcion = horaRecepcionSelect.value;
    var hora = horaRecepcion.substr(0,2);
    var minuto = horaRecepcion.slice(3);
    if(minuto != "00") {
        minuto = "00";
        horaRecepcionSelect.value = hora + ":" + minuto;
    }
    if(hora*1 < 8) var horaEntrega = "0" + ((hora * 1) + 2) + ":" + minuto;
    else var horaEntrega = ((hora * 1) + 2) + ":" + minuto;
    horaEntregaSelect.value = horaEntrega;
});
