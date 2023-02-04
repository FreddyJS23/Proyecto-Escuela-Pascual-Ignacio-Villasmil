const formulario = document.getElementById("formulario"),
    input = document.querySelectorAll("#formulario input"),
    label = document.querySelectorAll("#formulario label"),
    select = document.querySelectorAll("#formulario select");


/* ------------------------- identificar formularios ------------------------- */
let inscripcion = document.getElementById("inscripcion");
let inscripcionRegular = document.getElementById("inscripcionRegular");
let editar_estu = document.getElementById("editar_estu");
let editar_repre = document.getElementById("editar_repre");
let repre_nuevo = document.getElementById("repre_nuevo");
let inscripcion_profesor = document.getElementById("inscripcion_profesor");
let editar_profe = document.getElementById("editar_profe");
let asignar_profe = document.getElementById("asignar_profe");
let formulario_usuario = document.getElementById("formulario_usuario")
let formulario_administrador = document.getElementById("formulario_administrador")
let formulario_editarUsuario = document.getElementById("formulario_editarUsuario")
//formulario login
let login = document.getElementById("form_login")

//formularios reportes
let constancia_estudio = document.getElementById("formulario_constanciaEstudio")
let constancia_inscripcion = document.getElementById("formulario_constanciaInscripcion")
let constancia_retiro = document.getElementById("formulario_constanciaRetiro")

let carta_aceptacion = document.getElementById("formulario_cartaAceptacion")
let certificado_conducta = document.getElementById("formulario_certificadoConducta")
let certificado_promocion = document.getElementById("formulario_certificadoPromocion")

/* ------------------ colores de las alertas ----------------- */

let fondo = 'rgb(240, 240, 240)';
let color_boton = 'rgb(50, 33, 218)';
let color_botonCancelar = '#d33'
let icono_pregunta = 'rgb(135, 206, 250)';
let icono_confirmar = 'rgb(173, 255, 47)';

//ventana modal de generacion de reporte

let modalReporte = () => {
    Swal.fire({
        title: 'Generando pdf',
        showConfirmButton: false,
        timer: 3000,
        didOpen: () => {
            Swal.showLoading()
        },
        background: fondo,
        timerProgressBar: true,
        showLoaderOnConfirm: true

    }).then((res) => {

        if (res.dismiss == "timer") {
            history.back();

        }
    })
}

/* -------------------------- otros identificadores ------------------------- */
//tipo de cedula estudiante V o E
let select_ci = document.getElementById("select_ci");
//ver contraseña o ocultar
let pass = document.getElementById("pass")

//input ci repre
let ci_repreExiste = document.getElementById("check_inscrito")



/* ---------------------------- formulario index o login ---------------------------- */
if (login != null) {

    login.addEventListener("submit", (e) => {

        e.preventDefault()

        let formData = new FormData(login)
        axios.post("comprobacion.php", formData).then(res => {
            if (res.data['resultado'] == "passwordIncorrecto") {

                Swal.fire({
                    icon: 'error',
                    title: 'Contraseña incorrecta',
                    background: fondo,
                    confirmButtonColor: color_boton,

                })
            }
            else if (res.data['resultado'] == "usuarioNoExiste") {

                Swal.fire({
                    icon: 'error',
                    title: 'Este usuario no existe',
                    background: fondo,
                    confirmButtonColor: color_boton,

                })
            }
            else if (res.data['resultado'] == "errorPeriodo") {

                Swal.fire({
                    icon: 'error',
                    title: 'Seleccione un periodo',
                    background: fondo,
                    confirmButtonColor: color_boton,

                })

            } else if (res.data['resultado'] == "exitoAdmin") {

                location.href = "director.php"
            }
            else if (res.data['resultado'] == "exitoUsuario") {

                location.href = "usuario.php"
            }
        })
    })
}

