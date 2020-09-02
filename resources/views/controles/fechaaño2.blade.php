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
                        <input type="hidden" class="form-control" id="i_casoS" name="casoS"/>
                    </div>
                </div>
                <hr class="sidebar-divider">
                <br>
                <div class="row align-items-start"> 
                <h4>Buscar por:</h4>
                    <div class="input-group">
                        <label class="col-xs-12 col-sm-6 col-md-3 form-control-label" for="text-input" style="max-width: 32%;flex: auto">PartId:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <select class="form-control" id="i_partid" name="partid">
                                <option value="all"  selected>Select all</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="input-group">
                        <label class="col-md-3 form-control-label" for="text-input" style="max-width: 32%;flex: auto">LoteId:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <select class="form-control" id="i_loteid" name="loteid">
                                <option value="all"  selected>Select all</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="input-group">
                        <label class="col-md-3 form-control-label" for="text-input" style="max-width: 32%;flex: auto">Turno:</label>
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <select class="form-control" id="i_shift" name="shift">
                                <option value="all"  selected>Select all</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <h4>Exportar Reporte</h4>
                <button class="btn btn-primary btn-icon-split" id="exportO" name="exportO">
                    <span class="icon text-white-50">    
                        <i class="fas fa-download"></i>
                    </span>
                    <span class="text">Descargar</span>
                </button>
            </div>
        </div>
    </div>
    