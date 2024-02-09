<?php
session_start();
$conectio = mysqli_connect('localhost', 'id21812402_javier', 'Jrr#108vivi', 'id21812402_proyecto') or die(mysql_error($mysqli));

insertar($conectio);

function insertar($conectio){
    $feedback = $_POST['fedd'];
    $usuario = $_SESSION['usuario'] ;
    $desarrollador = isset($_GET['usuario']) ? mysqli_real_escape_string($conectio, $_GET['usuario']) : '';
    $consulta = "INSERT INTO feedback_table(usuario, feedback, desarrollador)
        VALUES('$usuario', '$feedback', '$desarrollador')";
        mysqli_query($conectio, $consulta);
        header("location: ../html/detalle_programador.php?usuario=$desarrollador");
}

    ?>