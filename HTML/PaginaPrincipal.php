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
    <link rel="stylesheet" href="../CSS/PaginaPrincipal.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
    <header>
            <a href="../PHP/PaginaPrincipal.php" class="logo-link">
                <h1>EduCraft</h1>
            </a>
        <div class="header-buttons">
            <a href="../HTML/IniciarSesion.php" class="header-btn btn">Iniciar Sesión</a>
            <a href="../HTML/Registro.php" class="header-btn btn">Registrarse</a>
        </div>
    </header>

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

        <a href="#" class="all-courses-btn">Ver todos los cursos disponibles</a>

        <section class="featured-courses">
            <div class="course-card">
                <img src="../img/Diseño-Web.jpg" alt="Curso de Diseño Web">
                <h3>Curso de Diseño Web</h3>
                <p>Calificación (100%)</p>
                <button class="course-btn btn">Ver más</button>
            </div>
            <div class="course-card">
                <img src="../img/Bootstrap.png" alt="Aprende a usar Bootstrap">
                <h3>Aprende a usar Bootstrap</h3>
                <p>Calificación (98%)</p>
                <button class="course-btn btn">Ver más</button>
            </div>
            <div class="course-card">
                <img src="../img/Unreal-Engine.png" alt="Aprende a usar Unreal Engine">
                <h3>Aprende a usar Unreal Engine</h3>
                <p>Calificación (98%)</p>
                <button class="course-btn btn">Ver más</button>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../JS/PaginaPrincipal-2.js"></script>
</body>
</html>
