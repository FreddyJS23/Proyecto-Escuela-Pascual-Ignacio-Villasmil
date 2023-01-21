<?php
include("../db.php");
$ajax_status=$_GET['periodoStatus'];

if(!empty($ajax_status)){ 

   
$id_periodo=$_SESSION['id_periodo'];



$editar_status="UPDATE `periodo` SET `status`='OFF' WHERE id_periodo='$id_periodo'";
$editar=mysqli_query($conexion,$editar_status);

if($editar){

    $resultado=["resultado"=>"exito"];

    echo json_encode($resultado);
}else{
    $resultado=["resultado"=>"error"];

    echo json_encode($resultado);

}
 }



?>