<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Documentos Facturación</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Documentos Facturación</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDfact">

                                Agregar Datos Facturación

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

                                <!-- <table class="table table-bordered table-striped dt-responsive" id="tabladtsFacturacion"
                                    width="100%">

                                    <thead>

                                        <tr>

                                            <th style="width:5px">#</th>
                                            <th>cliente</th>
                                            <th>nombrePlan</th>
                                            <th>precioPlan</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table> -->
                             

<?php  

$datosFact = DatosFacturacionController::ctrCargarDatosFacturacion($_SESSION["empresa"]);

?>


                            <h4>Datos Producción</h4>


                                <div class="row">


                                    <div class="col-xs-12 col-lg-6">
                                        <label class="mt-4">&nbsp;&nbspPin P12:</label>
                                        <div class="input-group mb-6" style=" width: 100%;">

                                            <div class="input-group-prepend">

                                                <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                        class="fas fa-key"></i></span>

                                            </div>

                                            <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                                id="pin" name="pin" value = "<?php echo $datosFact[0]["pin_p12"] ?>" placeholder="Pin P12" readOnly>

                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-lg-6">
                                        <label class="mt-4">&nbsp;&nbspUsuario token:</label>
                                        <div class="input-group mb-6" style=" width: 100%;">

                                            <div class="input-group-prepend">

                                                <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                        class="fas fa-user"></i></span>

                                            </div>

                                            <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                                id="usuario_tokenM" name="usuario_tokenM" value = "<?php echo $datosFact[0]["usuario_token"] ?>" placeholder="Usuario" readOnly>

                                        </div>
                                    </div>



                                    <div class="col-xs-12 col-lg-6">
                                        <label class="mt-4">&nbsp;&nbspContraseña token:</label>
                                        <div class="input-group mb-6" style=" width: 100%;">

                                            <div class="input-group-prepend">

                                                <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                        class="fas fa-lock"></i></span>

                                            </div>

                                            <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                                id="contrasena_tokenM" name="contrasena_tokenM" value = "<?php echo $datosFact[0]["contrasena_token"] ?>" placeholder="Contraseña" readOnly>

                                        </div>
                                    </div>


                                </div>




                            </div>

                            <h4 class="mt-4">Datos Prueba</h4>

                            <div class="row">

                                <div class="col-xs-12 col-lg-6">
                                    <label class="mt-4">&nbsp;&nbspPin P12:</label>
                                    <div class="input-group mb-6" style=" width: 100%;">

                                        <div class="input-group-prepend">

                                            <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                    class="fas fa-key"></i></span>

                                        </div>

                                        <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                            id="pinpruebaM" name="pinpruebaM" value = "<?php echo $datosFact[0]["pin_p12_prueba"] ?>" placeholder="Pin P12" readOnly>

                                    </div>
                                </div>

                                <div class="col-xs-12 col-lg-6">
                                    <label class="mt-4">&nbsp;&nbspUsuario token:</label>
                                    <div class="input-group mb-6" style=" width: 100%;">

                                        <div class="input-group-prepend">

                                            <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                    class="fas fa-user"></i></span>

                                        </div>

                                        <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                            id="usuario_tokenM" name="usuario_tokenM" value = "<?php echo $datosFact[0]["usuario_token_prueba"] ?>" placeholder="Usuario" readOnly>

                                    </div>
                                </div>


                                <div class="col-xs-12 col-lg-6">
                                    <label class="mt-4">&nbsp;&nbspContraseña token:</label>
                                    <div class="input-group mb-6" style=" width: 100%;">

                                        <div class="input-group-prepend">

                                            <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                    class="fas fa-lock"></i></span>

                                        </div>

                                        <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                            id="contrasena_token_pruebaM" name="contrasena_token_pruebaM" value = "<?php echo $datosFact[0]["contrasena_token_prueba"] ?>"
                                            placeholder="Contraseña" readOnly>

                                    </div>
                                </div>


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


