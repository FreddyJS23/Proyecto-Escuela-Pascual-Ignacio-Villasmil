/* -------------------------------- variables ------------------------------- */





//ruta de las consultas
let url = "../ajax/php.php";

/* --------------- selects de estados municipios y parroquias --------------- */
//representantes
let select_estado_repre = document.getElementById("estado_repre");
let select_municipio_repre = document.getElementById("municipio_repre");
let select_parroquia_repre = document.getElementById("parroquia_repre");
//estudiantes
let select_estado_estu = document.getElementById("estado_estu");
let select_municipio_estu = document.getElementById("municipio_estu");
let select_parroquia_estu = document.getElementById("parroquia_estu");
let select_estado_nacimiento_estu = document.getElementById("estado_nacimiento_estu");
let select_ciudad = document.getElementById("ciudad");
//prfesores
let select_estado_profe = document.getElementById("estado");
let select_municipio_profe = document.getElementById("municipio");
let select_parroquia_profe = document.getElementById("parroquia");



/* ----------- contenedores padres de las tablas de las consultas ----------- */

//asginar notas
let divNota = document.querySelector(".nota");

//asginar secciones
let divSeccion = document.querySelector(".seccion");

//consultar estudiantes
let divEstudiante = document.querySelector(".estudiante");

//consultar estudiantes para reportes
let divEstudianteReporte = document.querySelector(".estudiante-reporte");

//consultar profesores
let divProfe = document.querySelector(".profesor");

//consultar asginaciones
let divAsignaciones = document.querySelector(".asignaciones");

//principio de periodo
let divPrincipioPeriodo = document.querySelector(".principio_periodo");

//finales de periodo
let divFinalPeriodo = document.querySelector(".final_periodo");

//consultar usuarios
let divUsuarios = document.querySelector(".container_usuarios");



/* ---------------------- botones y selects especiales ---------------------- */
//boton en el login para crear periodo
let crearPeriodo = document.getElementById("crearPeriodo");

//control para evitar inscripciones en caso de vista de todos los periodos
let fieldset = document.querySelector(".fieldset");

//boton li en el header para cerrar periodo
let cerrarPeriodo = document.getElementById("cerrar-periodo");


//ayudas para ver profesores con y sin usuarios al registrar usuarios
let profeNoUsuario = document.getElementById("profeNoUsuario");
let profeConUsuario = document.getElementById("profeConUsuario");

//ayuda para ve los profesores asignados y no asignados al registrar asignaciones
let asignados = document.getElementById("asignados")
let noAsignados = document.getElementById("no-asignados")

//ver grados con secciones inactivas 
let activar_secciones = document.getElementById("activar_secciones")

//ver secciones disponibles en los  grados
let grado = document.getElementById("grado")
let selectSeccionesDisponibles = document.getElementById("seccionDisponible")

//crear y restaurar base de datos
let crearDb = document.getElementById("crearDb")
let restaurarDb = document.getElementById("restaurarDb")

/* ------------------ colores de las alertas ----------------- */
let fondo = 'rgb(240, 240, 240)';
let color_boton = 'rgb(50, 33, 218)';
let color_botonCancelar = '#d33'
let icono_pregunta = 'rgb(135, 206, 250)';
let icono_confirmar = 'rgb(173, 255, 47)';


/* ----------------- configuraciones de las tablas de las consultas---------------- */
//idioma

let espanol = {
  search: {
    placeholder: 'Buscar...',
  },
  sort: {
    sortAsc: 'Ordenar columna ascendente',
    sortDesc: 'Ordenar columna descendente',
  },
  pagination: {
    previous: 'Anterior',
    next: 'Siguente',
    navigate: (page, pages) => `Pagina ${page} de ${pages}`,
    page: (page) => `Pagina ${page}`,
    showing: 'Mostrando',
    of: 'de',
    to: 'a',
    results: 'resultado',
  },
  loading: 'Cargando...',
  noRecordsFound: 'No se encontraron registros coincidentes',
  error: 'Ocurrió un error al obtener los datos'
};


//esquema de colores
let diseno = {
  table: {

    width: '100%'
  },
  th: {
    background: 'rgb(50, 33, 218) ',
    border: 'none',
    color: 'white',
    'text-shadow': " 0px 0px 4px black",
    'text-align': 'center',
    'font-weight': '800',
    'font-size': 'large',
  },
  td: {
    border: 'none',
    'border-bottom': '1px solid transparent',
    'text-align': 'center',
    'font-weight': '600',
    'font-size': 'large',
    background: 'rgb(240, 248, 255)',

  },

  footer: {
    background: 'rgb(240, 248, 255)'
  },

};
//poner clases a los tr para hover
let hover = {
  tr: 'grid-tr',
  td: 'grid-td',

};

