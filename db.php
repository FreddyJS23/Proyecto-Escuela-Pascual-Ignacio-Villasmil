
<?php
   

 
   $conexion=@mysqli_connect("localhost","root","","sistema automatizado registro control de notas");
  
  
   if($conexion==false){

   echo "ocurrio un error" . mysqli_connect_error();
  }
  mysqli_set_charset($conexion,"UTF8");   

  session_start()
    ?>


