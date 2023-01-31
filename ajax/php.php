<?php
include("../db.php");


/* -------------------------------- vairables ------------------------------- */
$id_periodo = @$_SESSION['id_periodo'];
$ci_profe = @$_SESSION['ci_profe'];

/* ------------------------------- ubicaciones ------------------------------ */
$estado = @$_GET['estado'];
$municipio = @$_GET['municipio'];
//ciudad
$estado_nacimiento = @$_GET['estado_nacimiento'];



/* ----------------------------------tabla notas --------------------------------- */
//solicitar notas para consulta
$ajax_notas = @$_GET['ajax_notas'];
//cedula a quien se le asignara nota
$ci_estu_nota = @$_GET['ci_estu_nota'];
//literal
$literario = @$_GET['literario'];



/* --------------------------------tabla secciones ------------------------------- */
//solicitar secciones para consulta
$ajax_seccion = @$_GET['ajax_seccion'];
//cedula a quien se asignara la seccion
$ci_estu_seccion = @$_GET['ci_estu_seccion'];
//seccion
$seccion = @$_GET['seccion'];

//secciones activas en el grado
$gradoSeccionesActivas = @$_GET['gradoSeccionesActivas'];

/* ---------------------------- tabla estudiante ---------------------------- */
//solicitar estudiantes
$ajax_estudiante = @$_GET['ajax_estudiante'];
/////referencia de estudiante para ventana modal
$ci_estu_editar = @$_GET['ci_estu_editar'];
////////referencia representanre para ventana modal
$ci_estu_repre = @$_GET['ci_estu_repre'];



/* ----------------------------- tabla profesor ----------------------------- */
//solicitar profeosr
$ajax_profe = @$_GET['ajax_profe'];




/* -- consulta profesores asignados y sin asginar en formulario asignacion -- */
//asignados
$ajax_asignacion_ayuda = @$_GET['devolverAsignados'];
//no asignados
$ajax_devolverProfeSinAsignar = @$_GET['devolverSinAsignar'];



/* ---------------------------- tabla asignacion ---------------------------- */
//solicitar asignacion
$ajax_asignaciones = @$_GET['ajax_asignacion'];




/* ------------------------- tabla principio periodo ------------------------ */
//solicitar principios de periodo
$ajax_principioPeriodo = @$_GET['ajax_principioPeriodo'];




/* ------------------------ tabla finales de periodo ------------------------ */
//solicitar finales de periodo
$ajax_finalPeriodoGrado = @$_GET['ajax_finalPeriodoGrado'];




/* -------------------------------- periodos -------------------------------- */
//solicitar periodo para comprar existencia,login
$ajax_periodo = @$_GET['ajax_periodo'];




/* ------------------------------ tabla usuario ----------------------------- */
//solicitas usuarios
$ajax_usuarios = @$_GET['ajax_usuarios'];



/* ---------- secciones dinamicas con grado en asginacion de profes --------- */
//solicita cuantas secciones activas tiene el grado
$id_gradoSeccionesActivas = @$_GET['secciones_activas'];

//solicitar secciones que estan ocupadas en el grado
$grado_seccionOcupada = @$_GET['grado'];


/* ----------------- grados disponibles para activar seccion ---------------- */
//solicita grados que no tengan secciones activas 
$grados_disponible = @$_GET['gradoDisponible'];



/* -------- consulta profes con y sin usuario para registrar usuario -------- */
//profe sin usuario
$ajax_profeNoUsuario = @$_GET['ajax_profeNoUsuario'];
//profe con usuario
$ajax_profeConUsuario = @$_GET['ajax_profeConUsuario'];


/* ------------- comprobar en el login si hay admin registrado en el sistema en  ------------ */
$comprobarAdmin = @$_GET['ajax_comprobarAdmin'];


