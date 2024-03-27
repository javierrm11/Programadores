<?php
$conectio = mysqli_connect('sql113.infinityfree.com', 'if0_36209740', 'Jrr108vivi', 'if0_36209740_programadores');
$especialidad = $_POST['filtrarEspecialidad'];

// Construir la consulta SQL
if ($especialidad == 'todos') {
    $sql = "SELECT * FROM desarrolladores";
} else {
    $sql = "SELECT * FROM desarrolladores WHERE especialidad = '$especialidad'";
}
?>