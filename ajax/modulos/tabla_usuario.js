let tablaUsuario=(diseno,espanol,hover,divUsuarios,url)=>{

    let grid = new gridjs.Grid({
        columns: [
          {
            id: 'usuario', name: 'Usuario',
            formatter: (cell, row) => {
              let html = []
    
              html[0] = gridjs.h('i', {
                className: 'fa-solid fa-pen-to-square editar-usuario',
                onClick: () => editarUsuario(`${row.cells[0].data}`)
              })
    
              html[1] = gridjs.html(`${row.cells[0].data}`)
              return html
            }
    
          },
          { id: 'nombre', name: 'Nombre' },
          { id: 'apellido', name: 'Apellido' },
          { id: 'ci_profe', name: 'Cedula del profesor' },
          { id: 'borrar',  name:'Borrar',
          
          formatter:(cell,row)=>{
            let html=[];
          
            html[0]=gridjs.h('i',{
              className:'fa-solid fa-user-xmark eliminar-usuario',
              onClick:()=>eliminarUsuario(`${row.cells[0].data}`,url,grid)
              
            })
            return html
          }}
    
        ],
        data: [],
        style: diseno,
        language: espanol,
        search: true,
        sort: true,
        pagination: true,
        className: hover
      }).render(divUsuarios)
    
      consultarUsuarios(url,grid)
    }
    
      let consultarUsuarios = (url,grid) => {
    
        axios(url, {
          params: { ajax_usuarios: true }
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
    
     
      //editar usuario boton
      let editarUsuario = (usuario) => location.href = `../formularios/formulario_editar_usuario.php?id=${usuario}`

      //boton eliminar usuario

      let eliminarUsuario=(usuario,url,grid)=>{
       
      axios("../editar/eliminar_usuario.php",{
        params:{
          id:usuario
        }
      }
       ).then(res=>{
        if(res.data.resultado=="exito"){
          consultarUsuarios(url,grid);
        
        }
       })

      }
    



export{tablaUsuario}