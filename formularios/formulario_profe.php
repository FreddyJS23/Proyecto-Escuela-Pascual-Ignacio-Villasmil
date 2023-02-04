<?php session_start();
if (isset($_SESSION['usuario'])&& $_SESSION['cargo']==1) {  ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include("../cuerpo/head.html") ?>
        <title>Formulario profesor</title>
    </head>

    <body>

        <?php include("../cuerpo/header.html") ?>






        <form action="../registros/registro_profe.php" method="post" id="formulario">


            <div class="contenedor_profesor">

                <div class="titulo_formulario">
                    <p><i class="fa-solid fa-people-group"></i>Datos del profesor</p>
                </div>

                <div class="campos_profesor">

                    <div class="container_campos">
                        <input class="input" type="text" name="ci_profe" id="ci_profe" placeholder=" " autocomplete="off" maxlength="8" required>
                        <label class="label" id="label_ci_profe" for="ci_profe">Cedula </label>


                    </div>

                    <div class="container_campos">
                        <input class="input" type="text" name="nombre_profe" id="nombre_profe" maxlength="30" placeholder=" " autocomplete="off" required>
                        <label class="label" id="label_nombre_profe" for="nombre_profe">Nombre completo </label>

                    </div>

                    <div class="container_campos">
                        <input class="input" type="text" name="apellido_profe" id="apellido_profe" maxlength="30" placeholder=" " autocomplete="off" required>
                        <label class="label" id="label_apellido_profe" for="apellido_profe">Apellido completo </label>

                    </div>

                    <div class="container_campos">
                        <input class="input" type="date" name="fn_profe" id="fn_profe">
                        <label class="label" for="fn_profe">Fecha_nacimiento </label>

                    </div>

                    <div class="container_campos">
                        <label class="label" for="sx_profe"></label>
                        <select class="select" name="sx_profe" id="sx_profe">
                            <option value="">Seleccione un genero</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>


                    <div class="container_campos">
                        <input class="input" type="tel" name="tlf_profe" id="tlf_profe" placeholder=" " autocomplete="off" maxlength="12" required pattern="[0-9]{4,4}-[0-9]{7,7}" title="Formato 0xxx-xxxxxxx">
                        <label class="label" id="label_tlf_profe" for="tlf_profe">Telefono contacto</label>





                    </div>
                    <div class="container_campos">
                        <input class="input" type="email" name="correo_profe" id="correo_profe" placeholder=" " required>
                        <label class="label" id="label_correo_profe" for="correo_profe">Correo electronico</label>

                    </div>

                    <div class="container_campos">
                        <label class="label_select" for="grado_instruccion">Grado de instruccion</label>
                        <select class="select" name="grado_instruccion" id="grado_instruccion">
                            <option value="">Seleccione grado de instruccion</option>
                            <option value="alto">Alto</option>
                            <option value="medio">Medio</option>
                            <option value="bajo">Bajo</option>
                        </select>
                    </div>



                    <div class="container_campos">
                        <label class="label_select" for="condicion_laboral">Condicion laboral</label>


                        <select class="select" name="condicion_laboral" id="condicion_laboral">
                            <option value="">Seleccione codincion laboral</option>
                            <option value="fijo">Fijo</option>
                            <option value="nofijo">No fijo</option>

                        </select>
                    </div>

                    <div class="campos_ubicacion">
                        <div class="contenedor_ubicacion">

                            <p class="titulo_ubicacion">Donde reside actualmente</p>
                        </div>




                        <div class="container_campos">

                            <label class="label_select" for="estado">Estado</label>

                            <select class="select" name="estado" id="estado">
                                <option value="0">Seleccione un estado</option>
                                <option value="0">Seleccione un estado</option>
                                <option value="1 ">Amazonas </option>
                                <option value="2 ">Anzoátegui </option>
                                <option value="3 ">Apure </option>
                                <option value="4 ">Aragua </option>
                                <option value="5 ">Barinas </option>
                                <option value="6 ">Bolívar </option>
                                <option value="7 ">Carabobo </option>
                                <option value="8 ">Cojedes </option>
                                <option value="9 ">Delta Amacuro </option>
                                <option value="10">Falcón </option>
                                <option value="11">Guárico </option>
                                <option value="12">Lara </option>
                                <option value="13">Mérida </option>
                                <option value="14">Miranda </option>
                                <option value="15">Monagas </option>
                                <option value="16">Nueva Esparta </option>
                                <option value="17">Portuguesa </option>
                                <option value="18">Sucre </option>
                                <option value="19">Táchira </option>
                                <option value="20">Trujillo </option>
                                <option value="21">La Guaira </option>
                                <option value="22">Yaracuy </option>
                                <option value="23">Zulia </option>
                                <option value="24">Distrito Capital </option>
                                <option value="25">Dependencias Federales</option>

                            </select>


                        </div>

                        <div class="container_campos">
                            <label class="label_select" for="estado">Municipio</label>
                            <select class="select" name="municipio" id="municipio" disabled>
                                <option value="0">Seleccione un municipio</option>

                            </select>


                        </div>


                        <div class="container_campos">
                            <label class="label_select" for="parroquia">Parrquia</label>
                            <select class="select" name="parroquia" id="parroquia" disabled>
                                <option value="0">Seleccione una parroquia</option>

                            </select>


                        </div>


                        <div class="container_campos">
                            <input class="input" type="text" name="sector" placeholder=" " autocomplete="off" id="sector" maxlength="30" required>
                            <label class="label espacio_sector" id="label_sector" for="sector">Sector</label>

                        </div>
                    </div>
                    <div class="contenedor_boton">

                        <input class="boton" type="submit" value="Registrar">
                    </div>
                </div>

            </div>



            <input type="hidden" id="inscripcion_profesor">


        </form>

        <?php include("../cuerpo/script.html") ?>
    </body>

    </html>

<?php } else {

    header("location:../index.html");
} ?>