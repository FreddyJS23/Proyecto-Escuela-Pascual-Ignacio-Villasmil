<?php
include("../db.php");

$referencia = $_POST['referencia'];
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$password = $_POST['password'];
$pregunta_secreta1=@$_POST['pregunta_secreta1'];
$pregunta_secreta2=@$_POST['pregunta_secreta2'];
$pregunta_secreta3=@$_POST['pregunta_secreta3'];

$password_hash=password_hash($password,PASSWORD_BCRYPT);
$editar_usuario = "UPDATE `usuario` SET `usuario`='$usuario',`pass`='$password_hash',`nombre`='$nombre',`apellido`='$apellido',`pregunta_secreta1`='$pregunta_secreta1',`pregunta_secreta2`='$pregunta_secreta2',`pregunta_secreta3`='$pregunta_secreta3' WHERE usuario='$referencia'";
$insertar_editar_usuario = mysqli_query($conexion, $editar_usuario);

if ($insertar_editar_usuario) {
        $resultado = ["resultado" => "exito"];
        echo json_encode($resultado);
} else {

        $resultado = ["resultado" => "error"];
        echo json_encode($resultado);
}
