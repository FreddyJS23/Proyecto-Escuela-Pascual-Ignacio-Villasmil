

//ventana modal para crear backup de la base de datos
let modalBackupBd = () => {

  Swal.fire({
    title: 'Respaldar base de datos',
    icon: 'info',
    showLoaderOnConfirm: true,
    showCancelButton: true,
    background: fondo,
    confirmButtonColor: color_boton,
    iconColor: icono_pregunta,
    cancelButtonColor: color_botonCancelar,
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Confirmar',
    preConfirm: () => {
      return axios('backup-restore.php', {
        params: {
          backupDb: true
        }
      }).then(res => { return res.data })
    }

  }).then((result) => {
    if (result.isConfirmed) {
      
      if (result.value.resultado == 0) {
        Swal.fire({
          icon: 'success',
          title: 'Respaldo exitoso',
          footer: 'La ruta predetermina de los backup es "C:/Bakups sistema automatizado registro control de notas"',
          iconColor: icono_confirmar,
          confirmButtonColor: color_boton,
          confirmButtonText: 'Confirmar'


        }).then(res => {

        })
      } else if (result.value.resultado != 0) {

        Swal.fire({
          icon: 'error',
          title: 'Error al respaldar la base de datos',
          background: fondo,
          confirmButtonColor: color_boton,

        })
      }







    }
  })

}
export { modalBackupBd }