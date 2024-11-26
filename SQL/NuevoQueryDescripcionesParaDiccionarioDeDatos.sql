/*---------DESCRIPCIONES PARA CADA COLUMNA-----------*/
USE DB_BDM_CURSOS;

/*Usuario*/
ALTER TABLE Usuario
MODIFY COLUMN Id_Usuario INT AUTO_INCREMENT COMMENT 'Identificador único para la tabla Usuario',
MODIFY COLUMN Rol VARCHAR(20) COMMENT 'Ya sea Administrador, Estudiante o Instructor',
MODIFY COLUMN ImagenAvatar longblob COMMENT 'Ruta de la imagen de perfil del usuario',
MODIFY COLUMN NombreCompleto VARCHAR(100) COMMENT 'Nombre completo del usuario',
MODIFY COLUMN Genero VARCHAR(20) COMMENT 'Género del usuario',
MODIFY COLUMN FechaNacimiento DATE COMMENT 'Fecha de nacimiento del usuario',
MODIFY COLUMN Email VARCHAR(50) UNIQUE COMMENT 'Correo electrónico del usuario',
MODIFY COLUMN Contraseña VARCHAR(20) COMMENT 'Debe de incluir 8 caracteres al menos, y debe incluir una mayúscula, un carácter especial, y un número al menos.',
MODIFY COLUMN NumeroIntentosContraseña INT COMMENT 'Máximo 3 intentos, sino, se deshabilitará el Usuario',
MODIFY COLUMN FechaRegistroYActualizacionInfo DATETIME COMMENT 'Se guarda tanto cuando se registra, así como también cuando se modifica la información personal, se sobrescribe la fecha',
MODIFY COLUMN EstatusUsuario VARCHAR(15) COMMENT 'Ya sea Activo o Inactivo';



/*Categoria*/
ALTER TABLE Categoria
MODIFY COLUMN Id_Categoria INT AUTO_INCREMENT COMMENT 'Identificador único para la tabla Categoria',
MODIFY COLUMN NombreCategoria VARCHAR(100) COMMENT 'Nombre de la categoría de los cursos',
MODIFY COLUMN DescripcionCategoria VARCHAR(200) COMMENT 'Se explica el tipo de cursos que contendrá.',
MODIFY COLUMN FechaHoraCreacionCategoria DATETIME COMMENT 'Fecha y hora de la creación de la categoría',
MODIFY COLUMN Id_Usuario INT COMMENT 'Id del usuario que creó la categoría';



/*Curso*/
ALTER TABLE Curso
MODIFY COLUMN Id_Curso INT AUTO_INCREMENT COMMENT 'Identificador único para la tabla Curso',
MODIFY COLUMN TituloCurso VARCHAR(100) COMMENT 'Título del curso',
MODIFY COLUMN CantidadNiveles INT COMMENT 'Número total de niveles en el curso',
MODIFY COLUMN CostoCompleto FLOAT COMMENT 'Costo del curso, aunque puede haber cursos completamente gratis',
MODIFY COLUMN DescripcionCurso VARCHAR(200) COMMENT 'Descripción del curso',
MODIFY COLUMN PromedioCalificacion FLOAT COMMENT 'Este se actualizará constantemente dependiendo de los comentarios y calificaciones que se hagan. Sacando un promedio de estas',
MODIFY COLUMN ImagenCurso longblob COMMENT 'Imagen representativa del curso',
MODIFY COLUMN EstatusCurso VARCHAR(20) COMMENT 'Activo o Inactivo',
MODIFY COLUMN NumeroVentas INT COMMENT 'Este se actualizaría constantemente dependiendo de las transacciones que se hagan, se hace una operación COUNT y el resultado se pone en esta columna',
MODIFY COLUMN FechaCreacionCurso DATETIME COMMENT 'Fecha de creación del curso',
MODIFY COLUMN Id_Usuario INT COMMENT 'Id del usuario que creó el curso',
MODIFY COLUMN Id_Categoria INT COMMENT 'Id de la categoría del curso';



