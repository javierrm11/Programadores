window.addEventListener('load', () => {
    const formulario = document.getElementById("formulario");

    formulario.addEventListener('submit', (e) => {
        if (!validaCampos()) {
            e.preventDefault(); // Evita que el formulario se envíe si hay errores
        }
    });

    const validaCampos = () => {
        let camposValidos = true;

        camposValidos = validaCampo("usuario", "Campo vacío", "Debe tener menos de 20 caracteres", 20) && camposValidos;
        camposValidos = validaCampoCorreo("correo", "Campo vacío", "Sintaxis incorrecta") && camposValidos;
        camposValidos = validaRadio("profesion", "Selecciona una opción") && camposValidos;

        // Verifica si la opción "Cliente" está seleccionada
        const clienteRadioButton = document.getElementById("Cliente");
        if (clienteRadioButton.checked) {
            camposValidos = validaCheckbox("desarrolloweb", "Selecciona al menos una opción") && camposValidos;
        }
        const desarrolladorRadioButton = document.getElementById("html");
        if (desarrolladorRadioButton.checked) {
            camposValidos = validaRadiodesa("trabajo", "Selecciona una especialización") && camposValidos;
        }
        camposValidos = validaCampoContraseña("contraseña", "Campo vacío", "Debe tener al menos 8 caracteres") && camposValidos;
        // Agrega validaciones para otros campos si es necesario

        return camposValidos;
    };

    const validaCampo = (campoId, mensajeVacio, mensajeExceso, maxLongitud) => {
        const campo = document.getElementById(campoId);
        const valor = campo.value.trim();
        const aviso = campo.nextElementSibling;

        if (!valor) {
            aviso.innerText = mensajeVacio;
            aviso.className = 'falla';
            return false;
        } else if (valor.length > maxLongitud) {
            aviso.innerText = mensajeExceso;
            aviso.className = 'falla';
            return false;
        } else {
            aviso.innerText = '';
            aviso.className = '';
            return true;
        }
    };

    const validaCampoCorreo = (campoId, mensajeVacio, mensajeIncorrecto) => {
        const campo = document.getElementById(campoId);
        const valor = campo.value.trim();
        const aviso = campo.nextElementSibling;

        if (!valor) {
            aviso.innerText = mensajeVacio;
            aviso.className = 'falla';
            return false;
        } else if (!validaCorreo(valor)) {
            aviso.innerText = mensajeIncorrecto;
            aviso.className = 'falla';
            return false;
        } else {
            aviso.innerText = '';
            aviso.className = '';
            return true;
        }
    };

    const validaRadio = (grupoName, mensaje) => {
        const opciones = document.querySelectorAll(`input[name="${grupoName}"]:checked`);
        const aviso = document.querySelector(`input[name="${grupoName}"]`).closest('.form-div').querySelector('p');

        if (opciones.length === 0) {
            aviso.innerText = mensaje;
            aviso.className = 'falla';
            return false;
        } else {
            aviso.innerText = '';
            aviso.className = '';
            return true;
        }
    };

    const validaCheckbox = (checkboxName, mensaje) => {
        // Verifica si la opción "Cliente" está seleccionada antes de validar el checkbox
        const clienteRadioButton = document.getElementById("Cliente");
        if (clienteRadioButton.checked) {
            const checkboxes = document.querySelectorAll(`input[name="${checkboxName}"]:checked`);
            const aviso = document.querySelector(`input[name="${checkboxName}"]`).closest('.div-masinfo').querySelector('p');

            if (checkboxes.length === 0) {
                aviso.innerText = mensaje;
                aviso.className = 'falla';
                return false;
            } else {
                aviso.innerText = '';
                aviso.className = '';
                return true;
            }
        } else {
            // Si la opción "Cliente" no está seleccionada, no es necesario validar el checkbox
            return true;
        }
    };
    const validaRadiodesa = (grupoName, mensaje) => {
        const opciones = document.querySelectorAll(`input[name="${grupoName}"]:checked`);
        const aviso = document.querySelector(`input[name="${grupoName}"]`).closest('.form-div').querySelector('p');

        if (opciones.length === 0) {
            aviso.innerText = mensaje;
            aviso.className = 'falla';
            return false;
        } else {
            aviso.innerText = '';
            aviso.className = '';
            return true;
        }
    };
    const validaCampoContraseña = (campoId, mensajeVacio, mensajeExceso) => {
        const campo = document.getElementById(campoId);
        const valor = campo.value.trim();
        const aviso = campo.nextElementSibling;

        if (!valor) {
            aviso.innerText = mensajeVacio;
            aviso.className = 'falla';
            return false;
        } else if (valor.length < 8) {
            aviso.innerText = mensajeExceso;
            aviso.className = 'falla';
            return false;
        } else {
            aviso.innerText = '';
            aviso.className = '';
            return true;
        }
    };

    const validaCorreo = (correo) => {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(correo);
    };
});