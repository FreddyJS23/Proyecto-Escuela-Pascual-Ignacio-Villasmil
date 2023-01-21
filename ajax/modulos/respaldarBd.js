

//ventana modal para crear backup de la base de datos
let modalBackupBd= () => {

    Swal.fire({
      title: 'Respaldar base de datos',
      icon: 'info',
      showCancelButton: true,
      background: fondo,
      confirmButtonColor: color_boton,
      iconColor: icono_pregunta,
      cancelButtonColor: color_botonCancelar,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Confirmar',
      showLoaderOnConfirm: true
    }).then((result) => {
      if (result.isConfirmed) {

        axios('backup-restore.php', {
          params: {
            backupDb: true
          }
        }).then(res => {
          if (res.data['resultado'] == 0) {
            Swal.fire({
              icon: 'success',
              title: 'Respaldo exitoso',
              footer: 'La ruta predetermina de los backup es "C:/Bakups sistema automatizado registro control de notas"',
              iconColor: icono_confirmar,
              confirmButtonColor: color_boton,
              confirmButtonText: 'Confirmar'


            }).then(res => {

            })
          } else if (res.data['resultado'] != 0) {

            Swal.fire({
              icon: 'error',
              title: 'Error al respaldar la base de datos',
              background: fondo,
              confirmButtonColor: color_boton,

            })
          }
        })






      }
    })

  }
  export{modalBackupBd}