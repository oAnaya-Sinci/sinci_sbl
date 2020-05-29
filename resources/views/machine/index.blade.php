@extends('layouts.app')

@section('contenido')
            
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Maquinas
              <button  data-toggle="modal" data-target="#myModalNuevo" class="btn btn-success btn-icon-split btn-sm">
                <span class="icon text-white-50">
                      <i class="fas fa-arrow-right"></i>
                </span>
                    <span class="text">Nuevo</span>
              </button>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>Usuario</th>
                      <th>Oee</th>
                      <th>Eventos</th>
                      <th>Estado</th>

                    </tr>
                  </thead>
                  <tbody>
                   @foreach($machines as $var)   
                    <tr>
                     <td>
                        <button data-toggle="modal" title="Editar" data-target="#myModalEdit{{$var['id']}}" type="button" class="btn btn-primary btn-circle btn-sm">
                            <i class="fas fa-fw fa-wrench"></i>
                        </button> &nbsp;
                        @include('machine.edit')


                        @if($var['condicion']==1)
                          <button type="button"  title="Desactivar" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#myModalDesactivar{{$var['id']}}">
                                <i class="fas fa-trash"></i>
                          </button>
                          @include('machine.delete')
                        @else
                            <button type="button"  title="Activar" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#myModalActivar{{$var['id']}}">
                                <i class="fas fa-check"></i>
                            </button>
                            @include('machine.activar')
                        @endif
                     </td>
                     <td>{{$var['name']}}</td>
                     <td>{{$var['name_user']}}</td>
                     <td>
                       @if($var['activar_oee']==1)
                         <div>
                            <span class="badge badge-success">Activado</span>
                         </div>
                         @else
                        <div>
                            <span class="badge badge-danger">Desactivado</span>
                        </div>
                        @endif
                    </td>
                    <td>
                       @if($var['activar_eventos']==1)
                         <div>
                            <span class="badge badge-success">Activado</span>
                         </div>
                         @else
                        <div>
                            <span class="badge badge-danger">Desactivado</span>
                        </div>
                        @endif
                    </td>
                     <td>
                       @if($var['condicion']==1)
                         <div>
                            <span class="badge badge-success">Activo</span>
                         </div>
                         @else
                        <div>
                            <span class="badge badge-danger">Desactivado</span>
                        </div>
                        @endif
                    </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
              <!--Inicio del modal agregar-->
        <div class="modal fade" id="myModalNuevo" aria-labelledby="myModal"  aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" >Nueva Maquina</h4>
                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('m_registrar')}}" role="form" method="post"  class="form-horizontal">
                           {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" placeholder="Nombre de la maquina" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Usuario</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="iduser" required>
                                        <option value="" disabled selected>Seleccione</option>
                                        @foreach($users as $user)
                                        <option value="{{$user['id']}}">{{$user['name']}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Oee</label>
                                <div class="col-md-9">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="oee" name="oee">
                                    <label class="form-check-label" for="gridCheck1">
                                      Mostrar graficas de oee
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Eventos</label>
                                <div class="col-md-9">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="eventos" name="eventos" >
                                    <label class="form-check-label" for="gridCheck2">
                                      Mostrar graficas de eventos
                                    </label>
                                  </div>
                                </div>
                            </div>
                            
                            <div  class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div>

                                    </div>
                                </div>
                            </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
         
          
@endsection
@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/datatables.js') }}"></script>

@endsection