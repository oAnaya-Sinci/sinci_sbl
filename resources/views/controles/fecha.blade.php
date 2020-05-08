<div class="col-xl-2 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Controles</h6>  
            </div>
            <div class="card-body">
                <div class="row align-items-start"> 
                <h4>Para mostrar las tendencias</h4>
                    <button  class="btn btn-primary btn-icon-split" id="b_dia" name="b_dia">Por Dia</button>
                     &nbsp; &nbsp;
                    <button  class="btn btn-success btn-icon-split" id="b_mes" name="b_mes">Por Mes</button>
                    <label class="form-control-label" for="fecha">Selecciona una fecha:</label><br>
                    <div class="input-group">
                    <input type="date" class="form-control" id="i_dia" name="dia" value="{{$date}}" >
                    <input type="month" class="form-control" id="i_mes" name="mes" style="display: none;">
                    </div>
                    
                </div>
                <!-- Divider -->
                <hr class="sidebar-divider">
            </div>
        </div>
    </div>