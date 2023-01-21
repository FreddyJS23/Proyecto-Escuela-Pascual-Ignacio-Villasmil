<?php
require("db.php");

$usuario = $_POST['usuario'];
$password = $_POST['contraseña'];
$id_periodo = $_POST['periodo'];


//consulta a la bd sobre el usuario
$consulta = "SELECT  usuario,ci_profe,pass, id_cargo FROM `usuario` WHERE  usuario='$usuario'";
$resultado = mysqli_query($conexion, $consulta);

//si no se encuentra filas quiere decir que el usuario no existe
if(mysqli_num_rows($resultado)==0){ 
    $resultado = ['resultado' => 'usuarioNoExiste'];
    echo json_encode($resultado);
    exit;
 }

 //extraer consulta de la base de datos
$filas = mysqli_fetch_array($resultado);
//extraer contraseña incriptada de la base de datos
$password_hash=$filas['pass'];

//caso que no se seleccione un periodo
if (empty($id_periodo)) {
    $resultado = ['resultado' => 'errorPeriodo'];
    echo json_encode($resultado);
    exit;
   
}

//verificacion de contraseña
//compara el hash de la contraseña del formulario con el hash de la contraseña de la bd
if ( password_verify($password,$password_hash)) {
    //manejar el id periodo para obtener el periodo en si
    if ($id_periodo != "todos") {
        $periodo = "SELECT `periodo`FROM `periodo` WHERE id_periodo=$id_periodo;";
        $sql = mysqli_query($conexion, $periodo);
        $row = mysqli_fetch_array($sql);
        $periodo = $row['periodo'];
    }

    if ($filas["id_cargo"] == 1) {
        $_SESSION["cargo"] = $filas["id_cargo"];
        $_SESSION['usuario'] = $usuario;
        $_SESSION['ci_profe']=$filas['ci_profe'];
        $_SESSION['id_periodo'] = $id_periodo;
        $_SESSION['periodo'] = @$periodo;
        $resultado = ['resultado' => 'exitoAdmin'];
        echo json_encode($resultado);
    } elseif ($filas["id_cargo"] == 2) {
        $_SESSION["cargo"] = $filas["id_cargo"];
        $_SESSION['usuario'] = $usuario;
        $_SESSION['ci_profe']=$filas['ci_profe'];
        $_SESSION['id_periodo'] = $id_periodo;
        $_SESSION['periodo'] = @$periodo;
        $resultado = ['resultado' => 'exitoUsuario'];
        echo json_encode($resultado);;
    }
} else {
    $resultado = ['resultado' => 'passwordIncorrecto'];
    echo json_encode($resultado);
}
