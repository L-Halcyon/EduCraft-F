<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>
    <link rel="icon" href="../img/Logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/Reportes-Admin.css">
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

    <!-- Contenedor del reporte -->
    <div class="container mt-5">
        <h1 class="text-center">Reporte de Usuarios</h1>

        <!-- Tabla de instructores -->
        <div class="table-responsive mt-4">
            <h2 class="text-center">Instructores</h2>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Fecha de Ingreso</th>
                        <th>Cursos Ofrecidos</th>
                        <th>Total de Ganancias</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>instructor01</td>
                        <td>Juan Pérez</td>
                        <td>2022-06-15</td>
                        <td>5</td>
                        <td>$1000 MXN</td>
                    </tr>
                    <tr>
                        <td>instructor02</td>
                        <td>María López</td>
                        <td>2021-03-25</td>
                        <td>8</td>
                        <td>$1500 MXN</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tabla de estudiantes -->
        <div class="table-responsive mt-5">
            <h2 class="text-center">Estudiantes</h2>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Fecha de Ingreso</th>
                        <th>Cursos Inscritos</th>
                        <th>% Cursos Terminados</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>estudiante01</td>
                        <td>Ana García</td>
                        <td>2023-01-10</td>
                        <td>3</td>
                        <td>67%</td>
                    </tr>
                    <tr>
                        <td>estudiante02</td>
                        <td>Carlos Ruiz</td>
                        <td>2022-09-15</td>
                        <td>5</td>
                        <td>80%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4">
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
