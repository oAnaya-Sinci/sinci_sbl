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
                <div class="table-responsive" style="overflow-x: unset;height:70%">
                    <div class="row">
                        <div class="col-sm-3">
                            <canvas id="Canvas1" data-toggle="modal" data-target="#myModalDis" style="cursor: pointer;"></canvas>
                        </div>
                        <div class="col-sm-3">
                         <canvas id="Canvas2" data-toggle="modal" data-target="#myModalRen" style="cursor: pointer;"></canvas>
                        </div>
                        <div class="col-sm-3">
                           <canvas id="Canvas3" data-toggle="modal" data-target="#myModalCal" style="cursor: pointer;"></canvas>
                        </div>
                        <div class="col-sm-3">
                            <canvas id="Canvas4"></canvas>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <canvas id="Canvas"></canvas>
                        </div>
                    </div>
                </div>
                @include('controles.comoee')
                
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="80%" cellspacing="0">
                    <thead>
                        <tr>
                        <th style="font-size:90%;">Date</th>
                        <th style="font-size:90%;">OEE</th>
                        <th style="font-size:90%;">Availability</th>
                        <th style="font-size:90%;">Performance</th>
                        <th style="font-size:90%;">Quality</th>
                        <th style="font-size:90%;">RunTime</th>
                        <th style="font-size:90%;">AvailableTime</th>
                        <th style="font-size:90%;">ICT</th>
                        <th style="font-size:90%;">TotalParts</th>
                        <th style="font-size:90%;">GoodParts</th>
                        <th style="font-size:90%;">lotId</th>
                        <th style="font-size:90%;">partId</th>
                        <th style="font-size:90%;">Shift</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo">
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
<script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/utils.js')}}"></script>
<script src="{{ asset('js/oeetemplate.js')}}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/datatables.js') }}"></script>


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
                url: '/oee/' + idmachine + '/d/' + date + '/datos',
                type: 'GET',
                success: function (response) {
                    config.data.labels.length = 0;
                    config.data.datasets[0].data.length = 0;
                    config.data.datasets[1].data.length = 0;
                    config.data.datasets[2].data.length = 0;
                    config.data.datasets[3].data.length = 0;
                    config.options.scales.xAxes[0].scaleLabel.labelString= "Dia"
                    
                    $("#dataTable").dataTable().fnDestroy();
                    $("#cuerpo").empty();
                    response[1].forEach(function(elemento, indice){
                        configDis.data.datasets[0].data=[elemento.AvailabilityG,elemento.AvailabilityR]
                        configEf.data.datasets[0].data=[elemento.performanceG,elemento. performanceR]
                        configQty.data.datasets[0].data=[elemento.qualityG,elemento.qualityR]
                        configM1.data.datasets[0].data=[elemento.OEEG,elemento.OEER]

                        configDis.options.elements.center.text = elemento.AvailabilityG+'%';
                        configEf.options.elements.center.text = elemento.performanceG+'%';
                        configQty.options.elements.center.text = elemento.qualityG+'%';
                        configM1.options.elements.center.text = elemento.OEEG+'%';

                        var resAvailability = elemento.AvailabilityG+'%';
                        $("#resAvailability").html(resAvailability);

                        var resThroghput = elemento.performanceG+'%';
                        $("#resThroghput").html(resThroghput);

                        var resQuality = elemento.qualityG+'%';
                        $("#resQuality").html(resQuality);

                    });
                    //response[1].length=0
                    if (response[1][0].date == null) {
                        
                        configDis.options.elements.center.text = 'No Data'
                        configEf.options.elements.center.text = 'No Data'
                        configQty.options.elements.center.text = 'No Data'
                        configM1.options.elements.center.text = 'No Data';
                        $("#resAvailability").html('No Data');
                        $("#resThroghput").html('No Data');
                        $("#resQuality").html('No Data');

                    }

                    response[0].forEach(function (elemento, indice) {
                        config.data.labels.push(elemento['date']);
                        config.data.datasets[0].data.push(elemento['availability'])
                        config.data.datasets[1].data.push(elemento['performance'])
                        config.data.datasets[2].data.push(elemento['quality'])
                        config.data.datasets[3].data.push(elemento['oee'])

                    });
                    response[2].forEach(function (elemento, indice) {
                        var tr = `<tr>
                            <td style="font-size:90%;">`+elemento['date']+`</td>
                            <td style="font-size:90%;">`+elemento['oee']+`</td>
                            <td style="font-size:90%;">`+elemento['availability']+`</td>
                            <td style="font-size:90%;">`+elemento['performance']+`</td>
                            <td style="font-size:90%;">`+elemento['quality']+`</td>
                            <td style="font-size:90%;">`+elemento['runTime']+`</td>
                            <td style="font-size:90%;">`+elemento['availableTime']+`</td>
                            <td style="font-size:90%;">`+elemento['ict']+`</td>
                            <td style="font-size:90%;">`+elemento['totalPieces']+`</td>
                            <td style="font-size:90%;">`+elemento['goodParts']+`</td>
                            <td style="font-size:90%;">`+elemento['lotId']+`</td>
                            <td style="font-size:90%;">`+elemento['partId']+`</td>
                            <td style="font-size:90%;">`+elemento['turno']+`</td>
                        </tr>`
                            $("#cuerpo").append(tr)

                    });
                    $('#dataTable').DataTable({
                            "pageLength": 50,
                            "order": [[ 1, "desc" ]],
                            "searching": false
                    });
                    response[3].forEach(function (elemento, indice) {
                        $("#RunningTime").html(elemento['RunningTime']);
                        $("#AvailableTime").html(elemento['AvailableTime']);

                        $("#TotalParts").html(elemento['TotalParts']);
                        $("#IdealCycleTime").html(elemento['ICT']);
                        $("#RunningTime2").html(elemento['RunningTime']);

                        $("#GoodParts").html(elemento['GoodParts']);
                        $("#TotalParts2").html(elemento['TotalParts']);

                        
                    });
                    if (response[3][0].date == null) {
                            
                            $("#RunningTime").html('No Data');
                            $("#AvailableTime").html('No Data');

                            $("#TotalParts").html('No Data');
                            $("#IdealCycleTime").html('No Data');
                            $("#RunningTime2").html('No Data');

                            $("#GoodParts").html('No Data');
                            $("#TotalParts2").html('No Data');
                
                    }

                    window.myLine.update()
                    window.myMaq5.update()
                    window.myMaq6.update()
                    window.myMaq7.update()
                    window.myMaq8.update()
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
                url: '/oee/' + idmachine + '/m/' + date + '/datos',
                type: 'GET',
                success: function (response) {
                    config.data.labels.length = 0;
                    config.data.datasets[0].data.length = 0;
                    config.data.datasets[1].data.length = 0;
                    config.data.datasets[2].data.length = 0;
                    config.data.datasets[3].data.length = 0;
                    config.options.scales.xAxes[0].scaleLabel.labelString= "Mes"
                    
                    $("#dataTable").dataTable().fnDestroy();
                    $("#cuerpo").empty();
                    response[1].forEach(function(elemento, indice){
                        configM1.data.datasets[0].data=[elemento.OEEG,elemento.OEER]
                        configEf.data.datasets[0].data=[elemento.performanceG,elemento. performanceR]
                        configDis.data.datasets[0].data=[elemento.AvailabilityG,elemento.AvailabilityR]
                        configQty.data.datasets[0].data=[elemento.qualityG,elemento.qualityR]
                        configM1.options.elements.center.text = elemento.OEEG+'%';
                        configEf.options.elements.center.text = elemento.performanceG+'%';
                        configDis.options.elements.center.text = elemento.AvailabilityG+'%';
                        configQty.options.elements.center.text = elemento.qualityG+'%';

                        var resAvailability = elemento.AvailabilityG+'%';
                        $("#resAvailability").html(resAvailability);

                        var resThroghput = elemento.performanceG+'%';
                        $("#resThroghput").html(resThroghput);

                        var resQuality = elemento.qualityG+'%';
                        $("#resQuality").html(resQuality);

                    });
                    if (response[1][0].date == null) {
                        
                        configDis.options.elements.center.text = 'No Data'
                        configEf.options.elements.center.text = 'No Data'
                        configQty.options.elements.center.text = 'No Data'
                        configM1.options.elements.center.text = 'No Data';
                        $("#resAvailability").html('No Data');
                        $("#resThroghput").html('No Data');
                        $("#resQuality").html('No Data');
            
                    }
                    response[0].forEach(function (elemento, indice) {
                        config.data.labels.push(elemento['date']);
                        config.data.datasets[0].data.push(elemento['availability'])
                        config.data.datasets[1].data.push(elemento['performance'])
                        config.data.datasets[2].data.push(elemento['quality'])
                        config.data.datasets[3].data.push(elemento['oee'])

                    });
                    response[2].forEach(function (elemento, indice) {
                        var tr = `<tr>
                            <td style="font-size:90%;">`+elemento['date']+`</td>
                            <td style="font-size:90%;">`+elemento['oee']+`</td>
                            <td style="font-size:90%;">`+elemento['availability']+`</td>
                            <td style="font-size:90%;">`+elemento['performance']+`</td>
                            <td style="font-size:90%;">`+elemento['quality']+`</td>
                            <td style="font-size:90%;">`+elemento['runTime']+`</td>
                            <td style="font-size:90%;">`+elemento['availableTime']+`</td>
                            <td style="font-size:90%;">`+elemento['ict']+`</td>
                            <td style="font-size:90%;">`+elemento['totalPieces']+`</td>
                            <td style="font-size:90%;">`+elemento['goodParts']+`</td>
                            <td style="font-size:90%;">`+elemento['lotId']+`</td>
                            <td style="font-size:90%;">`+elemento['partId']+`</td>
                            <td style="font-size:90%;">`+elemento['turno']+`</td>
                        </tr>`
                            $("#cuerpo").append(tr)

                    });
                $('#dataTable').DataTable({
                            "pageLength": 50,
                            "order": [[ 1, "desc" ]],
                            "searching": false
                    });
                    response[3].forEach(function (elemento, indice) {
                        $("#RunningTime").html(elemento['RunningTime']);
                        $("#AvailableTime").html(elemento['AvailableTime']);

                        $("#TotalParts").html(elemento['TotalParts']);
                        $("#IdealCycleTime").html(elemento['ICT']);
                        $("#RunningTime2").html(elemento['RunningTime']);

                        $("#GoodParts").html(elemento['GoodParts']);
                        $("#TotalParts2").html(elemento['TotalParts']);
                    });
                    if (response[3][0].date == null) {
                            
                            $("#RunningTime").html('No Data');
                            $("#AvailableTime").html('No Data');

                            $("#TotalParts").html('No Data');
                            $("#IdealCycleTime").html('No Data');
                            $("#RunningTime2").html('No Data');

                            $("#GoodParts").html('No Data');
                            $("#TotalParts2").html('No Data');
                
                    }

                    window.myLine.update()
                    window.myMaq5.update()
                    window.myMaq6.update()
                    window.myMaq7.update()
                    window.myMaq8.update()
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
                url: '/oee/' + idmachine + '/y/' + date + '/datos',
                type: 'GET',
                success: function (response) {
                    config.data.labels.length = 0;
                    config.data.datasets[0].data.length = 0;
                    config.data.datasets[1].data.length = 0;
                    config.data.datasets[2].data.length = 0;
                    config.data.datasets[3].data.length = 0;
                    config.options.scales.xAxes[0].scaleLabel.labelString= "Año"
                    
                    $("#dataTable").dataTable().fnDestroy();
                    $("#cuerpo").empty();
                    response[1].forEach(function(elemento, indice){
                        configM1.data.datasets[0].data=[elemento.OEEG,elemento.OEER]
                        configEf.data.datasets[0].data=[elemento.performanceG,elemento. performanceR]
                        configDis.data.datasets[0].data=[elemento.AvailabilityG,elemento.AvailabilityR]
                        configQty.data.datasets[0].data=[elemento.qualityG,elemento.qualityR]
                        configM1.options.elements.center.text = elemento.OEEG+'%';
                        configEf.options.elements.center.text = elemento.performanceG+'%';
                        configDis.options.elements.center.text = elemento.AvailabilityG+'%';
                        configQty.options.elements.center.text = elemento.qualityG+'%';

                        var resAvailability = elemento.AvailabilityG+'%';
                        $("#resAvailability").html(resAvailability);

                        var resThroghput = elemento.performanceG+'%';
                        $("#resThroghput").html(resThroghput);

                        var resQuality = elemento.qualityG+'%';
                        $("#resQuality").html(resQuality);

                    });
                    if (response[1][0].date == null) {
                        
                        configDis.options.elements.center.text = 'No Data'
                        configEf.options.elements.center.text = 'No Data'
                        configQty.options.elements.center.text = 'No Data'
                        configM1.options.elements.center.text = 'No Data';
                        $("#resAvailability").html('No Data');
                        $("#resThroghput").html('No Data');
                        $("#resQuality").html('No Data');
            
                    }
                    response[0].forEach(function (elemento, indice) {
                        config.data.labels.push(elemento['date']);
                        config.data.datasets[0].data.push(elemento['availability'])
                        config.data.datasets[1].data.push(elemento['performance'])
                        config.data.datasets[2].data.push(elemento['quality'])
                        config.data.datasets[3].data.push(elemento['oee'])

                    });
                    response[2].forEach(function (elemento, indice) {
                        var tr = `<tr>
                            <td style="font-size:90%;">`+elemento['date']+`</td>
                            <td style="font-size:90%;">`+elemento['oee']+`</td>
                            <td style="font-size:90%;">`+elemento['availability']+`</td>
                            <td style="font-size:90%;">`+elemento['performance']+`</td>
                            <td style="font-size:90%;">`+elemento['quality']+`</td>
                            <td style="font-size:90%;">`+elemento['runTime']+`</td>
                            <td style="font-size:90%;">`+elemento['availableTime']+`</td>
                            <td style="font-size:90%;">`+elemento['ict']+`</td>
                            <td style="font-size:90%;">`+elemento['totalPieces']+`</td>
                            <td style="font-size:90%;">`+elemento['goodParts']+`</td>
                            <td style="font-size:90%;">`+elemento['lotId']+`</td>
                            <td style="font-size:90%;">`+elemento['partId']+`</td>
                            <td style="font-size:90%;">`+elemento['turno']+`</td>
                        </tr>`
                            $("#cuerpo").append(tr)

                    });
                $('#dataTable').DataTable({
                            "pageLength": 100,
                            "order": [[ 1, "desc" ]],
                            "searching": false
                    });
                    response[3].forEach(function (elemento, indice) {
                        $("#RunningTime").html(elemento['RunningTime']);
                        $("#AvailableTime").html(elemento['AvailableTime']);

                        $("#TotalParts").html(elemento['TotalParts']);
                        $("#IdealCycleTime").html(elemento['ICT']);
                        $("#RunningTime2").html(elemento['RunningTime']);

                        $("#GoodParts").html(elemento['GoodParts']);
                        $("#TotalParts2").html(elemento['TotalParts']);
                    });
                    if (response[3][0].date == null) {
                        
                        $("#RunningTime").html('No Data');
                        $("#AvailableTime").html('No Data');

                        $("#TotalParts").html('No Data');
                        $("#IdealCycleTime").html('No Data');
                        $("#RunningTime2").html('No Data');

                        $("#GoodParts").html('No Data');
                        $("#TotalParts2").html('No Data');
            
                    }

                    window.myLine.update()
                    window.myMaq5.update()
                    window.myMaq6.update()
                    window.myMaq7.update()
                    window.myMaq8.update()
                }
            });
        });


    });
</script>

@endsection
