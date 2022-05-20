<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Control Usuarios</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Conrtrol Usuarios</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

        <div class="container">



            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalcreacion_usuarios">

                                Gestión Usuarios

                            </button>



                            <!--        <button type="button" class="btn btn-default float-right" id="daterange-btn-pospago">

            <span>
              
              <i class="fa fa-calendar"></i> Rango de Fecha

            </span>

             <i class="fa fa-caret-down"></i>
            
            
          </button> -->

                        </div>
                        <div class="card-body">

                            <div class="box-body">

                                <table class="table table-bordered table-striped dt-responsive"
                                    id="tablausuariosclientes" width="100%">

                                    <thead>

                                        <tr>

                                            <th style="width:5px">#</th>
                                            <th>Estado</th>
                                            <th>Nombre</th>
                                            
                                        </tr>

                                    </thead>

                                    <tbody>



                                    </tbody>



                                </table>

                            </div>


                        </div>
                    </div>

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<div class="modal fade " id="modalcreacion_usuarios">
    <div class="modal-dialog "> <!-- modal-xl -->
        <div class="modal-content">
            <form role="form" class="formulario_creacion_usuarios" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Usuarios</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-xs-12 col-lg-12">
                            <label class="mt-1">&nbsp;&nbspBuscar Usuarios:</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span class="input-group-append" style="font-size:15px;height: 45px">
                                        <button type="button" class="btn btn-outline-info btn-flat"
                                            id="frmAsigbtnsearch" title="Buscar Usuario">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                    </span>
                                </div>
                                <input type="text" style="font-size:15px;height: 45px" class="form-control "
                                    id="frmAsigUsuariossearch" name="frmAsigUsuariossearch" placeholder="Usuario">

                                    <input type="hidden" style="font-size:15px;height: 45px" class="form-control "
                                    id="frmAsigDatosUser" name="frmAsigDatosUser" iduser="" nombreuser="" placeholder="Usuario">
                                    
                         </div>
                        </div>
                    </div>

                  
                    <div class="row">
                   
                        <?php 



$modulosEmpresas = json_decode($_SESSION["privempresa"]);
      
$modulosEmpresas = str_replace ( '"' , '' ,$modulosEmpresas);
$modulosEmpresas = str_replace ( '[' , '' ,$modulosEmpresas);
$modulosEmpresas = str_replace ( ']' , '' ,$modulosEmpresas);
$modulosEmpresas = explode(',', $modulosEmpresas);


?>

                        <div class="col-xs-12 col-lg-12">
                            <label class="mt-1">&nbsp;&nbspModulos:</label>
                            <div class="input-group mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text "><i
                                            class="fas fa-percentage"></i></span>
                                </div>
                                <select style="font-size:15px;height: 35px" class="custom-select "
                                    id="frmAsigModulos" name="frmAsigModulos" disabled> 
                                    <option selected disabled value="">Modulos</option>
                                    <?php foreach ($modulosEmpresas as $key => $value):?>

                                    <option value="<?php echo $value ?>">
                                        <?php echo $value;?></option>

                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-12 mt-3">
                          <div class="card card-primary">
                              <div class="card-header">
                                  <h3 class="card-title">Asignación de Permisos</h3>

                                  <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                          title="Collapse">
                                          <i class="fas fa-minus"></i>
                                      </button>
                                  </div>
                              </div>
                              <div class="card-body" style="display: block;">
                                
                              <div class="col-xs-12 col-lg-6 ">

                                <div class="form-check">
                                  <input class="form-check-input selectTodos" id="chktodos" type="checkbox">
                                  <label class="form-check-label" for="chktodos">Marcar Todos</label>
                                </div> 

                              </div>
                                
                                <div class="col-xs-12 col-lg-6 divsSubmodulos">


                                </div>
                                <button type="button" class="btn btn-primary float-right mt-2 btnAgregarMods">Agregar</button>

                                <input type="hidden" style="font-size:15px;height: 45px" class="form-control "
                                    id="frmAsigModulosUser" name="frmAsigModulosUser"  placeholder="Usuario">
                                 
                              </div>
                              <!-- /.card-body -->
                          </div>
                        </div>
                

                    </div>



                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <!-- <button type="submit" class="btn btn-primary btn_guardar_movimiento">Guardar</button> -->
                </div>
            </form>

            <?php 

      // $agregar_saldo = new UsuariosClienteController();

      // $agregar_saldo -> ctrAgregarUsuario();

      ?>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade " id="modaleditar_usuarios">
    <div class="modal-dialog "> <!-- modal-xl -->
        <div class="modal-content">
            <form role="form" class="formulario_creacion_usuarios" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Usuarios</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                           
                    <div class="row">
                                
                        <div class="col-xs-12 col-lg-12 mt-3">
                          <div class="card card-primary">
                              <div class="card-header">
                                  <h3 class="card-title">Permisos Asignados</h3>

                                  <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                          title="Collapse">
                                          <i class="fas fa-minus"></i>
                                      </button>
                                  </div>
                              </div>
                              <div class="card-body" style="display: block;">
                                 
                              <div class="col-xs-12 col-lg-6 ">

                                <!-- <div class="form-check">
                                  <input class="form-check-input selectTodos" id="chktodos" type="checkbox">
                                  <label class="form-check-label" for="chktodos">Marcar Todos</label>
                                </div>  -->

                              </div>
                                
                                <div class="col-xs-12 col-lg-12 divsSubmodulosEditar">


                                </div>
                                <button type="button" class="btn btn-primary float-right mt-2 btnUodateMods">Guardar Cambios</button>
                                <input type="hidden" style="font-size:15px;height: 45px" class="form-control " id="frmAsigEditModIDuser" name="frmAsigEditModIDuser"  placeholder="Usuario">
                               
                                 
                              </div>
                              <!-- /.card-body -->
                          </div>
                        </div>
                

                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <!-- <button type="submit" class="btn btn-primary btn_guardar_movimiento">Guardar</button> -->
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>