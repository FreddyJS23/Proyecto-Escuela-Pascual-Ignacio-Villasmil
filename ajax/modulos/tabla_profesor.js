let tablaProfesor=(diseno,espanol,hover,divProfe,url,  fondo,color_boton)=>{


    let grid = new gridjs.Grid({
        columns: [
          {
            id: 'ci_profe', name: 'Cedula',
            formatter: (cell, row) => {
              let html = []
    
              //variable global declarada en el head de consulta profesor
              if (cargo == 1) {
    
                html[0] = gridjs.h('i', {
                  className: 'fa-solid fa-pen-to-square editar-profe',
                  onClick: () => editarProfe(`${row.cells[0].data}`)
                })
              }
    
              html[1] = gridjs.html(`${row.cells[0].data}`)
              return html
            }
    
          },
          { id: 'nombre_profe', name: 'Nombre' },
          { id: 'apellido_profe', name: 'Apellido' },
          { id: 'sx_profe', name: 'Genero' },
          { id: 'tlf_profe', name: 'Telefono' },
          { id: 'grado_instruccion', name: 'Grado de instruccion' },
          { id: 'condicion_laboral', name: 'Condicion laboral' },
          { id: 'status', name: 'Status' },
          { id: 'sector', name: 'Sector' },
    
    
        ],
        data: [],
        style: diseno,
        language: espanol,
    
        search: true,
        sort: true,
        pagination: true,
        className: hover
      }).render(divProfe)
     
    consultarProfe(url,grid)
    }
      
     //obtener profesores
      let consultarProfe = (url,grid) => {
    
        axios(url, {
          params: { ajax_profe: true }
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
      
    
      //boton editar
      let editarProfe = (ci_profe) => location.href = `../formularios/formulario_editar_profe.php?id=${ci_profe}`



export{tablaProfesor}