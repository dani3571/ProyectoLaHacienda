const btnAgregarProducto = document.getElementById("btnAgregarProducto");
const productosAgregados = {};
let contador = 0;
btnAgregarProducto.addEventListener("click", function (e) {
    // Obtener los valores del formulario
    e.preventDefault();
    if (!validarCampos()) {
        return;
    }
    const idProducto = document.getElementById("IdProducto").value;
    const producto = document.getElementById("Producto").value;
    const cantidad = document.getElementById("Cantidad").value;
    const precio = document.getElementById("PrecioIndividual").value;
    const subtotal = (cantidad * precio).toFixed(2);
    // Crear una nueva fila y sus celdas
    const fila = document.createElement("tr");
    const celdaIdProducto = document.createElement("th");
    const celdaProducto = document.createElement("td");
    const celdaCantidad = document.createElement("td");
    const celdaPrecio = document.createElement("td");
    const celdaSubtotal = document.createElement("td");
    const celdaAcciones = document.createElement("td");
    // Nueva celda para el campo adicional
    // Nuevo elemento <a>
    const enlace = document.createElement("a");
    const inputIdProducto = document.createElement("input");
    const inputProducto = document.createElement("input");
    const inputCantidad = document.createElement("input");
    const inputPrecioIndividual = document.createElement("input");
    const inputSubtotal = document.createElement("input");
    // Asignar los valores a las celdas (mismo código que en el ejemplo anterior)
    celdaIdProducto.textContent = idProducto;
    celdaProducto.textContent = producto;
    celdaCantidad.textContent = cantidad;
    celdaCantidad.setAttribute("class", "cantidad");
    celdaPrecio.textContent = precio;
    celdaSubtotal.textContent = subtotal;
    celdaSubtotal.setAttribute("class", "subtotal");
    //Asignar valores a los inputs
    inputIdProducto.setAttribute("type", "hidden");
    inputIdProducto.setAttribute("value", idProducto);
    inputIdProducto.setAttribute(
        "name",
        "venta[venta" + contador + "][IdProducto]"
    );
    inputProducto.setAttribute("type", "hidden");
    inputProducto.setAttribute("value", producto);
    inputProducto.setAttribute(
        "name",
        "venta[venta" + contador + "][Producto]"
    );
    inputCantidad.setAttribute("type", "hidden");
    inputCantidad.setAttribute("value", cantidad);
    inputCantidad.setAttribute(
        "name",
        "venta[venta" + contador + "][Cantidad]"
    );
    inputPrecioIndividual.setAttribute("type", "hidden");
    inputPrecioIndividual.setAttribute("value", precio);
    inputPrecioIndividual.setAttribute(
        "name",
        "venta[venta" + contador + "][Precio]"
    );
    inputSubtotal.setAttribute("type", "hidden");
    inputSubtotal.setAttribute("value", subtotal);
    inputSubtotal.setAttribute(
        "name",
        "venta[venta" + contador + "][Subtotal]"
    );
    // Agregar el texto al enlace
    enlace.textContent = "Eliminar";
    // Agregar el atributo href al enlace
    enlace.setAttribute("href", "#");
    enlace.setAttribute("class", "btn btn-primary btn-sm");
    // Agregar el evento onclick al enlace
    enlace.addEventListener("click", function () {
        // Eliminar la fila al hacer clic en el enlace
        fila.remove();
        if (productosAgregados[producto]) {
            productosAgregados[producto] -= cantidad;
            if (productosAgregados[producto] === 0) {
                delete productosAgregados[producto];
            }
        }
        actualizarTotal();
    });
    // Agregar el enlace a la celda de acciones
    celdaIdProducto.appendChild(inputIdProducto);
    celdaProducto.appendChild(inputProducto);
    celdaCantidad.appendChild(inputCantidad);
    celdaPrecio.appendChild(inputPrecioIndividual);
    celdaSubtotal.appendChild(inputSubtotal);
    celdaAcciones.appendChild(enlace);
    // Agregar las celdas a la fila (mismo código que en el ejemplo anterior)
    fila.appendChild(celdaIdProducto);
    fila.appendChild(celdaProducto);
    fila.appendChild(celdaCantidad);
    fila.appendChild(celdaPrecio);
    fila.appendChild(celdaSubtotal);
    fila.appendChild(celdaAcciones);
    if (productosAgregados[producto]) {
        productosAgregados[producto] += parseInt(cantidad);
    } else {
        productosAgregados[producto] = parseInt(cantidad);
    }
    // Agregar la fila a la tabla
    document.getElementById("tbody").appendChild(fila);
    // Limpiar los valores del formulario
    document.getElementById("Cantidad").value = "";
    contador++;
    actualizarTotal();
});

function validarCampos() {
    // Obtener los valores de los campos del formulario
    const IdProducto = document.getElementById("IdProducto").value;
    const Producto = document.getElementById("Producto").value;
    const Cantidad = document.getElementById("Cantidad").value;
    const PrecioIndividual = document.getElementById("PrecioIndividual").value;
    const CantidadDisponible =
        document.getElementById("CantidadDisponible").value;
    // Verificar que los campos no estén vacíos
    if (
        IdProducto.trim() === "" ||
        Producto.trim() === "" ||
        Cantidad.trim() === "" ||
        PrecioIndividual.trim() === ""
    ) {
        alert("Ingrese una cantidad");
        return false; // Detener la ejecución si hay campos vacíos
    }
    if (parseInt(Cantidad) > parseInt(CantidadDisponible)) {
        alert("La cantidad ingresada es mayor que la cantidad disponible.");
        return false; // Detener la ejecución si la cantidad es mayor
    }
    if (
        productosAgregados[Producto] &&
        productosAgregados[Producto] + parseInt(Cantidad) >
            parseInt(CantidadDisponible)
    ) {
        alert(
            "La suma de las cantidades para el producto actual supera la cantidad disponible."
        );
        return false; // Detener la ejecución si la suma de las cantidades es mayor
    }
    return true; // Retornar true si los campos están completos
}
function actualizarTotal() {
    let total = 0;
    let cantidadTotal = 0;
    // Recorrer todas las filas de la tabla
    const filas = document.querySelectorAll("#tbody tr");
    filas.forEach(function (fila) {
        // Obtener el valor del subtotal de cada fila y sumarlo al total
        const subtotal = parseFloat(
            fila.querySelector(".subtotal").textContent
        );
        const cantidad = parseInt(fila.querySelector(".cantidad").textContent);
        cantidadTotal += cantidad;
        total += subtotal;
    });
    const textTotal = document.getElementById("Total");
    textTotal.setAttribute("value", total);
    document.getElementById("CantidadTotal").value = cantidadTotal;
}
