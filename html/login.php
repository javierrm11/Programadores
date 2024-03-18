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
<header>
        <div class="header">
            <div class="titulos">
            <div class="titulo-ab">
                    <a href="../index.php" class="headera">Desarrolladores</a>
                    <a href="../index.php" class="headera2">.NET</a>
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