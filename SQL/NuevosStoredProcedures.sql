USE DB_BDM_CURSOS;


-- LOGIN
DELIMITER //

CREATE PROCEDURE IniciarSesion(
    IN p_Email VARCHAR(50),
    IN p_Contraseña VARCHAR(20),
    OUT p_EstatusSesion VARCHAR(255) 
)
BEGIN
    DECLARE v_ContraseñaActual VARCHAR(20);
    DECLARE v_NumeroIntentos INT;
    DECLARE v_EstatusUsuario VARCHAR(15);
    DECLARE v_UsuarioEncontrado INT;

    -- Verifica si el usuario existe
    SELECT COUNT(*) INTO v_UsuarioEncontrado
    FROM Usuario
    WHERE Email = p_Email;

    IF v_UsuarioEncontrado = 0 THEN
        SET p_EstatusSesion = 'El correo no está registrado.';
    ELSE
        -- Si el usuario existe, obtenemos sus datos
        SELECT Contraseña, NumeroIntentosContraseña, EstatusUsuario
        INTO v_ContraseñaActual, v_NumeroIntentos, v_EstatusUsuario
        FROM Usuario
        WHERE Email = p_Email;

        -- Verifica si el usuario está inactivo
        IF v_EstatusUsuario = 'Inactivo' THEN
            SET p_EstatusSesion = 'Cuenta inactiva. Espere activación por un administrador.';
        ELSE
            -- Compara la contraseña
            IF p_Contraseña = v_ContraseñaActual THEN
                -- Contraseña correcta
                UPDATE Usuario
                SET NumeroIntentosContraseña = 0
                WHERE Email = p_Email;
                SET p_EstatusSesion = 'Inicio de sesión exitoso';
            ELSE
                -- Contraseña incorrecta, incrementa intentos
                SET v_NumeroIntentos = v_NumeroIntentos + 1;
                UPDATE Usuario
                SET NumeroIntentosContraseña = v_NumeroIntentos
                WHERE Email = p_Email;

                IF v_NumeroIntentos >= 3 THEN
                    -- Bloquea usuario después de 3 intentos
                    UPDATE Usuario
                    SET EstatusUsuario = 'Inactivo'
                    WHERE Email = p_Email;
                    SET p_EstatusSesion = 'Cuenta inactiva por intentos fallidos.';
                ELSE
                    -- Mensaje indicando intentos restantes
                    SET p_EstatusSesion = CONCAT('Contraseña incorrecta. Intento ', v_NumeroIntentos, '/3.');
                END IF;
            END IF;
        END IF;
    END IF;
END //

DELIMITER ;


/*----------------------------USUARIO------------------------------------*/
DELIMITER //

CREATE PROCEDURE ObtenerRolUsuario(
    IN p_Email VARCHAR(50),
    OUT p_RolUsuario VARCHAR(20) -- Parámetro de salida para devolver el rol del usuario
)
BEGIN
    -- Obtener el rol del usuario con el email proporcionado
    SELECT Rol
    INTO p_RolUsuario
    FROM Usuario
    WHERE Email = p_Email;
END //

DELIMITER ;




-- USUARIO
DELIMITER //

DELIMITER $$

CREATE PROCEDURE InsertarUsuario(
    IN p_Rol VARCHAR(20),
    IN p_ImagenAvatar LONGBLOB,
    IN p_NombreCompleto VARCHAR(100),
    IN p_Genero VARCHAR(20),
    IN p_FechaNacimiento DATE,
    IN p_Email VARCHAR(50),
    IN p_Contraseña VARCHAR(20)
)
BEGIN
    -- Inserción de datos si todas las validaciones se cumplen
    INSERT INTO Usuario (
        Rol, ImagenAvatar, NombreCompleto, Genero, FechaNacimiento, Email, Contraseña, NumeroIntentosContraseña, FechaRegistroYActualizacionInfo, EstatusUsuario
    )
    VALUES (
        p_Rol, p_ImagenAvatar, p_NombreCompleto, p_Genero, p_FechaNacimiento, p_Email, p_Contraseña, 0, NOW(), 'Activo'
    );

    
END$$

DELIMITER ;



DELIMITER //

