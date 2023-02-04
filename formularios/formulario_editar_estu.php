<?php

include("../db.php");

$ci_estu = $_GET['id'];

$consulta = "SELECT ci_estu, `nombre_estu`, `apellido_estu`, `sx_estu`, `fn_estu`, `enfermedad`,`discapacidad`, `estado_econ`, `tlf_estu`, estudiante.id_estado, estudiante.id_municipio, estudiante.id_parroquia,`estado`, `municipio`, `parroquia`, `sector`, `pais`,estudiante.id_ciudad_nacimiento, `ciudad` FROM `estudiante` 
INNER JOIN salud
ON estudiante.id_salud=salud.id_salud
INNER JOIN economia
ON estudiante.id_economia=economia.id_economia
INNER JOIN estados
ON estudiante.id_estado=estados.id_estado
INNER JOIN municipios
ON estudiante.id_municipio=municipios.id_municipio
INNER JOIN parroquias
ON estudiante.id_parroquia=parroquias.id_parroquia
INNER JOIN pais
ON estudiante.id_pais_nacimiento=pais.id_pais
INNER JOIN ciudades
ON estudiante.id_ciudad_nacimiento=ciudades.id_ciudad WHERE ci_estu=$ci_estu";

$ejecutar = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_array($ejecutar);

$consultarEstadoNacimiento= "SELECT estudiante.id_estado_nacimiento, `estado` FROM `estudiante` INNER JOIN estados ON estudiante.id_estado_nacimiento=estados.id_estado WHERE ci_estu=$ci_estu";

$obtenerEstadoNacimiento= mysqli_query($conexion, $consultarEstadoNacimiento);
$estadoNacimiento = mysqli_fetch_array($obtenerEstadoNacimiento);


