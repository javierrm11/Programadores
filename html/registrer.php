<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <script src="../js/mostrar.js"></script>
    <link rel="stylesheet" href="../css/registrer.css"/>
    <script src="../js/registrer.js"></script>
    <link rel="stylesheet" href="../php/usuarios.php">
</head>
<body>
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
        <form id="formulario" method="post" action="../php/usuarios.php" enctype="multipart/form-data" novalidate>
            <h2>Registrate</h2>
            <a href="./login.php" class="volver">Iniciar Sesión</a>
            <div class="formulario">
                <div class="form-div">
                    <h3>Nombre de Usuario</h3>
                    <input type="text" class="forminput" name="usuario" id="usuario">
                    <p></p>
                </div>
                <div class="form-div">
                    <h3>Correo Electrónico</h3>
                    <input type="email" class="forminput" placeholder="Email:" name="correo" id="correo">
                    <p></p>
                </div>
                <div class="form-div">
                    <h3>Profesión</h3>
                    <div class="profesiones">
                        <input type="radio" id="Cliente" name="profesion" value="Cliente" onchange="cliente()" id="profesion">
                        <h5 class="label">Cliente</h5>
                    </div>
                    <div class="profesiones">
                        <input type="radio" id="html" name="profesion" value="Desarrollador" onchange="desarrollador()" id="profesion">
                        <h5 class="label">Desarrollador</h5>
                    </div>
                    <p></p>
                </div>
                <div class="div-mas" id="div-mas">
                    <div class="div-masinfo">
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
                    </div>
                </div>
                <div class="div-mas2" id="div-mas2">
                    <div class="form-div">
                        <h3>Especialización</h3>
                        <div class="trabajo">
                            <input type="radio" name="trabajo" value="DesarrolladorWeb">
                            <h5 class="label">Desarrollador Web</h5>
                        </div>
                        <div class="trabajo">
                            <input type="radio" name="trabajo" value="DesarrolladorMultiplataforma">
                            <h5 class="label">Desarrollador Multiplataforma</h5>
                        </div>
                        <div class="trabajo">
                            <input type="radio" name="trabajo" value="DesarrolladorApliacionesMoviles">
                            <h5 class="label">Desarrollador Aplicaciones Móviles</h5>
                        </div>
                        <p></p>
                    </div>
                    <div class="form-div">
                        <h3>Teléfono</h3>
                        <input type="tel" class="forminput2" name="tlf" id="tlf">
                    </div>
                    <div class="form-div">
                        <h3>País</h3>
                        <input type="text" class="forminput2" name="pais" id="pais">
                    </div>
                    <div class="form-divfoto">
                        <h3>Foto de perfil</h3>
                        <input type="file" class="formfoto" name="archivo" id="arhivo" accept="image/*">
                    </div>
                    <div class="form-div">
                        <h3>Descripción</h3>
                        <input type="text" class="forminput2" name="Descripcion" id="descripcion">
                    </div>
                </div>
                <div class="form-div">
                    <h3>Contraseña Nueva</h3>
                    <input type="password" class="forminput2" placeholder="Password" name="contraseña" id="contraseña">
                    <p></p>
                </div>
                <div class="form-div">
                    <input type="submit" value="Listo" class="formcta" name="enviar">
                    <p class="warning" id="warning"></p>
                </div>
            </div>
            <script src="../js/validacionregistrer.js"></script>
        </form>
    </main>
</body>
</html>