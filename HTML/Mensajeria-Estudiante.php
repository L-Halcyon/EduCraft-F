<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajería Estudiante - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Archivo CSS personalizado -->
    <link rel="stylesheet" href="../CSS/Mensajeria-Estudiante.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
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
                        Fatima Nuñez
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../HTML/EditarUsuario.php">Perfil</a>
                        <a class="dropdown-item" href="../HTML/Kardex.php">Kardex</a>
                        <a class="dropdown-item" href="../HTML/Mensajeria-Estudiante.php">Mensajes</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../HTML/PaginaPrincipal.php">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Encabezado -->
    <header class="container my-4">
        <h2 id="chat-title">Mensajes Privados - Curso de Diseño Web</h2>
        <p>Conversación entre Alumno y Instructor</p>
    </header>

    <div class="container">
        <div class="row">
            <!-- Lista de Instructores / Cursos -->
            <div class="col-md-3">
                <h4>Instructores/Cursos</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="#" class="instructor-link">Brian Barrero - Curso de Diseño Web</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="instructor-link">Nieves Moral - Aprende a usar Bootstrap</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="instructor-link">Felipa Sole - Aprende a usar Unreal Engine</a>
                    </li>
                </ul>
            </div>

            <!-- Contenedor de Mensajes -->
            <div class="col-md-9">
                <div class="message-container">
                    <!-- Mensaje del Alumno -->
                    <div class="message alumno">
                        <img src="../img/Estudiante.jpg" alt="Alumno">
                        <div class="message-content">
                            <p>Hola, tengo una duda sobre el curso.</p>
                            <span class="timestamp">12/09/2024 14:35</span>
                        </div>
                    </div>

                    <!-- Mensaje del Instructor -->
                    <div class="message instructor">
                        <img src="../img/Instructor.jpg" alt="Instructor">
                        <div class="message-content">
                            <p>Claro, ¿cuál es tu duda?</p>
                            <span class="timestamp">12/09/2024 14:37</span>
                        </div>
                    </div>
                </div>

                <!-- Enviar Nuevo Mensaje -->
                <div class="send-message">
                    <textarea class="form-control" rows="3" placeholder="Escribe tu mensaje aquí..."></textarea>
                    <button class="btn btn-send">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Archivo JS personalizado -->
    <script src="../JS/Mensajeria-Estudiante.js"></script>
</body>
</html>
