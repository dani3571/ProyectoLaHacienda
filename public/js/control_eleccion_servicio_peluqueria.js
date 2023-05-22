const valorActivo = document.querySelectorAll('input[name="servicio"]');
var corte = document.getElementById("corte");
var bano = document.getElementById("BanoSimple");
var prev = 0;
for (var i = 0; i < valorActivo.length; i++) {
    valorActivo[i].addEventListener('change', function() {
        if (this != prev) {
            prev = this;
        }
        if (prev.value == 0){
            corte.value = "1";
            bano.value = "0";
        }
        else if(prev.value == 1){
            corte.value = "0";
            bano.value = "1";
        }
        else if(prev.value == 2) {
            corte.value = "1";
            bano.value = "1";
        }
        console.log(prev.value)
    });
}