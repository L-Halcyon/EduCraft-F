<?php
require_once 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        // Llamada al procedimiento almacenado IniciarSesion
        $sql = 'CALL IniciarSesion(:email, :password, @estatusSesion)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            // Obtener el estado de la sesión desde el parámetro de salida
            $result = $db->query("SELECT @estatusSesion AS estatusSesion")->fetch(PDO::FETCH_ASSOC);
            $estatusSesion = $result['estatusSesion'];

            // Si el inicio de sesión fue exitoso
            if ($estatusSesion === 'Inicio de sesión exitoso') {
                // Llamada al procedimiento ObtenerRolUsuario para determinar el rol
                $sqlRol = 'CALL ObtenerRolUsuario(:email, @rolUsuario)';
                $stmtRol = $db->prepare($sqlRol);
                $stmtRol->bindParam(':email', $email);

                if ($stmtRol->execute()) {
                    $resultRol = $db->query("SELECT @rolUsuario AS rolUsuario")->fetch(PDO::FETCH_ASSOC);
                    $rolUsuario = $resultRol['rolUsuario'];

                    // Determinar la URL de redirección según el rol
                    $redirectUrl = '';
                    if ($rolUsuario === 'estudiante') {
                        $redirectUrl = '../HTML/PaginaPrincipal-2.php';
                    } elseif ($rolUsuario === 'profesor') {
                        $redirectUrl = '../HTML/CrearCurso.php';
                    } elseif ($rolUsuario === 'administrador') {
                        $redirectUrl = '../HTML/DesbloqueoUsuarios.php';
                    }

                    // Responder con el estado y la URL de redirección
                    echo json_encode([
                        'status' => 'success',
                        'message' => $estatusSesion,
                        'redirect' => $redirectUrl
                    ]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al obtener el rol del usuario.']);
                }
            } else {
                // Respuesta de error con el mensaje del procedimiento
                echo json_encode(['status' => 'error', 'message' => $estatusSesion]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al procesar la solicitud.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
