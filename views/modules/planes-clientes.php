<?php 


$clientes = PlanesClientesController::ctrCargarClientes();
$planes = ClientesController::ctrCargarPlanes();
  

?>

 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Adquirir Paquetes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Adquirir Paquetes</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-header">

                            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPlanCliente"> -->
                            <button class="btn btn-primary btnPlanCliente" type="button">

                                Agregar Plan

                            </button>

                        </div>

                        <div class="card-body">

                            <div class="box-body">

                                <table class="table table-bordered table-striped dt-responsive" id="tablaPlanesClientes"
                                    width="100%">

                                    <thead>

                                        <tr>

                                            <th style="width:5px">#</th>
                                            <th>Acciones</th>
                                            <th>Plan contratado</th>  
                                            <th>Estado</th>
                                            <th>Fecha Expiración</th>                                       
                                            <th class="text-center">Total Plan</th>
                                            
                                            <!-- <th>Categoria</th> -->


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

        </div>

    </div>

</div>

<style>
.global {

    height: 15em;
    line-height: 1em;
    overflow-x: hidden;
    overflow-y: scroll;
    width: 100%;
    /* border: 1px solid; */
}
</style>

<div class="modal " id="modalAgregarPlanCliente">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">
                                <!-- <div class="card-header">
                                    <h3 class="card-title"></h3>
                                </div> -->
                                <div class="card-body p-0">
                                    <div class="bs-stepper">
                                        <div class="bs-stepper-header" role="tablist">
                                            <!-- your steps here -->
                                            <div class="step" data-target="#logins-part">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="logins-part" id="logins-part-trigger">
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">Adquirir Paquetes</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#information-part">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="information-part" id="information-part-trigger">
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Pagar</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="bs-stepper-content">
                                            <!-- your steps content here -->
                                            <div id="logins-part" class="content" role="tabpanel"
                                                aria-labelledby="logins-part-trigger">


                                                <!-- AGREGAR AQUI LOS DIVS -->

                                                <div class="global mt-2">






                                                </div>

                                                <div class="row">

                                                    <div class="col-6 col-sm-8 col-md-8 col-lg-8 ">
                                                        <button class="btn btn-outline-primary mt-4" id="btnSiguienteModel" type="button"
                                                            >Siguiente</button>
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-4">

                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-dark d-none d-lg-block">Total a
                                                                    Pagar</button>
                                                            </div>
                                                            <!-- /btn-group -->
                                                            <input type="text" class="form-control" id="totalPagarMu"
                                                                value="0" readOnly>
                                                            <input type="hidden" class="form-control" id="totalPagarMo"
                                                                value="0" readOnly>
                                                        </div>

                                                    </div>


                                                </div>

                                            </div>




                                            <div id="information-part" class="content" role="tabpanel"
                                                aria-labelledby="information-part-trigger">



                                                <!-- AGREGAR AQUI LOS DIVS -->

                                                <div class="row">

                                                    <div class="col-xs-12 col-lg-4">
                                                        <label class="mt-1">&nbsp;&nbspNombre Completo:</label>
                                                        <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                                            <div class="input-group-prepend">
                                                                <span style="font-size:15px;height: 35px"
                                                                    class="input-group-text"><i
                                                                        class="fas fa-user-tie"></i></span>
                                                            </div>
                                                            <input type="text" style="font-size:15px;height: 35px"
                                                                 class="form-control "
                                                                id="frmpagoNombre" name="frmpagoNombre"
                                                                placeholder="Nombre Completo">
                                                        </div>
                                                    </div>


                                                    <div class="col-xs-12 col-lg-4">
                                                    <label class="mt-1">&nbsp;&nbspTipo Cédula:</label>                                      
                                                    <div class="input-group" style=" width: 100%;">
                                                        <div class="input-group-prepend ">
                                                        <span style="font-size:15px;"  class="input-group-text "><i class="far fa-address-card"></i></span>
                                                        </div>
                                                    <select style="font-size:15px; " class="custom-select " id="frmpagoTced" name="frmpagoTced" required>
                                                        <option selected disabled value="" >Seleccionar Tipo Cédula</option>          
                                                        <option   value="01" >Fisico</option> 
                                                        <option   value="02" >Juridico</option> 
                                                        <option   value="03" >Dimex / Nite</option>                                                       
                                                    </select> 
                                                    </div>
                                                    <br>
                                                </div>

                                                    <div class="col-xs-12 col-lg-4">
                                                        <label class="mt-1">&nbsp;&nbspCédula:</label>
                                                        <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                                            <div class="input-group-prepend">
                                                                <span style="font-size:15px;height: 35px"
                                                                    class="input-group-text"><i
                                                                        class="far fa-address-card"></i></span>
                                                            </div>
                                                            <input type="text" style="font-size:15px;height: 35px"
                                                                class="form-control "
                                                                id="frmpagocedula" name="frmpagocedula"
                                                                placeholder="Cédula">
                                                        </div>
                                                    </div>



                                                    <div class="col-xs-12 col-lg-6">
                                                        <label class="mt-1">&nbsp;&nbspCorreo:</label>
                                                        <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                                            <div class="input-group-prepend">
                                                                <span style="font-size:15px;height: 35px"
                                                                    class="input-group-text"><i
                                                                        class="far fa-envelope"></i></span>
                                                            </div>
                                                            <input type="text" style="font-size:15px;height: 35px"
                                                                 class="form-control "
                                                                id="frmpagocorreo" name="frmpagocorreo"
                                                                placeholder="Correo">
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-lg-6">
                                                        <label class="mt-1">&nbsp;&nbspTeléfono:</label>
                                                        <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                                            <div class="input-group-prepend">
                                                                <span style="font-size:15px;height: 35px"
                                                                    class="input-group-text"><i
                                                                        class="fas fa-mobile-alt"></i></span>
                                                            </div>
                                                            <input type="number" style="font-size:15px;height: 35px"
                                                                 class="form-control "
                                                                id="frmpagotelefono" name="frmpagotelefono"
                                                                placeholder="Teléfono">
                                                        </div>
                                                    </div>


                                                    <div
                                                        class="col-6 col-sm-6 col-md-4 col-lg-4 justify-content-end">

                                                        <div class="input-group mb-3 mt-4">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-dark d-none d-lg-block">Total a
                                                                    Pagar</button>
                                                            </div>
                                                            <!-- /btn-group -->
                                                            <input type="text" class="form-control" id="totalPagarFinal"
                                                                value="0" readOnly>
                                                            <input type="hidden" class="form-control" id="totalPagarFinal"
                                                                value="0" readOnly>
                                                        </div>

                                                    </div>

                                                </div>




                                                <div class="col-sm-12 col-md-12col-lg-12">
                                                    <div class="card card-info shadow-sm">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Datos de pago</h3>

                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool"
                                                                    data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>

                                                        </div>


                                                        <?php 

