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
        response.forEach(function(elemento, indice){
           
            //console.log(elemento['descriptions'])
            chartData.labels.push(elemento['descriptions'])
            chartData.datasets[1].data.push(elemento['Frecuencia'])
            chartData.datasets[0].data.push(elemento['PorcentajeAcumulado'])
        });
       
        window.myMixedChart.update()
    }
});



 chartData = {
   
    labels: [ ],
    datasets: [{
        type: 'line',
        label: 'Porcentaje Acumulado',
        borderColor: window.chartColors.blue,
        borderWidth: 2,
        fill: false,
        data: [], //Porcentaje acumulado
        yAxisID: "y-axis1"
    }, {
        type: 'bar',
        label: 'Frecuencias',
        backgroundColor: window.chartColors.green,
        data: [], //Frecuencia
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

   


