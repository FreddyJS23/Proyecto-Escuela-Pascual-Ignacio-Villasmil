<?php
require("../db.php");

if($_GET){ 
$grado=$_GET['grado'];
$seccionesActivar=$_GET['seccionesActivar'];
$id_periodo=$_SESSION['id_periodo'];

$sqlActivarSecciones="INSERT INTO `secciones_activas`( `id_grado`, `id_periodo`, `secciones_activas`) 
                                            VALUES ('$grado','$id_periodo','$seccionesActivar')";

$activarSecciones=mysqli_query($conexion,$sqlActivarSecciones);

if($activarSecciones){

    $resultado=['resultado'=>'exito'];

    echo json_encode($resultado);
}else{
   
    $resultado=['resultado'=>'error'];

    echo json_encode($resultado);
    
}


 }

?>