/* ---------------------- click para ver la contraseña ---------------------- */
if (pass != undefined) {

    pass.addEventListener("click", () => {

        let input = document.getElementById("password");
        if (input.type == "password") {
            input.setAttribute("type", "text")
            pass.classList.replace("fa-eye-slash", "fa-eye")
        } else {
            input.setAttribute("type", "password")
            pass.classList.replace("fa-eye", "fa-eye-slash")
        }
    })
}

/* --------------- agregar guiones a los numeros de telefonos -------------- */
//añadir caracteres a inputs
if (input != undefined) {

    input.forEach(input => {

        let guion = (e) => {
            let nombreInput = e.target.name;
            if (nombreInput == "tlf_estu" || nombreInput == "tlf_repre" || nombreInput == "tlf_profe") {

                if (e.target.value.length == 4) {
                    e.target.value += "-"
                }

            }
        }

        let barra = (e) => {
            let nombreInput = e.target.name;

            if (nombreInput == "periodo") {

                if (e.target.value.length == 4) {
                    e.target.value += "/"
                }

            }
        }



        /* ------------------------- primera letra mayuscula ------------------------ */

        let mayuscula = (e) => {

            //para que no ponga la primera mayusucla de las contraseñas
            if (e.target.id == "password" || e.target.id == "password2" || e.target.id == "usuario") {

            }
            else if (e.target.value.length == 1)
                e.target.value = e.target.value[0].toUpperCase()

            //prueba poner primera letra mayuscyla despues del espaci
            /* else if(e.code=="Space") {
                e.target.value=e.target.value.split()
                e.target.value=e.target.value[0].toUpperCase()
            }  */
        }

        //input.addEventListener("keyup",mayuscula)
        input.addEventListener("keypress", mayuscula)
        input.addEventListener("keypress", barra)
        input.addEventListener("keypress", guion)



    })


}


