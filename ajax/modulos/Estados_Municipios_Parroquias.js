//esquema utilizado
//se crea la funcion
const obtenerMunicipios= (estado, select_municipio, url) => {
     
  //añadir un estado de carga mientras se carga la informacion
  select_municipio.innerHTML=` <option value="">Cargando...</option>`
  /* la funcion recibe 3 parametros

    parametro 1:valor del select actual estado/municipio
    
    parametro 2:elemento select selecionado en el doom a añadir los datos de la obtencion
    
    parametro 3:dirrecion del archivo php que se hara la consulta */

     select_municipio.removeAttribute("disabled");
    
     //se crea un variable con el valor inicial del select,
    let html = '<option value="0">Seleccione un municipio</option>';
    
    //peticion
    axios(url, {
      //los parametros enviados son el valor actual del select/parametro 1 
      params: { estado: estado.value }
      //manejo de la respuesta, un forEach para idividualizar cada resultado obtenido
    }).then(res => res.data.forEach(municipio => {
  
      //el id de cada municipio sera el valor,la opcion tendra el nombre del municipio,cada repeticion se sumana al valor anterior con +=
      html += `<option value="${municipio['id_municipio']}">${municipio['municipio']}</option>`;
      
      //inserccion del total de options creados con html, en el select municipio
      select_municipio.innerHTML = html;
    }))
    
  
  }
  
  const obtenerParroquias = (municipio, select_parroquia, url) => {
    
    select_parroquia.innerHTML=` <option value="">Cargando...</option>`
    
    select_parroquia.removeAttribute("disabled");
    
    let html = '<option value="0">Seleccione una parroquia</option>';
  
    axios(url, {
  
      params: { municipio:municipio.value }
  
    }).then(res => res.data.forEach(parroquia => {
  
      html += `<option value="${parroquia['id_parroquia']}">${parroquia['parroquia']}</option>`;
  
      select_parroquia.innerHTML = html;
    }));
  
  
  };
  
  
  
  const obtenerCiudad = (estado,select_ciudad,url) => {
    
    select_ciudad.innerHTML=` <option value="">Cargando...</option>`
    
    let html = '<option value="0">Seleccione una ciudad</option>';
    select_ciudad.removeAttribute("disabled");
    axios(url, {
  
      params: { estado_nacimiento:estado.value }
  
    }).then(res => res.data.forEach(ciudad => {
  
      html += `<option value="${ciudad['id_ciudad']}">${ciudad['ciudad']}</option>`;
      select_ciudad.innerHTML = html;
  
    }))
  
  };
  
  export {obtenerMunicipios,obtenerParroquias,obtenerCiudad}