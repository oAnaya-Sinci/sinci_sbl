<div class="col-xl-2 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Controles</h6>  
            </div>
            <div class="card-body">
                <div class="row align-items-start"> 
                <h4>Para mostrar las tendencias</h4>
                    <button  class="btn btn-primary btn-icon-split" id="b_dia" name="b_dia">Por Dia</button>
                     &nbsp; &nbsp;&nbsp; &nbsp;
                    <button  class="btn btn-success btn-icon-split" id="b_mes" name="b_mes">Por Mes</button>
                    &nbsp; &nbsp;&nbsp; &nbsp;
                    <label class="form-control-label" for="fecha">Selecciona una fecha:</label><br>
                    
                    <div class="input-group">
                        <input type="text" class="form-control" id="i_dia" name="dia" placeholder="YYYY-MM-DD"/>
                        <input type="text" class="form-control" id="i_mes" name="mes" placeholder="YYYY-MM" style="display: none;"/>
                        <input type="hidden" class="form-control" id="i_date" name="date"/>
                        <input type="hidden" class="form-control" id="i_caso" name="caso"/>
                    </div>
                    
                </div>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <h4>Exportar Reporte</h4>
                <button class="btn btn-primary btn-icon-split" id="exportA" name="exportA">
                    <span class="icon text-white-50">    
                        <i class="fas fa-download"></i>
                    </span>
                    <span class="text">Descargar</span>
                </button>
            </div>
        </div>
    </div>
    