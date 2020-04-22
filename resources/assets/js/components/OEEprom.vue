<template>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <i class="fa fa-align-justify"></i>
      </div>
      <div class="card-body">
        <div class="small">
          <h4>OEE</h4>
          <line-chart :chart-data="datacollection" :options="options"></line-chart>
         
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LineChart from "./horizontalBar.js";

export default {
  components: {
    LineChart
  },
  data() {
    return {
      datacollection: null,
      options: null
    };
  },
  mounted() {
    this.fillData();
    this.fillOption();
  },
  methods: {
    fillData() {
      this.datacollection = {
        labels: ["OEE", "Efectividad", "Disponibilidad", "Calidad"],
        datasets: [
          {
            label: "Downtime",
            backgroundColor: "green",
            data: [50, 30, 60, 90], //ojo por estructura de chartjs se acomodan asi, la suma de dataset1[0] y dataset2[0], forman el 100 del OEE y así sucesivamente
            stack: 2
          },
          {
            label: "Normaltime",
            backgroundColor: "red",
            data: [50, 70, 40, 10],
            stack: 2
          }
        ]
      };
    },
    fillOption() {
      this.options = {
        title: {
          display: true,
          text: "Comparativa de OEE"
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [
            {
              ticks: {
                //max: 100,
              },
              stacked: true
            }
          ],
          xAxes: [
            {
              stacked: true
            }
          ]
        }
      };
    },
    getRandomInt() {
      return Math.floor(Math.random() * (50 - 5 + 1)) + 5;
    }
  }
};
</script>

<style lang="css">
.small {
  max-width: 800px;
  /* max-height: 500px; */
  margin: 50px auto;
}
</style>