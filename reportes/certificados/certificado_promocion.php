 <?php

$ci_estu=$_POST['ci_estu'];

$grado=$_POST['grado'];    
$nota=$_POST['literal'];

if($grado==1){
    $grado="PRIMER";
}
elseif($grado==2){
    $grado="SEGUNDO";
}
elseif($grado==3){
    $grado="TERCER";
}
elseif($grado==4){
    $grado="CUARTO";
}
elseif($grado==5){
    $grado="QUINTO";
}
elseif($grado==6){
    $grado="SEXTO";
}



include("../../db.php");

$select_estu = "SELECT `ci_estu`, `nombre_estu`, `apellido_estu`, `fn_estu`,`estado`,`ciudad` FROM `estudiante` 
    
    INNER JOIN estados
    ON estudiante.id_estado_nacimiento=estados.id_estado
    INNER JOIN ciudades
    ON estudiante.id_ciudad_nacimiento=ciudades.id_ciudad where ci_estu=$ci_estu";

    $sql=mysqli_query($conexion,$select_estu);
    $estudiante=mysqli_fetch_array($sql);
    
$consultarGrado="SELECT ci_estu_inscripcion FROM `inscripcion` WHERE id_grado=6 && ci_estu_inscripcion=$ci_estu";
$consultaGrado=mysqli_query($conexion,$consultarGrado);
$grado=mysqli_num_rows($consultaGrado);
if($grado==0){
    $resultado=["resultado"=>'noCursoGrado'];
    echo json_encode($resultado);
    exit;
}
   


$consultar_fecha_nacimiento="SELECT  fn_estu FROM `estudiante` WHERE ci_estu=$ci_estu";
$consulta_fecha_nacimiento=mysqli_query($conexion,$consultar_fecha_nacimiento);
$consulta_fecha_nacimiento=mysqli_fetch_array($consulta_fecha_nacimiento);

$fecha_nacimiento=$consulta_fecha_nacimiento['fn_estu'];

//date time para obtener la fecha ya que esta funcion se trabajara con objetos
//se incializa un dateTime con la fecha de la bd
$fecha_nacimiento=new DateTime($fecha_nacimiento);
//se inicializa otro con la fecha actual
$fecha_actual=new DateTime();
//date diff saca la diferencia de años
$edad=date_diff($fecha_actual,$fecha_nacimiento);
//ya que se trabaja con objetos se accede al objeto year de $edad
$edad=$edad->y;

//obtener año mes y dia actual 
$año=date("Y");
$mes=date("m");
$dia=date("d");

ob_start()
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
         * {
             font-family: Arial, Helvetica, sans-serif;
         }


         .linea_1,
         .linea_2,
         .linea_3,
         .linea_5,
         .linea_7,
         .linea_8 {
             text-align: center;
         }

         .linea_4,
         .linea_6,
         .linea_7 {
             text-align: justify;
             text-indent: 10px;


         }

         .linea_bottom {
             border-bottom: 2px solid black;
         }

         .linea_1 img {
             margin-left: 20px;
         }
     </style>
     <title>Certificado de promoción</title>
 </head>

 <body>
     <div class="linea_1">
         <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/Proyecto/css/logos de constancias/img1.png" alt="img1" width="">
         <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/Proyecto/css/logos de constancias/img2.png" alt="img2" width="">
         <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/Proyecto/css/logos de constancias/img3.png" alt="img3" width="">
         <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/Proyecto/css/logos de constancias/img4.png" alt="img4" width="">
     </div>

     <div class="linea_2">
         <p>
             REPUBLICA BOLIVARIANA DE VENEZUELA <br>
             DIRECCIÓN DE EDUCACION, CULTURA Y DEPORTE <br>
             ESCUELA ESTADAL “PASCUAL IGNACIO VILLASMIL” <br>
             CODIGO DEA OD00991407 <br>
             TELEFONO: 0275 - 4441950 <br>
             TUCANI ESTADO MÉRIDA
         </p>
     </div> <br>

     <div class="linea_3">
         <p>
             <b> Certificado de Promoción.</b>
         </p>
     </div> <br>

     <div class="linea_4">
         <p>
             Quien suscribe, Esp. Francisco Javier Ángel, Titular de la Cédula de Identidad Nº 14.530.553, Director (e)
             de la Escuela Estadal “Pascual Ignacio Villasmil”, por medio de la presente:
         </p>
     </div> <br>



     <div class="linea_5">
         <p><b>HACE CONSTAR</b></p>

     </div> <br>

     <div class="linea_6">
         <p>
             Que el estudiante: <b class="linea_bottom"><?= $estudiante['apellido_estu'] ?></b>,<b class="linea_bottom"><?= $estudiante['nombre_estu'] ?></b> Titular de la Cédula de Identidad o Escolar Nº <b class="linea_bottom"><?= $estudiante['ci_estu'] ?></b>
             natural de <b class="linea_bottom"><?= $estudiante['ciudad'] ?></b><b class="linea_bottom"><?= " – " . $estudiante['estado'] ?></b> de <b class="linea_bottom"><?=$edad ?></b> años de edad, 
             . Ha sido <b>PROMOVIDO (A): </b> al <b> PRIMER AÑO </b> de Educación Media, por haber alcanzado las competencias requeridas, según el artículo 108 del Reglamento General de la Ley Orgánica de Educación y la Resolución 266 del Ministerio de Educación.
              Con el LITERAL: <b class="linea_bottom"><?= $nota ?></b>
             


         </p>
     </div>

     <div class="linea_7">
         <p>
             Constancia que se expide de parte interesada en Tucaní, a los <b class="linea_bottom"><?=$dia ?></b> días del mes de <b class="linea_bottom"><?=$mes ?></b> de
             <b class="linea_bottom"><?= $año?></b>.
         </p>
     </div>

     <br><br><br><br><br>
     <div class="linea_8">
         <p>
         <div class="linea_firma"></div><br>
         Esp. Francisco Javier Ángel <br>
         C.I V- 14.530.553 <br>
         Director (E)

         </p>

     </div>
 </body>

 </html>

 <?php

  $html = ob_get_clean();
  
    require_once("../../dompdf/autoload.inc.php");

    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');

    $dompdf->render();

    $dompdf->stream('constancia de estudio.pdf');
    

    ?>

