<?php
$backupDb = @$_GET['backupDb'];
$restoreDb = @$_GET['restoreDb'];



if ($backupDb) {
    //ruta de carpeta a guardar los backup
    $carpeta='C:\Backup sistema automatizado registro control de notas';
    //condicional en caso que la carpeta no exista
    if(!file_exists($carpeta)){
      
        mkdir($carpeta,0777);
    }
    
  
    
    
    $fecha = date('d-m-y');
    //agregar variable de entorno, sistema path primero la ruta   "mysql5.7.36\bin"
    //comando respaldo
    //formato "nombre de la base de datos" ">"ruta donde se va a guardar"
    //mysqldump -u root "sistema automatizado registro control de notas" > "C:\Backup sistema automatizado registro control de notas\backup.sql"
    // (\" \") ese formato permite incluir comillas dobles("") dentro de comillas dobles
    exec("(mysqldump -u root \"sistema automatizado registro control de notas\" > \"C:\Backup sistema automatizado registro control de notas\backup $fecha.sql\")", $output, $result);
   
    $resultado = ['resultado' => $result];
  
    echo json_encode($resultado);
}

if ($restoreDb) {
   
    $restoreFile = @$_GET['restoreFile'];
    $db = mysqli_connect("localhost", "root", "");
    $selectDb = mysqli_select_db($db, "sistema automatizado registro control de notas");
    //comprobar si existe la base de datos para crearla
    if (mysqli_errno($db) == 1049) {
        $crearDb = "CREATE DATABASE sistema automatizado registro control de notas";
        $sql = mysqli_query($db, $crearDb);
    }
    //doble barra significa una barra "\\"="\"
    $cmd="(mysql -u root  \"sistema automatizado registro control de notas\" <\"C:\Backup sistema automatizado registro control de notas\\$restoreFile\")";
   
    exec($cmd, $output, $result);
   
    //mysql -u root  simulacion < "C:\Backup sistema automatisado\backup 01-12-22.sql
    $resultado = ['resultado' => $result];

    echo json_encode($resultado);
}



//comando crear base de datos en caso que no exista
//CREATE DATABASE simulacion CHARACTER SET ut8mb4;

//mysql -u root -p simulacion < backup.sql

//opcion1
/* $db_host = 'localhost'; //Host del Servidor MySQL
$db_name = 'simulacion'; //Nombre de la Base de datos
$db_user = 'root'; //Usuario de MySQL
$db_pass = ''; //Password de Usuario MySQL

$fecha = date("Ymd-His"); //Obtenemos la fecha y hora para identificar el respaldo

// Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
$salida_sql = $db_name.'_'.$fecha.'.sql'; 

//Comando para genera respaldo de MySQL, enviamos las variales de conexion y el destino
$dump = "mysqldump -h localhost -u usuario -pPassword --opt nombreBD Tabla --single-transaction --quick --lock-tables=false > dump.sql";
//mysqldump -u $db_user  -p $db_name --single-transaction --quick --lock-tables=false > si-backup-$(date +%F)
system($dump, $output); //Ejecutamos el comando para respaldo */


/* $mysqlDatabaseName ='Database name';
$mysqlUserName ='root';
$mysqlPassword ='';
$mysqlHostName ='localhost';
$mysqlExportPath ='h.sql';

//Please do not change the following points
//Export of the database and output of the status
$command='mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ' .$mysqlExportPath;
exec($command,$output); */
