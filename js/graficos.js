let graficoProfesores = document.getElementById("graficoProfesor")
let graficoEstudiantes= document.getElementById("graficoEstudiante")
let graficoGrados= document.getElementById("graficoGrado")

axios("consultas/consulta_data_graficos.php",{
    params:{dataGrafico:true}
}).then(res=>{


let primero=parseInt(res.data[6].total_primero)
let segundo=parseInt(res.data[7].total_segundo)
let tercero=parseInt(res.data[8].total_tercero)
let cuarto=parseInt(res.data[9].total_cuarto)
let quinto=parseInt(res.data[10].total_quinto)
let sexto=parseInt(res.data[11].total_sexto)


let promedioEstudianteGrado=primero+segundo+tercero+cuarto+quinto+sexto 


let grafico1= new Chart(graficoProfesores, {
    type: 'pie',
    data: {
        labels: ['Activos', 'Inactivos'],
        datasets: [{
            label: 'Profesores',
            data: [`${res.data[1].total_activos}`, `${res.data[2].total_inactivos}`]
           
        }]
    },
    options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
            labels:{
                color:'black',
                font:{
                    weight:'500',
                    
                }
            }
          },
          title: {
            display: true,
            text: `Profesores Inscritos: ${res.data[0].total_profes} `,
            font:{
              weight:'700',   
          },
          color:'black'
          },
          
        }
      },
});



let grafico2 = new Chart(graficoEstudiantes, {
    type: 'pie',
    data: {
        labels: ['Niños', 'Niñas'],
        datasets: [{
            label: 'Estudiantes',
            data: [`${res.data[4].estudiantes_masculinos}`,`${res.data[5].estudiantes_femeninos}` ],
           
        }]
    },options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
            labels:{
                color:'black',
                font:{
                    weight:'500',
                    
                }
            }
          },
          title: {
            display: true,
            text: `Estudiantes Inscritos: ${res.data[3].total_estudiantes} `,
            font:{
              weight:'700',   
          },
          color:'black'
          }
        }
      },
});



let grafico3 = new Chart(graficoGrados, {
    type: 'pie',
    data: {
        labels: ["Primer grado","Segundo grado","Tercero grado","Cuarto grado","Quinto grado","Sexto grado"],
        datasets: [{
            label:"Total",
            data: [
            `${res.data[6].total_primero}`,
            `${res.data[7].total_segundo}`,
            `${res.data[8].total_tercero}`,
            `${res.data[9].total_cuarto}`,
            `${res.data[10].total_quinto}`,
            `${res.data[11].total_sexto}`
        ],
            
        }]
    },options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
            labels:{
                color:'black',
                font:{
                    weight:'500',
                    
                }
            }
          },
          title: {
            display: true,
            text: `Estudiantes inscritos por grado`,
            font:{
              weight:'700',   
          },
          color:'black'
          },
          subtitle: {
            display: true,
            text: `Hay un promedio de ${Math.round(promedioEstudianteGrado / 6)} estudiantes por grado  `,
            font:{
              weight:'700',   
          }
          }
        }
      },
});

})

