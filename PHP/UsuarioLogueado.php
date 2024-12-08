<?php
session_start();
require_once 'Conexion.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'No se ha iniciado sesión.']);
    exit();
}

$email = $_SESSION['email'];

try {
    $conexion = new Conexion();
    $db = $conexion->obtenerConexion();

    // Llamar al procedimiento para obtener el nombre completo
    $stmtNombre = $db->prepare('CALL ObtenerNombreCompleto(:email, @nombreCompleto)');
    $stmtNombre->bindParam(':email', $email);
    $stmtNombre->execute();

    // Llamar al procedimiento para obtener el ID del usuario
    $stmtId = $db->prepare('CALL ObtenerIdUsuarioPorEmail(:email, @idUsuario, @nombreCompleto)');
    $stmtId->bindParam(':email', $email);
    $stmtId->execute();

    // Llamar al procedimiento para obtener el rol del usuario
    $stmtRol = $db->prepare('CALL ObtenerRolUsuario(:email, @rolUsuario)');
    $stmtRol->bindParam(':email', $email);
    $stmtRol->execute();

    $resultNombre = $db->query('SELECT @nombreCompleto AS nombreCompleto')->fetch(PDO::FETCH_ASSOC);
    $resultId = $db->query('SELECT @idUsuario AS idUsuario')->fetch(PDO::FETCH_ASSOC);
    $resultRol = $db->query('SELECT @rolUsuario AS rolUsuario')->fetch(PDO::FETCH_ASSOC);

    if ($resultNombre && $resultId && $resultRol) {
        $nombreCompleto = $resultNombre['nombreCompleto'];
        $idUsuario = $resultId['idUsuario'];
        $rolUsuario = $resultRol['rolUsuario'];


    // Solo actualizar la sesión si no están definidas o si es necesario
    if (!isset($_SESSION['idUsuario']) || $_SESSION['idUsuario'] != $idUsuario) {
        // Guardar el ID del usuario y el rol en la sesión solo si son diferentes
        $_SESSION['idUsuario'] = $idUsuario;
        $_SESSION['rol_usuario'] = $rolUsuario;
    }

    
        $partesNombre = explode(' ', $nombreCompleto);
        $nombre = $partesNombre[0];
        $apellido = isset($partesNombre[1]) ? $partesNombre[1] : '';
    
        // Enviar respuesta JSON
        echo json_encode([
            'status' => 'success',
            'idUsuario' => $idUsuario,
            'rolUsuario'=> $rolUsuario,  
            'nombre' => $nombre,
            'apellido' => $apellido
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo obtener la información del usuario.']);
    }
    
    
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
?>
