<?php
include("../db.php");

$ci_profe = $_POST['ci_profe'];
$id_periodo=$_SESSION['id_periodo'];

$select = "SELECT * FROM `asignacion` WHERE ci_profe_asignacion=$ci_profe && id_periodo=$id_periodo";
$comprobar_profe = mysqli_query($conexion, $select);
$resultado = mysqli_num_rows($comprobar_profe);

if($resultado>=1){
  $resultado = ["resultado" => "profesorAsignado"];

  echo json_encode($resultado);
  exit;
}

if (!empty($ci_profe)) {

  $select = "SELECT * FROM `profesor` WHERE ci_profe=$ci_profe";
  $comprobar_profe = mysqli_query($conexion, $select);
  $resultado = mysqli_num_rows($comprobar_profe);

  if ($resultado == 1) {
    $grado = $_POST['grado'];
    $seccion = $_POST['seccion'];
    $id_periodo = $_SESSION['id_periodo'];


    $registro = "INSERT INTO `asignacion`(`ci_profe_asignacion`, `id_periodo`, `id_grado`, `id_seccion`) VALUES ('$ci_profe','$id_periodo','$grado','$seccion')";


    $insertar_registro = mysqli_query($conexion, $registro);

    $resultado = ["resultado" => "exito"];

    echo json_encode($resultado);
  } else {
    $resultado = ["resultado" => "noExiste"];
    echo json_encode($resultado);
  }
}
