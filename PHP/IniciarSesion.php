<?php
require_once 'Conexion.php';

session_start(); // Iniciar la sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Crear una instancia de la clase Conexion
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        // Llamar al procedimiento almacenado
        $sql = 'CALL IniciarSesion(:email, :password, @estatusSesion)';
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Obtener el estado de sesión
            $result = $db->query("SELECT @estatusSesion AS estatusSesion")->fetch(PDO::FETCH_ASSOC);
            $estatusSesion = $result['estatusSesion'];

            if ($estatusSesion === 'Inicio de sesión exitoso') {
                // Redirigir a la página principal
                header('Location: ../HTML/PaginaPrincipal-2.php');
                exit();
            } else {
                // Guardar el mensaje de error en la sesión
                $_SESSION['error'] = $estatusSesion;
                header('Location: ../HTML/IniciarSesion.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Error al iniciar sesión.';
            header('Location: ../HTML/IniciarSesion.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error: ' . $e->getMessage();
        header('Location: ../HTML/IniciarSesion.php');
        exit();
    }
} else {
    // Manejo si no es un POST (opcional)
    echo 'Acceso no permitido.';
    exit();
}
?>
