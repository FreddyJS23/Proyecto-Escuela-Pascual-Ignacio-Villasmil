<?php
include("../db.php");
$id_periodo=$_SESSION['id_periodo'];
$dataGraficos=[];

//total profes
$consultarTotalProfes="SELECT COUNT(*) AS total_profes FROM `profesor` ";
$consultarTotalProfes=mysqli_query($conexion,$consultarTotalProfes);
$totalProfes=mysqli_fetch_all($consultarTotalProfes,MYSQLI_ASSOC);
array_push($dataGraficos,$totalProfes[0]);
//profes activos
$consultarProfeActivos="SELECT COUNT(*) AS total_activos FROM `profesor`  WHERE profesor.status='ON'";
$consultarProfeActivos=mysqli_query($conexion,$consultarProfeActivos);
$profesActivos=mysqli_fetch_all($consultarProfeActivos,MYSQLI_ASSOC);
array_push($dataGraficos,$profesActivos[0]);
//profes inactivos
$consultarProfeInactivos="SELECT COUNT(*) AS total_inactivos FROM `profesor`  WHERE profesor.status='OFF'";
$consultarProfeInactivos=mysqli_query($conexion,$consultarProfeInactivos);
$profesInactivos=mysqli_fetch_all($consultarProfeInactivos,MYSQLI_ASSOC);
array_push($dataGraficos,$profesInactivos[0]);


