<?php 

/* ------------- comprobar que existe base de datos en el login ------------- */
$comprobarBd=@$_GET['comprobarBd'];

/* ------------- instalar base de datos en caso de que no exista ------------- */
$crearBd=@$_GET['crearBd'];


/* ------------------ comprobar que existe la base de datos ----------------- */
if(!empty($comprobarBd)){
   
    $db = mysqli_connect("localhost", "root", "");
    $selectDb = mysqli_select_db($db, "sistema automatizado registro control de notas");
    //comprobar si existe la base de datos para crearla
    if (mysqli_errno($db) == 1049) {
       $resultado=['resultado'=>'noExiste'];
       echo json_encode($resultado);
    }
}

/* ------------------------- instalar base de datos ------------------------- */
if(!empty($crearBd)){

    //obtener la ruta actual del archivo php en ejecucion, en este caso instalarBd.php
   $ruta=getcwd();
    //concadenar la ruta del archivo php con el nombre de la bd 
    //ya que en la misma ruta que se ejecute este archivo debe estar la base de datos
   $ruta=$ruta . "\sistema_automatizado_registro_control_de_notas.sql";

   //quedaria = C:\wamp64\www\Proyecto\instalarBd\sistema_automatizado_registro_control_de_notas.sql
   
    //comando cmd que ejecutara el php
    $cmd="(mysql -u root < $ruta )";
    
    //ejecucion
    exec($cmd, $output, $result);
    //valor devuelto 1= error
    //valor devuelto 0= correcto

    echo json_encode($result);
}





?>