/* -------------------------- solicitar municipios -------------------------- */
if (!empty($estado)) {

    //esquema aplica para municipio,parroquias,ciudades
    //consulta de municipios solo los que corresponda al estado
    //ejemplo $estado vale 3, consultara los municipios que tenga una id_estado de 3
    $select_municipio = "SELECT  `municipio`,id_municipio FROM `municipios` WHERE id_estado=$estado;";

    //ejecutar consulta
    $sql_municipio = mysqli_query($conexion, $select_municipio);
    //fecth_all traera todos los datos y hara un bucle por cada fila encontrada y las traera como un array asociativo
    //ejemplo de como vienen los datos ['municipio'=>'caracciolo parra y olmedo']

    $municipios = mysqli_fetch_all($sql_municipio, MYSQLI_ASSOC);
    //json_encode  tranforma el array asociativo de php a un array asociativo tipo json que leera js
    //ejemplo php:['municipio'=>'caracciolo parra y olmedo'] json:['municipio':'caracciolo parra y olmedo']
    //echo haran que se vea la respuesta del servidor

    echo json_encode($municipios);
}

/* -------------------------- solicitar parroquias -------------------------- */
if (!empty($municipio)) {

    $select_parroquia = "SELECT  `parroquia`,id_parroquia FROM `parroquias` WHERE id_municipio=$municipio;";

    $sql_parroquia = mysqli_query($conexion, $select_parroquia);

    $parroquias = mysqli_fetch_all($sql_parroquia, MYSQLI_ASSOC);

    echo json_encode($parroquias);
}

/* --------------------------- solicitar ciudades --------------------------- */
if (!empty($estado_nacimiento)) {

    $select_ciudad = "SELECT  `ciudad`,id_ciudad FROM `ciudades` WHERE id_estado=$estado_nacimiento;";

    $sql_ciudad = mysqli_query($conexion, $select_ciudad);

    $ciudades = mysqli_fetch_all($sql_ciudad, MYSQLI_ASSOC);

    echo json_encode($ciudades);
}

/* ------------------------------ tabla datos asignar nota------------------------------ */
if (!empty($ajax_notas)) {

    //esquema aplica para nota y asignar seccion
    //comprobar si se inicio sesion con vista a todos los periodos
    if ($_SESSION['id_periodo'] != "todos") {
        //consulta para filtras los estudiante a su correspodiente profesor
        //consulta a la tabla asignacion para traer los datos del profesor que tiene la sesion iniciada
        $filtro_estudiante = "SELECT  `id_periodo`, `id_grado`, `id_seccion` FROM `asignacion` WHERE ci_profe_asignacion=$ci_profe && id_periodo=$id_periodo";
        $sql = mysqli_query($conexion, $filtro_estudiante);
        $filtro = mysqli_fetch_array($sql);
        if($filtro){
         $id_grado = $filtro['id_grado'];
        $id_seccion = $filtro['id_seccion'];
       }else{
        exit;
       }
      

        //si se inicia sesion con un periodo normal tendra un where donde solo traiga los datos del periodo actual
        $select_notas = "SELECT  inscripcion.id_periodo, `periodo`, `grado`, `seccion`,ci_estu_inscripcion,nombre_estu,apellido_estu,nota FROM `inscripcion` 
        INNER JOIN periodo
        ON inscripcion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON inscripcion.id_grado=grado.id_grado
        INNER JOIN seccion
        ON inscripcion.id_seccion=seccion.id_seccion
        INNER JOIN estudiante
        ON inscripcion.ci_estu_inscripcion=estudiante.ci_estu 
        where nota is null && inscripcion.id_periodo=$id_periodo && inscripcion.id_seccion=$id_seccion && inscripcion.id_grado=$id_grado";
    }


    $sql_notas = mysqli_query($conexion, $select_notas);

    $notas = mysqli_fetch_all($sql_notas, MYSQLI_ASSOC);

    echo json_encode($notas);
}

/* ------------------------------ asignar nota ------------------------------ */
if (!empty($ci_estu_nota)) {
    //insertar la nota donde literario sera igual a lo que se halla recibdo del parametro axios
    //el where indicara a que estudiante se le asignara la nota
    $insertar_nota = "UPDATE `inscripcion` SET `nota`='$literario' WHERE ci_estu_inscripcion=$ci_estu_nota";

    $sql_nota = mysqli_query($conexion, $insertar_nota);
    //envia una respuesta en caso que se haya insertado la nota o haya ocurrido un error
    if ($sql_nota) {
        $resultado = ['resultado' => 'exito'];
        echo json_encode($resultado);
    } else {
        $resultado = ['resultado' => 'error'];
        echo json_encode($resultado);
    };
}

