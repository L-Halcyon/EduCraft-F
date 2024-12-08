<?php
require_once 'Conexion.php';

header('Content-Type: application/json');

try {
    // Validar y procesar datos del curso
    $tituloCurso = trim($_POST['tituloCurso']);
    $descripcionCurso = trim($_POST['descripcionCurso']);
    $costoCompleto = floatval($_POST['costoCompleto']);
    $cantidadNiveles = intval($_POST['cantidadNiveles']);
    $idUsuario = intval($_POST['idUsuario']);
    $idCategoria = intval($_POST['idCategoria']);

    if (empty($tituloCurso) || empty($descripcionCurso) || $costoCompleto < 0 || $cantidadNiveles <= 0 || $idUsuario <= 0 || $idCategoria <= 0) {
        throw new Exception('Datos del curso inválidos.');
    }

    // Procesar imagen del curso
    $imagenCurso = null;
    if (isset($_FILES['imagenCurso']) && $_FILES['imagenCurso']['error'] === UPLOAD_ERR_OK) {
        $imagenCurso = file_get_contents($_FILES['imagenCurso']['tmp_name']);
    }

    // Procesar niveles
    $nivelesData = [];
    for ($i = 1; $i <= $cantidadNiveles; $i++) {
        $tituloNivel = trim($_POST["nivel{$i}_titulo"]);
        $descripcionNivel = trim($_POST["nivel{$i}_descripcion"]);
        $costoNivel = floatval($_POST["nivel{$i}_costo"]);
        $videoNivel = $_FILES["nivel{$i}_video"]['name'] ?? '';

        if (empty($tituloNivel) || empty($descripcionNivel) || $costoNivel < 0) {
            throw new Exception("Datos del nivel {$i} son inválidos.");
        }

        // Guardar video en la carpeta local (opcional, según necesidades)
        $rutaVideo = "../uploads/niveles/videos/{$videoNivel}";
        if (!move_uploaded_file($_FILES["nivel{$i}_video"]['tmp_name'], $rutaVideo)) {
            throw new Exception("Error al subir el video del nivel {$i}.");
        }

        // Formatear nivel para el procedimiento almacenado
        $nivelesData[] = "{$costoNivel}|{$tituloNivel}|{$descripcionNivel}|{$rutaVideo}";
    }
    $niveles = implode(';', $nivelesData);

    // Procesar multimedia
    $multimediaData = [];
    if (isset($_FILES['multimedia'])) {
        foreach ($_FILES['multimedia']['name'] as $index => $fileName) {
            $rutaMultimedia = "../uploads/cursos/multimedia/{$fileName}";
            if (move_uploaded_file($_FILES['multimedia']['tmp_name'][$index], $rutaMultimedia)) {
                $multimediaData[] = $rutaMultimedia;
            }
        }
    }
    $multimedia = implode(';', $multimediaData);

    // Crear instancia de conexión
    $conexion = new Conexion();
    $db = $conexion->obtenerConexion();

    // Llamar al procedimiento almacenado
    $stmt = $db->prepare("CALL InsertarCurso(:titulo, :cantidadNiveles, :costoCompleto, :descripcion, :imagen, :idUsuario, :idCategoria, :niveles, :multimedia)");
    $stmt->bindParam(':titulo', $tituloCurso);
    $stmt->bindParam(':cantidadNiveles', $cantidadNiveles);
    $stmt->bindParam(':costoCompleto', $costoCompleto);
    $stmt->bindParam(':descripcion', $descripcionCurso);
    $stmt->bindParam(':imagen', $imagenCurso, PDO::PARAM_LOB);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->bindParam(':idCategoria', $idCategoria);
    $stmt->bindParam(':niveles', $niveles);
    $stmt->bindParam(':multimedia', $multimedia);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
