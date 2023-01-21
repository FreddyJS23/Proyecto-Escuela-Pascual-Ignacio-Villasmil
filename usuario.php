<?php



include("db.php");
$consultar_estu="SELECT ci_estu FROM estudiante";
$ejecutar_estu=mysqli_query($conexion,$consultar_estu);

$total_estu=mysqli_num_rows($ejecutar_estu);


$consultar_profe="SELECT  ci_profe FROM profesor";
$ejecutar_profe=mysqli_query($conexion,$consultar_profe);

$total_profe=mysqli_num_rows($ejecutar_profe);


if(isset($_SESSION['usuario'])){  
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontawesome-free-6.1.1-web/css/all.css" >

    <title>Bienvenido</title>
</head>

<body>

<header>



<nav class="nav">
    <p class="titulo_principal"><?=$_SESSION['usuario'];    $_SESSION['periodo'] ?></p>

    <ul class="menu">


        <li class="pestaña"><i class="fa-solid fa-user"></i>Estudiantes



            <ul class="submenu1">
               
                <li class="nav_li"> <a class="opcion" href="formularios/formulario_inscripcion.php">Inscribir</a></li>
                <li class="nav_li"><a class="opcion" href="formularios/formulario_regular.php">Inscripcion regular </a></li>
                <li class="nav_li"><a class="opcion" href="consultas/consultar_estu.php">Consultar </a></li>
                <?php if($_SESSION['id_periodo']!='todos') {?> <li class="nav_li"> <a class="opcion" href="editar/editar_seccion.php">Asignar secciones</a> </li> <?php } ?>
              
               
            </ul>
        </li>


        <li class="pestaña"><i class="fa-solid fa-person-chalkboard"></i>Profesores

            <ul class="submenu2">
              
                <li class="nav_li"><a class="opcion" href="consultas/consultar_profe.php">Consultar</a> </li>
                <li class="nav_li"> <a class="opcion" href="consultas/consulta_asignacion.php">Ver asignaciones </a> </li>

            </ul>

        </li>

        <li class="pestaña_logo">

            <div class="contenedor_logo">

                 <img src="css//imagenes/logo.png" width="55px" alt="Logo">
            </div>
        </li>




        <li class="pestaña"><i class="fa-solid fa-calendar-days"></i>Periodos

            <ul class="submenu3">
                
                <!-- <?php if($_SESSION['id_periodo']!='todos') {?> <li class="nav_li"> <a class="opcion" href="consultas/consultar_principio_periodo.php">Principios del periodo</a> </li><?php }?> -->
                <?php if($_SESSION['id_periodo']!='todos') {?> <li class="nav_li"> <a class="opcion" href="editar/editar_nota.php">Vaciar notas</a> </li> <?php }?>
                <li class="nav_li"> <a class="opcion" href="consultas/consultar_final_periodo.php">Finales del periodo</a> </li>
            
            </ul>
        
        </li>


        <li class="pestaña"><i class="fa-solid fa-users"></i>Usuario

            <ul class="submenu4">
                
                <li class="nav_li"><a class="opcion" href="formularios/formulario_editar_usuario.php?id=<?php echo $_SESSION['usuario'] ?>">Editar usuario </a></li>

            </ul>

        </li>

        <li class="pestaña">
                        <a href="consultas/consultar_estu_reporte.php"><i class="fa-solid fa-file-export"></i>Constancias</a>
                    </li>
        <li class="pestaña" for="cerrar"><a href="cerrar sesion.php"><i class="fa-solid fa-door-open"></i> Cerrar sesión</a></li>
    </ul>
</nav>
</header>

<div class="contenedor_estadisticas1">
<p>Total de estudiantes inscritos actualmente:</p>

<div class=contenedor_numero>
    <div class=numero><?php echo $total_estu ?></div>
</div>
</div>

<div class="contenedor_estadisticas2">
<p>Total de profesores inscritos actualmente:</p>

<div class="contenedor_numero">
    <div class=numero><?php echo $total_profe  ?></div>
</div>
</div>



</body>

</html>




<?php }else{

header("location:index.html");
} ?>
