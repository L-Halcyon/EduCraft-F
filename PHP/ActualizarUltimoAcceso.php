<?php
require_once 'Conexion.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['idTransaccion'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID de transacción no proporcionado.']);
    exit();
}

$idTransaccion = $data['idTransaccion'];
$fechaActual = date('Y-m-d H:i:s');

try {
    $conexion = new Conexion();
    $db = $conexion->obtenerConexion();

    $sql = 'UPDATE Transaccion SET FechaUltimoAcceso = :fechaActual WHERE Id_Transaccion = :idTransaccion';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
    $stmt->bindParam(':idTransaccion', $idTransaccion, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se encontró la transacción.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
}
