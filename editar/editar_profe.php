<?php
require("../db.php");
//datos profesor
$referencia = $_POST['referencia'];
$ci_profe = $_POST['ci_profe'];
$nombre_profe = $_POST['nombre_profe'];
$apellido_profe = $_POST['apellido_profe'];
$sx_profe = $_POST['sx_profe'];
$fn_profe = $_POST['fn_profe'];
$tlf_profe = $_POST['tlf_profe'];
$correo_profe = $_POST['correo_profe'];
$grado_instruccion=$_POST['grado_instruccion'];
$condicion_laboral=$_POST['condicion_laboral'];
$status=$_POST['status'];


$estado = $_POST['estado'];
$municipio = $_POST['municipio'];
$parroquia = $_POST['parroquia'];
$sector = $_POST['sector'];

//insertar Profesor


$editar_profe = "UPDATE `profesor` SET `ci_profe`='$ci_profe',`nombre_profe`='$nombre_profe',`apellido_profe`='$apellido_profe',`fn_profe`='$fn_profe',`sx_profe`='$sx_profe',`tlf_profe`='$tlf_profe',`correo_profe`='$correo_profe',`grado_instruccion`='$grado_instruccion',`condicion_laboral`='$condicion_laboral',`status`='$status',`id_estado`='$estado',`id_municipio`='$municipio',`id_parroquia`='$parroquia',`sector`='sector' WHERE ci_profe=$referencia";

$ejecutar_editar_profe = mysqli_query($conexion, $editar_profe);



if ($ejecutar_editar_profe) {

$resultado=["resultado"=>"exito"];
echo json_encode($resultado);

   } else {
 
    $resultado=["resultado"=>"error"];
    echo json_encode($resultado);
    }
