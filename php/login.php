<?php
session_start();
// Conecta a la base de datos
$conexion = mysqli_connect('sql113.infinityfree.com', 'if0_36209740', 'Jrr108vivi', 'if0_36209740_programadores');

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];


$consulta = mysqli_query($conexion, "SELECT * FROM usuarios where usuario = '$usuario' and contrasena = '$contraseña'");
$consulta2 = mysqli_query($conexion, "SELECT * FROM desarrolladores where usuario = '$usuario' and contrasena = '$contraseña'");
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