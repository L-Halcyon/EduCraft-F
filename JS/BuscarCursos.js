document.querySelector('.search-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita el comportamiento predeterminado

    const titulo = document.getElementById('tituloCurso').value;
    const instructor = document.getElementById('instructor').value;
    const categoria = document.getElementById('categorySelect').value;
    const fechaDesde = document.getElementById('fechaDesde').value;
    const fechaHasta = document.getElementById('fechaHasta').value;
    const filtroEspecial = document.getElementById('filterOption').value;

    const url = `../PHP/BuscarCursos.php?titulo=${titulo}&instructor=${instructor}&categoria=${categoria}&fechaDesde=${fechaDesde}&fechaHasta=${fechaHasta}&filtroEspecial=${filtroEspecial}`;

    fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            console.error('Error del servidor:', data.error);
            return;
        }
        // Procesar los datos
        const container = document.querySelector('#coursesContainer');
        container.innerHTML = '';
        data.forEach(curso => {
            const card = `
                <div class="course-card">
                    <img src="data:image/jpeg;base64,${curso.ImagenCurso}" alt="${curso.TituloCurso}">
                    <h3>${curso.TituloCurso}</h3>
                    <p>Instructor: ${curso.NombreInstructor}</p>
                    <p>Calificación: ${curso.PromedioCalificacion}%</p>
                    <a class="course-btn btn" href="#" onclick="verMas(${curso.Id_Curso})">Ver más</a>
                </div>
            `;
            container.innerHTML += card;
        });
    })
    .catch(error => console.error('Error:', error));
});

// Función para manejar la redirección
function verMas(cursoId) {
    // Verificar si el usuario está logueado (ejemplo con sessionStorage)
    const usuarioLogueado = sessionStorage.getItem('usuarioLogueado');
    window.location.href = `../HTML/ComprarCurso.php?cursoId=${cursoId}`;
    /*
    if (usuarioLogueado) {
        // Si está logueado, redirigir a la página de detalles del curso
        window.location.href = `../HTML/ComprarCurso.php?cursoId=${cursoId}`;
    } else {
        // Si no está logueado, redirigir al registro
        window.location.href = '../HTML/Registro.php';
    }*/
}
