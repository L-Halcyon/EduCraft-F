<?php
session_start();
include 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idCategoria = trim($_POST['idCategoria']);
    $nombreCategoria = trim($_POST['nombreCategoria']);
    $descripcionCategoria = trim($_POST['descripcionCategoria']);
    
    if (!isset($_SESSION['idUsuario'])) {
        echo "<script>
            alert('Error: No se pudo obtener el ID del usuario. Por favor, vuelve a iniciar sesión.');
            window.location.href = '../HTML/Categorias-Admin.php';
        </script>";
        exit();
    }

    $idUsuario = $_SESSION['idUsuario'];

    if (empty($idCategoria) || empty($nombreCategoria) || empty($descripcionCategoria)) {
        echo "<script>
            alert('Por favor, llena todos los campos.');
            window.history.back(); 
        </script>";
        exit;
    }

    try {
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();
        
        $stmt = $db->prepare("CALL ModificarCategoria(:idCategoria, :nombreCategoria, :descripcionCategoria, :idUsuario)");
        $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
        $stmt->bindParam(':nombreCategoria', $nombreCategoria);
        $stmt->bindParam(':descripcionCategoria', $descripcionCategoria);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>
            alert('Categoría modificada correctamente.');
            window.location.href = '../HTML/Categorias-Admin.php'; 
        </script>";
    } catch (PDOException $e) {
        echo "<script>
            alert('Ocurrió un error: " . $e->getMessage() . "');
            window.history.back();
        </script>";
    }
}
?>
