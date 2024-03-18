<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red Social</title>
    <link rel="stylesheet" href="../css/mensajes.css">
    <script src="https://kit.fontawesome.com/5952267027.js" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</head>
<body onload="cargarSeleccion()">
    <?php
    $conectio = mysqli_connect('172.17.0.2', 'root', 'Jrr#108vivi', 'docker');
    if ($conectio) {
        $sql = "SELECT usuario FROM desarrolladores";
        $result = $conectio->query($sql);
        $sql_update = "
        UPDATE desarrolladores
        SET mediavota = IFNULL(
        (SELECT AVG(votacion) AS media
         FROM votaciones
         WHERE votaciones.usuario = desarrolladores.usuario), 0)
        ";
        $conectio->query($sql_update);
    }
    ?>
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
        <?php if (!isset($_SESSION['usuario'])) { ?>
            <div class="iniciar">
                <a href="../html/login.php" class="iniciosesion">Necesitas Iniciar Sesión, pincha aquí.</a>
                <a href="../index.php" class="volver">Volver</a>
            </div>
        <?php } else { ?>
            <article class="mensajes">
                <h2 class="mensajesh2">Mensajes</h2>
                <form id="formulario" name="form" method="post" action="../php/mensaje.php" novalidate>
                    <h3>Enviar mensaje</h3>
                    <section class="form-div">
                        <?php
                        $usuario = $_SESSION['usuario'] ;
                        $resultadoDesarrolladores = $conectio->query("SELECT usuario FROM usuariototales WHERE usuario != '$usuario'");
                        $desarrolladores = $resultadoDesarrolladores->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <h4 class="usuario-a">Nombre de Usuario:</h4>
                        <select id="desarrollador" name="desarrollador" required>
                            <?php foreach ($desarrolladores as $desarrollador) : ?>
                                <option value="<?php echo $desarrollador['usuario']; ?>"><?php echo $desarrollador['usuario']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </section>
                    <section class="mensaje-form">
                        <div class="form-div">
                            <h4 class="textmensaje">Mensaje</h4>
                            <textarea name="message" id="message"></textarea>
                        </div>
                        <p id="mensajeError" class="falla"></p>
                    </section>

                    <section class="form-div">
                        <input type="submit" value="Listo" class="submit" name="enviar">
                    </section>
                    <p></p>
                    <script src="../js/validacionmensaje.js"></script>
                </form>
                <a href="../index.php" class="volver">Volver</a>

                <aside class="mensajes-recibidos">
                    <h3>Mensajes Recibidos</h3>
                    <div class="recibidos-mensajes">
                        <?php
                        $sql2 = "SELECT * FROM mensajes WHERE usuariorecibe = '$usuario'";
                        $resultado2 = mysqli_query($conectio, $sql2);
                        if ($resultado2) {
                            while ($row = $resultado2->fetch_array()) {
                                $usuarioenvia = $row['usuarioenvia'];
                                $usuariorecibe = $row['usuariorecibe'];
                                $mensaje = $row['mensaje'];
                                $hora = $row['fecha_envio'];
                                ?>
                                <div class="mensaje">
                                    <p class="usuarioenvio"><?php echo $usuarioenvia ?></p>
                                    <p class="mensaje-p"><?php echo $mensaje ?></p>
                                    <p class="hora"><?php echo $hora ?></p>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </aside>

                <aside class="mensajes-recibidos">
                    <h3>Mensajes Enviados</h3>
                    <div class="recibidos-mensajes">
                        <?php
                        $sql2 = "SELECT * FROM mensajes WHERE usuarioenvia = '$usuario'";
                        $resultado2 = mysqli_query($conectio, $sql2);
                        if ($resultado2) {
                            while ($row = $resultado2->fetch_array()) {
                                $usuarioenvia = $row['usuarioenvia'];
                                $usuariorecibe = $row['usuariorecibe'];
                                $mensaje = $row['mensaje'];
                                $hora = $row['fecha_envio'];
                                ?>
                                <div class="mensaje">
                                    <p class="usuarioenvio"><?php echo $usuariorecibe ?></p>
                                    <p class="mensaje-p"><?php echo $mensaje ?></p>
                                    <p class="hora"><?php echo $hora ?></p>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </aside>
            </article>
        <?php } ?>
    </main>
</body>
</html>