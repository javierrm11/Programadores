document.addEventListener('DOMContentLoaded', function () {
    const form = document.forms['form'];
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        const usuario = form.elements['usuario'].value;
        const contraseña = form.elements['contraseña'].value;

        // Validaciones del lado del cliente
        if (!usuario || !contraseña) {
            mostrarError('Por favor, completa todos los campos.');
            return;
        }

        // Realizar solicitud al servidor
        validarCredenciales(usuario, contraseña);
    });
});

function mostrarError(mensaje) {
    // Muestra un mensaje de error en algún elemento HTML (puede ser un div, span, etc.)
    const errorElement = document.querySelector('p');
    errorElement.innerText = mensaje;
    errorElement.className = 'falla';
}

function validarCredenciales(usuario, contraseña) {
    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    const url = '../php/login.php';
    const params = `usuario=${encodeURIComponent(usuario)}&contraseña=${encodeURIComponent(contraseña)}`;

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Manejar la respuesta del servidor
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const respuesta = JSON.parse(xhr.responseText);

                // Manejar la respuesta del servidor
                if (respuesta.autenticado) {
                    // Autenticación exitosa, redirige o realiza otras acciones
                    alert('Inicio de sesión exitoso');
                    
                    window.location.href = respuesta.tipo === 'usuario' ? '../index.php' : '../index.php';
                } else {
                    // Autenticación fallida, muestra un mensaje de error
                    mostrarError('Usuario o contraseña incorrectos.');
                }
            } else {
                // Muestra un mensaje de error genérico
                mostrarError('Error al intentar iniciar sesión.');
            }
        }
    };

    // Enviar la solicitud al servidor
    xhr.send(params);
}