/* ----------------------- tabla datos asignar seccion ---------------------- */
if (!empty($ajax_seccion)) {

    if ($_SESSION['id_periodo'] == "todos" || $_SESSION['cargo'] == 1) {
        $select_secciones = "SELECT  `periodo`, `grado`,ci_estu_inscripcion,nombre_estu,apellido_estu FROM `inscripcion` 
        INNER JOIN periodo
        ON inscripcion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON inscripcion.id_grado=grado.id_grado
        INNER JOIN estudiante
        ON inscripcion.ci_estu_inscripcion=estudiante.ci_estu where id_seccion is null ;";
    } else {

        $select_secciones = "SELECT  `periodo`, `grado`,ci_estu_inscripcion,nombre_estu,apellido_estu FROM `inscripcion` 
        INNER JOIN periodo
        ON inscripcion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON inscripcion.id_grado=grado.id_grado
        INNER JOIN estudiante 
        ON inscripcion.ci_estu_inscripcion=estudiante.ci_estu where id_seccion is null && inscripcion.id_periodo=$id_periodo;";
    };


    $consulta_secciones = mysqli_query($conexion, $select_secciones);
    $gestion_secciones = mysqli_fetch_all($consulta_secciones, MYSQLI_ASSOC);


    echo json_encode($gestion_secciones);
}



/* ------- ver secciones activas en el grado de tabla asignar seccion ------- */
if (!empty($gradoSeccionesActivas)) {

    $selectSeccionesActivas = "SELECT `secciones_activas`, grado FROM `secciones_activas` 
    INNER JOIN grado ON secciones_activas.id_grado=grado.id_grado 
    WHERE id_periodo=$id_periodo  && grado='$gradoSeccionesActivas'";

    $sqlSeccionesActivas = mysqli_query($conexion, $selectSeccionesActivas);
    $resultado = mysqli_fetch_all($sqlSeccionesActivas, MYSQLI_ASSOC);

    echo json_encode($resultado);
}



/* ----------------------------- asignar seccion ---------------------------- */
if (!empty($ci_estu_seccion)) {

    $insertar_seccion = "UPDATE `inscripcion` SET `id_seccion`=$seccion WHERE ci_estu_inscripcion=$ci_estu_seccion";
    $sql_seccion = mysqli_query($conexion, $insertar_seccion);

    if ($sql_seccion) {
        $resultado = ['resultado' => 'exito'];
        echo json_encode($resultado);
    } else {
        $resultado = ['resultado' => 'error'];
        echo json_encode($resultado);
    };
}
/* -------------------------- solicitar estudiantes para consulta / constancias  ------------------------- */
if (!empty($ajax_estudiante)) {
    if ($_SESSION['id_periodo'] != "todos") {
        $consultar_estu = "SELECT `ci_estu`, `nombre_estu`, `apellido_estu`, `sx_estu`, `fn_estu`, `municipio` FROM `estudiante` INNER JOIN municipios
    ON estudiante.id_municipio=municipios.id_municipio
    INNER JOIN inscripcion
    ON estudiante.ci_estu=inscripcion.ci_estu_inscripcion WHERE id_periodo=$id_periodo";

        $sql = mysqli_query($conexion, $consultar_estu);
        $estudiante = mysqli_fetch_all($sql, MYSQLI_ASSOC);

        echo json_encode($estudiante);
    } else {
        $consultar_estu = "SELECT `ci_estu`, `nombre_estu`, `apellido_estu`, `sx_estu`, `fn_estu`, `municipio` FROM `estudiante` INNER JOIN municipios
    ON estudiante.id_municipio=municipios.id_municipio
    LEFT JOIN inscripcion
    ON estudiante.ci_estu=inscripcion.ci_estu_inscripcion 
    INNER JOIN periodo
    ON inscripcion.id_periodo=periodo.id_periodo WHERE periodo.status='OFF' ";

        $sql = mysqli_query($conexion, $consultar_estu);
        $estudiante = mysqli_fetch_all($sql, MYSQLI_ASSOC);

        echo json_encode($estudiante);
    }
}