CREATE PROCEDURE ModificarUsuario(
    IN p_Id_Usuario INT,
    IN p_ImagenAvatar LONGBLOB,
    IN p_NombreCompleto VARCHAR(100),
    IN p_Genero VARCHAR(20), 
    IN p_FechaNacimiento DATE,
    IN p_Email VARCHAR(50),
    IN p_Contraseña VARCHAR(20)
)
BEGIN
    UPDATE Usuario
    SET 
        ImagenAvatar = p_ImagenAvatar,
        NombreCompleto = p_NombreCompleto,
        Genero = p_Genero, 
        FechaNacimiento = p_FechaNacimiento,
        Email = p_Email,
        Contraseña = p_Contraseña,
        FechaRegistroYActualizacionInfo = NOW()
    WHERE Id_Usuario = p_Id_Usuario;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE BajaLogicaUsuario(
    IN p_Id_Usuario INT
)
BEGIN
    UPDATE Usuario
    SET 
        EstatusUsuario = 'Inactivo' -- BAJA LÓGICA
    WHERE Id_Usuario = p_Id_Usuario;
END //

DELIMITER ;



/*----------------------------CATEGORIAS------------------------------------*/

DELIMITER //

CREATE PROCEDURE CrearCategoria(
    IN p_NombreCategoria VARCHAR(100),
    IN p_DescripcionCategoria VARCHAR(200),
    IN p_Id_Usuario INT
)
BEGIN
    INSERT INTO Categoria (
        NombreCategoria, DescripcionCategoria, FechaHoraCreacionCategoria, Id_Usuario, EstatusCategoria
    )
    VALUES (
        p_NombreCategoria, p_DescripcionCategoria, NOW(), p_Id_Usuario, 'Activo'
    );
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE ModificarCategoria(
    IN p_Id_Categoria INT,
    IN p_NombreCategoria VARCHAR(100),
    IN p_DescripcionCategoria VARCHAR(200),
    IN p_Id_Usuario INT
)
BEGIN
    UPDATE Categoria
    SET 
        NombreCategoria = p_NombreCategoria,
        DescripcionCategoria = p_DescripcionCategoria,
        Id_Usuario = p_Id_Usuario
    WHERE Id_Categoria = p_Id_Categoria;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE BajaCategoria(
     IN p_Id_Categoria INT
)
BEGIN
    UPDATE Categoria
    SET 
        EstatusCategoria = 'Inactivo' -- BAJA LÓGICA
    WHERE Id_Categoria = p_Id_Categoria;
END //

DELIMITER ;



/*----------------------------CURSOS/NIVELES/MULTIMEDIA------------------------------------*/

DELIMITER //

CREATE PROCEDURE InsertarCurso(
    IN p_TituloCurso VARCHAR(100),
    IN p_CantidadNiveles INT,
    IN p_CostoCompleto FLOAT,
    IN p_DescripcionCurso VARCHAR(200),
    IN p_ImagenCurso LONGBLOB,
    IN p_Id_Usuario INT,
    IN p_Id_Categoria INT,
    IN p_Niveles TEXT,      
    IN p_Multimedia TEXT     
)
BEGIN
    DECLARE v_Id_Curso INT;

   
    INSERT INTO Curso (
        TituloCurso, CantidadNiveles, CostoCompleto, DescripcionCurso, ImagenCurso, 
        EstatusCurso, FechaCreacionCurso, Id_Usuario, Id_Categoria
    ) 
    VALUES (
        p_TituloCurso, p_CantidadNiveles, p_CostoCompleto, p_DescripcionCurso, p_ImagenCurso,
        'Activo', NOW(), p_Id_Usuario, p_Id_Categoria
    );

    -- Recupera el ID del curso recién insertado.
    SET v_Id_Curso = LAST_INSERT_ID();

    -- Si hay al menos un nivel, se llama el procedure
    IF p_Niveles IS NOT NULL AND p_Niveles != '' THEN
        CALL InsertarNiveles(v_Id_Curso, p_Niveles);
    END IF;

    -- si hay al menos un archivo multimedia, se llama el procedure sino ne
    IF p_Multimedia IS NOT NULL AND p_Multimedia != '' THEN
        CALL InsertarMultimedia(v_Id_Curso, p_Multimedia);
    END IF;
END //

DELIMITER ;

DELIMITER //


