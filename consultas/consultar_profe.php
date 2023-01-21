<?php
include("../db.php");


if (isset($_SESSION['usuario'])) {

    $cargo = $_SESSION['cargo'];
?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>

        <script>
            let cargo = "<?= $cargo ?>"
        </script>
        <title>Datos de los profesores</title>
    </head>

    <body>
        <!-- header -->
        <?php include("../cuerpo/header.html") ?>




        <!-- titulo -->
        <p class="titulo_tabla">Datos personales de los profesores</p>



        <!-- contenedor de la tabla -->
        <div class="profesor"></div>

        <!-- scripst -->
        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>