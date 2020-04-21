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



import LineChart from './horizontalBar.js'

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
            label: "Downtime",
            backgroundColor: "rgba(99,255,132,0.9)",
            data: [3000, 2500],
            stack: 2
        },
        {
            label: "Normaltime",
            backgroundColor: "rgba(255,99,132,0.9)",
            data: [3000, 3500],
            stack: 2,

        },
        {
            label: "NotYetHour",
            backgroundColor: "rgba(20,20,0,0.8)",
            data: [3000, 3000],
            stack: 2,

        } 
            
          ]
        }
      },
      fillOption () {
          this.options = {
        scales: {
            yAxes: [{
                ticks: {
                    //max: 100,
                },
                stacked: true,
            }],
            xAxes: [{
                stacked: true
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