@extends('layouts.app')

@section('contenido')
<!-- DataTales Example -->
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
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/chart.js/chart.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/chart.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/utils.js')}}"></script>


<script src="{{ asset('js/Paretos.js')}}"></script>
@endsection