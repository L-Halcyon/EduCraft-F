<?php 
require_once '../PHP/obtenerInfoCurso.php';

$categorias = obtenerCategorias();
$curso = null;
$tituloCurso = $descripcionCurso = $costoCurso = $base64Imagen = $categoriaCursoId = $categoriaCursoNombre = '';

if (isset($_GET['idCurso'])) {
    $idCurso = intval($_GET['idCurso']);
    $curso = obtenerInformacionCurso($idCurso);

    if ($curso) {
        $tituloCurso = htmlspecialchars($curso['TituloCurso']);
        $descripcionCurso = htmlspecialchars($curso['DescripcionCurso']);
        $costoCurso = htmlspecialchars($curso['CostoCompleto']);
        $base64Imagen = $curso['base64Imagen'];
        $categoriaCursoId = $curso['Id_Categoria'];
        $categoriaCursoNombre = htmlspecialchars($curso['NombreCategoria']);
    } else {
        echo '<p>Curso no encontrado.</p>';
    }
} else {
    echo '<p>No se recibió el idCurso.</p>';
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso - EduCraft</title>
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

    <!-- Contenido Principal -->
    <main class="container my-4">
    <h2 class="text-center">Editar Curso</h2>

    <!-- Formulario de Curso -->
    <form id="form-editar-curso"  action="../PHP/editarCursoBaseDatos.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tituloCurso">Título del curso</label>
                <input type="text" class="form-control" id="tituloCurso" name="tituloCurso" placeholder="Título del curso" value="<?php echo isset($tituloCurso) ? $tituloCurso : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="categoriaCurso">Categoría del curso</label>
                <select class="form-control" id="categoriaCurso" name="categoriaCurso" required>
                    <option value="" disabled>Seleccione una categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option 
                            value="<?php echo $categoria['Id_Categoria']; ?>" 
                            <?php echo $categoriaCursoId == $categoria['Id_Categoria'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($categoria['Nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

      <!-- Aquí viene la imagen del curso -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="imagenCurso">Imagen del curso</label>
                
                <input type="file" class="custom-file-input" id="imagenCurso" name="imagenCurso">
                <label class="custom-file-label" for="imagenCurso">Seleccionar archivo</label>
                
                <!-- Campo oculto para guardar el nombre de la imagen actual -->
                <input type="hidden" id="hiddenImageName" name="hiddenImageName" value="<?php echo htmlspecialchars($imagenCurso); ?>">
            </div>

            <div class="form-group col-md-6">
                <?php if ($base64Imagen): ?>
                    <img src="<?php echo $base64Imagen; ?>" alt="Imagen del curso" class="img-thumbnail mb-2" style="max-width: 350px;">
                <?php else: ?>
                    <p>No hay imagen disponible</p>
                <?php endif; ?>

               

                <div id="imagePreviewContainer" class="mt-3">
                    <img id="imagePreview" src="#" alt="Vista previa de la imagen" style="display: none; max-width: 350px;">
                </div>
            </div>
        </div>

        <input type="hidden" name="idCurso" value="<?php echo isset($curso['Id_Curso']) ? $curso['Id_Curso'] : ''; ?>">




        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="descripcionCurso">Descripción general del curso</label>
                <textarea class="form-control no-resize" id="descripcionCurso" name="descripcionCurso" rows="3" required><?php echo isset($descripcionCurso) ? $descripcionCurso : ''; ?></textarea>
            </div>

            <div class="form-group col-md-3">
                <label for="costoCurso">Costo del curso completo</label>
                <input type="text" class="form-control" id="costoCurso" name="costoCurso" placeholder="Costo" value="<?php echo isset($costoCurso) ? $costoCurso : ''; ?>" required>
            </div>
        </div>

        <!-- Botón para editar el curso -->
        <button type="submit" class="btn btn-primary btn-block mt-4" style="max-width: 200px; margin: 0 auto;">Editar curso</button>
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
    <script src="../JS/EditarCurso.js"></script>
    <script src="../JS/UsuarioLogueado-1.js"></script>
</body>
</html>
