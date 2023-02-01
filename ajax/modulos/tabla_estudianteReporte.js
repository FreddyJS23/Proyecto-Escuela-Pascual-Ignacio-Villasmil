let tablaEstudianteReporte = (diseno, espanol, hover, divEstudianteReporte, url, fondo, color_boton) => {

  let grid = new gridjs.Grid({
    columns: [
      {
        name: 'Cedula', id: 'ci_estu',
        formatter: (cell, row) => {
          let html = []

          html[0] = gridjs.html(`${row.cells[0].data}`)

          return html
        }

      }, { id: 'nombre_estu', name: 'Nombre' },
      { id: 'apellido_estu', name: 'Apellido' },

      //constancias
      {
        name: 'Constancias', sort: false,
        formatter: (cell, row) => {
          return gridjs.h('i', {
            className: 'fa-solid fa-file-pdf constancias',
            onClick: () => modalVerReporteConstancia(`${row.cells[0].data}`, fondo)

          })
        }
      },
      //certificados
      {
        name: 'Certificados', sort: false,
        formatter: (cell, row) => {
          return gridjs.h('i', {
            className: 'fa-solid fa-file-pdf constancias',
            onClick: () => modalVerReporteCertificado(`${row.cells[0].data}`, fondo)

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

    fixedHeader: true,
    search: true,
  }).render(divEstudianteReporte)

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


//ventana modal constancias
let modalVerReporteConstancia = (ci_estu, fondo) => {
  axios("../ajax/php.php", {
    params: { periodoActual: true }
  }).then(res => {
    if (res.data.resultado != "todos") {

      Swal.fire({
        title: 'Contancias',

        html:
          `
           
          <a class="link_reporte" href="../reportes/constancias/constancia_inscripcion.php?ci_estu=${ci_estu}">Constancia de inscripcion</a> <br>
          <a class="link_reporte" href="../formularios/formulario_constanciaRetiro.php?id=${ci_estu}">Constancia de retiro</a>
        `,
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton: false,
        background: fondo,


      })
    }else{
      Swal.fire({
        title: 'Contancias',

        html:
          `
           <a class="link_reporte" href="../formularios/formulario_constanciaEstudio.php?id=${ci_estu}">Constancia de estudio con literal</a> <br>
          
        `,
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton: false,
        background: fondo,


      })

    }
  })

}

//ventana modal certificados
let modalVerReporteCertificado = (ci_estu, fondo) => {
axios("../ajax/php.php",{
  params:{periodoActual:true}
}).then(res=>{

  if(res.data.resultado !="todos"){
  Swal.fire({
    title: 'Certificados',

    html:
      `
            <a class="link_reporte" href="../formularios/formulario_cartaAceptacion.php?id=${ci_estu}">Carta de aceptacion</a> <br>
            <a class="link_reporte" href="../formularios/formulario_certificadoConducta.php?id=${ci_estu}">Certificado de buena conducta</a> <br>
            
           
          `,
    showCloseButton: true,
    showCancelButton: false,
    showConfirmButton: false,
    background: fondo,


  })}else{

    Swal.fire({
      title: 'Certificados',
  
      html:
        `
              <a class="link_reporte" href="../formularios/formulario_cartaAceptacion.php?id=${ci_estu}">Carta de aceptacion</a> <br>
              
              <a class="link_reporte" href="../formularios/formulario_certificadoPromocion.php?id=${ci_estu}">Certificado de promoción</a> <br>
             
            `,
      showCloseButton: true,
      showCancelButton: false,
      showConfirmButton: false,
      background: fondo,
  
  
    })
  }

})

}




export { tablaEstudianteReporte }