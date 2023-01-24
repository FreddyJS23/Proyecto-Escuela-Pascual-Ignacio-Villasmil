<?php session_start();
if (isset($_SESSION['usuario'])) {  ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <?php include("../cuerpo/head.html"); ?>


        <title>Inscrpcion regular</title>
    </head>

    <body>

        <?php

        include("../cuerpo/header.html") ?>


        <form action="../registros/registro_inscripcion_regular.php" method="post" id="formulario">
            <fieldset class="fieldset" <?php if ($_SESSION['id_periodo'] == 'todos') { ?>disabled <?php  }   ?>>
                
            <div class="contenedor_regular">

                    <div class="campos_regular">
                        <div class="titulo_formulario">
                            <p><i class="fa-solid fa-children"></i>Inscripcion regular</p>
                        </div>


                        <div class="container_campos">
                            <input class="input" type="text" name="ci_repre" id="ci_repre" placeholder=" " autocomplete="off" value="<?php if ($_GET) echo $_GET['id'] ?>" required maxlength="8">
                            <label class="label" id="label_ci_repre" for="ci_repre">Cedula representante</label>


                        </div>

                        <div class="container_campos">
                            <select name="" class="select_ci regular" id="select_ci">
                                <option value="ci_estu">E</option>
                                <option value="ci">V</option>
                            </select>

                            <input class="input" type="text" name="ci_estu" id="ci_estu" placeholder=" " autocomplete="off" required maxlength="14">
                            <label class="label" id="label_ci_estu" for="ci_estu">Cedula estudiante </label>
                        </div>


                        <div class="container_campos">
                            <label class="label_select" for="grado">Grado en que el que se inscribira</label>
                            <select class="select" name="grado" id="grado" auto>

                                <option value="0">Seleccione un grado</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                                <option value="4">4°</option>
                                <option value="5">5°</option>
                                <option value="6">6°</option>
                            </select>
                        </div>



                      

                        <div class="container_campos">
                            <input class="input" type="text" value="<?php echo $_SESSION['periodo'] ?>" disabled>
                            <label class="label" id="label_periodo" for="periodo">Periodo en el que se va a inscrbir</label>


                        </div>

                        <div class="contenedor_boton">
                            <input class="boton" type="submit" value="Inscribir estudiante">
                        </div>
                    </div>







                </div>



                <input type="hidden" id="inscripcionRegular">
            </fieldset>
        </form>




        <?php include("../cuerpo/script.html") ?>

    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>