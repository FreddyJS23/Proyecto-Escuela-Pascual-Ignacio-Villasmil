<?php
include("../db.php");
$id_periodo=$_SESSION['id_periodo'];

//solicitas cantidad de secciones activas por grado para filtrar los botones
//se usa orde by asc para ordenar los grados de forma ascendete para evitar errores al leer mal los datos
$SolicitarSecciones="SELECT `secciones_activas`,grado FROM `secciones_activas`
    INNER JOIN grado ON secciones_activas.id_grado=grado.id_grado WHERE id_periodo=$id_periodo ORDER BY `secciones_activas`.`id_grado` ASC";
$sqlSeccionesActivas=mysqli_query($conexion,$SolicitarSecciones);
//se usa un bucle para leer la data de la bd para crear una variable con las secciones activas que tiene cada grado
while ($seccionesActivas = mysqli_fetch_array($sqlSeccionesActivas)) {
  
   //identificar grados
   if($seccionesActivas['grado']=="1°"){
    $primerGrado=$seccionesActivas['secciones_activas'];

   };
    if($seccionesActivas['grado']=="2°"){
    $segundoGrado=$seccionesActivas['secciones_activas'];

   }
   if($seccionesActivas['grado']=="3°"){
    $tercerGrado=$seccionesActivas['secciones_activas'];

   }
   if($seccionesActivas['grado']=="4°"){
    $cuartoGrado=$seccionesActivas['secciones_activas'];

   }
   if($seccionesActivas['grado']=="5°"){
    $quintoGrado=$seccionesActivas['secciones_activas'];

   }
   if($seccionesActivas['grado']=="6°"){
    $sextoGrado=$seccionesActivas['secciones_activas'];

   } 
   
};

 
if(isset($_SESSION['usuario']) && $_SESSION['id_periodo']!='todos' && $_SESSION['cargo']==1){  
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../cuerpo/head.html") ?>
    <title>Asginar secciones</title>

    <!-- pasar las variables de php a js a modo de objeto -->
    <script>
       let grados={
           primero:{grado:"1°",seccionActivas:<?= $primerGrado ?>},
           segundo:{grado:"2°",seccionActivas:<?= $segundoGrado ?>},
           tercero:{grado:"3°",seccionActivas:<?= $tercerGrado ?>},
           cuarto:{grado:"4°",seccionActivas:<?= $cuartoGrado ?>},
           quinto:{grado:"5°",seccionActivas:<?= $quintoGrado ?>},
           sexto:{grado:"6°",seccionActivas:<?= $sextoGrado ?>}
        }
    
    </script>
</head>

<body>

<!-- header -->
    <?php include("../cuerpo/header.html") ?>


<!-- titulo -->

    <p class="titulo_tabla">Asignar secciones a los estudiantes</p>

 


<!-- contenedor de la tabla -->
   <div   class="seccion"></div>
   
  



<?php include("../cuerpo/script.html") ?>

</body>

</html>
<?php }else{

header("location:../index.html");
} ?>