<?php
include("../db.php");

$usuario = @$_POST['usuario'];
$ci_profe = @$_POST['ci_profe'];
$password = @$_POST['password'];
$pregunta_secreta1=@$_POST['pregunta_secreta1'];
$pregunta_secreta2=@$_POST['pregunta_secreta2'];
$pregunta_secreta3=@$_POST['pregunta_secreta3'];
//encriptacion de la contraseña
$password_hash=password_hash($password,PASSWORD_BCRYPT);

$cargo = 2;


$consultar_profe = "SELECT `nombre_profe`, `apellido_profe`  FROM `profesor` WHERE ci_profe=$ci_profe;";
$ejecutar_consulta_profe = mysqli_query($conexion, $consultar_profe);

$profesores = mysqli_num_rows($ejecutar_consulta_profe);

if ($profesores == 1) {

  $row = mysqli_fetch_array($ejecutar_consulta_profe);
  $nombre = $row['nombre_profe'];
  $apellido = $row['apellido_profe'];


  $consulta_usuario = "SELECT  `usuario` FROM `usuario` WHERE usuario='$usuario' ";
  $ejecutar_consulta = mysqli_query($conexion, $consulta_usuario);
  $filas = mysqli_num_rows($ejecutar_consulta);


  if ($filas >= 1) {

    $resultado = ["resultado" => "usuarioExiste"];
    echo json_encode($resultado);
    exit;
  } else {

    $registro_usuario = "INSERT INTO `usuario`(`usuario`, `pass`, `id_cargo`, `nombre`, `apellido`,`ci_profe`, `pregunta_secreta1`, `pregunta_secreta2`, `pregunta_secreta3`)
                         VALUES ('$usuario','$password_hash','$cargo','$nombre','$apellido','$ci_profe','$pregunta_secreta1', '$pregunta_secreta2', '$pregunta_secreta3')";
    $insertar_usuario = mysqli_query($conexion, $registro_usuario);

    if ($insertar_usuario) {

      $resultado = ["resultado" => "exito"];
      
      echo json_encode($resultado);
    } else {
      $resultado = ["resultado" => "error"];
      echo json_encode($resultado);
    }
  }
} else {

  $resultado = ["resultado" => "noExisteProfe"];
  echo json_encode($resultado);
}
