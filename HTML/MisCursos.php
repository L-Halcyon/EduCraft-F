<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Cursos - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../CSS/MisCursos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-brown">
        <a class="navbar-brand font-weight-bold text-brown" href="../HTML/CrearCurso.php">
            <h1>EduCraft</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-brown" href="../HTML/CrearCurso.php">Crear curso</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-brown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Usuario Instructor
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../HTML/EditarUsuario-Instructor.php">Perfil</a>
                        <a class="dropdown-item" href="../HTML/MisCursos.php">Mis cursos y Certificados</a>
                        <a class="dropdown-item" href="../HTML/ChatCursoInicio.php">Mensajes</a>
                        <a class="dropdown-item" href="../HTML/Ventas.php">Ventas</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../HTML/PaginaPrincipal.php">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-5">
        <!-- Sección Mis Cursos -->
        <h1 class="text-center mb-4">Mis Cursos</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="course-card">
                    <h3>Curso de Marketing Digital</h3>
                    <p>Calificación (95%)</p>
                    <button class="btn btn-danger mt-2">Dar de baja</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="course-card">
                    <h3>Curso de Programación en Python</h3>
                    <p>Calificación (90%)</p>
                    <button class="btn btn-danger mt-2">Dar de baja</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="course-card">
                    <h3>Curso de Diseño Web</h3>
                    <p>Calificación (100%)</p>
                    <button class="btn btn-danger mt-2">Dar de baja</button>
                </div>
            </div>
        </div>

        <!-- Sección Certificados -->
        <section class="certificados-section">
            <h2 class="text-center mb-4">Generar Certificados</h2>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Estudiante</th>
                            <th>Progreso</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Curso de Diseño Web</td>
                            <td>Juan Pérez</td>
                            <td>100%</td>
                            <td>
                                <button class="btn btn-success">Generar Certificado</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Curso de Marketing Digital</td>
                            <td>Maria López</td>
                            <td>100%</td>
                            <td>
                                <button class="btn btn-success">Generar Certificado</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="../scripts/MisCursos.js"></script>
    <!-- Archivo JS personalizado -->
    <script src="../JS/UsuarioLogueado-1.js"></script>
</body>

</html>
