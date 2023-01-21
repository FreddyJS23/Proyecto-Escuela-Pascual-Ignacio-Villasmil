<?php

include("../db.php");
$ci_repre = $_GET['id'];

$select_repre = "SELECT `ci_repre`, `nombre_repre`, `apellido_repre`, `fn_repre`, `sx_repre`, `tlf_repre`, `estado`, `municipio`, `parroquia`, `sector` FROM `representante`
    INNER JOIN estados
     ON representante.id_estado=estados.id_estado
    INNER JOIN municipios
    ON representante.id_municipio=municipios.id_municipio
    INNER JOIN parroquias
    ON representante.id_parroquia=parroquias.id_parroquia WHERE ci_repre=$ci_repre";

$sql_repre = mysqli_query($conexion, $select_repre);
$row=mysqli_fetch_array($sql_repre);


//obner parentesco
/* $id_periodo=$_SESSION['id_periodo'];
$select_parentesco="SELECT parentesco FROM parentesco WHERE ci_repre=$ci_repre GROUP BY ci_repre;";
$sql_parentesco=mysqli_query($conexion,$select_parentesco);
$parentesco=mysqli_fetch_array($sql_parentesco);
 */


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../cuerpo/head.html") ?>
    <title>Representante</title>
</head>

<body>


    <form action="../registros/editar_repre.php" method="post" id="formulario">
        
        <input type="hidden" name="referencia" value="<?= $row['ci_repre'] ?>">
        <div class="contenedor_representante contenedor_representante_grid">
            <div class="titulo_formulario titulo_formulario_grip">
                <p><i class="fa-solid fa-person-breastfeeding"></i>Datos del representante</p>
            </div>
            <div class="campos_representante campos_representante_grid">
                <div class="container_campos container_ci_repre">
                    <input class="input" required type="text" name="ci_repre" id="ci_repre" value="<?= $row['ci_repre'] ?>" placeholder=" " autocomplete="off" maxlength="8">
                    <label class="label" id="label_ci_repre" for="ci_repre">Cedula </label>
                </div>
                <div class="container_campos">
                    <input class="input" required type="text" name="nombre_repre" id="nombre_repre" value="<?= $row['nombre_repre'] ?>" placeholder=" " autocomplete="off" maxlength="30">
                    <label class="label" id="label_nombre_repre" for="nombre_repre">Nombre completo </label>
                </div>
                <div class="container_campos">
                    <input class="input" required type="text" name="apellido_repre" id="apellido_repre" value="<?= $row['apellido_repre'] ?>" placeholder=" " autocomplete="off" maxlength="30">
                    <label class="label" id="label_apellido_repre" for="apellido_repre">Apellido completo </label>
                </div>
                <div class="container_campos">
                    <input class="input" required type="date" name="fn_repre" id="fn_repre"  value="<?= $row['fn_repre'] ?>">
                    <label class="label" for="fn_repre">Fecha nacimiento </label>
                </div>
                <div class="container_campos genero">
                    <label class="label_select" for="sx_repre">Genero</label>
                    <select class="select" name="sx_repre" id="sx_repre">
                        <option value="0">Seleccione un genero</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                <div class="container_campos">
                    <input class="input" required type="text" name="tlf_repre" id="tlf_repre" placeholder=" "  value="<?= $row['tlf_repre'] ?>"autocomplete="off" maxlength="12" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Formato 0xxx-xxxxxxx">
                    <label class="label" id="label_tlf_repre" for="tlf_repre">Telefono contacto</label>
                </div>
                <!-- <div class="container_campos">
                    <input class="input" required type="text" name="parentesco" id="parentesco" placeholder=" " value="" autocomplete="off" maxlength="15">
                    <label class="label" id="label_parentesco" for="parentesco">Parentesco con el estudiante</label>
                </div> -->
            </div>
            <!-- ubicacion -->
            <div class="contenedor_ubicacion">
                <div class="contenedor_titulo_ubicacion">
                    <p class="titulo_ubicacion">Donde recide actualemte</p>
                </div>
                <div class="campos_ubicacion">
                    <div class="container_campos">
                        <label class="label_select" for="estado">Estado</label>
                        <select class="select" name="estado_repre" id="estado_repre">
                            <option value="0"> <?= $row['estado'] ?></option>
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
                        <select class="select" name="municipio_repre" id="municipio_repre" disabled>
                            <option value="0"> <?= $row['municipio'] ?></option>

                            <option value="460">Sucre</option>
                        </select>
                    </div>
                    <div class="container_campos">
                        <label class="label_select" for="parroquia">Parrquia</label>
                        <select class="select" name="parroquia_repre" id="parroquia_repre" disabled>
                            <option value="0"> <?= $row['parroquia'] ?></option>

                        </select>
                    </div>
                    <div class="container_campos" for="sector">
                        <input class="input" required type="text" name="sector_repre" placeholder=" " autocomplete="off" id="sector_repre"  value="<?= $row['sector'] ?>" maxlength="30">
                        <label class="label" id="label_sector_repre" for="sector_repre">Sector</label>
                    </div>
                </div>
        
            </div>
            <input class="boton boton_editar" type="submit" value="Editar">
            <input type="hidden" id="editar_repre">
        </div>
        
    </form>

    <?php include("../cuerpo/script.html") ?>
</body>

</html>