<?php
session_start();
require_once 'Conexion.php';

header('Content-Type: application/json');

if (isset($_GET['idCurso'])) {
    $idCurso = intval($_GET['idCurso']);

    try {
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        // Consultar información del curso
        $stmt = $db->prepare("
            SELECT c.TituloCurso, c.CostoCompleto, c.DescripcionCurso, c.PromedioCalificacion, c.ImagenCurso, 
                   u.NombreCompleto AS Instructor
            FROM Curso c
            JOIN Usuario u ON c.Id_Usuario = u.Id_Usuario
            WHERE c.Id_Curso = ? AND c.EstatusCurso = 'activo'
        ");
        $stmt->execute([$idCurso]);
        $curso = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$curso) {
            echo json_encode(['success' => false, 'message' => 'Curso no encontrado o inactivo.']);
            exit;
        }

        // Consultar niveles del curso
        $queryNiveles = $db->prepare("
            SELECT TituloNivel, Descripcion 
            FROM Nivel
            WHERE Id_Curso = ?
        ");
        $queryNiveles->execute([$idCurso]);
        $niveles = $queryNiveles->fetchAll(PDO::FETCH_ASSOC);

        // Consultar comentarios del curso
        $queryComentarios = $db->prepare("
            SELECT c.DescripcionComentario, c.CalificacionComentario, c.FechaHoraCreacionComentario, 
                   u.NombreCompleto AS Usuario
            FROM Comentario c
            JOIN Usuario u ON c.Id_Usuario = u.Id_Usuario
            WHERE c.Id_Curso = ? AND c.EstatusComentario = 'activo'
            ORDER BY c.FechaHoraCreacionComentario DESC
        ");
        $queryComentarios->execute([$idCurso]);
        $comentarios = $queryComentarios->fetchAll(PDO::FETCH_ASSOC);

        // Formar la respuesta JSON
        echo json_encode([
            'success' => true,
            'curso' => [
                'TituloCurso' => $curso['TituloCurso'],
                'CostoCompleto' => $curso['CostoCompleto'],
                'DescripcionCurso' => $curso['DescripcionCurso'],
                'PromedioCalificacion' => $curso['PromedioCalificacion'],
                'ImagenCurso' => base64_encode($curso['ImagenCurso']),
                'Instructor' => $curso['Instructor'],
                'niveles' => $niveles,
                'comentarios' => $comentarios
            ]
        ]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID del curso no proporcionado.']);
}
?>
