//sin usuarios
let consultarProfeNoUsuario = (url,profeNoUsuario) => {
  
    axios(url, {
      params: { ajax_profeNoUsuario: true }
    }).then(res => {
      let html = ` <option value="">Lista de profesores</option>`
      profeNoUsuario.innerHTML=html
      res.data.forEach(profes => {

        html += ` <option value="${profes['ci_profe']}">CI:${profes['ci_profe']} Nombre:${profes['nombre_profe']} ${profes['apellido_profe']}</option>`
        profeNoUsuario.innerHTML = html
      })

    })
  }
  //con usuario
  let consultarProfeConUsuario = (url,profeConUsuario) => {
    
    axios(url, {
      params: { ajax_profeConUsuario: true }
    }).then(res => {
    
      let html = ` <option value="">Lista de profesores</option>`
      res.data.forEach(profes => {
       
        html += ` <option value="${profes['ci_profe']}">CI:${profes['ci_profe']} Nombre:${profes['nombre']} ${profes['apellido']}</option>`
        profeConUsuario.innerHTML = html
        
       
      })

    })
  }




 
  export{consultarProfeConUsuario,consultarProfeNoUsuario}