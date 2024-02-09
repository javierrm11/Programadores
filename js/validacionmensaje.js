window.addEventListener('load', () => {
    const formulario = document.getElementById("formulario");
    const mensajeError = document.getElementById("mensajeError");

    formulario.addEventListener('submit', (e) => {
        if (!validaCampos()) {
            e.preventDefault(); // Evita que el formulario se envíe si hay errores
        }
    });

    const validaCampos = () => {
        let camposValidos = true;

        camposValidos = validaCampo("message", "Campo vacío", "El mensaje debe tener al menos 20 caracteres", 20) && camposValidos;

        return camposValidos;
    };

    const validaCampo = (campoId, mensajeVacio, mensajeExceso, maxLongitud) => {
        const campo = document.getElementById(campoId);
        const valor = campo.value.trim();

        if (!valor) {
            mensajeError.innerText = mensajeVacio;
            mensajeError.className = 'falla';
            return false;
        } else if (valor.length < maxLongitud) {
            mensajeError.innerText = mensajeExceso;
            mensajeError.className = 'falla';
            return false;
        } else {
            mensajeError.innerText = '';
            mensajeError.className = '';
            return true;
        }
    };
});