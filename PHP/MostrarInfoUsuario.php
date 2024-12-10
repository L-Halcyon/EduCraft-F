<?php
session_start();
require_once 'Conexion.php';

// Validar que la sesión contiene el ID del usuario
if (!isset($_SESSION['idUsuario'])) {
    echo json_encode(['status' => 'error', 'message' => 'No se ha iniciado sesión.']);
    exit();
}

$idUsuario = $_SESSION['idUsuario'];

try {
    $conexion = new Conexion();
    $db = $conexion->obtenerConexion();

    // Llamada al procedimiento almacenado
    $sql = 'CALL ObtenerInfoUsuarioPorId(:idUsuario)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $usuario['ImagenAvatar'] = base64_encode($usuario['ImagenAvatar']);
        echo json_encode(['status' => 'success', 'usuario' => $usuario]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se encontraron datos del usuario.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
}
