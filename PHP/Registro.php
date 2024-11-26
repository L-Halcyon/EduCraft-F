<?php
require_once 'Conexion.php';

header('Content-Type: application/json'); // Respuesta en formato JSON

$response = ['success' => false, 'message' => '']; // Estructura de respuesta inicial

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recibir datos del formulario
        $rol = $_POST['user-role'] ?? '';
        $nombreCompleto = $_POST['full-name'] ?? '';
        $genero = $_POST['gender'] ?? '';
        $fechaNacimiento = $_POST['birth-date'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $imagenAvatar = null;

        // Procesar imagen si fue cargada
        if (isset($_FILES['user-photo']) && $_FILES['user-photo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['user-photo']['tmp_name'];
            $imagenAvatar = file_get_contents($fileTmpPath);
        }

        // Crear conexión a la base de datos
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        // Llamar al procedimiento almacenado
        $sql = 'CALL InsertarUsuario(:rol, :imagenAvatar, :nombreCompleto, :genero, :fechaNacimiento, :email, :password)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':imagenAvatar', $imagenAvatar, PDO::PARAM_LOB); // Para LONGBLOB
        $stmt->bindParam(':nombreCompleto', $nombreCompleto);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        // Respuesta exitosa
        $response['success'] = true;
        $response['message'] = 'Usuario registrado correctamente.';
    } else {
        $response['message'] = 'Método no permitido.';
    }
} catch (PDOException $e) {
    // Capturar solo el mensaje definido en el procedimiento almacenado
    if (strpos($e->getMessage(), 'Este correo ya está registrado.') !== false) {
        $response['message'] = 'Este correo ya está registrado.';
    } else {
        $response['message'] = 'Error en la base de datos.';
    }
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

echo json_encode($response); // Devolver respuesta en formato JSON
exit();

?>