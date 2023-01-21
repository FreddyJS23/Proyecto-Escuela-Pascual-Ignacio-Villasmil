<?php
require("../db.php");

$ci_estu = $_POST['ci_estu'];
$ci_repre = $_POST['ci_repre'];
$ci_repreExiste = @$_POST['check'];




if (!empty($ci_estu)) {

  $consultar_estu = "SELECT `ci_estu` FROM `estudiante` WHERE ci_estu=$ci_estu";
  $ejecutar_contulta_estu = mysqli_query($conexion, $consultar_estu);
  $estudiante = mysqli_num_rows($ejecutar_contulta_estu);
  if ($estudiante >= 1) {

    $resultado = ["respuesta" => "existeEstu"];
    echo json_encode($resultado);
    exit;
  }
}

if (empty($ci_repreExiste)) {

  if (!empty($ci_repre)) {

    $consultar_repre = "SELECT `ci_repre` FROM `representante` WHERE ci_repre=$ci_repre";
    $ejecutar_contulta_repre = mysqli_query($conexion, $consultar_repre);
    $representante = mysqli_num_rows($ejecutar_contulta_repre);
    if ($representante >= 1) {

      $resultado = ["respuesta" => "existeRepre"];
      echo json_encode($resultado);
      exit;
    }
  }
}

