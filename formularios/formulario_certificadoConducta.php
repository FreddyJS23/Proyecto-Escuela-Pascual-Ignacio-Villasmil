<?php session_start();
$ci_estu=$_GET['id'];
if (isset($_SESSION['usuario'])) {  ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Certificado de conducta</title>
    </head>

    <body>

        <?php

        include("../cuerpo/header.html")

        ?>

        <form action="../registros/registro_usuario.php" method="post" id="formulario">

            <div class="container contenedor_usuario">
                <div class="titulo_formulario">
                    <p>Certificado de conducta</p>
                </div>
                <div class="campos_usuarios">

                  
                   
           

                        <div class="container_campos">
                            <label class="label_select" for="conducta">Conducta</label>
                            <select class="select" name="conducta" id="conducta" auto>

                                <option value="0">Seleccione una opcion</option>
                                <option value="1">Bueno, digno de su nivel de aprendisaje</option>
                                <option value="2">opcion 2</option>
                                <option value="3">opcion 3</option>
                                <option value="4">opcion 4</option>
                                <option value="5">opcion 5</option>
                                <option value="6">opcion 6</option>
                            </select>
                        </div>
              

                   

                        <div class="contenedor_boton">

                            <input class="boton" type="submit" value="Generar certificado de conducta">
                        </div>

                    </div>






                </div>

            </div>

            <input type="hidden" id="formulario_certificadoConducta">
            <input type="hidden" name="ci_estu" value="<?= $ci_estu ?>">
        </form>
       
        
        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>