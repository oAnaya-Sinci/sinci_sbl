for (i = 0; i < 1440; i++) {
            
}

var mylabels = []
var data1=[]
var data2=[]
var data3=[]

for (i = 0; i < 1440; i++) {
    mylabels[i] = i
    data1[i] =  Math.sin(i*.01 )*50
    //data1[i] = randomScalingFactor()
    data2[i] = 120
    data3[i] = -120
}
var config = {
    type: 'line',
    data: {
        labels: mylabels,
        datasets: [{
            label: "Variable",
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: data1,
            fill: false,
        }, {
            label: "Limite superior",
            fill: false,
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: data2,
        },
        {
            label: "Limite inferior",
            fill: false,
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: data3,
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

window.onload = function () {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);
};

document.getElementById('randomizeData').addEventListener('click', function () {
    config.data.datasets.forEach(function (dataset) {
        dataset.data = dataset.data.map(function () {
            return randomScalingFactor();
        });

    });

    window.myLine.update();
});