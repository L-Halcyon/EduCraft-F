// Función para cargar los usuarios inactivos desde PHP
function cargarUsuariosInactivos() {
    $.ajax({
        url: '../PHP/DesbloqueoUsuarios.php',  // URL del archivo PHP que devuelve los usuarios inactivos
        method: 'GET',
        success: function (data) {
            const usuarios = JSON.parse(data);  // Parsear la respuesta JSON

            let tableBody = $('#usuariosTableBody');
            tableBody.empty();  // Limpiar la tabla antes de agregar nuevos usuarios

            usuarios.forEach(function (usuario) {
                let row = `
                    <tr>
                        <td>${usuario.NombreCompleto}</td>
                        <td>${usuario.Rol}</td>
                        <td>${usuario.EstatusUsuario}</td>
                        <td>
                            <button class="btn btn-primary" onclick="desbloquearUsuario(${usuario.Id_Usuario})">Desbloquear</button>
                        </td>
                    </tr>
                `;
                tableBody.append(row);  // Agregar cada usuario a la tabla
            });
        }
    });
}


// Función para desbloquear a un usuario
function desbloquearUsuario(usuarioId) {
    $.ajax({
        url: '../PHP/DesbloqueoUsuarios.php',  // Archivo PHP para desbloquear usuario
        method: 'POST',
        data: { id: usuarioId },
        success: function (response) {
            console.log(response); // Esto mostrará la respuesta del servidor en la consola
            
            if (response === "Usuario desbloqueado con éxito.") {
                alert(response);  // Si es un mensaje de éxito, lo mostramos
            } else {
                alert('Hubo un error al intentar desbloquear el usuario.'); // Si la respuesta no es éxito
            }
            
            cargarUsuariosInactivos();  // Recargar la lista de usuarios inactivos
        },
        
        error: function () {
            alert('Hubo un error al intentar desbloquear el usuario.');
        }
    });
}

// Cargar los usuarios inactivos al cargar la página
$(document).ready(function () {
    cargarUsuariosInactivos();
});
