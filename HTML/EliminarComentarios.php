<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Comentarios - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/EliminarComentarios.css">
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
                    Usuario Admin
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

    <!-- Filtros de Categoría y Curso -->
    <section class="container mt-4">
        <h2 class="text-center">Gestión de Comentarios Ofensivos</h2>
        <div class="row">
            <div class="col-md-6">
                <label for="categoria">Categoría:</label>
                <select class="form-control" id="categoria">
                    <option value="todas">Todas</option>
                    <option value="IT">IT & Software</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Negocio">Negocio</option>
                    <option value="Diseño">Diseño</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="curso">Curso:</label>
                <select class="form-control" id="curso">
                    <option value="todos">Todos</option>
                    <option value="diseño-web">Curso de Diseño Web</option>
                    <option value="marketing-digital">Marketing Digital</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary mt-3">Filtrar</button>
    </section>

    <!-- Tabla de Comentarios -->
    <section class="container mt-4">
        <h3 class="text-center">Comentarios de Usuarios</h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Comentario</th>
                    <th>Fecha de Creación</th>
                    <th>Calificación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Juan Pérez</td>
                    <td>Me encantó el curso, muy completo.</td>
                    <td>12 Sep 2024, 15:30</td>
                    <td><span class="text-success font-weight-bold">Me gusta</span></td>
                    <td>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-username="Juan Pérez">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>Ana Gómez</td>
                    <td>El contenido está desactualizado.</td>
                    <td>10 Sep 2024, 09:15</td>
                    <td><span class="text-danger font-weight-bold">No me gusta</span></td>
                    <td>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-username="Ana Gómez">Eliminar</button>
                    </td>
                </tr>
                <tr class="eliminado">
                    <td>Felix Nieto</td>
                    <td colspan="2" class="text-center">Este mensaje ha sido eliminado</td>
                    <td colspan="1"><span class="text-danger font-weight-bold">No me gusta</span></td>
                    <td>Eliminado (13 Sep 2024, 12:45)</td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Modal para Confirmar Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Comentario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="deleteReason">Razón para eliminar el comentario:</label>
                            <textarea class="form-control no-resize"  id="deleteReason" rows="3" placeholder="Escribe la razón aquí..."></textarea>
                        </div>
                        <input type="hidden" id="usernameToDelete">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Footer -->
        <footer class="text-center py-4">
            <p>© 2024 EduCraft. Todos los derechos reservados.</p>
        </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script para cargar el nombre del usuario -->
    <script src="../JS/UsuarioLogueado-1.js"></script>

</body>
</html>
