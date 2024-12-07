<?php
session_start();
require_once 'Conexion.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'No se ha iniciado sesión.']);
    exit();
}

$email = $_SESSION['email'];

try {
    $conexion = new Conexion();
    $db = $conexion->obtenerConexion();

    $stmtNombre = $db->prepare('CALL ObtenerNombreCompleto(:email, @nombreCompleto)');
    $stmtNombre->bindParam(':email', $email);
    $stmtNombre->execute();

    $stmtId = $db->prepare('CALL ObtenerIdUsuarioPorEmail(:email, @idUsuario, @nombreCompleto)');
    $stmtId->bindParam(':email', $email);
    $stmtId->execute();
    

    $resultNombre = $db->query('SELECT @nombreCompleto AS nombreCompleto')->fetch(PDO::FETCH_ASSOC);
    $resultId = $db->query('SELECT @idUsuario AS idUsuario')->fetch(PDO::FETCH_ASSOC);

    if ($resultNombre && $resultId) {
        $nombreCompleto = $resultNombre['nombreCompleto'];
        $idUsuario = $resultId['idUsuario'];

        $_SESSION['idUsuario'] = $idUsuario;

        $partesNombre = explode(' ', $nombreCompleto);
        $nombre = $partesNombre[0];
        $apellido = isset($partesNombre[1]) ? $partesNombre[1] : '';

        echo json_encode([
            'status' => 'success',
            'idUsuario' => $idUsuario,
            'nombre' => $nombre,
            'apellido' => $apellido
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo obtener la información del usuario.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
}
?>
