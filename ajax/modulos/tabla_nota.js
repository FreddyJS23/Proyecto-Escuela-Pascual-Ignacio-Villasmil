
//esquema 
/* los primeros 5 parametos son para el 
diseño
idioma
hover
contenedor de la tabla 
url de la peticion al servidor
 
los otros 4 parametros enviados es el diseño de la alerta
 
fondo de la alerta
color del boton confirmar
icono de la alerta
color del icono de la alerta

*/

const tablaNota = (diseno, espanol, hover, divNota, url,    fondo, color_boton, icono_pregunta, icono_confirmar) => {
    //se inicializa la funcion o la libreria grid.js
    //cabe destacar que las configuracion son tipo objeto 
    let grid = new gridjs.Grid({
        //declara columnas
        columns: [
            //se espera que la respuesta del serviror sea tipo json es decir clave:valor el gridjs se encargara de ordenarlo segun su nombre en el id, cada columna tendra una id para identificar que valor corresponde
            //sort false es para evitar el ordenamiento en esa columna
            { id: 'periodo', name: 'Periodo', sort: false },
            { id: 'grado', name: 'Grado' },
            { id: 'ci_estu_inscripcion', name: 'Cedula', sort: false },
            { id: 'nombre_estu', name: 'Nombre', sort: false },
            { id: 'apellido_estu', name: 'Apellido', sort: false },
            {
                //columna especial que tendra una funcion para cada  elemento dentro de la columna
                name: 'Literal',
                sort: false,
                //declarar funcion con formatter con los parametos cell y row
                formatter: (cell, row) => {
                    //inicializar boton como un array para poder devolver varios botones a la vez
                    let bton = []
                    /* configuaciones de los botones, gridj.h()permite 3 parametros, 
                    el primero el tipo de elemento html a crear, 
                    el segundo un odjetos con sus atributos, 
                    el tercero el texto que llevara */
                    bton[0] = gridjs.h('button', {
                        className: 'nota-seccion',
                        /*   añadir evento click con una funcion que llevara dos parametros en un array,
                        el primero sera el literal que ocupara la posicion [0], el segundo sera la cedula para identificarlo que sera [1]
                        row.cells[2].data significa que llamara los datos que este en la columna con posicion [2] es decir la columna numero 3 
                        el resto de parametos son los diseños de las alertas
                        
                        */
                        onClick: () => editarNota(["A", `${row.cells[2].data}`],    grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
                    }, 'A')
                    bton[1] = gridjs.h('button', {
                        className: 'nota-seccion',
                        onClick: () => editarNota(["B", `${row.cells[2].data}`],    grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
                    }, 'B')
                    bton[2] = gridjs.h('button', {
                        className: 'nota-seccion',
                        onClick: () => editarNota(["C", `${row.cells[2].data}`],    grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
                    }, 'C')
                    bton[3] = gridjs.h('button', {
                        className: 'nota-seccion',
                        onClick: () => editarNota(["D", `${row.cells[2].data}`],    grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
                    }, 'D')
                    bton[4] = gridjs.h('button', {
                        className: 'nota-seccion',
                        onClick: () => editarNota(["E", `${row.cells[2].data}`],    grid, url, fondo, color_boton, icono_pregunta, icono_confirmar)
                    }, 'E')
                    //devolver el array es decir 5 botones
                    return bton;
                }
            }],
        //se inicializa data pero vacio, si no se inicializa dara error
        data: [],
        //estilo de la tabla
        style: diseno,
        //habilitar ordenamiento de las columnas
        sort: true,
        //habilidar paginacion
        pagination: true,
        //habilitar cabecera fija mienstra se hace scroll
        heigt: '400px',
        fixedHeader: true,
        //lenguaje de la tabla
        language: espanol,
        //dar clase algunos elementos para tener un hover
        className: hover
        //al final de crear una grid.js se tinene que declarar el lugar donde se pondra la tabla,tendra que ser un div vacio en este caso en el divnota
    }).render(divNota)

    /* se llama la funcion enviando los parametros 
    url la direccion del servidor
    grid es la variable que contiene la tabla ya plasmada pero vacia */
    consultarNotas(url, grid)

}


//funcion para obteber las notas
const consultarNotas = (url, grid) => {
    //peticion
    //se utiliza el parametro recibido url
    axios(url, {
        params: {
            //valores de la peticion
            ajax_notas: true

        }
        //administrar respuesta de la peticion
    }).then(res => {
        
        //se utiliza el parametro recibido grid que es la tabla pero vacia
        //ya que la tabla se declaro previamente pero vacia,se le hara un update con los datos recibidos de la peticion
         grid.updateConfig({
            //data puede recibir una funcion o ir directamente data:res.data,
            //se retorna data como promesa para tener una estado de carga de la tabla
            data: () => {
                return new Promise(resolve => {
                    //la tabla tardara 300 milesegundo antes de carga la informacion
                    setTimeout(() => resolve(res.data), 300)
                })
            }
            //igual como render hay que añadir los datos al div, pero en este caso tomara los que se haya retomado en render
        }).forceRender();

    });
};


//funcion de los botones de las columna para editar nota
//se crea y se declara funcion para editar la nota, recibira un parametro en este caso data,que sera un array
//el resto de parametros son los diseño de la alerta
let editarNota = (data,  grid, url, fondo, color_boton, icono_pregunta, icono_confirmar) => {
    //inicializar venta modal, recibe sus configuacion como un objeto

    Swal.fire({
        //titulo del modal entre comillas
        title: 'Esta seguro?',
        //texto del modal entre comillas
        text: "Desea asignar el literal al estudiante?",
        //icono del modal, entre comillas
        icon: 'question',
        //habilitar boton de cancelar
        showCancelButton: true,
        //fondo del modal
        background: fondo,
        //color del boton confirmar del modal
        confirmButtonColor: color_boton,
        //color del icono
        iconColor: icono_pregunta,
        //color del botn cancelar
        cancelButtonColor: '#d33',
        //texto del boton cancelar y confirmar
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar'
    }).then((result) => {
        //depende del boton recibe una promesa, en este caso si se da en el boton confimar
        if (result.isConfirmed) {
            //peticion
            axios(url, {
                params: {
                    //paramettos de la peticion, en este caso como data es un array se accede a sus posiciones
                    ci_estu_nota: data[1],
                    literario: data[0]
                }
                //administrar respuesta
            }).then(res => {
                //administra respuesta del servidor si recibe exito o no
                if (res.data.resultado == "exito") {
                    //modal
                    Swal.fire({
                        icon: 'success',
                        title: 'Literal asignado',
                        iconColor: icono_confirmar,
                        //el modal se cerrara en 800 milisegundos
                        timer: 800,
                        //ocultar boton de confirmar
                        showConfirmButton: false

                    })
                    //llama la funcion para actualizar la tabla una vez se asigne la nota
                    consultarNotas(url, grid)
                }
                else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Literal no asignado',
                        timer: 800,
                        showConfirmButton: false

                    })

                }
            }).catch(err => console.log(err))

        }
    }


    )
}


export { tablaNota }