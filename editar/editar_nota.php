<?php
include("../db.php");




if (isset($_SESSION['usuario']) && $_SESSION['id_periodo'] != 'todos') {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Vaciar notas</title>
    </head>

    <body>
        <!-- herader -->
        <?php include("../cuerpo/header.html") ?>


        <!-- titulo -->
        <p class="titulo_tabla">Vaciar notas</p>

        <!-- contenedor de la tabla -->
        <div class="nota"></div>




        <!-- scripst -->
        <?php include("../cuerpo/script.html") ?>

    </body>

    </html>
<?php } else {

    header("location:../index.html");
} ?>