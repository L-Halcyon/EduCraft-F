$(document).ready(function() {
    // Obtener el Id del usuario y del curso de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const idCurso = urlParams.get('idCurso'); // Obtener el Id del curso desde la URL
    //const idUsuario = urlParams.get('idUsuario'); // Obtener el Id del usuario desde la URL

    console.log(idCurso);

    if (idCurso) {
        $.ajax({
            url: '../PHP/ObtenerDiploma.php', // El archivo PHP que devolverá los datos del usuario y curso
            type: 'GET',
            data: { idCurso: idCurso/*, idUsuario: idUsuario*/ },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Llenar los datos en el diploma
                    $('#nombre-estudiante').text(response.usuario.NombreCompleto); // Nombre del usuario
                    $('#nombre-curso').text(response.curso.TituloCurso); // Título del curso
                    //$('#nombre-instructor').text(response.instructor.NombreCompleto); // Nombre del instructor
                    $('#fecha-terminacion').text(new Date().toLocaleDateString('es-ES')); // Fecha actual
                } else {
                    alert('No se pudo obtener la información del diploma.');
                }
            },
            error: function() {
                alert('Error al cargar los datos.');
            }
        });
    }
});


document.getElementById('descargar').addEventListener('click', function () {

    const diploma = document.getElementById('diploma');

   
    const opciones = {
        margin: [0.5, 0.5, 0.5, 0.5], 
        filename: 'diploma_educraft.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, letterRendering: true },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' } 
    };

 
    html2pdf().set(opciones).from(diploma).save();
});
