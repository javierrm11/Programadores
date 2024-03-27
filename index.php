<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red Social</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/5952267027.js" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</head>
<body onload="cargarSeleccion()">

    <?php
    $usuario = $_SESSION['usuario'] ?? "";
    $conexion = mysqli_connect('sql113.infinityfree.com', 'if0_36209740', 'Jrr108vivi', 'if0_36209740_programadores');

    if ($conexion) {
        $sql = "SELECT usuario FROM desarrolladores";
        $result = $conexion->query($sql);

            $sql_update = "
            UPDATE desarrolladores
            SET mediavota = (
            SELECT IFNULL(AVG(votacion), 0) AS media
            FROM votaciones
            WHERE votaciones.desarrollador = desarrolladores.usuario
            )
        ";
        $conexion->query($sql_update);

        $sql_update2 = "
            UPDATE desarrolladores d
            SET d.num_feedback = (
                SELECT COUNT(*) 
                FROM feedback_table f
                WHERE f.desarrollador = d.usuario
            );
        ";
        $conexion->query($sql_update2);

        $consulta = "SELECT * FROM desarrolladores";
        $resultado = mysqli_query($conexion, $consulta);

        if ($consulta) {
            while ($row = $resultado->fetch_array()) {
                $usuario = $row['usuario'];
                $correo = $row['correo'];
                $tlf = $row['tlf'];
                $especialidad = $row['especialidad'];
                $pais = $row['pais'];
                $imagen = $row['imagen'];
            }
        }
    }
    ?>

