//consultas para graficar
var var_name = $('#var_name').val();
var idmachine = $('#idmachine').val();
var date = $('#date').val();
$('#i_dia').val(date)
var maxy = 0
//var Acumulado= []


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: '/Events/' + idmachine + '/d/' + date + '/datos',
    type: 'GET',
    success: function (response) {

        chartData.labels.length = 0;
        chartData.datasets[1].data.length = 0; 
        chartData.datasets[0].data.length = 0;

        
        response[0].forEach(function (elemento, indice) {

            chartData.labels.push(elemento['descriptions'])
            chartData.datasets[1].data.push(elemento['Total'])
            //chartData.datasets[1].data.push(elemento['Porc']) //opcional sustituir por porcentajes
            chartData.datasets[0].data.push(elemento['PorcentajeAcumulado'])
            maxy = elemento['Acumulado']
            
        });
        response[1].forEach(function (elemento, indice) {

            var tr = `<tr>
                     <td>  
                     <button data-toggle="modal" data-target="#myModalEdit`+elemento['idevent']+`" type="button" class="btn btn-primary btn-circle btn-sm">
                        <i class="fas fa-fw fa-wrench"></i>
                     </button> &nbsp; 
                     </td>
                     <td>`+elemento['startTime']+`</td>
                     <td>`+elemento['endTime']+`</td>
                     <td>`+elemento['descriptions']+`</td>
                     
                     <td>`+elemento['justification']+`</td>
                     <td>`+elemento['event']+`</td>
                     <td>`+elemento['duration']+`</td>
                 </tr>`
                 $("#cuerpo").append(tr)
 
         });
        
        options.options.scales.yAxes[1].ticks.max = parseFloat(maxy)
        window.myMixedChart.update()
    }
});



var chartData = {

    labels: [],
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
var canvas = document.getElementById("canvas")
//var canvas = $("#Canvas")
var options = {
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
                    beginAtZero: true,
                    //max: 101
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
}

window.onload = function () {
    window.myMixedChart = new Chart(canvas, options);

}




