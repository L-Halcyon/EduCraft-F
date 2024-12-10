document.addEventListener('DOMContentLoaded', function () {
    fetch('../PHP/MostrarCursos.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            const coursesSection = document.querySelector('.featured-courses');
            coursesSection.innerHTML = ''; // Limpiar contenido previo

            data.forEach(course => {
                const courseCard = document.createElement('div');
                courseCard.classList.add('course-card');

                const img = document.createElement('img');
                img.src = course.ImagenCurso ? `data:image/jpeg;base64,${course.ImagenCurso}` : '../img/placeholder.png';
                img.alt = `Imagen del curso ${course.TituloCurso}`;

                const title = document.createElement('h3');
                title.textContent = course.TituloCurso;

                const description = document.createElement('p');
                description.textContent = `Calificación (${course.PromedioCalificacion}%)`;

                const button = document.createElement('a');
                button.classList.add('course-btn', 'btn');
                button.href = `../HTML/ComprarCurso.php?id_curso=${course.Id_Curso}`;
                button.textContent = 'Ver más';

                courseCard.appendChild(img);
                courseCard.appendChild(title);
                courseCard.appendChild(description);
                courseCard.appendChild(button);

                coursesSection.appendChild(courseCard);
            });
        })
        .catch(error => console.error('Error al cargar los cursos:', error));
});
