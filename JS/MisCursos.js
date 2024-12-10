$(document).ready(function () {
    const idUsuario = sessionStorage.getItem('idUsuario');

    $.ajax({
        url: '../PHP/ObtenerCursosProfesor.php',  
        method: 'GET',
        data: { idUsuario: idUsuario },
        dataType: 'html', 
        success: function (response) {
            // Inserta los cursos dentro del contenedor #cursosContainer
            $('#cursosContainer').html(response);
        },
        error: function () {
            console.error('Error al cargar los cursos.');
        }
    });
});
