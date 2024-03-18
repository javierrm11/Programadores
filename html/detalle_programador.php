<?php
// Conexión a la base de datos
session_start();
$conectio = mysqli_connect('172.17.0.2', 'root', 'Jrr#108vivi', 'docker');
$usuariosesion = $_SESSION['usuario'] ?? "";
if ($conectio) {
    // Obtén el nombre de usuario del parámetro en la URL
    $usuario = isset($_GET['usuario']) ? mysqli_real_escape_string($conectio, $_GET['usuario']) : '';

    // Construir la consulta SQL para obtener la información del desarrollador
    $sql = "SELECT * FROM desarrolladores WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conectio, $sql);

    if ($resultado) {
        // Obtén la información del desarrollador
        $row = $resultado->fetch_array();
        $correo = $row['correo'];
        $tlf = $row['tlf'];
        $especialidad = $row['especialidad'];
        $pais = $row['pais'];
        $media = $row['mediavota'];
        $imagen_base64 = base64_encode($row['imagen']);
        // ... (otras variables según sea necesario)
    }
}

// Cierra la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Desarrollador - <?php echo $usuario; ?></title>
    <link rel="stylesheet" href="../css/programador.css"/>
    <script src="https://kit.fontawesome.com/5952267027.js" crossorigin="anonymous"></script>
    <!-- Agrega tus estilos CSS aquí -->
</head>
<body>
<div class="header">
            <div class="titulos">
                <div class="titulo-ab">
                    <a href="../index.php" class="headera">Desarrolladores</a>
                    <a href="../index.php" class="headera2">.NET</a>
                </div>
                <div class="usuario" id="usuario">
                    <?php
                    if (isset($_SESSION['usuario'])) {
                    ?>
                    <div class="usuariom">
                        <a href="../html/perfil.php"id="usuarios"><?php echo $_SESSION['usuario'];?></a>
                        <a href="../php/cerrar.php" >Cerrar sesión</a>
                    </div> 
                    <?php
                } else {
                    ?>
                    <a id="sesion" href="../html/login.php">Inicia Sesión</a>
                    <a id="sesion" href="../html/registrer.php">Registrate</a>
                    <?php
                }
                ?>
                </div>
            </div>
            <div class="container-header">
                <nav class="nav">
                    <div class="subnav">
                        <button class="subnavbtn">Inicio <i class="fa fa-caret-down"></i></button>
                        <div class="subnav-content">
                            <a href="../index.php">Dashboard</a>
                            <a href="../html/perfil.php">Perfil</a>
                            <a href="../html/mensajes.php">Mensajes</a>
                        </div>
                    </div>
                    <a href="">Servicios</a>
                    <a href="">Acerca de</a>
                    <a href="">Contacto</a>
                </nav>
                
                <script src="../js/menu.js"></script>
            </div>
        </div>
    </header>

    <main>
        <!-- Muestra la información del desarrollador -->
        <article class="profesional">
            <img src="data:image/png;base64,<?php echo $imagen_base64; ?>" alt="">
            <section class="desa-info">
                <h4 class="profesional-titulo"><?php echo $usuario; ?></h4>
                
                <!-- Muestra otras informaciones como correo, teléfono, especialidad, etc. -->
                <div class="pro-div">
                    <i class="fa-solid fa-envelope fa-sm"></i>
                    <h4 class="correo"><?php echo $correo; ?></h4>
                </div>
                <div class="pro-div">
                    <i class="fa-solid fa-phone fa-sm"></i>
                    <h4 class="tlf"><?php echo $tlf; ?></h4>
                </div>
                <div class="pro-div">
                    <i class="fa-solid fa-globe fa-sm"></i>
                    <h4 class="pais"><?php echo $pais; ?></h4>
                </div>
                <div class="pro-div">
                    <h4 class="espe">#</h4>
                    <h4 class="espe"><?php echo $especialidad; ?></h4>
                </div>

                <div class="calificador">
                    <!-- Imprime las estrellas según la media -->
                    <div class="estrellas" id="estrellas">
                        <?php
                        for ($i = 1; $i <= $media; $i++) {
                            echo '<span class="estrella">&#9733;</span>';
                        }
                        ?>
                    </div>
                </div>
                
                <div class="opiniones">
                    <h5>Feedback</h5>
                    <?php
                    $sql2 = "SELECT * FROM feedback_table WHERE desarrollador = '$usuario'";
                    $resultado2 = mysqli_query($conectio, $sql2);
                    if ($resultado2) {
                        while ($row = $resultado2->fetch_array()) {
                            $user = $row['usuario'];
                            $mensaje = $row['feedback'];
                    ?>
                            <section class="feedback">
                                <p class="usuarioenvio"><?php echo $user ?></p>
                                <p class="feedback-p"><?php echo $mensaje ?></p>
                            </section>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    if ($usuario == $usuariosesion) {
                        echo "";
                    } else if ($usuariosesion == "") {
                        echo "";
                    } else {
                    ?>
                        <aside class="añadir-opi">
                            <h5>Hacer opinión:</h5>
                            <form action="../php/feedback.php?usuario=<?php echo urlencode($usuario); ?>" method="post">
                                <section class="form-div">
                                    <textarea name="fedd" id="fedd"></textarea>
                                </section>
                                <button type="submit" class="submit">Subir</button>
                            </form>
                        </aside>
                    <?php
                    }
                    ?>
                </div>
            </section>
        </article>

        <!-- Agrega enlaces o contenido adicional según sea necesario -->
    </main>
</body>
</html>