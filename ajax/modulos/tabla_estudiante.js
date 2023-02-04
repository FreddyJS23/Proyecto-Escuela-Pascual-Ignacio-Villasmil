let tablaEstudiante = (diseno, espanol, hover, divEstudiante, url, color_boton, color_botonCancelar) => {
  let grid = new gridjs.Grid({
    columns: [
      {
        name: 'Cedula', id: 'ci_estu',
        formatter: (cell, row) => {
          let html = []
          html[0] = gridjs.h('i', {
            className: 'fa-solid fa-pen-to-square editar-estu',
            onClick: () => modalEditarEstu(`${row.cells[0].data}`, url, color_boton, color_botonCancelar)
          })
          html[1] = gridjs.html(`${row.cells[0].data}`)

          return html
        }

      }, { id: 'nombre_estu', name: 'Nombre' },
      { id: 'apellido_estu', name: 'Apellido' },
      { id: 'sx_estu', name: 'Genero' },
      { id: 'fn_estu', name: 'Fecha de nacimiento' },
      { id: 'municipio', name: 'Municipio', },
      {
        name: 'Representante', sort: false,
        formatter: (cell, row) => {
          return gridjs.h('i', {
            className: 'fa-solid fa-person-breastfeeding editar-repre',
            onClick: () => modalVerRepre(`${row.cells[0].data}`, url, color_boton, color_botonCancelar)

          })
        }
      }


    ],

    data: [],
    className: hover,
    language: espanol,
    style: diseno,
    sort: true,
    pagination: true,
    heigt: '400px',
    fixedHeader: true,
    search: true,
  }).render(divEstudiante)
  consultarEstudiante(url, grid)
}


//obtener estudiante
let consultarEstudiante = (url, grid) => {
  axios(url, {
    params: { ajax_estudiante: true }
  }).then(res => {
    grid.updateConfig({
      data: () => {
        return new Promise(resolve => {

          setTimeout(() => resolve(res.data), 1000)
        })
      }
    }).forceRender()
  })
}


//ventana modal para ver datos completos del estudiante

