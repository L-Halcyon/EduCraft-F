document.addEventListener('DOMContentLoaded', () => {
    const btnCrearNiveles = document.getElementById('btn-crear-niveles');
    const nivelesContainer = document.getElementById('niveles-container');
    const formCrearCurso = document.getElementById('form-crear-curso');

    // Crear niveles dinámicos
    btnCrearNiveles.addEventListener('click', () => {
        const cantidadNiveles = parseInt(document.getElementById('cantidadNiveles').value);
        nivelesContainer.innerHTML = ''; // Limpiar niveles anteriores

        for (let i = 1; i <= cantidadNiveles; i++) {
            const nivelDiv = document.createElement('div');
            nivelDiv.classList.add('nivel');
            nivelDiv.innerHTML = `
                <h4 class="bold-text">Nivel ${i}</h4>
                <div class="form-group">
                    <label for="tituloNivel${i}">Título del nivel</label>
                    <input type="text" class="form-control" id="tituloNivel${i}" placeholder="Título del nivel" required>
                </div>
                <div class="form-group">
                    <label for="descripcionNivel${i}">Descripción del nivel</label>
                    <textarea class="form-control no-resize" id="descripcionNivel${i}" rows="2" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="videoNivel${i}">Video del nivel</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="videoNivel${i}" accept="video/*" required>
                            <label class="custom-file-label" for="videoNivel${i}">Seleccionar archivo</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="archivosAdjuntos${i}">Archivos adjuntos (Opcional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="archivosAdjuntos${i}" multiple>
                            <label class="custom-file-label" for="archivosAdjuntos${i}">Seleccionar archivos</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="linkExterno${i}">Link externo (Opcional)</label>
                        <input type="url" class="form-control" id="linkExterno${i}" placeholder="URL">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="imagenesNivel${i}">Imágenes (Opcional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imagenesNivel${i}" accept="image/*" multiple>
                            <label class="custom-file-label" for="imagenesNivel${i}">Seleccionar imágenes</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textoContenido${i}">Texto del contenido (Opcional)</label>
                    <textarea class="form-control no-resize" id="textoContenido${i}" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="costoNivel${i}">Costo del nivel</label>
                    <input type="text" class="form-control" id="costoNivel${i}" placeholder="Costo del nivel" required>
                </div>
            `;
            nivelesContainer.appendChild(nivelDiv);
        }

        // Actualizar etiquetas de archivos
        actualizarEtiquetasArchivo();
    });

    // Manejar envío del formulario
    formCrearCurso.addEventListener('submit', async (e) => {
        e.preventDefault();

        console.log('Formulario enviado'); // Asegúrate de que esto aparezca en la consola

        // Validaciones generales
        if (!validarFormulario()) return;

        // Preparar datos del formulario
        const formData = prepararDatosFormulario();

        // Inspección del contenido de formData
        /*for (let [key, value] of formData.entries()) {
            console.log(key, value); // Esto mostrará cada clave y valor en la consola del navegador
        }*/

        // Enviar datos al servidor
        await enviarDatosCurso(formData);
    });

    // Inicializar etiquetas de archivos al cargar la página
    actualizarEtiquetasArchivo();
});

// Validar formulario
function validarFormulario() {
    const tituloCurso = document.getElementById('tituloCurso').value.trim();
    const descripcionCurso = document.getElementById('descripcionCurso').value.trim();
    const costoCurso = document.getElementById('costoCurso').value.trim();
    const cantidadNiveles = parseInt(document.getElementById('cantidadNiveles').value);
    let valid = true;

    if (tituloCurso.length < 5) {
        alert('El título del curso debe tener al menos 5 caracteres.');
        valid = false;
    }
    if (descripcionCurso.length < 20) {
        alert('La descripción del curso debe tener al menos 20 caracteres.');
        valid = false;
    }
    if (isNaN(costoCurso) || parseFloat(costoCurso) <= 0) {
        alert('El costo del curso debe ser un número mayor a 0.');
        valid = false;
    }
    if (isNaN(cantidadNiveles) || cantidadNiveles < 1) {
        alert('La cantidad de niveles debe ser al menos 1.');
        valid = false;
    }

    return valid;
}

