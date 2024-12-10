<?php
header('Content-Type: application/json');

require_once 'Conexion.php';

try {
    $conexionDB = new Conexion();
    $conn = $conexionDB->obtenerConexion();

    $vendedorId = isset($_GET['vendedorId']) ? $_GET['vendedorId'] : null;
    $fechaInicio = isset($_GET['fechaInicio']) ? $_GET['fechaInicio'] : null;
    $fechaFin = isset($_GET['fechaFin']) ? $_GET['fechaFin'] : null;
    $categoria = isset($_GET['categoria']) ? intval($_GET['categoria']) : null;
    $estatusCurso = isset($_GET['estatusCurso']) ? $_GET['estatusCurso'] : null;

    if (!$vendedorId) {
        throw new Exception("El ID del vendedor no está especificado.");
    }

    $query = "
    SELECT 
        vc.TituloCurso AS Curso,
        vc.AlumnosInscritos,
        vc.NivelPromedioCursado,
        vc.IngresosTotales
    FROM 
        VistaCursosVendedor vc
    JOIN 
        Curso c ON vc.Id_Curso = c.Id_Curso
    WHERE 
        c.Id_Usuario = :vendedorId
    ";

    if ($fechaInicio) {
        $query .= " AND c.FechaCreacionCurso >= :fechaInicio";
    }
    if ($fechaFin) {
        $query .= " AND c.FechaCreacionCurso <= :fechaFin";
    }
    if ($categoria) {
        $query .= " AND c.Id_Categoria = :categoria";
    }
    if ($estatusCurso) {
        $query .= " AND c.EstatusCurso = :estatusCurso";
    }

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':vendedorId', $vendedorId, PDO::PARAM_INT);
    if ($fechaInicio) {
        $stmt->bindParam(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
    }
    if ($fechaFin) {
        $stmt->bindParam(':fechaFin', $fechaFin, PDO::PARAM_STR);
    }
    if ($categoria) {
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_INT);
    }
    if ($estatusCurso) {
        $stmt->bindParam(':estatusCurso', $estatusCurso, PDO::PARAM_STR);
    }

    // Ejecutar la consulta
    $stmt->execute();
    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Obtener el total de ingresos generales
    $stmtTotalIngresos = $conn->prepare("
        SELECT SUM(vc.IngresosTotales) AS TotalIngresos
        FROM VistaCursosVendedor vc
        JOIN Curso c ON vc.Id_Curso = c.Id_Curso
        WHERE c.Id_Usuario = :vendedorId
    ");
    $stmtTotalIngresos->bindParam(':vendedorId', $vendedorId, PDO::PARAM_INT);
    $stmtTotalIngresos->execute();
    $totalIngresos = $stmtTotalIngresos->fetch(PDO::FETCH_ASSOC)['TotalIngresos'];

    echo json_encode([
        'cursos' => $cursos,
        'totalIngresos' => $totalIngresos
    ]);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

?>
