<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conectio = mysqli_connect('localhost', 'id21812402_javier', 'Jrr#108vivi', 'id21812402_proyecto') or die(mysqli_error($conectio));

$votacion = $_POST["estrellas"];
$Desarrollador = $_POST["desarrollador"];
$usuario = $_SESSION['usuario'];

// Inserta la votación en la base de datos

// Verificar si el usuario ya votó por ese desarrollador
$verificacion = "SELECT COUNT(*) as count FROM votaciones WHERE usuario = '$usuario' AND desarrollador = '$Desarrollador'";
$resultado = mysqli_query($conectio, $verificacion);

if ($resultado) {
    $row = mysqli_fetch_assoc($resultado);

    if ($row['count'] == 0) {
        // El usuario no ha votado por este desarrollador, proceder con la inserción
        $consulta = "INSERT INTO votaciones (votacion, desarrollador, usuario) VALUES ($votacion, '$Desarrollador', '$usuario')";
        mysqli_query($conectio, $consulta);
        header("location: ../index.php");
    } else {
        // El usuario ya ha votado por este desarrollador, puedes manejar esto según tus necesidades
        echo "Ya has votado por este desarrollador.";
    }
} else {
    // Manejo de errores en la consulta SQL
    echo "Error en la consulta: " . mysqli_error($conectio);
}

// Cerrar la conexión
mysqli_close($conectio);
?>