<?php
include("../db.php");

    $id_usuario = $_GET['id'];

    $elimar_usuario = "DELETE FROM `usuario` WHERE usuario='$id_usuario'";
    $ejecutar_eliminar_usuario = mysqli_query($conexion, $elimar_usuario);

    if($ejecutar_eliminar_usuario){ 
    $resultado=["resultado"=>"exito"];
    echo json_encode($resultado);

   } else {
 
    $resultado=["resultado"=>"error"];
    echo json_encode($resultado);
    }