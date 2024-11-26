<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/PaginaPrincipal-2.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-brown">
        <a class="navbar-brand font-weight-bold text-brown" href="../PHP/PaginaPrincipal-2.php">
            <h1>EduCraft</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-brown" href="../PHP/Busqueda.php">Buscar cursos</a>
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

        <!-- Main Content -->
        <main class="container my-5">
            <h1 class="text-center mb-4">Buscar cursos</h1>
            <form class="search-form mb-5">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tituloCurso">Título del Curso</label>
                        <input type="text" class="form-control" id="tituloCurso" placeholder="Título del Curso">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="instructor">Instructor</label>
                        <input type="text" class="form-control" id="instructor" placeholder="Instructor">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="fechaDesde">Fecha de Publicación (Desde)</label>
                        <input type="date" class="form-control" id="fechaDesde">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fechaHasta">Fecha de Publicación (Hasta)</label>
                        <input type="date" class="form-control" id="fechaHasta">
                    </div>
                    <div class="form-group col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-block">Buscar curso(s)</button>
                    </div>
                </div>
            </form>

    <main class="container">
        <section class="course-categories text-center">
            <h2>Categorías de cursos</h2>
            <p>Explore nuestros cursos mejor calificados en varias categorías.</p>
            <div class="categories-container">
                <button class="category-item btn">IT & Software<br><span>Explora cursos de programación, ciberseguridad y más.</span></button>
                <button class="category-item btn">Marketing<br><span>Aprenda marketing digital, redes sociales y más.</span></button>
                <button class="category-item btn">Negocio<br><span>Mejora tus habilidades empresariales con nuestros cursos.</span></button>
                <button class="category-item btn">Diseño<br><span>Explore cursos de diseño gráfico, UX/UI y más.</span></button>
                <button class="category-item btn">Desarrollo personal<br><span>Potencia tu crecimiento personal y profesional.</span></button>
                <button class="category-item btn">Salud y Fitness<br><span>Mejora tu salud y bienestar con nuestros cursos.</span></button>
            </div>
        </section>
        <a href="#" class="all-courses-btn">Ver todos los cursos disponibles</a>

        <section class="featured-courses">
            <div class="course-card">
                <img src="../img/Diseño-Web.jpg" alt="Curso de Diseño Web">
                <h3>Curso de Diseño Web</h3>
                <p>Calificación (100%)</p>
                <a class="course-btn btn" href="../PHP/ComprarCurso.php">Ver más</a>
            </div>
            <div class="course-card">
                <img src="../img/Bootstrap.png" alt="Aprende a usar Bootstrap">
                <h3>Aprende a usar Bootstrap</h3>
                <p>Calificación (98%)</p>
                <a class="course-btn btn" href="#">Ver más</a>
            </div>
            <div class="course-card">
                <img src="../img/Unreal-Engine.png" alt="Aprende a usar Unreal Engine">
                <h3>Aprende a usar Unreal Engine</h3>
                <p>Calificación (98%)</p>
                <a class="course-btn btn" href="#">Ver más</a>
            </div>
            
        </section>
    </main>

    <footer>
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
