<?php

include("db.php");
$consultar_estu = "SELECT ci_estu FROM estudiante";
$ejecutar_estu = mysqli_query($conexion, $consultar_estu);

$total_estu = mysqli_num_rows($ejecutar_estu);


$consultar_profe = "SELECT  ci_profe FROM profesor";
$ejecutar_profe = mysqli_query($conexion, $consultar_profe);

$total_profe = mysqli_num_rows($ejecutar_profe);


if (!empty($_SESSION['usuario']) && $_SESSION['cargo'] == 1) {

?>




    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/bootstrap-5.1.3-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/fontawesome-free-6.1.1-web/css/all.css">
       



        <title>Bienvenido</title>
    </head>

    <body>


        <header>



            <nav class="navbar navbar-expand-lg  ">
                <div class="container-fluid">
                    <p class="titulo_principal titulo-nav navbar-brand mt-0 mb-0 ">Director <?= $_SESSION['periodo'] ?></p>
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <i class="fa-solid fa-bars icono-navbar navbar-toggler"></i>
                    </a>


                    <div class="collapse navbar-collapse justify-content-center div-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav">

                            <li class="nav-item dropdown  ">
                                <a class=" dropdown-toggle pestaña" id="toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa-solid fa-user"></i>Estudiantes</a>
                                <ul class="dropdown-menu menu-nav" aria-labelledby="toggle">
                                    <li class="nav_li"><a class="opcion" href="formularios/formulario_inscripcion.php">Inscribir</a></li>
                                    <li class="nav_li"><a class="opcion" href="formularios/formulario_regular.php">Inscripcion regular </a></li>
                                    <li class="nav_li"><a class="opcion" href="consultas/consultar_estu.php">Consultar </a></li>
                                    <?php if ($_SESSION['id_periodo'] != 'todos') { ?> <li class="nav_li"> <a class="opcion" href="editar/editar_seccion.php">Asignar secciones</a> </li> <?php } ?>
                                </ul>
                            </li>

                            <li class="nav-item dropdown ">
                                <a class=" dropdown-toggle pestaña" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa-solid fa-person-chalkboard"></i>Profesores</a>
                                <ul class="dropdown-menu menu-nav">
                                    <li class="nav_li"> <a class="opcion" href="formularios/formulario_profe.php">Inscribir</a></li>
                                    <li class="nav_li"><a class="opcion" href="consultas/consultar_profe.php">Consultar</a> </li>
                                    <li class="nav_li"> <a class="opcion" href="formularios/formulario_asignacion_profe.php">Asignar </a> </li>
                                    <li class="nav_li"> <a class="opcion" href="consultas/consulta_asignacion.php">Ver asignaciones </a> </li>
                                </ul>
                            </li>


                            <li class="nav-item dropdown">
                                <a class=" dropdown-toggle pestaña" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa-solid fa-calendar-days"></i>Periodos</a>
                                <ul class="dropdown-menu menu-nav">
                                    <!--  <?php if ($_SESSION['id_periodo'] != 'todos') { ?> <li class="nav_li"> <a class="opcion" href="consultas/consultar_principio_periodo.php">Principios del periodo</a> </li><?php } ?> -->
                                    <?php if ($_SESSION['id_periodo'] != "todos" && $_SESSION['cargo'] == 1) { ?> <li class="nav_li" id="activar_secciones"> <a class="opcion">Activar Secciones</a> </li> <?php } ?>
                                    <li class="nav_li"> <a class="opcion" href="consultas/consultar_final_periodo.php">Finales del periodo</a> </li>
                                    <?php if ($_SESSION['id_periodo'] != "todos") { ?> <li class="nav_li" id="cerrar-periodo"> <a class="opcion">Cerrar periodo</a> </li> <?php } ?>
                                </ul>
                            </li>


                            <li class="nav-item  ">
                                <div class="container-logo-nav ">

                                    <img class="logo-nav" src="css//imagenes/logo.png" alt="Logo">
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class=" dropdown-toggle pestaña" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa-solid fa-users"></i>Usuarios</a>
                                <ul class="dropdown-menu menu-nav">
                                    <li class="nav_li"><a class="opcion" href="consultas/consultar_usuario.php">Ver Usuarios </a></li>
                                    <li class="nav_li"><a class="opcion" href="formularios/formulario_usuario.php">Registrar</a></li>
                                </ul>
                            </li>


                            <li class="nav-item ">
                                <a class=" pestaña" href="consultas/consultar_estu_reporte.php"><i class="fa-solid fa-file-export"></i>Reportes</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class=" dropdown-toggle pestaña" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa-solid fa-database"></i>Base de datos</a>
                                <ul class="dropdown-menu menu-nav">
                                    <li class="nav_li"><a id="crearDb" class="opcion">Crear respaldo</a></li>
                                    <li class="nav_li"><a id="restaurarDb" class="opcion">Restaurar respaldo</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class=" pestaña" href="cerrar sesion.php"><i class="fa-solid fa-door-open "></i> Cerrar sesión</a>
                            </li>



                        </ul>

                    </div>
                </div>
            </nav>

        </header>



        <div class="container ">
            <div class="row ">
                <div class="col-6 contenedor_estadistica1">
                    <canvas id="graficoProfesor"></canvas>
                </div>


                <div class="col-6 contenedor_estadistica2">
                    <canvas id="graficoEstudiante"></canvas>
                </div>
                

            </div>
            <div class="row justify-content-center ">
                    <div class=" col-12 contenedor_estadistica3">
                        <canvas id="graficoGrado"></canvas>
                    </div>
                </div>
        </div>








        <script src="chartjs/chart.umd.js"></script>
        <script src="js/axios.js"></script>
        <script src="js/sweetalert2.all.min.js"></script>
        <script src="css/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/graficos.js"></script>


    </body>


    </html>

<?php } else {

    header("location:index.html");
} ?>