<?php
session_start();
require_once 'Conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    echo json_encode(['status' => 'error', 'message' => 'No se ha iniciado sesión.']);
    exit();
}

$idUsuario = $_SESSION['idUsuario'];

try {
    // Establecer conexión con la base de datos
    $conexion = new Conexion();
    $db = $conexion->obtenerConexion();

    // Consulta a la vista filtrando por el usuario logueado
    $sql = "SELECT * FROM VistaKardex WHERE Id_Usuario = :idUsuario";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $stmt->execute();

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($resultados) {
        // Codificar imágenes a base64 para su uso en el frontend
        foreach ($resultados as &$fila) {
            if (isset($fila['ImagenCurso'])) {
                $fila['ImagenCurso'] = base64_encode($fila['ImagenCurso']);
            }
        }
        echo json_encode(['status' => 'success', 'kardex' => $resultados]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se encontraron cursos.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
}
