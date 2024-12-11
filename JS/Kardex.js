document.addEventListener('DOMContentLoaded', () => {
    const kardexTableBody = document.querySelector('table tbody');
    const mensajes = document.getElementById('messages');
    const commentSectionContainer = document.getElementById('comment-section'); // Contenedor externo para comentarios

    // Cargar datos del Kardex
    fetch('../PHP/ObtenerKardex.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const cursos = data.kardex;

                cursos.forEach(curso => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${curso.Curso}</td>
                        <td>${new Date(curso.FechaInscripcion).toLocaleDateString()}</td>
                        <td>${curso.FechaUltimoAcceso ? new Date(curso.FechaUltimoAcceso).toLocaleDateString() : 'N/A'}</td>
                        <td>${curso.FechaTerminacion ? new Date(curso.FechaTerminacion).toLocaleDateString() : 'N/A'}</td>
                        <td>${curso.EstadoCurso}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width: ${curso.ProgresoCurso}%;"></div>
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm view-course" data-id="${curso.Id_Transaccion}" href="../HTML/VerCurso.php?idCurso=${curso.Id_Curso}">Ver Curso</a>
                        </td>
                    `;
                    kardexTableBody.appendChild(row);

                    // Sección de comentarios en el contenedor externo
                    if (curso.EstadoCurso === 'Completado') {
                        const commentSection = document.createElement('div');
                        commentSection.classList.add('rating-section', 'mb-4');
                        commentSection.innerHTML = `
                            <h5>${curso.Curso}</h5>
                            <textarea class="form-control mb-2" rows="4" id="comment-${curso.Id_Curso}" placeholder="Escribe tu comentario aquí..."></textarea>
                            <button class="btn btn-outline-success rate-btn" data-id="${curso.Id_Curso}" data-rating="Me Gusta">&#128077; Me Gusta</button>
                            <button class="btn btn-outline-danger rate-btn" data-id="${curso.Id_Curso}" data-rating="No Me Gusta">&#128078; No Me Gusta</button>
                            <button class="btn btn-primary mt-2 submit-comment" data-id="${curso.Id_Curso}" data-usuario="${curso.Id_Usuario}">Enviar Comentario</button>
                        `;
                        commentSectionContainer.appendChild(commentSection);
                    }
                });

                // Manejar selección de calificación
                document.addEventListener('click', event => {
                    if (event.target.classList.contains('rate-btn')) {
                        const buttons = event.target.parentElement.querySelectorAll('.rate-btn');
                        buttons.forEach(btn => btn.classList.remove('active')); // Quitar clase activa de otros botones
                        event.target.classList.add('active'); // Añadir clase activa al botón seleccionado
                    }

                    if (event.target.classList.contains('submit-comment')) {
                        const idCurso = event.target.getAttribute('data-id');
                        const idUsuario = event.target.getAttribute('data-usuario');
                        const comentario = document.getElementById(`comment-${idCurso}`).value.trim();
                        const rating = event.target.parentElement.querySelector('.rate-btn.active')?.getAttribute('data-rating');

                        if (!comentario) {
                            alert('El comentario no puede estar vacío.');
                            return;
                        }

                        if (!rating) {
                            alert('Selecciona una calificación.');
                            return;
                        }

                        // Enviar datos al servidor
                        fetch('../PHP/GuardarComentario.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ idCurso, idUsuario, comentario, rating })
                        })
                            .then(response => response.json())
                            .then(result => {
                                if (result.success) {
                                    mensajes.className = 'alert alert-success';
                                    mensajes.textContent = 'Comentario Guardado con éxito';
                                    mensajes.style.display = 'block';
                                    //alert('Comentario guardado exitosamente.');
                                    // Recargar la página después de 2 segundos
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    alert('Error al guardar el comentario.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            } else {
                mensajes.className = 'alert alert-danger';
                mensajes.textContent = data.message || 'No se encontraron cursos.';
                mensajes.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mensajes.className = 'alert alert-danger';
            mensajes.textContent = 'Error al cargar los cursos.';
            mensajes.style.display = 'block';
        });
});
