<template>
            <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Tipos de eventos
                        <button type="button" @click="abrirModal('typeevent','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listartypeevent(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listartypeevent(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Maquina</th>
                                    <th>N° de fallo PLC</th>
                                    <th>descripcion</th>
                                    <th>Gravedad</th>
                                    <th>Fecha creacion</th>
                                    <th>Fecha actualizacion</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="evento in arrayTypeEvent" :key="evento.id">
                                    <td>
                                        <button type="button" @click="abrirModal('typeevent','actualizar',evento)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="evento.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarTypeEvent(evento.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarTypeEvent(evento.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="evento.name"></td>
                                    <td v-text="evento.name_machine"></td>
                                    <td v-text="evento.id_faild"></td>
                                    <td v-text="evento.description"></td>
                                    <td v-text="evento.severity"></td>
                                    <td v-text="evento.created_at"></td>
                                    <td v-text="evento.updated_at"></td>
                                    <td>
                                        <div v-if="evento.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Maquina</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idmachine">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="machine in arrayMachine" :key="machine.id" :value="machine.id" v-text="machine.name"></option>
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de Evento</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="name" class="form-control" placeholder="Nombre del Evento">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">id_fallo</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="id_faild" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="description" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Gravedad</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="severity" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div v-show="errorTypeEvent" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjTypeEvent" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarTypeEvent()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarTypeEvent()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    import VueBarcode from 'vue-barcode';
    export default {
        data (){
            return {
                evento_id: 0,
                idmachine : 0,
                name : '',
                name_machine : '',
                id_faild : 0,
                description : '',
                severity : 0,
                arrayTypeEvent : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorTypeEvent : 0,
                errorMostrarMsjTypeEvent : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'name',
                buscar : '',
                arrayMachine :[]
            }
        },
        components: {
        'barcode': VueBarcode
    },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listartypeevent (page,buscar,criterio){
                let me=this;
                var url= '/typeevent?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayTypeEvent = respuesta.type_events.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectMachine(){
                let me=this;
                var url= '/machine/selectMachine';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayMachine = respuesta.machines;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listartypeevent(page,buscar,criterio);
            },
            registrarTypeEvent(){
                if (this.validarTypeEvent()){
                    return;
                }
                
                let me = this;

                axios.post('/typeevent/registrar',{
                    'idmachine': this.idmachine,
                    'name': this.name,
                    'id_faild': this.id_faild,
                    'description': this.description,
                    'severity': this.severity
                }).then(function (response) {
                    me.cerrarModal();
                    me.listartypeevent(1,'','name');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarTypeEvent(){
               if (this.validarTypeEvent()){
                    return;
                }
                
                let me = this;

                axios.put('/typeevent/actualizar',{
                    'idmachine': this.idmachine,
                    'name': this.name,
                    'id_faild': this.id_faild,
                    'description': this.description,
                    'severity': this.severity,
                    'id': this.evento_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listartypeevent(1,'','name');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarTypeEvent(id){
               swal({
                title: 'Esta seguro de desactivar esta Evento?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/typeevent/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listartypeevent(1,'','name');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarTypeEvent(id){
               swal({
                title: 'Esta seguro de activar esta Evento?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/typeevent/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listartypeevent(1,'','name');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarTypeEvent(){
                this.errorTypeEvent=0;
                this.errorMostrarMsjTypeEvent =[];

                if (this.idmachine==0) this.errorMostrarMsjTypeEvent.push("Seleccione una maquina.");
                if (!this.name) this.errorMostrarMsjTypeEvent.push("El nombre de la evento no puede estar vacío.");
                if (!this.description) this.errorMostrarMsjTypeEvent.push("la descripcion no puede estar vacío.");
                if (!this.id_faild) this.errorMostrarMsjTypeEvent.push("id del evento no puede estar vacío.");
                if (!this.severity) this.errorMostrarMsjTypeEvent.push("Gravedad no puede estar vacío.");

                if (this.errorMostrarMsjTypeEvent.length) this.errorTypeEvent = 1;

                return this.errorTypeEvent;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idmachine= 0;
                this.name = '';
                this.name_machine = '';
                this.severity = 0;
                this.description = '';
                this.id_faild = 0;
		        this.errorTypeEvent=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "typeevent":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Evento';
                                this.idmachine= 0;
                                this.name = '';
                                this.name_machine = '';
                                this.severity = 0;
                                this.description = '';
                                this.id_faild = 0;
		                        this.errorTypeEvent=0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Evento';
                                this.tipoAccion=2;
                                this.evento_id=data['id'];
                                this.name = data['name'];
                                this.idmachine=data['idmachine'];
                                this.description=data['description'];
                                this.id_faild=data['id_faild'];
                                this.severity= data['severity'];
                                break;
                            }
                        }
                    }
                }
                this.selectMachine();
            }
        },
        mounted() {
            this.listartypeevent(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
