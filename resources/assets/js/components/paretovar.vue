<template>
<div class="container-fluid">
   <div class="card">
        <div class="card-header">
             <i class="fa fa-align-justify"></i> Temperatura 1
        </div> 
        <div class="card-body">
            <div class="small">
                <h4>Temperatura 1</h4>
               <line-chart :chart-data="datacollection" :options="options"></line-chart>
                <button @click="fillData()">Randomize</button>
            </div>
        </div>
   </div>
</div>
</template>

<script>



import LineChart from './Line2Chart.js'

  export default {
    components: {
      LineChart
    },
    data () {
      return {
        datacollection: null,
        options: null
      }
    },
    mounted () {
      this.fillData()
      this.fillOption()
    },
    methods: {
      fillData () {
        this.datacollection = {
          labels: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()],
          datasets: [
            {
              label: 'Frecuencia  ',
              backgroundColor: 'gray',
              data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(),this.getRandomInt(), this.getRandomInt()],
               yAxisID: "y-axis1",
               type:'bar'
            }, {
              label: 'Porcnetaje invertido',
              borderColor: "black",
              data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(),this.getRandomInt(), this.getRandomInt()],
              type:'bar',
              fill: false
            }, 
            
          ]
        }
      },
      fillOption () {
          this.options = {

            responsive: true,
            maintainAspectRatio: false,
            legend: {
              display: true,
              labels: {
                  fontColor: 'blue'
              }
            },
            title: {
                display: false,
                text: 'titulo'
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
            
          }
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      }
    }
  }
</script>

<style lang="css">
.small {
  max-width: 800px;
  /* max-height: 500px; */
  margin:  50px auto;
}
</style>