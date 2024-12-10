<?php
require_once '../PHP/Conexion.php';

function obtenerInformacionCurso($idCurso) {
    try {
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        $stmt = $db->prepare('CALL obtenerInfo_curso(:idCurso)');
        $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
        $stmt->execute();

        $curso = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($curso) {
            $curso['base64Imagen'] = $curso['ImagenCurso'] 
                ? 'data:image/jpeg;base64,' . base64_encode($curso['ImagenCurso']) 
                : '';
        }
        return $curso;
    } catch (PDOException $e) {
        echo 'Error en la base de datos: ' . $e->getMessage();
        return null;
    }
}

function obtenerCategorias() {
    try {
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        $stmt = $db->prepare('CALL ObtenerCategorias()');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error en la base de datos: ' . $e->getMessage();
        return [];
    }
}
?>
