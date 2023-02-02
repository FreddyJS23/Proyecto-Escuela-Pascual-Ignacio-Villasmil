<?php
include("../db.php");

$usuario = @$_POST['usuario'];
$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$ci_profe = @$_POST['ci_profe'];
$password = @$_POST['password'];
$pregunta_secreta1=@$_POST['pregunta_secreta1'];
$pregunta_secreta2=@$_POST['pregunta_secreta2'];
$pregunta_secreta3=@$_POST['pregunta_secreta3'];
//encriptacion de la contraseña
$password_hash=password_hash($password,PASSWORD_BCRYPT);

$cargo = 1;


    $registro_administrador = "INSERT INTO `usuario`(`usuario`, `pass`, `id_cargo`, `nombre`, `apellido`,`ci_profe`, `pregunta_secreta1`, `pregunta_secreta2`, `pregunta_secreta3`)
                         VALUES ('$usuario','$password_hash','$cargo','$nombre','$apellido','$ci_profe', '$pregunta_secreta1', '$pregunta_secreta2', '$pregunta_secreta3')";
    $insertar_administrador = mysqli_query($conexion, $registro_administrador);

    if ($insertar_administrador) {

      $resultado = ["resultado" => "exito"];
      
      echo json_encode($resultado);
    } else {
      $resultado = ["resultado" => "error"];
      echo json_encode($resultado);
    }
  