/* -------------------------- expresiones regulares ------------------------- */
const expresiones = {
    
    nombreApellido: /^[a-zA-ZÀ-ÿ\u00f1\u00d1/\sa-zA-ZÀ-ÿ\u00f1\u00d1]{3,30}$/,
    usuario: /^[a-zA-Z0-9-_#$*=?¡!]{3,20}$/,
    pass: /^[a-zA-Z0-9-_#$*=?¡!]{5,15}$/,
    ci_estu: /^\d{8,8}\d{6,6}$/,
    ci_estu2: /^\d{7,8}$/,
    ci: /^\d{7,8}$/,
    enfermedad: /^[A-Z\s?a-z]{2,30}$/,
    parentesco: /^[A-Z\s?a-z]{2,15}$/,
    tlf: /^\d{4}-\d{7,7}$/,
    sector: /^[a-zA-ZÀ-ÿ\u00f1\u00d1/\sa-zA-ZÀ-ÿ\u00f1\u00d1]+$/,
    periodo: /^\d{4}\/\d{4}$/,

};


/* ------------------------ validacion de expresiones ----------------------- */
//se crea una funcion con un parametro "e" para obtener su nombre
const validar = (e) => {
    switch (e.target.name) {
        //cuando un input tenga el siguete nombre ejecutara la siguente funcion y le pasara los 3 parametros
        case "ci_estu":

            if (select_ci.value == "ci_estu") validar_campos(expresiones.ci_estu, e.target, 'ci_estu');
            else validar_campos(expresiones.ci_estu2, e.target, 'ci_estu');

            break;
        case "nombre_estu":
            validar_campos(expresiones.nombreApellido, e.target, 'nombre_estu');
            break;
        case "apellido_estu":
            validar_campos(expresiones.nombreApellido, e.target, 'apellido_estu');

            break;
        case "enfermedad":
            validar_campos(expresiones.enfermedad, e.target, 'enfermedad');
            break;
        case "tlf_estu":
            validar_campos(expresiones.tlf, e.target, 'tlf_estu');
            break;

        case "sector_estu":
            validar_campos(expresiones.sector, e.target, 'sector_estu');
            break;

        //-----------     representante     -----------//

        case "ci_repre":

            validar_campos(expresiones.ci, e.target, 'ci_repre');
            break;
        case "nombre_repre":
            validar_campos(expresiones.nombreApellido, e.target, 'nombre_repre');
            break;
        case "apellido_repre":
            validar_campos(expresiones.nombreApellido, e.target, 'apellido_repre');

            break;
        case "parentesco":
            validar_campos(expresiones.enfermedad, e.target, 'parentesco');
            break;
        case "tlf_repre":
            validar_campos(expresiones.tlf, e.target, 'tlf_repre');
            break;
        case "sector_repre":
            validar_campos(expresiones.sector, e.target, 'sector_repre');
            break;


        //-----------     inscripcion   -----------//


        case "periodo":
            validar_campos(expresiones.periodo, e.target, 'periodo');
            break;


        //-----------    profesor    -----------//

        case "ci_profe":

            validar_campos(expresiones.ci, e.target, 'ci_profe');
            break;
        case "nombre_profe":
            validar_campos(expresiones.nombreApellido, e.target, 'nombre_profe');
            break;
        case "apellido_profe":
            validar_campos(expresiones.nombreApellido, e.target, 'apellido_profe');

            break;
        case "parentesco":
            validar_campos(expresiones.enfermedad, e.target, 'parentesco');
            break;
        case "tlf_profe":
            validar_campos(expresiones.tlf, e.target, 'tlf_profe');
            break;

        case "sector":
            validar_campos(expresiones.sector, e.target, 'sector');
            break;

        //-----------    usuario    -----------//

        case "usuario":
            validar_campos(expresiones.usuario, e.target, 'usuario');
            break;
        case "password":
            validar_campos(expresiones.pass, e.target, 'password');
            validarPass();
            break;

        case "password2":
            validarPass();
            break;

        case "nombre":
            validar_campos(expresiones.nombreApellido, e.target, 'nombre');
            break;
        case "apellido":
            validar_campos(expresiones.nombreApellido, e.target, 'apellido');
            break;
    }
}


//   funcion que recibe los 3 parametros "la expresion,el input, el nombre del campo"

const validar_campos = (expresiones, input, campo) => {


    if (expresiones.test(input.value)) {
        document.getElementById(`${campo}`).classList.remove("input_error");
        document.getElementById(`label_${campo}`).classList.remove("label_error");
    } else {
        document.getElementById(`${campo}`).classList.add("input_error");
        document.getElementById(`label_${campo}`).classList.add("label_error");

    }
}


//funcion de pass2 para comprobar que las dos contraseñas sean iguales
const validarPass = () => {


    const inputPass1 = document.getElementById("password");
    const inputPass2 = document.getElementById("password2");

    if (inputPass1.value !== inputPass2.value) {


        document.getElementById("password2").classList.add("input_error");

        document.getElementById(`label_password2`).classList.add("label_error");

    } else {


        document.getElementById("password2").classList.remove("input_error");

        document.getElementById(`label_password2`).classList.remove("label_error");
    }
}


if (formulario != undefined ) {


    //por cada input allado ejecutara la siguente funcion
    input.forEach((input) => {

        //evento que se ejecuta cada vez que se levante la tecla
        input.addEventListener("keyup", validar);

        //evento que se ejecuta cuando se da click afuera dle objeto
        input.addEventListener("blur", validar);

        input.addEventListener("mouseover", validar);



    })
}



//añadir clase error a selects vacios
if (select != undefined) {
    select.forEach((select) => {

        const validar_select = () => {
            if (select.value == 0) {

                select.classList.add("select_error");

            } else {
                select.classList.remove("select_error");
            }
        }

        select.addEventListener("blur", validar_select)
        select.addEventListener("change", validar_select)
    }

    )
}

/* ------------ comprobar que los inpust y select no esten vacios ----------- */
let comprobarInputSelect = () => {
    let ok;
    //vairable input con clase error
    let input_error = document.getElementsByClassName("input_error")
    let select_error = document.getElementsByClassName("select_error")
    //comprobar selects con error

    if (formulario_usuario != undefined || formulario_editarUsuario != undefined || formulario_administrador != undefined) {

        input.forEach(input => {
          

            if (input == 0 || input_error.length >= 1) {

                ok = false
                Swal.fire({
                    icon: 'error',
                    title: 'Carecteres invalidos',
                    confirmButtonColor: color_boton


                })
            } else {
                ok = true
            }

        })
    }


    select.forEach(select => {


        if (select.value == 0 || select_error.length >= 1 ) {
           
            ok = false
            Swal.fire({
                title: "Rellene todos los campos",
                icon: "error",
                confirmButtonColor: color_boton

            })

            //comprobar inputs
        } else if (input_error.length >= 1) {
            
            ok = false
            Swal.fire({
                icon: 'error',
                title: 'Carecteres invalidos',
                confirmButtonColor: color_boton


            })

        }

        else {

            ok = true


        }

    })

    return ok


}


/* -----------------------------evitar error de campos vacio en disable con check ---------------------------- */
if (ci_repreExiste != undefined) {
    ci_repreExiste.addEventListener("click", () => {

        if (ci_repreExiste.checked) {
            document.getElementById("nombre_repre").setAttribute("disabled", "true")
            document.getElementById("apellido_repre").setAttribute("disabled", "true")
            document.getElementById("fn_repre").setAttribute("disabled", "true")
            document.getElementById("tlf_repre").setAttribute("disabled", "true")
            document.getElementById("sx_repre").setAttribute("disabled", "true")
            document.getElementById("estado_repre").setAttribute("disabled", "true")
            document.getElementById("municipio_repre").setAttribute("disabled", "true")
            document.getElementById("parroquia_repre").setAttribute("disabled", "true")
            document.getElementById("sector_repre").setAttribute("disabled", "true")

            //quitar clases de error con checked on
            document.getElementById("nombre_repre").classList.remove("input_error")
            document.getElementById("apellido_repre").classList.remove("input_error")
            document.getElementById("tlf_repre").classList.remove("input_error")
            document.getElementById("sector_repre").classList.remove("input_error")
            
            document.getElementById("label_nombre_repre").classList.remove("label_error")
            document.getElementById("label_apellido_repre").classList.remove("label_error")
            document.getElementById("label_tlf_repre").classList.remove("label_error")
            document.getElementById("label_sector_repre").classList.remove("label_error")

            //cambiar valores de select para evitar bug de campos vacios
            document.getElementById("sx_repre").options[0].value=99
            document.getElementById("estado_repre").options[0].value=99
            document.getElementById("municipio_repre").options[0].value=99
            document.getElementById("parroquia_repre").options[0].value=99
            


        } else {
            document.getElementById("nombre_repre").removeAttribute("disabled")
            document.getElementById("apellido_repre").removeAttribute("disabled")
            document.getElementById("fn_repre").removeAttribute("disabled")
            document.getElementById("tlf_repre").removeAttribute("disabled")
            document.getElementById("sx_repre").removeAttribute("disabled")
            document.getElementById("estado_repre").removeAttribute("disabled")
            document.getElementById("sector_repre").removeAttribute("disabled")


        }


    })

}




if (formulario != undefined) {
    //agregar evento a todos los formulario o form que ten el id formulario
    formulario.addEventListener("submit", (e) => {
        //previene el evento por defecto de submi que recarga la pagina
        e.preventDefault()
        //llamar funcion para comprobar
        comprobarInputSelect()
        
        
        if (comprobarInputSelect() == true) {


            //variable formdata,dentro va el formulario que permite enviar todos los datos de un formulario clave:valor
            let formData = new FormData(formulario)

            /* -------------------------------formulario inscripcion ------------------------------ */
            //esquema
            //cada formulario tiene un input oculto que ayuda a identificar cuando se este en ese formulario para evitar errores y tener un mejor control
            if (inscripcion != null) {
                //envio axios con metoto post,acepta dos parametros, el primero la url, el segundo los datos a enviar en este caso el formdata que tendra todos los datos del formulario clave valor
                //con .then(res=>{}) administro la peticion, en el php al insertar los datos mando una series de respuesta dependiendo si insertaron los datos
                axios.post("../registros/registro_inscripcion.php", formData).then(res => {
                    //"res"es la repsuesta total de la peticion con encabezados, con res.data accedo solo a la data recibida de la peticion
                    //condicionales de respuesta dependiedno de la inserccion de los datos
                    //een caso que haya un error al insertar los datos del estudiante
                    if (res.data['respuesta'] == "errorEstudiante") {
                        //modal de avertencia
                        Swal.fire({
                            icon: 'error',
                            title: 'Error con los datos del estudiante',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de haber llenado todos los campos o de no estar registrado'
                        })
                    }
                    //caso que haya error con datos del representante
                    else if (res.data['respuesta'] == "errorRepresentante") {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error con los datos del representante',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de haber llenado todos los campos o de no estar registrado'
                        })
                    }
                    //caso en el que estudiante ya este inscrito
                    else if (res.data['respuesta'] == "existeEstu") {

                        Swal.fire({
                            icon: 'error',
                            title: 'El estudiante ya esta inscrito',
                            background: fondo,
                            confirmButtonColor: color_boton,

                        })
                    }
                    //caso en el que representante ese inscrito
                    else if (res.data['respuesta'] == "existeRepre") {

                        Swal.fire({
                            icon: 'error',
                            title: 'El representante ya esta inscrito',
                            background: fondo,
                            confirmButtonColor: color_boton,

                        })
                    }
                    else if (res.data['respuesta'] == "repreNoExiste") {

                        Swal.fire({
                            icon: 'error',
                            title: 'El representante no esta inscrito',
                            background: fondo,
                            confirmButtonColor: color_boton,

                        })
                    }
                    //caso en que haya un error en la inscripcion
                    else if (res.data['respuesta'] == "errorInscripcion") {

                        Swal.fire({
                            icon: 'error',
                            title: 'No se ha completado la inscripcion',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de haber llenado todos los campos correctamente'
                        })
                    }
                    //caso en que todo haya funcionado
                    else if (res.data['respuesta'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Inscripcion completada',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar

                            //los modales pueden recibir una promesa,en este caso hace un reset de todos los campos del formulario
                        }).then(res => {
                            formulario.reset()
                        })
                    }


                })
            }

            /* ---------------------------formulario inscripcion regular -------------------------- */

            if (inscripcionRegular != null) {


                axios.post("../registros/registro_inscripcion_regular.php", formData).then(res => {

                    if (res.data['resultado'] == "noRepre") {
                       
                        //input cedula estudiante referencia pare inscribir representante en caso de que no este inscrito
                        let ci_estu=document.getElementById("ci_estu")
                        let ci_repre=document.getElementById("ci_repre")

                        Swal.fire({
                            icon: 'error',
                            title: 'Representante no inscrito',
                            html: `Puede inscribir un representante<a class="link_reporte" href="../formularios/formulario_repre_nuevo.php?ci_estu=${ci_estu.value}&ci_repre=${ci_repre.value}"> Aquí</a> `,
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de que el representante este registrado'
                        })
                    }
                    else if (res.data['resultado'] == "noEstu") {

                        Swal.fire({
                            icon: 'error',
                            title: 'Estudiante no inscrito',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de que el estudiante este registrado'
                        })
                    } else if (res.data['resultado'] == "existeEstu") {

                        Swal.fire({
                            icon: 'error',
                            title: 'Estudiante ya inscrito',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Este estudiante ya se inscribio previamente en el periodo actual'
                        })
                    }
                    else if (res.data['resultado'] == "errorParentesco") {

                        Swal.fire({
                            icon: 'error',
                            title: 'Parentesco no registrado',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de haber registrado al representante y al estudiante'
                        })
                    }
                    else if (res.data['resultado'] == "errorInscripcion") {

                        Swal.fire({
                            icon: 'error',
                            title: 'No se ha completado la inscripcion',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese que todos los campos esten correctos'
                        })
                    }
                    else if (res.data['resultado'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Inscripcion completada',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar

                        }).then(res => {
                           location.href="formulario_regular.php"
                        })
                    }
                })


            }
          
          
            /* ---------------------- formulario editar datos estudiante ---------------------- */
            if (editar_estu != null) {
                //esquema, aplica para todas las ediciones
                axios.post("../editar/editar_estu.php", formData).then(res => {
                    if (res.data['resultado'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Edicion completada',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar

                        }).then(res => {
                            //hago un redirecionamiento a la siguente url pasado los 900 milisegundos
                            setTimeout(location.href = "../consultas/consultar_estu.php", 900)
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se ha completado la edicion',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese que todos los campos esten correctos'
                        })
                    }
                })
            }
            
            
            /* ---------------------- formulario editar datos representante---------------------- */
            if (editar_repre != null) {

                axios.post("../editar/editar_repre.php", formData).then(res => {
                    if (res.data['resultado'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Edicion completada',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar

                        }).then(res => {

                            setTimeout(location.href = "../consultas/consultar_estu.php", 900)
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se ha completado la edicion',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese que todos los campos esten correctos'
                        })
                    }
                })
            }
           
           
            /* ---------------------- formulario inscribir representate nuevo en formulario regular ---------------------- */
            if (repre_nuevo != null) {

                axios.post("../registros/registro_repre_nuevo.php", formData).then(res => {
                    if (res.data['resultado'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Representante Inscrito',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar

                        }).then(ress => {
                            
                            let ci_repre=res.data['ci_repre'];
                            let url=`formulario_regular.php?id=${ci_repre}`
                            setTimeout(location.href=url, 900) 
                        })
                    } else if (res.data['resultado'] == "existeRepresentante") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Esta cedula ya esta registrada',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese que todos los campos esten correctos'
                        })
                    }
                    else if (res.data['resultado'] == "errorRepresentante") {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se ha completado la inscripcion' ,
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese que todos los campos esten correctos'
                        })
                    }
                })
            }

            /* --------------------------- formulario profesor -------------------------- */
            if (inscripcion_profesor != undefined) {

                axios.post("../registros/registro_profe.php", formData).then(res => {

                    if (res.data['resultado'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Inscripcion completada',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar
                        }).then(res => {
                            formulario.reset()
                        }
                        )

                    } else if ((res.data['resultado'] == "existeProfe")) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Este profesor ya esta inscrito',
                            background: fondo,
                            confirmButtonColor: color_boton,

                        })
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se ha completado la inscripcion',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese que todos los campos esten correctos'
                        })
                    }
                })

            }
            /* ----------------------- formulario editar profesor ----------------------- */
            if (editar_profe != undefined) {

                axios.post("../editar/editar_profe.php", formData).then(res => {
                    if (res.data['resultado'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Edicion completada',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar
                        }).then(res => {
                            location.href = "../consultas/consultar_profe.php"
                        }
                        )

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se ha completado la edicion',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese que todos los campos esten correctos'
                        })
                    }
                })

            }
            /* ------------------- asignar secciones a los profesores ------------------ */
            if (asignar_profe != undefined) {
                axios.post("../registros/registro_asignacion.php", formData).then(res => {
                    if (res.data['resultado'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Asignacion completada',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar
                        }).then(res => {
                            formulario.reset()
                        })
                    }else if(res.data['resultado'] == "profesorAsignado") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Este profesor ya fue asignado',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de que el profesor no este asignado en este periodo'
                        })
                    } 
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Este profesor no esta inscrito',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de estar registrado'
                        })
                    }
                })

            }
            /* --------------------------- formulario usuario --------------------------- */
            if (formulario_usuario != undefined) {

                axios.post("../registros/registro_usuario.php", formData).then(res => {
                    if (res.data['resultado'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Usuario registrado',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar
                        }).then(res => {
                            formulario.reset()
                        })
                    } else if (res.data['resultado'] == "usuarioExiste") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Este usuario ya existe',
                            background: fondo,
                            confirmButtonColor: color_boton,


                        })
                    }else if (res.data['resultado'] == "profeTieneUsuario") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Este profesor ya tiene un usuario',
                            background: fondo,
                            confirmButtonColor: color_boton,


                        })
                    } 
                    else if (res.data['resultado'] == "noExisteProfe") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Este profesor no esta registrado',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de que el profesor este registrado'

                        })
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Usuario no registrado',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de completar todos los campos'
                        })
                    }

                })
            }


            /* --------------------------- formulario administrador --------------------------- */
            if (formulario_administrador != undefined) {

                axios.post("../registros/registro_administrador.php", formData).then(res => {
                    if (res.data['resultado'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Administrador registrado',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar
                        }).then(res => {
                            location.href = "../index.html"
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se ha completado el registro',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese de completar todos los campos'
                        })
                    }

                })
            }



            /* ----------------------------- editar usuarios ---------------------------- */
            if (formulario_editarUsuario != undefined) {
                alert("hsis")
                axios.post("../editar/editar_usuario.php", formData).then(res => {
                    if (res.data['resultado'] == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Edicion completada',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            iconColor: icono_confirmar
                        }).then(res => {
                            location.href = "../consultas/consultar_usuario.php"
                        })
                    } else if (res.data['resultado'] == "error") {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se ha completado la edicion',
                            background: fondo,
                            confirmButtonColor: color_boton,
                            footer: 'Asegurese que todos los campos esten correctos'


                        })
                    }

                })
            }

            /* --------------------------- constancias-------------------------- */
            if (constancia_estudio != undefined) {
                axios.post("../reportes/constancias/constancia_estudio.php", formData)


                modalReporte()
            }
            if (constancia_inscripcion != undefined) {
                axios.post("../reportes/constancias/constancia_inscripcion.php", formData)

                modalReporte()


            }
            if (constancia_retiro != undefined) {
                axios.post("../reportes/constancias/constancia_retiro.php", formData)


                modalReporte()
            }


            /* --------------------------- certificados-------------------------- */
            if (carta_aceptacion != undefined) {
                axios.post("../reportes/certificados/carta_aceptacion.php", formData)


                modalReporte()
            }
            if (certificado_conducta != undefined) {
                axios.post("../reportes/certificados/certificado_conducta.php", formData)

                modalReporte()


            }
            if (certificado_promocion != undefined) {
                axios.post("../reportes/certificados/certificado_promocion.php", formData).then(res=>{
                 if(res.data.resultado=="noCursoGrado"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Este estudiante no es apto para la carta de promocion',
                        background: fondo,
                        confirmButtonColor: color_boton,
                        footer: 'Este estudiante no cumple con el requisito de haber cursado sexto grado'
                    }).then((res) => {
                history.back()
                       
                    })
                 }
                })


             
            }




        }


    })

}





/* 
 let asignados=document.querySelector(".asignados")

 let grid=new gridjs.Grid({

     columns:[
   
  
   {id:'apellido_profe' ,name:'apellido',width:'90px'},
   {id:'grado' ,name:'grado',width:'80px'},
   {id:'seccion' ,name:'seccion',width:'80px'},
 ],
 data:[],
 style:{
     table:{
         width:'300px'
     }
 }
}).render(asignados) 


const verAsignados=()=>{ 
 axios("../ajax/php.php",{
     params:{asignacion:true}}).then(res=>{
       
       grid.updateConfig({

         data:()=>{
             return new Promise(resolve=>{
                 setTimeout(()=>resolve(res.data),1000)
             })
         }
       }).forceRender()

     })
}

verAsignados()
 */

