<?php
require_once 'Conexion.php';

if (isset($_GET['idUsuario'])) {
    $idUsuario = intval($_GET['idUsuario']);
    
    try {
        $conexion = new Conexion();
        $db = $conexion->obtenerConexion();

        $stmt = $db->prepare('CALL ObtenerCursosPorUsuario(:idUsuario)');
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->execute();

        $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($cursos) {
            echo '<div class="row">';
            foreach ($cursos as $curso) {
                echo '<div class="col-md-4 mb-4">';
                echo '  <div class="course-card card">';
                echo '    <div class="card-body">';
                echo '      <h3 class="card-title">' . htmlspecialchars($curso['TituloCurso']) . '</h3>';
                echo '      <p class="card-text">Calificación (' . htmlspecialchars($curso['PromedioCalificacion']) . '%)</p>';
                
                echo '      <div class="d-flex justify-content-between">';
                
                echo '        <a href="../HTML/EditarCurso.php?idCurso=' . htmlspecialchars($curso['Id_Curso']) . '" class="btn btn-warning">Editar Curso</a>';
                
                echo '        <button class="btn btn-danger" onclick="confirmarBaja(' . htmlspecialchars($curso['Id_Curso']) . ')">Dar de baja</button>';
                
                echo '      </div>'; 
                
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            }
            echo '</div>';
        }
         else {
            echo '<p class="text-center">No se encontraron cursos para este usuario.</p>';
        }
    } catch (PDOException $e) {
        echo 'Error en la base de datos: ' . $e->getMessage();
    }
} else {
    echo 'No se recibió el idUsuario.';
}
?>


<script>
function confirmarBaja(idCurso) {
    const confirmar = confirm("¿Estás seguro de que quieres dar de baja este curso?");
    if (confirmar) {
        window.location.href = `../PHP/darDeBajaCurso.php?idCurso=${idCurso}`;
    }
}
</script>