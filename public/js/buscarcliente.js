const apellido = document.getElementById("Apellido");
const nit = document.getElementById("Nit");
nit.addEventListener("input", buscarUsuarios);

// Función para buscar usuarios en la base de datos
function buscarUsuarios() {
    var Nit = nit.value;
    // Realizar una solicitud AJAX al servidor
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var usuarios = JSON.parse(this.responseText);
            if (usuarios.apellido != undefined) {
                apellido.value = usuarios.apellido;
            } else {
                if (apellido.value == "") {
                    apellido.value = "";
                }
            }
        }
    };
    xhttp.open("GET", "buscarCliente/" + encodeURIComponent(Nit), true);
    xhttp.send();
}
