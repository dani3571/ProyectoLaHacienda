document
    .getElementById("FormularioVentas")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Evita el envío automático del formulario
        if (!validarCeldas()) {
            return;
        }
        Swal.fire({
            title: "¿Confirmar?",
            text: "¿Estás seguro de que quiere continuar con la Compra?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Confirmar",
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
function validarCeldas() {
    const filas = document.querySelectorAll("#tbody tr");
    if (filas.length == 0) {
        alert("No hay productos elegidos para la Compra");
        return false; // Detener la ejecución si la cantidad es mayor
    }
    return true;
}