/* ------------------solicitar datos del estudiante para ventana modal ----------------- */
if (!empty($ci_estu_editar)) {

    $select_estu = "SELECT `ci_estu`, `nombre_estu`, `apellido_estu`, `sx_estu`, `fn_estu`, `enfermedad`,`discapacidad`, `estado_econ`, `tlf_estu`, `estado`, `municipio`, `parroquia`, `sector`, `pais`, `ciudad` FROM `estudiante` 
    INNER JOIN salud
    ON estudiante.id_salud=salud.id_salud
    INNER JOIN economia
    ON estudiante.id_economia=economia.id_economia
    INNER JOIN estados
    ON estudiante.id_estado=estados.id_estado
    INNER JOIN municipios
    ON estudiante.id_municipio=municipios.id_municipio
    INNER JOIN parroquias
    ON estudiante.id_parroquia=parroquias.id_parroquia
    INNER JOIN pais
    ON estudiante.id_pais_nacimiento=pais.id_pais
    INNER JOIN ciudades
    ON estudiante.id_ciudad_nacimiento=ciudades.id_ciudad where ci_estu=$ci_estu_editar";

    $consultar_estu = mysqli_query($conexion, $select_estu);

    $estudiante = mysqli_fetch_all($consultar_estu, MYSQLI_ASSOC);
    //consulta solo estado de nacimiento
    $consultarEstadoNacimiento = "SELECT estudiante.id_estado_nacimiento, estado as estado_nacimiento FROM `estudiante` INNER JOIN estados ON estudiante.id_estado_nacimiento=estados.id_estado WHERE ci_estu=$ci_estu_editar";
    $obtenerEstadoNacimiento = mysqli_query($conexion, $consultarEstadoNacimiento);
    $estadoNacimiento = mysqli_fetch_all($obtenerEstadoNacimiento, MYSQLI_ASSOC);
    //juntar dos array en un array
   $estudiante=array_merge($estudiante,$estadoNacimiento);
   
    
    echo json_encode($estudiante);
   


    /* ----------------- datos del reprentante en ventana modal ----------------- */
}

