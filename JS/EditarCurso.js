

//Para  mostrar la imagen cuando selecciones una
document.addEventListener('DOMContentLoaded', function () {
    const inputImagenCurso = document.getElementById('imagenCurso');
    const imagePreview = document.getElementById('imagePreview');

    inputImagenCurso.addEventListener('change', function (event) {
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; 
            };

            reader.readAsDataURL(file); 
        }
    });
});



//Para actualizar el nombre de la imagen ymostrarla cuando se seleccione una nueva
document.getElementById("imagenCurso").addEventListener("change", function(event) {
    const imagePreview = document.getElementById("imagePreview");
    const hiddenImageName = document.getElementById("hiddenImageName");

    const file = event.target.files[0]; 
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);

        hiddenImageName.value = file.name;
    } else {
        imagePreview.style.display = 'none';
        hiddenImageName.value = ''; 
    }
});



//Validaciones para editar (si no se cumple alguna, no se manda)
document.getElementById('form-editar-curso').addEventListener('submit', function (event) {
    if (!validarFormulario()) {
        event.preventDefault(); 
    }
});

function validarFormulario() {
    const tituloCurso = document.getElementById('tituloCurso').value.trim();
    const descripcionCurso = document.getElementById('descripcionCurso').value.trim();
    const costoCurso = document.getElementById('costoCurso').value.trim();
    const imagenCurso = document.getElementById('imagenCurso').files[0];
    const hiddenImageName = document.getElementById('hiddenImageName').value.trim();

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
    if (!imagenCurso && !hiddenImageName) {
        alert('Debe seleccionar una imagen para el curso.');
        valid = false;
    }

    return valid;
}
