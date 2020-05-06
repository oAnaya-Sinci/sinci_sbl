


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




var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var config = {
    type: 'line',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "My First dataset",
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
            fill: false,
        }, {
            label: "My Second dataset",
            fill: false,
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
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
/*
Chart.plugins.register({
    afterDatasetsDraw: function(chart) {
        var ctx = chart.ctx;

        chart.data.datasets.forEach(function(dataset, i) {
            var meta = chart.getDatasetMeta(i);
            if (!meta.hidden) {
                meta.data.forEach(function(element, index) {
                    // Draw the text in black, with the specified font
                    ctx.fillStyle = 'rgb(0, 0, 0)';

                    var fontSize = 16;
                    var fontStyle = 'normal';
                    var fontFamily = 'Helvetica Neue';
                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                    // Just naively convert to string for now
                    var dataString = dataset.data[index].toString();

                    // Make sure alignment settings are correct
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    var padding = 5;
                    var position = element.tooltipPosition();
                    ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                });
            }
        });
    }
});*/