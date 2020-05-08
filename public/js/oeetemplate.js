//consultas para graficar
var var_name = $('#var_name').val();
var idmachine = $('#idmachine').val();
var eu = "";
var date = $('#date').val();
var ejex = "Dia";
var etiq = "Consumo del Día";	 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
            }
        }); 
        $.ajax({
                url:'/oee/'+idmachine+'/d/'+date+'/datos',
                type:'GET',
                success:function(response){
                   
                    config.data.labels.length=0;
                    config.data.datasets[0].length=0;
                    config.data.datasets[1].length=0;
                    config.data.datasets[2].length=0;
                response.forEach(function (elemento, indice) {
                    console.log(elemento,indice)

                    config.data.labels.push(elemento[0]['date']);
                    config.data.datasets[0].data.push(elemento['availability'])
                    config.data.datasets[1].data.push(elemento['performance'])
                    config.data.datasets[2].data.push(elemento['quality'])
                    config.data.datasets[3].data.push(elemento['oee'])

                });
                               
                window.myLine.update()
                }
        });

$(document).ready(function()
{  
    $("input[name=dia]").change(function () {
        var date = $('#i_dia').val();
        var ejex = "Dia";
        var etiq = "Consumo del Día";	 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
            }
        }); 
        $.ajax({
                url:'/trends/'+idvariable+'/d/'+date+'/datos',
                type:'GET',
                success:function(response){
                    // config.data.labels.length=0;
                    // config.data.datasets[0].length=0;
                    // config.data.datasets[1].length=0;
                    // config.data.datasets[2].length=0;
                response.forEach(function (elemento, indice) {
                    
                    // config.data.labels.push(elemento['date']);
                    // config.data.datasets[0].data.push(elemento['value'])
                    // config.data.datasets[1].data.push(elemento['highLimit'])
                    // config.data.datasets[2].data.push(elemento['lowLimit'])

                });
                               
                window.myLine.update()
                }
        });

    });
    $("input[name=mes]").change(function () {	 
        var date = $('#i_mes').val();
        var ejex = "Mes";
        var etiq = "Consumo del Mes";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
            }
        }); 
        $.ajax({
                url:'/trends/'+idvariable+'/m/'+date+'/datos',
                type:'GET',
                success:function(response){
                    // config.data.labels.length=0;
                    // config.data.datasets[0].length=0;
                    // config.data.datasets[1].length=0;
                    // config.data.datasets[2].length=0;
                response.forEach(function (elemento, indice) {            
                    // config.data.labels.push(elemento['date']);
                    // config.data.datasets[0].data.push(elemento['value'])
                    // config.data.datasets[1].data.push(elemento['highLimit'])
                    // config.data.datasets[2].data.push(elemento['lowLimit'])

                });
                
                
                window.myLine.update()
                }
        });
    });
   
});
//Editables Maquina 5
var configM1 = {
    type: 'doughnut',
    data: {
        labels: ["Green", "Yellow"],

        datasets: [{
            data: [90, 10],
            backgroundColor: [
                'green',
                'red'
            ],
            labels: [
                'Lgreen',
                'Lred',

            ]
        }]
    },
    options: {
        rotation: 90,
        circumference: 4, //1.5* Math.PI,
        responsive: true,
        legend: {
            position: 'top',
            display: false
        },
        title: {
            display: true,
            text: 'Efectividad'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        elements: {
            center: {
                text: '90%',
                color: 'green', // Default is #000000
                fontStyle: 'Arial', // Default is Arial
                sidePadding: 20 // Defualt is 20 (as a percentage)
            }
        },
        plugins: {
            datalabels: {
                backgroundColor: function (context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                anchor: 'end',
                color: 'white',
                /*display: function (context) {
                    var dataset = context.dataset;
                    var count = dataset.data.length;
                    var value = dataset.data[context.dataIndex];
                    return value > count * 1.5;
                },*/
                font: {
                    weight: 'bolder',
                    size: 50,

                },
                formatter: Math.round
            }
        }


    },

};

var configEf = {
    type: 'doughnut',
    data: {
        labels: ["Green", "Yellow"],

        datasets: [{
            data: [90, 10],
            backgroundColor: [
                'green',
                'red'
            ],
            labels: [
                'Lgreen',
                'Lred',

            ]
        }]
    },
    options: {
        rotation: 90,
        circumference: 4, //1.5* Math.PI,
        responsive: true,
        legend: {
            position: 'top',
            display: false
        },
        title: {
            display: true,
            text: 'Disponibilidad',
            fontSize: '50',
            fontColor: 'black'
            //fontFamily:
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        elements: {
            center: {
                text: '90%',
                color: 'green', // Default is #000000
                fontStyle: 'Arial', // Default is Arial
                sidePadding: 20 // Defualt is 20 (as a percentage)
            }
        },
        plugins: {
            datalabels: {
                backgroundColor: function (context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                anchor: 'end',
                color: 'white',
                /*display: function (context) {
                    var dataset = context.dataset;
                    var count = dataset.data.length;
                    var value = dataset.data[context.dataIndex];
                    return value > count * 1.5;
                },*/
                font: {
                    weight: 'bolder',
                    size: 50,

                },
                formatter: Math.round
            }
        }


    },

};

var configDis = {
    type: 'doughnut',
    data: {
        labels: ["Green", "Yellow"],

        datasets: [{
            data: [90, 10],
            backgroundColor: [
                'green',
                'red'
            ],
            labels: [
                'Lgreen',
                'Lred',

            ]
        }]
    },
    options: {
        rotation: 90,
        circumference: 4, //1.5* Math.PI,
        responsive: true,
        legend: {
            position: 'top',
            display: false
        },
        title: {
            display: true,
            text: 'Efectividad',
            fontSize: '50',
            fontColor: 'black'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        elements: {
            center: {
                text: '90%',
                color: 'green', // Default is #000000
                fontStyle: 'Arial', // Default is Arial
                sidePadding: 20 // Defualt is 20 (as a percentage)
            }
        },
        plugins: {
            datalabels: {
                backgroundColor: function (context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                anchor: 'end',
                color: 'white',
                /*display: function (context) {
                    var dataset = context.dataset;
                    var count = dataset.data.length;
                    var value = dataset.data[context.dataIndex];
                    return value > count * 1.5;
                },*/
                font: {
                    weight: 'bolder',
                    size: 50,

                },
                formatter: Math.round
            }
        }


    },

};
var configQty = {
    type: 'doughnut',
    data: {
        labels: ["Green", "Yellow"],

        datasets: [{
            data: [90, 10],
            backgroundColor: [
                'green',
                'red'
            ],
            labels: [
                'Lgreen',
                'Lred',

            ]
        }]
    },
    options: {
        rotation: 90,
        circumference: 4, //1.5* Math.PI,
        responsive: true,
        legend: {
            position: 'top',
            display: false
        },
        title: {
            display: true,
            text: 'Calidad',
            fontSize: '50',
            fontColor: 'black'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        elements: {
            center: {
                text: '90%',
                color: 'green', // Default is #000000
                fontStyle: 'Arial', // Default is Arial
                sidePadding: 20 // Defualt is 20 (as a percentage)
            }
        },
        plugins: {
            datalabels: {
                backgroundColor: function (context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                anchor: 'end',
                color: 'white',
                /*display: function (context) {
                    var dataset = context.dataset;
                    var count = dataset.data.length;
                    var value = dataset.data[context.dataIndex];
                    return value > count * 1.5;
                },*/
                font: {
                    weight: 'bolder',
                    size: 50,

                },
                formatter: Math.round
            }
        }


    },

};

window.onload = function () {
    var ctx = document.getElementById("Canvas1").getContext("2d");
    window.myMaq5 = new Chart(ctx, this.configEf);

    var ctx2 = document.getElementById("Canvas2").getContext("2d");
    window.myMaq6 = new Chart(ctx2, this.configDis);

    var ctx3 = document.getElementById("Canvas3").getContext("2d");
    window.myMaq7 = new Chart(ctx3, this.configQty);

    var ctx4 = document.getElementById("Canvas4").getContext("2d");
    window.myMaq7 = new Chart(ctx4, this.configQty);

    var ctx5 = document.getElementById("Canvas").getContext("2d");
    window.myLine = new Chart(ctx5, config);

};




var MONTHS = [];
var config = {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: "My First dataset",
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: [],
            fill: false,
        }, {
            label: "My Second dataset",
            fill: false,
            backgroundColor: window.chartColors.orange,
            borderColor: window.chartColors.orange,
            data: [],
        }, {
            label: "My Second dataset",
            fill: false,
            backgroundColor: window.chartColors.green,
            borderColor: window.chartColors.green,
            data: [],
        }, {
            label: "My Second dataset",
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
            text: 'Chart.js Line Chart'
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
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        }
    }
};



Chart.pluginService.register({
    beforeDraw: function (chart) {
        if (chart.config.options.elements.center) {
            //Get ctx from string
            var ctx = chart.chart.ctx;

            //Get options from the center object in options
            var centerConfig = chart.config.options.elements.center;
            var fontStyle = centerConfig.fontStyle || 'Arial';
            var txt = centerConfig.text;
            var color = centerConfig.color || '#000';
            var sidePadding = centerConfig.sidePadding || 20;
            var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
            //Start with a base font of 30px
            ctx.font = "30px " + fontStyle;

            //Get the width of the string and also the width of the element minus 10 to give it 5px side padding
            var stringWidth = ctx.measureText(txt).width;
            var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

            // Find out how much the font can grow in width.
            var widthRatio = elementWidth / stringWidth;
            var newFontSize = Math.floor(30 * widthRatio);
            var elementHeight = (chart.innerRadius * 2);

            // Pick a new font size so it will not be larger than the height of label.
            var fontSizeToUse = Math.min(newFontSize, elementHeight);

            //Set font settings to draw it correctly.
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
            var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
            ctx.font = fontSizeToUse + "px " + fontStyle;
            ctx.fillStyle = color;

            //Draw text in center
            ctx.fillText(txt, centerX, centerY);
        }
    }
});
