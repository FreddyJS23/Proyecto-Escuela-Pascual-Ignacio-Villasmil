<?php
include("../db.php");

$referencia = $_POST['referencia'];
$ci_repre = $_POST['ci_repre'];
$nombre_repre = $_POST['nombre_repre'];
$apellido_repre = $_POST['apellido_repre'];
$sx_repre = $_POST['sx_repre'];
$fn_repre = $_POST['fn_repre'];
$tlf_repre = $_POST['tlf_repre'];


//ubicacion representante
$estado_repre = $_POST["estado_repre"];
$municipio_repre = $_POST["municipio_repre"];
$parroquia_repre = $_POST["parroquia_repre"];
$sector_repre = $_POST["sector_repre"];





//update al estudiante usan el where que tendra la referencia o el la cedula a la que se le aplicara todos lso cambios
$update_repre = "UPDATE `representante` SET `ci_repre`='$ci_repre',`nombre_repre`='$nombre_repre',`apellido_repre`='$apellido_repre',`fn_repre`='$fn_repre',`sx_repre`='$sx_repre',`tlf_repre`='$tlf_repre',`id_estado`='$estado_repre',`id_municipio`='$municipio_repre,`id_parroquia`='$parroquia_repre',`sector`='$sector_repre' WHERE ci_repre=$referencia";
$ejecutar_update_repre = mysqli_query($conexion, $update_repre);

//respuesta de la peticion
if ($ejecutar_update_repre) {

   $resultado = ["resultado" => "exito"];
   echo json_encode($resultado);
} else {

   $resultado = ["resultado" => "error"];
   echo json_encode($resultado);
}
