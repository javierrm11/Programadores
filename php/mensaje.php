<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// Obtiene el ID del usuario (puedes ajustar esto según tu sistema de autenticación)
$conectio = mysqli_connect('172.17.0.2', 'root', 'Jrr#108vivi', 'docker');
$usuarioenvia = $_SESSION['usuario'];
$consultaUsuario = "SELECT * FROM usuariototales WHERE usuario = '$usuarioenvia'";
$resultadoUsuario = mysqli_query($conectio, $consultaUsuario);

if (mysqli_num_rows($resultadoUsuario) > 0) {
    // El usuario existe, ahora puedes realizar la inserción en la tabla mensajes
    $usuariorecibe = $_POST["desarrollador"];
    $mensaje = $_POST["message"];
    $consulta = "INSERT INTO mensajes (usuarioenvia, usuariorecibe, mensaje) VALUES ('$usuarioenvia', '$usuariorecibe', '$mensaje')";
    mysqli_query($conectio, $consulta);
    header("location: ../index.php");
} else {
    echo "El usuario que envía el mensaje no existe.";
}
?>
