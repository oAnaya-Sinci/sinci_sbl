<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">OEE</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Variables
                        <button type="button" @click="abrirModal('variable','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarVariable(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarVariable(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Maquina</th>
                                    <th>Limite Alto</th>
                                    <th>Limite Bajo</th>
                                    <th>EU</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="variable in arrayVariable" :key="variable.id">
                                    <td>
                                        <button type="button" @click="abrirModal('variable','actualizar',articulo)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="variable.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarVariable(variable.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarVariable(variable.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="variable.name"></td>
                                    <td v-text="variable.name_machine"></td>
                                    <td v-text="variable.highLimit"></td>
                                    <td v-text="variable.lowLimit"></td>
                                    <td v-text="variable.eu"></td>
                                    <td>
                                        <div v-if="variable.condicion">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Categoría</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idmachine">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="machine in arrayMachine" :key="machine.id" :value="machine.id" v-text="machine.name"></option>
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="name" class="form-control" placeholder="Nombre de la variable">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Limite Alto</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="highLimit" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Limite Bajo</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="lowLimit" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">EU</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="eu" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div v-show="errorVariable" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjVariable" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarVariable()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarVariable()">Actualizar</button>
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
                variable_id: 0,
                idmachine : 0,
                name_machine : '',
                name : '',
                highLimit : 0,
                lowLimit : 0,
                eu : 0,
                arrayVariable : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorVariable : 0,
                errorMostrarMsjVariable : [],
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
            listarVariable (page,buscar,criterio){
                let me=this;
                var url= '/variable?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayVariable = respuesta.variables.data;
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
                me.listarVariable(page,buscar,criterio);
            },
            registrarVariable(){
                if (this.validarVariable()){
                    return;
                }
                
                let me = this;

                axios.post('/variable/registrar',{
                    'idmachine': this.idmachine,
                    'name': this.name,
                    'highLimit': this.highLimit,
                    'lowLimit': this.lowLimit,
                    'eu': this.eu
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarVariable(1,'','name');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarVariable(){
               if (this.validarVariable()){
                    return;
                }
                
                let me = this;

                axios.put('/variable/actualizar',{
                    'idmachine': this.idmachine,
                      'name': this.name,
                    'highLimit': this.highLimit,
                    'lowLimit': this.lowLimit,
                    'eu': this.eu,
                    'id': this.variable_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarVariable(1,'','name');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarVariable(id){
               swal({
                title: 'Esta seguro de desactivar esta variable?',
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

                    axios.put('/variable/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarVariable(1,'','name');
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
            activarVariable(id){
               swal({
                title: 'Esta seguro de activar esta variable?',
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

                    axios.put('/variable/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarVariable(1,'','name');
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
            validarVariable(){
                this.errorVariable=0;
                this.errorMostrarMsjVariable =[];

                if (this.idmachine==0) this.errorMostrarMsjVariable.push("Seleccione una maquina.");
                if (!this.name) this.errorMostrarMsjVariable.push("El nombre de la variable no puede estar vacío.");
                if (!this.highLimit) this.errorMostrarMsjVariable.push("El limite alto no puede estar vacío.");
                if (!this.lowLimit) this.errorMostrarMsjVariable.push("El limite bajo no puede estar vacío.");

                if (this.errorMostrarMsjVariable.length) this.errorVariable = 1;

                return this.errorVariable;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idmachine= 0;
                this.name_machine = '';
                this.name = '';
                this.highLimit = 0;
                this.lowLimit = 0;
                this.eu = 0;
		        this.errorVariable=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "variable":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Variable';
                                this.idmachine=0;
                                this.name_machine='';
                                this.name= '';
                                this.highLimit=0;
                                this.lowLimit=0;
                                this.eu = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Variable';
                                this.tipoAccion=2;
                                this.variable_id=data['id'];
                                this.idmachine=data['idmachine'];
                                this.name = data['name'];
                                this.highLimit=data['highLimit'];
                                this.lowLimit=data['lowLimit'];
                                this.eu= data['eu'];
                                break;
                            }
                        }
                    }
                }
                this.selectMachine();
            }
        },
        mounted() {
            this.listarVariable(1,this.buscar,this.criterio);
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
