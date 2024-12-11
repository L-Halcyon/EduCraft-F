<?php
require_once 'Conexion.php';

header('Content-Type: application/json'); // Respuesta en formato JSON

$response = ['success' => false, 'message' => '']; // Estructura de respuesta inicial

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Decodificar los datos JSON enviados desde el frontend
        $data = json_decode(file_get_contents('php://input'), true);

        $idCurso = $data['idCurso'] ?? '';
        $idUsuario = $data['idUsuario'] ?? '';
        $comentario = $data['comentario'] ?? '';
        $rating = $data['rating'] ?? '';
        $fechaCreacion = date('Y-m-d H:i:s');

        // Validar que no haya datos vacíos
        if (empty($idCurso) || empty($idUsuario) || empty($comentario) || empty($rating)) {
            $response['message'] = 'Datos incompletos';
            echo json_encode($response);
            exit;
        }

        // Crear conexión a la base de datos
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        // Preparar la consulta con PDO
        $sql = "INSERT INTO Comentario 
                (DescripcionComentario, CalificacionComentario, FechaHoraCreacionComentario, EstatusComentario, Id_Usuario, Id_Curso) 
                VALUES (:comentario, :rating, :fechaCreacion, 'Activo', :idUsuario, :idCurso)";

        $stmt = $db->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':comentario', $comentario);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':fechaCreacion', $fechaCreacion);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->bindParam(':idCurso', $idCurso);

        // Ejecutar la consulta
        $stmt->execute();

        // Respuesta exitosa
        $response['success'] = true;
        $response['message'] = 'Comentario guardado correctamente';
    } else {
        $response['message'] = 'Método no permitido';
    }
} catch (PDOException $e) {
    $response['message'] = 'Error de base de datos: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

// Devolver respuesta en formato JSON
echo json_encode($response);
exit();
?>
