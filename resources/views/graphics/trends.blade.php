@extends('layouts.app')

@section('contenido')

<div class="row">
    <div class="col-xl-10 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @foreach($variables as $var)
                    <h6 class="m-0 font-weight-bold text-primary">{{$var['name_machine']}}</h6>
                    <input type="hidden" class="form-control" name="var_name" id="var_name" value="{{$var['name']}}"> 
                    <input type="hidden" class="form-control" name="idvariable" id="idvariable" value="{{$var['id']}}"> 
                    <input type="hidden" class="form-control" name="eu" id="eu" value="{{$var['eu']}}">
                    <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">      
                @endforeach
            </div>
                <div class="card-body">
                    <div style="width:75%;">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
        </div>
    </div>
    @include('controles.fecha')
</div>
          

          <!--     -->
@endsection
@section('scripts')
<script src="{{ asset('vendor/chart.js/chart.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/chart.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/utils.js')}}"></script>
<!--Probar los ejemplos de minutos al dia y de promedios por hora al mes para observar la estructura que toma el canvas!-->
<script src="{{ asset('js/minutes.js')}}"></script>
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
});
$(document).ready(function()
{  
    $("#i_dia").change(function () {
        var date = $('#i_dia').val();
         
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
            }
        }); 
        $.ajax({
                url:'/trends/'+idvariable+'/d/'+date+'/datos',
                type:'GET',
                success:function(response){
                    config.data.labels.length=0;
                    config.data.datasets[0].data.length=0;
                    config.data.datasets[1].data.length=0;
                    config.data.datasets[2].data.length=0;
                    config.options.scales.xAxes[0].scaleLabel.labelString= "Día"
                    config.data.datasets[0].label =  "Consumo del Día"
                response.forEach(function (elemento, indice) {
                    
                    config.data.labels.push(elemento['date']);
                    config.data.datasets[0].data.push(elemento['value'])
                    config.data.datasets[1].data.push(elemento['highLimit'])
                    config.data.datasets[2].data.push(elemento['lowLimit'])

                });	            
                window.myLine.update()
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
                url:'/trends/'+idvariable+'/m/'+date+'/datos',
                type:'GET',
                success:function(response){
                    config.data.labels.length=0;
                    config.data.datasets[0].length=0;
                    config.data.datasets[1].length=0;
                    config.data.datasets[2].length=0;
                    config.options.scales.xAxes[0].scaleLabel.labelString= "Mes"
                    config.data.datasets[0].label =  "Consumo del Mes"
                response.forEach(function (elemento, indice) {            
                    config.data.labels.push(elemento['date']);
                    config.data.datasets[0].data.push(elemento['value'])
                    config.data.datasets[1].data.push(elemento['highLimit'])
                    config.data.datasets[2].data.push(elemento['lowLimit'])

                });    
                window.myLine.update()
                }
        });
    });
   
});
</script>

@endsection