let modalEditarEstu = (ci_estu, url, color_boton, color_botonCancelar) => {
  axios(url, {
    params: {
      ci_estu_editar: ci_estu
    }
  }).then(res => {
    //data estudiante
    let data1 = res.data[0]
    //data lugar de nacimiento estudiante
    let data2 = res.data[1]
    //juntar informacion
    let estudiante = Object.assign(data1, data2)

    let genero;
    if (estudiante['sx_repre'] == "F") {
      genero = "Femenino"
    } else {
      genero = "Masculino"
    }
    Swal.fire({
      //insertar html en el modal
      html: `
    
    <fieldset disabled style="border:0">
           
  <div class="container-lg  contenedor_estudiante contenedor_estudiante_grid">

    <div class="titulo_formulario titulo_formulario_grid">
        <p><i class="fa-solid fa-children"></i>Datos del estudiante</p>
    </div>
    <div class="container campos_estudiante campos_estudiante_grid" id="estudiante">


        <div class="container_campos container container_ci_estu">
           
           <input value="${estudiante.ci_estu}" class="input" required type="text" name="ci_estu" id="ci_estu" placeholder=" " autocomplete="off"
                maxlength="14" autofocus autocomplete="off" title="Ingrese un formato correcto ejem:01020329839077">
            <label class="label label_input_previa_datos label_input_previa_datos_ci" id="label_ci_estu" for="ci_estu">Cedula estudiante </label>
        </div>

        <div class="container_campos container">
            <input  value="${estudiante.nombre_estu}"  class="input" required type="text" name="nombre_estu" id="nombre_estu" placeholder=" "
                autocomplete="off" maxlength="30">
            <label class="label label_input_previa_datos" id="label_nombre_estu" for="nombre_estu">Nombre completo </label>
        </div>

        <div class="container_campos container">
            <input  value="${estudiante.apellido_estu}"  class="input" required type="text" name="apellido_estu" id="apellido_estu" placeholder=" "
                autocomplete="off" maxlength="30">
            <label class="label label_input_previa_datos" id="label_apellido_estu" for="apellido_estu">Apellido completo </label>
        </div>

        <div class="container_campos container">
            <input  value="${estudiante.fn_estu}"  class="input" required type="date" name="fn_estu" id="fn_estu">
            <label class="label label_input_previa_datos" for="fn_estu">Fecha nacimiento</label>
        </div>

        <div class="container_campos container genero" for="genero">
            <label for="sx_estu" class="label_select label_select_previa_datos label_select_previa_datos_genero" for="sx_estu">Genero</label>
            <select class="select" name="sx_estu" id="sx_estu">
                <option value="0">${genero}</option>
               
            </select>
        </div>

        <div class="container_campos container" for="economia">
            <label for="economia" class="label_select label_select_previa_datos label_select_previa_datos_economia">Estado economico</label>
            <select class="select" name="economia" id="economia">
                <option value="0">${estudiante.estado_econ}</option>
               
            </select>
        </div>

        <div class="container_campos container" for="discapacidad">
            <label for="discapacidad" class="label_select label_select_previa_datos label_select_previa_datos_discapacidad">Discapacidad</label>
            <select class="select" name="discapacidad" id="select_discapacidad">
            <option value="si">${estudiante.discapacidad}</option>
                
                <option value="no">No</option>
            </select>
        </div>

        <div class="container_campos container">
            <input  value="${estudiante.enfermedad}"  class="input" required type="text" name="enfermedad" id="enfermedad" placeholder=" "
                autocomplete="off" maxlength="30">
            <label class="label label_input_previa_datos" id="label_enfermedad" for="enfermedad">Sufre alguna enfermedad?</label>
        </div>

        <div class="container_campos container">
            <input  value="${estudiante.tlf_estu}"  class="input" required type="text" name="tlf_estu" id="tlf_estu" placeholder=" " autocomplete="off"
                maxlength="12" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Formato 0xxx-xxxxxxx">
            <label class="label label_input_previa_datos" id="label_tlf_estu" for="tlf_estu">Telefono contacto</label>
        </div>
    </div>


    <!-- campos ubicacion -->
    <div class=" container contenedor_ubicacion  contenedor_ubicacion_grid">
        <div class="contenedor_titulo_ubicacion">
            <p class="titulo_ubicacion">Donde reside actualemte</p>
        </div>

        <div class="campos_ubicacion">
            <div class="container_campos container">
                <label class="label_select label_select_previa_datos" for="estado_estu">Estado</label>
                <select class="select" name="estado_estu" id="estado_estu">
                    
                <option value="0">${estudiante.estado}</option>
               
                </select>
            </div>

            <div class="container_campos container">
                <label class="label_select label_select_previa_datos" for="municipio_estu">Municipio</label>
                <select class="select" name="municipio_estu" id="municipio_estu"disabled >
                    <option value="0">${estudiante.municipio}</option>
                </select>
            </div>

            <div class="container_campos container">
                <label class="label_select label_select_previa_datos" for="parroquia">Parrquia</label>
                <select class="select" name="parroquia_estu" id="parroquia_estu"disabled >
                    <option value="0">${estudiante.parroquia}</option>
                </select>
            </div>

            <div class="container_campos container" for="sector">
                <input  value="${estudiante.sector}"  class="input" required type="text" name="sector_estu" placeholder=" " autocomplete="off"
                    id="sector_estu" maxlength="30">
                <label class="label label_input_previa_datos label_input_previa_datos_sector" id="label_sector_estu" for="sector_estu">Sector</label>
            </div>
        </div>
    </div>

    <!-- Lugar de nacimiento -->
    <div class="container contenedor_ubicacion contenedor_ubicacion_grid">
        <div class="contenedor_titulo_ubicacion">
            <p class="titulo_ubicacion">Lugar de nacimiento</p>
        </div>

        <div class="campos_ubicacion">
            <div class="container_campos container">
                <label class="label_select label_select_previa_datos" for="pais">Pais</label>
                <select class="select" name="pais" id="pais">
                    
                    <option value="1">${estudiante.pais}</option>
                   
                </select>
            </div>

            <div class="container_campos container">
                <label class="label_select label_select_previa_datos" for="estado_nacimiento_estu">Estado</label>
                <select class="select" name="estado_nacimiento_estu" id="estado_nacimiento_estu" >
                    <option value="0">${estudiante.estado_nacimiento}</option>
                 
                </select>
            </div>

            <div class="container_campos container">
                <label class="label_select label_select_previa_datos" for="ciudad">Ciudad</label>
                <select class="select" name="ciudad" id="ciudad" disabled>
                    <option value="0">${estudiante.ciudad}</option>
                   
                </select>

            </div>

        </div>
    </div>


</div>    



        </fieldset>
    
   
    `,
      width: "86%",
      background: "transparent",

      confirmButtonColor: color_boton,
      confirmButtonText: "Editar",
      showCancelButton: true,
      cancelButtonColor: color_botonCancelar,
      cancelButtonText: "Cancelar"

    }).then(res => {
      //si dan click en confirmar los reedirecionara al formulario editar con el id de la cedula
      if (res.isConfirmed) {
        location.href = `../formularios/formulario_editar_estu.php?id=${estudiante['ci_estu']}`
      }
    })


  })

}

