$(document).ready(function () {
    // Hacer una solicitud a UsuarioLogueado.php
    $.ajax({
        url: '../PHP/UsuarioLogueado.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                // Actualizar el nombre en el dropdown
                const nombreCompleto = response.nombre + ' ' + response.apellido;
                $('#navbarDropdown').text(nombreCompleto);
            } else {
                console.error(response.message);
            }
        },
        error: function () {
            console.error('Error al comunicarse con el servidor.');
        }
    });
});
