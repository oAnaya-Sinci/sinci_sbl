@extends('layouts.app')

@section('contenido')
     <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Variables {{$trends}}
              </h6>
            </div>
            <div class="card-body">
            
    <div style="width:75%;">
        <canvas id="canvas"></canvas>
    </div>
    <br>
    <br>
    <button id="randomizeData">Randomize Data</button>
    <button id="addDataset">Add Dataset</button>
    <button id="removeDataset">Remove Dataset</button>
    <button id="addData">Add Data</button>
    <button id="removeData">Remove Data</button>
    




            </div>
          </div>
@endsection
@section('scripts')
<script src="{{ asset('vendor/chart.js/chart.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/chart.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/utils.js')}}"></script>
<script src="{{ asset('js/trendsvars.js')}}"></script>
@endsection