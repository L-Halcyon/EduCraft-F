USE DB_BDM_CURSOS;

DROP TRIGGER IF EXISTS BajaLogicaPorIntentos;
DROP TRIGGER IF EXISTS BajaLogicaCursoTrigger;

/*PRIMER TRIGGER (PARA BORRAR CURSO)*/


DELIMITER //

CREATE TRIGGER BajaLogicaPorIntentos
BEFORE UPDATE ON Usuario
FOR EACH ROW
BEGIN
    IF NEW.NumeroIntentosContraseña >= 3 THEN
        SET NEW.EstatusUsuario = 'Inactivo';
        SET NEW.FechaRegistroYActualizacionInfo = NOW();
    END IF;
END //

DELIMITER ;

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