CREATE PROCEDURE InsertarNiveles(
    IN p_Id_Curso INT,
    IN p_Niveles TEXT
)
BEGIN
    DECLARE v_Nivel TEXT;
    DECLARE v_Pos INT;

    WHILE LENGTH(p_Niveles) > 0 DO
        -- Extrae el primer nivel (hasta el delimitador ';').
        SET v_Pos = LOCATE(';', p_Niveles);
        IF v_Pos > 0 THEN
            SET v_Nivel = LEFT(p_Niveles, v_Pos - 1);
            SET p_Niveles = SUBSTRING(p_Niveles, v_Pos + 1);
        ELSE
            SET v_Nivel = p_Niveles;
            SET p_Niveles = '';
        END IF;

        -- Inserta el nivel desglosando los campos.
        INSERT INTO Nivel (
            CostoNivel, TituloNivel, Descripcion, Video, Id_Curso
        )
        VALUES (
            SUBSTRING_INDEX(v_Nivel, '|', 1),
            SUBSTRING_INDEX(SUBSTRING_INDEX(v_Nivel, '|', 2), '|', -1),
            SUBSTRING_INDEX(SUBSTRING_INDEX(v_Nivel, '|', 3), '|', -1),
            SUBSTRING_INDEX(SUBSTRING_INDEX(v_Nivel, '|', 4), '|', -1),
            p_Id_Curso
        );
    END WHILE;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE InsertarMultimedia(
    IN p_Id_Curso INT,
    IN p_Multimedia TEXT
)
BEGIN
    DECLARE v_Archivo TEXT;
    DECLARE v_Pos INT;

    WHILE LENGTH(p_Multimedia) > 0 DO
        -- Extrae el primer archivo (hasta el delimitador ';').
        SET v_Pos = LOCATE(';', p_Multimedia);
        IF v_Pos > 0 THEN
            SET v_Archivo = LEFT(p_Multimedia, v_Pos - 1);
            SET p_Multimedia = SUBSTRING(p_Multimedia, v_Pos + 1);
        ELSE
            SET v_Archivo = p_Multimedia;
            SET p_Multimedia = '';
        END IF;

       
        INSERT INTO Multimedia (
            Archivo, Id_Curso
        )
        VALUES (
            v_Archivo,
            p_Id_Curso
        );
    END WHILE;
END //

DELIMITER ;


/*EDITAR CURSO (SOLO CURSO, NO NIVELES)*/

DELIMITER //

CREATE PROCEDURE EditarCurso(
    IN p_Id_Curso INT,
    IN p_TituloCurso VARCHAR(100),
    IN p_CostoCompleto FLOAT,
    IN p_DescripcionCurso VARCHAR(200),
    IN p_ImagenCurso LONGBLOB,
    IN p_Id_Categoria INT
)
BEGIN
    
    IF EXISTS (SELECT 1 FROM Curso WHERE Id_Curso = p_Id_Curso) THEN
        UPDATE Curso
        SET 
            TituloCurso = p_TituloCurso,
            CostoCompleto = p_CostoCompleto,
            DescripcionCurso = p_DescripcionCurso,
            ImagenCurso = p_ImagenCurso,
            Id_Categoria = p_Id_Categoria
            WHERE Id_Curso = p_Id_Curso;
   
    END IF;
END //

DELIMITER ;




DELIMITER //

CREATE PROCEDURE BajaLogicaCurso(
    IN p_Id_Curso INT
)
BEGIN
    DELETE FROM Curso
    WHERE Id_Curso = p_Id_Curso;
END //


DELIMITER ;


/*-----------------COMENTARIO (Y ACTUALIZAR EL PROMEDIO DEL CURSO)---------------*/
DELIMITER //

CREATE PROCEDURE InsertarComentario(
    IN p_DescripcionComentario VARCHAR(200),
    IN p_CalificacionComentario VARCHAR(30),
    IN p_Id_Usuario INT,
    IN p_Id_Curso INT
)
BEGIN
    DECLARE v_NuevoPromedio FLOAT;

 
    INSERT INTO Comentario (
        DescripcionComentario,
        CalificacionComentario,
        FechaHoraCreacionComentario,
        EstatusComentario,
        FechaEliminacion,
        CausaEliminacion,
        Id_Usuario,
        Id_Curso
    )
    VALUES (
        p_DescripcionComentario,
        p_CalificacionComentario,
        NOW(),
        'Activo',
        NULL,
        NULL,
        p_Id_Usuario,
        p_Id_Curso
    );

    
    SET v_NuevoPromedio = CalcularPromedioCalificacionCURSO(p_Id_Curso);

   
    UPDATE Curso
    SET PromedioCalificacion = v_NuevoPromedio
    WHERE Id_Curso = p_Id_Curso;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE ActualizarComentarioBaja(
    IN p_Id_Comentario INT,                
    IN p_CausaEliminacion VARCHAR(100)      
)
BEGIN
    UPDATE Comentario
    SET 
        EstatusComentario = 'Inactivo',       
        CausaEliminacion = p_CausaEliminacion, 
        FechaEliminacion = NOW()              
    WHERE Id_Comentario = p_Id_Comentario;
END //

DELIMITER ;




