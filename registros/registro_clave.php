<?php
 $conexion=@mysqli_connect("localhost","root","","sistema automatizado registro control de notas");
  
session_start();


$usuario =$_SESSION['usuario'];
$password = @$_POST['password'];

//encriptacion de la contraseña
$password_hash=password_hash($password,PASSWORD_BCRYPT);




    $cambiar_calve= "UPDATE `usuario` SET `pass`='$password_hash' WHERE usuario='$usuario'";
    $sql_cambiar_clave = mysqli_query($conexion, $cambiar_calve);

  if($sql_cambiar_clave){
    session_destroy();
    header("location:../index.html");
  }else{
    echo "error";
  }
