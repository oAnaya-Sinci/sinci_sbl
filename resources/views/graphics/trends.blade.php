@extends('layouts.app')

@section('contenido')

<div class="row">
    <div class="col-xl-10 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @foreach($variables as $var)
                    <h6 class="m-0 font-weight-bold text-primary">{{$var['name_machine']}}</h6>
                    <input type="hidden" class="form-control" name="idvariable" id="var_name" value="{{$var['name']}}"> 
                    <input type="hidden" class="form-control" name="idvariable" id="idvariable" value="{{$var['id']}}"> 
                    <input type="hidden" class="form-control" name="idvariable" id="eu" value="{{$var['eu']}}">   
                @endforeach
            </div>
                <div class="card-body">
                    <div style="width:75%;">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Controles</h6>  
            </div>
            <div class="card-body">
                <div class="row align-items-start"> 
                    <h4>Para mostrar las tendencias del dia</h4>
                    <label class="form-control-label" for="fecha">Selecciona un día:</label><br>
                    <div class="input-group">
                    <input type="date" class="form-control" id="dia" name="dia" value="{{$date}}" >
                        <button  class="btn btn-success btn-icon-split btn-sm" onclick='selectorfecha(1)'>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                        </button>
                    </div>
                    
                </div>
                <!-- Divider -->
                <br><br><br><br>
                <hr class="sidebar-divider">
                <br><br><br><br>
                <div class="row align-items-center">
                    <h4>Para mostrar las tendencias del mes</h4>
                    <label class="form-control-label" for="fecha">Selecciona un mes:</label><br>
                    <div class="input-group">
                    <input type="month" class="form-control" id="mes" name="mes" >
                        <button  class="btn btn-success btn-icon-split btn-sm" onclick='selectorfecha(2)'>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
          

          <!--     -->
@endsection
@section('scripts')
<script src="{{ asset('vendor/chart.js/chart.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/chart.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/utils.js')}}"></script>
<!--Probar los ejemplos de minutos al dia y de promedios por hora al mes para observar la estructura que toma el canvas!-->
<script src="{{ asset('js/minutes.js')}}"></script>
@endsection