//metodo import estaticio(importa todo del modulo)
//import { obtenerMunicipios,obtenerParroquias,obtenerCiudad } from "./Estados_Municipios_Parroquias.js";

/* ---------------------------- control de vistas --------------------------- */

//identificar cuando se este en la ventana correspondiente

/* ------ condicion para evitar errores en sus formularios individuales ----- */
if (select_estado_repre != undefined || select_estado_estu != undefined) {

  if (select_estado_estu != undefined && select_estado_repre != undefined) {

    //import dinamico (importa los modulo en caso que se solicite)
    import("./modulos/Estados_Municipios_Parroquias.js").then(module => {

      select_estado_estu.addEventListener("change", () => module.obtenerMunicipios(select_estado_estu, select_municipio_estu, url));
      select_municipio_estu.addEventListener("change", () => module.obtenerParroquias(select_municipio_estu, select_parroquia_estu, url));
      select_estado_nacimiento_estu.addEventListener("change", () => module.obtenerCiudad(select_estado_nacimiento_estu, select_ciudad, url));

      select_estado_repre.addEventListener("change", () => module.obtenerMunicipios(select_estado_repre, select_municipio_repre, url));
      select_municipio_repre.addEventListener("change", () => module.obtenerParroquias(select_municipio_repre, select_parroquia_repre, url));


    })

  }
  else if (select_estado_repre != undefined) {

    import("./modulos/Estados_Municipios_Parroquias.js").then(module => {
      select_estado_repre.addEventListener("change", () => module.obtenerMunicipios(select_estado_repre, select_municipio_repre, url));
      select_municipio_repre.addEventListener("change", () => module.obtenerParroquias(select_municipio_repre, select_parroquia_repre, url));

    })

  } else if (select_estado_estu != undefined) {

    import("./modulos/Estados_Municipios_Parroquias.js").then(module => {

      select_estado_estu.addEventListener("change", () => module.obtenerMunicipios(select_estado_estu, select_municipio_estu, url));
      select_municipio_estu.addEventListener("change", () => module.obtenerParroquias(select_municipio_estu, select_parroquia_estu, url));
      select_estado_nacimiento_estu.addEventListener("change", () => module.obtenerParroquias(select_estado_nacimiento_estu, select_ciudad, url));
    })

  }
}



//profesor
if (select_estado_profe != undefined) {

  import("./modulos/Estados_Municipios_Parroquias.js").then(module => {
    select_estado_profe.addEventListener("change", () => module.obtenerMunicipios(select_estado_profe, select_municipio_profe, url));
    select_municipio_profe.addEventListener("change", () => module.obtenerParroquias(select_municipio_profe, select_parroquia_profe, url));
  })

}


/* --------------------------------- tablas --------------------------------- */

////////////////////nota
if (divNota != undefined) {

  import("./modulos/tabla_nota.js").then(module => {


    //esquema 
    /* los primeros 5 parametos son para el 
    diseño
    idioma
    hover
    contenedor de la tabla 
    url de la peticion al servidor
    
    los otros 4 parametros enviados es el diseño de la alerta
   
    fondo de la alerta
    color del boton confirmar
    icono de la alerta
    color del icono de la alerta
 
    */
    module.tablaNota(diseno, espanol, hover, divNota, url, fondo, color_boton, icono_pregunta, icono_confirmar)

  })



}



////////////////////////secciones
if (divSeccion != undefined) {

  import("./modulos/tabla_seccion.js").then(module => {

    module.tablaSeccion(diseno, espanol, hover, divSeccion, url, fondo, color_boton, icono_pregunta, icono_confirmar)
  })
}



///////////////////estudiante
if (divEstudiante != undefined) {

  import("./modulos/tabla_estudiante.js").then(module => {

    module.tablaEstudiante(diseno, espanol, hover, divEstudiante, url, color_boton, color_botonCancelar)
  })




}

///////////////////estudiante reportes
if (divEstudianteReporte != undefined) {


  import("./modulos/tabla_estudianteReporte.js").then(module => {

    module.tablaEstudianteReporte(diseno, espanol, hover, divEstudianteReporte, url, fondo, color_boton)
  })






}
//////////////profesor
if (divProfe != undefined) {


  import("./modulos/tabla_profesor.js").then(module => {

    module.tablaProfesor(diseno, espanol, hover, divProfe, url, fondo, color_boton)
  })


}



