<?php
session_start();
// Conecta a la base de datos
$conexion = mysqli_connect('172.17.0.2', 'root', 'Jrr#108vivi', 'docker');

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];


$consulta = mysqli_query($conexion, "SELECT * FROM usuarios where usuario = '$usuario' and contraseña = '$contraseña'");
$consulta2 = mysqli_query($conexion, "SELECT * FROM desarrolladores where usuario = '$usuario' and contraseña = '$contraseña'");
// Inicializar la respuesta
$respuesta = array('autenticado' => false);

// Verificar las credenciales en ambas tablas
if ($consulta->num_rows > 0) {
    $_SESSION['usuario'] = $usuario;
    $respuesta = array('autenticado' => true, 'tipo' => 'usuario');

} elseif ($consulta2->num_rows > 0) {
    $_SESSION['usuario'] = $usuario;
    $respuesta = array('autenticado' => true, 'tipo' => 'desarrollador');

}

// Cerrar la conexión


// Devuelve la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($respuesta);
$conexion->close();
?>