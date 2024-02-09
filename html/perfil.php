<?php
$conectio = mysqli_connect('localhost', 'id21812402_javier', 'Jrr#108vivi', 'id21812402_proyecto');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/perfil.css">
    <script src="https://kit.fontawesome.com/5952267027.js" crossorigin="anonymous"></script>
</head>
<body>


<div class="header">
    <a href="../index.php" class="headera">Desarrolladores</a>
    <a href="../index.php" class="headera2">.NET</a>
    <nav class="nav">
        <div class="subnav">
            <button class="subnavbtn">Inicio <i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="../index.php">Dashboard</a>
                <a href="#">Perfil</a>
                <a href="./mensajes.php">Mensajes</a>
            </div>
        </div>
        <a href="">Servicios</a>
        <a href="">Acerca de</a>
        <a href="">Contanto</a>
    </nav>
    <div class="usuario">
        <?php
        if (isset($_SESSION['usuario'])) {
            ?>
            <div class="usuariom">
                <a href="../html/login.html" id="usuarios"><?php echo $_SESSION['usuario'];?></a>
                <a href="../php/cerrar.php" >Cerrar sesión</a>
            </div> 
            <?php
        } else {
            ?>
            <a id="sesion" href="./login.php">Inicia Sesión</a>
            <a id="sesion" href="./registrer.php">Registrate</a>
            <?php
        }
        ?>
    </div>
</div>

<?php
if (!isset($_SESSION['usuario'])) {
    ?>
    <div class="iniciar">
        <a href="./login.php" class="iniciosesion">Necesitas Iniciar Sesión, pincha aquí.</a>
        <a href="../index.php" class="volver">Volver</a>
    </div>
    <?php
} else {
    ?>
    <div class="container">
        <main>
            <h2 class="titulo-h2">Nuestro Perfil</h2>
                <?php
                $usuario = $_SESSION['usuario'];
                $sqldesa = "SELECT * FROM desarrolladores WHERE usuario = '$usuario'";
                $resultadoDesarrollador = mysqli_query($conectio, $sqldesa);
                $sqlusuarios = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
                $resultadousuario = mysqli_query($conectio, $sqlusuarios);

                if (mysqli_num_rows($resultadoDesarrollador) > 0) {
                    if ($resultadoDesarrollador) {
                        while ($row = $resultadoDesarrollador->fetch_array()) {
                            $usuario = $row['usuario'];
                            $correo = $row['correo'];
                            $tlf = $row['tlf'];
                            $especialidad = $row['especialidad'];
                            $pais = $row['pais'];
                            $imagen = $row['imagen'];
                            $descripcion = $row['descripcion'];
                            ?>
                            <article class="perfil-grup">
                                <img src="data:image/png;base64,<?php echo  base64_encode($row['imagen'])?>" alt="">
                                <section class="perfil">
                                    <h3 class="nombre-usuario"><?php echo $usuario?></h3>
                                    <div class="pro-div">
                                        <i class="fa-solid fa-envelope fa-lg"></i>
                                        <h4 class="correo"><?php echo $correo ?></h4>
                                    </div>
                                    <div class="pro-div">
                                        <i class="fa-solid fa-phone fa-lg"></i>
                                        <h4 class="tlf"><?php echo $tlf ?></h4>
                                    </div>
                                    <div class="pro-div">
                                        <i class="fa-solid fa-globe fa-lg"></i>
                                        <h4 class="pais"><?php echo $pais ?></h4>
                                    </div>
                                    <div class="pro-div2">
                                        <h4 class="espe">#</h4>
                                        <h4 class="espe"><?php echo $especialidad ?></h4>
                                    </div>
                                    <div class="descripcion">
                                        <h4 class="">Descripcion</h4>
                                        <p class=""><?php echo $descripcion ?></p>
                                    </div>
                                    <a href="./editarperfil.php" class="editar">Editar perfil</a>
                                    <a href="../index.php" class="volver">Volver</a>
                                </section>
                            </article>
                            <?php
                        }
                    }
                } elseif (mysqli_num_rows($resultadousuario) > 0) {
                    if ($resultadousuario) {
                        while ($row = $resultadousuario->fetch_array()) {
                            $usuario = $row['usuario'];
                            $correo = $row['correo'];
                            $pais = $row['pais'];
                            $tlf = $row['tlf'];
                            $descripcion = $row['descripcion'];
                            $desarrolloweb = $row['desarrolloweb'];
                            $desarrollomulti = $row['desarrollomulti'];
                            $desarrollomovil = $row['desarrollomovil'];
                            ?>
                            <article>
                                <section class="perfil-usuario">
                                    <h3 class="nombre-usuario-usu"><?php echo $usuario?></h3>
                                    <div class="pro-div">
                                        <i class="fa-solid fa-envelope fa-lg"></i>
                                        <h4 class="correo"><?php echo $correo ?></h4>
                                    </div>
                                    <div class="pro-div">
                                        <i class="fa-solid fa-phone fa-lg"></i>
                                        <h4 class="tlf"><?php echo $tlf ?></h4>
                                    </div>
                                    <div class="pro-div">
                                        <i class="fa-solid fa-globe fa-lg"></i>
                                        <h4 class="pais"><?php echo $pais ?></h4>
                                    </div>
                                    <div class="intereses">
                                        <h2>Intereses</h2>
                                        <div class="pro-div-inte">
                                            <h4 class="pais">Desarrollo Web: <?php echo $desarrolloweb ?></h4>
                                            <h4 class="pais">Desarrollo Multiplataforma: <?php echo $desarrollomulti ?></h4>
                                            <h4 class="pais">Desarrollo Movil: <?php echo $desarrollomovil ?></h4>
                                        </div>
                                    </div>
                                    <div class="descripcion-usu">
                                        <h4 class="">Descripcion</h4>
                                        <p class=""><?php echo $descripcion ?></p>
                                    </div>
                                    <a href="./editarperfil.php" class="editar">Editar perfil</a>
                                    <a href="../index.php" class="volver">Volver</a>
                                </section>
                            </article>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </main>
    </div>
<?php } ?>

</body>
</html>