///////////asignaciones
if (divAsignaciones != undefined) {

  import("./modulos/tabla_asignacion.js").then(module => {

    module.tablaAsignacion(diseno, espanol, hover, divAsignaciones, url)
  })

}





///////principios de periodo
if (divPrincipioPeriodo != undefined) {

  import("./modulos/tabla_principioPeriodo.js").then(module => {

    module.tablaPrincipioPeriodo(diseno, espanol, hover, divPrincipioPeriodo, url)
  })

}




//////////finales de periodo
if (divFinalPeriodo != undefined) {

  import("./modulos/tabla_FinalPeriodo.js").then(module => {

    module.tablaFinalPeriodo(diseno, espanol, hover, divFinalPeriodo, url)
  })

}


/////////usuarios
if (divUsuarios != undefined) {

  import("./modulos/tabla_usuario.js").then(module => {

    module.tablaUsuario(diseno, espanol, hover, divUsuarios, url, fondo, color_boton, icono_pregunta, icono_confirmar)
  })

}


/* ----------------------- eventos de botones y acciones epeciales ----------------------- */

/* ------------------------ crear periodo en el login y consultar periodos en el login ----------------------- */
//obtener periodos
if (crearPeriodo != undefined) {

  //comprobar si hay un admin registrado en la base de datos
  axios("ajax/php.php", {
    params: {
      ajax_comprobarAdmin: true
    }
  }).then(res => {
    //en caso que no exista ningun admin registrado quiere decir que el sistema esta nuevo y se tendra que registrar un administrador
    if (res.data['resultado'] == "adminNoExiste") {
      //se redirecionara al formulario administrador con un indicador true para acceder al formulario
      location.href = "formularios/formulario_admin.php?id=true"
    }

    else if (res.data['resultado'] == "adminExiste") {

      import("./modulos/Crear periodo login.js").then(module => {

        module.consultarPeriodo()

        crearPeriodo.addEventListener("click", module.modalCrearPeriodo)
      })


    }
  })
}



/* -------- ventana modal en caso que esten viendo todos los periodos ------- */
if (fieldset != undefined) {
  //el fieldset tiene una condional php de agregar un atributo disabled en caso que este en vista de todos los periodo
  //asi automaticamente tendra dos atributo y activara la condional
  if (fieldset.getAttributeNames().length >= 2) {
    Swal.fire({
      title: 'Advertencia',
      icon: 'warning',
      text: '¡ Al inicar sesión visualisando todos los periodo no puede realizar inscripciones !',
      iconColor: '	rgb(255, 165, 0)',
      allowOutsideClick: false,
      confirmButtonColor: color_boton

    }).then(res => {
      history.back()
    })
  }


}


/* ----------------------------- cerrar periodos ---------------------------- */
if (cerrarPeriodo != undefined) {

  //evento a la pestaña
  import("./modulos/Cerrar periodo.js").then(module => {

    cerrarPeriodo.addEventListener("click", module.modalCerrarPeriodo)
  })




}


/* ------ lista de profesores con y si usuarios al registrar un usuario ----- */
if (profeNoUsuario != undefined) {
  import("./modulos/profesor_con-sin_usuario.js").then(module => {

    module.consultarProfeConUsuario(url)
    module.consultarProfeNoUsuario(url)

    //evento al boton para llamar a la funcion y actualizar el select
    let submit = document.querySelector(".boton")
    submit.addEventListener("click", () => {
      module.consultarProfeNoUsuario(url);
      module.consultarProfeConUsuario(url);

    })


  })

  profeNoUsuario.addEventListener("change", (e) => {
    let input = document.getElementById("ci_profe")
    input.value = e.target.value
  })



}



/* ----------------- lista de profesores asignados y no asignados al asignar profesores----------------- */
if (asignados != undefined) {
  import("./modulos/profesor asignados-noAsignados.js").then(module => {

    module.verAsignados(url, asignados)
    module.verNoAsignados(url, noAsignados)


    let submit = document.getElementById("formulario")
    submit.addEventListener("submit", () => {
      setTimeout(module.verAsignados(url, asignados), 800)
      setTimeout(module.verNoAsignados(url, noAsignados), 800)


    })
  })

  //tomar valor del select al input
  noAsignados.addEventListener("change", (e) => {
    let input = document.getElementById("ci_profe")
    input.value = e.target.value
  })
}



/* ------------------------ respaldo de base de datos ----------------------- */

if (crearDb != undefined) {

  import("./modulos/respaldarBd.js").then(module => {

    crearDb.addEventListener("click", module.modalBackupBd)
  })


}
/* ------------------------ restaurar de base de datos ----------------------- */

