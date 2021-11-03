@extends('layouts.app')

@section('contenido')
<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color:rgb(250,250,250);border-color:rgb(250,250,250)">
                    @foreach($machines as $machine)
                    <h5 class="m-0 font-weight-bold text-primary" >Andon {{$machine['name']}}</h5>
                    <input type="hidden" class="form-control" name="var_name" id="var_name" value="{{$machine['name']}}">
                    <input type="hidden" class="form-control" name="idmachine" id="idmachine" value="{{$machine['id']}}">
                    <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">
                    @endforeach
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-6">

                        <!-- Default Card Example -->
                        <div class="card shadow mb-4" >
                            <div class="card-header py-3" style="background-color:rgb(75,192,192);border-color:rgb(75,192,192)"> 
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Disponibilidad</h2>
                            </div>
                            <div class="card-body" style="background-color:rgb(75,192,192)">
                                <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resAvailability"></h1>
                            </div>
                        </div>

                        <!-- Basic Card Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3" style="background-color:rgb(0,161,203);border-color:rgb(0,161,203)">
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Calidad</h2>
                            </div>
                            <div class="card-body" style="background-color:rgb(0,161,203)">
                                <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resQuality"></h1>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">

                        <!-- Default Card Example -->
                        <div class="card shadow mb-4" style="background-color:rgb(0,239,193)">
                            <div class="card-header py-3" style="background-color:rgb(213,77,84);border-color:rgb(213,77,84)">
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">Rendimiento</h2>
                            </div>
                            <div class="card-body" style="background-color:rgb(213,77,84)">
                                <h1 class="m-0 font-weight-bold text-primary" style="text-align:center;" id="resThroghput"></h1>
                            </div>
                        </div>

                        <!-- Default Card Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3" style="background-color:rgb(255,185,46);border-color:rgb(255,185,46)">
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align:center">OEE</h2>
                            </div>
                            <div class="card-body" style="background-color:rgb(255,185,46)">
                                <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" id="resOee"></h1>
                            </div>
                        </div>

                    </div>

                    </div>


            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/andon.js')}}"></script>
<script src="{{ asset('js/andon5.js')}}"></script>
@endsection