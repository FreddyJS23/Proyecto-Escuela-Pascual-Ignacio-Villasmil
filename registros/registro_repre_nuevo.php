<?php

include("../db.php");

$ci_repre = $_POST['ci_repre'];
$ci_estu = $_POST['ci_estu'];
$id_periodo = $_SESSION['id_periodo'];

if (!empty($ci_repre)) {

    $consultar_repre = "SELECT `ci_repre` FROM `representante` WHERE ci_repre=$ci_repre";
    $ejecutar_contulta_repre = mysqli_query($conexion, $consultar_repre);
    $representante = mysqli_num_rows($ejecutar_contulta_repre);
    if ($representante >= 1) {

        $resultado = ["resultado" => "existeRepresentante"];
        echo json_encode($resultado);
        exit;
    }
}



$nombre_repre = $_POST['nombre_repre'];
$apellido_repre = $_POST['apellido_repre'];
$sx_repre = @$_POST['sx_repre'];
$fn_repre = $_POST['fn_repre'];
$tlf_repre = $_POST['tlf_repre'];
$parentesco = @$_POST['parentesco'];


//ubicacion representante
$estado_repre = @$_POST["estado_repre"];
$municipio_repre = @$_POST["municipio_repre"];
$parroquia_repre = @$_POST["parroquia_repre"];
$sector_repre = $_POST["sector_repre"];

//comprobaR campos vacios
if (
    empty($estado_repre)  ||
    empty($municipio_repre)  ||
    empty($parroquia_repre)   ||
    empty($sx_repre)

) {



    $resultado = ["resultado" => "errorRepresentante"];

    echo json_encode($resultado);

    exit;
}

$representante = "INSERT INTO `representante`(`ci_repre`, `nombre_repre`, `apellido_repre`, `fn_repre`, `sx_repre`, `tlf_repre`,`id_estado`, `id_municipio`, `id_parroquia`, `sector` ) 
                                        VALUES ('$ci_repre','$nombre_repre','$apellido_repre','$fn_repre','$sx_repre','$tlf_repre','$estado_repre','$municipio_repre','$parroquia_repre','$sector_repre')";
$insertar_representante = mysqli_query($conexion, $representante);

if ($insertar_representante) {
    $parentesco = "INSERT INTO `parentesco`(`parentesco`, `ci_repre`, `ci_estu`, `id_periodo`) VALUES ('$parentesco','$ci_repre','$ci_estu','$id_periodo')";
    $insertar_parentesco = mysqli_query($conexion, $parentesco);

    if ($insertar_parentesco) {
        $resultado = ['resultado' => 'exito'];
        echo json_encode($resultado);
    }
} else {
    $resultado = ['resultado' => 'errorRepresentante'];
    echo json_encode($resultado);
}
