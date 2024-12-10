//Hacer la solicitud al backend para que traiga las tablas 
document.addEventListener("DOMContentLoaded", () => {
    const vendedorId = sessionStorage.getItem("idUsuario");

    const cursosTableBody = document.getElementById("cursosTableBody");
    const totalIngresosCell = document.getElementById("totalIngresos");

    const detalleTableBody = document.getElementById("detalleTableBody");
    const totalIngresosCurso = document.getElementById("totalIngresosCurso");

    // Fetch para ventas normales
    fetch(`../PHP/obtenerVentasVendedor.php?vendedorId=${vendedorId}`)
    .then((response) => response.json())
    .then((data) => {
        console.log("Datos recibidos (ventas normales):", data);

        cursosTableBody.innerHTML = "";

        data.cursos.forEach((curso) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${curso.Curso}</td>
                <td>${curso.AlumnosInscritos}</td>
                <td>${curso.NivelPromedioCursado}</td>
                <td>$${curso.IngresosTotales.toFixed(2)}</td>
            `;
            cursosTableBody.appendChild(row);
        });

        totalIngresosCell.textContent = `$${parseFloat(data.totalIngresos).toFixed(2)}`;
    })
    .catch((error) => console.error("Error al obtener datos:", error));


    // Fetch para ventas detalladas
    fetch(`../PHP/obtenerVentasVendedor.php?vendedorId=${vendedorId}`)
    .then(response => response.json())
    .then(data => {
        console.log("Datos recibidos (ventas detalladas):", data);

        detalleTableBody.innerHTML = "";

        let totalIngresos = 0;

        data.ventaDetallada.forEach(detalle => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${detalle.Curso}</td>
                <td>${detalle.Alumno}</td>
                <td>${new Date(detalle.FechaInscripcion).toLocaleDateString()}</td>
                <td>${detalle.NivelAvance}</td>
                <td>${detalle.MetodoPago}</td>
                <td>$${parseFloat(detalle.MontoPagado).toFixed(2)}</td>
            `;

            detalleTableBody.appendChild(row);

            totalIngresos += parseFloat(detalle.MontoPagado);
        });

        totalIngresosCurso.textContent = `$${totalIngresos.toFixed(2)}`;
    })
    .catch(error => console.error("Error al obtener datos:", error));

});



//Mostrar las categorias en el cb 

//Cargar Las categorias en el cb
document.addEventListener("DOMContentLoaded", function() {
    const categorySelect = document.getElementById("categoria");

    // Cargar las categorías desde el servidor
    fetch("../PHP/ObtenerCategorias.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(categoria => {
                const option = document.createElement("option");
                option.value = categoria.Id_Categoria;
                option.textContent = categoria.Nombre;
                categorySelect.appendChild(option);
            });
        })
        .catch(error => console.error("Error al cargar las categorías:", error));
});




//Filtros para ventas
document.addEventListener("DOMContentLoaded", function () {
    const fechaInicio = document.getElementById("fechaInicio");
    const fechaFin = document.getElementById("fechaFin");
    const categoria = document.getElementById("categoria");
    const cursosActivos = document.getElementById("cursosActivos");
    const filtrarBtn = document.getElementById("filtrarBtn");

    const vendedorId = sessionStorage.getItem("idUsuario");


    function obtenerCursosFiltrados() {
        const params = new URLSearchParams();
        
        if (fechaInicio.value) {
            params.append("fechaInicio", fechaInicio.value);
        }
        
        if (fechaFin.value) {
            params.append("fechaFin", fechaFin.value);
        }
        
        if (categoria.value) {
            params.append("categoria", categoria.value);
        }
        
        if (cursosActivos.checked) {
            params.append("estatusCurso", "Activo");
        }

        if (vendedorId) {
            params.append("vendedorId", vendedorId);
        }

        fetch(`../PHP/obtenerVentasCursosFiltrados.php?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                if (data.cursos && data.cursos.length > 0) {
                    mostrarCursos(data.cursos); 
                } else {
                    alert("No se encontraron cursos con los filtros seleccionados.");
                }
            })
            .catch(error => {
                console.error("Error al obtener los cursos:", error);
                alert("Hubo un error al filtrar los cursos.");
            });
    }

    filtrarBtn.addEventListener("click", obtenerCursosFiltrados);
    
    function mostrarCursos(cursos) {
        const cursosTableBody = document.getElementById("cursosTableBody");
        cursosTableBody.innerHTML = ""; 

        cursos.forEach(curso => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${curso.Curso}</td>
                <td>${curso.AlumnosInscritos}</td>
                <td>${curso.NivelPromedioCursado}</td>
                <td>$${curso.IngresosTotales.toFixed(2)}</td>
            `;
            cursosTableBody.appendChild(row);
        });
    }
});
