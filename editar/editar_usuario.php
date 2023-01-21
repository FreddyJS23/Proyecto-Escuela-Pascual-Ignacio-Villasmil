<?php
include("../db.php");

$referencia = $_POST['referencia'];
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$password = $_POST['password'];

$password_hash=password_hash($password,PASSWORD_BCRYPT);
$editar_usuario = "UPDATE `usuario` SET `usuario`='$usuario',`pass`='$password_hash',`nombre`='$nombre',`apellido`='$apellido' WHERE usuario='$referencia'";
$insertar_editar_usuario = mysqli_query($conexion, $editar_usuario);

if ($insertar_editar_usuario) {
        $resultado = ["resultado" => "exito"];
        echo json_encode($resultado);
} else {

        $resultado = ["resultado" => "error"];
        echo json_encode($resultado);
}
