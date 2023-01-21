let modalCerrarPeriodo= (e) => {

    Swal.fire({
      title: 'Cerrar periodo',
      text: "Tenga en cuenta que al cerrar un periodo no podra realizar mas incripciones en el, solo podra consultarlo",
      icon: 'warning',
      showCancelButton: true,
      background: fondo,
      confirmButtonColor: color_boton,
      iconColor: 'rgb(255, 165, 0)',
      cancelButtonColor: color_botonCancelar,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Confirmar'
    }).then((result) => {
      if (result.isConfirmed) {

        axios('editar/editar_status_periodo.php', {
          params: {
            periodoStatus: true
          }
        }).then(res => {
          if (res.data['resultado'] == "exito") {
            Swal.fire({
              icon: 'success',
              title: 'Periodo cerrado',
              text: 'Volveras al login',
              iconColor: icono_confirmar,
              confirmButtonColor: color_boton,
              confirmButtonText: 'Confirmar'


            }).then(res => {
              location.href = "cerrar sesion.php"
            })
          } else if (res.data['resultado'] == "error") {

            Swal.fire({
              icon: 'error',
              title: 'Error al cerrar el periodo actual',
              background: fondo,
              confirmButtonColor: color_boton,

            })
          }

        }).catch(err => console.log(err))

      }
    })

  }

  export{modalCerrarPeriodo}