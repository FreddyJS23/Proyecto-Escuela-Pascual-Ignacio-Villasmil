<?php
require("../db.php");

$grado = $_POST['grado'];
$ci_estu = $_POST['ci_estu'];
$ci_repre = $_POST['ci_repre'];



/* ------------------------- verificar representante ------------------------ */

$verificar_repre = "SELECT * FROM `representante` WHERE ci_repre=$ci_repre";
$consultar_repre = mysqli_query($conexion, $verificar_repre);

$total_repre = mysqli_num_rows($consultar_repre);



/* -------------------------- verificar estudiante -------------------------- */
$verificar_estu = "SELECT * FROM `estudiante` WHERE ci_estu=$ci_estu";
$consultar_estu = mysqli_query($conexion, $verificar_estu);

$total_estu = mysqli_num_rows($consultar_estu);

/* -------------------------- verificar estudiante que no este inscriito en el periodo -------------------------- */
$verificar_estuMismoPeriodo = "SELECT * FROM `inscripcion` WHERE ci_estu_inscripcion=$ci_estu && id_periodo=$id_periodo";
$consultar_estuMismoPeriodo = mysqli_query($conexion, $verificar_estuMismoPeriodo);

$total_estuMismoPeriodo = mysqli_num_rows($consultar_estuMismoPeriodo);


if ($total_estu == 0) {

   $resultado = ["resultado" => "noEstu"];
   echo json_encode($resultado);
   exit;

}else if ($total_repre == 0) {

   $resultado = ["resultado" => "noRepre"];
   echo json_encode($resultado);
   exit;
}else if ($total_estuMismoPeriodo == 1) {

   $resultado = ["resultado" => "existeEstu"];
   echo json_encode($resultado);
   exit;
}  

/* --------------------------- inscripcion regular -------------------------- */

$preguntar_parentesco = "SELECT parentesco FROM `parentesco` WHERE ci_estu=$ci_estu && ci_repre =$ci_repre GROUP BY parentesco";
$consultar_parentesco = mysqli_query($conexion, $preguntar_parentesco);

$resultado = mysqli_fetch_array($consultar_parentesco);

@$parentesco = $resultado['parentesco'];


if (!empty($parentesco)) {

   $id_periodo = $_SESSION['id_periodo'];

   $insertar_parentesco = "INSERT INTO `parentesco`(`parentesco`, `ci_repre`, `ci_estu`, `id_periodo`) VALUES ('$parentesco','$ci_repre','$ci_estu','$id_periodo')";
   $ejecutar_consulta = mysqli_query($conexion, $parentesco);


   $inscripcion = "INSERT INTO `inscripcion`(`id_grado`, `id_periodo` ,`ci_estu_inscripcion`)
                                    VALUES ('$grado','$id_periodo','$ci_estu')";
   $insertar_inscripcion = mysqli_query($conexion, $inscripcion);
} else {

   $resultado = ["resultado" => "errorParentesco"];
   echo json_encode($resultado);

   exit;
}

if (!$insertar_inscripcion) {
   $resultado = ["resultado" => "errorInscripcion"];
   echo json_encode($resultado);
   exit;
} else {

   $resultado = ["resultado" => "exito"];
   echo json_encode($resultado);
}
