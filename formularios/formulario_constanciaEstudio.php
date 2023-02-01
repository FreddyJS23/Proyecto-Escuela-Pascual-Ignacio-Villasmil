<?php 
include("../db.php");

$ci_estu=$_GET['id'];
$consultarPeriodos="SELECT  inscripcion.id_periodo ,periodo  FROM `inscripcion` INNER JOIN periodo on inscripcion.id_periodo=periodo.id_periodo
WHERE ci_estu_inscripcion=$ci_estu";
$consultaPeriodos=mysqli_query($conexion,$consultarPeriodos);

if (isset($_SESSION['usuario'])) {  ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Constancia de estudio</title>
    </head>

    <body>

        <?php

        include("../cuerpo/header.html")

        ?>

        <form action="../registros/registro_usuario.php" method="post" id="formulario">

            <div class="container contenedor_usuario">
                
            <div class="titulo_formulario">
                    <p>Constancia de estudio</p>
                </div>
                <div class="campos_usuarios">

                  
                   
                <div class="container_campos">
                            <label class="label_select" for="periodo">Periodo en el que curso</label>
                            <select class="select" name="periodo" id="periodo_reporte" auto>

                                <option value="0">Seleccione un periodo</option>
                                <?php while($periodos=mysqli_fetch_array($consultaPeriodos)){  ?>
                                <option value="<?=$periodos['id_periodo'] ?>"><?=$periodos['periodo']?></option>
                               <?php } ?>
                               
                            
                            </select>
                        </div>
                <div class="container_campos">
                            <label class="label_select" for="grado">Grado en el que curso</label>
                            <select class="select" name="grado" id="grado_reporte" disabled auto>

                                
                             
                            </select>
                        </div>


                <div class="container_campos">
                            <label class="label_select" for="literal">Nota que obtuvo</label>
                            <select class="select" name="literal" id="literal_reporte" disabled auto>

                               
                               
                               
                            </select>
                        </div>

                   

                        <div class="contenedor_boton">

                            <input class="boton" type="submit" value="Generar constancia de estudio">
                        </div>

                    </div>






                </div>

            </div>

            <input type="hidden" id="formulario_constanciaEstudio">
            <input type="hidden" id="ci_estu" name="ci_estu" value="<?= $ci_estu ?>">
        </form>
       
        
        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>