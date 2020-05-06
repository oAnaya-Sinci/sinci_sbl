@extends('layouts.app')

@section('contenido')
     <!-- DataTales Example -->
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
@endsection
@section('scripts')
<script src="{{ asset('vendor/chart.js/chart.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/chart.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/utils.js')}}"></script>
<!--Probar los ejemplos de minutos al dia y de promedios por hora al mes para observar la estructura que toma el canvas!-->
<script src="{{ asset('js/minutes.js')}}"></script>
@endsection