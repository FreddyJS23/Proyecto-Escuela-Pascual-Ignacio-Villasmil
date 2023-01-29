<?php 
include("../db.php");
$registrar_admin=$_GET['id'];

if ($registrar_admin) {  ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Formulario administrador</title>
    </head>

    <body>

        <?php

      

        ?>

        <form action="" method="post" id="formulario">

            <div class="contenedor_usuario container">
                <div class="titulo_formulario">
                    <p><i class="fa-solid fa-user-plus"></i>Registrar administrador</p>
                </div>
                <div class="campos_usuarios">

                    <div class="container_campos">
                    <input class="input" type="text" name="nombre" id="nombre" placeholder=" " autocomplete="off" required maxlength="15">
                    <label class="label" id="label_nombre" for="nombre">Nombre</label>


                </div>
                    <div class="container_campos">
                        <input class="input" type="text" name="ci_profe" id="ci_profe" placeholder=" " autocomplete="off" required maxlength="8">
                        <label class="label" id="label_ci_profe" for="ci_profe">Cedula</label>


                    </div>

                    
                <div class="container_campos">
                    <input class="input" type="text" name="apellido" id="apellido" placeholder=" " autocomplete="off" required maxlength="15">
                    <label class="label" id="label_apellido" for="apellido">Apellido</label>


                </div>



                    <div class="container_campos">

                        <input class="input" type="text" name="usuario" id="usuario" placeholder=" " autocomplete="off" required maxlength="20">
                        <label class="label" id="label_usuario" for="usuario">Nombre de administrador</label>


                    </div>

                    <div class="container_campos">
                        <input class="input" type="password" name="password" id="password" placeholder=" " autocomplete="off" required maxlength="15">
                        <label class="label" id="label_password" for="password">Contraseña </label>
                        <div><i class="fa-solid fa-eye-slash" id="pass"></i></div>

                    </div>

                    <div class="container_campos">
                        <input class="input" type="password" name="password2" id="password2" placeholder=" " autocomplete="off" required maxlength="15">
                        <label class="label" id="label_password2" for="password2">Repetir Contraseña</label>

                        <div class="contenedor_boton">

                            <input class="boton" type="submit" value="Registrar">
                        </div>

                    </div>






                </div>

            </div>

            <input type="hidden" id="formulario_administrador">
        </form>
      
        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>