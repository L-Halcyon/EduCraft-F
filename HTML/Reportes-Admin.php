<?php
require_once '../PHP/Conexion.php';

try {
    $conexion = new Conexion();
    
    $pdo = $conexion->obtenerConexion();
    
    $stmt = $pdo->prepare("CALL ObtenerReporteInstructores()");
    $stmt->execute();
    
    $instructores = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $instructores[] = $row; 
    }

    
    if (empty($instructores)) {
        $error_message = "No se encontraron instructores.";
    }




    $stmt = $pdo->prepare("CALL ObtenerReporteEstudiantes()");
    $stmt->execute();
    
    $estudiantes = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $estudiantes[] = $row; 
    }
    
    if (empty($estudiantes)) {
        $error_message = "No se encontraron estudiantes.";
    }

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>
    <link rel="icon" href="../img/Logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/Reportes-Admin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-brown">
        <a class="navbar-brand font-weight-bold text-brown" href="#">
            <h1>EduCraft Admin</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-brown" href="../HTML/DesbloqueoUsuarios.php">Desbloqueo de Usuarios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-brown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario Admin
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../HTML/EditarUsuario-Admin.php">Perfil</a>
                        <!--<a class="dropdown-item" href="../HTML/EliminarComentarios.php">Comentarios</a>-->
                        <a class="dropdown-item" href="../HTML/Categorias-Admin.php">Gestion de categorias</a>
                        <a class="dropdown-item" href="../HTML/Reportes-Admin.php">Reporte de Usuarios</a>

                        <a class="dropdown-item" href="../HTML/PaginaPrincipal.php">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
    <h1 class="text-center">Reporte de Usuarios</h1>

    <!-- Tabla de instructores -->
    <div class="table-responsive mt-4">
    <h2 class="text-center">Instructores</h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Fecha de Ingreso</th>
                <th>Cursos Ofrecidos</th>
                <th>Total de Ganancias</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($error_message)) {
                echo "<tr><td colspan='5' class='text-center'>$error_message</td></tr>";
            } else {
                foreach ($instructores as $instructor) {
                    echo "<tr>";
                    echo "<td>{$instructor['Usuario']}</td>";
                    echo "<td>{$instructor['Nombre']}</td>";
                    echo "<td>{$instructor['FechaIngreso']}</td>";
                    echo "<td>{$instructor['CursosOfrecidos']}</td>";
                    echo "<td>{$instructor['TotalGanancias']}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>


       <!-- Tabla de estudiantes -->
        <div class="table-responsive mt-4">
            <h2 class="text-center">Estudiantes</h2>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Fecha de Ingreso</th>
                        <th>Cursos Inscritos</th>
                        <th>Porcentaje de Cursos Terminados</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($error_message)) {
                        echo "<tr><td colspan='5' class='text-center'>$error_message</td></tr>";
                    } else {
                        foreach ($estudiantes as $estudiante) {
                            echo "<tr>";
                            echo "<td>{$estudiante['Usuario']}</td>";
                            echo "<td>{$estudiante['Nombre']}</td>";
                            echo "<td>{$estudiante['FechaIngreso']}</td>";
                            echo "<td>{$estudiante['CursosInscritos']}</td>";
                            echo "<td>" . number_format($estudiante['PorcentajeCursosTerminados'], 2) . "%</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

            <!-- Footer -->
    <footer class="text-center py-4">
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script para cargar el nombre del usuario -->
    <script src="../JS/UsuarioLogueado-1.js"></script>
</body>
</html>
