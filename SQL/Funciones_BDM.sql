/*----------FUNCIONES----------*/

USE DB_BDM_CURSOS;

DROP FUNCTION IF EXISTS CalcularPromedioCalificacionCURSO;

/*Contar Cuantos likes y dislikes hay en un curso*/
DELIMITER //

CREATE FUNCTION CalcularPromedioCalificacionCURSO(p_Id_Curso INT)
RETURNS FLOAT
DETERMINISTIC
BEGIN
    DECLARE v_TotalLikes INT;
    DECLARE v_TotalDislikes INT;
    DECLARE v_Promedio FLOAT;

   
    SELECT 
        COUNT(CASE WHEN CalificacionComentario = 'Me gustó' THEN 1 END),
        COUNT(CASE WHEN CalificacionComentario = 'No me gustó' THEN 1 END)
    INTO v_TotalLikes, v_TotalDislikes
    FROM Comentario
    WHERE Id_Curso = p_Id_Curso;


    IF (v_TotalLikes + v_TotalDislikes) > 0 THEN
        SET v_Promedio = (v_TotalLikes / (v_TotalLikes + v_TotalDislikes)) * 100;
    ELSE
        SET v_Promedio = 0;
    END IF;

    RETURN v_Promedio;
END //

DELIMITER ;







DROP FUNCTION IF EXISTS ObtenerGananciasTotalesInstructor;

DELIMITER //
CREATE FUNCTION ObtenerGananciasTotalesInstructor(instructorId INT) 
RETURNS FLOAT
DETERMINISTIC
BEGIN
    DECLARE totalGanancias FLOAT DEFAULT 0;
    SELECT SUM(t.MontoPagado) INTO totalGanancias
    FROM Transaccion t
    JOIN Curso c ON t.Id_Curso = c.Id_Curso
    WHERE c.Id_Usuario = instructorId;
    RETURN totalGanancias;
END//

DELIMITER ;
