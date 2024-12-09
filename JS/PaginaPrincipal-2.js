//Cargar Las categorias en el cb
document.addEventListener("DOMContentLoaded", function() {
        const categorySelect = document.getElementById("categorySelect");

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
