/*-----------------VISTAS----------------*/

USE DB_BDM_CURSOS;

DROP VIEW IF EXISTS VistaCategorias;
DROP VIEW IF EXISTS Top5CursosMejorCalificados;
DROP VIEW IF EXISTS Top5CursosMasRecientes;


-- Vista: Mostrar categorías
DROP VIEW IF EXISTS VistaCategorias;

CREATE VIEW VistaCategorias AS
SELECT 
    c.Id_Categoria,
    c.NombreCategoria AS Nombre,
    c.DescripcionCategoria AS Descripcion,
    c.FechaHoraCreacionCategoria AS FechaCreacion,
    u.NombreCompleto AS UsuarioCreador,
    c.EstatusCategoria
FROM 
    Categoria c
LEFT JOIN 
    Usuario u
ON 
    c.Id_Usuario = u.Id_Usuario;

-- Vista: Top 5 Cursos Mejor Calificados
DROP VIEW IF EXISTS Top5CursosMejorCalificados;

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

-- Vista: Top 5 Cursos Más Recientes
DROP VIEW IF EXISTS Top5CursosMasRecientes;

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



DROP VIEW IF EXISTS VistaCursosPorUsuario;

CREATE VIEW VistaCursosPorUsuario AS
SELECT
    c.Id_Curso,
    c.TituloCurso,
    c.CantidadNiveles,
    c.CostoCompleto,
    c.DescripcionCurso,
    c.PromedioCalificacion,
    c.ImagenCurso,
    c.EstatusCurso,
    c.NumeroVentas,
    c.FechaCreacionCurso,
    c.Id_Usuario,
    c.Id_Categoria,
    cat.NombreCategoria,
    cat.DescripcionCategoria
FROM
    Curso c
JOIN
    Categoria cat ON c.Id_Categoria = cat.Id_Categoria;




DROP VIEW IF EXISTS Vista_CursoConCategoria;

CREATE VIEW Vista_CursoConCategoria AS
SELECT 
    c.Id_Curso,
    c.TituloCurso,
    c.DescripcionCurso,
    c.CostoCompleto,
    c.ImagenCurso,
    cat.Id_Categoria,
    cat.NombreCategoria
FROM Curso c
JOIN Categoria cat ON c.Id_Categoria = cat.Id_Categoria;

