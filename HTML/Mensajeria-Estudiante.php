<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../PHP/Conexion.php'; 
session_start();

$conexion = new Conexion();
$conn = $conexion->obtenerConexion(); 

if (!isset($_SESSION['idUsuario'])) {
    echo "<br>Valor de 'idUsuario' en la sesión: ";
    var_dump($_SESSION['idUsuario']); 
    die("Usuario no logueado");
}

$rol_usuario = $_SESSION['rol_usuario'];
$id_usuario = $_SESSION['idUsuario']; 

// Obtener los chats asociados al usuario actual
$query_chats = "SELECT c.ID_Chat, 
                       (SELECT NombreCompleto FROM Usuario WHERE ID_Usuario = c.ID_Profesor) AS Profesor,
                       (SELECT NombreCompleto FROM Usuario WHERE ID_Usuario = c.ID_Estudiante) AS Estudiante
                FROM Chat c 
                WHERE c.ID_Profesor = :id_usuario OR c.ID_Estudiante = :id_usuario";
$stmt_chats = $conn->prepare($query_chats);
$stmt_chats->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt_chats->execute();
$result = $stmt_chats->fetchAll(PDO::FETCH_ASSOC); 

if (isset($_GET['id_chat'])) {
    $id_chat = $_GET['id_chat'];

    // Consulta para obtener el ID del profesor basado en el ID del chat
    $query_vendedor = "SELECT ID_Profesor FROM Chat WHERE ID_Chat = ?";
    $stmt_vendedor = $conn->prepare($query_vendedor);
    $stmt_vendedor->execute([$id_chat]); 

    $row = $stmt_vendedor->fetch(PDO::FETCH_ASSOC); 
    if ($row) {
        $id_vendedor = $row['ID_Profesor'];
    } else {
        die("No se encontró un profesor asociado a este chat.");
    }
}

// Obtener los mensajes de un chat específico
if (isset($_GET['id_chat'])) {
    $id_chat = $_GET['id_chat'];
    $query_mensajes = "SELECT m.ID_Mensaje, m.TextoMensaje, m.HoraFechaMensaje, u.NombreCompleto AS Usuario, u.Rol AS Rol, u.ImagenAvatar 
                   FROM Mensaje m
                   JOIN Usuario u ON m.ID_USUARIO = u.ID_USUARIO
                   WHERE m.CHAT_ID = ? 
                   ORDER BY m.HoraFechaMensaje ASC";
    $stmt_mensajes = $conn->prepare($query_mensajes);
    $stmt_mensajes->execute([$id_chat]); 
    $mensajes = $stmt_mensajes->fetchAll(PDO::FETCH_ASSOC); 
}

// Si el método es POST, manejar el envío de mensajes
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mensaje'])) {
    $mensaje = $_POST['mensaje'];
    $chat_id = $_POST['chat_id'];
    $id_usuario = $_SESSION['idUsuario'];
    $query_insertar = "INSERT INTO Mensaje (CHAT_ID, ID_USUARIO, TextoMensaje, HoraFechaMensaje) 
                       VALUES (?, ?, ?, NOW())";
    $stmt_insertar = $conn->prepare($query_insertar);
    $stmt_insertar->execute([$chat_id, $id_usuario, $mensaje]);
    header("Location: ../HTML/Mensajeria-Estudiante.php?id_chat=" . $chat_id); 
    exit();
}
?>




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

 <!-- Encabezado -->
<header class="container my-4">
    <h2 id="chat-title">Mensajes Privados - Curso de Diseño Web</h2>
    <p>Conversación entre Alumno y Profesor</p>
</header>

<div class="container">
    <div class="row">
        <!-- Lista de Instructores / Cursos -->
        <div class="col-md-3">
            <h4>Instructores / Cursos</h4>
            <ul class="list-group">
                <?php if (!empty($result)): ?>
                    <?php foreach ($result as $chat): ?>
                        <li class="list-group-item">
                            <a href="../HTML/Mensajeria-Estudiante.php?id_chat=<?= htmlspecialchars($chat['ID_Chat']); ?>" class="instructor-link">
                                <?= htmlspecialchars($rol_usuario === 'Profesor' ? $chat['Estudiante'] : $chat['Profesor']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item">No hay chats disponibles.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Contenedor de Mensajes -->
        <div class="col-md-9">
            <?php if (isset($mensajes)): ?>
                <div class="message-container">
                    <?php foreach ($mensajes as $mensaje): ?>
                        <div class="message">
                            <?php
                            if (!empty($mensaje['ImagenAvatar'])) {
                                $imageData = base64_encode($mensaje['ImagenAvatar']);
                                $imageSrc = 'data:image/jpeg;base64,' . $imageData; 
                            } else {
                                $imageSrc = 'path/to/default-avatar.jpg'; 
                            }
                            ?>
                            <!-- Mostrar la imagen del avatar -->
                            <img src="<?= $imageSrc; ?>" alt="Avatar" class="user-avatar">

                            <p><strong><?= htmlspecialchars($mensaje['Usuario']); ?>:</strong> <?= htmlspecialchars($mensaje['TextoMensaje']); ?></p>
                            <span class="message-timestamp"><?= htmlspecialchars($mensaje['HoraFechaMensaje']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Enviar Nuevo Mensaje -->
                <div class="send-message">
                    <form action="../HTML/Mensajeria-Estudiante.php" method="POST">
                        <textarea class="form-control" rows="3" placeholder="Escribe tu mensaje aquí..." name="mensaje"></textarea>
                        <input type="hidden" name="chat_id" value="<?= htmlspecialchars($id_chat); ?>">
                        <button class="btn btn-send" type="submit">Enviar</button>
                    </form>
                </div>
            <?php else: ?>
                <p>No hay mensajes disponibles para este chat.</p>
            <?php endif; ?>
        </div>
    </div>
</div>


<footer>
    <p>© 2024 EduCraft. Todos los derechos reservados.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Archivo JS personalizado -->
  <script src="../JS/UsuarioLogueado-1.js"></script>

</body>
</html>