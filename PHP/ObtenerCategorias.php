<?php
include 'Conexion.php'; 

$conexionObj = new Conexion();

$conn = $conexionObj->obtenerConexion();

$sql = "CALL ObtenerCategorias()"; 
$stmt = $conn->query($sql);

if ($stmt->rowCount() > 0) {
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $categorias = [];
}

echo json_encode($categorias);
?>
