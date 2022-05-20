<?php
date_default_timezone_set('America/Costa_Rica');

// session_start();
$ID_empresa = $_SESSION['empresa'];
 

// $PlanesCliente = sidebarController::ctrCargarPlanesClientes($_SESSION["empresa"]);

// $IdPaquete = $PlanesCliente[0]["idPlan"];
// $cantDocumentos = $PlanesCliente[0]["cantDocumentos"];
// $nombrePaquete = $PlanesCliente[0]["nombrePlan"];
// $fechaCreacion = date("Y-m-d", strtotime($PlanesCliente[0]["fechaCreacion"]));
// $fechaFin = date("Y-m-d", strtotime($PlanesCliente[0]["fecha_fin"]));
// $hoy = $fechaCreacion;
// $hoy = date("Y/m/d");
// if($IdPaquete == ""){


// }else{

// $Planes = sidebarController::ctrCargarPlanesid($IdPaquete);

// echo '<pre>'; print_r($IdPaquete); echo '</pre>';

// if(strripos($Planes[0]["modulos"], "Facturacion")){

//     $CantFacturas = sidebarController::ctrCargarCantFacturas($_SESSION["empresa"], $fechaCreacion, $fechaFin);
//     $facturasRealizadas = $CantFacturas[0]["cantFact"];
    
// }

    // $date1 = new DateTime($hoy);
    // $date2 = new DateTime($fechaFin);

    /* esto no se descomenta
       
    $diff = abs($date1 - $date2);
    $años = floor($diff / (365*60*60*24));
    $meses = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
    $dias = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    
    
    */




    // $diff = date_diff($date2, $date1);
 
    // $años = $diff->y;
    // $meses = $diff->m;
    // $dias = $diff->days;
    // $invert = $diff->invert;


    // if($invert == "0"){

    //     if($años >= "0" && $meses >= "0" && $dias >= "0"){

    //         echo "<script>
    //         var Toast = Swal.mixin({
    //         toast: true,
    //         position: 'top-end',
    //         showConfirmButton: false,
    //         timer: 30000
    //     });
        
    //         Toast.fire({
    //             icon: 'warning',
    //             title: 'El paquete contratado se encuentra vencido.'
    //         })

    //         window.location ='home';

    //         </script>";

    //     }else if( $meses >= "0" && $dias >= "0"){

    //         echo "<script>
    //         var Toast = Swal.mixin({
    //         toast: true,
    //         position: 'top-end',
    //         showConfirmButton: false,
    //         timer: 30000
    //     });
        
    //         Toast.fire({
    //             icon: 'warning',
    //             title: 'El paquete contratado se encuentra vencido.'
    //         })

    //         window.location ='home';

    //         </script>";

    //     }else if($dias >= "0"){

    //         echo "<script>
    //         var Toast = Swal.mixin({
    //         toast: true,
    //         position: 'top-end',
    //         showConfirmButton: false,
    //         timer: 30000
    //     });
        
    //         Toast.fire({
    //             icon: 'warning',
    //             title: 'El paquete contratado se encuentra vencido.'
    //         })

    //         window.location ='home';

    //         </script>";

    //     }



    // }else if ($facturasRealizadas  >= $cantDocumentos){

    //     echo "<script>
    //     var Toast = Swal.mixin({
    //     toast: true,
    //     position: 'top-end',
    //     showConfirmButton: false,
    //     timer: 30000
    // });
    
    //     Toast.fire({
    //         icon: 'warning',
    //         title: 'El paquete contratado a exedido el limite de documentos contratados.'
    //     })


    //     window.location ='home';

    //     </script>";

        
    // }
// }

$clientes = FacturacionController::ctrCargarClientes($ID_empresa);

$sucursales = FacturacionController::ctrCargarSucursales($ID_empresa);

$Actividad = FacturacionController::ctrCargarActividadE($ID_empresa);

$monedas = FacturacionController::ctrCargarTipoMoneda();

