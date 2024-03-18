<?php
$conectio = mysqli_connect('172.17.0.2', 'root', 'Jrr#108vivi', 'docker');
$especialidad = $_POST['filtrarEspecialidad'];

// Construir la consulta SQL
if ($especialidad == 'todos') {
    $sql = "SELECT * FROM desarrolladores";
} else {
    $sql = "SELECT * FROM desarrolladores WHERE especialidad = '$especialidad'";
}
?>