if (restaurarDb != undefined) {

  import("./modulos/restaurarBd.js").then(module => {

    restaurarDb.addEventListener("click", module.modalRestaurarBd)
  })


}



/* ----------------------------modal para activar secciones en grados con secciones inactivas  --------------------------- */
if (activar_secciones != undefined) {


  let modalActivarSecciones = () => {
    Swal.fire({
      title: 'Activar secciones',
      html: `
      <label class="swal2-input-label titulo_select_alerta">Grado</label>
     
      <select  class="select_alerta" name="grado" id="gradoConSeccionInactiva" auto>
        <option value="0"></option>
      </select> 
     
      <label class="swal2-input-label  titulo_select_alerta">Cantidad de secciones a activar</label>
     
      <select  class="select_alerta" name="seccion" id="cantidadSeccionesActivar">
        <option value="0"></option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option> 
      </select>`,

      icon: 'info',
      didOpen: () => {

        import("../ajax/modulos/gradosSinSeccionesActivas.js").then(module => {
          let gradoConSeccionInactiva = Swal.getHtmlContainer().querySelector('#gradoConSeccionInactiva')
          module.solicitarGradoSinSecciones(gradoConSeccionInactiva)
        })

      },
      showCloseButton: true,
      background: fondo,
      confirmButtonColor: color_boton,
      confirmButtonText: 'Confirmar',
      showLoaderOnConfirm: true,
      footer: '<b>Tenga en cuenta que estos datos no se pueden modificar</b>',
      showLoaderOnConfirm: true,
      preConfirm: () => {
        let select_grado = Swal.getHtmlContainer().querySelector("#gradoConSeccionInactiva").value
        let select_SeccionesActivar = Swal.getHtmlContainer().querySelector("#cantidadSeccionesActivar").value

        if (select_grado == 0 || select_SeccionesActivar == 0) {
          Swal.showValidationMessage(`Rellene todos los campos`)

        } else {
          return axios("registros/registro_secciones_activar.php", {
            params: { grado: `${select_grado}`, seccionesActivar: `${select_SeccionesActivar}` }
          }).then(res => {
            return res.data
          }).catch(err => {
            Swal.showValidationMessage(err)
          })
        }


      }
    }).then(res => {

      if (res.value.resultado == "exito") {

        Swal.fire({
          icon: 'success',
          title: 'Secciones Activadas',
          background: fondo,
          confirmButtonColor: color_boton,
          iconColor: icono_confirmar
        })
      } else if (res.value.resultado == "error") {

        Swal.fire({
          icon: 'error',
          title: 'Error al activar secciones',
          background: fondo,
          confirmButtonColor: color_boton,

        })


      }
    })
  }

  activar_secciones.addEventListener("click", modalActivarSecciones)

}

/* -- detectar que no haya grados con secciones sin activar en formulario asignacion o asginar secciones a estudiante -- */
if (asignar_profe != undefined || divSeccion != undefined) {

  axios(url, {
    params: { gradoDisponible: true }
  }).then(res => {

    if (res.data.length != 6) {
      Swal.fire({
        title: 'Existen grados sin secciones activas',
        icon: 'warning',
        text: 'Necesita que todos los grados tengan secciones activas para continuar ',
        iconColor: '	rgb(255, 165, 0)',
        allowOutsideClick: false,
        confirmButtonColor: color_boton

      }).then(res => {
        history.back()
      })
    }

  })

}

/* ---------------- ver cantidad de secciones activas y disponibles para cada grado en asignacion de profesor --------------- */
if (selectSeccionesDisponibles != undefined) {

  import("../ajax/modulos/gradosConSeccionesDisponible.js").then(module=>{
   
    grado.addEventListener("change",()=>{module.verSeccionesDisponible(url,selectSeccionesDisponibles)})
  })

}


/* ----------------------------- estrucura modal ---------------------------- */


//plantilla de confirmacion

/* Swal.fire({
  title: 'Esta seguro?',
  text: "Desea asignar el literal al estudiante?",
  icon: 'question',
  showCancelButton: true,
  background:'rgb(230, 230, 230)',
  confirmButtonColor: 'rgb(50, 33, 218)',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Cancelar',
  confirmButtonText: 'Confirmar'
}).then((result) => {
  if (result.isConfirmed) {

    Swal.fire({ 
      title:'Literal asignado',
      background:'rgb(230, 230, 230)',
      confirmButtonColor:'rgb(50, 33, 218)'
     })

  } }
 )  */


