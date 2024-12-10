<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/EditarUsuario-Admin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light-brown">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-brown">
        <a class="navbar-brand font-weight-bold text-brown" href="#">
            <h1>EduCraft Admin</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-brown" href="../HTML/DesbloqueoUsuarios.php">Desbloqueo de Usuarios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-brown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario Admin
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../HTML/EditarUsuario-Admin.php">Perfil</a>
                        <a class="dropdown-item" href="../HTML/EliminarComentarios.php">Comentarios</a>
                        <a class="dropdown-item" href="../HTML/Categorias-Admin.php">Gestion de categorias</a>
                        <a class="dropdown-item" href="../HTML/Reportes-Admin.php">Reporte de Usuarios</a>

                        <a class="dropdown-item" href="../HTML/PaginaPrincipal.php">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <form enctype="multipart/form-data">
    <div class="container mt-5">
        <div class="row">
            <!-- Columna de la Foto del Usuario -->
            <div class="col-md-4 text-center">
                <div class="image-container-wrapper"> <!-- Caja envolvente con margen -->
                    <div class="image-container">
                        <img id="userImage" src="../img/perfil.jpg" class="img-fluid rounded mb-3" alt="Imagen del usuario">
                    </div>
                </div>
                <input type="file" id="fileInput" name="imagenUsuario" accept="image/*" class="d-none">
                <button id="changeImageBtn" class="btn btn-brown btn-block">Cambiar foto de usuario</button>
            </div>
            
    
            <!-- Columnas de los Campos del Formulario -->
            <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombreCompleto" class="text-brown">Nombre Completo:</label>
                                <input type="text" class="form-control border-brown form-background" id="nombreCompleto" placeholder="Nombre Completo">
                            </div>
                            <div class="form-group">
                                <label for="genero" class="text-brown">Género:</label>
                                <select class="form-control border-brown form-background" id="genero" required>
                                    <option>Seleccionar género</option>
                                    <option>Masculino</option>
                                    <option>Femenino</option>
                                    <option>Otro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="correoElectronico" class="text-brown">Correo electrónico:</label>
                                <input type="email" class="form-control border-brown form-background" id="correoElectronico" placeholder="Correo electrónico" readonly>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaNacimiento" class="text-brown">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control border-brown form-background" id="fechaNacimiento" >
                            </div>
                            <div class="form-group">
                                <label for="contrasena" class="text-brown">Contraseña:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control border-brown form-background" id="contrasena" placeholder="Contraseña">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-brown" type="button" id="togglePassword">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-brown btn-block">Guardar cambios</button>
                            <!-- Botón Eliminar Cuenta -->
                            <div class="container text-center mt-4">
                                 <button class="btn btn-delete">Eliminar Cuenta</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
    

    <footer class="text-center mt-5 p-3 bg-brown text-brown">
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/JS/EditarUsuario-Admin.js"></script>
    <!-- Script para cargar el nombre del usuario -->
    <script src="../JS/EditarUsuario.js"></script>
    <script src="../JS/UsuarioLogueado-1.js"></script>
<script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        const passwordField = document.getElementById("contrasena");
        const toggleIcon = document.getElementById("toggleIcon");
        
        // Cambia el tipo del campo
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    });
</script>

</body>
</html>
