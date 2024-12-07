<?php
session_start();
include 'Conexion.php';

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['idUsuario'])) {
        echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
        exit();
    }

    $idCategoria = $_POST['idCategoria'];

    try {
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();
        
        $stmt = $db->prepare("CALL BajaCategoria(:idCategoria)");
        $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) { 
            echo json_encode(['success' => true, 'message' => 'Categoría eliminada correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontró la categoría o no se pudo eliminar.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}
?>
