<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/IniciarSesion.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <a href="../HTML/PaginaPrincipal.php" class="logo-link">
            <h1>EduCraft</h1>
        </a>
    </header>
    
    <div class="main-content">
        <h2 class="page-title">Iniciar Sesión</h2>
        <p class="subtitle">Comienza a aprender a tu propio ritmo</p>

        <div id="messages" class="d-none alert alert-danger" role="alert">
            <?php
            session_start(); // Iniciar la sesión para acceder a los mensajes
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']); // Limpiar el mensaje después de mostrarlo
            }
            ?>
        </div>

        <form class="login-form" id="loginForm" method="POST" action="../PHP/IniciarSesion.php">
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="text" class="form-control custom-input" id="email" name="email">
                <div id="emailError" class="text-danger"></div>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control custom-input" id="password" name="password">
                <div id="passwordError" class="text-danger"></div>
            </div>
            <button type="submit" class="btn custom-button">Iniciar Sesión</button>
        </form>
        <p class="text-center mt-3">¿No tienes cuenta? <a href="../HTML/Registro.php">Crear Cuenta</a></p>
    </div>

    <footer>
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../JS/IniciarSesion-1.js"></script>
</body>
</html>
