/*-----------------VISTAS----------------*/

USE DB_BDM_CURSOS;

DELIMITER //
/*MOSTRAR CATEGORIAS (EN LOS COMBOBOX A LA HORA DE CREAR UN CURSO O BUSCARLO)*/

CREATE VIEW VistaCategorias AS
SELECT 
    c.Id_Categoria,
    c.NombreCategoria AS Nombre,
    c.DescripcionCategoria AS Descripcion,
    c.FechaHoraCreacionCategoria AS FechaCreacion,
    u.NombreCompleto AS UsuarioCreador
FROM 
    Categoria c
LEFT JOIN 
    Usuario u
ON 
    c.Id_Usuario = u.Id_Usuario
WHERE 
    c.Id_Categoria IS NOT NULL;


DELIMITER ;

DELIMITER //
/*Mostrar en la pantalla principal los 5 cursos mejor calificados*/
CREATE VIEW Top5CursosMejorCalificados AS
SELECT 
    Id_Curso,
    TituloCurso,
    PromedioCalificacion,
    CostoCompleto,
    DescripcionCurso,
    ImagenCurso
FROM 
    Curso
WHERE 
    EstatusCurso = 'Activo' 
ORDER BY 
    PromedioCalificacion DESC
LIMIT 5;


DELIMITER ;



/*Mostrar en la pantalla principal los 5 cursos mas recientes*/
DELIMITER //

CREATE VIEW Top5CursosMasRecientes AS
SELECT 
    Id_Curso,
    TituloCurso,
    FechaCreacionCurso,
    CostoCompleto,
    DescripcionCurso,
    ImagenCurso,
    PromedioCalificacion
FROM 
    Curso
WHERE 
    EstatusCurso = 'Activo' 
ORDER BY 
    FechaCreacionCurso DESC
LIMIT 5;

DELIMITER ;