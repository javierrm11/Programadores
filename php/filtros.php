<?php
$conectio = mysqli_connect('localhost', 'id21812402_javier', 'Jrr#108vivi', 'id21812402_proyecto') or die(mysql_error($mysqli));
$especialidad = $_POST['filtrarEspecialidad'];

// Construir la consulta SQL
if ($especialidad == 'todos') {
    $sql = "SELECT * FROM desarrolladores";
} else {
    $sql = "SELECT * FROM desarrolladores WHERE especialidad = '$especialidad'";
}
?>