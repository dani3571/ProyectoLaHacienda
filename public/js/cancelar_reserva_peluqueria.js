$(document).ready(function () {
    $('.cancelarReserva').click(function (e) {
        e.preventDefault();
        var reserva_id = $(this).val();
        $('#Reserva_id').val(reserva_id);
        $('#ModalCancelar').modal('show');
    });
});