<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sucursales / Cajas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Sucursales - Cajas</li>
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

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSucursal">

                                Crear Sucursales

                            </button>

                            <button class="btn btn-primary float-right" data-toggle="modal"
                                data-target="#modalAgregarCajas">

                                Crear Cajas

                            </button>

                        </div>


                        <div class="card-body">

                            <div class="box-body">

                                <table class="table table-bordered table-striped dt-responsive" id="tablaSucursales"
                                    width="100%">

                                    <thead>

                                        <tr>

                                            <th style="width:5px">#</th>
                                            <th>Acciones</th>
                                            <th>Sucursal</th>
                                            <th>ID Sucursal</th>
                                            <th>Caja</th>
                                            <th>ID Caja</th>

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


<div class="modal " id="modalAgregarSucursal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">
                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Agregar Sucursales</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-xs-12 col-lg-6">
                            <label>&nbsp;&nbspNombre Sucursal:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-angle-double-right"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px"
                                    class="form-control nombresucursal" id="nombresucursal" name="nombresucursal"
                                    required placeholder="Sucursal">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-6">
                            <label>&nbsp;&nbspID Sucursal:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-angle-double-right"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" maxlength="3" minlength="3"
                                    class="form-control idsucursal" id="idsucursal" name="idsucursal" required
                                    placeholder="Ejemplo: 001">
                            </div>
                        </div>


                    </div>


                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>


            </form>


            <?php 

      $createsucursal = new SucursalesCajasController();

      $createsucursal -> ctrCrearSucursal();

     ?>


        </div>

    </div>

</div>




<div class="modal " id="modalAgregarCajas">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">
                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Agregar Datos Cajas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">


                        <div class="col-xs-12 col-lg-4">
                            <label class="mt-2">&nbsp;&nbspNombre Caja:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-angle-double-right"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" class="form-control nombrecaja"
                                    id="nombrecaja" name="nombrecaja" required placeholder="Caja">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-4">
                            <label class="mt-2">&nbsp;&nbspID Caja:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-angle-double-right"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" maxlength="3" minlength="3"
                                    class="form-control idcaja" id="idcaja" name="idcaja" required
                                    placeholder="Ejemplo: 001">
                            </div>
                        </div>

                        <?php 

                      $empresa = $_SESSION['empresa'];

                      $sucursales = SucursalesCajasController::ctrCargarSucursalxEmpresa($empresa);
                      

                     ?>


                        <div class="col-xs-12 col-lg-4">
                            <label class="mt-2">&nbsp;&nbspSucursal:</label>
                            <div class="input-group" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text "><i
                                            class="fas fa-align-justify"></i></span>
                                </div>
                                <select style="font-size:15px;height: 35px" class="custom-select" id="sucursalcaja"
                                    name="sucursalcaja" required>
                                    <option selected disabled value="">Seleccionar</option>
                                    <?php foreach ($sucursales as $key => $value): ?>

                                    <option value="<?php echo $value["idtbl_sucursal"];?>">
                                        <?php echo $value["nombre"];?></option>

                                    <?php endforeach ?>

                                </select>
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Factura Electronica:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control utlconseFE" id="utlconseFE" name="utlconseFE" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Tiquete Electronico:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control utlconseTE" id="utlconseTE" name="utlconseTE" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Nota Credito:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control utlconseNC" id="utlconseNC" name="utlconseNC" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Nota Debito:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control utlconseND" id="utlconseND" name="utlconseND" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Factura Compra:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control utlconseFC" id="utlconseFC" name="utlconseFC" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Aceptación Gastos:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control utlconseMC" id="utlconseMC" name="utlconseMC" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-12">

                            <strong><p class="mt-2" style="font-size: 20px;">Ingresar el ultimo consecutivo utilizado en la factura, de no tener iniciar en 0</p></strong>
                        
                        </div>

                    </div>


                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>


            </form>


            <?php 

      $createsucursal = new SucursalesCajasController();

      $createsucursal -> ctrCrearCajas();

     ?>


        </div>

    </div>

</div>





<div class="modal" id="modalUltConse" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Agregar ultimo Consecutivo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               

                <div class="modal-body">
                    <div class="row">

                    <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspAmbiente:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-align-justify"></i></span>
                                </div>
                                <select style="font-size:15px;height: 35px" class="custom-select " id="frmSucursalAmbiente"
                                    name="frmSucursalAmbiente" required>
                                    <option selected disabled value="">Seleccionar Ambiente</option>
                                    <option value="Prod" >Producción</option>
                                    <option value="prue">Pruebas</option>
                                </select>
                            </div>
                        </div>



                    <input type="hidden" style="font-size:15px;height: 35px" minlength="0" class="form-control" id="sucursal" name="sucursal" required>

                    <input type="hidden" style="font-size:15px;height: 35px" minlength="0" class="form-control" id="caja" name="caja" required>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Factura Electronica:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control" id="conseFE" name="conseFE" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Tiquete Electronico:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control" id="conseTE" name="conseTE" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Nota Credito:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control" id="conseNC" name="conseNC" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Nota Debito:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control" id="conseND" name="conseND" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Factura Compra:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control" id="conseFC" name="conseFC" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-2">&nbsp;&nbspUltimo Consecutivo Aceptación Gastos:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-file"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" minlength="0"
                                    class="form-control" id="conseMR" name="conseMR" required
                                    placeholder="Ejemplo: 999">
                            </div>
                        </div>


                    </div>
                </div>


                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary btnAddUltConse">Guardar</button>

                </div>
            </form>
        </div>
    </div>
</div>