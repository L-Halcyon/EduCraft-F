CREATE DATABASE IF NOT EXISTS DB_BDM_CURSOS;
USE DB_BDM_CURSOS;
-- DROP DATABASE DB_BDM_CURSOS;

CREATE TABLE Usuario (
    Id_Usuario INT AUTO_INCREMENT PRIMARY KEY,
    Rol VARCHAR(20),
    ImagenAvatar longblob ,
    NombreCompleto VARCHAR(100),
    Genero VARCHAR(20),
    FechaNacimiento DATE,
    Email VARCHAR(50) UNIQUE,
    Contraseña VARCHAR(20),
    NumeroIntentosContraseña INT,
    FechaRegistroYActualizacionInfo DATETIME,
    EstatusUsuario VARCHAR(15)
);


CREATE TABLE Categoria (
    Id_Categoria INT AUTO_INCREMENT PRIMARY KEY,
    NombreCategoria VARCHAR(100),
    DescripcionCategoria VARCHAR(200),
    FechaHoraCreacionCategoria DATETIME,
    Id_Usuario INT,
	EstatusCategoria VARCHAR(15),

    FOREIGN KEY (Id_Usuario) REFERENCES Usuario(Id_Usuario)
);


CREATE TABLE Curso (
    Id_Curso INT AUTO_INCREMENT PRIMARY KEY,
    TituloCurso VARCHAR(100),
    CantidadNiveles INT,
    CostoCompleto FLOAT,
    DescripcionCurso VARCHAR(200),
    PromedioCalificacion FLOAT,
    ImagenCurso longblob,
    EstatusCurso VARCHAR(20),
    NumeroVentas INT,
    FechaCreacionCurso DATETIME,
    Id_Usuario INT,
    Id_Categoria INT,
    FOREIGN KEY (Id_Usuario) REFERENCES Usuario(Id_Usuario),
    FOREIGN KEY (Id_Categoria) REFERENCES Categoria(Id_Categoria)
);


CREATE TABLE Nivel (
    Id_Nivel INT AUTO_INCREMENT PRIMARY KEY,
    CostoNivel FLOAT,
    TituloNivel VARCHAR(100),
    Descripcion VARCHAR(200),
    Video VARCHAR(200),
    Id_Curso INT,
    FOREIGN KEY (Id_Curso) REFERENCES Curso(Id_Curso)
);


CREATE TABLE Multimedia (
    Id_Multimedia INT AUTO_INCREMENT PRIMARY KEY,
    Archivo VARCHAR(200),
    Id_Curso INT,
    FOREIGN KEY (Id_Curso) REFERENCES Curso(Id_Curso)
);


CREATE TABLE Comentario (
    Id_Comentario INT AUTO_INCREMENT PRIMARY KEY,
    DescripcionComentario VARCHAR(200),
    CalificacionComentario VARCHAR(30),
    FechaHoraCreacionComentario DATETIME,
    EstatusComentario VARCHAR(20),
    FechaEliminacion DATETIME,
    CausaEliminacion VARCHAR(100),
    Id_Usuario INT,
    Id_Curso INT,
    FOREIGN KEY (Id_Usuario) REFERENCES Usuario(Id_Usuario),
    FOREIGN KEY (Id_Curso) REFERENCES Curso(Id_Curso)
);


CREATE TABLE Transaccion (
    Id_Transaccion INT AUTO_INCREMENT PRIMARY KEY,
    FechaInscripcion DATETIME,
    FechaTerminacion DATETIME,
    FechaUltimoAcceso DATETIME,
    MetodoPago VARCHAR(100),
    MontoPagado FLOAT,
    ProgresoCurso INT,
    Id_Usuario INT,
    Id_Curso INT,
    FOREIGN KEY (Id_Usuario) REFERENCES Usuario(Id_Usuario),
    FOREIGN KEY (Id_Curso) REFERENCES Curso(Id_Curso)
);


CREATE TABLE Diploma (
    Id_Diploma INT AUTO_INCREMENT PRIMARY KEY,
    Id_Transaccion INT,
    FOREIGN KEY (Id_Transaccion) REFERENCES Transaccion(Id_Transaccion)
);


CREATE TABLE Mensaje (
    Id_Mensaje INT AUTO_INCREMENT PRIMARY KEY,
    TextoMensaje VARCHAR(200),
    FechaHoraMensaje DATETIME,
    Id_Usuario INT,
    FOREIGN KEY (Id_Usuario) REFERENCES Usuario(Id_Usuario)
);
