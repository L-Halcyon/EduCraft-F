document.getElementById('changeImageBtn').addEventListener('click', function () {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('userImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
$(document).ready(function () {
    // Solicitud para obtener los datos del usuario
    $.ajax({
        url: '../PHP/MostrarInfoUsuario.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                const usuario = response.usuario;

                // Llenar los campos con los datos obtenidos
                $('#nombreCompleto').val(usuario.NombreCompleto);
                $('#genero').val(usuario.Genero);
                $('#fechaNacimiento').val(usuario.FechaNacimiento);
                $('#correoElectronico').val(usuario.Email).prop('disabled', true); // Correo bloqueado
                $('#contrasena').val(usuario.Contraseña);

                if ($('#genero').val() !== usuario.Genero) {
                    $('#genero').append(new Option(usuario.Genero, usuario.Genero, true, true));
                }
                if (usuario.ImagenAvatar) {
                    $('#userImage').attr('src', `data:image/jpeg;base64,${usuario.ImagenAvatar}`);
                }
            } else {
                $('#messages').addClass('alert alert-danger').text(response.message).show();
            }
        },
        error: function () {
            $('#messages').addClass('alert alert-danger').text('Error al comunicarse con el servidor.').show();
        }
    });

    // Validar y enviar formulario de edición
    $('form').on('submit', function (e) {
        e.preventDefault();

        const nombreCompleto = $('#nombreCompleto').val().trim();
        const genero = $('#genero').val();
        const fechaNacimiento = $('#fechaNacimiento').val();
        const contrasena = $('#contrasena').val().trim();
        const imagenArchivo = $('#fileInput')[0].files[0];

        // Limpiar mensajes previos
        const mensajes = $('#messages');
        mensajes.hide().removeClass().text('');

        // Validaciones
        let valido = true;

        // Validar que el nombre solo tenga letras
        const regexNombre = /^[a-zñA-ZÑáéíóúÁÉÍÓÚüÜ\s]+$/;
        if (!regexNombre.test(nombreCompleto)) {
            mensajes.addClass('alert alert-danger').text('El Nombre Completo solo debe contener letras.').show();
            valido = false;
        }

        // Validar la contraseña
        const regexContrasena = /^(?=.*[a-zñ])(?=.*[A-ZÑ])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (!regexContrasena.test(contrasena)) {
            mensajes.addClass('alert alert-danger').text('La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.').show();
            valido = false;
        }

        // Validar imagen
        if (imagenArchivo) {
            const extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
            const extension = imagenArchivo.name.split('.').pop().toLowerCase();
            const maxTamano = 2 * 1024 * 1024; // 2 MB

            if (!extensionesPermitidas.includes(extension)) {
                mensajes.addClass('alert alert-danger').text('Por favor, selecciona un archivo de imagen válido (jpg, jpeg, png, gif).').show();
                valido = false;
            } else if (imagenArchivo.size > maxTamano) {
                mensajes.addClass('alert alert-danger').text('El archivo de imagen no debe superar los 2 MB.').show();
                valido = false;
            }
        }

        // Si las validaciones son correctas
        if (valido) {
            // Limpiar mensajes previos
            const mensajes2 = $('#messages');
            mensajes2.hide().removeClass().text('');

            const formData = new FormData();
            formData.append('idUsuario', sessionStorage.getItem('idUsuario')); // Recuperar ID del usuario desde el almacenamiento
            formData.append('nombreCompleto', nombreCompleto);
            formData.append('genero', genero);
            formData.append('fechaNacimiento', fechaNacimiento);
            formData.append('contrasena', contrasena);
            if (imagenArchivo) {
                formData.append('fileInput', imagenArchivo);
            }

            // Enviar datos al servidor
            $.ajax({
                url: '../PHP/EditarUsuario.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json', // Asegura que jQuery interprete la respuesta como JSON
                success: function (response) {
                    console.log("Respuesta del servidor:", response); // Depuración
                    if (response.success) {
                        console.log("EXITO"); // Depuración
                        mensajes2.addClass('alert alert-success').text(response.message).show();
                        // Recargar la página después de 2 segundos
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } 
                },
                error: function () {
                    mensajes2.addClass('alert alert-danger').text(response.message).show();
                }
            });
        }
    });
});
