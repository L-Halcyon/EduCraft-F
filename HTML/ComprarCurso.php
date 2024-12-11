<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso de Diseño Web - EduCraft</title>
    <link rel="icon" href="../img/Logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/ComprarCurso.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body class="bg-light-brown">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-brown">
        <a class="navbar-brand font-weight-bold text-brown" href="../HTML/PaginaPrincipal-2.php">
            <h1>EduCraft</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
               <!--   <a class="nav-link text-brown" href="../HTML/Busqueda.php">Buscar cursos</a>-->
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-brown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario Estudiante
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../HTML/EditarUsuario.php">Perfil</a>
                        <a class="dropdown-item" href="../HTML/Kardex.php">Kardex</a>
                        <a class="dropdown-item" href="../HTML/ChatCursoInicio.php">Mensajes</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../HTML/PaginaPrincipal.php">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Imagen y detalles -->
            <div class="col-md-6">
                <img id="courseImage" class="img-fluid border rounded" alt="Imagen del curso">
                <p class="mt-2 text-brown">
                    <strong>Calificación del curso: </strong><span id="courseRating"></span><br>
                    <strong>Instructor del curso: </strong><span id="courseInstructor"></span>
                </p>
                <a id="messageInstructor" class="btn btn-outline-brown btn-block" href="../HTML/ChatCursoInicio.php">Enviar mensaje al instructor</a>
            </div>
            <!-- Descripción y compra -->
            <div class="col-md-6">
                <h2 id="courseTitle" class="font-weight-bold text-brown"></h2>
                <p id="courseDescription" class="text-brown"></p>
                <div class="mt-4">
                    <p class="text-brown font-weight-bold"><span id="coursePrice"></span></p>
                    <label for="paymentMethod" class="text-brown font-weight-bold">Selecciona un método de pago:</label>
                    <select id="paymentMethod" class="form-control">
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Paypal">Paypal</option>
                    </select>
                    <button id="buyButton" class="btn btn-brown btn-block mt-3">Comprar</button>
                    <div id="messages" class="alert mt-3" style="display: none;"></div>
                </div>
            </div>
        </div>

        <!-- Niveles del curso -->
        <h4 class="mt-5 font-weight-bold text-brown">Niveles del curso</h4>
        <div id="courseLevels"></div>

        <!-- Comentarios -->
        <h4 class="mt-5 font-weight-bold text-brown">Comentarios acerca del curso</h4>
        <div id="courseComments"></div>
    </div>

    <!--
    <!- Main Content ->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="../img/Diseño-Web.jpg" class="img-fluid border rounded" alt="Imagen del curso">
                <p class="mt-2 text-brown"><strong>Calificación del curso: </strong>(100%)<br><strong>Instructor del curso: </strong>(Brian Barrero)</p>
                <a class="btn btn-outline-brown btn-block" href="../PHP/Mensajeria-Estudiante.php">Enviar mensaje al instructor</a>
            </div>
            <div class="col-md-6">
                <h2 class="font-weight-bold text-brown">Curso de Diseño Web</h2>
                <p class="text-brown">Aprende a crear sitios web atractivos y funcionales con nuestro curso de Diseño Web. Domina el diseño responsive, la experiencia del usuario y las herramientas actuales para transformar tus ideas en interfaces impactantes.</p>
                <!- ComboBox and Purchase Button ->
                <div class="mt-4">
                    <!-<label for="purchaseOption" class="text-brown font-weight-bold">Selecciona una opción de compra:</label>
                    <select id="purchaseOption" class="form-control">
                        <option value="complete">Curso completo - $250</option>
                        <option value="level1">Nivel 1 - $85</option>
                        <option value="level2">Nivel 2 - $85</option>
                        <option value="level3">Nivel 3 - Gratis</option>
                    </select>->
                    <p id="purchasePrice" class="text-brown font-weight-bold"></p>
                    <button class="btn btn-brown btn-block mt-3">Comprar</button>
                </div>
            </div>
        </div>

        <!- Levels Section ->
        <h4 class="mt-5 font-weight-bold text-brown">Niveles del curso</h4>
        <div class="level bg-cream p-3 mb-3 rounded border">
            <p class="font-weight-bold text-brown">Nivel 1: Introducción al Diseño Web</p>
            <p>En este nivel aprenderás los fundamentos básicos del diseño web, incluyendo HTML y CSS. Al finalizar este nivel, serás capaz de crear páginas estáticas con diseño básico.</p>
        </div>
        <div class="level bg-cream p-3 mb-3 rounded border">
            <p class="font-weight-bold text-brown">Nivel 2: Diseño Responsivo</p>
            <p>Este nivel cubre el diseño adaptativo para dispositivos móviles y técnicas avanzadas de CSS. Serás capaz de crear sitios que se ajusten a diferentes tamaños de pantalla.</p>
        </div>
        <div class="level bg-cream p-3 mb-3 rounded border">
            <p class="font-weight-bold text-brown">Nivel 3: Interactividad con JavaScript</p>
            <p>En el último nivel, aprenderás a agregar interactividad a tus sitios web utilizando JavaScript. También veremos cómo integrar frameworks populares como Bootstrap.</p>
        </div>

        <!- Comments Section ->
        <h4 class="mt-5 font-weight-bold text-brown">Comentarios acerca del curso</h4>
        <div class="comment bg-cream p-3 mb-3 rounded border">
            <p class="font-weight-bold text-brown">Ana Nuñez <span class="float-right">7/Sep/2024 9:30 a.m. <span class="text-success">Me gusta</span></span></p>
            <p>¡Este curso de Diseño Web superó todas mis expectativas! Las clases son muy claras y prácticas, y las herramientas como Adobe XD y Figma se explican a fondo...</p>
        </div>
        <div class="comment bg-cream p-3 mb-3 rounded border">
            <p class="font-weight-bold text-brown">Luis Cisneros <span class="float-right">21/Oct/2024 10:00 p.m. <span class="text-danger">No me gusta</span></span></p>
            <p>No estoy satisfecho con el curso de Diseño Web. Aunque se mencionan herramientas como WordPress y Figma, sentí que el contenido era bastante básico...</p>
        </div>
        <p class="text-muted text-center">Comentario eliminado</p>
        <div class="comment bg-cream p-3 mb-3 rounded border">
            <p class="font-weight-bold text-brown">María Ramírez <span class="float-right">1/Nov/2024 12:00 p.m. <span class="text-success">Me gusta</span></span></p>
            <p>El curso de Diseño Web ofrece una introducción útil a herramientas como Adobe XD y WordPress. Los conceptos básicos están bien cubiertos...</p>
        </div>
        
    </div>-->

    <footer class="text-center mt-5 p-3 bg-brown text-brown">
        <p>© 2024 EduCraft. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Archivo JS personalizado -->
    <script src="../JS/UsuarioLogueado-1.js"></script>
    <script src="../JS/ComprarCurso.js"></script>

</body>
</html>
