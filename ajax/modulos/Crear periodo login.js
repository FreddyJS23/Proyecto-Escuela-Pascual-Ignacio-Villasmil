//consulta periodos en selects

let select = document.getElementById("periodo")
let consultarPeriodo = () => {
    axios("ajax/php.php", {
        params: { ajax_periodo: true }
    }).then(res => {

        let html = '<option value="0">Selecione un periodo</option>'
        html += '<option value="todos">Todos</option>'
        res.data.forEach(periodo => {

            html += ` <option value="${periodo['id_periodo']}">${periodo['periodo']}</option>`
            select.innerHTML = html

        })
    })
}


//evento al boton
let modalCrearPeriodo = (e) => {

    Swal.fire({
        title: 'Crear periodo',
        html: ` <input class="input crearPeriodo"  type="text" placeholder=" " autocomplete="off" id="periodo" name="periodo"
    maxlength="9" title="Use el formato 2021/2022" >`,
        icon: 'info',
        showCloseButton: true,
        background: fondo,
        confirmButtonColor: color_boton,
        confirmButtonText: 'Confirmar',
        footer: '<b>Formato: 2021/2022</b>',
        showLoaderOnConfirm: true,
        //evaluar antes de enviar los datos
        preConfirm: () => {

            let periodo = Swal.getPopup().querySelector("#periodo").value
            let expresion = /^\d{4}\/\d{4}$/

            let comprobar = expresion.test(periodo)
            if (!comprobar) {
                Swal.showValidationMessage(`Formato invalido`)
            } else {

                return axios("registros/registro_periodo.php", {
                    params: { 'periodo': `${periodo}` }
                }).then(res => {

                    return res.data

                }).catch(err => {

                    Swal.showValidationMessage(err)

                })
            }
        },

    }).then((res) => {

        if (res.value.resultado == "exito") {
            consultarPeriodo()
            Swal.fire({
                icon: 'success',
                title: 'Periodo creado',
                background: fondo,
                confirmButtonColor: color_boton,
                iconColor: icono_confirmar
            })
        } else if (res.value.resultado == "error") {

            Swal.fire({
                icon: 'error',
                title: 'No se ha creado el periodo',
                background: fondo,
                confirmButtonColor: color_boton,

            })
        } else if (res.value.resultado == "periodoExiste") {

            Swal.fire({
                icon: 'error',
                title: 'Este periodo ya esta registrado',
                background: fondo,
                confirmButtonColor: color_boton,

            })
        }

    }).catch(err => {
        console.log(err)
    })




}


export { consultarPeriodo, modalCrearPeriodo }