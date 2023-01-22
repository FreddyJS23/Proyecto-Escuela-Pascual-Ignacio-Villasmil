# Proyecto Escuela Pascual Ignacio Villasmil
Sistema automatizado de registrol control de notas
# Funciones


* Sistema de login con apertura de periodos

* Inscripcion de estudiantes junto con su representante

* Inscripcion de Profesores

* Asignacion de secciones y grado a los profesores

* Los profesores tienen su propio usuario

* Consulta de estudiante y su represetante 

* Consulta de profesores

* Consulta de usuarios

* Backup y restore de bd

* Emision de reporte Constancia/Certificado

* Cierre de periodo

* Vista visualizando todos los periodos

## Backup/Restore de bd

Para usar esta funcionalidad necesita tener mysql en variable de entorno, para eso hacer lo siguente


* Equipo -> Propiedades del sistema -> Configuracion avanzada del sistema -> Variables de entorno
* Buscar path en variables de sistema -> Editar
* Agregar ruta de instalacion de mysqli\bin junto con un ";"
* Ejemplo: C:\wamp64\bin\mysql\mysql5.7.36\bin; 
