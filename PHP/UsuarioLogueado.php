<?php
session_start(); //<-- inicio de sesion unico
require_once 'Conexion.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'No se ha iniciado sesión.']);
    exit();
}

$email = $_SESSION['email'];

try {
    $conexion = new Conexion();
    $db = $conexion->obtenerConexion();

    // Llamar al procedimiento ObtenerNombreCompleto
    $sql = 'CALL ObtenerNombreCompleto(:email, @nombreCompleto)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Obtener el valor del parámetro de salida
    $result = $db->query("SELECT @nombreCompleto AS nombreCompleto")->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $nombreCompleto = $result['nombreCompleto'];

        // Separar nombre y apellido
        $partesNombre = explode(' ', $nombreCompleto);
        $nombre = $partesNombre[0];
        $apellido = isset($partesNombre[1]) ? $partesNombre[1] : '';

        echo json_encode(['status' => 'success', 'nombre' => $nombre, 'apellido' => $apellido]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo obtener el nombre del usuario.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
}
?>
