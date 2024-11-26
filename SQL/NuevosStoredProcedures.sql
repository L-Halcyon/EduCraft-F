USE DB_BDM_CURSOS;


-- LOGIN
DELIMITER //

CREATE PROCEDURE IniciarSesion(
    IN p_Email VARCHAR(50),
    IN p_Contraseña VARCHAR(20),
    OUT p_EstatusSesion VARCHAR(50) -- Parámetro de salida para indicar el estado del inicio de sesión
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
        -- Si no existe el usuario
        SET p_EstatusSesion = 'Usuario no encontrado';
    ELSE
        -- Si el usuario existe, obtenemos sus datos
        SELECT Contraseña, NumeroIntentosContraseña, EstatusUsuario
        INTO v_ContraseñaActual, v_NumeroIntentos, v_EstatusUsuario
        FROM Usuario
        WHERE Email = p_Email;

        -- Verifica si el usuario está inactivo
        IF v_EstatusUsuario = 'Inactivo' THEN
            SET p_EstatusSesion = 'Usuario inactivo por intentos fallidos. Contacte a un administrador.';
        ELSE
            -- Compara la contraseña
            IF p_Contraseña = v_ContraseñaActual THEN
                -- Si la contraseña es correcta, restablece el número de intentos a 0
                UPDATE Usuario
                SET NumeroIntentosContraseña = 0
                WHERE Email = p_Email;

                SET p_EstatusSesion = 'Inicio de sesión exitoso'; -- Contraseña correcta
            ELSE
                -- Si la contraseña es incorrecta, incrementa el número de intentos
                UPDATE Usuario
                SET NumeroIntentosContraseña = NumeroIntentosContraseña + 1
                WHERE Email = p_Email;

                SET p_EstatusSesion = 'Contraseña incorrecta'; -- Contraseña incorrecta
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
    -- Validación: Campos vacíos
    /*
    IF p_Rol IS NULL OR p_Rol = '' OR
       p_NombreCompleto IS NULL OR p_NombreCompleto = '' OR
       p_Genero IS NULL OR p_Genero = '' OR
       p_FechaNacimiento IS NULL OR
       p_Email IS NULL OR p_Email = '' OR
       p_Contraseña IS NULL OR p_Contraseña = '' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Todos los campos son obligatorios.';
    END IF;
*/
    -- Validación: Este correo ya está registrado
    IF EXISTS (
        SELECT 1 FROM Usuario WHERE Email = p_Email
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Este correo ya está registrado.';
    END IF;
/*
    -- Validación: El nombre completo solo debe contener letras (incluido la ñ y espacios)
    IF p_NombreCompleto NOT REGEXP '^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]+$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El nombre completo solo debe contener letras.';
    END IF;

    -- Validación: El correo no es válido
    IF p_Email NOT REGEXP '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El correo no es válido.';
    END IF;

    -- Validación: La contraseña debe contener al menos 8 caracteres, una mayúscula, un carácter especial y un número
    IF LENGTH(p_Contraseña) < 8 OR
       p_Contraseña NOT REGEXP '.*[A-Z].*' OR
       p_Contraseña NOT REGEXP '.*[0-9].*' OR
       p_Contraseña NOT REGEXP '.*[!@#$%^&*(),.?":{}|<>].*' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, un carácter especial y un número.';
    END IF;
*/
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




