<?php
header('Content-Type: application/json');

require_once 'Conexion.php';

try {
    $conexionDB = new Conexion();
    $conn = $conexionDB->obtenerConexion();

    $vendedorId = isset($_GET['vendedorId']) ? intval($_GET['vendedorId']) : 0;

    if ($vendedorId === 0) {
        throw new Exception("ID del vendedor no proporcionado o inválido.");
    }

    $stmt = $conn->prepare("CALL ObtenerReporteVendedor(:vendedorId)");
    $stmt->bindParam(':vendedorId', $vendedorId, PDO::PARAM_INT);
    $stmt->execute();

    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    $stmtTotalIngresos = $conn->prepare("SELECT SUM(vc.IngresosTotales) AS TotalIngresos FROM VistaCursosVendedor vc JOIN Curso c ON vc.Id_Curso = c.Id_Curso WHERE c.Id_Usuario = :vendedorId");
    $stmtTotalIngresos->bindParam(':vendedorId', $vendedorId, PDO::PARAM_INT);
    $stmtTotalIngresos->execute();
    $totalIngresos = $stmtTotalIngresos->fetch(PDO::FETCH_ASSOC)['TotalIngresos'];

    $stmtDetalleVenta = $conn->prepare("CALL ObtenerDetalleVentaPorAlumno(:vendedorId)");
    $stmtDetalleVenta->bindParam(':vendedorId', $vendedorId, PDO::PARAM_INT);
    $stmtDetalleVenta->execute();

    $ventaDetallada = $stmtDetalleVenta->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'cursos' => $cursos,
        'totalIngresos' => $totalIngresos,
        'ventaDetallada' => $ventaDetallada
    ]);

} catch (Exception $e) {
    // Manejo de errores
    echo json_encode(['error' => $e->getMessage()]);
}
?>

