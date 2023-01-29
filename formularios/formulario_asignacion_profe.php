<?php
include("../db.php");



if (isset($_SESSION['usuario']) && $_SESSION['cargo'] == 1) {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <?php include("../cuerpo/head.html") ?>
        <title>Asignacion de profesor</title>
    </head>

    <body>


        <?php include("../cuerpo/header.html") ?>

        <form action="../registros/registro_asignacion.php" method="post" id="formulario">
            <!-- control de vista de periodo -->
            <fieldset class="fieldset" <?php if ($_SESSION['id_periodo'] == 'todos') { ?>disabled <?php  }   ?>>
                <div class=" contenedor_asignacion">

                    <div class="campos_asignacion">

                        <div class="titulo_formulario">
                            <p>Asignacion de profesor</p>
                        </div>

                        <div class="container_campos">
                            <input class="input" type="text" name="ci_profe" id="ci_profe" placeholder=" " autocomplete="off" maxlength="8" required>
                            <label class="label" id="label_ci_profe" for="ci_profe">Cedula </label>
                        </div>

                        <div class="container_campos">
                            <label class="label_select" for="grado">Grado </label>
                            <select class="select" name="grado" id="grado">

                                <option value="">Seleccione un grado</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                                <option value="4">4°</option>
                                <option value="5">5°</option>
                                <option value="6">6°</option>
                            </select>
                        </div>



                        <div class="container_campos">
                            <label class="label_select" for="seccion">Seccion</label>
                            <select class="select" name="seccion" id="seccionDisponible" disabled>

                                <option value="">Seleccione una seccion</option>
                           

                            </select>
                        </div>


                        <div class="container_campos">
                            <input class="input" type="text" value="<?php echo $_SESSION['periodo'] ?>" disabled>
                            <label class="label" id="label_periodo" for="periodo">Periodo actual</label>


                        </div>




                    </div>


                    <div class="contenedor_boton">

                        <input type="submit" value="Asignar" class="boton">
                    </div>

                </div>
                <input type="hidden" id="asignar_profe">
            </fieldset>
        </form>

        <div class="ayuda_profe ">

            <div class="container_ayuda_selector">

                <div class="titulo_formulario">
                    <p>Profesores no asignados</p>
                </div>

                <select name="" id="no-asignados" autofocus>
                    <option value="">Lista de profesores</option>
                </select>

            </div>


            <div class="container_asignados">

                <div class="titulo_formulario">
                    <p>Profesores asignados</p>
                </div>

                <select name="" id="asignados" autofocus>
                    <option value="">Lista de profesores</option>

                    <option value=""></option>
                </select>

            </div>



        </div>
        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>