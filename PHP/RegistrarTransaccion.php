<?php
session_start();
require_once 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar que el usuario está autenticado
    if (!isset($_SESSION['idUsuario'])) {
        echo json_encode(['status' => 'error', 'message' => 'No se ha iniciado sesión.']);
        exit();
    }

    $idUsuario = $_SESSION['idUsuario'];
    $data = json_decode(file_get_contents('php://input'), true);
    $metodoPago = $data['metodoPago'];
    $idCurso = $data['idCurso'];

    // Validar datos
    if (empty($metodoPago) || empty($idCurso)) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
        exit();
    }

    try {
        // Establecer conexión con la base de datos
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        // Insertar en la tabla Transaccion
        $sql = "INSERT INTO Transaccion (FechaInscripcion, MetodoPago, EstadoCurso, ProgresoCurso, Id_Usuario, Id_Curso, MontoPagado)
                VALUES (NOW(), :metodoPago, 'Activo', 0, :idUsuario, :idCurso, (SELECT CostoCompleto FROM Curso WHERE Id_Curso = :idCurso))";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':metodoPago', $metodoPago);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Transacción registrada con éxito.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al registrar la transacción.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
