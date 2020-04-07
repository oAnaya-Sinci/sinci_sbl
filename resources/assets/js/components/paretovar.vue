<template>
<div class="container-fluid">
   <div class="card">
        <div class="card-header">
             <i class="fa fa-align-justify"></i> Temperatura 1
        </div> 
        <div class="card-body">
            <div class="small">

                <h4>Temperatura 1</h4>
                <line-chart :chart-data="datacollection" :height="100"></line-chart>
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
  data(){
    return {
      datacollection: null
    }
  },
  mounted () {
    this.fillData()
  },
  methods: {

    fillData ()
    {
      this.datacollection = {
        labels: ['01','02','07','15','20', '23','30'],
        datasets: [
          {
            label: 'Consumo por Dia',
            backgroundColor: '#00c8ff',
            data: [ 20, 40, 50, 20, 50, 40,65]
          },
          {
            label: 'Consumo por Dia',
            backgroundColor: '#00c8ff',
            data: [ 20, 40, 50, 20, 50, 40,65]
          },
        ]
      }
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