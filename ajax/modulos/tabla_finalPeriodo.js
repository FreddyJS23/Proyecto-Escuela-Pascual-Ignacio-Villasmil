let tablaFinalPeriodo=(diseno,espanol,hover,divFinalPeriodo,url)=>{

    let grid = new gridjs.Grid({
        columns: [
          { id: 'periodo', name: 'Periodo' },
          { id: 'grado', name: 'Grado' },
          { id: 'seccion', name: 'Seccion' },
          { id: 'ci_estu_inscripcion', name: 'Cedula' },
          { id: 'nombre_estu', name: 'Nombre' },
          { id: 'apellido_estu', name: 'Apellido' },
          { id: 'nota', name: 'Nota' },
        ],
        data: [],
        style: diseno,
        language: espanol,
        search: true,
        sort: true,
        pagination: true,
        className: hover
      }).render(divFinalPeriodo)
  finalPeriodo(url,grid)
    }
    //consulta 
    let finalPeriodo = (url,grid) => {
    
        axios(url, {
          params: { ajax_finalPeriodo: true }
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
    
   

export{tablaFinalPeriodo}