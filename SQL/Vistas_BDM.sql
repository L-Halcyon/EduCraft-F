/*-----------------VISTAS----------------*/

USE DB_BDM_CURSOS;

<<<<<<< Updated upstream
DROP VIEW IF EXISTS VistaCategorias;
DROP VIEW IF EXISTS Top5CursosMejorCalificados;
DROP VIEW IF EXISTS Top5CursosMasRecientes;


-- Vista: Mostrar categorías
=======
-- Vista: Mostrar categorías 
>>>>>>> Stashed changes
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



<<<<<<< Updated upstream
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


-- -------------------------
=======
-- Usuarios inactivos
>>>>>>> Stashed changes
CREATE VIEW UsuariosInactivos AS
SELECT 
    Id_Usuario,
    NombreCompleto,
    Rol,
    EstatusUsuario,
    NumeroIntentosContraseña
FROM Usuario
WHERE NumeroIntentosContraseña >= 3 AND EstatusUsuario = 'Inactivo';

<<<<<<< Updated upstream



DROP VIEW IF EXISTS VistaCursosInstructoresReporte;

CREATE VIEW VistaCursosInstructoresReporte AS
SELECT 
    u.Email AS Usuario,
    u.NombreCompleto AS Nombre,
    u.FechaRegistroYActualizacionInfo AS FechaIngreso,
    COUNT(c.Id_Curso) AS CursosOfrecidos
FROM 
    Usuario u
JOIN 
    Curso c ON u.Id_Usuario = c.Id_Usuario
WHERE 
    u.EstatusUsuario = 'Activo'
GROUP BY 
    u.Id_Usuario;
=======
-- ------------------------------- Para buscar cursos

-- Vista para mostrar todos los cursos
CREATE VIEW vw_todos_los_cursos AS
SELECT Curso.*, Usuario.NombreCompleto AS NombreInstructor, Categoria.NombreCategoria
FROM Curso
INNER JOIN Usuario ON Curso.Id_Usuario = Usuario.Id_Usuario
INNER JOIN Categoria ON Curso.Id_Categoria = Categoria.Id_Categoria;

-- Vista para los cursos más vendidos
CREATE VIEW vw_cursos_mas_vendidos AS
SELECT * FROM vw_todos_los_cursos
ORDER BY NumeroVentas DESC
LIMIT 5;

-- Vista para los cursos más recientes
CREATE VIEW vw_cursos_mas_recientes AS
SELECT * FROM vw_todos_los_cursos
ORDER BY FechaCreacionCurso DESC
LIMIT 5;

-- Vista para los cursos mejor calificados
CREATE VIEW vw_cursos_mejor_calificados AS
SELECT * FROM vw_todos_los_cursos
ORDER BY PromedioCalificacion DESC
LIMIT 5;
>>>>>>> Stashed changes




DROP VIEW IF EXISTS VistaCursosVendedor;

CREATE VIEW VistaCursosVendedor AS
SELECT 
    c.Id_Curso,
    c.TituloCurso,
    c.CantidadNiveles,
    COUNT(t.Id_Transaccion) AS AlumnosInscritos,
    ROUND(SUM(t.ProgresoCurso / 100.0 * c.CantidadNiveles) / COUNT(t.Id_Transaccion), 1) AS NivelPromedioCursado,
    SUM(t.MontoPagado) AS IngresosTotales
FROM 
    Curso c
LEFT JOIN 
    Transaccion t ON c.Id_Curso = t.Id_Curso

GROUP BY 
    c.Id_Curso;