$formas_pago = FacturacionController::ctrFormasPago();
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
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="card card-outline card-primary">

                        <div class="card-header">

                            <div class="col-xs-12 col-lg-8 float-right">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control " value="<?php  echo date('d-m-Y')  ?>"
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                        data-mask="" inputmode="numeric" disabled>
                                </div>
                            </div>
                        </div>
 
                        <div class="card-body">

                            <div class="row">

                                <div class="col-sm-12">

                                    <!-- id="btnNewClient" -->
                                    <div class="col-xs-12 col-lg-12">
                                        <div class="input-group" style=" width: 100%;">
                                            <div class="input-group-prepend">
                                                <span style="font-size:15px;" data-toggle="modal"
                                                    data-target="#modalCrearCliente"
                                                    title="Agregar o Actualizar Cliente" class="input-group-text "><i
                                                        class="fas fa-user-plus"></i></span>
                                            </div>
                                            <select class="custom-select " id="frmFactClient" name="frmFactClient"
                                                required>
                                                <option selected disabled value="">Seleccionar Cliente</option>
                                                <?php foreach ($clientes as $key => $value): ?>

                                                <option value="<?php echo $value["idtbl_empresas_clientes"];?>">
                                                    <?php echo $value["Nombre"];?></option>

                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12">
                                        <div class="input-group" style=" width: 100%;">
                                            <div class="input-group-prepend">
                                                <span style="font-size:15px; " class="input-group-text "><i
                                                        class="fas fa-bars"></i></span>
                                            </div>
                                            <select style="font-size:15px; " class="custom-select "
                                                id="frmFactActividad" name="frmFactActividad" required>
                                                <option selected disabled value="">Seleccionar Actividad Economica
                                                </option>
                                                <?php foreach ($Actividad as $key => $value): ?>

                                                    <?php if(count($sucursales) == 1){ ?>

                                                    <option value="<?php echo $value["codigo"];?>" selected>
                                                    <?php echo $value["nombre"];?></option>

                                                    <?php   }else{ ?>
                                                        <option value="<?php echo $value["codigo"];?>">
                                                    <?php echo $value["nombre"];?></option>

                                                    <?php   } ?>

                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12">
                                        <div class="input-group mb-6" style=" width: 100%;">
                                            <div class="input-group-prepend ">
                                                <span style="font-size:15px;" class="input-group-text"><i
                                                        class="far fa-address-card"></i></span>
                                            </div>
                                            <input type="text" style="font-size:15px;" class="form-control"
                                                id="frmFactced" name="frmFactced" prov="" cant="" dist=""
                                                autocomplete="off"  placeholder="Cédula">
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12">
                                        <div class="input-group" style=" width: 100%;">
                                            <div class="input-group-prepend ">
                                                <span style="font-size:15px;" class="input-group-text "><i
                                                        class="far fa-address-card"></i></span>
                                            </div>
                                            <select style="font-size:15px; " class="custom-select " id="frmFactTced"
                                                name="frmFactTced"  required>
                                                <option selected disabled value="">Seleccionar Tipo Cédula</option>
                                                <option value="01">Fisico</option>
                                                <option value="02">Juridico</option>
                                                <option value="03">Dimex / Nite</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                            </select>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12">
                                        <div class="input-group mb-6" style=" width: 100%;">
                                            <div class="input-group-prepend ">
                                                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" style="font-size:15px;" class="form-control"
                                                id="frmFactClientNombre" name="frmFactClientNombre"
                                                autocomplete="off"  placeholder="Nombre">
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12">
                                        <div class="input-group mb-6" style=" width: 100%;">
                                            <div class="input-group-prepend ">
                                                <span style="font-size:15px;" class="input-group-text"><i
                                                        class="far fa-envelope"></i></span>
                                            </div>
                                            <input type="text" style="font-size:15px;" class="form-control"
                                                id="frmFactmail" name="frmFactmail" autocomplete="off" 
                                                placeholder="Correo">
                                        </div>
                                        <br>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="input-group mb-6" style=" width: 100%;">
                                                <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text "><i
                                                            class="fas fa-store-alt"></i></span>
                                                </div>
                                                <select class="custom-select frmFactsucursal" id="frmFactsucursal"
                                                    name="frmFactsucursal" required>
                                                    <option selected disabled value="">Seleccionar Sucursal</option>
                                                    <?php foreach ($sucursales as $key => $value): ?>
                                                                                                       
                                                        <option value="<?php echo $value["idsucursal"];?>"
                                                            idSucursal="<?php echo $value["idtbl_sucursal"];?>">
                                                        <?php echo $value["nombre"];?></option>

                                                    <?php endforeach ?>
                                                    
                                                </select>
                                            </div>
                                            <br>
                                        </div>
 
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="input-group mb-6" style=" width: 100%;">
                                                <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text "><i
                                                            class="fas fa-cash-register"></i></span>
                                                </div>
                                                <select class="custom-select " id="frmFactcaja" name="frmFactcaja"
                                                    required>
                                                    <option selected disabled value="">Seleccionar Caja</option>
                                                </select>
                                            </div>
                                            <br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="input-group mb-6" style=" width: 100%;">
                                                <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text "><i
                                                            class="fas fa-coins"></i></span>
                                                </div>
                                                <select class="custom-select " id="frmFactTipoMoneda"
                                                    name="frmFactTipoMoneda" required>
                                                    <option selected disabled value="">Seleccionar Moneda</option>
                                                    <?php foreach ($monedas as $key => $value): ?>
                                                    <option value="<?php echo $value["codigo"];?>">
                                                        <?php echo $value["nombre"];?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <br>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="input-group mb-6" style=" width: 100%;">
                                                <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text ">CRC</span>
                                                </div>
                                                <input type="text" style="font-size:15px;" class="form-control"
                                                    id="frmFactMoneda" name="frmFactMoneda" autocomplete="off" required
                                                    readonly='false' placeholder="Valor">
                                            </div>
                                            <br>
                                        </div>
                                    </div>


                                    <!-- 
                                                    <div class="col-xs-12 col-lg-6">
                                            <label>&nbsp;&nbspServicios Contratados:</label>
                                            <div class="input-group" style=" width: 100%;">

                                                <select class="servicio_contratado select2" id="servicio_contratado"
                                                    name="servicio_contratado[]" multiple="" style="width: 100%;"
                                                    placeholder="Seleccionar Servicios" aria-hidden="true" required hidden>
                                                    

                                        <?php foreach ($planes as $key => $value): ?>

                                        <option value="<?php echo $value["nombre"];?>"><?php echo $value["nombre"];?>
                                        </option>

                                        <?php endforeach ?>


                                                </select>
                                            </div>
                                        </div> -->

                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12">
                                            <div class="input-group" style=" width: 100%;">
                                                <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text "><i
                                                            class="fas fa-money-check-alt"></i></span>
                                                </div>
                                                <select class="tipo_pago select2 custom-select" multiple="multiple"
                                                    aria-hidden="true" data-placeholder="Seleccionar Tipo Pago">
                                                    <!-- <option selected disabled value="">Tipo de Pago</option> -->
                                                    <option value="01">Efectivo</option>
                                                    <option value="02">Tarjeta</option>
                                                    <option value="04">Transferencia</option>
                                                    <option value="03">Cheque</option>
                                                </select>
                                            </div>
                                            <br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12">
                                            <div class="input-group" style=" width: 100%;">
                                                <div class="input-group-prepend">
                                                    <span style="font-size:15px;" class="input-group-text "><i class="fas fa-align-justify"></i></span>
                                                </div>
                                                <select class="custom-select" id="frmFactCondVenta" name="frmFactCondVenta" required>
                                                    <option selected disabled value="">Seleccionar Condición Venta</option>
                                                    <?php foreach ($formas_pago as $key => $value): ?>

                                                    <option value="<?php echo $value["codigo"];?>">
                                                        <?php echo $value["nombre"];?></option>

                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <br>
                                        </div>


                                        <div class="col-xs-12 col-lg-6">
                                            <div class="input-group mb-6" style=" width: 100%;">
                                                <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text "><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="number" style="font-size:15px;" class="form-control"
                                                    id="frmFactPlazoCred" name="frmFactPlazoCred" autocomplete="off" placeholder="Plazo Crédito (días)" value= '0' readOnly>
                                            </div>
                                            <br>
                                        </div>
                                    

                                    </div>




                                    <div class="row">

                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline ">
                                                    <input type="radio" id="radioFactura" name="r1" checked="">
                                                    <label for="radioFactura">Factura Electronica</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline ">
                                                    <input type="radio" id="radioTiquete" name="r1">
                                                    <label for="radioTiquete">Tiquete Electronico</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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

                                    <div class="row Agregar_Producto">
                                    </div>

                                    <button type="button"
                                        class="btn btn-outline-secondary d-block d-sm-none d-sm-block d-md-none btnAgregar_producto">Agregar
                                        producto</button>
                                    <br>

                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                            <label>&nbsp;&nbspTotal:</label>
                                            <div class="input-group mb-6" style=" width: 100%;">
                                                <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text"><i
                                                            class="monedaTotal"></i></span>
                                                </div>
                                                <input type="text" style="font-size:15px;" class="form-control"
                                                    id="frmFacttoSiniva" name="frmFacttoSiniva" required
                                                    placeholder="Total" disabled hidden>
                                                <input type="text" style="font-size:15px;" class="form-control"
                                                    id="frmFacttoSiniva2" name="frmFacttoSiniva2" required
                                                    placeholder="Total" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                            <label>&nbsp;&nbspTotal IVA:</label>
                                            <div class="input-group mb-6" style=" width: 100%;">
                                                <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text"><i
                                                            class="monedaTotal"></i></span>
                                                </div>
                                                <input type="text" style="font-size:15px;"
                                                    class="form-control frmFacttoIva" id="frmFacttoIva"
                                                    name="frmFacttoIva" required placeholder="Total" disabled hidden>
                                                <input type="text" style="font-size:15px;"
                                                    class="form-control frmFacttoIva2" id="frmFacttoIva2"
                                                    name="frmFacttoIva2" required placeholder="Total" disabled>
                                            </div>

                                        </div>


                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
                                            <!-- <label>&nbsp;&nbspComentarios:</label>                                 -->
                                            <div class="input-group mb-6 " style=" width: 100%;">
                                                <!-- <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text"><i class="monedaTotal"></i></span>
                                                </div> -->
                                                <textarea class="form-control" id="frmFactComent" name="frmFactComent"
                                                    rows="5" placeholder="Observaciones"></textarea>
                                            </div>
                                            <br>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                                            <!-- <button type="button" class="btn btn-outline-dark float-right  Facturar">Facturar</button> -->
                                            <button type="submit"
                                                class="btn btn-outline-primary   Facturar">Facturar</button>

                                            <!-- <a  href="machoteFactura?clave=50617012200310173144800100101010000000052100000052" rel="noopener" target="_blank" 
                                            class="btn btn-default"><i class="fas fa-print float-right"></i>Imprimir</a> -->
                                            <!--  -->
                                            <!-- 50615022200050385019700100002010000000020100000020 -->
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- /.col-md-6 -->
                <!-- d-sm-block d-md-none d-md-block d-lg-none-->
                <div class=" col-md-7 col-lg-7 d-none   d-md-block d-lg-none d-lg-block d-xl-none d-xl-block">
                    <div class="card card-outline card-success">
                        <!-- <div class="card-header">
 
                        </div> -->

                        <div class="card-body">

                            <button type="button" class="btn btn-primary" id="btnAgregarProducto"
                                title="Crea o modifica un producto">Agregar Producto</button>

                            <div class="row">

                                <div class="col-sm-12">

                                    <table class="table table-bordered table-striped dt-responsive "
                                        id="tblProductosFacturacion" width="100%" style="display: none;">

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
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->




