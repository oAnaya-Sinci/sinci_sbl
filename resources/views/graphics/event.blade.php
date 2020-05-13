@extends('layouts.app')

@section('contenido')
<div class="row">
    <div class="col-xl-10 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @foreach($machines as $machine)
                <h6 class="m-0 font-weight-bold text-primary">{{$machine['name']}}</h6>
                <input type="hidden" class="form-control" name="var_name" id="var_name" value="{{$machine['name']}}">
                <input type="hidden" class="form-control" name="idmachine" id="idmachine" value="{{$machine['id']}}">
                <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">

                @endforeach
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div style="width: 75%">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Opciones</th>
                      <th>Inicio evento</th>
                      <th>Fin Evento</th>
                      <th>Descripción</th>
                      <th>Justificación</th>
                      <th>Tipo evento</th>
                      <th>Duración</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($events as $var)   
                    <tr>
                     <td>
                        <button data-toggle="modal" data-target="#myModalEdit{{$var['id']}}" type="button" class="btn btn-primary btn-circle btn-sm">
                            <i class="fas fa-fw fa-wrench"></i>
                        </button> &nbsp;
                        @include('machine.edit')
                     </td>
                     <td>{{$var['startTime']}}</td>
                     <td>{{$var['endTime']}}</td>
                     <td>{{$var['descriptions']}}</td>
                     <td>{{$var['justification']}}</td>
                     <td>{{$var['event']}}</td>
                     <td>{{$var['duration']}}</td>
                    
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    @include('controles.fechaaño')
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/chart.js/chart.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/chart.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/utils.js')}}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/datatables.js') }}"></script>


<script src="{{ asset('js/Paretos.js')}}"></script>

<script>
 $(function () {
    $('#i_dia').datepicker({
        format: "yyyy-mm-dd"
        }).datepicker("setDate", new Date());
    $('#i_mes').datepicker({
        format: "yyyy-mm",
        viewMode: "months", 
        minViewMode: "months"
        });
    $('#i_year').datepicker({
                format: "yyyy",
              viewMode: "years", 
            minViewMode: "years"
        });

    });

$(document).ready(function () {
    $("#i_dia").change(function () {
        var date = $('#i_dia').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/Events/' + idmachine + '/d/' + date + '/datos',
            type: 'GET',
            success: function (response) {
                config.data.labels.length = 0;
                config.data.datasets[0].length = 0;
                config.data.datasets[1].length = 0;
                config.options.scales.xAxes[0].scaleLabel.labelString= "Dia"
                
                response.forEach(function (elemento, indice) {
                    chartData.labels.push(elemento['descriptions'])
                    chartData.datasets[1].data.push(elemento['Frecuencia'])
                    chartData.datasets[0].data.push(elemento['PorcentajeAcumulado'])
        
                });

                window.myMixedChart.update()
            }
        });

    });
    $("#i_mes").change(function () {
        var date = $('#i_mes').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/Events/' + idmachine + '/m/' + date + '/datos',
            type: 'GET',
            success: function (response) {
                config.data.labels.length = 0;
                config.data.datasets[0].length = 0;
                config.data.datasets[1].length = 0;
                config.options.scales.xAxes[0].scaleLabel.labelString= "Mes"
                response.forEach(function (elemento, indice) {
                    chartData.labels.push(elemento['descriptions'])
                    chartData.datasets[1].data.push(elemento['Frecuencia'])
                    chartData.datasets[0].data.push(elemento['PorcentajeAcumulado'])
        
                });

                window.myMixedChart.update()
            }
        });
    });
    $("#i_year").change(function () {
        var date = $('#i_year').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/Events/' + idmachine + '/y/' + date + '/datos',
            type: 'GET',
            success: function (response) {
                config.data.labels.length = 0;
                config.data.datasets[0].length = 0;
                config.data.datasets[1].length = 0;
                config.options.scales.xAxes[0].scaleLabel.labelString= "Año"
                
                response.forEach(function (elemento, indice) {
                    chartData.labels.push(elemento['descriptions'])
                    chartData.datasets[1].data.push(elemento['Frecuencia'])
                    chartData.datasets[0].data.push(elemento['PorcentajeAcumulado'])
        
                });

                window.myMixedChart.update()
            }
        });
    });
   

});
</script>
@endsection