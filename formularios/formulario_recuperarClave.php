<?php
if($_POST){
   include("../db.php");
   $usuario=$_POST['usuario'];
   $pregunta_secreta1=$_POST['pregunta_secreta1'];
   $pregunta_secreta2=$_POST['pregunta_secreta2'];
   $pregunta_secreta3=$_POST['pregunta_secreta3'];

$comprobarPreguntas="SELECT  `usuario` FROM `usuario` 
WHERE pregunta_secreta1='$pregunta_secreta1' && pregunta_secreta2='$pregunta_secreta2' && pregunta_secreta3='$pregunta_secreta3' && usuario='$usuario'";
$sql=mysqli_query($conexion,$comprobarPreguntas);

if(mysqli_num_rows($sql) == 1){ 
session_destroy();

session_start();
$_SESSION['usuario']=$usuario;

header("location:../formularios/formulario_restablecerClave.php?id=$usuario");


}


}

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
  
<form action="./formulario_recuperarClave.php"  method="post" id="formulario">

        <div class="container contenedor_usuario">

            <div class="titulo_formulario">
                <p>Restablecer contraseña</p>
            </div>


            <div class="container_campos">

                <input class="input" type="text" name="usuario" id="usuario" placeholder=" " autocomplete="off" required
                    maxlength="20">
                <label class="label" id="label_usuario" for="usuario">Nombre de usuario</label>


            </div>
            <div class="container_campos">

                <input class="input" type="text" name="pregunta_secreta1" id="pregunta_secreta1" placeholder=" "
                    autocomplete="off" required maxlength="20">
                <label class="label" id="label_pregunta_secreta1" for="pregunta_secreta1">Comida favorita</label>


            </div>
            <div class="container_campos">

                <input class="input" type="text" name="pregunta_secreta2" id="pregunta_secreta2" placeholder=" "
                    autocomplete="off" required maxlength="20">
                <label class="label" id="label_pregunta_secreta2" for="pregunta_secreta2">Animal favorito</label>


            </div>
            <div class="container_campos">

                <input class="input" type="text" name="pregunta_secreta3" id="pregunta_secreta3" placeholder=" "
                    autocomplete="off" required maxlength="20">
                <label class="label" id="label_pregunta_secreta3" for="pregunta_secreta3">Color favorito</label>



                <div class="contenedor_boton">

                    <input class="boton" type="submit" value="Enviar">
                </div>

            </div>



        </div>

        </div>

        <input type="hidden" id="formulario_constanciaEstudio">

    </form>
<script src="../js/sweetalert2.all.min.js"></script>
<script>
    
    let pregunta_secreta1=document.getElementById("pregunta_secreta1")
    let pregunta_secreta2=document.getElementById("pregunta_secreta2")
    let pregunta_secreta3=document.getElementById("pregunta_secreta3")
    let mayuscula = (e) => {

//para que no ponga la primera mayusucla de las contraseñas
if (e.target.id == "usuario") {

}
else if (e.target.value.length == 1)
    e.target.value = e.target.value[0].toUpperCase()


}
pregunta_secreta1.addEventListener("keypress", mayuscula)
pregunta_secreta2.addEventListener("keypress", mayuscula)
pregunta_secreta3.addEventListener("keypress", mayuscula)
</script>
</body>

</html>