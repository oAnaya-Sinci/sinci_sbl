@extends('layouts.app')

@section('contenido')
     <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Events {{$events}}
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              </div>
            </div>
          </div>
@endsection