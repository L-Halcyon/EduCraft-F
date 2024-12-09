<?php
require_once 'Conexion.php';

header('Content-Type: application/json');

try {
    // Crear instancia de conexión
    $conexion = new Conexion();
    $db = $conexion->obtenerConexion();

    // Llamar al procedimiento almacenado
    $stmt = $db->prepare("CALL ObtenerCategorias()");
    $stmt->execute();

    $categorias = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Agregar solo los campos necesarios
        $categorias[] = [
            'id' => $row['Id_Categoria'],
            'nombre' => $row['Nombre']
        ];
    }

    echo json_encode(['success' => true, 'categorias' => $categorias]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
