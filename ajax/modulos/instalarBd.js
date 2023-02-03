let instalarBd=()=>{
Swal.fire({
    title: 'Base de datos no instalada',
    icon: 'warning',
    iconColor: 'rgb(255, 165, 0)',
    showLoaderOnConfirm: true,
    showCancelButton: false,
    allowOutsideClick:false,
    showConfirmButton: true,
    confirmButtonText: 'Instalar',
   
    background: fondo,
    confirmButtonColor: color_boton,
    cancelButtonColor: color_botonCancelar,

    preConfirm: () => {
      return axios("instalarBd/instalarBd.php", {
        params: {
          crearBd: true
        }
      }).then(res => { return res.data })
    }

  }).then(res => {
    if (res.value == 0) {
      Swal.fire({
        title: 'Base de datos instalada',
        icon: 'success',
        showLoaderOnConfirm: true,
        showCancelButton: false,
        background: fondo,
        footer: '<b>Porfavor reinicie el servidor</b>',
        confirmButtonColor: color_boton,
        iconColor: icono_confirmar,
        cancelButtonColor: color_botonCancelar,
      }).then(res=>{
        location.reload()
      })
      
    } else {
      Swal.fire({
        title: 'Error al instalar base de datos instalada',
        icon: 'error',
        showLoaderOnConfirm: true,
        showCancelButton: false,
        background: fondo,
        confirmButtonColor: color_boton,
        cancelButtonColor: color_botonCancelar,
      }).then(res => {
        location.reload()
      })
    }

  })}

  export{instalarBd}