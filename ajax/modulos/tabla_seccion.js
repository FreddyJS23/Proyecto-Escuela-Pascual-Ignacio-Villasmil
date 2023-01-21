//crear tabla
  
let tablaSeccion=(diseno,espanol,hover,divSeccion,url,  fondo,color_boton,icono_pregunta,icono_confirmar)=>{

  let grid = new gridjs.Grid({
    columns: [
      { id: 'periodo', name: 'Periodo' },
      { id: 'grado', name: 'Grado' },
      { id: 'ci_estu_inscripcion', name: 'Cedula' },
      { id: 'nombre_estu', name: 'Nombre' },
      { id: 'apellido_estu', name: 'Apellido', },
      {
        name: 'Secciones',
        formatter: (cell, row) => {
          let bton = []
          bton[0] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([1, `${row.cells[2].data}`], grid,url,fondo,color_boton,icono_pregunta,icono_confirmar)
          }, 'A')

          bton[1] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([2, `${row.cells[2].data}`], grid,url,fondo,color_boton,icono_pregunta,icono_confirmar)
          }, 'B')

          bton[2] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([3, `${row.cells[2].data}`], grid,url,fondo,color_boton,icono_pregunta,icono_confirmar)
          }, 'C')


          bton[3] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([4, `${row.cells[2].data}`], grid,url,fondo,color_boton,icono_pregunta,icono_confirmar)
          }, 'D')


          bton[4] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([5, `${row.cells[2].data}`], grid,url,fondo,color_boton,icono_pregunta,icono_confirmar)
          }, 'E')


          bton[5] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([6, `${row.cells[2].data}`], grid,url,fondo,color_boton,icono_pregunta,icono_confirmar)
          }, 'F')


          return bton
        }
      }],
    data: [],
    style: diseno,
    sort: true,
    pagination: true,
    heigt: '400px',
    fixedHeader: true,
    className: hover,
    language: espanol,

  }).render(divSeccion)

consultarSecciones(url,grid)
}




  //consultar
  const consultarSecciones = (url,grid) => {

    axios(url, {
      params: {
        ajax_seccion: true
      }
    }).then(res => {

      grid.updateConfig({

        data: () => {
          return new Promise(resolve => {
            setTimeout(() => resolve(res.data), 300)
          })
        }

      }).forceRender();
    })
  }

  //asignar seccion
  const editarSeccion = (data ,grid,url,fondo,color_boton,icono_pregunta,icono_confirmar) => {

    Swal.fire({
      title: 'Esta seguro?',
      text: "Desea asignar la sección al estudiante?",
      icon: 'question',
      showCancelButton: true,
      background: fondo,
      confirmButtonColor: color_boton,
      iconColor: icono_pregunta,
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Confirmar'
    }).then((result) => {
      if (result.isConfirmed) {
        axios(url, {
          params: {
            ci_estu_seccion: data[1],
            seccion: data[0]
          }
        }).then(res => {
          if (res.data.resultado == "exito") {
            Swal.fire({
              icon: 'success',
              title: 'Sección asignada',
              timer: 800,
              iconColor: icono_confirmar,
              showConfirmButton: false
            })
          } else {

            Swal.fire({
              icon: 'error',
              title: 'Seccion no asignada',
              timer: 800,
              showConfirmButton: false

            })
          }
          consultarSecciones(url,grid)
        }).catch(err => alert(err))
      }
    })
  }

  export{tablaSeccion}
