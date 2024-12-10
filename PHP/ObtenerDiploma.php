<?php
session_start();
require_once 'Conexion.php';

header('Content-Type: application/json');

// Verificar si se recibieron los parámetros necesarios
if (isset($_GET['idCurso'])/* && isset($_GET['idUsuario'])*/) {
    $idCurso = intval($_GET['idCurso']);
    if (!isset($_SESSION['idUsuario'])) {
        echo "<script>
            alert('Error: No se pudo obtener el ID del usuario. Por favor, vuelve a iniciar sesión.');
            window.location.href = '../HTML/Categorias-Admin.php';
        </script>";
        exit();
    }

    $idUsuario = $_SESSION['idUsuario'];

    try {
        // Establecer la conexión
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        // Obtener los datos del curso
        $queryCurso = "SELECT TituloCurso FROM Curso WHERE Id_Curso = ?";
        $stmtCurso = $db->prepare($queryCurso);
        $stmtCurso->execute([$idCurso]);
        $curso = $stmtCurso->fetch(PDO::FETCH_ASSOC);

        // Obtener los datos del usuario
        $queryUsuario = "SELECT NombreCompleto FROM Usuario WHERE Id_Usuario = ?";
        $stmtUsuario = $db->prepare($queryUsuario);
        $stmtUsuario->execute([$idUsuario]);
        $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

        // Obtener los datos del instructor (suponiendo que el instructor es un campo en la tabla de Curso o un campo relacionado)
        /*$queryInstructor = "SELECT NombreCompleto FROM Instructor WHERE Id_Curso = ?";
        $stmtInstructor = $db->prepare($queryInstructor);
        $stmtInstructor->execute([$idCurso]);
        $instructor = $stmtInstructor->fetch(PDO::FETCH_ASSOC);*/

        // Verificar que se haya encontrado el curso, el usuario y el instructor
        if ($curso && $usuario/* && $instructor*/) {
            echo json_encode([
                'success' => true,
                'usuario' => $usuario,
                'curso' => $curso,
                //'instructor' => $instructor
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Datos no encontrados']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener los datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Faltan parámetros']);
}
?>
