function guardarSeleccion() {
    var seleccionEspecialidad = document.getElementById("filtrarEspecialidad").value;
    localStorage.setItem("especialidadSeleccionada", seleccionEspecialidad);

    var seleccionValoracion = document.getElementById("filtrarValoracion").value;
    localStorage.setItem("valoracionSeleccionada", seleccionValoracion);
    
    var seleccionValoracion = document.getElementById("filtrarFeed").value;
    localStorage.setItem("feedSeleccionada", seleccionValoracion);
}

// Función para cargar la elección de especialidad y valoración desde el almacenamiento local
function cargarSeleccion() {
    var seleccionGuardadaEspecialidad = localStorage.getItem("especialidadSeleccionada");
    console.log("Especialidad guardada:", seleccionGuardadaEspecialidad);
    if (seleccionGuardadaEspecialidad) {
        document.getElementById("filtrarEspecialidad").value = seleccionGuardadaEspecialidad;
    }

    var seleccionGuardadaValoracion = localStorage.getItem("valoracionSeleccionada");
    console.log("Valoración guardada:", seleccionGuardadaValoracion);
    if (seleccionGuardadaValoracion) {
        document.getElementById("filtrarValoracion").value = seleccionGuardadaValoracion;
    }

    var seleccionGuardadaFeed = localStorage.getItem("feedSeleccionada");
    console.log("Valoración guardada:", seleccionGuardadaFeed);
    if (seleccionGuardadaFeed) {
        document.getElementById("filtrarFeed").value = seleccionGuardadaFeed;
    }
}