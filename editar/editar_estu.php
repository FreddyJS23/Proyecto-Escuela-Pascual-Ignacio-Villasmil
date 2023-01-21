<?php
include("../db.php");
//esquema, aplica para editar profesor usuario y representrante
//vairable de referencia saber a que estudiante se le hara el update, en este caso tiene su id que es un cedula
$referencia = $_POST['referencia'];
$ci_estu = $_POST['ci_estu'];
$nombre_estu = $_POST['nombre_estu'];
$apellido_estu = $_POST['apellido_estu'];
$sx_estu = $_POST['sx_estu'];
$fn_estu = $_POST['fn_estu'];
$id_salud = 0;
$discapacidad = $_POST['discapacidad'];
$enfermedad = $_POST['enfermedad'];
$economia = $_POST['economia'];
$tlf_estu = $_POST['tlf_estu'];
//ubicacion estudiante_nacimiento
$pais = $_POST["pais"];
$estado_estu = $_POST["estado_estu"];
$ciudad = $_POST["ciudad"];
//ubicacion
$estado_estu = $_POST["estado_estu"];
$municipio_estu = $_POST["municipio_estu"];
$parroquia_estu = $_POST["parroquia_estu"];
$sector_estu = $_POST["sector_estu"];

//consulta a la tabla salud usando la referencia para obtener el id
$consulta_id_salud = "SELECT `id_salud` FROM `estudiante` where ci_estu=$referencia";
$ejecutar_consulta_id_salud = mysqli_query($conexion, $consulta_id_salud);
$row = mysqli_fetch_array($ejecutar_consulta_id_salud);
$id_salud = $row['id_salud'];



//update con usando el where con el id salud obtenido
$salud = "UPDATE `salud` SET `enfermedad`='$enfermedad',`discapacidad`='$discapacidad' WHERE id_salud=$id_salud";
$ejecutar_salud = mysqli_query($conexion, $salud);
//update al estudiante usan el where que tendra la referencia o el la cedula a la que se le aplicara todos lso cambios
$update_estu = "UPDATE `estudiante` SET `ci_estu`='$ci_estu',`nombre_estu`='$nombre_estu',`apellido_estu`='$apellido_estu',`sx_estu`='$sx_estu',`fn_estu`='$fn_estu',`id_economia`='$economia',`tlf_estu`='$tlf_estu',`id_pais_nacimiento`='$pais',`id_estado_nacimiento`='$estado_estu',`id_ciudad_nacimiento`='$ciudad' WHERE ci_estu=$referencia";
$ejecutar_update_estu = mysqli_query($conexion, $update_estu);

//respuesta de la peticion
if ($ejecutar_update_estu) {

   $resultado = ["resultado" => "exito"];
   echo json_encode($resultado);
} else {

   $resultado = ["resultado" => "error"];
   echo json_encode($resultado);
}
