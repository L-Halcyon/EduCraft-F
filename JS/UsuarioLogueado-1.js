$(document).ready(function () {
    $.ajax({
        url: '../PHP/UsuarioLogueado.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response);

            if (response.status === 'success') {
                const nombre = response.nombre || '';
                const apellido = response.apellido || '';
                const nombreCompleto = nombre + ' ' + apellido;
                const rolUsuario = response.rolUsuario || '';
                const idUsuario = response.idUsuario || '';  // Guardar idUsuario  

                console.log("Rol de usuario: " + rolUsuario);

                $('#navbarDropdown').text(nombreCompleto);

                // Guardar idUsuario en sessionStorage
                sessionStorage.setItem('idUsuario', idUsuario);
            } else {
                console.error(response.message);
            }
        },
        error: function () {
            console.error('Error al comunicarse con el servidor.');
        }
    });
});
