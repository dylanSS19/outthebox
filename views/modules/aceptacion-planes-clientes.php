<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Activación de Planes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Activación de Planes</li>
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

                            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">

                                  Agregar Cliente

                              </button> -->



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
                                    id="tablaAceptacionPlanes" width="100%">

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

<!--          MODAL AGREGAR PRODUCTOS            -->
<div class="modal" id="modalPlanesAcep" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Detalles del Plan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                    

                        <div class="col-xs-12 col-lg-12">
                            <label class="mt-1">&nbsp;&nbspCliente:</label>
                            <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                <div class="input-group-prepend">

                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i class="fas fa-user"></i></span>

                                </div>

                                <input type="text" style="font-size:15px;height: 35px" minlength="9"
                                    class="form-control " id="frmAceptNcliente" name="frmAceptNcliente"
                                    required placeholder="Nombre Cliente">

                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspCédula:</label>
                            <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                <div class="input-group-prepend">

                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i class="fas fa-address-card"></i></span>

                                </div>

                                <input type="text" style="font-size:15px;height: 35px" minlength="9"
                                    class="form-control " id="frmAceptCEcliente" name="frmAceptCEcliente"
                                    required placeholder="Cédula">

                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspCorreo:</label>
                            <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                <div class="input-group-prepend">

                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i class="fas fa-envelope"></i></span>

                                </div>

                                <input type="text" style="font-size:15px;height: 35px" minlength="9"
                                    class="form-control " id="frmAceptCOcliente" name="frmAceptCOcliente"
                                    required placeholder="Correo">

                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspTeléfono:</label>
                            <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                <div class="input-group-prepend">

                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i class="fas fa-phone-square"></i></span>

                                </div>

                                <input type="text" style="font-size:15px;height: 35px" minlength="9"
                                    class="form-control " id="frmAceptTEcliente" name="frmAceptTEcliente"
                                    required placeholder="Teléfono">

                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspDirección:</label>
                            <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                <div class="input-group-prepend">

                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>

                                </div>

                                <input type="text" style="font-size:15px;height: 35px" minlength="9"
                                    class="form-control " id="frmAceptDIcliente" name="frmAceptDIcliente"
                                    required placeholder="Dirección">

                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspPlan:</label>
                            <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                <div class="input-group-prepend">

                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i class="fas fa-arrow-circle-right"></i></span>

                                </div>

                                <input type="text" style="font-size:15px;height: 35px" minlength="9"
                                    class="form-control " id="frmAceptPLcliente" name="frmAceptPLcliente" idplan = "" privi = "" emp = ""
                                    required placeholder="Plan">

                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspMonto a Pagar:</label>
                            <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                <div class="input-group-prepend">

                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i class="fas fa-money-bill"></i></span>

                                </div>

                                <input type="text" style="font-size:15px;height: 35px" minlength="9"
                                    class="form-control " id="frmAceptMPcliente" name="frmAceptMPcliente"
                                    required placeholder="Monto a Pagar">

                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-12">
                            
                            <div id="demo" class="carousel slide mt-3" data-ride="carousel">

                                <!-- Indicators -->
                                <!-- <ul class="carousel-indicators">
                                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo" data-slide-to="1"></li>
                                    <li data-target="#demo" data-slide-to="2"></li>
                                </ul> -->

                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <center>
                                            <img id="frmAceptimgComp" src="../views/img/users/default/anonymous.png" width="450" height="400">
                                        </center>
                                    </div>

                                    <!-- Left and right controls -->
                                    <!-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a> -->

                                </div>

                            </div>

                        </div>


                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary btnGuardarAcepPlan">Aceptar Suscripción</button>

                </div>

            </form>
        </div>
    </div>
</div>