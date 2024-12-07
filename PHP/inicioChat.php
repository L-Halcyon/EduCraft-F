<?php
include '../PHP/Conexion.php'; 
session_start();

if (!isset($_SESSION['idUsuario'])) { 
    exit("Usuario no logueado.");
}

$id_usuario = $_SESSION['idUsuario']; 
$rol_usuario = $_SESSION['rol_usuario']; 

if (!isset($_GET['id_vendedor'])) {
    die("Error: El ID del vendedor no está definido.");
}
$id_usuario_vendedor = intval($_GET['id_vendedor']);

$conexion = new Conexion();
$conn = $conexion->obtenerConexion(); 

try {
    $id_usuario_int = intval($id_usuario); 

    if ($rol_usuario === 'estudiante') {
        // Para el estudiante
        $query = "SELECT * FROM Chat WHERE ID_Estudiante = :id_usuario AND ID_Profesor = :id_vendedor";
    } elseif ($rol_usuario === 'profesor') {
        // Para el profesor
        $query = "SELECT * FROM Chat WHERE ID_Profesor = :id_usuario AND ID_Estudiante = :id_vendedor";
    } else {
        throw new Exception("Rol de usuario no válido: $rol_usuario");
    }

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario_int, PDO::PARAM_INT);
    $stmt->bindParam(':id_vendedor', $id_usuario_vendedor, PDO::PARAM_INT);
    $stmt->execute();

    // Si ya existe un chat, redirige al chat existente
    $result = $stmt->fetch(PDO::FETCH_ASSOC); 
    if ($result) {
        header("Location: ../HTML/Mensajeria-Estudiante.php?id_chat=" . $result['ID_Chat'] . "&id_vendedor=" . $id_usuario_vendedor);
        exit();
    } else {
        // Si no existe un chat, creamos uno nuevo
        $query_insert = "INSERT INTO Chat (ID_Estudiante, ID_Profesor) VALUES (:id_estudiante, :id_profesor)";
        $stmt_insert = $conn->prepare($query_insert);
        $stmt_insert->bindParam(':id_estudiante', $id_usuario_int, PDO::PARAM_INT);
        $stmt_insert->bindParam(':id_profesor', $id_usuario_vendedor, PDO::PARAM_INT);
        $stmt_insert->execute();

        // Obtener el ID del nuevo chat
        $new_chat_id = $conn->lastInsertId();
        header("Location: ../HTML/Mensajeria-Estudiante.php?id_chat=" . $new_chat_id . "&id_vendedor=" . $id_usuario_vendedor);
        exit();
        
    }

} catch (PDOException $e) {
    die("Error al obtener o crear el chat: " . $e->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