<!--          MODAL AGREGAR DATOS FACTURACIÓN            -->
<div class="modal" id="modalAgregarDfact" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Datos Facturación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <h3>Datos Producción</h3>
                    <div class="row">


                        <div class="row">


                            <div class="col-xs-12 col-lg-6">
                                <label class="mt-4">&nbsp;&nbspPin P12:</label>
                                <div class="input-group mb-6" style=" width: 100%;">

                                    <div class="input-group-prepend">

                                        <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                class="fas fa-key"></i></span>

                                    </div>

                                    <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                        id="pin_p12" name="pin_p12" placeholder="Pin P12">

                                </div>
                            </div>

                            <div class="col-xs-12 col-lg-6">
                                <label class="mt-4">&nbsp;&nbspUsuario token:</label>
                                <div class="input-group mb-6" style=" width: 100%;">

                                    <div class="input-group-prepend">

                                        <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                class="fas fa-user"></i></span>

                                    </div>

                                    <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                        id="usuario_token" name="usuario_token" placeholder="Usuario">

                                </div>
                            </div>


                            <div class="col-xs-12 col-lg-6">
                                <label class="mt-4">&nbsp;&nbspContraseña token:</label>
                                <div class="input-group mb-6" style=" width: 100%;">

                                    <div class="input-group-prepend">

                                        <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                class="fas fa-lock"></i></span>

                                    </div>

                                    <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                        id="contrasena_token" name="contrasena_token" placeholder="Contraseña">

                                </div>
                            </div>


                            <div class="col-xs-12 col-lg-6" style="position : relative;">
                                <label class="mt-4">&nbsp;&nbspDocumento p12</label>
                                <div class="input-group mb-6" style=" width: 100%;">

                                    <div class="input-group-prepend">

                                        <!-- <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                            class="fas fa-mobile-alt"></i></span> -->

                                    </div>

                                    <input type="file" id="documento_p12" name="documento_p12" multiple>

                                </div>
                            </div>


                            <div class="col-xs-12 col-lg-3">
                                <div class=" mt-4">

                                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button> -->
                                    <button type="button" class="btn btn-primary btnGuardarDtsFact">Guardar
                                        Datos</button>

                                </div>
                            </div>


                        </div>

                        <h3 class="mt-4">Datos Pruebas</h3>

                        <div class="row">


                            <!-- <i class="fas fa-key"></i> -->
                            <div class="col-xs-12 col-lg-6">
                                <label class="mt-4">&nbsp;&nbspPin P12:</label>
                                <div class="input-group mb-6" style=" width: 100%;">

                                    <div class="input-group-prepend">

                                        <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                class="fas fa-key"></i></span>

                                    </div>

                                    <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                        id="pin_p12_prueba" name="pin_p12_prueba" placeholder="Pin P12">

                                </div>
                            </div>


                            <div class="col-xs-12 col-lg-6">
                                <label class="mt-4">&nbsp;&nbspUsuario token:</label>
                                <div class="input-group mb-6" style=" width: 100%;">

                                    <div class="input-group-prepend">

                                        <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                class="fas fa-user"></i></span>

                                    </div>

                                    <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                        id="usuario_token_prueba" name="usuario_token_prueba" placeholder="Usuario">

                                </div>
                            </div>


                            <div class="col-xs-12 col-lg-6">
                                <label class="mt-4">&nbsp;&nbspContraseña token:</label>
                                <div class="input-group mb-6" style=" width: 100%;">

                                    <div class="input-group-prepend">

                                        <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                class="fas fa-lock"></i></span>

                                    </div>

                                    <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                        id="contrasena_token_prueba" name="contrasena_token_prueba"
                                        placeholder="Contraseña">

                                </div>
                            </div>


                            <div class="col-xs-12 col-lg-6" style="position : relative;">
                                <label class="mt-4">&nbsp;&nbspDocumento p12</label>
                                <div class="input-group mb-6" style=" width: 100%;">

                                    <div class="input-group-prepend">

                                        <!-- <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                class="fas fa-mobile-alt"></i></span> -->

                                    </div>

                                    <input type="file" id="documento_p12_prueba" name="documento_p12_prueba" multiple>

                                </div>
                            </div>


                            <div class="col-xs-12 col-lg-3">
                                <div class=" mt-4">

                                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button> -->
                                    <button type="button" class="btn btn-primary btnGuardarDtsFactP">Guardar
                                        Datos</button>

                                </div>
                            </div>

                        </div>


                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <!-- <button type="button" class="btn btn-primary btnGuardarDtsFact">Guardar</button> -->

                </div>

            </form>
        </div>
    </div>
</div>