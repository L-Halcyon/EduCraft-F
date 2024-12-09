<?php
require_once 'Conexion.php';

header('Content-Type: application/json');

try {
    // Validar y procesar datos del curso
    $tituloCurso = trim($_POST['tituloCurso']);
    $descripcionCurso = trim($_POST['descripcionCurso']);
    $costoCurso = floatval($_POST['costoCurso']);
    $cantidadNiveles = intval($_POST['cantidadNiveles']);
    $idUsuario = intval($_POST['idUsuario']);
    $idCategoria = isset($_POST['idCategoria']) ? intval($_POST['idCategoria']) : 0;
    $nivelesData = isset($_POST['nivelesData']) ? json_decode($_POST['nivelesData'], true) : [];


    if (empty($tituloCurso) || empty($descripcionCurso) || $costoCurso < 0 || $cantidadNiveles <= 0 || $idUsuario <= 0 || $idCategoria <= 0) {
        throw new Exception('Datos del curso inválidos.');
    }

    // Procesar imagen del curso
    $imagenCurso = null;
    if (isset($_FILES['imagenCurso']) && $_FILES['imagenCurso']['error'] === UPLOAD_ERR_OK) {
        $imagenCurso = file_get_contents($_FILES['imagenCurso']['tmp_name']);
    }

    // Procesar niveles (ahora se reciben como JSON)
    $nivelesData = [];
    if (isset($_POST['nivelesData'])) {
        $nivelesData = json_decode($_POST['nivelesData'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Error al procesar los datos de los niveles.');
        }

        foreach ($nivelesData as $index => $nivel) {
            $tituloNivel = $nivel['titulo'];
            $descripcionNivel = $nivel['descripcion'];
            $costoNivel = floatval($nivel['costo']);
            //$videoNivel = $nivel['video'] ?? null;

            if (empty($tituloNivel) || empty($descripcionNivel) || $costoNivel < 0) {
                throw new Exception("Datos del nivel " . ($index + 1) . " son invalidos.");
            }

            // Guardar video en la carpeta local (opcional, según necesidades)
            /*$rutaVideo = "../uploads/niveles/videos/{$videoNivel}";
            if (!move_uploaded_file($_FILES["nivel{$index}_video"]['tmp_name'], $rutaVideo)) {
                throw new Exception("Error al subir el video del nivel " . ($index + 1) . ".");
            }*/

            // Procesar el archivo de video
            $videoKey = "nivel{$index}_video"; // Clave dinámica para el archivo
            $rutaVideo = null;

            if (isset($_FILES[$videoKey]) && $_FILES[$videoKey]['error'] === UPLOAD_ERR_OK) {
                $uploadDir = "../uploads/niveles/videos/";
                $nombreArchivo = basename($_FILES[$videoKey]['name']);
                $rutaVideo = $uploadDir . $nombreArchivo;

                // Mover el archivo subido a su destino
                if (!move_uploaded_file($_FILES[$videoKey]['tmp_name'], $rutaVideo)) {
                    echo json_encode([
                        "success" => false,
                        "message" => "Error al subir el video del nivel " . ($index + 1) . "."
                    ]);
                    exit;
                }
            }

            // Formatear nivel para el procedimiento almacenado
            $nivelesData[$index] = "{$costoNivel}|{$tituloNivel}|{$descripcionNivel}|{$rutaVideo}";
        }
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
    $stmt = $db->prepare("CALL InsertarCurso(:titulo, :cantidadNiveles, :costoCurso, :descripcion, :imagen, :idUsuario, :idCategoria, :niveles, :multimedia)");
    $stmt->bindParam(':titulo', $tituloCurso);
    $stmt->bindParam(':cantidadNiveles', $cantidadNiveles);
    $stmt->bindParam(':costoCurso', $costoCurso);
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
