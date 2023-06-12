
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    $(document).ready(function() {
        // Ocultar el menú Veterinaria si no tiene submenús
        var submenuVeterinaria = $('#menuVeterinaria .treeview-menu');
        if (submenuVeterinaria.children().length === 0) {
            $('#menuVeterinaria').hide();
        }
    });