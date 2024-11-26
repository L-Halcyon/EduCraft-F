document.addEventListener('DOMContentLoaded', () => {
    const sendButton = document.querySelector('.btn-send');
    const messageContainer = document.querySelector('.message-container');
    const chatTitle = document.getElementById('chat-title');
    const instructorLinks = document.querySelectorAll('.instructor-link');

    // Enviar mensaje del estudiante
    sendButton.addEventListener('click', () => {
        const messageText = document.querySelector('textarea').value.trim();
        if (messageText !== '') {
            const newMessage = document.createElement('div');
            newMessage.classList.add('message', 'instructor'); // Clase del instructor

            // Crear el mensaje con la imagen y el texto del estudiante
            newMessage.innerHTML = `
                <img src="/img/Instructor.jpg" alt="Instructor">
                <div class="message-content">
                    <p>${messageText}</p>
                    <span class="timestamp">${new Date().toLocaleString()}</span>
                </div>
            `;

            // Agregar el nuevo mensaje al contenedor
            messageContainer.appendChild(newMessage);

            // Limpiar el textarea después de enviar el mensaje
            document.querySelector('textarea').value = '';

            // Desplazar el contenedor de mensajes hacia abajo para mostrar el último mensaje
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }
    });

    // Cambiar el título del chat al hacer clic en un curso/alumno
    instructorLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // Evitar la recarga de la página

            // Obtener el texto del curso/instructor seleccionado
            const selectedCourse = link.textContent;

            // Cambiar el título del chat al nombre del curso/instructor seleccionado
            chatTitle.textContent = `Mensajes Privados - ${selectedCourse}`;
        });
    });
});