/*Nivel*/
ALTER TABLE Nivel
MODIFY COLUMN Id_Nivel INT AUTO_INCREMENT COMMENT 'Identificador único para la tabla Nivel',
MODIFY COLUMN CostoNivel FLOAT COMMENT 'Costo del nivel, aunque puede haber niveles completamente gratis',
MODIFY COLUMN TituloNivel VARCHAR(100) COMMENT 'Título del nivel dentro del curso',
MODIFY COLUMN Descripcion VARCHAR(200) COMMENT 'Descripción del contenido del nivel',
MODIFY COLUMN Video VARCHAR(200) COMMENT 'Todo Nivel debe de contener uno, mostrando lo que se abarcará en ese nivel',
MODIFY COLUMN Id_Curso INT COMMENT 'Id del curso al que pertenece el nivel';



/*Multimedia*/
ALTER TABLE Multimedia
MODIFY COLUMN Id_Multimedia INT AUTO_INCREMENT COMMENT 'Identificador único para la tabla Multimedia',
MODIFY COLUMN Archivo VARCHAR(200) COMMENT 'Puede ser PDF, algún archivo adjunto, imágenes, videos, etc.',
MODIFY COLUMN Id_Curso INT COMMENT 'Id del curso al que pertenece el archivo multimedia';



/*Comentario*/
ALTER TABLE Comentario
MODIFY COLUMN Id_Comentario INT AUTO_INCREMENT COMMENT 'Identificador único para la tabla Comentario',
MODIFY COLUMN DescripcionComentario VARCHAR(200) COMMENT 'Texto del comentario dejado por un usuario',
MODIFY COLUMN CalificacionComentario VARCHAR(30) COMMENT 'Puede ser "Me gustó" o "No me gustó"',
MODIFY COLUMN FechaHoraCreacionComentario DATETIME COMMENT 'Fecha y hora de la creación del comentario',
MODIFY COLUMN EstatusComentario VARCHAR(20) COMMENT 'Ya sea Activo o Inactivo',
MODIFY COLUMN FechaEliminacion DATETIME COMMENT 'Fecha en la que el comentario fue eliminado (si aplica)',
MODIFY COLUMN CausaEliminacion VARCHAR(100) COMMENT 'Mensaje de por qué el administrador lo dio de baja',
MODIFY COLUMN Id_Usuario INT COMMENT 'Id del usuario que hizo el comentario',
MODIFY COLUMN Id_Curso INT COMMENT 'Id del curso al que pertenece el comentario';



/*Transaccion*/
ALTER TABLE Transaccion
MODIFY COLUMN Id_Transaccion INT AUTO_INCREMENT COMMENT 'Identificador único para la tabla Transacción',
MODIFY COLUMN FechaInscripcion DATETIME COMMENT 'Fecha en la que el usuario se inscribió al curso',
MODIFY COLUMN FechaTerminacion DATETIME COMMENT 'Se mantendrá vacío este campo hasta que se complete el curso',
MODIFY COLUMN FechaUltimoAcceso DATETIME COMMENT 'Última fecha en la que el usuario accedió al curso',
MODIFY COLUMN MetodoPago VARCHAR(100) COMMENT 'Método de pago usado para la inscripción (Tarjeta, Efectivo...)',
MODIFY COLUMN MontoPagado FLOAT COMMENT 'Monto total pagado por el usuario',
MODIFY COLUMN ProgresoCurso INT COMMENT 'Progreso del curso en porcentaje',
MODIFY COLUMN Id_Usuario INT COMMENT 'Id del usuario que realizó la transacción',
MODIFY COLUMN Id_Curso INT COMMENT 'Id del curso al que pertenece la transacción';



/*Diploma*/
ALTER TABLE Diploma
MODIFY COLUMN Id_Diploma INT AUTO_INCREMENT COMMENT 'Identificador único para la tabla Diploma',
MODIFY COLUMN Id_Transaccion INT COMMENT 'Id de la transacción asociada al diploma';



/*Mensaje*/
ALTER TABLE Mensaje
MODIFY COLUMN Id_Mensaje INT AUTO_INCREMENT COMMENT 'Identificador único para la tabla Mensaje',
MODIFY COLUMN TextoMensaje VARCHAR(200) COMMENT 'Texto del mensaje enviado',
MODIFY COLUMN FechaHoraMensaje DATETIME COMMENT 'Fecha y hora en que se envió el mensaje',
MODIFY COLUMN Id_Usuario INT COMMENT 'Id del usuario que envió el mensaje';