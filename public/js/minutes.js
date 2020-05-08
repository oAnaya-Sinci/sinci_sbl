var var_name = $('#var_name').val();
var idvariable = $('#idvariable').val();
var eu = $('#eu').val();

$(document).ready(function()
{  
    $("input[name=dia]").change(function () {
        var date = $('#i_dia').val();	 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
            }
        }); 
        $.ajax({
                url:'/trends/'+idvariable+'/d/'+date+'/datos',
                type:'GET',
                success:function(response){
                    config.data.labels.length=0;
                    config.data.datasets[0].length=0;
                    config.data.datasets[1].length=0;
                    config.data.datasets[2].length=0;
                response.forEach(function (elemento, indice) {
                    
                    config.data.labels.push(elemento['date']);
                    config.data.datasets[0].data.push(elemento['value'])
                    config.data.datasets[1].data.push(elemento['highLimit'])
                    config.data.datasets[2].data.push(elemento['lowLimit'])

                });
                               
                window.myLine.update()
                }
        });

    });
    $("input[name=mes]").change(function () {	 
        var date = $('#i_mes').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
            }
        }); 
        $.ajax({
                url:'/trends/'+idvariable+'/m/'+date+'/datos',
                type:'GET',
                success:function(response){
                    config.data.labels.length=0;
                    config.data.datasets[0].length=0;
                    config.data.datasets[1].length=0;
                    config.data.datasets[2].length=0;
                response.forEach(function (elemento, indice) {            
                    config.data.labels.push(elemento['date']);
                    config.data.datasets[0].data.push(elemento['value'])
                    config.data.datasets[1].data.push(elemento['highLimit'])
                    config.data.datasets[2].data.push(elemento['lowLimit'])

                });
                
                
                window.myLine.update()
                }
        });
    });
   
});
var config = {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: "Consumo del Dia",
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: [],
            fill: false,
        }, {
            label: "Limite superior",
            fill: false,
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [],
        },
        {
            label: "Limite inferior",
            fill: false,
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [],
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
    ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);
};
