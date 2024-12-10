<?php
require_once 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCurso = intval($_POST['idCurso']);
    $tituloCurso = $_POST['tituloCurso'];
    $descripcionCurso = $_POST['descripcionCurso'];
    $costoCurso = floatval($_POST['costoCurso']);
    $idCategoria = intval($_POST['categoriaCurso']);
    $imagenCurso = $_FILES['imagenCurso']['tmp_name'];
    $hiddenImageName = $_POST['hiddenImageName'];

    try {
        if ($imagenCurso) {
            $imagenCurso = file_get_contents($imagenCurso); 
        } else {
            $imagenCurso = base64_decode($hiddenImageName); 
        }

        $conexion = new Conexion();
        $conn = $conexion->obtenerConexion(); 
        $stmt = $conn->prepare("CALL EditarCurso(?, ?, ?, ?, ?, ?)");

        $stmt->bindParam(1, $idCurso, PDO::PARAM_INT);
        $stmt->bindParam(2, $tituloCurso, PDO::PARAM_STR);
        $stmt->bindParam(3, $costoCurso, PDO::PARAM_STR);
        $stmt->bindParam(4, $descripcionCurso, PDO::PARAM_STR);
        $stmt->bindParam(5, $imagenCurso, PDO::PARAM_LOB);
        $stmt->bindParam(6, $idCategoria, PDO::PARAM_INT);

        $stmt->execute();
        echo "<script>alert('Curso actualizado con éxito'); window.location.href = '../HTML/MisCursos.php';</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>