// Preparar datos del formulario
function prepararDatosFormulario() {
    const formData = new FormData();

    // Datos principales del curso
    const tituloCurso = document.getElementById('tituloCurso').value.trim();
    const imagenCurso = document.getElementById('imagenCurso').files[0];
    const descripcionCurso = document.getElementById('descripcionCurso').value.trim();
    const costoCurso = document.getElementById('costoCurso').value.trim();
    const cantidadNiveles = parseInt(document.getElementById('cantidadNiveles').value);

    formData.append('tituloCurso', tituloCurso);
    formData.append('imagenCurso', imagenCurso);
    formData.append('descripcionCurso', descripcionCurso);
    formData.append('costoCurso', costoCurso);
    formData.append('cantidadNiveles', cantidadNiveles);

    // Datos de los niveles dinámicos
    const nivelesContainer = document.getElementById('niveles-container');
    const niveles = nivelesContainer.querySelectorAll('.nivel');

    niveles.forEach((nivel, index) => {
        const nivelIndex = index + 1; // Para identificar los niveles (1, 2, ...)

        // Campos obligatorios
        const tituloNivel = nivel.querySelector(`#tituloNivel${nivelIndex}`).value.trim();
        const descripcionNivel = nivel.querySelector(`#descripcionNivel${nivelIndex}`).value.trim();
        const videoNivel = nivel.querySelector(`#videoNivel${nivelIndex}`).files[0];
        const costoNivel = nivel.querySelector(`#costoNivel${nivelIndex}`).value.trim();

        formData.append(`nivel${nivelIndex}_titulo`, tituloNivel);
        formData.append(`nivel${nivelIndex}_descripcion`, descripcionNivel);
        formData.append(`nivel${nivelIndex}_video`, videoNivel);
        formData.append(`nivel${nivelIndex}_costo`, costoNivel);

        // Campos opcionales
        const archivosAdjuntos = nivel.querySelector(`#archivosAdjuntos${nivelIndex}`).files;
        const linkExterno = nivel.querySelector(`#linkExterno${nivelIndex}`).value.trim();
        const imagenesNivel = nivel.querySelector(`#imagenesNivel${nivelIndex}`).files;
        const textoContenido = nivel.querySelector(`#textoContenido${nivelIndex}`).value.trim();

        // Adjuntar archivos opcionales
        Array.from(archivosAdjuntos).forEach((archivo, i) => {
            formData.append(`nivel${nivelIndex}_archivoAdjunto${i + 1}`, archivo);
        });

        Array.from(imagenesNivel).forEach((imagen, i) => {
            formData.append(`nivel${nivelIndex}_imagen${i + 1}`, imagen);
        });

        // Adjuntar otros campos opcionales
        if (linkExterno) {
            formData.append(`nivel${nivelIndex}_linkExterno`, linkExterno);
        }

        if (textoContenido) {
            formData.append(`nivel${nivelIndex}_textoContenido`, textoContenido);
        }
    });

    return formData;
}




// Actualizar etiquetas de archivo
function actualizarEtiquetasArchivo() {
    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', (e) => {
            const files = Array.from(e.target.files).map(file => file.name).join(', ') || 'Seleccionar archivo(s)';
            e.target.nextElementSibling.textContent = files;
        });
    });
}

// Enviar datos al servidor
async function enviarDatosCurso(formData) {
    try {
        const response = await fetch('../PHP/CrearCurso.php', {
            method: 'POST',
            body: formData,
        });
        const result = await response.json();
        if (result.success) {
            alert('Curso creado exitosamente.');
            window.location.href = './HTML/MisCursos.php';
        } else {
            alert(`Error: ${result.message}`);
        }
    } catch (error) {
        console.error('Error al enviar los datos:', error);
        alert('Ocurrió un error. Intente nuevamente.');
    }
}
