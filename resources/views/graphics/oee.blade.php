@extends('layouts.app')

@section('contenido')
     <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            @foreach($machines as $machine)
              <h6 class="m-0 font-weight-bold text-primary">{{$machine['name']}}</h6>
            @endforeach
    <div class="card-body">
        <div class="table-responsive" style="overflow-x: unset;">


            <div class="row">
                <div class="col-sm-3">

                    <canvas id="Canvas1"></canvas>
                </div>
                <div class="col-sm-3">

                    <canvas id="Canvas2"></canvas>
                </div>
                <div class="col-sm-3">

                    <canvas id="Canvas3"></canvas>
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
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/chart.js/chart.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/chart.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/utils.js')}}"></script>


<script src="{{ asset('js/oeetemplate.js')}}"></script>
<!--script src="{{ asset('js/trendsvars.js')}}"></script!-->
@endsection