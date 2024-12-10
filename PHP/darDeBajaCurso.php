<?php
require_once 'Conexion.php';

if (isset($_GET['idCurso'])) {
    $idCurso = intval($_GET['idCurso']);

    try {
        $conexion = new Conexion();
        $conn = $conexion->obtenerConexion();

        $stmt = $conn->prepare("CALL BajaLogicaCurso(?)");
        $stmt->bindParam(1, $idCurso, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>alert('Curso dado de baja con éxito'); window.location.href = '../HTML/MisCursos.php';</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
} else {
    echo "<script>alert('ID del curso no especificado'); window.location.href = '../HTML/MisCursos.php';</script>";
}
?>
