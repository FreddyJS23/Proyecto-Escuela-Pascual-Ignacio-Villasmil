<?php

include("../db.php");

$ci_profe = $_GET['id'];

$consulta_profe = "SELECT `ci_profe`, `nombre_profe`, `apellido_profe`, `fn_profe`, `sx_profe`, `tlf_profe`,`correo_profe`,`grado_instruccion`,`condicion_laboral`,`status`, profesor.id_estado, profesor.id_municipio, profesor.id_parroquia,`estado`, `municipio`, `parroquia`, `sector` FROM `profesor` 
INNER JOIN estados
ON profesor.id_estado=estados.id_estado
INNER JOIN municipios
ON profesor.id_municipio=municipios.id_municipio
INNER JOIN parroquias
ON profesor.id_parroquia=parroquias.id_parroquia where ci_profe=$ci_profe";


$ejecutar_consulta_profe = mysqli_query($conexion, $consulta_profe);
$row = mysqli_fetch_array($ejecutar_consulta_profe);

if (isset($_SESSION['usuario']) && $_SESSION['cargo'] == 1) {

?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Formulario profesor</title>
    </head>

    <body>

        <?php include("../cuerpo/header.html") ?>






        <form action="../editar/editar_profe.php" method="post" id="formulario">
            <input type="hidden" name="referencia" value="<?php echo $ci_profe ?>">

            <div class="contenedor_profesor">

                <div class="titulo_formulario">
                    <p><i class="fa-solid fa-people-group"></i>Datos del profesor</p>
                </div>

                <div class="campos_profesor">

                    <div class="container_campos">
                        <input class="input" type="text" name="ci_profe" id="ci_profe" placeholder=" " autocomplete="off" maxlength="8" required value="<?php echo $row['ci_profe'] ?>">
                        <label class="label" id="label_ci_profe" for="ci_profe">Cedula </label>


                    </div>

                    <div class="container_campos">
                        <input class="input" type="text" name="nombre_profe" id="nombre_profe" maxlength="30" placeholder=" " autocomplete="off" required value="<?php echo $row['nombre_profe'] ?>">
                        <label class="label" id="label_nombre_profe" for="nombre_profe">Nombre completo </label>

                    </div>

                    <div class="container_campos">
                        <input class="input" type="text" name="apellido_profe" id="apellido_profe" maxlength="30" placeholder=" " autocomplete="off" required value="<?php echo $row['apellido_profe'] ?>">
                        <label class="label" id="label_apellido_profe" for="apellido_profe">Apellido completo </label>

                    </div>

                    <div class="container_campos">
                        <input class="input" type="date" name="fn_profe" id="fn_profe" value="<?php echo $row['fn_profe'] ?>">
                        <label class="label" for="fn_profe">Fecha_nacimiento </label>

                    </div>

                    <div class="container_campos">
                        <label class="label" for="sx_profe"></label>
                        <select class="select" name="sx_profe" id="sx_profe">

                            <?php if ($row['sx_profe'] == "M") { ?>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            <?php } ?>
                            
                            <?php if ($row['sx_profe'] == "F") {  ?>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            <?php  } ?>

                        </select>
                    </div>


                    <div class="container_campos">
                        <input class="input" type="tel" name="tlf_profe" id="tlf_profe" placeholder=" " autocomplete="off" maxlength="12" required value="<?php echo $row['tlf_profe'] ?>">
                        <label class="label" id="label_tlf_profe" for="tlf_profe" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Formato 0xxx-xxxxxxx">Telefono contacto</label>





                    </div>

                    <div class="container_campos">
                        <input class="input" type="email" name="correo_profe" id="correo_profe" placeholder=" " required value="<?php echo $row['correo_profe'] ?>">
                        <label class="label" id="label_correo_profe" for="correo_profe">Correo electronico</label>


                    </div>

                    <div class="container_campos">
                        <label class="label_select" for="grado_instruccion">Grado de instruccion</label>
                        <select class="select" name="grado_instruccion" id="grado_instruccion" value="<?php echo $row['grado_instruccion'] ?>">

                            <?php if ($row['grado_instruccion'] == "alto") { ?>
                                <option value="alto">Alto</option>
                                <option value="medio">Medio</option>
                                <option value="bajo">Bajo</option>
                            <?php } ?>

                            <?php if ($row['grado_instruccion'] == "medio") { ?>
                                <option value="medio">Medio</option>
                                <option value="alto">Alto</option>
                                <option value="bajo">Bajo</option>
                            <?php } ?>

                            <?php if ($row['grado_instruccion'] == "bajo") { ?>
                                <option value="bajo">Bajo</option>
                                <option value="alto">Alto</option>
                                <option value="medio">Medio</option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="container_campos">
                        <label class="label_select" for="condicion_laboral">Condicion laboral</label>

                        <select class="select" name="condicion_laboral" id="condicon_laboral" value="<?php echo $row['condicion_laboral'] ?>">

                            <?php if ($row['condicion_laboral'] == "fijo") { ?>
                                <option value="fijo">fijo</option>
                                <option value="no fijo">no fijo</option>
                            <?php } ?>

                            <?php if ($row['condicion_laboral'] == "nofijo") { ?>
                                <option value="nofijo">no fijo</option>
                                <option value="fijo">fijo</option>
                            <?php } ?>


                        </select>
                    </div>
                    <div class="container_campos">
                        <label class="label_select" for="status">Estado</label>

                        <select class="select" name="status" id="status" value="<?php echo $row['status'] ?>">

                            <?php if ($row['status'] == "ON") { ?>
                                <option value="ON">Activo</option>
                                <option value="OFF">Inactivo</option>
                            <?php } ?>
                            
                            <?php if ($row['status'] == "OFF") { ?>
                                <option value="OFF">Inactivo</option>
                                <option value="ON">Activo</option>
                            <?php } ?>

                            </select>
                    </div>

                    <div class="campos_ubicacion">
                        <div class="contenedor_ubicacion">

                            <p class="titulo_ubicacion">Donde reside actualemte</p>
                        </div>




                        <div class="container_campos">

                            <label class="label_select" for="estado">Estado</label>

                            <select class="select" name="estado" id="estado" >
                            <option value="<?php echo $row['id_estado'] ?>"><?php echo $row['estado'] ?></option>

                                <option value="1 ">Amazonas </option>
                                <option value="2 ">Anzoátegui </option>
                                <option value="3 ">Apure </option>
                                <option value="4 ">Aragua </option>
                                <option value="5 ">Barinas </option>
                                <option value="6 ">Bolívar </option>
                                <option value="7 ">Carabobo </option>
                                <option value="8 ">Cojedes </option>
                                <option value="9 ">Delta Amacuro </option>
                                <option value="10">Falcón </option>
                                <option value="11">Guárico </option>
                                <option value="12">Lara </option>
                                <option value="13">Mérida </option>
                                <option value="14">Miranda </option>
                                <option value="15">Monagas </option>
                                <option value="16">Nueva Esparta </option>
                                <option value="17">Portuguesa </option>
                                <option value="18">Sucre </option>
                                <option value="19">Táchira </option>
                                <option value="20">Trujillo </option>
                                <option value="21">La Guaira </option>
                                <option value="22">Yaracuy </option>
                                <option value="23">Zulia </option>
                                <option value="24">Distrito Capital </option>
                                <option value="25">Dependencias Federales</option>

                            </select>


                        </div>

                        <div class="container_campos">
                            <label class="label_select" for="estado">Municipio</label>
                            <select class="select" name="municipio" id="municipio" disabled>

                                <option value="<?php echo $row['id_municipio'] ?>"><?php echo $row['municipio'] ?></option>

                            </select>


                        </div>


                        <div class="container_campos">
                            <label class="label_select" for="parroquia">Parroquia</label>
                            <select class="select" name="parroquia" id="parroquia" disabled>
                            <option value="<?php echo $row['id_parroquia'] ?>"><?php echo $row['parroquia'] ?></option>

                            </select>


                        </div>


                        <div class="container_campos">
                            <input class="input" type="text" name="sector" placeholder=" " autocomplete="off" id="sector_profe" maxlength="15" required value="<?php echo $row['sector'] ?>">
                            <label class="label espacio_sector" id="sector_profe" for="sector">Sector</label>

                        </div>
                    </div>
                    <div class="contenedor_boton">
                        <input type="hidden" id="editar_profe">
                        <input class="boton" type="submit" value="Editar">
                    </div>
                </div>

            </div>






        </form>


        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>