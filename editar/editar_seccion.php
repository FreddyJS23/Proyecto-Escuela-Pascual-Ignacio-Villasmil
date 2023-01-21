<?php
include("../db.php");

 
if(isset($_SESSION['usuario']) && $_SESSION['id_periodo']!='todos' && $_SESSION['cargo']==1){  
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../cuerpo/head.html") ?>
    <title>Asginar secciones</title>
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