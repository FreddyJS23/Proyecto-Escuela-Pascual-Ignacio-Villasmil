let verSeccionesDisponible = (url,selectSeccionesDisponibles) => {

    axios(url, {
      params: { grado: grado.value }
    }).then(res => {

      let seccionesOcupadas = Object.values(res.data)

      let secciones = [
        {
          "id_seccion": "1",
          "seccion": "A"
        },
        {
          "id_seccion": "2",
          "seccion": "B"
        },
        {
          "id_seccion": "3",
          "seccion": "C"
        },
        {
          "id_seccion": "4",
          "seccion": "D"
        },
        {
          "id_seccion": "5",
          "seccion": "E"
        },
        {
          "id_seccion": "6",
          "seccion": "F"
        }
      ]

      let seccionesDisponibles = []
      for (let i = 0; i < secciones.length; i++) {
        let ocupado = false
       
        for (let j = 0; j < seccionesOcupadas.length; j++) {
          if (secciones[i]['id_seccion'] == seccionesOcupadas[j]['id_seccion']) {
            ocupado = true
          }
        }
        if (!ocupado) {
          seccionesDisponibles.push(secciones[i])

        }
      }
    
      let html=` <option value="">Seleccione una seccion</option>`
      seccionesDisponibles.forEach(seccionDisponible=>{
        html+=` <option value="${seccionDisponible['id_seccion']}">${seccionDisponible['seccion']}</option>`

        selectSeccionesDisponibles.innerHTML=html
      })
    })  
  selectSeccionesDisponibles.removeAttribute("disabled")
  }

  export{verSeccionesDisponible}