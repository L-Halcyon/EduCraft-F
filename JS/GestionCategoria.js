//Validacion de campos vacíos
    document.getElementById("formAgregarCategoria").addEventListener("submit", function (event) {
        const nombre = document.getElementById("nombreCategoria").value.trim();
        const descripcion = document.getElementById("descripcionCategoria").value.trim();

        if (!nombre || !descripcion) {
            event.preventDefault(); 
            alert("Por favor, llena todos los campos.");
        }
    });



    // Función para cargar las categorías
    function cargarCategorias() {
        $.ajax({
            url: '../PHP/ObtenerCategorias.php', 
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var tbody = $('#tablaCategorias');
                tbody.empty(); 
    
                if (data.length > 0) {
                    data.forEach(function(categoria) {
                        var row = `
                            <tr>
                                <td>${categoria.Nombre}</td>
                                <td>${categoria.Descripcion}</td>
                                <td>${categoria.UsuarioCreador}</td>
                                <td>${categoria.FechaCreacion}</td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#modalEditarCategoria" onclick="editarCategoria(${categoria.Id_Categoria}, '${categoria.Nombre}', '${categoria.Descripcion}')">Editar</button>
                                        <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion(${categoria.Id_Categoria})">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                } else {
                    tbody.append('<tr><td colspan="5" class="text-center">No hay categorías disponibles.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); 
                alert('Error al cargar las categorías.');
            }
        });
    }

    $(document).ready(function() {
        cargarCategorias();
    });



    function editarCategoria(id, nombre, descripcion) {
        $('#editarIdCategoria').val(id);
        $('#editarNombreCategoria').val(nombre);
        $('#editarDescripcionCategoria').val(descripcion);
    }

    $('#formEditarCategoria').on('submit', function(event) {
        event.preventDefault();
        
        const nombre = $('#editarNombreCategoria').val().trim();
        const descripcion = $('#editarDescripcionCategoria').val().trim();
        const idCategoria = $('#editarIdCategoria').val();

        if (!nombre || !descripcion) {
            alert("Por favor, llena todos los campos.");
            return;
        }

        $.ajax({
            url: '../PHP/ModificarCategoria.php', 
            type: 'POST',
            data: {
                idCategoria: idCategoria,
                nombreCategoria: nombre,
                descripcionCategoria: descripcion
            },
            success: function(response) {
                alert('Categoría modificada correctamente.');
                $('#modalEditarCategoria').modal('hide');
                cargarCategorias(); 
            },
            error: function(xhr, status, error) {
                alert('Error al modificar la categoría.');
                console.log(xhr.responseText);
            }
        });
    });


    // Función para confirmar la eliminación de una categoría
    function confirmarEliminacion(idCategoria) {
        if (confirm("¿Estás seguro de que deseas eliminar esta categoría?")) {
            eliminarCategoria(idCategoria);
        }
    }

    // Función para eliminar la categoría
function eliminarCategoria(idCategoria) {
    $.ajax({
        url: '../PHP/EliminarCategoria.php',  
        type: 'POST',
        data: { idCategoria: idCategoria },
        success: function(response) {
            console.log("Respuesta del servidor:", response);  
            
            if (response.success) {
                alert("Categoría eliminada correctamente.");
                cargarCategorias(); 
            } else {
                alert("Error al eliminar la categoría: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); 
            alert("Hubo un error al intentar eliminar la categoría.");
        }
    });
}
