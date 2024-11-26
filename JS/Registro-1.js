document.querySelector('.register-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Evitar la redirección del formulario

    const formData = new FormData(this); // Obtener datos del formulario
    const messages = document.getElementById('messages');

    fetch('../PHP/Registro.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mostrar mensaje de éxito
                messages.className = 'alert alert-success';
                messages.innerText = data.message;
                messages.style.display = 'block';
                
                // Redirigir después de 2 segundos
                setTimeout(() => {
                    window.location.href = '../HTML/IniciarSesion.php';
                }, 2000);
            } else {
                // Mostrar mensaje de error
                messages.className = 'alert alert-danger';
                messages.innerText = data.message;
                messages.style.display = 'block';
            }
        })
        .catch(error => {
            messages.className = 'alert alert-danger';
            messages.innerText = 'Error al conectar con el servidor.';
            messages.style.display = 'block';
        });
});
