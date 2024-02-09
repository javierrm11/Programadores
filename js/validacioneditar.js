window.addEventListener('load', () => {
    const formulario = document.getElementById("formulario");

    formulario.addEventListener('submit', (e) => {
        if (!validaCampos()) {
            e.preventDefault(); // Evita que el formulario se envíe si hay errores
        }
    });

    const validaCampos = () => {
        let camposValidos = true;

        camposValidos = validaCampo("usuario", "Debe tener menos de 20 caracteres", 20) && camposValidos;
        camposValidos = validaCampoCorreo("correo", "Sintaxis incorrecta") && camposValidos;


        camposValidos = validaCampoContraseña("contraseña", "Debe tener al menos 8 caracteres") && camposValidos;
        // Agrega validaciones para otros campos si es necesario

        return camposValidos;
    };

    const validaCampo = (campoId, mensajeExceso, maxLongitud) => {
        const campo = document.getElementById(campoId);
        const valor = campo.value.trim();
        const aviso = campo.nextElementSibling;

 
        if (valor.length > maxLongitud) {
            aviso.innerText = mensajeExceso;
            aviso.className = 'falla';
            return false;
        } else {
            aviso.innerText = '';
            aviso.className = '';
            return true;
        }
    };

    const validaCampoCorreo = (campoId, mensajeIncorrecto) => {
        const campo = document.getElementById(campoId);
        const valor = campo.value.trim();
        const aviso = campo.nextElementSibling;
    
        if (valor.length === 0) {
            aviso.innerText = '';
            aviso.className = '';
            return true;
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

        if (!opciones.length === 0) {
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

            if (!opciones.length === 0) {
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

        if (!opciones.length === 0) {
            aviso.innerText = '';
            aviso.className = '';
            return true;
        } 
    };
    const validaCampoContraseña = (campoId, mensajeExceso) => {
        const campo = document.getElementById(campoId);
        const valor = campo.value.trim();
        const aviso = campo.nextElementSibling;

        
        if ( valor.length >0) {
            if ( valor.length <8 ){
                aviso.innerText = mensajeExceso;
                aviso.className = 'falla';
                return false;
            }
            else {
                aviso.innerText = '';
                aviso.className = '';
                return true;
            }
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