<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/Registro.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
    <header>
            <a href="../HTML/PaginaPrincipal.php" class="logo-link">
                <h1>EduCraft</h1>
            </a>
    </header>
   
    <div class="main-content">
        <h2 class="page-title">Crear Cuenta</h2>
        <p class="subtitle">Comienza a aprender a tu propio ritmo</p>
        <form class="register-form" action="../PHP/Registro.php" method="POST" enctype="multipart/form-data" novalidate>
        <div class="row">
                <div class="form-group col-md-6">
                    <label for="full-name">Nombre Completo:</label>
                    <input type="text" class="form-control custom-input" id="full-name" name="full-name">
                </div>
                <div class="form-group col-md-6">
                    <label for="birth-date">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control custom-input" id="birth-date" name="birth-date" >
                </div>
            </div>
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control custom-input" id="email" name="email" >
                </div>
                <div class="form-group col-md-6">
                    <label for="gender">Género:</label>
                    <select class="form-control custom-input" id="gender" name="gender" >
                        <option value="">Seleccionar género</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
            </div>
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="user-photo">Foto de Usuario:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="user-photo" name="user-photo" accept="image/*">
                        <label class="custom-file-label" for="user-photo">Elegir archivo</label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control custom-input" id="password" name="password" >
                </div>
            </div>
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="user-role">Rol de Usuario:</label>
                    <select class="form-control custom-input" id="user-role" name="user-role" >
                        <option value="">Seleccionar Rol</option>
                        <option value="estudiante">Estudiante</option>
                        <option value="profesor">Profesor</option>
                        <option value="administrador">Administrador</option>

                    </select>
                </div>
            </div>
                        <!-- Mensajes de validación -->
                        <div id="messages" class="alert d-none" style="display: none;"></div>

            <div class="text-center">
                <button type="submit" class="btn custom-button">Registrarme</button>
            </div>
        </form>
        <p class="text-center mt-3">¿Ya tienes cuenta de EduCraft? <a href="../HTML/IniciarSesion.php">Iniciar Sesión</a></p>
    </div>
    
    <footer>
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom Script to Show File Name -->
    <script>
        // Mostrar el nombre del archivo seleccionado
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("user-photo").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
    <script src="../JS/Registro-1.js"></script>
</body>
</html>
