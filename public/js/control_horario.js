const horaRecepcionSelect = document.getElementById("horaRecepcion");
const horaEntregaSelect = document.getElementById("horaEntrega");

horaRecepcionSelect.addEventListener("change", function () {
    horaEntregaSelect.selectedIndex = horaRecepcionSelect.selectedIndex;
});
