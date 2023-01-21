<?php
include("../db.php");



if (isset($_SESSION['usuario'])) {

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>

        <title>Datos de periodos</title>
    </head>

    <body>
        <!-- header -->
        <?php include("../cuerpo/header.html") ?>


        <!-- titulo -->
        <p class="titulo_tabla">Final de periodo</p>
        
        <!-- contenedor de la tabla -->
        <div class="final_periodo"></div>






        <!-- scripts -->
        <?php include("../cuerpo/script.html") ?>

    </body>

    </html>
<?php } else {

    header("location:../index.html");
} ?>