/*-----------------VISTAS----------------*/

USE DB_BDM_CURSOS;

DROP VIEW IF EXISTS VistaCategorias;
DROP VIEW IF EXISTS Top5CursosMejorCalificados;
DROP VIEW IF EXISTS CursosView;


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

-- ------------------------------- MIS VIEWS XD
DROP VIEW IF EXISTS CursosActivos;
DROP VIEW IF EXISTS top5cursosmejorcalificados;
DROP VIEW IF EXISTS top5cursosmasrecientes;
DROP VIEW IF EXISTS vistacategorias;
DROP VIEW IF EXISTS VistaTodoLosCursos;

-- Cursos activos
CREATE VIEW VistaCursosActivos AS
SELECT 
    c.Id_Curso,
    c.TituloCurso,
    c.CantidadNiveles,
    c.CostoCompleto,
    c.DescripcionCurso,
    c.PromedioCalificacion,
    c.ImagenCurso,
    c.NumeroVentas,
    c.FechaCreacionCurso,
    u.NombreCompleto AS PublicadoPor,
    cat.NombreCategoria
FROM Curso c
JOIN Usuario u ON c.Id_Usuario = u.Id_Usuario
JOIN Categoria cat ON c.Id_Categoria = cat.Id_Categoria
WHERE c.EstatusCurso = 'Activo';

-- Los mas vendidos
CREATE VIEW VistaCursosMasVendidos AS
SELECT * 
FROM VistaCursosActivos
ORDER BY NumeroVentas DESC;

-- Los mejor calificados
CREATE VIEW VistaCursosMejorCalificados AS
SELECT * 
FROM VistaCursosActivos
ORDER BY PromedioCalificacion DESC;

-- Los más recientes
CREATE VIEW VistaCursosMasRecientes AS
SELECT * 
FROM VistaCursosActivos
ORDER BY FechaCreacionCurso DESC;

-- Cursos con detalles completos
CREATE VIEW VistaDetalleCursos AS
SELECT 
    c.Id_Curso,
    c.TituloCurso,
    c.DescripcionCurso,
    c.CostoCompleto,
    c.FechaCreacionCurso,
    c.NumeroVentas,
    c.PromedioCalificacion,
    cat.NombreCategoria,
    u.NombreCompleto AS PublicadoPor
FROM Curso c
JOIN Categoria cat ON c.Id_Categoria = cat.Id_Categoria
JOIN Usuario u ON c.Id_Usuario = u.Id_Usuario
WHERE c.EstatusCurso = 'Activo';

-- -------------------------------------
CREATE VIEW VistaCursos AS
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
    cat.NombreCategoria,
    u.NombreCompleto AS Instructor
FROM Curso c
INNER JOIN Categoria cat ON c.Id_Categoria = cat.Id_Categoria
INNER JOIN Usuario u ON c.Id_Usuario = u.Id_Usuario
WHERE c.EstatusCurso = 'Activo';