$tipoPago = "TRANSFERENCIA";
$datosTransferencia = PlanesClientesController::ctrCargarDatosPago($tipoPago);
$tipoPago = "SINPE";
$datosSinpe = PlanesClientesController::ctrCargarDatosPago($tipoPago);

// echo '<pre>'; print_r($datosSinpe); echo '</pre>';


?>

                                                        <div class="card-body">
                                                            <div class="row">

                                                                <!-- <h4>Datos de pago</h4> -->
 

                                                                <!-- <div class="col-lg-6">                                                -->

                                                                <div class="col-12 col-sm-12 col-lg-12">
                                                                    <div class="card card-dark card-tabs">
                                                                        <div class="card-header p-0 pt-1">
                                                                            <ul class="nav nav-tabs"
                                                                                id="custom-tabs-one-tab" role="tablist">
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link active"
                                                                                        id="custom-tabs-one-transferencia-tab"
                                                                                        data-toggle="pill"
                                                                                        href="#custom-tabs-transferencia"
                                                                                        role="tab"
                                                                                        aria-controls="custom-tabs-one-home"
                                                                                        aria-selected="true">Pago con
                                                                                        transferencia</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link"
                                                                                        id="custom-tabs-one-sinpe-tab"
                                                                                        data-toggle="pill"
                                                                                        href="#custom-tabs-sinpe"
                                                                                        role="tab"
                                                                                        aria-controls="custom-tabs-one-profile"
                                                                                        aria-selected="false">Pago con
                                                                                        Sinpe movil</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link"
                                                                                        id="custom-tabs-one-tarjeta-tab"
                                                                                        data-toggle="pill"
                                                                                        href="#custom-tabs-tarjeta"
                                                                                        role="tab"
                                                                                        aria-controls="custom-tabs-one-messages"
                                                                                        aria-selected="false">Pago con
                                                                                        Tarjeta
                                                                                        (Proximamente)</a>
                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="tab-content"
                                                                                id="custom-tabs-one-tabContent">


                                                                                <div class="tab-pane fade show active"
                                                                                    id="custom-tabs-transferencia"
                                                                                    role="tabpanel"
                                                                                    aria-labelledby="custom-tabs-one-home-tab">

                                                                                    <p><strong>1.</strong> Para pagar
                                                                                        los Servicios, deposite el monto
                                                                                        total a una de las siguientes
                                                                                        cuentas:</p>
                                                                                    <div class="row">



                                                                                        <?php foreach ($datosTransferencia as $key => $value): ?>

                                                                                        
                                                                                        <div class="col-sm-12 col-md-12 col-lg-3">
                                                                                            <p><strong>Banco:</strong>
                                                                                                <?php echo $value["banco"] ?>
                                                                                            </p>
                                                                                            <p><strong>Cuenta:</strong>
                                                                                                <?php echo $value["cuenta"] ?>
                                                                                            </p>
                                                                                            <p><strong>Cuenta
                                                                                                    Cliente:</strong>
                                                                                                <?php echo $value["cuentaCliente"] ?>
                                                                                            </p>
                                                                                            <p><strong>Nombre:</strong>
                                                                                                <?php echo $value["nombreEmpresa"] ?>
                                                                                            </p>
                                                                                            <p><strong>Cédula:</strong>
                                                                                                <?php echo  $value["cedula"] ?>
                                                                                            </p>
                                                                                            <p><strong>Moneda:</strong>
                                                                                                <?php echo  $value["moneda"] ?>
                                                                                            </p>
                                                                                        </div>
                                                                                        <?php endforeach ?>


                                                                                    </div>

                                                                                    <p><strong>2.</strong> Una vez
                                                                                        realizado el pago, tome una foto
                                                                                        del comprobante y adjúntelo con
                                                                                        el botón de Adjuntar comprobante
                                                                                    </p>
                                                                                    <p><strong>3.</strong> Por último,
                                                                                        haga click en el botón de Enviar
                                                                                        comprobante para notificarnos
                                                                                        sobre su compra.</p>
                                                                                    <div
                                                                                        class="col-lg-12 ">
                                                                                        <div class="col-xs-12 col-lg-4">
                                                                                            <label
                                                                                                class="mt-1">&nbsp;&nbspComprobante Pago</label>
                                                                                            <div class="input-group mb-6 mt-2"
                                                                                                style=" width: 100%;">

                                                                                                <img src="views/img/users/default/anonymous.png"
                                                                                                    class="img-thumbnail"
                                                                                                    id="comptransferencia_vista"
                                                                                                    width="100px">

                                                                                                <input type="file"
                                                                                                    class="comptransferencia "
                                                                                                    id="comptransferencia"
                                                                                                    name="comptransferencia">

                                                                                                <p class="help-block">
                                                                                                    Peso máximo de la
                                                                                                    foto 4MB</p>


                                                                                            </div>
                                                                                        </div>





                                                                                    </div>

                                                                                </div>



                                                                                <div class="tab-pane fade"
                                                                                    id="custom-tabs-sinpe"
                                                                                    role="tabpanel"
                                                                                    aria-labelledby="custom-tabs-one-profile-tab">


                                                                                    <p><strong>1.</strong> Para pagar
                                                                                        los Servicios, realizar sinpe
                                                                                        con el monto total a una de las
                                                                                        siguientes cuentas:</p>

                                                                                        <div class="row">

                                                                                        <?php foreach ($datosSinpe as $key => $value): ?>

                                                                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                                                                        <p><strong>Banco:</strong>
                                                                                            <?php echo $value["banco"] ?>
                                                                                        </p>
                                                                                        <p><strong>Número Teléfono:</strong>
                                                                                            <?php echo $value["telefono"] ?>
                                                                                        </p>                                                                 
                                                                                        <p><strong>Nombre:</strong>
                                                                                            <?php echo $value["nombreEmpresa"] ?>
                                                                                        </p>
                                                                                        <p><strong>Cédula:</strong>
                                                                                            <?php echo  $value["cedula"] ?>
                                                                                        </p>
                                                                                        <p><strong>Moneda:</strong>
                                                                                            <?php echo  $value["moneda"] ?>
                                                                                        </p>
                                                                                    </div>
                                                                                    <?php endforeach ?>
                                                                                    </div>

                                                                                    <p><strong>2.</strong> Una vez
                                                                                        realizado el pago, tome una foto
                                                                                        del comprobante y adjúntelo con
                                                                                        el botón de Adjuntar comprobante
                                                                                    </p>
                                                                                    <p><strong>3.</strong> Por último,
                                                                                        haga click en el botón de Enviar
                                                                                        comprobante para notificarnos
                                                                                        sobre su compra.</p>

                                                                                        <div class="col-xs-12 col-lg-4">
                                                                                            <label
                                                                                                class="mt-1">&nbsp;&nbspComprobante Pago</label>
                                                                                            <div class="input-group mb-6 mt-2"
                                                                                                style=" width: 100%;">

                                                                                                <img src="views/img/users/default/anonymous.png"
                                                                                                    class="img-thumbnail"
                                                                                                    id="compSinpe_vista"
                                                                                                    width="100px">

                                                                                                <input type="file"
                                                                                                    class="compSinpe "
                                                                                                    id="compSinpe"
                                                                                                    name="compSinpe">

                                                                                                <p class="help-block">
                                                                                                    Peso máximo de la
                                                                                                    foto 4MB</p>


                                                                                            </div>
                                                                                        </div>

                                                                                </div>



                                                                                <div class="tab-pane fade"
                                                                                    id="custom-tabs-tarjeta"
                                                                                    role="tabpanel"
                                                                                    aria-labelledby="custom-tabs-one-messages-tab">

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <!-- /.card -->
                                                                    </div>
                                                                </div>

 

                                                                <!-- </div> -->



                                                                <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                                                    <button type="button" 
                                                                    class="btn btn-primary justify-content-end">Agregar</button>
                                                                </div> -->

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>




                                                <div class="row">

                                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 ">
                                                        <button class="btn btn-outline-primary" type="button"
                                                            onclick="stepper.previous()">Anterior</button>
                                                    </div>


                                                    <div
                                                        class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end">

                                                        <button type="button"
                                                            class="btn btn-outline-primary justify-content-end btnGuardaPaquetes">Guardar</button>

                                                    </div>


                                                </div>

                                                <!-- <button type="button" class="btn btn-primary justify-content-end">Pagar</button> -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">

                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>


                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <!-- <button type="button" class="btn btn-primary btnGuardarpaquetes">Guardar</button> -->
                </div>


            </form>


        </div>

    </div>

</div>