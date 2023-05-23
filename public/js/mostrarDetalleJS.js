document.addEventListener('DOMContentLoaded', function () {
	//Listener
	/*document.querySelector('#btn-print').addEventListener('click', function () {
		html2canvas(document.querySelector('#factura')).then((canvas) => {
			// create a new window
			var nWindow = window.open('');
			// Anexar el canvas al body
			nWindow.document.body.appendChild(canvas);
			// Enfocar la ventana
			nWindow.focus();
			// Imprimir la ventana
			nWindow.print();
			// Recargar la página
			location.reload();
			//Cerrar ventana
			nWindow.close();
		});
	});*/
	//Listener
	document.querySelector('#btn-savepdf').addEventListener('click', function () {
		html2canvas(document.querySelector('#factura')).then((canvas) => {
			let base64image = canvas.toDataURL('image/png');
			// Definir tamaño de PDF
			let pdf = new jsPDF('p', 'px', [1600, 1131]);
			pdf.addImage(base64image, 'PNG', 15, 15, 1110, 360);
			//Obtener fecha
			var date = new Date();
			var current_time = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear() + "-" + date.getHours() + ":" + date.getMinutes();
			//Guardar PDF
			pdf.save(current_time + "Detalle.pdf");
		});
	});
});