<?php
require("../db.php");
//datos profesor
$ci_profe = $_POST['ci_profe'];

//evalua si la cedula el profesor es nula
if (!empty($ci_profe)) {
   $consultar_profe = "SELECT `nombre_profe`, `apellido_profe`  FROM `profesor` WHERE ci_profe=$ci_profe;";
   $ejecutar_consulta_profe = mysqli_query($conexion, $consultar_profe);

   $profesores = mysqli_num_rows($ejecutar_consulta_profe);

   //evalua si existe el profesor con la misma cedula
   if ($profesores == 0) {

    //datos profesor
      $nombre_profe = $_POST['nombre_profe'];
      $apellido_profe = $_POST['apellido_profe'];
      $sx_profe = $_POST['sx_profe'];
      $fn_profe = $_POST['fn_profe'];
      $tlf_profe = $_POST['tlf_profe'];
      $correo_profe = $_POST['correo_profe'];
      $grado_instruccion = $_POST['grado_instruccion'];
      $condicion_laboral = $_POST['condicion_laboral'];
      $status = "ON";
      $estado = $_POST['estado'];
      $municipio = $_POST['municipio'];
      $parroquia = $_POST['parroquia'];
      $sector = $_POST['sector'];


      //insertar Profesor
      $profesor = "INSERT INTO `profesor`(`ci_profe`, `nombre_profe`, `apellido_profe`, `fn_profe`, `sx_profe`, `tlf_profe`,`correo_profe`,`grado_instruccion`,`condicion_laboral`,`status`,`id_estado`, `id_municipio`, `id_parroquia`, `sector` ) 
            VALUES ('$ci_profe','$nombre_profe','$apellido_profe','$fn_profe','$sx_profe','$tlf_profe','$correo_profe','$grado_instruccion','$condicion_laboral','$status','$estado','$municipio','$parroquia','$sector')";

      $registro_profe = mysqli_query($conexion, $profesor);

      if ($registro_profe) {

         $resultado = ["resultado" => "exito"];
         echo json_encode($resultado);
      
      } else {

         $resultado = ["resultado" => "error"];
         echo json_encode($resultado);
     
      }
   
   } else {
      $resultado = ["resultado" => "existeProfe"];
      echo json_encode($resultado);
   }
} else {

   $resultado = ["resultado" => "error"];
   echo json_encode($resultado);
}
