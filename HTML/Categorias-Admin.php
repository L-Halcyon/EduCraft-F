<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Categorías - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/Categorias-Admin.css"> <!-- Enlace al archivo CSS externo -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-brown">
        <a class="navbar-brand font-weight-bold text-brown" href="#">
            <h1>EduCraft Admin</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-brown" href="../HTML/DesbloqueoUsuarios.php">Desbloqueo de Usuarios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-brown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Elisa Ponce
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../HTML/EditarUsuario-Admin.php">Perfil</a>
                        <a class="dropdown-item" href="../HTML/EliminarComentarios.php">Comentarios</a>
                        <a class="dropdown-item" href="../HTML/Categorias-Admin.php">Gestion de categorias</a>
                        <a class="dropdown-item" href="../HTML/Reportes-Admin.php">Reporte de Usuarios</a>

                        <a class="dropdown-item" href="../HTML/PaginaPrincipal.php">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Gestión de Categorías -->
    <div class="container mt-5">
        <h1 class="text-center">Gestión de Categorías</h1>
        <button class="btn btn-custom mb-4" data-toggle="modal" data-target="#modalAgregarCategoria">Agregar Categoría</button>
        
        <!-- Tabla de Categorías -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Creado por</th>
                    <th>Fecha de creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ejemplo de categorías -->
                <tr>
                    <td>Desarrollo Web</td>
                    <td>Cursos relacionados con programación web.</td>
                    <td>Elisa Ponce</td>
                    <td>2024-09-13 10:00 AM</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#modalEditarCategoria">Editar</button>
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Diseño Gráfico</td>
                    <td>Cursos para aprender diseño visual y herramientas.</td>
                    <td>Rogelio Maza</td>
                    <td>2024-09-13 11:30 AM</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#modalEditarCategoria">Editar</button>
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal para Agregar Categoría -->
    <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="modalAgregarCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarCategoriaLabel">Agregar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nombreCategoria">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="nombreCategoria" placeholder="Ingresa el nombre">
                        </div>
                        <div class="form-group">
                            <label for="descripcionCategoria">Descripción</label>
                            <textarea class="form-control no-resize" id="descripcionCategoria" rows="3" placeholder="Descripción de la categoría"></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal para Editar Categoría -->
    <div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="modalEditarCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarCategoriaLabel">Editar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="editarNombreCategoria">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="editarNombreCategoria" placeholder="Ingresa el nombre">
                        </div>
                        <div class="form-group">
                            <label for="editarDescripcionCategoria">Descripción</label>
                            <textarea class="form-control no-resize" id="editarDescripcionCategoria" rows="3" placeholder="Descripción de la categoría"></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4">
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
