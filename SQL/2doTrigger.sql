/*SEGUNDO TRIGGER (PARA BORRAR CURSO)*/

DELIMITER //

CREATE TRIGGER BajaLogicaCursoTrigger
BEFORE DELETE ON Curso
FOR EACH ROW
BEGIN
    
    UPDATE Curso
    SET EstatusCurso = 'Inactivo'
    WHERE Id_Curso = OLD.Id_Curso;
    
    
END //

DELIMITER ;
