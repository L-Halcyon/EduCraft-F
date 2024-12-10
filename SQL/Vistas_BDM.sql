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

-- -------------------------
CREATE VIEW UsuariosInactivos AS
SELECT 
    Id_Usuario,
    NombreCompleto,
    Rol,
    EstatusUsuario,
    NumeroIntentosContraseña
FROM Usuario
WHERE NumeroIntentosContraseña >= 3 AND EstatusUsuario = 'Inactivo';
