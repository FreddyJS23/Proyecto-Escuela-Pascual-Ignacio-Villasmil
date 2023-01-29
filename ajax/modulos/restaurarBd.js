//restaurar backup de base de datos
let modalRestaurarBd = () => {

    Swal.fire({
        title: 'Restaurar',
        input: 'file',
        inputAttributes: {
            'accept': '.sql',
            'aria-label': 'Upload your profile picture',
            'name': 'fileRestore',
            'id': 'fileSql',
        },
        preConfirm: (res) => {

            return axios("backup-restore.php", {
                params: {
                    restoreDb: 'true',
                    restoreFile: res.name
                }
            }
            ).then(res => {

                return res.data
            })

        },
        icon: 'info',
        showCancelButton: true,
        background: fondo,
        confirmButtonColor: color_boton,
        iconColor: icono_pregunta,
        cancelButtonColor: color_botonCancelar,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar',
        showLoaderOnConfirm: true

    }).then((res) => {
        if (res.isConfirmed) {

            if (res.value['resultado'] == 0) {
                Swal.fire({
                    icon: 'success',
                    title: 'Base de datos restaurada',

                    iconColor: icono_confirmar,
                    confirmButtonColor: color_boton,
                    confirmButtonText: 'Confirmar'


                }).then(res => {
                    location.href="cerrar sesion.php"
                })
            } else if (res.value['resultado'] != 0) {

                Swal.fire({
                    icon: 'error',
                    title: 'Error al restaurar la base de datos',
                    background: fondo,
                    confirmButtonColor: color_boton,

                })
            }


        }
    })

}

export {modalRestaurarBd}