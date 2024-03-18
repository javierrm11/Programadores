<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conectio = mysqli_connect('172.17.0.2', 'root', 'Jrr#108vivi', 'docker');
insertar($conectio);

function insertar($conectio){
    $usuario = $_POST['usuario'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $profesion = $_POST['profesion'] ?? '';
    $tlf = $_POST['tlf'] ?? '';
    $pais = $_POST['pais'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $descripcion = $_POST['Descripcion'] ?? '';

    // Verificar si se ha enviado un archivo
    $consulta_verificacion = "SELECT COUNT(*) as count FROM usuariototales WHERE usuario = '$usuario'";
    $resultado_verificacion = mysqli_query($conectio, $consulta_verificacion);
    $fila_verificacion = mysqli_fetch_assoc($resultado_verificacion);

    /*añadir a bd*/
    if ($profesion == 'Desarrollador') {
        // Validar el número de teléfono antes de insertarlo
        if (!preg_match("/^\d{9}$/", $tlf)) {
            echo "Error: El número de teléfono no es válido.";
            return;
        }
        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
            // Leer el contenido del archivo
            $imagen_contenido = file_get_contents($_FILES['archivo']['tmp_name']);
            // Escapar el contenido para evitar problemas con caracteres especiales
            $imagen_contenido = $conectio->real_escape_string($imagen_contenido);
        } else {
            // Manejar el caso en el que no se ha enviado un archivo
            echo "Error: No se ha enviado ningún archivo.";
            return;
        }

        $especialidad = $_POST['trabajo'] ?? '';
        $consultaini = "INSERT INTO usuariototales(usuario) VALUES('$usuario')";
        mysqli_query($conectio, $consultaini);
        $consulta2 = "INSERT INTO desarrolladores(usuario, correo, tlf, pais, imagen, especialidad, contraseña, descripcion, mediavota)
        VALUES('$usuario', '$correo', '$tlf', '$pais', '$imagen_contenido', '$especialidad', '$contraseña', '$descripcion', 0)";
        mysqli_query($conectio, $consulta2);
        header("location: ../html/login.php");
    } else {
        $desarrolloweb = isset($_POST['desarrolloweb']) ? 'si' : 'no';
        $desarrollomulti = isset($_POST['desarrollomulti']) ? 'si' : 'no';
        $desarrollomovil = isset($_POST['desarrollomovil']) ? 'si' : 'no';
        $consultaini = "INSERT INTO usuariototales(usuario) VALUES('$usuario')";
        mysqli_query($conectio, $consultaini);
        $consulta2 = "INSERT INTO usuarios(usuario, correo, desarrolloweb, desarrollomulti, desarrollomovil, contraseña)
        VALUES('$usuario', '$correo', '$desarrolloweb', '$desarrollomulti', '$desarrollomovil', '$contraseña')";
        mysqli_query($conectio, $consulta2);
        header("location: ../html/login.php");
    }

    mysqli_close($conectio);
}
?>