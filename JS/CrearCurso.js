document.addEventListener('DOMContentLoaded', () => {
    const btnCrearNiveles = document.getElementById('btn-crear-niveles');
    const nivelesContainer = document.getElementById('niveles-container');
    const formCrearCurso = document.getElementById('form-crear-curso');
    const categoriaSelect = document.getElementById("categoriaCurso");

    // Función para cargar las categorías
    function cargarCategorias() {
        fetch("../PHP/ObtenerCategoriasCursos.php")
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error al obtener las categorías");
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    data.categorias.forEach((categoria) => {
                        const option = document.createElement("option");
                        option.value = categoria.id;
                        option.textContent = categoria.nombre;
                        categoriaSelect.appendChild(option);
                    });
                } else {
                    console.error("Error en la respuesta:", data.message);
                }
            })
            .catch((error) => {
                console.error("Error al cargar categorías:", error);
            });
    }

    // Llamar a la función para cargar categorías
    cargarCategorias();

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
                            <input type="file" class="custom-file-input" id="videoNivel${i}" name="nivel${i}_video" accept="video/*" required>
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
    
    // Obtener idUsuario desde sessionStorage
    const idUsuario = sessionStorage.getItem('idUsuario');

    if (!idUsuario) {
        console.error('El ID del usuario no está disponible');
        return;
    }

    formData.append('tituloCurso', tituloCurso);
    formData.append('cantidadNiveles', cantidadNiveles);
    formData.append('costoCurso', costoCurso);
    formData.append('descripcionCurso', descripcionCurso);
    formData.append('imagenCurso', imagenCurso);
    formData.append('idUsuario', idUsuario);
    
    // Datos de categorías (si es necesario, si no lo has hecho)
    const categoriaSelect = document.getElementById('categoriaCurso');
    const idCategoria = categoriaSelect ? categoriaSelect.value : '';
    formData.append('idCategoria', idCategoria);

    /*document.getElementById('categoriasData').value = JSON.stringify(categoriasData);

    const idCategoria = document.getElementById('categoriasData').value.trim();
    formData.append('idCategoria', idCategoria);*/
    

    // Recopilar datos de los niveles
    const nivelesContainer = document.getElementById('niveles-container');
    const niveles = nivelesContainer.querySelectorAll('.nivel');
    const nivelesData = [];

    niveles.forEach((nivel, index) => {
        const nivelIndex = index + 1; // Para identificar los niveles (1, 2, ...)

        // Verificar que los elementos existen antes de acceder a ellos
        const tituloNivelElement = nivel.querySelector(`#tituloNivel${nivelIndex}`);
        const descripcionNivelElement = nivel.querySelector(`#descripcionNivel${nivelIndex}`);
        const videoNivelElement = nivel.querySelector(`#videoNivel${nivelIndex}`);
        const costoNivelElement = nivel.querySelector(`#costoNivel${nivelIndex}`);

        // Verificar que los elementos no son nulos
        if (!tituloNivelElement || !descripcionNivelElement || !costoNivelElement) {
            console.error(`Faltan campos obligatorios en el nivel ${nivelIndex}`);
            return;
        }

        const tituloNivel = tituloNivelElement.value.trim();
        const descripcionNivel = descripcionNivelElement.value.trim();
        const videoNivel = videoNivelElement ? videoNivelElement.files[0] : null;  // Verificar si el video existe
        const costoNivel = costoNivelElement.value.trim();

        // Crear objeto para cada nivel
        const nivelData = {
            titulo: tituloNivel,
            descripcion: descripcionNivel,
            video: videoNivel,
            costo: costoNivel
        };

        // Campos opcionales
        const archivosAdjuntos = nivel.querySelector(`#archivosAdjuntos${nivelIndex}`)?.files ?? [];
        const linkExterno = nivel.querySelector(`#linkExterno${nivelIndex}`)?.value.trim() ?? '';
        const imagenesNivel = nivel.querySelector(`#imagenesNivel${nivelIndex}`)?.files ?? [];
        const textoContenido = nivel.querySelector(`#textoContenido${nivelIndex}`)?.value.trim() ?? '';

        nivelData.archivosAdjuntos = Array.from(archivosAdjuntos).map(archivo => archivo.name);
        nivelData.imagenesNivel = Array.from(imagenesNivel).map(imagen => imagen.name);
        nivelData.linkExterno = linkExterno;
        nivelData.textoContenido = textoContenido;

        nivelesData.push(nivelData);
    });

    // Asignar la información de niveles a un campo oculto
    document.getElementById('nivelesData').value = JSON.stringify(nivelesData);
    formData.append('nivelesData', JSON.stringify(nivelesData));


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
        /*// Obtener los datos de los campos ocultos
        const nivelesData = document.getElementById('nivelesData').value;
        const categoriasData = document.getElementById('categoriasData').value;

        // Asegurarse de que se agreguen los datos de los campos ocultos al FormData
        formData.append('nivelesData', nivelesData);
        formData.append('categoriasData', categoriasData);*/

        const response = await fetch('../PHP/CrearCurso.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();

        // Si el servidor responde con éxito, muestra un mensaje y redirige
        if (result.success) {
            alert('Curso creado exitosamente.');
            window.location.href = 'MisCursos.php'; // Redirigir a la página de cursos
        } else {
            alert(`Error: ${result.message}`);
        }
    } catch (error) {
        console.error('Error al enviar los datos:', error);
        alert('Ocurrió un error al intentar crear el curso. Intente nuevamente más tarde.');
    }
}

