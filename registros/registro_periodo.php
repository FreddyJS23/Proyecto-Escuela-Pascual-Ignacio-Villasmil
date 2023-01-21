<?php
include("../db.php");

$periodo = $_GET['periodo'];

if (!empty($periodo)) {
    $comprobar = "SELECT * FROM `periodo` WHERE periodo='$periodo'";
    $sql = mysqli_query($conexion, $comprobar);
    $comprobar = mysqli_num_rows($sql);

    if ($comprobar >= 1) {
        $resultado = ['resultado' => 'periodoExiste'];
        echo json_encode($resultado);
        exit;
    
    } else {
        $insertar = "INSERT INTO `periodo`( `periodo`, `status`) VALUES ('$periodo','ON')";
        $sql = mysqli_query($conexion, $insertar);

        if ($sql) {
            $resultado = ['resultado' => 'exito'];
            echo json_encode($resultado);
        } else {
            $resultado = ['resultado' => 'error'];
            echo json_encode($resultado);
        }
    }
} else {
    $resultado = ['resultado' => 'error'];
    echo json_encode($resultado);
}
