<?php
include("../db.php");

$referencia = $_GET['id'];

$consulta_usuario = "SELECT `usuario`, `nombre`, `apellido`,pass FROM `usuario` where usuario='$referencia' ";
$ejecutar_consulta_usuario = mysqli_query($conexion, $consulta_usuario);

$row = mysqli_fetch_array($ejecutar_consulta_usuario);

if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == $referencia || $_SESSION['cargo'] == 1) {


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Formulario usuario</title>
    </head>

    <body>

        <?php

        include("../cuerpo/header.html")

        ?>

        <form action="../editar/editar_usuario.php" method="post" id="formulario">

            <input type="hidden" name="referencia" value="<?php echo $referencia ?>">
            <div class="container contenedor_usuario">
                <div class="titulo_formulario">
                    <p><i class="fa-solid fa-user-plus"></i>Editar usuario</p>
                </div>
                <div class="campos_usuarios">

                    <div class="container_campos">
                        <input class="input" type="text" name="nombre" id="nombre" placeholder=" " autocomplete="off" required maxlength="15" value="<?php echo $row['nombre'] ?>">
                        <label class="label" id="label_nombre" for="nombre">Nombre</label>


                    </div>


                    <div class="container_campos">
                        <input class="input" type="text" name="apellido" id="apellido" placeholder=" " autocomplete="off" required maxlength="15" value="<?php echo $row['apellido'] ?>">
                        <label class="label" id="label_apellido" for="apellido">Apellido</label>


                    </div>



                    <div class="container_campos">

                        <input class="input" type="text" name="usuario" id="usuario" placeholder=" " autocomplete="off" required maxlength="20" value="<?php echo $row['usuario'] ?>">
                        <label class="label" id="label_usuario" for="usuario">Nombre de usuario</label>


                    </div>
                    <div class="container_campos">

                        <input class="input" type="text" name="pregunta_secreta1" id="pregunta_secreta1" placeholder=" " autocomplete="off" required maxlength="20">
                        <label class="label" id="label_pregunta_secreta1" for="pregunta_secreta1">Comida favorita</label>


                    </div>
                    <div class="container_campos">

                        <input class="input" type="text" name="pregunta_secreta2" id="pregunta_secreta2" placeholder=" " autocomplete="off" required maxlength="20">
                        <label class="label" id="label_pregunta_secreta2" for="pregunta_secreta2">Animal favorito</label>


                    </div>
                    <div class="container_campos">

                        <input class="input" type="text" name="pregunta_secreta3" id="pregunta_secreta3" placeholder=" " autocomplete="off" required maxlength="20">
                        <label class="label" id="label_pregunta_secreta3" for="pregunta_secreta3">Color favorito</label>


                        <div class="container_campos">
                            <input class="input" type="password" name="password" id="password" placeholder=" " autocomplete="off" required maxlength="15">
                            <label class="label" id="label_password" for="password">Contraseña </label>
                            <div><i class="fa-solid fa-eye-slash" id="pass"></i></div>

                        </div>

                        <div class="container_campos">
                            <input class="input" type="password" name="password2" id="password2" placeholder=" " autocomplete="off" required maxlength="15">
                            <label class="label" id="label_password2" for="password2">Repetir Contraseña</label>

                            <div class="contenedor_boton">


                                <input class="boton" type="submit" value="Editar">
                            </div>

                        </div>






                    </div>

                </div>

                <input type="hidden" id="formulario_editarUsuario">
        </form>

        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>
<?php } else {

    header("location:../cerrar sesion.php");
} ?>