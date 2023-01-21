let tablaPrincipioPeriodo=(diseno,espanol,hover,divPrincipioPeriodo,url)=>{

    let grid = new gridjs.Grid({
        columns: [
          { id: 'periodo', name: 'Periodo' },
          { id: 'grado', name: 'Grado' },
          { id: 'seccion', name: 'Seccion' },
          { id: 'ci_estu_inscripcion', name: 'Cedula' },
          { id: 'nombre_estu', name: 'Nombre' },
          { id: 'apellido_estu', name: 'Apellido' },
        ],
        data: [],
        style: diseno,
        language: espanol,
        search: true,
        sort: true,
        pagination: true,
        className: hover
      }).render(divPrincipioPeriodo)
    principioPeriodo(url,grid)
    }
    //consulta 
    let principioPeriodo = (url,grid) => {
    
        axios(url, {
          params: { ajax_principioPeriodo: true }
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
    
   

export{tablaPrincipioPeriodo}