document.addEventListener('DOMContentLoaded', () => {
    const kardexTableBody = document.querySelector('table tbody');
    const mensajes = document.getElementById('messages');

    // Cargar datos del Kardex
    fetch('../PHP/ObtenerKardex.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const cursos = data.kardex;

                // Llenar la tabla con los datos
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
                });

                // Agregar evento a los botones "Ver Curso"
                document.querySelectorAll('.view-course').forEach(button => {
                    button.addEventListener('click', event => {
                        event.preventDefault(); // Evita que el enlace navegue inmediatamente
                        const idTransaccion = button.getAttribute('data-id');

                        // Actualizar FechaUltimoAcceso en la base de datos
                        fetch('../PHP/ActualizarUltimoAcceso.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ idTransaccion })
                        })
                            .then(response => response.json())
                            .then(result => {
                                if (result.status === 'success') {
                                    // Redirigir al curso después de actualizar
                                    window.location.href = button.href;
                                } else {
                                    alert('Error al actualizar la fecha de acceso.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Error al procesar la solicitud.');
                            });
                    });
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
