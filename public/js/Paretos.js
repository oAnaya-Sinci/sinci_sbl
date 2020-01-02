//consultas para graficar
var var_name = $('#var_name').val();
var idmachine = $('#idmachine').val();
var eu = "";
var date = $('#date').val(); 
$('#i_dia').val(date)



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    /*url: '/Events/' + idmachine + '/d/' + date + '/datos',*/
    url: '/Events/' + idmachine + '/d/' + '2020-01-01' + '/datos',
    type: 'GET',
    success: function (response) {
        
        console.log(response)
        
       
       
    }
});



var chartData = {
    /*labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],*/ //OPCION 1 CON NUMEROS Y LABELS AL LADO
    /*labels: ["Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh", "Temperatura Bulbo HumedoHigh"],*/  //WORST CASE LOOOOONG LABELS
    labels: ['PesoLow', 'PresiónHigh', 'Temperatura Bulbo HumedoHigh', 'Consumo de EnergíaHigh', 'Cantidad de IngredientesLow', 'PesoHigh', 'Tiempo de OperaciónLow', 'Temperatura Bulbo SecoLow',
        'MotorXFallaElect',
        'Cantidad de IngredientesHigh',
        'TemperaturaHigh',
        'PresiónLow',
        'RitmoLow',
        'Sincronizacion A-BLow',
        'ValvulaXFallaAlAbrir',
        'NivelLow',
        'MotorXFallaCom',
        'Tiempo de Operaci,ónHigh',
        'Temperatura Bulbo HumedoLow',
        'RitmoHigh',
        'Sincronizacion A-BHigh',
        'MotorXFallaNoRetro',
        'NivelHigh',
        'ValvulaXFallaAlCerrar',
        'ValvulaXFallaGeneral',
        'TemperaturaLow',
        'MotorXFallaGral'
    ],
    datasets: [{
        type: 'line',
        label: 'Porcentaje Acumulado',
        borderColor: window.chartColors.blue,
        borderWidth: 2,
        fill: false,
        data: [8, 16, 22, 28, 34, 40, 45, 49, 54, 58, 62, 66, 69, 73, 76, 80, 82, 85, 87, 89, 90, 92, 94, 96, 97, 99, 100], //Porcentaje acumulado
        yAxisID: "y-axis1"
    }, {
        type: 'bar',
        label: 'Frecuencias',
        backgroundColor: window.chartColors.green,
        data: [9, 9, 7, 7, 7, 7, 5, 5, 5, 5, 5, 4, 4, 4, 4, 4, 3, 3, 2, 2, 2, 2, 2, 2, 2, 2, 1], //Frecuencia
        yAxisID: "y-axis2",
    }]

};
var canvas  = document.getElementById("canvas")
//var canvas = $("#Canvas")
window.myMixedChart = new Chart(canvas, {
    type: 'bar',
    data: chartData,
    options: {

        defaultFontSize: 20,

        responsive: true,
        legend: {
            labels: {
                defaultFontSize: 1,
            }
        },
        title: {
            display: true,
            text: 'Pareto'
        },

        tooltips: {
            mode: 'index',
            intersect: true
        },

        scales: {
            xAxes: [{
                ticks: {
                    autoSkip: false,
                    autoSkipPadding: 0
                }
            }],

            yAxes: [{
                id: "y-axis1",
                position: "right",
                ticks: {
                    beginAtZero: true
                },
                gridLines: {
                    offsetGridLines: false
                }

            },
            {
                display: true,
                id: "y-axis2",
                ticks: {
                    beginAtZero: true
                },

                gridLines: {
                    offsetGridLines: false,

                }
            }
            ]

        },
        plugins: {
            datalabels: {
                color: 'Black',
                anchor: 'end',
                align: 'end',
                offset: -5,

                font: {
                    weight: 'bold'
                },
                
            }
        },
    }
});

   


