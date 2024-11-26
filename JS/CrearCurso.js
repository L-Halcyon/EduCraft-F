document.addEventListener('DOMContentLoaded', () => {
    const btnCrearNiveles = document.getElementById('btn-crear-niveles');
    const nivelesContainer = document.getElementById('niveles-container');
    const formCrearCurso = document.getElementById('form-crear-curso');

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

        // Actualiza los labels de los inputs tipo file para mostrar los nombres de los archivos seleccionados
        document.querySelectorAll('.custom-file-input').forEach(input => {
            input.addEventListener('change', (e) => {
                const files = Array.from(e.target.files).map(file => file.name).join(', ') || 'Seleccionar archivo(s)';
                e.target.nextElementSibling.textContent = files;
            });
        });

        formCrearCurso.addEventListener('submit', (e) => {
            e.preventDefault(); // Evitar el envío del formulario hasta que se validen los campos
            const tituloCurso = document.getElementById('tituloCurso').value.trim();
            const descripcionCurso = document.getElementById('descripcionCurso').value.trim();
            const costoCurso = document.getElementById('costoCurso').value.trim();
            const cantidadNiveles = parseInt(document.getElementById('cantidadNiveles').value);
            let valid = true;
    
            // Validación del título del curso
            if (tituloCurso.length < 5) {
                alert('El título del curso debe tener al menos 5 caracteres.');
                valid = false;
            }
    
            // Validación de la descripción del curso
            if (descripcionCurso.length < 20) {
                alert('La descripción del curso debe tener al menos 20 caracteres.');
                valid = false;
            }
    
            // Validación del costo del curso
            if (isNaN(costoCurso) || parseFloat(costoCurso) <= 0) {
                alert('El costo del curso debe ser un número mayor a 0.');
                valid = false;
            }
    
            // Validación de la cantidad de niveles
            if (isNaN(cantidadNiveles) || cantidadNiveles < 1) {
                alert('La cantidad de niveles debe ser al menos 1.');
                valid = false;
            }
    
            // Validaciones para cada nivel creado
            for (let i = 1; i <= cantidadNiveles; i++) {
                const tituloNivel = document.getElementById(`tituloNivel${i}`).value.trim();
                const costoNivel = document.getElementById(`costoNivel${i}`).value.trim();
                const linkExterno = document.getElementById(`linkExterno${i}`) ? document.getElementById(`linkExterno${i}`).value.trim() : '';
    
                // Validación del título del nivel
                if (tituloNivel.length < 3) {
                    alert(`El título del nivel ${i} debe tener al menos 3 caracteres.`);
                    valid = false;
                }
    
                // Validación del costo del nivel
                if (isNaN(costoNivel) || parseFloat(costoNivel) <= 0) {
                    alert(`El costo del nivel ${i} debe ser un número mayor a 0.`);
                    valid = false;
                }
    
                // Validación del link externo
                if (linkExterno && !isValidURL(linkExterno)) {
                    alert(`El link externo del nivel ${i} no tiene un formato válido.`);
                    valid = false;
                }
            }
    
            if (valid) {
                alert('Curso creado exitosamente.');
                formCrearCurso.submit(); // Enviar el formulario
            }
        });
    });

    // Actualiza los labels de los inputs tipo file al cargar la página
    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', (e) => {
            const files = Array.from(e.target.files).map(file => file.name).join(', ') || 'Seleccionar archivo(s)';
            e.target.nextElementSibling.textContent = files;
        });
    });
});
