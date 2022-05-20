<?php 

date_default_timezone_set('America/Costa_Rica');

$ID_empresa = $_COOKIE['cookie_empresa'];

$ListasPrecios = CrearFactController::ctrCargarListaPrecios($ID_empresa);

$Clientes = CrearFactController::ctrCargarClientes($ID_empresa);

if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrador"){

    $usuario = "%";

}else{

    $usuario = $_SESSION["id"];

}



$Rutas = CrearFactController::ctrCargarRutas($usuario, $ID_empresa);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Facturación</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

        <div class="row">

            <div class="col-sm-12 col-md-15 col-lg-5">

                <div class="card card-outline card-primary">

                    <div class="card-header">
                        <div class="col-xs-12 col-lg-6 float-right">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control frmCrearFactFecha" value="<?php  echo date('d-m-Y');  ?>"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                    inputmode="numeric" iduser = "<?php  echo $_SESSION["user_name"];  ?>" disabled>
                            </div>

                            
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <style>
                            .select2-selection__rendered {
                                line-height: 31px !important;
                            }

                            .select2-container .select2-selection--single {
                                height: 35px !important;
                            }

                            .select2-selection__arrow {
                                height: 34px !important;
                            }
                            </style>

                            <div class="col-xs-12 col-lg-12">
                                <div class="input-group" style=" width: 100%;">
                                    <div class="input-group-prepend">
                                        <!-- <span style="font-size:15px; " class="input-group-text "><i
                                                class="far fa-user"></i></span> -->
                                    </div>
                                    <select style="font-size:15px; " class="custom-select select2"
                                        id="frmCrearFactClient" name="frmCrearFactClient" required>
                                        <option selected disabled value="">Seleccionar Cliente</option>
                                        <?php foreach ($Clientes as $key => $value): ?>

                                        <option value="<?php echo $value["idtbl_clientes"];?>" dCred="<?php echo $value["dias_credito"];?>">
                                            <?php echo $value["nombre"];?></option>

                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <br>
                            </div>

                            <div class="col-xs-12 col-lg-12">
                                <div class="input-group" style=" width: 100%;">
                                    <div class="input-group-prepend">
                                        <!-- <span style="font-size:15px; " class="input-group-text "><i
                                                class="far fa-user"></i></span> -->
                                    </div>
                                    <select style="font-size:15px; " class="custom-select select2"
                                        id="frmCrearFactTipCed" name="frmCrearFactTipCed" disabled required>
                                        <option selected disabled value="">Seleccionar Tipo Cédula</option>
                                        <option value="01">Fisica</option>
                                        <option value="02">Juridica</option>
                                        <option value="03">Dimex / Nite</option>
                                        <option value="Pasaporte">Pasaporte</option>

                                    </select>
                                </div>
                                <br>
                            </div>


                            <div class="col-xs-12 col-lg-12">
                                <div class="input-group mb-6" style=" width: 100%;">
                                    <div class="input-group-prepend ">
                                        <!-- <span style="font-size:15px;" class="input-group-text"><i
                                                class="far fa-address-card"></i></span> -->
                                    </div>
                                    <input type="text" style="font-size:15px;" class="form-control"
                                        id="frmCrearFactCedula" name="frmCrearFactCedula" autocomplete="off" disabled
                                        required placeholder="Cédula">
                                </div>
                                <br>
                            </div>


                            <div class="col-xs-12 col-lg-12">
                                <div class="input-group mb-6" style=" width: 100%;">
                                    <div class="input-group-prepend ">
                                        <!-- <span style="font-size:15px;" class="input-group-text"><i
                                                class="far fa-envelope"></i></span> -->
                                    </div>
                                    <input type="text" style="font-size:15px;" class="form-control"
                                        id="frmCrearFactMail" name="frmCrearFactMail" autocomplete="off" disabled
                                        required placeholder="Correo">
                                </div>
                                <br>
                            </div>

                            <div class="col-xs-12 col-lg-12">
                                <div class="input-group" style=" width: 100%;">
                                    <div class="input-group-prepend">
                                        <!-- <span style="font-size:15px; " class="input-group-text "><i
                                                class="far fa-user"></i></span> -->
                                    </div>
                                    <select style="font-size:15px; " class="custom-select select2" id="frmCrearFacRuta"
                                        name="frmCrearFacRuta" required>
                                        <option selected disabled value="">Seleccionar Ruta</option>
                                        <?php foreach ($Rutas as $key => $value): ?>

                                        <option value="<?php echo $value["idtbl_rutas"];?>"
                                            idBodega="<?php echo $value["id_bodega"];?>"
                                            inventario="<?php echo $value["valida_inventario"];?>"
                                            Factura="<?php echo $value["Factura_directa"];?>">
                                            <?php echo $value["nombre"];?></option>

                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <br>
                            </div>

                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 divPrevent" hidden>
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline ">
                                            <input type="radio" id="frmCrearFactPrevent" name="r4" checked="">
                                            <label for="frmCrearFactPrevent">Preventa</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 divDirect" hidden>
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline ">
                                            <input type="radio" id="frmCrearFactDirect" name="r3" >
                                            <label for="frmCrearFactDirect">Fact. Directa</label>
                                        </div>
                                    </div>
                                </div>

                            <div class="col-xs-12 col-lg-12">
                                <div class="input-group" style=" width: 100%;">
                                    <div class="input-group-prepend">
                                        <!-- <span style="font-size:15px; " class="input-group-text "><i
                                                class="far fa-user"></i></span>-->
                                    </div>
                                    <select style="font-size:15px; " class="custom-select select2"
                                        id="frmCrearFacTbodega" name="frmCrearFacTbodega" disabled required>
                                        <option selected disabled value="">Seleccionar Bodega</option>
                                    </select>
                                </div>
                                <br>
                            </div>

                            <div class="col-xs-12 col-lg-12">
                                <div class="input-group" style=" width: 100%;">
                                    <div class="input-group-prepend">
                                        <!-- <span style="font-size:15px; " class="input-group-text "><i
                                                class="far fa-user"></i></span> -->
                                    </div>
                                    <select style="font-size:15px; " class="custom-select select2" id="frmCrearConVenta"
                                        name="frmCrearConVenta" disabled required>
                                        <option selected disabled value="">Seleccionar Condición Venta</option>
                                        <option value="01">Contado</option>
                                        <option value="02">Credito</option>
                                    </select>
                                </div>
                                <br>
                            </div>

                            <div class="col-xs-12 col-lg-12">
                                <div class="input-group" style=" width: 100%;">
                                    <div class="input-group-prepend">
                                        <!-- <span style="font-size:15px; " class="input-group-text "><i
                                                class="far fa-user"></i></span> -->
                                    </div>
                                    <select style="font-size:15px; " class="custom-select select2"
                                        id="frmCrearFactLista" name="frmCrearFactLista" disabled required>
                                        <option selected disabled value="">Seleccionar Lista Precio</option>
                                        <?php foreach ($ListasPrecios as $key => $value): ?>

                                        <option value="<?php echo $value["codigo"];?>">
                                            <?php echo $value["nombre"];?></option>

                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <br>
                            </div>

                            <div class="col-xs-12 col-lg-12">

                                <select class="frmCrearFacttipo_pago select2" name="frmCrearFacttipo_pago[]" multiple="multiple" style="width: 100%;"
                                    aria-hidden="true" data-placeholder="Seleccionar Forma Pago" readonly>
                                    <!-- <option selected disabled value="">Tipo de Pago</option> -->
                                    <option value="01">Efectivo</option>
                                    <option value="02">Tarjeta</option>
                                    <option value="04">Transferencia</option>
                                    <option value="03">Cheque</option>
                                </select>
                                <br>
                            </div>

                            <!-- <div class="row"> -->
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 " >
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline ">
                                            <input type="radio" id="frmCrearFactFactura" name="r1">
                                            <label for="frmCrearFactFactura">Factura Elect.</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 " >
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline ">
                                            <input type="radio" id="frmCrearFactTiquete" name="r1" checked="">
                                            <label for="frmCrearFactTiquete">Tiquete Elect.</label>
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->

                            <div class="Addproductos">




                            </div>

                            <button type="button"
                                class="btn btn-outline-secondary d-block d-sm-none d-sm-block d-md-none btnAgregar_Prods">Agregar
                                producto</button>


                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                    <hr>
                                    <label>&nbsp;&nbspTotal:</label>
                                    <div class="input-group mb-6" style=" width: 100%;">
                                        <div class="input-group-prepend ">
                                            <span style="font-size:15px;" class="input-group-text"><i
                                                    class="">₡</i></span>
                                        </div>
                                        <input type="text" style="font-size:15px;" class="form-control"
                                            id="frmCrearFacttoSiniva" name="frmCrearFacttoSiniva" required
                                            placeholder="Total" disabled hidden>
                                        <input type="text" style="font-size:15px;" class="form-control"
                                            id="frmCrearFacttoSiniva2" name="frmCrearFacttoSiniva2" required
                                            placeholder="Total" disabled>
                                    </div>

                                </div>



                                <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                    <hr>
                                    <label>&nbsp;&nbspTotal IVA:</label>
                                    <div class="input-group mb-6" style=" width: 100%;">
                                        <div class="input-group-prepend ">
                                            <span style="font-size:15px;" class="input-group-text"><i
                                                    class="">₡</i></span>
                                        </div>
                                        <input type="text" style="font-size:15px;" class="form-control frmFacttoIva"
                                            id="frmCrearFacttoIva" name="frmCrearFacttoIva" required placeholder="Total"
                                            disabled hidden>
                                        <input type="text" style="font-size:15px;" class="form-control frmFacttoIva2"
                                            id="frmCrearFacttoIva2" name="frmCrearFacttoIva2" required
                                            placeholder="Total" disabled>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 ">
                                            <!-- <button type="button" class="btn btn-outline-dark float-right  Facturar">Facturar</button> -->
                                            <button type="button" class="btn btn-outline-dark   CreaFacturar">Guardar Pedido</button>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 ">
                                            <!-- <button type="button" class="btn btn-outline-dark float-right  Facturar">Facturar</button> -->
                                            <button type="button" class="btn btn-outline-dark  float-right  EmitFactura" hidden>Factura</button>
                            </div>


                        </div>

                    </div>

                </div>

            </div>


            <div class=" col-md-7 col-lg-7 d-none   d-md-block d-lg-none d-lg-block d-xl-none d-xl-block">

                <div class="card card-outline card-success">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-sm-12">

                                <table class="table table-bordered table-striped dt-responsive " id="tblProdCreFact"
                                    width="100%">

                                    <thead>

                                        <tr>
                                            <th>Nombre</th>
                                            <th>Código</th>
                                            <th>Precio Unitario</th>
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

            </div>

        </div>

    </div>
</div>