<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="./js/mostrar.js"></script>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <header>
        <div class="header">
            <a href="../index.php" class="headera">Desarrolladores</a><a href="../index.php" class="headera2">.NET</a>
            <nav class="nav">
                <div class="subnav">
                    <button class="subnavbtn">Inicio <i class="fa fa-caret-down"></i></button>
                    <div class="subnav-content">
                        <a href="../index.php">Dashboard</a>
                        <a href="./perfil.php">Perfil</a>
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
                        <a id="usuarios"><?php echo $_SESSION['usuario'];?></a>
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
    </header>

    <main>
        <form name="form" method="post" action="../php/login.php" novalidate>
            <h2>Iniciar Sesión</h2>
            <a href="./registrer.php" class="volver">Registrate</a>
            <section class="formulario">
                <article class="form-div">
                    <h3>Nombre de Usuario</h3>
                    <input type="text" class="forminput" placeholder="Usuario:" name="usuario" id="usuario" required>
                </article>
                <article class="form-div">
                    <h3>Contraseña</h3>
                    <input type="password" class="forminput2" placeholder="Password" name="contraseña" id="password" required>
                </article>
                <article class="form-div">
                    <input type="submit" value="Listo" class="formcta" name="enviar" >
                </article>
                <p></p>
            </section>
            <script src="../js/validacionlogin.js"></script>
        </form>
    </main>
</body>
</html>