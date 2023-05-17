const productoSelect = document.getElementById("Producto");
const precioSelect = document.getElementById("PrecioIndividual");
const idproductoSelect = document.getElementById("IdProducto");
const cantidadSelect = document.getElementById("CantidadDisponible");
productoSelect.addEventListener("change", function () {
    precioSelect.selectedIndex = productoSelect.selectedIndex;
    cantidadSelect.selectedIndex = productoSelect.selectedIndex;
    idproductoSelect.selectedIndex = productoSelect.selectedIndex;
});