if (!empty($ci_estu_repre)) {

    $select_parentesco = "SELECT   `ci_repre` FROM `parentesco` WHERE ci_estu=$ci_estu_repre  GROUP BY ci_estu=$ci_estu_repre";
    $consultar_parentesco = mysqli_query($conexion, $select_parentesco);
    $parentesco = mysqli_fetch_array($consultar_parentesco);
    $ci_repre = $parentesco['ci_repre'];

    $select_repre = "SELECT `ci_repre`, `nombre_repre`, `apellido_repre`, `fn_repre`, `sx_repre`, `tlf_repre`, `estado`, `municipio`, `parroquia`, `sector` FROM `representante`
    INNER JOIN estados
     ON representante.id_estado=estados.id_estado
    INNER JOIN municipios
    ON representante.id_municipio=municipios.id_municipio
    INNER JOIN parroquias
    ON representante.id_parroquia=parroquias.id_parroquia WHERE ci_repre=$ci_repre";

    $consultar_repre = mysqli_query($conexion, $select_repre);
    $repre = mysqli_fetch_all($consultar_repre, MYSQLI_ASSOC);



    echo json_encode($repre);
}
/* ------------------------ tabla de datos profesores ----------------------- */
if (!empty($ajax_profe)) {

    $consultar_profe = "SELECT `ci_profe`, `nombre_profe`, `apellido_profe`, `fn_profe`, `sx_profe`, `tlf_profe`,`correo_profe`, `grado_instruccion`, `condicion_laboral`,`status`,`estado`, `municipio`, `parroquia`, `sector` FROM `profesor`
    INNER JOIN estados
    ON profesor.id_estado=estados.id_estado
    INNER JOIN municipios
    ON profesor.id_municipio=municipios.id_municipio
    INNER JOIN parroquias
    ON profesor.id_parroquia=parroquias.id_parroquia";
    $sql = mysqli_query($conexion, $consultar_profe);
    $profesor = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    echo json_encode($profesor);
}
/* --------------------- consultar profes asignados para la ayuda en formulario asignacion-------------------- */
if (!empty($ajax_asignacion_ayuda)) {
    if ($_SESSION['id_periodo'] == "todos") {
        $consultar_asignacion = "SELECT  `ci_profe_asignacion`,nombre_profe,apellido_profe, `periodo`, `grado`, `seccion` FROM `asignacion` 
        INNER JOIN profesor
        ON asignacion.ci_profe_asignacion=profesor.ci_profe
        INNER JOIN periodo
        ON asignacion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON asignacion.id_grado=grado.id_grado
        INNER JOIN seccion
        ON asignacion.id_seccion=seccion.id_seccion";
    } else {

        $consultar_asignacion = "SELECT  `ci_profe_asignacion`,nombre_profe,apellido_profe, `periodo`, `grado`, `seccion` FROM `asignacion` 
        INNER JOIN profesor
        ON asignacion.ci_profe_asignacion=profesor.ci_profe
        INNER JOIN periodo
        ON asignacion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON asignacion.id_grado=grado.id_grado
        INNER JOIN seccion
        ON asignacion.id_seccion=seccion.id_seccion WHERE asignacion.id_periodo=$id_periodo && periodo.status='ON'";
    }
    $consulta_asignacion = mysqli_query($conexion, $consultar_asignacion);
    $asignacion = mysqli_fetch_all($consulta_asignacion, MYSQLI_ASSOC);

    echo json_encode($asignacion);
}
/* ------------------------------ devolver profesores no asignados------------------------------ */
if (!empty($ajax_devolverProfeSinAsignar)) {

    $consultar_profesores = "SELECT `ci_profe`,nombre_profe,apellido_profe FROM `profesor` ";

    $consulta_profesores = mysqli_query($conexion, $consultar_profesores);
    $profesores = mysqli_fetch_all($consulta_profesores, MYSQLI_ASSOC);
    //count devuelve la logintud de un array
    $cantidadProfesores = count($profesores);

    $consultar_asignaciones = "SELECT ci_profe_asignacion as ci_profe,nombre_profe,apellido_profe FROM `asignacion` 
    INNER JOIN profesor ON asignacion.ci_profe_asignacion=profesor.ci_profe 
    INNER JOIN periodo ON asignacion.id_periodo=periodo.id_periodo 
    WHERE asignacion.id_periodo=$id_periodo && periodo.status='ON' && profesor.status='ON'";

    $consulta_asignacion = mysqli_query($conexion, $consultar_asignaciones);
    $profesoresAsignados = mysqli_fetch_all($consulta_asignacion, MYSQLI_ASSOC);
    $cantidadProfesoresAsignados = count($profesoresAsignados);

    //inicializar array que contendra profesores sin asignar
    $profesoresSinAsignar = [];
    //bucle para leer profesores inscritos
    for ($i = 0; $i < $cantidadProfesores; $i++) {
        //identificador de profesor asignado
        $profeAsignado = false;
        //bucle para leer profesores asignados
        for ($j = 0; $j < $cantidadProfesoresAsignados; $j++) {
            //informar si un profesor ya esta asignado
            if ($profesores[$i] == $profesoresAsignados[$j]) {
                $profeAsignado = true;
            }
        }
        //añadir profesor no asignado
        if (!$profeAsignado) {
            array_push($profesoresSinAsignar, $profesores[$i]);
        }
    }



    echo json_encode($profesoresSinAsignar);


    //echo json_encode($noAsignados);
}
/* ------------------------- datos tabla asignaciones ------------------------- */
if (!empty($ajax_asignaciones)) {
    if ($_SESSION['id_periodo'] == "todos") {
        $consultar_asignacion = "SELECT  `ci_profe_asignacion`,nombre_profe,apellido_profe, `periodo`, `grado`, `seccion` FROM `asignacion` 
        INNER JOIN profesor
        ON asignacion.ci_profe_asignacion=profesor.ci_profe
        INNER JOIN periodo
        ON asignacion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON asignacion.id_grado=grado.id_grado
        INNER JOIN seccion
        ON asignacion.id_seccion=seccion.id_seccion";
    } else {

        $consultar_asignacion = "SELECT  `ci_profe_asignacion`,nombre_profe,apellido_profe, `periodo`, `grado`, `seccion` FROM `asignacion` 
        INNER JOIN profesor
        ON asignacion.ci_profe_asignacion=profesor.ci_profe
        INNER JOIN periodo
        ON asignacion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON asignacion.id_grado=grado.id_grado
        INNER JOIN seccion
        ON asignacion.id_seccion=seccion.id_seccion WHERE  asignacion.id_periodo=$id_periodo  ";
    }

    $consultar = mysqli_query($conexion, $consultar_asignacion);
    $asignaciones = mysqli_fetch_all($consultar);

    echo json_encode($asignaciones);
}

