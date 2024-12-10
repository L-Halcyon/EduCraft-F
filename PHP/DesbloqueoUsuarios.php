<?php 
require_once('Conexion.php');

// Crear una instancia de la clase Conexion
$conexion = new Conexion();
$conn = $conexion->obtenerConexion();

// Verificar si la solicitud es GET o POST
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Consulta SQL para obtener los usuarios inactivos desde la vista
    $query = "SELECT Id_Usuario, NombreCompleto, Rol, EstatusUsuario FROM UsuariosInactivos";

    // Ejecutar la consulta
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Obtener los resultados
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los resultados como JSON
    echo json_encode($usuarios);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que se haya recibido un ID de usuario en el POST
    if (isset($_POST['id'])) {
        $usuarioId = $_POST['id'];

        // Consulta SQL para actualizar el estado del usuario a "Activo"
        $query = "UPDATE Usuario SET EstatusUsuario = 'Activo', NumeroIntentosContraseña = 0 WHERE Id_Usuario = :id";

        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $usuarioId, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Si la actualización es exitosa, devolver un mensaje de éxito
            echo "Usuario desbloqueado con éxito.";
        } else {
            // Si hay un error en la ejecución
            echo "Error al desbloquear al usuario: " . implode(", ", $stmt->errorInfo());
        }
    } else {
        // Si no se recibe el ID del usuario
        echo "ID de usuario no proporcionado.";
    }
}
?>
