const cantidadInput = document.getElementById("Cantidad");
const precioInput = document.getElementById("Preciocompra");

cantidadInput.addEventListener("input", function () {
    if (this.value <= 0 && this.value != "") {
        alert("El valor debe ser mayor a cero.");
        this.value = "";
    }
});

precioInput.addEventListener("input", function () {
    if (this.value <= 0 && this.value != "") {
        alert("El valor debe ser mayor a cero.");
        this.value = "";
    }
});
