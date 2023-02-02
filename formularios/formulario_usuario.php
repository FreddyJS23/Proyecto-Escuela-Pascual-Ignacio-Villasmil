<?php
include("../db.php");
if (isset($_SESSION['usuario']) && $_SESSION['cargo'] == 1) {  ?>
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

        <form action="../registros/registro_usuario.php" method="post" id="formulario">

            <div class="container contenedor_usuario contenedor_usuario_formulario">
                <div class="titulo_formulario">
                    <p><i class="fa-solid fa-user-plus"></i>Registro de usuarios</p>
                </div>
                <div class="campos_usuarios">


                    <div class="container_campos">
                        <input class="input" type="text" name="ci_profe" id="ci_profe" placeholder=" " autocomplete="off" required maxlength="8">
                        <label class="label" id="label_ci_profe" for="ci_profe">Cedula del profesor</label>


                    </div>





                    <div class="container_campos">

                        <input class="input" type="text" name="usuario" id="usuario" placeholder=" " autocomplete="off" required maxlength="20">
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

                                <input class="boton" type="submit" value="Registrar">
                            </div>

                        </div>






                    </div>

                </div>

                <input type="hidden" id="formulario_usuario">
        </form>

        <div class="ayuda_profe usuario">



            <div class="container_ayuda_selector">

                <div class="titulo_formulario">
                    <p>Profesores sin usuario</p>
                </div>



                <select name="" id="profeNoUsuario" autofocus>
                    <option value="">Lista de profesores</option>

                </select>

            </div>


            <div class="container_asignados">
                <div class="titulo_formulario">
                    <p>Profesores con un usuario</p>
                </div>

                <select name="" id="profeConUsuario" autofocus>
                    <option value="">Lista de profesores</option>

                    <option value=""></option>


                </select>

            </div>



        </div>
        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>