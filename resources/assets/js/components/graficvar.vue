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



import LineChart from './LineChart.js'

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
              label: 'Consumo por Dia',
              backgroundColor: '#00c8ff',
              data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(),this.getRandomInt(), this.getRandomInt()]
            }, {
              label: 'Limite Bajo',
              backgroundColor: '#e83a3a',
              data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(),this.getRandomInt(), this.getRandomInt()]
            }, {
              label: 'Limite Alto',
              backgroundColor: '#4e3ae8',
              data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(),this.getRandomInt(), this.getRandomInt()]
            }
            
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
                  fontColor: '#000000'
              }
            },
            scales: { 
                xAxes: [{ 
                  scaleLabel: { 
                  display: true, 
                  labelString: 'Hora' 
                  } 
                }],
                yAxes: [{ 
                  scaleLabel: { 
                  display: true, 
                  labelString: '°C' 
                  } 
                }]  
            } 
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