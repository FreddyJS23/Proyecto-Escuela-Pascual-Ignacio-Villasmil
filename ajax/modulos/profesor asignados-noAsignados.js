
   let verNoAsignados = (url,noAsignados) => {
    axios(url, {
      params: { devolverSinAsignar: true }
    }).then(res => {
      let html;
      html += `<option value="">Lista de profesores</option>`
      res.data.forEach(profe => {

        html += ` <option value="${profe.ci_profe}">CI-${profe.ci_profe} ${profe.nombre_profe}  ${profe.apellido_profe} </option>`
        noAsignados.innerHTML = html
      })
    })
  }

  
  
  
  
  
  let verAsignados = (url,asignados) => {
    axios(url, {
      params: { devolverAsignados: true }
    }).then(res => {
      let html
      html += `<option value="">Lista de profesores</option>`
      res.data.forEach(profe => {
        html += ` <option value="">${profe.nombre_profe} ${profe.apellido_profe} Grado:${profe.grado}  Seccion:${profe.seccion} </option>`
        asignados.innerHTML = html
      })
    })
  }

 
  /* //tomar valor del select al input
  noAsignados.addEventListener("change", (e) => {
    let input = document.getElementById("ci_profe")
    input.value = e.target.value
  }) */

/* 
  let submit = document.getElementById("formulario")
  submit.addEventListener("submit", () => {
    setTimeout(verAsignados(), 800)
    setTimeout(verNoAsignados(), 800)
    setTimeout(console.log("asr"), 800)

  })
 */
  export{verAsignados,verNoAsignados}