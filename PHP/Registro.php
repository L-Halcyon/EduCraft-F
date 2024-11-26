<?php
require_once 'Conexion.php';

header('Content-Type: application/json'); // Indicar que se devolverá JSON

$response = ['success' => false, 'message' => '']; // Inicializar respuesta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtener los datos del formulario
        $rol = $_POST['user-role'] ?? '';
        $nombreCompleto = $_POST['full-name'] ?? '';
        $genero = $_POST['gender'] ?? '';
        $fechaNacimiento = $_POST['birth-date'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $imagenAvatar = '';

        // Validar imagen subida
        if (isset($_FILES['user-photo']) && $_FILES['user-photo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['user-photo']['tmp_name'];
            $fileName = $_FILES['user-photo']['name'];
            $uploadFileDir = '../uploads/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagenAvatar = $dest_path;
            } else {
                throw new Exception('Error al subir la imagen.');
            }
        }

        // Crear instancia de conexión
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        // Llamar al procedimiento almacenado
        $sql = 'CALL InsertarUsuario(:rol, :imagenAvatar, :nombreCompleto, :genero, :fechaNacimiento, :email, :password)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':imagenAvatar', $imagenAvatar);
        $stmt->bindParam(':nombreCompleto', $nombreCompleto);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        $response['success'] = true;
        $response['message'] = 'Usuario registrado correctamente.';
    } catch (PDOException $e) {
        // Capturar errores del procedimiento almacenado
        $response['message'] = $e->getMessage();
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
} else {
    $response['message'] = 'Acceso no permitido.';
}

echo json_encode($response);
exit();
