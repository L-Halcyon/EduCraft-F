<?php
include 'Conexion.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

try {
    $conexion = (new Conexion())->obtenerConexion();

    $titulo = $_GET['titulo'] ?? '';
    $instructor = $_GET['instructor'] ?? '';
    $categoria = $_GET['categoria'] ?? '';
    $fechaDesde = $_GET['fechaDesde'] ?? '';
    $fechaHasta = $_GET['fechaHasta'] ?? '';
    $filtroEspecial = $_GET['filtroEspecial'] ?? 'todos';

    switch ($filtroEspecial) {
        case 'mas_vendidos':
            $query = "SELECT * FROM vw_cursos_mas_vendidos";
            break;
        case 'mas_recientes':
            $query = "SELECT * FROM vw_cursos_mas_recientes";
            break;
        case 'mejor_calificados':
            $query = "SELECT * FROM vw_cursos_mejor_calificados";
            break;
        default:
            $query = "SELECT * FROM vw_todos_los_cursos WHERE 1=1";
            if (!empty($titulo)) $query .= " AND TituloCurso LIKE :titulo";
            if (!empty($instructor)) $query .= " AND NombreInstructor LIKE :instructor";
            if (!empty($categoria)) $query .= " AND NombreCategoria = :categoria";
            if (!empty($fechaDesde)) $query .= " AND FechaCreacionCurso >= :fechaDesde";
            if (!empty($fechaHasta)) $query .= " AND FechaCreacionCurso <= :fechaHasta";
            break;
    }

    $stmt = $conexion->prepare($query);

    if ($filtroEspecial === 'todos') {
        if (!empty($titulo)) $stmt->bindValue(':titulo', "%$titulo%");
        if (!empty($instructor)) $stmt->bindValue(':instructor', "%$instructor%");
        if (!empty($categoria)) $stmt->bindValue(':categoria', $categoria);
        if (!empty($fechaDesde)) $stmt->bindValue(':fechaDesde', $fechaDesde);
        if (!empty($fechaHasta)) $stmt->bindValue(':fechaHasta', $fechaHasta);
    }

    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultados as &$curso) {
        if (!empty($curso['ImagenCurso'])) {
            $curso['ImagenCurso'] = base64_encode($curso['ImagenCurso']);
        }
    }

    echo json_encode($resultados);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
