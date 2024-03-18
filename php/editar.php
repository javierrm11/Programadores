<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establecer la conexión a la base de datos
$conectio = mysqli_connect('172.17.0.2', 'root', 'Jrr#108vivi', 'docker');

// Iniciar sesión
session_start();

// Obtener el nombre de usuario de la sesión
$usuario = $_SESSION['usuario'];
// Obtener información del usuario desde la tabla 'usuarios'
$sqlusu = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$resultadoUsuario = mysqli_query($conectio, $sqlusu);
// Obtener información del usuario desde la tabla 'desarrolladores'
$sqldesarrollador = "SELECT * FROM desarrolladores WHERE usuario = '$usuario'";
$resultadoDesarrollador = mysqli_query($conectio, $sqldesarrollador);

// Deshabilitar las verificaciones de clave externa (foreign key checks)
$conectio->query("SET foreign_key_checks = 0");

if (mysqli_num_rows($resultadoDesarrollador) > 0) {
    // El usuario es un desarrollador
    if ($row = $resultadoDesarrollador->fetch_array()) {
        $usuario = $row['usuario'];
        $correo = $row['correo'];
        $tlf = $row['tlf'];
        $especialidad = $row['especialidad'];
        $pais = $row['pais'];
        $imagen = $row['imagen'];
        $descripcion = $row['descripcion'];
        $contraseña = $row['contraseña'];

        // Obtener datos actualizados del formulario
        $usuarionuevo = $usuario;
        if(isset($_POST["usuario"]) && !empty($_POST["usuario"])){
            $usuarionuevo = $_POST["usuario"];
        }

        $correonuevo = $correo;
        if(isset($_POST["correopost"]) && !empty($_POST["correopost"])){
            $correonuevo = $_POST["correopost"];
        }

        $tlfnuevo = $tlf;
        if(isset($_POST["tlf"]) && !empty($_POST["tlf"])){
            $tlfnuevo = $_POST["tlf"];
        }

        $especialidadnuevo = $especialidad;
        if(isset($_POST["trabajo"]) && !empty($_POST["trabajo"])){
            $especialidadnuevo = $_POST["trabajo"];
        }

        // Verificar si se cargó un nuevo archivo de imagen
        if (isset($_FILES["archivo"]["tmp_name"]) && !empty($_FILES["archivo"]["tmp_name"])) {
            // Codificar la imagen en base64 antes de almacenarla en la base de datos
            $imagen_contenido = file_get_contents($_FILES['archivo']['tmp_name']);
            $imagennuevo = base64_encode($imagen_contenido);
        } else {
            $imagennuevo = $row['imagen']; // Mantener la imagen existente
        }

        $paisnuevo = $pais;
        if(isset($_POST["pais"]) && !empty($_POST["pais"])){
            $paisnuevo = $_POST["pais"];
        }

        $descripcionnuevo = $descripcion;
        if(isset($_POST["Descripcion"]) && !empty($_POST["Descripcion"])){
            $descripcionnuevo = $_POST["Descripcion"];
        }

        $contraseñanuevo = $contraseña;
        if(isset($_POST["contraseña"]) && !empty($_POST["contraseña"])){
            $contraseñanuevo = $_POST["contraseña"];
        }
        $profesion = isset($_POST['profesion']);
        if (!isset($_POST['profesion'])){
            $profesion = "";
        }
        if ($profesion == "Cliente"){
            $desarrollowebnuevo = 'no';
            if(isset($_POST["desarrolloweb"]) && !empty($_POST["desarrolloweb"])){
                $desarrollowebnuevo = $_POST["desarrolloweb"];
            }

            $desarrollomultinuevo = 'no';
            if(isset($_POST["desarrollomulti"]) && !empty($_POST["desarrollomulti"])){
                $desarrollomultinuevo = $_POST["desarrollomulti"];
            }

            $desarrollomovilnuevo = 'no';
            if(isset($_POST["desarrollomulti"]) && !empty($_POST["desarrollomovil"])){
                $desarrollomovilnuevo = $_POST["desarrollomovil"];
            }

            $consultausuarioinse = "INSERT INTO usuarios (usuario, correo,  desarrolloweb, desarrollomulti, desarrollomovil, contraseña) 
            VALUES ('$usuarionuevo', '$correonuevo', '$desarrollowebnuevo', '$desarrollomultinuevo', '$desarrollomovilnuevo', '$contraseñanuevo')";
            mysqli_query($conectio, $consultausuarioinse);

            $consulta10 = "DELETE FROM desarrolladores WHERE usuario = '$usuario'";
                mysqli_query($conectio, $consulta10);
            $_SESSION['usuario'] = $usuarionuevo;
            header("location: ../html/perfil.php");
            }else {
                $consulta = "UPDATE desarrolladores SET usuario = '$usuarionuevo', correo = '$correonuevo', tlf = $tlfnuevo, pais = '$paisnuevo', imagen = ?,
                especialidad = '$especialidadnuevo', contraseña = '$contraseñanuevo', descripcion = '$descripcionnuevo' WHERE usuario = '$usuario'";
                $declaracion = mysqli_prepare($conectio, $consulta);
                mysqli_stmt_bind_param($declaracion, "s", $imagennuevo);
                mysqli_stmt_send_long_data($declaracion, 4, $imagennuevo);
                mysqli_stmt_execute($declaracion);
                mysqli_stmt_close($declaracion);
                
                //borrar de la tabla desarrollador
                

                $_SESSION['usuario'] = $usuarionuevo;
                header("location: ../html/perfil.php");
            }
}
} else {
    // El usuario es un cliente
    if ($row = $resultadoUsuario->fetch_array()) {
        $usuario = $row['usuario'];
        $correo = $row['correo'];
        $desarrolloweb = $row['desarrolloweb'];
        $desarrollomulti = $row['desarrollomulti'];
        $desarrollomovil = $row['desarrollomovil'];
        $contraseña = $row['contraseña'];

        $usuarionuevo = $usuario;
        if(isset($_POST["usuario"]) && !empty($_POST["usuario"])){
            $usuarionuevo = $_POST["usuario"];
        }

        $correonuevo = $correo;
        if(isset($_POST["correopost"]) && !empty($_POST["correopost"])){
            $correonuevo = $_POST["correopost"];
        }

        $desarrollowebnuevo = $desarrolloweb;
        if(isset($_POST["desarrolloweb"]) && !empty($_POST["desarrolloweb"])){
            $desarrollowebnuevo = $_POST["desarrolloweb"];
        }

        $desarrollomultinuevo = $desarrollomulti;
        if(isset($_POST["desarrollomulti"]) && !empty($_POST["desarrollomulti"])){
            $desarrollomultinuevo = $_POST["desarrollomulti"];
        }

        $desarrollomovilnuevo = $desarrollomovil;
        if(isset($_POST["desarrollomulti"]) && !empty($_POST["desarrollomovil"])){
            $desarrollomovilnuevo = $_POST["desarrollomovil"];
        }

        $contraseñanuevo = $contraseña;
        if(isset($_POST["contraseña"]) && !empty($_POST["contraseña"])){
            $contraseñanuevo = $_POST["contraseña"];
        }

        $profesion = isset($_POST['profesion']);
        if (!isset($_POST['profesion'])){
            $profesion = "";
        }
        if ($profesion == "Desarrollador"){
            $tlfnuevo = 666666666;
            if(isset($_POST["tlf"]) && !empty($_POST["tlf"])){
                $tlfnuevo = $_POST["tlf"];
            }

            $especialidadnuevo = "";
            if(isset($_POST["trabajo"]) && !empty($_POST["trabajo"])){
                $especialidadnuevo = $_POST["trabajo"];
            }

            // Verificar si se cargó un nuevo archivo de imagen
            if (isset($_FILES["archivo"]["tmp_name"]) && !empty($_FILES["archivo"]["tmp_name"])) {
                // Codificar la imagen en base64 antes de almacenarla en la base de datos
                $imagen_contenido = file_get_contents($_FILES['archivo']['tmp_name']);
                $imagennuevo = base64_encode($imagen_contenido);
            } else {
                $imagennuevo = ""; // Mantener la imagen existente
            }

            $paisnuevo = "";
            if(isset($_POST["pais"]) && !empty($_POST["pais"])){
                $paisnuevo = $_POST["pais"];
            }

            $descripcionnuevo = "";
            if(isset($_POST["Descripcion"]) && !empty($_POST["Descripcion"])){
                $descripcionnuevo = $_POST["Descripcion"];
            }

            $consultainse = "INSERT INTO desarrolladores (usuario, correo, tlf, pais, imagen, especialidad, contraseña, descripcion, mediavota, num_feedback) 
            VALUES ('$usuarionuevo', '$correonuevo', $tlfnuevo, '$paisnuevo', ?, '$especialidadnuevo', '$contraseñanuevo', '$descripcionnuevo', 0, 0)";
            $declaracion = mysqli_prepare($conectio, $consultainse);
            mysqli_stmt_bind_param($declaracion, "s", $imagennuevo);
            mysqli_stmt_send_long_data($declaracion, 4, $imagennuevo);
            mysqli_stmt_execute($declaracion);
            mysqli_stmt_close($declaracion);

            $consulta10 = "DELETE FROM usuarios WHERE usuario = '$usuario'";
            mysqli_query($conectio, $consulta10);
            header("location: ../html/perfil.php");   

            
        }  else{

        // Actualizar información del cliente en la tabla 'usuarios'
        $consulta = "UPDATE usuarios SET usuario = '$usuarionuevo', correo = '$correonuevo', desarrolloweb = '$desarrollowebnuevo', desarrollomulti = '$desarrollomulti',
        desarrollomovil = '$desarrollomovilnuevo', contraseña = '$contraseñanuevo' WHERE usuario = '$usuario'";

        mysqli_query($conectio, $consulta);
        header("location: ../html/perfil.php");   
        }
    }
}


// Cerrar la conexión
mysqli_close($conectio);
?>