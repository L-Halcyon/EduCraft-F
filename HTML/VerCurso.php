<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Curso - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../CSS/VerCurso.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


</head>
<body class="bg-light-brown">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-brown">
        <a class="navbar-brand font-weight-bold text-brown" href="../HTML/PaginaPrincipal-2.php">
            <h1>EduCraft</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-brown" href="../HTML/Busqueda.php">Buscar cursos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-brown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario Estudiante
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../HTML/EditarUsuario.php">Perfil</a>
                        <a class="dropdown-item" href="../HTML/Kardex.php">Kardex</a>
                        <a class="dropdown-item" href="../HTML/ChatCursoInicio.php">Mensajes</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../HTML/PaginaPrincipal.php">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5" id="curso-container">
        <!-- Aquí se cargarán los datos del curso y niveles mediante JavaScript -->
    </div>
    <!--<div class="container mt-5">
        <div class="course-header text-center">
            <h1>Curso de Diseño Web</h1>
            <img src="../img/Diseño-Web.jpg" alt="Imagen del curso" class="img-fluid">
            <p class="mt-3 text-left course-description">Aprende a crear sitios web atractivos y funcionales con nuestro curso de Diseño Web. Domina el diseño responsive, la experiencia del usuario y las herramientas actuales para transformar tus ideas en interfaces impactantes.</p>
        </div>

        <!- Course Levels ->
        <div class="mt-4">
            <h2 class="text-brown">Niveles del curso</h2>

            <!- Nivel 1 ->
            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="level-title">Nivel 1: Introducción al Diseño Web</h3>
                    <p>En este nivel aprenderás los fundamentos básicos del diseño web, incluyendo HTML y CSS.</p>

                    <!- Video obligatorio ->
                    <div class="video-container">
                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <!- Contenido adicional en dos columnas ->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <p>Archivos adjuntos:</p>
                            <a href="https://example.com/archivo.pdf" class="btn btn-outline-secondary">Descargar PDF</a>
                        </div>
                        <div class="col-md-6">
                            <p>Recursos adicionales:</p>
                            <a href="https://www.example.com" class="btn btn-outline-secondary">Visitar página externa</a>
                        </div>
                    </div>

                    <!- Imágenes en dos columnas ->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <p>Imagen de referencia:</p>
                            <img src="../img/Diseño-Web-contenido.jpg" alt="Imagen del nivel" class="img-fluid mt-2">
                        </div>
                        <div class="col-md-6">
                            <p>Imagen de referencia:</p>
                            <img src="../img/Diseño-Web-contenido-2.jpg" alt="Imagen del nivel" class="img-fluid mt-2">
                        </div>
                    </div>

                    <!- Texto adicional ->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <p>Aquí puedes agregar texto adicional sobre el nivel o cualquier detalle relevante que quieras destacar.</p>
                        </div>
                    </div>

                    <!- Checkbox de nivel completado ->
                    <div class="mt-3">
                        <input type="checkbox" id="nivel1-completado">
                        <label for="nivel1-completado">Marcar como completado</label>
                    </div>
                </div>
            </div>

            <!- Nivel 2 ->
            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="level-title">Nivel 2: Diseño Responsive</h3>
                    <p>Este nivel cubre el diseño adaptativo para dispositivos móviles y técnicas avanzadas de CSS. Serás capaz de crear sitios que se ajusten a diferentes tamaños de pantalla.</p>
                    <div class="video-container">
                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="mt-3">
                        <input type="checkbox" id="nivel2-completado">
                        <label for="nivel2-completado">Marcar como completado</label>
                    </div>
                </div>
            </div>

            <!- Nivel 3 ->
            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="level-title">Nivel 3: Interactividad con JavaScript</h3>
                    <p>En el último nivel, aprenderás a agregar interactividad a tus sitios web utilizando JavaScript. También veremos cómo integrar frameworks populares como Bootstrap.</p>
                    <div class="video-container">
                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="mt-3">
                        <input type="checkbox" id="nivel3-completado">
                        <label for="nivel3-completado">Marcar como completado</label>
                    </div>
                </div>
            </div>
        </div>

            <!- Course Certificate ->
            <div class="mt-5">
                <h2 class="text-brown">Certificado</h2>
                <p>Una vez que completes todos los niveles del curso, recibirás un certificado con tu nombre y la fecha de finalización.</p>
                <a href="../HTML/diploma.php" class="btn btn-success">Ver certificado</a>
            </div>

    </div>-->

    <!-- Footer -->
    <footer class="text-center mt-5 p-3 bg-brown text-brown">
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Archivo JS personalizado -->
        <script src="../JS/VerCurso.js"></script>
        <script src="../JS/UsuarioLogueado-1.js"></script>
</body>
</html>
