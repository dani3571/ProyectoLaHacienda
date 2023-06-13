$(document).ready(function () {
    $('.cancelarReserva').click(function (e) {
        e.preventDefault();
        var reserva_id = $(this).val();
        $('#Reserva_id').val(reserva_id);
        $('#ModalCancelar').modal('show');
    });
});


$(document).ready(function () {
    $('.confirmarCheckin').click(function (e) {
        e.preventDefault();
        var reserva_id = $(this).val();
        //alert(reserva_id+"");
        
        // Obtener la hora actual
        var fecha = new Date();
        var hora = fecha.getHours();
        var minutos = fecha.getMinutes();
        
        // Formatear los minutos para que siempre tenga dos dígitos
        minutos = minutos < 10 ? '0' + minutos : minutos;
        
        var horaActual = hora + ':' + minutos;
        
        // Asignar la hora actual al campo de entrada
        $('#horaCheckin').val(horaActual);
        
        $('#Reserva_idch').val(reserva_id);
        $('#ModalCheckin').modal('show');
    });
});


$(document).ready(function () {
    $('.confirmarCheckout').click(function (e) {
        e.preventDefault();
        var reserva_id = $(this).val();
        //alert(reserva_id+"");
        
        // Obtener la hora actual
        var fecha = new Date();
        var hora = fecha.getHours();
        var minutos = fecha.getMinutes();
        
        // Formatear los minutos para que siempre tenga dos dígitos
        minutos = minutos < 10 ? '0' + minutos : minutos;
        
        var horaActual = hora + ':' + minutos;
        
        // Asignar la hora actual al campo de entrada
        $('#horaCheckout').val(horaActual);
        
        $('#Reserva_idcho').val(reserva_id);
        $('#ModalCheckout').modal('show');
    });
});