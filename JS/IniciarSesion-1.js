$(document).ready(function () {
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        const email = $('#email').val().trim();
        const password = $('#password').val().trim();
        const messagesDiv = $('#messages');
        messagesDiv.html(''); // Limpia los mensajes anteriores
        messagesDiv.removeClass('alert-danger alert-success d-none'); // Remueve clases previas

        let messages = '';
        let valid = true;

        // Validaciones de campos vacíos
        if (!email && !password) {
            messages = 'Ambos campos están vacíos.';
            valid = false;
        } else if (!email) {
            messages = 'El campo Correo Electrónico está vacío.';
            valid = false;
        } else if (!password) {
            messages = 'El campo Contraseña está vacío.';
            valid = false;
        }

        if (!valid) {
            // Mostrar mensaje de error si los campos están vacíos
            messagesDiv.addClass('alert-danger').html(messages);
        } else {
            // Realizar solicitud AJAX
            $.ajax({
                url: '../PHP/IniciarSesion.php',
                method: 'POST',
                data: { email, password },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        messagesDiv.addClass('alert-success').html(response.message);
                        // Redirigir después de 1500ms
                        setTimeout(() => {
                            window.location.href = response.redirect;
                        }, 1500);
                    } else {
                        messagesDiv.addClass('alert-danger').html(response.message);
                    }
                },
                error: function () {
                    messagesDiv.addClass('alert-danger').html('Error al comunicarse con el servidor.');
                }
            });
        }
    });
});
