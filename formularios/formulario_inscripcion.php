<?php session_start();
if (isset($_SESSION['usuario'])) {  ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>

        <title>Inscripcion</title>
    </head>

    <body>

        <!-------------header o barra de navegacion-------------  -->
        <div>
            <?php include("../cuerpo/header.html") ?>
        </div>
        
        <form action="../registros/registro_inscripcion.php" method="post" id="formulario">

            <fieldset class="fieldset" <?php if ($_SESSION['id_periodo'] == 'todos') { ?>disabled <?php  }   ?>>
                <div class="contenedor_principal">


                    <!--------------    formulario  estudiante           --------- -->
                    <?php include("../cuerpo/form_estudiante.html") ?>



                    <!--------------    formulario  representante           --------- -->
                    <?php include("../cuerpo/form_representante.html") ?>



                    <!--------------    formulario    inscripcion         --------- -->
                    <?php include("../cuerpo/form_inscripcion.html") ?>
        

                    <input id="inscripcion" type="hidden">
                </div>
            </fieldset>

        </form>
        
        <?php include("../cuerpo/script.html") ?>





    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>