if (isset($_SESSION['usuario'])) {

    

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Editar datos de estudiante</title>
    </head>

    <body>

        <?php include("../cuerpo/head.html") ?>
        <!--Datos estudiantes-->
        <form action="../editar/editar_estu.php" method="post" id="formulario">

            <input type="hidden" value="<?php echo $ci_estu ?>" name="referencia">
            <div class="contenedor_estudiante contenedor_estudiante_grid">

                <div class="titulo_formulario titulo_formulario_grid">
                    <p><i class="fa-solid fa-children"></i>Datos del estudiante</p>
                </div>

                <div class="campos_estudiante campos_estudiante_grid" id="estudiante">


                    <div class="container_campos container_ci_estu">
                        <select name="" class="select_ci" id="select_ci">
                            <option value="ci_estu">E</option>
                            <option value="ci">V</option>
                        </select>

                        <input class="input" required type="text" name="ci_estu" id="ci_estu" placeholder=" " autocomplete="off" maxlength="14" autofocus autocomplete="off" value="<?php echo $row['ci_estu'] ?>">
                        <label class="label" id="label_ci_estu" for="ci_estu">Cedula estudiante </label>
                    </div>

                    <div class="container_campos">
                        <input class="input" required type="text" name="nombre_estu" id="nombre_estu" placeholder=" " autocomplete="off" maxlength="30" value="<?php echo $row['nombre_estu'] ?>">
                        <label class="label" id="label_nombre_estu" for="nombre_estu">Nombre completo </label>
                    </div>

                    <div class="container_campos">
                        <input class="input" required type="text" name="apellido_estu" id="apellido_estu" placeholder=" " autocomplete="off" maxlength="30" value="<?php echo $row['apellido_estu'] ?>">
                        <label class="label" id="label_apellido_estu" for="apellido_estu">Apellido completo </label>
                    </div>

                    <div class="container_campos">
                        <input class="input" required type="date" name="fn_estu" id="fn_estu" value="<?php echo $row['fn_estu'] ?>">
                        <label class="label" for="fn_estu">Fecha nacimiento</label>
                    </div>

                    <div class="container_campos genero" for="genero">
                        <label for="sx_estu" class="label_select" for="sx_estu">Genero</label>
                        <select class="select" name="sx_estu" id="sx_estu">
                            <?php if ($row['sx_estu'] == "M") { ?>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            <?php } ?>

                            <?php if ($row['sx_estu'] == "F") {  ?>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            <?php  } ?>

                        </select>
                    </div>

                    <div class="container_campos" for="economia">
                        <label for="economia" class="label_select">Estado economico</label>
                        <select class="select" name="economia" id="economia">

                            <?php if ($row['estado_econ'] == "alto") { ?>
                                <option value="1">Alto</option>
                                <option value="2">Bueno</option>
                                <option value="3">Intermedio</option>
                                <option value="4">Bajo</option>
                            <?php } ?>

                            <?php if ($row['estado_econ'] == "bueno") { ?>
                                <option value="2">Bueno</option>
                                <option value="3">Intermedio</option>
                                <option value="4">Bajo</option>
                                <option value="1">Alto</option>
                            <?php } ?>

                            <?php if ($row['estado_econ'] == "intermedio") { ?>
                                <option value="3">Intermedio</option>
                                <option value="4">Bajo</option>
                                <option value="1">Alto</option>
                                <option value="2">Bueno</option>
                            <?php } ?>
                            <?php if ($row['estado_econ'] == "bajo") { ?>
                                <option value="4">Bajo</option>
                                <option value="1">Alto</option>
                                <option value="2">Bueno</option>
                                <option value="3">Intermedio</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="container_campos" for="discapacidad">
                        <label for="discapacidad" class="label_select">Discapacidad</label>
                        <select class="select" name="discapacidad" id="select_discapacidad">

                            <?php if ($row['discapacidad'] == "si") {  ?>
                                 <option value="si">Si</option>
                                <option value="no">No</option>
                            <?php  } ?>

                            <?php if ($row['discapacidad'] == "no") {  ?>
                                <option value="no">No</option>
                                <option value="si">Si</option>
                            <?php  } ?>
                        
                        </select>
                    </div>

                    <div class="container_campos">
                        <input class="input" required type="text" name="enfermedad" id="enfermedad" placeholder=" " autocomplete="off" maxlength="30" value="<?php echo $row['enfermedad'] ?>">
                        <label class="label" id="label_enfermedad" for="enfermedad">Sufre alguna enfermedad?</label>
                    </div>

                    <div class="container_campos">
                        <input class="input" required type="text" name="tlf_estu" id="tlf_estu" placeholder=" " autocomplete="off" maxlength="12" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Formato 0xxx-xxxxxxx" value="<?php echo $row['tlf_estu'] ?>">
                        <label class="label" id="label_tlf_estu" for="tlf_estu">Telefono contacto</label>
                    </div>
                </div>


                <!-- campos ubicacion -->
                <div class="contenedor_ubicacion  contenedor_ubicacion_grid">
                    <div class="contenedor_titulo_ubicacion">
                        <p class="titulo_ubicacion">Donde reside actualmente</p>
                    </div>

                    <div class="campos_ubicacion">
                        <div class="container_campos">
                            <label class="label_select" for="estado_estu">Estado</label>
                            <select class="select" name="estado_estu" id="estado_estu">
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
                            <label class="label_select" for="municipio_estu">Municipio</label>
                            <select class="select" name="municipio_estu" id="municipio_estu" >
                            <option value="<?php echo $row['id_municipio'] ?>"><?php echo $row['municipio'] ?></option>

                            </select>
                        </div>

                        <div class="container_campos">
                            <label class="label_select" for="parroquia">Parroquia</label>
                            <select class="select" name="parroquia_estu" id="parroquia_estu" >
                            <option value="<?php echo $row['id_parroquia'] ?>"><?php echo $row['parroquia'] ?></option>

                            </select>
                        </div>

                        <div class="container_campos" for="sector">
                            <input class="input" required type="text" name="sector_estu" placeholder=" " autocomplete="off" id="sector_estu" maxlength="30" value="<?php echo $row['sector'] ?>">
                            <label class="label" id="label_sector_estu" for="sector_estu">Sector</label>
                        </div>
                    </div>
                </div>




                <!-- Lugar de nacimiento -->
                <div class="contenedor_ubicacion contenedor_ubicacion_grid">
                    <div class="contenedor_titulo_ubicacion">
                        <p class="titulo_ubicacion">Lugar de nacimiento</p>
                    </div>

                    <div class="campos_ubicacion">
                        <div class="container_campos">
                            <label class="label_select" for="pais">Pais</label>
                            <select class="select" name="pais" id="pais">
                            <option value="1">Venezuela</option>
                            </select>
                        </div>

                        <div class="container_campos">
                            <label class="label_select" for="estado_nacimiento_estu">Estado</label>
                            <select class="select" name="estado_nacimiento_estu" id="estado_nacimiento_estu">
                            <option value="<?php echo $estadoNacimiento['id_estado_nacimiento'] ?>"><?php echo $estadoNacimiento['estado'] ?></option>
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
                            <label class="label_select" for="ciudad">Ciudad</label>
                            <select class="select" name="ciudad" id="ciudad" >
                            <option value="<?php echo $row['id_ciudad_nacimiento'] ?>"><?php echo $row['ciudad'] ?></option>

                            </select>

                        </div>

                    </div>
                </div>
                <input class="boton boton_editar" type="submit" value="Editar">
                <input type="hidden" id="editar_estu">
            </div>
        </form>

        <?php include("../cuerpo/script.html") ?>


    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>