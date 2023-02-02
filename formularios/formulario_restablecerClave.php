<?php 
session_start();

$usuario=$_GET['id'];

if($_SESSION['usuario']==$usuario){
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.1-web/css/all.css">
    <title>Recuperar contraseña</title>
</head>

<body>
  
<form action="../registros/registro_clave.php"  method="post" id="formRestablecerClave">

        <div class="container contenedor_usuario">

            <div class="titulo_formulario">
                <p>Restablecer contraseña</p>
            </div>

            <div class="container_campos">
                        <input class="input" type="password" name="password" id="password" placeholder=" " autocomplete="off" required maxlength="15">
                        <label class="label" id="label_password" for="password">Contraseña </label>
                        <div><i class="fa-solid fa-eye-slash" id="pass"></i></div>

                    </div>

                  
          


                <div class="contenedor_boton">

                    <input class="boton" type="submit" value="Cambiar clave">
                </div>

            



        </div>

        </div>

        <input type="hidden" id="formulario_constanciaEstudio">

    </form>

<script src="../js//formulario.js"></script>
</body>

</html>


<?php  } else{  header("location:../index.html");  } ?>