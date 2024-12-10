$(document).ready(function () {
    const idCurso = 3//sessionStorage.getItem('idCurso'); // Recuperar el ID del curso seleccionado

    if (!idCurso) {
        alert('No se seleccionó ningún curso. Redirigiendo a la página principal.');
        window.location.href = '../HTML/PaginaPrincipal.php';
        return;
    }

    // Obtener información del curso
    $.ajax({
        url: '../PHP/ObtenerCurso.php', // Archivo PHP para recuperar los datos del curso
        method: 'GET',
        data: { idCurso: idCurso }, // Enviar ID del curso al servidor
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                const curso = response.curso;

                // Llenar los elementos con la información del curso
                $('.navbar-brand').text(curso.TituloCurso + ' - EduCraft');
                $('#coursePrice').text(`Precio del curso: $${curso.CostoCompleto}`);
                $('#courseTitle').text(curso.TituloCurso);
                $('#courseDescription').text(curso.DescripcionCurso);
                $('#courseRating').text(`Calificación del curso: ${curso.PromedioCalificacion}%`);
                $('#courseInstructor').text(`Instructor del curso: ${curso.Instructor}`);
                $('#courseImage').attr('src', `data:image/jpeg;base64,${curso.ImagenCurso}`);

                // Niveles del curso
                const nivelesContainer = $('#courseLevels');
                curso.niveles.forEach(nivel => {
                    const nivelElement = `
                        <div class="level bg-cream p-3 mb-3 rounded border">
                            <p class="font-weight-bold text-brown">${nivel.TituloNivel}</p>
                            <p>${nivel.Descripcion}</p>
                        </div>`;
                    nivelesContainer.append(nivelElement);
                });

                // Comentarios del curso
                const comentariosContainer = $('#courseComments');
                curso.comentarios.forEach(comentario => {
                    const comentarioElement = `
                        <div class="comment bg-cream p-3 mb-3 rounded border">
                            <p class="font-weight-bold text-brown">${comentario.Usuario} 
                                <span class="float-right">${new Date(comentario.FechaHoraCreacionComentario).toLocaleString()} 
                                <span class="${comentario.CalificacionComentario === 'Me gusta' ? 'text-success' : 'text-danger'}">
                                    ${comentario.CalificacionComentario}
                                </span></span>
                            </p>
                            <p>${comentario.DescripcionComentario}</p>
                        </div>`;
                    comentariosContainer.append(comentarioElement);
                });

                if (curso.comentarios.length === 0) {
                    comentariosContainer.append('<p class="text-muted text-center">Sin comentarios aún.</p>');
                }
            } else {
                alert('Error al cargar los datos del curso: ' + response.message);
                window.location.href = '../HTML/PaginaPrincipal.php';
            }
        },
        error: function () {
            alert('Error al comunicarse con el servidor. Intente nuevamente.');
            //window.location.href = '../HTML/PaginaPrincipal.php';
        }
    });

    const buyButton = document.getElementById('buyButton');
    const paymentMethod = document.getElementById('paymentMethod');
    const mensajes = document.getElementById('messages');

    buyButton.addEventListener('click', () => {
        const selectedMethod = paymentMethod.value;

        // Realizar la solicitud al servidor para guardar la transacción
        fetch('../PHP/RegistrarTransaccion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                metodoPago: selectedMethod,
                idCurso: idCurso // Variable definida previamente al cargar la página
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                mensajes.className = 'alert alert-success';
                mensajes.textContent = 'Compra realizada con éxito. Redirigiendo...';
                mensajes.style.display = 'block';

                // Redirigir después de 2 segundos
                setTimeout(() => {
                    window.location.href = '../HTML/Kardex.php';
                }, 2000);
            } else {
                mensajes.className = 'alert alert-danger';
                mensajes.textContent = data.message || 'Ocurrió un error al procesar la compra.';
                mensajes.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mensajes.className = 'alert alert-danger';
            mensajes.textContent = 'Error al conectar con el servidor.';
            mensajes.style.display = 'block';
        });
    });
});
