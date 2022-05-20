<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Clientes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
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

                            <button class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#modalClientesMercados">

                                Agregar Cliente

                            </button>

                            <button class="btn btn-outline-primary float-right" data-toggle="modal"
                                data-target="#modalClientesMasivosMercados" hidden>
                                Agregar Clientes Masivo
                            </button>

                            <!-- <button type="button" class="btn btn-default float-right" id="daterange-btn-SistemaFacturas" >
                  <span>
                    
                    <i class="fa fa-calendar"></i> Rango de Fecha

                  </span>

                   <i class="fa fa-caret-down"></i>
                     
                </button> -->

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-sm-12">

                                    <table class="table table-bordered table-striped dt-responsive "
                                        id="tablaMercadoClientes" width="100%">

                                        <thead>

                                            <tr>

                                                <th style="width:5px">#</th>
                                                <th>Acciones</th>
                                                <th>Nombre</th>
                                                <th>Tipo Cédula</th>
                                                <th>Cédula</th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                        </tbody>

                                    </table>

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



<div class="modal" id="modalClientesMercados" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Registrar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">


                        <div class="col-xs-12 col-lg-12">
                            <label>&nbsp;&nbspCédula:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <input type="text" class="form-control"
                                    style="font-size:20px;height: 50px; background: #fbfbfb;"
                                    id="frmclientlblcedulasearchMerc" name="frmclientlblcedulasearchMerc"
                                    autocomplete="off">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-info btn-flat" id="frmclientcedulasearchMerc">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"><i class="fas fa-search"></i></font>
                                        </font>
                                    </button>
                                </span>
                            </div>
                            <br>
                        </div>

                        <div class="col-xs-12 col-lg-12">
                            <label>&nbsp;&nbspNombre:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text"><i
                                            class="fas fa-barcode"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;" class="form-control" id="frmclientNombreMerc"
                                    name="frmclientNombreMerc" required placeholder="Nombre">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-6">
                            <label>&nbsp;&nbspTipo Cédula:</label>
                            <div class="input-group" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px; height: 35px;" class="input-group-text "><i
                                            class="fas fa-percentage"></i></span>
                                </div>
                                <select style="font-size:15px; height: 35px;" class="custom-select "
                                    id="frmclientTcedulaMerc" name="frmclientTcedulaMerc" required>
                                    <option selected disabled value="">Seleccionar Tipo Cédula</option>
                                    <option value="01">Fisico</option>
                                    <option value="02">Juridico</option>
                                    <option value="03">Dimex</option>
                                    <option value="03">Nite</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-6">
                            <label>&nbsp;&nbspCédula:</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text"><i
                                            class="fas fa-barcode"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;" class="form-control" id="frmclientCedulaMerc"
                                    name="frmclientCedulaMerc" required placeholder="Cédula">
                            </div>

                        </div>


                        <div class="col-xs-12 col-lg-6">
                            <label>&nbsp;&nbspCorreo</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text"><i
                                            class="fas fa-edit"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;" class="form-control" id="frmclientCorreoMerc"
                                    name="frmclientCorreoMerc" required placeholder="Correo">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label>&nbsp;&nbspTelefono</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text"><i
                                            class="fas fa-edit"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;" class="form-control"
                                    id="frmclientTelefonoMerc" name="frmclientTelefonoMerc" required
                                    placeholder="Telefono" autocomplete="off">
                            </div>
                        </div>



                        <?php  

                        $provincias = ClientesController::ctrBUSCAR_PROVINCIAS();

                        ?>


                        <div class="col-xs-12 col-lg-4">
                            <label>&nbsp;&nbspProvincia:</label>
                            <div class="input-group" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-flag"></i></span>
                                </div>
                                <select style="font-size:15px;height: 35px" class="custom-select "
                                    id="frmclientProvinciaMerc" name="frmclientProvinciaMerc" required>
                                    <option selected disabled value="">Seleccionar Provincia</option>

                                    <?php foreach ($provincias as $key => $value): ?>

                                    <option value="<?php echo $value["idprovincias"];?>"><?php echo $value["nombre"];?>
                                    </option>


                                    <?php endforeach ?>

                                </select>
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-4">
                            <label>&nbsp;&nbspCanton:</label>
                            <div class="input-group" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-flag"></i></span>
                                </div>
                                <select style="font-size:15px;height: 35px" class="custom-select "
                                    id="frmclientCantonMerc" name="frmclientCantonMerc" required>
                                    <option selected disabled value="">Seleccionar Canton</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-4">
                            <label>&nbsp;&nbspDistrito:</label>
                            <div class="input-group" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="far fa-flag"></i></span>
                                </div>
                                <select style="font-size:15px;height: 35px" class="custom-select "
                                    id="frmclientDistritoMerc" name="frmclientDistritoMerc" required>
                                    <option selected disabled value="">Seleccionar Distrito</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label>&nbsp;&nbspLongitud</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;" class="form-control"
                                    id="frmclientLongitudMerc" name="frmclientLongitudMerc" required
                                    placeholder="Longitud" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label>&nbsp;&nbspLatitud</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;" class="form-control"
                                    id="frmclientLatitudMerc" name="frmclientLatitudMerc" required
                                    placeholder="Latitud" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-12">
                            <label>&nbsp;&nbspLatitud</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text"><i
                                            class="fas fa-edit"></i></span>
                                </div>
                                <select class="select2 custom-select" id="diaVisitaMerc" multiple="multiple"
                                        aria-hidden="true" data-placeholder="Seleccionar día visita">
                                        <!-- <option selected disabled value="">Tipo de Pago</option> -->
                                        <option value="L">Lunes</option>
                                        <option value="K">Martes</option>
                                        <option value="M">Miercoles</option>
                                        <option value="J">Jueves</option>
                                        <option value="V">Viernes</option>
                                        <option value="S">Sabado</option>
                                        <option value="D">Domingo</option>
                                    </select>
                            </div>
                        </div>
                       

                        <div class="col-xs-12 col-lg-12">
                            <label>&nbsp;&nbspDirección</label>
                            <div class="input-group mb-6" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <!-- <span style="font-size:15px;" class="input-group-text"><i class=""></i>₡</span> -->
                                </div>
                                <textarea class="form-control" id="frmclientDireccionMerc" name="frmclientDireccionMerc"
                                    rows="3" required></textarea>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary btnGuardarClienteMerc">Guardar</button>

                </div>

            </form>
        </div>
    </div>
</div>