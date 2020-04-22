<template>
    <main class="main">
        <!-- Breadcrumb -->

        <div class="container-fluid">
            <br>
            <div class="car-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>OEE</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    a ver a ver encuentrame
                                    <canvas id="oees">
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</template>
<script>
    export default {
        data (){
            return {
                varOee:null,
                charOee:null,
                oees:[],
                varTotalOee:[],
                varMesOee:[], 
            }
        },
        methods : {
            getOees(){
                let me=this;
                var url= '/oee';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.oees = respuesta.oees;
                    //cargamos los datos del chart
                    me.loadOees();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadOees(){
                let me=this;
                me.oees.map(function(x){
                    me.varMesOee.push(x.mes);
                    me.varTotalOee.push(x.total);
                });
                me.varOee=document.getElementById('oees').getContext('2d');

                me.charOee = new Chart(me.varOee, {
                    type: 'bar',
                    data: {
                        labels: me.varMesOee,
                        datasets: [{
                            label: 'OEE',
                            data: me.varTotalOee,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },

        },
        mounted() {
            this.getOees();
        }
    }
</script>