<header>
        <div class="header">
            <div class="titulos">
                <div class="titulo-ab">
                    <a href="index.php" class="headera">Desarrolladores</a>
                    <a href="index.php" class="headera2">.NET</a>
                </div>
                <div class="usuario" id="usuario">
                    <?php
                    if (isset($_SESSION['usuario'])) {
                    ?>
                    <div class="usuariom">
                        <a href="./html/perfil.php"id="usuarios"><?php echo $_SESSION['usuario'];?></a>
                        <a href="./php/cerrar.php" >Cerrar sesión</a>
                    </div> 
                    <?php
                } else {
                    ?>
                    <a id="sesion" href="./html/login.php">Inicia Sesión</a>
                    <a id="sesion" href="./html/registrer.php">Registrate</a>
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
                            <a href="./html/perfil.php">Perfil</a>
                            <a href="./html/mensajes.php">Mensajes</a>
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
        <div class="inicio">
            <div class="texto">
                <p>Te ofrecemos...</p>
                <h2>LOS MEJORES PROGRAMADORES EN</h2>
                <div class="titulo">
                    <h1 class="h1-1">DESARROLLADORES</h1><h1 class="h1-2">.NET</h1>
                </div>
                <button>Leer Más</button>
            </div>
            <img src="./imagenes/desarrollador.png" alt="">
        </div>

        <section class="desarrolladores">
            <h3>Desarrolladores</h3>

            <div class="grupoform">
                <?php
                $consulta_desa = "SELECT * FROM desarrolladores WHERE usuario = '$usuario'";
                $resultado_desa = mysqli_query($conexion, $consulta_desa);
                if ($usuario == "") {
                } elseif(mysqli_num_rows($resultado_desa) > 0) {
                    ?>
                    <form action="./php/calificacion.php" method="post" class="form2">
                        <h4 for="estrellas">Hacer votación</h4>
                        <?php
                        $resultadoDesarrolladores = $conexion->query("SELECT usuario FROM desarrolladores");
                        $desarrolladores = $resultadoDesarrolladores->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <select id="desarrollador" name="desarrollador" required>
                            <?php foreach ($desarrolladores as $desarrollador) : ?>
                                <option value="<?php echo $desarrollador['usuario']; ?>"><?php echo $desarrollador['usuario']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select name="estrellas" id="estrellas" required>
                            <option value="1">Malo</option>
                            <option value="2">Regular</option>
                            <option value="3">Bueno</option>
                            <option value="4">Muy bueno</option>
                            <option value="5">Excelente</option>
                        </select>
                        <input type="submit" value="Votar">
                    </form>
                <?php
                }
                else {
                 }?>

                <form action="index.php" method="post" onchange="guardarSeleccion()" class="form3">
                    <h4>Filtros</h4>
                    <div class="form-group">
                        <label for="filtrarEspecialidad">Filtrar por Especialidad:</label>
                        <select id="filtrarEspecialidad" name="filtrarEspecialidad">
                            <option value="todos">Todos</option>
                            <option value="DesarrolladorWeb">Web</option>
                            <option value="DesarrolladorMultiplataforma">Multi</option>
                            <option value="DesarrolladorApliacionesMoviles">Móviles</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filtrarValoracion">Filtrar por Calificacion:</label>
                        <select id="filtrarValoracion" name="filtrarValoracion">
                            <option value="todos">Todos</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filtrarFeed">Filtrar por Nº Feedback:</label>
                        <select id="filtrarFeed" name="filtrarFeed">
                            <option value="todos">Todos</option>
                            <option value="1">>1</option>
                            <option value="5">>5</option>
                            <option value="10">>10</option>
                            <option value="15">>15</option>
                            <option value="20">>20</option>
                        </select>
                    </div>
                    <button type="submit" class="submit">Filtrar</button>
                </form>
            </div>

            <section class="profesionales">
                <?php
                

                if ($conexion) {
                    $especialidades_usuario = [];

                    $consulta_usuario = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
                    $resultado_usuario = mysqli_query($conexion, $consulta_usuario);

                    $especialidades_usuario = [];

                    while ($row = $resultado_usuario->fetch_array()) {
                        $desarrollo_web = $row['desarrolloweb'];
                        $desarrollo_multi = $row['desarrollomulti'];
                        $desarrollo_movil = $row['desarrollomovil'];

                        if (!empty($desarrollo_web)) {
                            $especialidades_usuario[] = $desarrollo_web;
                        }
                        if (!empty($desarrollo_multi)) {
                            $especialidades_usuario[] = $desarrollo_multi;
                        }
                        if (!empty($desarrollo_movil)) {
                            $especialidades_usuario[] = $desarrollo_movil;
                        }
                    }

                    $especialidad = $_POST['filtrarEspecialidad'] ?? 'todos';
                    $valoracion = isset($_POST['filtrarValoracion']) ? (int)$_POST['filtrarValoracion'] : 'todos';
                    $feedback = $_POST['filtrarFeed'] ?? 'todos';

                    $sql = "SELECT * FROM desarrolladores WHERE 1=1";

                    if ($especialidad != 'todos') {
                        if ($especialidad == 'todosintereses' && !empty($especialidades_usuario)) {
                            $especialidades_condition = implode("', '", $especialidades_usuario);
                            $sql .= " AND (especialidad IN ('$especialidades_condition'))";
                        } else {
                            $sql .= " AND especialidad = '$especialidad'";
                        }
                    }

                    if ($valoracion != 'todos') {
                        $sql .= " AND mediavota >= $valoracion";
                    }

                    if ($feedback != 'todos') {
                        $sql .= " AND num_feedback >= $feedback";
                    }

                    $sql .= " ORDER BY mediavota DESC";

                    $resultado = mysqli_query($conexion, $sql);

                    if ($resultado) {
                        while ($row = $resultado->fetch_array()) {
                            $usuario = $row['usuario'];
                            $correo = $row['correo'];
                            $tlf = $row['tlf'];
                            $especialidad = $row['especialidad'];
                            $pais = $row['pais'];
                            $media = $row['mediavota'];
                            ?>
                            <article class="profesional">
                                <img src="data:image/png;base64,<?php echo base64_encode($row['imagen'])?>" alt="">
                                <h4 class="profesional-titulo"><?php echo $usuario ?></h4>
                                <div class="pro-div">
                                    <i class="fa-solid fa-envelope fa-sm"></i>
                                    <h4 class="correo"><?php echo $correo ?></h4>
                                </div>
                                <div class="pro-div">
                                    <i class="fa-solid fa-phone fa-sm"></i>
                                    <h4 class="tlf"><?php echo $tlf ?></h4>
                                </div>
                                <div class="pro-div">
                                    <i class="fa-solid fa-globe fa-sm"></i>
                                    <h4 class="pais"><?php echo $pais ?></h4>
                                </div>
                                <div class="pro-div">
                                    <h4 class="espe-bt">#</h4>
                                    <h4 class="espe"><?php echo $especialidad ?></h4>
                                </div>

                                <div class="calificador">
                                    <div class="estrellas" id="estrellas">
                                        <?php
                                        for ($i = 1; $i <= $media; $i++) {
                                            echo '<span class="estrella">&#9733;</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <a href="./html/detalle_programador.php?usuario=<?php echo urlencode($usuario); ?>" class="mostrar-mas">Ver perfil</a>
                            </article>
                            <?php
                        }
                    } else {
                        echo "Error en la consulta: " . mysqli_error($conexion);
                    }
                }
                ?>
            </section>
        </section>
    </main>

</body>
</html>