/* ---------------------- datos tabla finales de periodo ---------------------- */
if (!empty($ajax_finalPeriodoGrado)) {
    if ($_SESSION['id_periodo'] == "todos") {

        $consultar_finalPerido = "SELECT  `periodo`, `grado`, `seccion`,ci_estu_inscripcion,nombre_estu,apellido_estu,nota FROM `inscripcion` 
        INNER JOIN periodo
        ON inscripcion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON inscripcion.id_grado=grado.id_grado
        INNER JOIN seccion
        ON inscripcion.id_seccion=seccion.id_seccion
        INNER JOIN estudiante
        ON inscripcion.ci_estu_inscripcion=estudiante.ci_estu  WHERE periodo.status = 'OFF'";
    } else if ($_SESSION['cargo'] == 1) {

        if($ajax_finalPeriodoGrado != "todos"){ 
        $consultar_finalPerido = "SELECT  `periodo`, `grado`, `seccion`,ci_estu_inscripcion,nombre_estu,apellido_estu,nota FROM `inscripcion` 
        INNER JOIN periodo
        ON inscripcion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON inscripcion.id_grado=grado.id_grado
        INNER JOIN seccion
        ON inscripcion.id_seccion=seccion.id_seccion
        INNER JOIN estudiante
        ON inscripcion.ci_estu_inscripcion=estudiante.ci_estu 
        WHERE inscripcion.id_periodo=$id_periodo && inscripcion.id_grado=$ajax_finalPeriodoGrado";
     }else{ 
        $consultar_finalPerido = "SELECT  `periodo`, `grado`, `seccion`,ci_estu_inscripcion,nombre_estu,apellido_estu,nota FROM `inscripcion` 
        INNER JOIN periodo
        ON inscripcion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON inscripcion.id_grado=grado.id_grado
        INNER JOIN seccion
        ON inscripcion.id_seccion=seccion.id_seccion
        INNER JOIN estudiante
        ON inscripcion.ci_estu_inscripcion=estudiante.ci_estu 
        WHERE inscripcion.id_periodo=$id_periodo ";
     }


} else {


        $filtro_estudiante = "SELECT  `id_periodo`, `id_grado`, `id_seccion` FROM `asignacion` WHERE ci_profe_asignacion=$ci_profe && id_periodo=$id_periodo";
        $sql = mysqli_query($conexion, $filtro_estudiante);
        $filtro = mysqli_fetch_array($sql);
        if ($filtro) {
            $id_grado = $filtro['id_grado'];
            $id_seccion = $filtro['id_seccion'];
        } else {
            exit;
        }



        $consultar_finalPerido = "SELECT  `periodo`, `grado`, `seccion`,ci_estu_inscripcion,nombre_estu,apellido_estu,nota FROM `inscripcion` 
        INNER JOIN periodo
        ON inscripcion.id_periodo=periodo.id_periodo
        INNER JOIN grado
        ON inscripcion.id_grado=grado.id_grado
        INNER JOIN seccion
        ON inscripcion.id_seccion=seccion.id_seccion
        INNER JOIN estudiante
        ON inscripcion.ci_estu_inscripcion=estudiante.ci_estu 
        WHERE inscripcion.id_periodo=$id_periodo && inscripcion.id_seccion=$id_seccion && inscripcion.id_grado=$id_grado  ";
    }

    $consultar = mysqli_query($conexion, $consultar_finalPerido);

    $finalPeriodo = mysqli_fetch_all($consultar);

    echo json_encode($finalPeriodo);
}