if (!empty($ci_estu) && !empty($ci_repre)) {

  //datos del representante
  $parentesco = @$_POST['parentesco'];
  if (empty($ci_repreExiste)) {

    $nombre_repre = $_POST['nombre_repre'];
    $apellido_repre = $_POST['apellido_repre'];
    $sx_repre = @$_POST['sx_repre'];
    $fn_repre = $_POST['fn_repre'];
    $tlf_repre = $_POST['tlf_repre'];


    //ubicacion representante
    $estado_repre = @$_POST["estado_repre"];
    $municipio_repre = @$_POST["municipio_repre"];
    $parroquia_repre = @$_POST["parroquia_repre"];
    $sector_repre = $_POST["sector_repre"];
   
    //comprobaR campos vacios
    if (
     empty($estado_repre)  ||
     empty($municipio_repre)  ||
     empty($parroquia_repre)   ||
     empty($sx_repre)
     
    ) {
      
     

       $respuesta = ["respuesta" => "errorRepresentante"];

      echo json_encode($respuesta);

      exit;
    }
  }
  //datos del estudiante

  $nombre_estu = $_POST['nombre_estu'];
  $apellido_estu = $_POST['apellido_estu'];
  $sx_estu = $_POST['sx_estu'];
  $fn_estu = $_POST['fn_estu'];
  $discapacidad =@$_POST['discapacidad'];
  $enfermedad = $_POST['enfermedad'];
  $economia =@$_POST['economia'];
  $tlf_estu = $_POST['tlf_estu'];

  //ubicacion estudiante_nacimiento
  $pais = $_POST["pais"];
  $estado_nacimiento_estu =@$_POST['estado_nacimiento_estu'];

  $ciudad = @$_POST["ciudad"];
  //ubicacion estudiante
  $estado_estu = @$_POST["estado_estu"];
  $municipio_estu = @$_POST["municipio_estu"];
  $parroquia_estu = @$_POST["parroquia_estu"];
  $sector_estu = $_POST["sector_estu"];

  //comprobar campos vacios
  if (
   empty( $sx_estu)  ||
   empty( $discapacidad)  ||
   empty( $pais) ||
   empty( $estado_nacimiento_estu )||
   empty( $economia) ||
   empty( $estado_estu )||
   empty( $municipio_estu) ||
   empty( $parroquia_estu ) 

  ) {

     $respuesta = ["respuesta" => "errorEstudiante"];

    echo json_encode($respuesta);
    exit;
  }
  //inscripcion
  $grado = $_POST['grado'];
  $id_periodo = $_SESSION['id_periodo'];






  //insertar representante
  if (empty($ci_repreExiste)) {

    $representante = "INSERT INTO `representante`(`ci_repre`, `nombre_repre`, `apellido_repre`, `fn_repre`, `sx_repre`, `tlf_repre`,`id_estado`, `id_municipio`, `id_parroquia`, `sector` ) 
                                        VALUES ('$ci_repre','$nombre_repre','$apellido_repre','$fn_repre','$sx_repre','$tlf_repre','$estado_repre','$municipio_repre','$parroquia_repre','$sector_repre')";
    $insertar_representante = mysqli_query($conexion, $representante);
  }



  //insertar estudiante

  if (@$insertar_representante || !empty($ci_repreExiste)) {


    $salud = "INSERT INTO `salud`( `enfermedad`, `discapacidad`) VALUES ('$enfermedad','$discapacidad')";
    $insertar_salud = mysqli_query($conexion, $salud);
    $id_salud = mysqli_insert_id($conexion);



    $estudiante = "INSERT INTO `estudiante`(`ci_estu`, `nombre_estu`, `apellido_estu`, `sx_estu`, `fn_estu`, `id_salud`, `id_economia`,`tlf_estu`, `id_estado`, `id_municipio`, `id_parroquia`, `sector`,`id_pais_nacimiento`, `id_estado_nacimiento`, `id_ciudad_nacimiento` ) 
                                VALUES ('$ci_estu','$nombre_estu','$apellido_estu','$sx_estu','$fn_estu','$id_salud','$economia','$tlf_estu','$estado_estu','$municipio_estu','$parroquia_estu','$sector_estu','$pais','$estado_nacimiento_estu','$ciudad')";

    $insertar_estudiante = mysqli_query($conexion, $estudiante);
  }


  //inscripcion
  if (@$insertar_estudiante) {


    $inscripcion = "INSERT INTO `inscripcion`( `id_grado`, `id_periodo`,`ci_estu_inscripcion` ) 
                                        VALUES ('$grado','$id_periodo','$ci_estu')";
    $insertar_inscripcion = mysqli_query($conexion, $inscripcion);




    $parentesco = "INSERT INTO `parentesco`(`parentesco`, `ci_repre`, `ci_estu`, `id_periodo`) VALUES ('$parentesco','$ci_repre','$ci_estu','$id_periodo')";
    $insertar_parentesco = mysqli_query($conexion, $parentesco);
 
  }


  /* --------------------------------- errores -------------------------------- */
  if (empty($ci_repreExiste)) {
    if (@!$insertar_representante) {

      $respuesta = ["respuesta" => "errorRepresentante"];

      echo json_encode($respuesta);

      exit;
    }
  } 
  
  if (!$insertar_estudiante) {

    $eliminar_repre = "DELETE FROM `representante` WHERE ci_repre=$ci_repre;";
    $eliminar_repre = mysqli_query($conexion, $eliminar_repre);
    $respuesta = ["respuesta" => "errorEstudiante"];

    echo json_encode($respuesta);
    exit;
  } elseif (!$insertar_inscripcion) {

    if (empty($ci_repreExiste)) {
      $eliminar_repre = "DELETE FROM `representante` WHERE ci_repre=$ci_repre;";
      $eliminar_repre = mysqli_query($conexion, $eliminar_repre);
    }

    $eliminar_estu = "DELETE FROM `estudiante` WHERE ci_estu=$ci_estu;";
    $eliminar_estu = mysqli_query($conexion, $eliminar_estu);

    $eliminar_parentesco = "DELETE FROM `parentesco` WHERE ci_estu=$ci_estu;";
    $eliminar_parentesco = mysqli_query($conexion, $eliminar_parentesco);

    $eliminar_salud = "DELETE FROM `salud` WHERE id_salud=$id_salud;";
    $eliminar_salud = mysqli_query($conexion, $eliminar_salud);

    $respuesta = ["respuesta" => "errorInscripcion"];

    echo json_encode($respuesta);

    exit;
  } else {

    /* ---------------------------------- exito --------------------------------- */

    $respuesta = ["respuesta" => "exito"];

    echo json_encode($respuesta);
  }
}
