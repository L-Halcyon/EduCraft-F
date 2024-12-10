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
        <form class="search-form mb-5" id="filterForm">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="tituloCurso">Título del Curso</label>
                    <input type="text" class="form-control" id="tituloCurso" name="titulo">
                </div>
                <div class="form-group col-md-4">
                    <label for="instructor">Instructor</label>
                    <input type="text" class="form-control" id="instructor" name="instructor">
                </div>
                <div class="form-group col-md-4">
                    <label for="categorySelect">Categoría</label>
                    <select id="categorySelect" class="form-control" name="categoria">
                        <option value="">Ninguna</option>
                        <!-- Opciones dinámicas desde la base de datos -->
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="fechaDesde">Fecha Desde</label>
                    <input type="date" class="form-control" id="fechaDesde" name="fecha_desde">
                </div>
                <div class="form-group col-md-4">
                    <label for="fechaHasta">Fecha Hasta</label>
                    <input type="date" class="form-control" id="fechaHasta" name="fecha_hasta">
                </div>
                <div class="form-group col-md-4">
                    <label for="filterOption">Filtros</label>
                    <select id="filterOption" class="form-control" name="filtro">
                        <option value="">Todos los cursos</option>
                        <option value="mas_vendidos">Los más vendidos</option>
                        <option value="mas_recientes">Los más recientes</option>
                        <option value="mejor_calificados">Los mejores calificados</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary btn-block" id="searchButton">Buscar cursos</button>
                </div>
            </div>
        </form>

        <section id="coursesContainer" class="featured-courses mt-5">
            <!-- Aquí se mostrarán los resultados en cards -->
        </section>
    </main>

    <footer>
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../JS/BuscarCursos.js"></script>
</body>
</html>
