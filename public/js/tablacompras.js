const btnAgregarProducto = document.getElementById("btnAgregarProducto");
const productosAgregados = {};
let contador = 0;
btnAgregarProducto.addEventListener("click", function (e) {
    // Obtener los valores del formulario
    e.preventDefault();
    if (!validarCampos()) {
        return;
    }
    const IdProducto = document.getElementById("IdProducto").value;
    const NombreProducto = document.getElementById("NombreProducto").value;
    const cantidad = document.getElementById("Cantidad").value;
    const precio = document.getElementById("Preciocompra").value;
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
    const inputPreciocompra = document.createElement("input");
    const inputSubtotal = document.createElement("input");
    // Asignar los valores a las celdas (mismo código que en el ejemplo anterior)
    celdaIdProducto.textContent = IdProducto;
    celdaProducto.textContent = NombreProducto;
    celdaCantidad.textContent = cantidad;
    celdaCantidad.setAttribute("class", "cantidad");
    celdaPrecio.textContent = precio;
    celdaSubtotal.textContent = subtotal;
    celdaSubtotal.setAttribute("class", "subtotal");
    //Asignar valores a los inputs
    inputIdProducto.setAttribute("type", "hidden");
    inputIdProducto.setAttribute("value", IdProducto);
    inputIdProducto.setAttribute(
        "name",
        "compra[compra" + contador + "][IdProducto]"
    );
    inputProducto.setAttribute("type", "hidden");
    inputProducto.setAttribute("value", NombreProducto);
    inputProducto.setAttribute(
        "name",
        "compra[compra" + contador + "][Producto]"
    );
    inputCantidad.setAttribute("type", "hidden");
    inputCantidad.setAttribute("value", cantidad);
    inputCantidad.setAttribute(
        "name",
        "compra[compra" + contador + "][Cantidad]"
    );
    inputPreciocompra.setAttribute("type", "hidden");
    inputPreciocompra.setAttribute("value", precio);
    inputPreciocompra.setAttribute(
        "name",
        "compra[compra" + contador + "][Precio]"
    );
    inputSubtotal.setAttribute("type", "hidden");
    inputSubtotal.setAttribute("value", subtotal);
    inputSubtotal.setAttribute(
        "name",
        "compra[compra" + contador + "][Subtotal]"
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
        if (productosAgregados[NombreProducto]) {
            productosAgregados[NombreProducto] -= cantidad;
            if (productosAgregados[NombreProducto] === 0) {
                delete productosAgregados[NombreProducto];
            }
        }
        actualizarTotal();
    });
    // Agregar el enlace a la celda de acciones
    celdaIdProducto.appendChild(inputIdProducto);
    celdaProducto.appendChild(inputProducto);
    celdaCantidad.appendChild(inputCantidad);
    celdaPrecio.appendChild(inputPreciocompra);
    celdaSubtotal.appendChild(inputSubtotal);
    celdaAcciones.appendChild(enlace);
    // Agregar las celdas a la fila (mismo código que en el ejemplo anterior)
    fila.appendChild(celdaIdProducto);
    fila.appendChild(celdaProducto);
    fila.appendChild(celdaCantidad);
    fila.appendChild(celdaPrecio);
    fila.appendChild(celdaSubtotal);
    fila.appendChild(celdaAcciones);
    if (productosAgregados[NombreProducto]) {
        productosAgregados[NombreProducto] += parseInt(cantidad);
    } else {
        productosAgregados[NombreProducto] = parseInt(cantidad);
    }
    // Agregar la fila a la tabla
    document.getElementById("tbody").appendChild(fila);
    // Limpiar los valores del formulario
    document.getElementById("Cantidad").value = "";
    document.getElementById("Preciocompra").value = "";
    document.getElementById("IdProducto").selectedIndex = 0;
    contador++;
    actualizarTotal();
});

function validarCampos() {
    // Obtener los valores de los campos del formulario
    const Producto = document.getElementById("NombreProducto").value;
    const Cantidad = document.getElementById("Cantidad").value;
    const Preciocompra = document.getElementById("Preciocompra").value;
    // Verificar que los campos no estén vacíos
    if (
        Producto.trim() === "" ||
        Cantidad.trim() === "" ||
        Preciocompra.trim() === ""
    ) {
        alert("Ingrese los datos faltantes");
        return false; // Detener la ejecución si hay campos vacíos
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
    console.log(cantidadTotal)
}
