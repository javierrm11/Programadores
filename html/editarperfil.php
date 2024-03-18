<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editarperfil</title>
    <link rel="stylesheet" href="../css/editarperfil.css">
    <script src="https://kit.fontawesome.com/5952267027.js" crossorigin="anonymous"></script>
    <script src="../js/editar.js"></script>
    <link rel="stylesheet" href="../php/editar.php">
</head>
<body>
<?php  
    $conectio = mysqli_connect('172.17.0.2', 'root', 'Jrr#108vivi', 'docker');
    
    $usuario = $_SESSION['usuario'];
    $consulta = mysqli_query($conectio, "SELECT * FROM usuarios where usuario = '$usuario'");
    $consulta2 = mysqli_query($conectio, "SELECT * FROM desarrolladores where usuario = '$usuario'");

    // Verificar las credenciales en ambas tablas
    if ($consulta->num_rows > 0) {
        $displayDivMas = 'block';
    } elseif ($consulta2->num_rows > 0) {
        $displayDivMas2 = 'block';
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
                        <a href="./perfil.php" id="usuarios"><?php echo $_SESSION['usuario'];?></a>
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
                            <a href="index.php">Dashboard</a>
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

<div class="container">
    <main>
        <h2 class="titulo-h2">Editar Perfil</h2>
        <div class="perfil-grup">
            <form id="formulario" name="form" method="post" action="../php/editar.php" enctype="multipart/form-data" novalidate>
                <article class="formulario">
                    <section class="form-div">
                        <h3>Nombre de Usuario</h3>
                        <input type="text" class="forminput" placeholder="Usuario:" name="usuario" id="usuario">
                        <p></p>
                    </section>
                    <section class="form-div">
                        <h3>Correo Electrónico</h3>
                        <input type="email" class="forminput" placeholder="Email:" name="correopost" id="correo">
                        <p></p>
                    </section>
                    <section class="form-div">
                        <h3>Profesión</h3>
                        <div class="profesiones">
                            <input type="radio" id="Cliente" name="profesion" value="Cliente" onchange="cliente2()" id="profesion">
                            <h5 class="label">Cliente</h5>
                        </div>
                        <div class="profesiones">
                            <input type="radio" id="html" name="profesion" value="Desarrollador" onchange="desarrollador2()" id="profesion">
                            <h5 class="label">Desarrollador</h5>
                        </div>
                        <p></p>
                    </section>
                    
                    <section class="div-mas" id="div-mas" style="display: <?php echo $displayDivMas;?>">
                        <section class="div-masinfo">
                            <h3>¿Qué te interesa?</h3>
                            <div class="desarrollodiv">
                                <input type="checkbox" name="desarrolloweb" value="si">
                                <h5 class="label">Desarrollo Web</h5>
                            </div>
                            <div class="desarrollodiv">
                                <input type="checkbox" name="desarrollomulti" value="si">
                                <h5 class="label">Desarrollo Multiplataforma</h5>
                            </div>
                            <div class="desarrollodiv">
                                <input type="checkbox" name="desarrollomovil" value="si">
                                <h5 class="label">Desarrollo Móvil</h5>
                            </div>
                            <p></p>
                        </section>
                    </section>
                    
                    <section class="div-mas2" id="div-mas2" style="display: <?php echo $displayDivMas2;?>">
                        <section class="form-div">
                            <h3>Especialización</h3>
                            <div class="trabajo">
                                <input type="radio"  name="trabajo" value="DesarrolladorWeb">
                                <h5 class="label">Desarrollador Web</h5>
                            </div>
                            <div class="trabajo">
                                <input type="radio"  name="trabajo" value="DesarrolladorMultiplataforma">
                                <h5 class="label">Desarrollador Multiplataforma</h5>
                            </div>
                            <div class="trabajo">
                                <input type="radio"  name="trabajo" value="DesarrolladorApliacionesMoviles">
                                <h5 class="label">Desarrollador Aplicaciones Móviles</h5>
                            </div>
                            <p></p>
                        </section>
                        <section class="form-div">
                            <h3>Teléfono</h3>
                            <input type="tel" class="forminput2"  name="tlf" id="tlf">
                        </section>
                        <section class="form-div">
                            <h3>País</h3>
                            <input type="text" class="forminput2"  name="pais" id="pais">
                        </section>
                        <section class="form-divfoto">
                            <h3>Foto de Perfil</h3>
                            <input type="file" class="formfoto"  name="archivo" id="arhivo" accept="image/*">
                        </section>
                        <section class="form-div">
                            <h3>Descripción</h3>
                            <input type="text" class="forminput2"  name="Descripcion" id="descripcion">
                        </section>
                    </section>
                    
                    <section class="form-div">
                        <h3>Contraseña Nueva</h3>
                        <input type="password" class="forminput2" placeholder="Password" name="contraseña" id="contraseña">
                        <p></p>
                    </section>
                    
                    <section class="form-div">
                        <input type="submit" value="Listo" class="formcta" name="enviar" >
                        <a href="./perfil.php" class="volver">Volver</a>
                    </section>
                </article>
            </form>
        </div>
    </main>
</div>

</body>
</html>