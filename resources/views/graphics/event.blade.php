@extends('layouts.app')

@section('contenido')
     <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            @foreach($machines as $machine)
              <h6 class="m-0 font-weight-bold text-primary">{{$machine['name']}}</h6>
            @endforeach
            </div>
            <div class="card-body">
              <div class="table-responsive">
              </div>
            </div>
          </div>
@endsection