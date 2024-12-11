$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const idCurso = urlParams.get('idCurso'); // Obtenemos el Id_Curso desde la URL

    
    if (idCurso) {
        // Hacemos la llamada AJAX a la API
        $.ajax({
            url: '../PHP/ObtenerCursoCompleto.php',
            type: 'GET',
            data: { idCurso: idCurso },
            dataType: 'json', // Especificamos que esperamos una respuesta JSON
            success: function(curso) {  // Ya no es necesario hacer JSON.parse(data)
                if (curso.success) {
                    // Insertamos los datos del curso
                    $('#curso-container').html(`
                        <div class="course-header text-center">
                            <h1>${curso.curso.TituloCurso}</h1>
                            <img src="data:image/jpeg;base64,${curso.curso.ImagenCurso}" alt="Imagen del curso" class="img-fluid">
                            <p class="mt-3 text-left course-description">${curso.curso.DescripcionCurso}</p>
                        </div>
                        <div class="mt-4">
                            <h2 class="text-brown">Niveles del curso</h2>
                    `);

                    // Insertamos los niveles del curso
                    curso.curso.niveles.forEach((nivel, index) => {
                        $('#curso-container').append(`
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h3 class="level-title">Nivel ${index + 1}: ${nivel.TituloNivel}</h3>
                                    <p>${nivel.Descripcion}</p>
                                    <div class="video-container">
                                        <iframe width="100%" height="400" src="${nivel.Video}" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <div class="row mt-3">
                                        ${Array.isArray(nivel.Multimedia) ? nivel.Multimedia.map(multimedia => `
                                            <div class="col-md-6">
                                                ${multimedia.ArchivoAdjunto ? `<a href="${multimedia.ArchivoAdjunto}" class="btn btn-outline-secondary">Descargar archivo</a>` : ''}
                                                ${multimedia.LinkExterno ? `<a href="${multimedia.LinkExterno}" class="btn btn-outline-secondary">Visitar página externa</a>` : ''}
                                            </div>
                                        `).join('') : ''}
                                    </div>
                                    <div class="row mt-3">
                                        ${nivel.Imagen ? `
                                            <div class="col-md-6">
                                                <img src="data:image/jpeg;base64,${nivel.Imagen}" alt="Imagen del nivel" class="img-fluid mt-2">
                                            </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        `);
                    });

                    // Botón para marcar curso como completado
                    $('#curso-container').append(`
                        <button id="marcar-completado" class="btn btn-primary mt-4">Marcar Curso Completado</button>
                    `);

                    // Añadir el certificado (pero oculto por ahora)
                    $('#curso-container').append(`
                        <div id="certificado-container" class="mt-5" style="display:none;">
                            <h2 class="text-brown">Certificado</h2>
                            <p>Una vez que completes todos los niveles del curso, recibirás un certificado con tu nombre y la fecha de finalización.</p>
                            <a href="../HTML/diploma.php?idCurso=${idCurso}" class="btn btn-success">Ver certificado</a>
                        </div>
                    `);

                    // Acción cuando se presiona el botón de completar el curso
                    $('#marcar-completado').on('click', function() {
                        $.ajax({
                            url: '../PHP/MarcarCursoCompletado.php',
                            type: 'POST',
                            data: { idCurso: idCurso },
                            success: function(response) {
                                if (response.success) {
                                    // Mostrar el certificado
                                    $('#certificado-container').show();
                                    alert('Curso marcado como completado.');
                                } else {
                                    alert('Error al marcar el curso como completado.');
                                }
                            },
                            error: function() {
                                alert('Error al hacer la solicitud');
                            }
                        });
                    });
                    /*$('#marcar-completado').on('click', function() {
                        $('#certificado-container').show();
                    });*/
                } else {
                    alert('No se pudo cargar el curso');
                }
            },
            error: function() {
                alert('Error al cargar el curso');
            }
        });
    }
});