<div class="modal" id="modalCrearCliente" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Agregar Datos Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">


                    <div class="col-xs-12 col-lg-6">
                            <!-- <label>&nbsp;&nbsp;Cédula:</label> -->
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text"><i class="far fa-address-card"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;" class="form-control" 
                                    id="frmAddCedulaCliente" name="frmAddCedulaCliente" placeholder="Cédula">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <!-- <label>:</label> -->
                            <div class="input-group mb-6 mt-2" style=" width: 100%;">
                                <div class="input-group-prepend ">
                                    <span style="font-size:15px;" class="input-group-text"><i class="far fa-address-card"></i></span>
                                </div>
                                <select style="font-size:15px;" class="custom-select" id="frmAddTpCedula"
                                    name="frmAddTpCedula" required>
                                    <option selected disabled value="">Tipo Cédula</option>
                                    <option value="01">Fisico</option>
                                    <option value="02">Juridico</option>
                                    <option value="03">Dimex/Nite</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                </select>
                            </div>

                        </div>


                        <div class="col-xs-12 col-lg-12">
                            <!-- <label>&nbsp;&nbsp;Nombre:</label> -->
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;" class="form-control" 
                                    id="frmAddNombreCliente" name="frmAddNombreCliente" placeholder="Nombre">
                            </div>

                        </div>
                     

                        <div class="col-xs-12 col-lg-12">
                            <!-- <label>&nbsp;&nbsp;Nombre:</label> -->
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;" class="form-control" 
                                    id="frmAddCorreoCliente" name="frmAddCorreoCliente" placeholder="Correo">
                            </div>

                        </div>

                        <?php
                        $listasPrecios = ReporteClientesController::ctrCargarListasPrecios();
                        ?>

                        <div class="col-xs-12 col-lg-12">
                            <!-- <label>&nbsp;&nbspListas De Precios:</label> -->
                            <div class="input-group mb-2 mt-2" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;" class="input-group-text "><i class="fas fa-list-ul"></i></span>
                                </div>
                                <select style="font-size:15px;height: 35px" class="custom-select frmAddListPrecio"
                                    id="frmAddListPrecio" name="frmAddListPrecio" required>
                                    <option selected disabled value="">Seleccionar Lista De Precio</option>

                                    <?php foreach ($listasPrecios as $key => $value): ?>

                                    <option value="<?php echo $value["idtbl_listas_precio"];?>">
                                        <?php echo $value["nombre"];?></option>


                                    <?php endforeach ?>

                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary btnGuardardtsClient">Guardar</button>

                </div>

            </form>
        </div>
    </div>
</div>








<style>
#btnNewClient:hover {
    background-color: #6C6C6C;
    color: #FFFFFF;
}

#btnNewClient:active {
    background-color: #9D9D9D;
    color: #FFFFFF;
}

label {
    display: inline-block;
    width: 5em;
}
</style>