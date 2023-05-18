const horaRecepcionSelect = document.getElementById("horaRecepcion");
const horaEntregaSelect = document.getElementById("horaEntrega");


horaRecepcionSelect.addEventListener("change", function () {
    var horaRecepcion = horaRecepcionSelect.value;
    var hora = horaRecepcion.substr(0,2);
    var minuto = horaRecepcion.slice(3);
    var horaEntrega = ((hora * 1) + 2) + ":" + minuto;
    horaEntregaSelect.value = horaEntrega;
});
