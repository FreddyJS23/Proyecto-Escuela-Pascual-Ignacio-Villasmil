<?php

include("../db.php");



if (isset($_SESSION['usuario'] )&& $_SESSION['cargo']==1) {


?>




    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Datos de los usuarios</title>

        <script>
            let ci_profe=<?= $_SESSION['ci_profe'] ?>
        </script>
    </head>

    <body>
        <!-- header -->
        <?php include("../cuerpo/header.html") ?>


        <!-- titulo -->
        <p class="titulo_tabla">Datos de los usuarios</p>

        <!-- contenedor de la tabla -->
        <div class="container_usuarios"></div>
       
        <!-- scripst -->
        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>