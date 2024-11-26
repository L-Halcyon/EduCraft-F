<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Curso - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/CrearCurso.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-brown">
        <a class="navbar-brand font-weight-bold text-brown" href="/HTML/CrearCurso.php">
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
                        Brian Barrero
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../HTML/EditarUsuario-Instructor.php">Perfil</a>
                        <a class="dropdown-item" href="../HTML/MisCursos.php">Mis cursos y Certificados</a>
                        <a class="dropdown-item" href="../HTML/Mensajeria-Instructor.php">Mensajes</a>
                        <a class="dropdown-item" href="../HTML/Ventas.php">Ventas</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../HTML/PaginaPrincipal.php">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="container my-4">
        <h2 class="text-center">Crear Curso</h2>

        <!-- Formulario de Curso -->
        <form id="form-crear-curso">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tituloCurso">Título del curso</label>
                    <input type="text" class="form-control" id="tituloCurso" placeholder="Título del curso" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="imagenCurso">Imagen del curso</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imagenCurso" required>
                        <label class="custom-file-label" for="imagenCurso">Seleccionar archivo</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="descripcionCurso">Descripción general del curso</label>
                    <textarea class="form-control no-resize" id="descripcionCurso" rows="3" required></textarea>
                </div>
                <div class="form-group col-md-3">
                    <label for="costoCurso">Costo del curso completo</label>
                    <input type="text" class="form-control" id="costoCurso" placeholder="Costo" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="cantidadNiveles">Cantidad de niveles</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="cantidadNiveles" value="1" min="1">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="btn-crear-niveles">Crear niveles</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenedor para los Niveles -->
            <div id="niveles-container"></div>

            <!-- Botón para crear el curso -->
            <button type="submit" class="btn btn-primary btn-block mt-4" style="max-width: 200px; margin: 0 auto;">Crear curso</button>
        </form>
    </main>

    <!-- Footer -->
    <footer class="text-center mt-4">
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Archivo JS personalizado -->
    <script src="../JS/CrearCurso.js"></script>
</body>
</html>
