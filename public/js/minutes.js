var minutos = []
var value=[]
var highlimit=[]
var lowlimit=[]

var var_name = $('#var_name').val();
var idvariable = $('#idvariable').val();
var eu = $('#eu').val();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
}); 
$.ajax({
        url:'/trends/'+idvariable+'/datos',
        type:'GET',
        success:function(response){
        response.forEach(function (elemento, indice) {
            
            minutos.push(elemento['date']);
            value.push(elemento['value']);
            highlimit.push(elemento['highLimit']);
            lowlimit.push(elemento['lowLimit']);
        });
        }
});
var config = {
    type: 'line',
    data: {
        labels: minutos,
        datasets: [{
            label: "Consumo del Dia",
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: value,
            fill: false,
        }, {
            label: "Limite superior",
            fill: false,
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: highlimit,
        },
        {
            label: "Limite inferior",
            fill: false,
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: lowlimit,
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: var_name
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Minutos'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: eu
                }
            }]
        }
    }
};

window.onload = function () {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);
};
