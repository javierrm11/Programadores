<?php
session_start();
$conectio = mysqli_connect('sql113.infinityfree.com', 'if0_36209740', 'Jrr108vivi', 'if0_36209740_programadores');

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