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
    
      Swal.fire({
        title: 'Filtrar Grados',
        html: `
       
       
        <label class="swal2-input-label  titulo_select_alerta">Grados a filtrar</label>
       
        <select style="width:100px" class="select_alerta" name="gradoFiltrar" id="gradoFiltrar">
        
          <option value="todos">Todos</option>
          <option value="1">1°</option>
          <option value="2">2°</option>
          <option value="3">3°</option>
          <option value="4">4°</option>
          <option value="5">5°</option>
          <option value="6">6°</option> 
        </select>`,
  
        icon: 'info',
        
        showCloseButton: true,
        background: fondo,
        confirmButtonColor: color_boton,
        confirmButtonText: 'Confirmar',
        showLoaderOnConfirm: true,
      
        showLoaderOnConfirm: true,
        preConfirm: () => {
          let select_gradoFiltrar = Swal.getHtmlContainer().querySelector("#gradoFiltrar").value
         
  
          return select_gradoFiltrar
  
  
        }
      }).then(res => {
  
          
      axios(url, {
        params: { ajax_finalPeriodoGrado: res.value }
      }).then(res => {
  
        grid.updateConfig({
  
          data: () => {
            return new Promise(resolve => {
              setTimeout(() => resolve(res.data), 1000)
            })
          }
        }).forceRender()
      })

      })
    }  
      
      
      
      
      
      
      
    
      
    
   

export{tablaFinalPeriodo}