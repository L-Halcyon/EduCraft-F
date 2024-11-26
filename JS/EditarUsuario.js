document.getElementById('changeImageBtn').addEventListener('click', function() {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('userImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Validaciones
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    // Validación del nombre completo
    const nombreCompleto = document.getElementById('nombreCompleto').value;
    if (!/^[a-zA-Z\s]+$/.test(nombreCompleto)) {
        alert('El nombre completo solo debe contener letras.');
        return;
    }

    // Validación del correo electrónico
    const correoElectronico = document.getElementById('correoElectronico').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(correoElectronico)) {
        alert('Por favor ingresa un correo electrónico válido.');
        return;
    }

    // Validación del nombre de usuario
    const nombreUsuario = document.getElementById('nombreUsuario').value;
    if (nombreUsuario.length > 20) {
        alert('El nombre de usuario no debe tener más de 20 caracteres.');
        return;
    }

    // Validación de la contraseña
    const contrasena = document.getElementById('contrasena').value;
    const contrasenaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    if (!contrasenaRegex.test(contrasena)) {
        alert('La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, una letra minúscula y un número.');
        return;
    }

    // Si todas las validaciones pasan
    alert('Cambios guardados correctamente.');
});
