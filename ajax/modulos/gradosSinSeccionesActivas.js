let solicitarGradoSinSecciones=(gradoConSeccionInactiva,urlRelativa)=>{ 

  //solicitar grados
axios(urlRelativa,{
    params:{gradoDisponible:true}
  }).then(res=>{
    //convertir formato json del servidor a un objeto
    let seccionesActivas=Object.values(res.data)
  
    //array base para comparar
    let grados=[
      {
          "id_grado": "1",                                         
          "grado": "1°"                                         
      },                                         
      {                                         
          "id_grado": "2",                                         
          "grado": "2°"                                         
      },                                         
      {                                         
          "id_grado": "3",                                         
          "grado": "3°"                                         
      },                                         
      {                                         
          "id_grado": "4",                                         
          "grado": "4°"                                         
      },                                         
      {                                         
          "id_grado": "5",                                         
          "grado": "5°"                                         
      },                                         
      {"id_grado":"6",                                         
        "grado":"6°"                                         
    }
  ]
  
  
  //array que guardara la diferencia de los array a comparar
   let gradoConSeccionesInactiva = [];
  //leer array base para sacar las diferencias
   for (let i = 0; i < grados.length; i++) {
      let gradoConSeccionActiva=false;
      
      //inciar otro for para leer el array obtenido de la base de datos 
      for (let j = 0; j < seccionesActivas.length; j++) {
         
        //comparar arrays, en caso que sean iguales quiere decir que el grado ya se le crearon sus seccioenes 
          if(grados[i]['id_grado'] == seccionesActivas[j]['id_grado']) 
                   gradoConSeccionActiva=true;
       }
      //se añadiran a un array los grados que no tienen secciones activas
       if(!gradoConSeccionActiva)gradoConSeccionesInactiva.push(grados[i]);
  }
  
  let html=`<option value=""></option>`
  gradoConSeccionesInactiva.forEach(gradoConSeccionesInactiva => {
   
    html+=`<option value="${gradoConSeccionesInactiva['id_grado']}">${gradoConSeccionesInactiva['grado']}</option>`
    gradoConSeccionInactiva.innerHTML=html
  });
  
  
  }) } 

  export{solicitarGradoSinSecciones}