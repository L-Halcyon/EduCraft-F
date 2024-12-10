<?php
session_start();
require_once 'Conexion.php';

header('Content-Type: application/json');

// Verificar si el idCurso está en la solicitud
if (isset($_POST['idCurso'])) {
    $idCurso = intval($_POST['idCurso']);
    $idUsuario = $_SESSION['idUsuario']; // Asumiendo que el ID de usuario está almacenado en la sesión

    try {
        // Establecer la conexión
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        // Actualizar el estado del curso en la tabla Transaccion
        $query = "
            UPDATE Transaccion 
            SET EstadoCurso = 'Completado', FechaTerminacion = NOW()
            WHERE Id_Curso = ? AND Id_Usuario = ? AND EstadoCurso != 'Completado'
        ";
        
        $stmt = $db->prepare($query);
        $stmt->execute([$idCurso, $idUsuario]);

        // Verificar si se actualizó algún registro
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el curso']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el curso: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID del curso no proporcionado']);
}
?>
