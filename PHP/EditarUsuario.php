<?php
require_once 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new Conexion();
    $pdo = $conexion->obtenerConexion();

    try {
        // Obtener los datos del formulario
        $idUsuario = $_POST['idUsuario'];
        $nombreCompleto = $_POST['nombreCompleto'];
        $genero = $_POST['genero'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $contrasena = $_POST['contrasena'];
        $imagenAvatar = null;

        // Procesar la imagen si se envía
        if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
            $imagenAvatar = file_get_contents($_FILES['fileInput']['tmp_name']);
        }

        // Llamar al procedimiento almacenado
        $stmt = $pdo->prepare("CALL ModificarUsuario(:idUsuario, :imagenAvatar, :nombreCompleto, :genero, :fechaNacimiento, :contrasena)");
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':imagenAvatar', $imagenAvatar, PDO::PARAM_LOB);
        $stmt->bindParam(':nombreCompleto', $nombreCompleto, PDO::PARAM_STR);
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);

        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Usuario actualizado con éxito.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el usuario: ' . $e->getMessage()]);
    }
}
?>
