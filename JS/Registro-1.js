document.querySelector('.register-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Evitar la redirección del formulario

    // Obtener los valores de los campos
    const fullName = document.getElementById('full-name').value.trim();
    const birthDate = document.getElementById('birth-date').value;
    const email = document.getElementById('email').value.trim();
    const gender = document.getElementById('gender').value;
    const password = document.getElementById('password').value.trim();
    const userRole = document.getElementById('user-role').value;
    const userPhoto = document.getElementById('user-photo'); // Input del archivo de foto

    const messages = document.getElementById('messages');

    // Limpiar mensajes anteriores
    messages.style.display = 'none';
    messages.className = ''; // Eliminar clases previas
    messages.innerText = '';

    // Validaciones
    let valid = true;

    // Validar que ningún campo esté vacío
    if (!fullName || !birthDate || !email || !gender || !password || !userRole) {
        messages.className = 'alert alert-danger';
        messages.innerText = 'Todos los campos son obligatorios.';
        messages.style.display = 'block';
        valid = false;
    }

    // Validar que el Nombre Completo solo contenga letras
    const nameRegex = /^[a-zñA-ZÑáéíóúÁÉÍÓÚüÜ\s]+$/;
    if (valid && !nameRegex.test(fullName)) {
        messages.className = 'alert alert-danger';
        messages.innerText = 'El Nombre Completo solo debe contener letras.';
        messages.style.display = 'block';
        valid = false;
    }

    // Validar el formato del correo electrónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (valid && !emailRegex.test(email)) {
        messages.className = 'alert alert-danger';
        messages.innerText = 'El formato del Correo Electrónico no es válido.';
        messages.style.display = 'block';
        valid = false;
    }

    // Validar la contraseña
    const patronContra = /^(?=.*[a-zñ])(?=.*[A-ZÑ])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (valid && !patronContra.test(password)) {
        messages.className = 'alert alert-danger';
        messages.innerText = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.';
        messages.style.display = 'block';
        valid = false;
    }

    // Validar el avatar
    if (valid) {
        if (userPhoto.files.length === 0) {
            messages.className = 'alert alert-danger';
            messages.innerText = 'Por favor, selecciona una imagen de avatar.';
            messages.style.display = 'block';
            valid = false;
        } else {
            const extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
            const extensionArchivo = userPhoto.files[0].name.split('.').pop().toLowerCase();
            const tamanioMaximo = 2 * 1024 * 1024; // 2 MB

            if (!extensionesPermitidas.includes(extensionArchivo)) {
                messages.className = 'alert alert-danger';
                messages.innerText = 'Por favor, selecciona un archivo de imagen válido (jpg, jpeg, png, gif).';
                messages.style.display = 'block';
                valid = false;
            } else if (userPhoto.files[0].size > tamanioMaximo) {
                messages.className = 'alert alert-danger';
                messages.innerText = 'El archivo de imagen no debe superar los 2 MB.';
                messages.style.display = 'block';
                valid = false;
            }
        }
    }

    // Si las validaciones son correctas, enviar datos al servidor
    if (valid) {
        const formData = new FormData(this);

        fetch('../PHP/Registro.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                const messages = document.getElementById('messages');
                messages.style.display = 'block';
        
                if (data.success) {
                    messages.className = 'alert alert-success';
                    messages.innerText = data.message;
                    setTimeout(() => window.location.href = '../HTML/IniciarSesion.php', 2000);
                } else {
                    messages.className = 'alert alert-danger';
                    messages.innerText = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const messages = document.getElementById('messages');
                messages.style.display = 'block';
                messages.className = 'alert alert-danger';
                messages.innerText = 'Error al conectar con el servidor.';
            });
    }
});
