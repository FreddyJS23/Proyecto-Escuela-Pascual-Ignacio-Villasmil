//crear tabla


let tablaSeccion = (diseno, espanol, hover, divSeccion, url, fondo, color_boton, icono_pregunta, icono_confirmar) => {

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
            onClick: () => editarSeccion([1, `${row.cells[2].data}`], grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
          }, 'A')

          bton[1] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([2, `${row.cells[2].data}`], grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
          }, 'B')

          bton[2] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([3, `${row.cells[2].data}`], grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
          }, 'C')


          bton[3] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([4, `${row.cells[2].data}`], grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
          }, 'D')


          bton[4] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([5, `${row.cells[2].data}`], grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
          }, 'E')


          bton[5] = gridjs.h('button', {
            id: `${row.cells[2].data}`,
            className: 'nota-seccion',
            onClick: () => editarSeccion([6, `${row.cells[2].data}`], grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
          }, 'F')

         
         
         //funcion bucle para eliminar botones, recibe la resta de botones a eliminar
          let eliminarBotones=(botonesQuitar)=>{
            //bucle para  eliminar ultimo elemento del array bton la cantida de veces que se necesite
            for (let i = 0; i < botonesQuitar; i++) {
              bton.pop()
             
            }
          }
          
          //condicion para identificar en la fila la celda que contiene el grado
          if (row.cells[1].data == "1°") {
            //resta de secciones activas, el resultado dara la cantidad de secciones inactivas
            let botonesQuitar = 6 - grados.primero.seccionActivas
           //se pasa el total de secciones inactivas o mejor dicho los botones a eliminar
            eliminarBotones(botonesQuitar)
           
          }
          if (row.cells[1].data == "2°") {
            let botonesQuitar = 6 - grados.segundo.seccionActivas
           eliminarBotones(botonesQuitar)
           
           
          }
          if (row.cells[1].data == "3°") {
            let botonesQuitar = 6 - grados.tercero.seccionActivas
           eliminarBotones(botonesQuitar)
           
          }
          if (row.cells[1].data == "4°") {
            let botonesQuitar = 6 - grados.cuarto.seccionActivas
           eliminarBotones(botonesQuitar)
           
          }
          if (row.cells[1].data == "5°") {
            let botonesQuitar = 6 - grados.quinto.seccionActivas
           eliminarBotones(botonesQuitar)
           
          }
          if (row.cells[1].data == "6°") {
            let botonesQuitar = 6 - grados.sexto.seccionActivas
           eliminarBotones(botonesQuitar)
           
          }
         //retonar conjunto de botones
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

  consultarSecciones(url, grid)
}




//consultar
const consultarSecciones = (url, grid) => {

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
const editarSeccion = (data, grid, url, fondo, color_boton, icono_pregunta, icono_confirmar) => {

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
        consultarSecciones(url, grid)
      }).catch(err => alert(err))
    }
  })
}

export { tablaSeccion }