/* -------------------------- datos tabla usuarios -------------------------- */
if (!empty($ajax_usuarios)) {

    $consulta_usuarios = "SELECT `usuario`, `nombre`, `apellido`,ci_profe FROM `usuario` ";

    $sql = mysqli_query($conexion, $consulta_usuarios);

    $usuarios = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    echo json_encode($usuarios);
}


/* ------------------ lista de periodos en el select del  login ----------------- */
if (!empty($ajax_periodo)) {
    $select_periodo = "SELECT `id_periodo`, `periodo` FROM `periodo` WHERE status='ON'";
    $sql_periodo = mysqli_query($conexion, $select_periodo);
    $periodos = mysqli_fetch_all($sql_periodo, MYSQLI_ASSOC);

    echo json_encode($periodos);
}



/* ----------- consulta para ayuda de profesores con y sin usuarios ---------- */
if (!empty($ajax_profeNoUsuario)) {

    $select_profeNoUsuario = "SELECT  profesor.ci_profe,id_usuario, nombre_profe,apellido_profe FROM `usuario` RIGHT JOIN profesor
    ON usuario.ci_profe=profesor.ci_profe WHERE id_usuario is null;";

    $sql = mysqli_query($conexion, $select_profeNoUsuario);
    $profeNousuario = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    echo json_encode($profeNousuario);
}
//sin usuarios
if (!empty($ajax_profeConUsuario)) {

    $select_profeConUsuario = "SELECT   `nombre`, `apellido`, `ci_profe` FROM `usuario` where id_usuario!=1";
    $consultar = mysqli_query($conexion, $select_profeConUsuario);
    $profeConUsuario = mysqli_fetch_all($consultar, MYSQLI_ASSOC);

    echo json_encode($profeConUsuario);
}


/* ------------- consultar cuantas secciones activas tiene un grado------------- */
if (!empty($id_gradoSeccionesActivas)) {

    $select_grados_Secciones_activas = "SELECT  secciones_activas FROM `secciones_activas` 
     WHERE id_periodo=$id_periodo && id_grado=$id_gradoSeccionesActivas";
    $sql = mysqli_query($conexion, $select_grados_Secciones_activas);

    $convertir = mysqli_fetch_array($sql);

    $seccionesActivas = ['seccionesActivas' => $convertir[0]];
}


/* ------------- consultar secciones disponible para el grado ------------- */
if (!empty($grado_seccionOcupada) || !empty($seccionesActivas)) {

    $select_grados_conSecciones_ocupada = "SELECT   asignacion.id_seccion, seccion FROM `asignacion` 
  INNER JOIN seccion
  ON asignacion.id_seccion=seccion.id_seccion WHERE id_periodo=$id_periodo && id_grado=$grado_seccionOcupada";
    $sql = mysqli_query($conexion, $select_grados_conSecciones_ocupada);

    $seccionesDisponibles = mysqli_fetch_all($sql, MYSQLI_ASSOC);
    //juntar los dos array en una respuesta final
    $resultado = array_merge($seccionesDisponibles, $seccionesActivas);

    echo json_encode($resultado);
}


/* ----------------- consultar grados con secciones activas ----------------- */
if (!empty($grados_disponible)) {

    $select_grados_conSecciones_activas = "SELECT  secciones_activas.id_grado,grado  FROM `secciones_activas` 
    INNER JOIN grado
    ON secciones_activas.id_grado=grado.id_grado WHERE id_periodo=$id_periodo";
    $sql = mysqli_query($conexion, $select_grados_conSecciones_activas);

    $resultado = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    echo json_encode($resultado);
}


/* ----------------- comprobar si un admin esta registrado ----------------- */
if (!empty($comprobarAdmin)) {

    $sql = "SELECT  `id_cargo`  FROM `usuario` WHERE id_cargo=1;";
    $consultar = mysqli_query($conexion, $sql);
    $admin = mysqli_num_rows($consultar);

    if ($admin >= 1) {
        $resultado = ['resultado' => 'adminExiste'];
        echo json_encode($resultado);
    } else {

        $resultado = ['resultado' => 'adminNoExiste'];
        echo json_encode($resultado);
    }
}
