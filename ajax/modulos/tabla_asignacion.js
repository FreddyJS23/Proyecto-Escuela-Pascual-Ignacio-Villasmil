let tablaAsignacion=(diseno,espanol,hover,divAsignaciones,url)=>{
    
    let grid = new gridjs.Grid({
        columns: [
          { id: 'ci_profe_asignacion', name: 'Cedula' },
          { id: 'nombre_profe', name: 'Nombre' },
          { id: 'apellido_profe', name: 'Apellido' },
          { id: 'periodo', name: 'Periodo' },
          { id: 'grado', name: 'Grado' },
          { id: 'seccion', name: 'Seccion' },
        ],
        data: [],
        style: diseno,
        language: espanol,
        search: true,
        sort: true,
        pagination: true,
        className: hover
      }).render(divAsignaciones)
    
      consultarAsignaciones(url,grid)
     }

     //consulta
      let consultarAsignaciones = (url,grid) => {
    
        axios(url, {
          params: { ajax_asignacion: true }
    
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
    
 


export{tablaAsignacion}