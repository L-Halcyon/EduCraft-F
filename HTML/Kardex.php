<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kardex de Cursos - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Archivo CSS personalizado -->
    <link rel="stylesheet" href="../CSS/Kardex.css">
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

    <div class="container my-4">
        <div id="messages" class="alert mt-3" style="display: none;"></div>
        <h2>Kardex de Cursos</h2>
        <p>Visualiza tu progreso en los cursos registrados.</p>

        <!-- Filtros -->
        <!--<div class="filters mb-4">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="start-date">Fecha de Inicio:</label>
                    <input type="date" class="form-control" id="start-date">
                </div>
                <div class="form-group col-md-3">
                    <label for="end-date">Fecha de Fin:</label>
                    <input type="date" class="form-control" id="end-date">
                </div>
                <div class="form-group col-md-3">
                    <label for="category">Categoría:</label>
                    <select id="category" class="form-control">
                        <option>Todas</option>
                        <option>Desarrollo Web</option>
                        <option>Animación</option>
                        <option>UI/UX</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="completed-courses">
                        <label class="form-check-label" for="completed-courses">Solo terminados</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="active-courses">
                        <label class="form-check-label" for="active-courses">Solo activos</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">Buscar</button>
        </div>-->

        <!-- Tabla Kardex -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Fecha de Inscripción</th>
                    <th>Último Acceso</th>
                    <th>Fecha de Finalización</th>
                    <th>Estado</th>
                    <th>Progreso</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <!--<tr>
                    <td>Curso de Diseño Web</td>
                    <td>12/01/2024</td>
                    <td>25/03/2024</td>
                    <td>10/05/2024</td>
                    <td>Completado</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 100%;"></div>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="../HTML/VerCurso.php">Ver Curso</a>
                    </td>
                </tr>
                <tr>
                    <td>Aprende a usar Bootstrap</td>
                    <td>14/02/2024</td>
                    <td>20/04/2024</td>
                    <td>Incompleto</td>
                    <td>Activo</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 60%;"></div>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm">Ver Curso</a>
                    </td>
                </tr>
                <!- Fila para curso completado con opción de calificación ->
                <tr>
                    <td>Aprende a usar Unreal Engine</td>
                    <td>01/03/2024</td>
                    <td>05/09/2024</td>
                    <td>25/09/2024</td>
                    <td>Completado</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 100%;"></div>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm">Ver Curso</a>
                    </td>
                </tr>-->

            </tbody>
        </table>

        <!-- Calificar Curso -->
        <div class="rate-course mt-4">
            <h4>Califica el Curso</h4>
            <div class="rating-section">
                <h5>Curso de Diseño Web</h5>
                <textarea class="form-control mb-2" rows="4" placeholder="Escribe tu comentario aquí..."></textarea>
                <button class="btn btn-outline-success" onclick="selectRating(this)"><span>&#128077;</span> Me Gusta</button>
                <button class="btn btn-outline-danger" onclick="selectRating(this)"><span>&#128078;</span> No Me Gusta</button>
                <button class="btn btn-primary mt-2">Enviar Comentario</button>
            </div>

            <div class="rating-section mt-4">
                <h5>Aprende a usar Unreal Engine</h5>
                <textarea class="form-control mb-2" rows="4" placeholder="Escribe tu comentario aquí..."></textarea>
                <button class="btn btn-outline-success" onclick="selectRating(this)"><span>&#128077;</span> Me Gusta</button>
                <button class="btn btn-outline-danger" onclick="selectRating(this)"><span>&#128078;</span> No Me Gusta</button>
                <button class="btn btn-primary mt-2">Enviar Comentario</button>
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
    <script src="../JS/Kardex.js"></script>
    <script src="../JS/UsuarioLogueado-1.js"></script>

</body>
</html>