let modalVerRepre = (ci_estu_repre, url, color_boton, color_botonCancelar) => {

  axios(url, {
    params: {
      ci_estu_repre: ci_estu_repre
    }
  }).then(res => {
    //data representante
    let data1 = res.data[0]
    //data del parentesco
    let data2 = res.data[1]
    //juntar informacion
    let representante = Object.assign(data1, data2)

    let genero;
    if (representante['sx_repre'] == "F") {
      genero = "Femenino"
    } else {
      genero = "Masculino"
    }
    Swal.fire({

      html: `
         <fieldset disabled style="border:0">
         <div class="contenedor_representante contenedor_representante_grid">
         <div class="titulo_formulario titulo_formulario_grid">
             <p><i class="fa-solid fa-person-breastfeeding"></i>Datos del representante</p>
         </div>
         <div class="campos_representante campos_representante_grid">
             <div class="container_campos container_ci_repre">
                 <input class="input" required type="text" name="ci_repre" id="ci_repre" value=${representante['ci_repre']} placeholder=" " autocomplete="off" maxlength="8">
                 <label class="label" id="label_ci_repre" for="ci_repre">Cedula </label>
             </div>
             <div class="container_campos">
                 <input class="input" required type="text" name="nombre_repre" id="nombre_repre" value=${representante['nombre_repre']} placeholder=" " autocomplete="off" maxlength="30">
                 <label class="label" id="label_nombre_repre" for="nombre_repre">Nombre completo </label>
             </div>
             <div class="container_campos">
                 <input class="input" required type="text" name="apellido_repre" id="apellido_repre"value=${representante['apellido_repre']} placeholder=" " autocomplete="off" maxlength="30">
                 <label class="label" id="label_apellido_repre" for="apellido_repre">Apellido completo </label>
             </div>
             <div class="container_campos">
                 <input class="input" required type="date" name="fn_repre" value=${representante['fn_repre']} id="fn_repre">
                 <label class="label" for="fn_repre">Fecha nacimiento </label>
             </div>
             <div class="container_campos genero">
                 <label class="label_select label_select_previa_datos label_select_previa_datos_genero" for="sx_repre">Genero</label>
                 <select class="select" name="sx_repre"value= id="sx_repre">
                     <option value="0">${genero}</option>
                     <option value="M">Masculino</option>
                     <option value="F">Femenino</option>
                 </select>
             </div>
             <div class="container_campos">
                 <input class="input" required type="text" name="tlf_repre"value=${representante['tlf_repre']} id="tlf_repre" placeholder=" " autocomplete="off" maxlength="12" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Formato 0xxx-xxxxxxx">
                 <label class="label" id="label_tlf_repre" for="tlf_repre">Telefono contacto</label>
             </div>
             <div class="container_campos">
                 <input class="input" required type="text" name="parentesco" id="parentesco"value=${representante['parentesco']} placeholder=" " autocomplete="off" maxlength="15">
                 <label class="label" id="label_parentesco" for="parentesco">Parentesco con el estudiante</label>
             </div>
         </div>
         <!-- ubicacion -->
         <div class="contenedor_ubicacion">
             <div class="contenedor_titulo_ubicacion">
                 <p class="titulo_ubicacion">Donde reside actualemte</p>
             </div>
             <div class="campos_ubicacion">
                 <div class="container_campos">
                     <label class="label_select label_select_previa_datos" for="estado">Estado</label>
                     <select class="select" name="estado_repre" id="estado_repre">
                         <option value="0">${representante['estado']}</option>
                       
                     </select>
                 </div>
                 <div class="container_campos">
                     <label class="label_select label_select_previa_datos" for="estado">Municipio</label>
                     <select class="select" name="municipio_repre" id="municipio_repre">
                         <option value="0">${representante['municipio']}</option>

                         <option value="460">Sucre</option>
                     </select>
                 </div>
                 <div class="container_campos">
                     <label class="label_select label_select_previa_datos" for="parroquia">Parroquia</label>
                     <select class="select" name="parroquia_repre" id="parroquia_repre">
                         <option value="0">${representante['parroquia']}</option>

                     </select>
                 </div>
                 <div class="container_campos" for="sector">
                     <input class="input" required type="text"value=${representante['sector']} name="sector_repre" placeholder=" " autocomplete="off" id="sector_repre" maxlength="30">
                     <label class="label" id="label_sector_repre" for="sector_repre">Sector</label>
                 </div>
             </div>
         </div>
     </div>
     </fieldset>    
         `,

      width: "83%",
      background: "transparent",

      confirmButtonColor: color_boton,
      confirmButtonText: "Editar",
      showCancelButton: true,
      cancelButtonColor: color_botonCancelar,
      cancelButtonText: "Cancelar"

    }).then(res => {
      if (res.isConfirmed) {
        location.href = `../formularios/formulario_editar_repre.php?id=${representante['ci_repre']}`
      }
    })






  })

}

export { tablaEstudiante }