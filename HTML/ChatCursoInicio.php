<?php

include '../PHP/Conexion.php';
session_start();



if (!isset($_SESSION['idUsuario'])) { 
    exit();
}

$id_usuario = $_SESSION['idUsuario']; 
$rol_usuario = $_SESSION['rol_usuario']; 

$conexion = new Conexion();
$conn = $conexion->obtenerConexion(); 

$usuarios = [];

try {
    $id_usuario_int = intval($id_usuario); 

    // Obtener los chats dependiendo del rol
    if ($rol_usuario === 'estudiante') {
        $query = "SELECT c.ID_Chat, u.NombreCompleto AS Profesor
                  FROM Chat c
                  JOIN Usuario u ON c.ID_Profesor = u.Id_Usuario
                  WHERE c.ID_Estudiante = :id_usuario
                  ORDER BY c.FechaInicio DESC";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario_int, PDO::PARAM_INT); 
    } elseif ($rol_usuario === 'profesor') {
        // Para el profesor
        $query = "SELECT c.ID_Chat, u.NombreCompleto AS Estudiante
                  FROM Chat c
                  JOIN Usuario u ON c.ID_Estudiante = u.Id_Usuario
                  WHERE c.ID_Profesor = :id_usuario
                  ORDER BY c.FechaInicio DESC";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario_int, PDO::PARAM_INT);
    } else {
        throw new Exception("Rol de usuario no válido: $rol_usuario");
    }


    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    
    $query_usuarios = "SELECT Id_Usuario, NombreCompleto, Rol FROM Usuario WHERE (Rol = 'profesor' OR Rol = 'estudiante') AND Id_Usuario != :id_usuario";
    $stmt_usuarios = $conn->prepare($query_usuarios);
    $stmt_usuarios->bindParam(':id_usuario', $id_usuario_int, PDO::PARAM_INT);
    $stmt_usuarios->execute();
    $usuarios = $stmt_usuarios->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error al obtener los chats: " . $e->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Chats</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/Mensajeria-Estudiante.css"> 
</head>
<body>
    


    <!-- Barra de Navegación -->
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

    <div class="container mt-4">
        <h3>Mis Chats</h3>
        <div class="list-group">
            <?php foreach ($result as $chat): ?>
                <a href="../HTML/Mensajeria-Estudiante.php?id_chat=<?= $chat['ID_Chat'] ?>" class="list-group-item list-group-item-action">
                    Chat con: <?= htmlspecialchars($rol_usuario === 'estudiante' ? $chat['Profesor'] : $chat['Estudiante']) ?>
                </a>
            <?php endforeach; ?>
        </div>
        <hr>
        <h5>Iniciar un nuevo chat</h5>
        <form action="../PHP/inicioChat.php" method="GET">
    <div class="mb-3">
        <label for="id_usuario" class="form-label">Selecciona un usuario</label>
        <select class="form-select" name="id_vendedor" required>
            <?php
            try {
                $id_usuario_int = intval($id_usuario);  

                $query_usuarios = "SELECT Id_Usuario, NombreCompleto, Rol 
                                   FROM Usuario 
                                   WHERE (Rol = 'profesor' OR Rol = 'estudiante') 
                                   AND Id_Usuario != :id_usuario"; // Excluir al usuario logueado

                $stmt_usuarios = $conn->prepare($query_usuarios);
                $stmt_usuarios->bindParam(':id_usuario', $id_usuario_int, PDO::PARAM_INT);
                $stmt_usuarios->execute();
                $usuarios = $stmt_usuarios->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar los usuarios disponibles en el combobox
                foreach ($usuarios as $usuario):
            ?>
                <option value="<?= $usuario['Id_Usuario'] ?>"><?= htmlspecialchars($usuario['NombreCompleto']) ?> (<?= ucfirst($usuario['Rol']) ?>)</option>
            <?php endforeach; } catch (PDOException $e) {
                die("Error al obtener usuarios: " . $e->getMessage());
            } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-warning">Iniciar Chat</button>
</form>





    </div>

    <footer>
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Archivo JS personalizado -->
    <script src="../JS/UsuarioLogueado-1.js"></script>
</body>
</html>