if($id_periodo != "todos"){ 
//total estudiantes
$consultarTotalEstu = "SELECT COUNT(*) AS total_estudiantes FROM estudiante INNER JOIN inscripcion ON estudiante.ci_estu=inscripcion.ci_estu_inscripcion WHERE id_periodo=$id_periodo";
$consultaTotalEstu = mysqli_query($conexion, $consultarTotalEstu);
$totalEstudiante = mysqli_fetch_all($consultaTotalEstu,MYSQLI_ASSOC);
array_push($dataGraficos,$totalEstudiante[0]);
//estudiante maculinos
$consultarEstudianteMasculino = "SELECT COUNT(*) AS estudiantes_masculinos FROM estudiante INNER JOIN inscripcion ON estudiante.ci_estu=inscripcion.ci_estu_inscripcion WHERE id_periodo=$id_periodo && sx_estu= 'M'";
$consultaEstudianteMasculino = mysqli_query($conexion, $consultarEstudianteMasculino);
$estudianteMasculino = mysqli_fetch_all($consultaEstudianteMasculino,MYSQLI_ASSOC);
array_push($dataGraficos,$estudianteMasculino[0]);
//estudiante femeninos
$consultarEstudianteFemenino = "SELECT COUNT(*) AS estudiantes_femeninos FROM estudiante INNER JOIN inscripcion ON estudiante.ci_estu=inscripcion.ci_estu_inscripcion WHERE id_periodo=$id_periodo && sx_estu= 'F'";
$consultaEstudianteFemenino = mysqli_query($conexion, $consultarEstudianteFemenino);
$estudianteFemenino = mysqli_fetch_all($consultaEstudianteFemenino,MYSQLI_ASSOC);
array_push($dataGraficos,$estudianteFemenino[0]);

//estudiantes por grados
//primero
$consultarPrimero="SELECT COUNT(*) AS total_primero FROM `inscripcion` WHERE id_grado=1 && id_periodo=$id_periodo";
$consultaPrimero=mysqli_query($conexion,$consultarPrimero);
$totalPrimero=mysqli_fetch_all($consultaPrimero,MYSQLI_ASSOC);
array_push($dataGraficos,$totalPrimero[0]);
//segundo
$consultarSegundo="SELECT COUNT(*) AS total_segundo FROM `inscripcion` WHERE id_grado=2 && id_periodo=$id_periodo";
$consultaSegundo=mysqli_query($conexion,$consultarSegundo);
$totalSegundo=mysqli_fetch_all($consultaSegundo,MYSQLI_ASSOC);
array_push($dataGraficos,$totalSegundo[0]);
//tercero
$consultarTercero="SELECT COUNT(*) AS total_tercero FROM `inscripcion` WHERE id_grado=3 && id_periodo=$id_periodo";
$consultaTercero=mysqli_query($conexion,$consultarTercero);
$totalTercero=mysqli_fetch_all($consultaTercero,MYSQLI_ASSOC);
array_push($dataGraficos,$totalTercero[0]);
//cuarto
$consultarCuarto="SELECT COUNT(*) AS total_cuarto FROM `inscripcion` WHERE id_grado=4 && id_periodo=$id_periodo";
$consultaCuarto=mysqli_query($conexion,$consultarCuarto);
$totalCuarto=mysqli_fetch_all($consultaCuarto,MYSQLI_ASSOC);
array_push($dataGraficos,$totalCuarto[0]);
//quinto
$consultarQuinto="SELECT COUNT(*) AS total_quinto FROM `inscripcion` WHERE id_grado=5 && id_periodo=$id_periodo";
$consultaQuinto=mysqli_query($conexion,$consultarQuinto);
$totalQuinto=mysqli_fetch_all($consultaQuinto,MYSQLI_ASSOC);
array_push($dataGraficos,$totalQuinto[0]);
//sexto
$consultarSexto="SELECT COUNT(*) AS total_sexto FROM `inscripcion` WHERE id_grado=6 && id_periodo=$id_periodo";
$consultaSexto=mysqli_query($conexion,$consultarSexto);
$totalSexto=mysqli_fetch_all($consultaSexto,MYSQLI_ASSOC);
array_push($dataGraficos,$totalSexto[0]);
 

        /* ------------------------ vista todos los periodos ------------------------ */
}else{ 
//total estudiantes
$consultarTotalEstu = "SELECT COUNT(*) AS total_estudiantes FROM estudiante INNER JOIN inscripcion ON estudiante.ci_estu=inscripcion.ci_estu_inscripcion ";
$consultaTotalEstu = mysqli_query($conexion, $consultarTotalEstu);
$totalEstudiante = mysqli_fetch_all($consultaTotalEstu,MYSQLI_ASSOC);
array_push($dataGraficos,$totalEstudiante[0]);
//estudiante maculinos
$consultarEstudianteMasculino = "SELECT COUNT(*) AS estudiantes_masculinos FROM estudiante INNER JOIN inscripcion ON estudiante.ci_estu=inscripcion.ci_estu_inscripcion WHERE  sx_estu= 'M'";
$consultaEstudianteMasculino = mysqli_query($conexion, $consultarEstudianteMasculino);
$estudianteMasculino = mysqli_fetch_all($consultaEstudianteMasculino,MYSQLI_ASSOC);
array_push($dataGraficos,$estudianteMasculino[0]);
//estudiante femeninos
$consultarEstudianteFemenino = "SELECT COUNT(*) AS estudiantes_femeninos FROM estudiante INNER JOIN inscripcion ON estudiante.ci_estu=inscripcion.ci_estu_inscripcion WHERE  sx_estu= 'F'";
$consultaEstudianteFemenino = mysqli_query($conexion, $consultarEstudianteFemenino);
$estudianteFemenino = mysqli_fetch_all($consultaEstudianteFemenino,MYSQLI_ASSOC);
array_push($dataGraficos,$estudianteFemenino[0]);

//estudiantes por grados
//primero
$consultarPrimero="SELECT COUNT(*) AS total_primero FROM `inscripcion` WHERE id_grado=1 ";
$consultaPrimero=mysqli_query($conexion,$consultarPrimero);
$totalPrimero=mysqli_fetch_all($consultaPrimero,MYSQLI_ASSOC);
array_push($dataGraficos,$totalPrimero[0]);
//segundo
$consultarSegundo="SELECT COUNT(*) AS total_segundo FROM `inscripcion` WHERE id_grado=2 ";
$consultaSegundo=mysqli_query($conexion,$consultarSegundo);
$totalSegundo=mysqli_fetch_all($consultaSegundo,MYSQLI_ASSOC);
array_push($dataGraficos,$totalSegundo[0]);
//tercero
$consultarTercero="SELECT COUNT(*) AS total_tercero FROM `inscripcion` WHERE id_grado=3 ";
$consultaTercero=mysqli_query($conexion,$consultarTercero);
$totalTercero=mysqli_fetch_all($consultaTercero,MYSQLI_ASSOC);
array_push($dataGraficos,$totalTercero[0]);
//cuarto
$consultarCuarto="SELECT COUNT(*) AS total_cuarto FROM `inscripcion` WHERE id_grado=4 ";
$consultaCuarto=mysqli_query($conexion,$consultarCuarto);
$totalCuarto=mysqli_fetch_all($consultaCuarto,MYSQLI_ASSOC);
array_push($dataGraficos,$totalCuarto[0]);
//quinto
$consultarQuinto="SELECT COUNT(*) AS total_quinto FROM `inscripcion` WHERE id_grado=5 ";
$consultaQuinto=mysqli_query($conexion,$consultarQuinto);
$totalQuinto=mysqli_fetch_all($consultaQuinto,MYSQLI_ASSOC);
array_push($dataGraficos,$totalQuinto[0]);
//sexto
$consultarSexto="SELECT COUNT(*) AS total_sexto FROM `inscripcion` WHERE id_grado=6 ";
$consultaSexto=mysqli_query($conexion,$consultarSexto);
$totalSexto=mysqli_fetch_all($consultaSexto,MYSQLI_ASSOC);
array_push($dataGraficos,$totalSexto[0]);
 }




 echo json_encode($dataGraficos)

?>