<?php



include("db.php");
$consultar_estu = "SELECT ci_estu FROM estudiante";
$ejecutar_estu = mysqli_query($conexion, $consultar_estu);

$total_estu = mysqli_num_rows($ejecutar_estu);


$consultar_profe = "SELECT  ci_profe FROM profesor";
$ejecutar_profe = mysqli_query($conexion, $consultar_profe);

$total_profe = mysqli_num_rows($ejecutar_profe);


if (isset($_SESSION['usuario'])) {
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
               
          
                <p class="titulo_principal titulo-nav navbar-brand mt-0 mb-0 "> <img src="css/imagenes/logo.png" alt=""  class="logo-menu-tlf"> <?= $_SESSION['usuario'] ?> <?= $_SESSION['periodo'] ?></p>
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <i class="fa-solid fa-bars icono-navbar navbar-toggler"></i>
                    </a>
                    


                    <div class="collapse navbar-collapse justify-content-center div-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav nav-usuario">

                            <li class="nav-item dropdown  ">
                                <a class=" dropdown-toggle pestaña" id="toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa-solid fa-user"></i>Estudiantes</a>
                                <ul class="dropdown-menu menu-nav" aria-labelledby="toggle">
                                    <li class="nav_li"><a class="opcion" href="formularios/formulario_inscripcion.php">Inscribir</a></li>
                                    <li class="nav_li"><a class="opcion" href="formularios/formulario_regular.php">Inscripcion regular </a></li>
                                    <li class="nav_li"><a class="opcion" href="consultas/consultar_estu.php">Consultar </a></li>

                                </ul>
                            </li>

                            <li class="nav-item dropdown ">
                                <a class=" dropdown-toggle pestaña" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa-solid fa-person-chalkboard"></i>Profesores</a>
                                <ul class="dropdown-menu menu-nav">

                                    <li class="nav_li"><a class="opcion" href="consultas/consultar_profe.php">Consultar</a> </li>
                                    <li class="nav_li"> <a class="opcion" href="consultas/consulta_asignacion.php">Ver asignaciones </a> </li>

                                </ul>
                            </li>


                            <li class="nav-item dropdown">
                                <a class=" dropdown-toggle pestaña" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa-solid fa-calendar-days"></i>Periodos</a>
                                <ul class="dropdown-menu menu-nav">

                                    <?php if ($_SESSION['id_periodo'] != 'todos') { ?> <li class="nav_li"> <a class="opcion" href="editar/editar_nota.php">Vaciar notas</a> </li> <?php } ?>
                                    <li class="nav_li"> <a class="opcion" href="consultas/consultar_final_periodo.php">Finales del periodo</a> </li>

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
                                    <li class="nav_li"><a class="opcion" href="formularios/formulario_editar_usuario.php?id=<?php echo $_SESSION['usuario'] ?>">Editar usuario </a></li>

                                </ul>
                            </li>


                            <li class="nav-item ">
                                <a class=" pestaña" href="consultas/consultar_estu_reporte.php"><i class="fa-solid fa-file-export"></i>Reportes</a>
                            </li>



                            <li class="nav-item">
                                <a class=" pestaña" href="cerrar sesion.php"><i class="fa-solid fa-door-open "></i> Cerrar sesión</a>
                            </li>



                        </ul>

                    </div>
                </div>
            </nav>



        </header>

        <div class="container-estadistica">
            
            <div class="contenedor_estadistica1">
                <canvas id="graficoProfesor"></canvas>
            </div>


            <div class="contenedor_estadistica2">
                <canvas id="graficoEstudiante"></canvas>
            </div>
            

        
       
                <div class="contenedor_estadistica3">
                    <canvas id="graficoGrado"></canvas>
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