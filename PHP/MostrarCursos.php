<?php
include 'Conexion.php';

try {
    $conexion = (new Conexion())->obtenerConexion();
    
    // Consulta para obtener los cursos de la vista
    $consulta = "SELECT * FROM VistaCursos";
    $stmt = $conexion->prepare($consulta);
    $stmt->execute();
    
    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los cursos como JSON
    echo json_encode($cursos);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
