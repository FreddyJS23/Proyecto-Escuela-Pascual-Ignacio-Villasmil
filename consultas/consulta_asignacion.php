<?php

include("../db.php");



if (isset($_SESSION['usuario'])) {
?>





    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Asignaciones</title>
    </head>

    <body>
        <!-- header -->
        <?php include("../cuerpo/header.html") ?>



        <!--  titulo -->
        <p class="titulo_tabla">Asignaciones de los profesores</p>


        <!--  contenedor de la tabala -->
        <div class="asignaciones"></div>



        <!--  scripts -->
        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>
<?php } else {

    header("location:../index.html");
} ?>