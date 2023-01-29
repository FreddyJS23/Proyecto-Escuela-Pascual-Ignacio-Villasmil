<?php session_start();
$ci_estu=$_GET['id'];
if (isset($_SESSION['usuario'])) {  ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Certificado de promoción</title>
    </head>

    <body>

        <?php

        include("../cuerpo/header.html")

        ?>

        <form action="../registros/registro_usuario.php" method="post" id="formulario">

            <div class="container contenedor_usuario">
                <div class="titulo_formulario">
                    <p>Certificado de promoción</p>
                </div>
                <div class="campos_usuarios">

                  
                   
                <div class="container_campos">
                            <label class="label_select" for="grado">Grado en el que curso</label>
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
                            <label class="label_select" for="literal">Nota que obtuvo</label>
                            <select class="select" name="literal" id="literal" auto>

                                <option value="0">Seleccione una nota</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                               
                            </select>
                        </div>

                   

                        <div class="contenedor_boton">

                            <input class="boton" type="submit" value="Generar certificado de promocion">
                        </div>

                    </div>






                </div>

            </div>

            <input type="hidden" id="formulario_certificadoPromocion">
            <input type="hidden" name="ci_estu" value="<?= $ci_estu ?>">
        </form>
       
        
        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>