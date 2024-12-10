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
                    <a class="nav-link text-brown" href="../HTML/Busqueda.php">Buscar cursos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-brown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuario Estudiante
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
                        <label for="tituloCurso">Curso disponibles:</label>
                        <select id="cursoSelect" class="form-control">
                        <option value="">Ninguna</option>
                    </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="instructor">Instructores:</label>
                        <select id="instructorSelect" class="form-control">
                        <option value="">Ninguna</option>
                    </select>
                    </div>

                    <div class="form-group col-md-4">
                    <label for="categorySelect">Categoría:</label>
                    <select id="categorySelect" class="form-control">
                        <option value="">Ninguna</option>
                    </select>
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
    <div class="container">
        <div class="row align-items-center">
            <!-- Segundo combo box -->
            <div class="col-md-6">
                <div class="category-select mt-4">
                    <label for="subcategorySelect">Seleccione un filtro:</label>
                    <select id="subcategorySelect" class="form-control">
                        <option value="">Todos los cursos</option>
                        <option value="">Los más vendidos</option>
                        <option value="">Los más recientes</option>
                        <option value="">Los mejores calificados</option>
                    </select>
                </div>
            </div>
        </div>
    </div>


    </section>

    <section class="featured-courses mt-5">

</section>

    </main>

    <footer>
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Archivo JS personalizado -->
    <script src="../JS/UsuarioLogueado-1.js"></script>
    <script src="../JS/PaginaPrincipal-2.js"></script>
    <script src="../JS/MostrarCursos.js"></script>


</body>
</html>
