<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/Ventas.css">
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

    <!-- Filters Section -->
    <section class="container filters-section mt-4">
        <h2 class="text-center">Reportes de Ventas</h2>
        <div class="row">
            <div class="col-md-4">
                <label for="fechaInicio">Fecha inicio:</label>
                <input type="date" class="form-control" id="fechaInicio">
            </div>
            <div class="col-md-4">
                <label for="fechaFin">Fecha fin:</label>
                <input type="date" class="form-control" id="fechaFin">
            </div>
            <div class="col-md-4">
                <label for="categoria">Categoría:</label>
                <select class="form-control" id="categoria">
                <option value="" disabled selected>Seleccione una categoría</option>

                    
                </select>
            </div>
        </div>
        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="cursosActivos">
            <label class="form-check-label" for="cursosActivos">Solo cursos activos</label>
        </div>
        <button id="filtrarBtn" class="btn btn-primary mt-3">Filtrar</button>
    </section>

    <!-- Ventas por Curso Section -->
    <section class="container mt-4" id="ventasCurso">
        <h3 class="text-center">Ventas por Curso</h3>
        <table class="table table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Alumnos Inscritos</th>
                    <th>Nivel Promedio Cursado</th>
                    <th>Ingresos Totales</th>
                </tr>
            </thead>
            <tbody id="cursosTableBody">
                <tr>
                    <td>Curso de Diseño Web</td>
                    <td>50</td>
                    <td>2</td>
                    <td>$1,500.00</td>
                </tr>
                <tr>
                    <td>Curso de Marketing Digital</td>
                    <td>35</td>
                    <td>1.5</td>
                    <td>$1,250.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total de Ingresos (desglosado por forma de pago):</th>
                    <th id="totalIngresos">$2,750.00</th>
                </tr>
            </tfoot>
        </table>
    </section>

    <!-- Detalle de Ventas por Alumno Section -->
    <section class="container mt-4" id="detalleCurso">
        <h3 class="text-center">Detalle de Ventas por Alumno</h3>
        <table class="table table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Nombre del Alumno</th>
                    <th>Fecha de Inscripción</th>
                    <th>Nivel de Avance</th>
                    <th>Forma de Pago</th>
                    <th>Precio Pagado</th>
                </tr>
            </thead>
            <tbody id="detalleTableBody">
                <tr>
                    <td>Curso de Diseño Web</td>
                    <td>Juan Pérez</td>
                    <td>12 Ene 2024</td>
                    <td>2</td>
                    <td>Tarjeta</td>
                    <td>$300.00</td>
                </tr>
                <tr>
                    <td>Curso de Diseño Web</td>
                    <td>Ana Gómez</td>
                    <td>15 Feb 2024</td>
                    <td>3</td>
                    <td>Paypal</td>
                    <td>$450.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total de Ingresos del Curso:</th>
                    <th id="totalIngresosCurso">$750.00</th>
                </tr>
            </tfoot>
        </table>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Archivo JS personalizado -->
    <script src="../JS/UsuarioLogueado-1.js"></script>

    <script src="../JS/Ventas.js"></script>
</body>

</html>
