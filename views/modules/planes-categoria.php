<?php 
 
$planes = PlanesCategoriasController::ctrCargarPlanes();

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Planes </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Paquetes</li>
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

                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregarCat">

                                Agregar Paquete

                            </button>

                        </div>

                        <div class="card-body">

                            <div class="box-body">

                                <table class="table table-bordered table-striped dt-responsive" id="tablaPlanes"
                                    width="100%">

                                    <thead>

                                        <tr>

                                            <th style="width:5px">#</th>
                                            <th>Acciones</th>
                                            <th>Paquete</th>
                                            <th>Modulos Paquete</th>
                                            <th>Monto</th>

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


<!-- <i class="far fa-check-circle"></i> -->
<!-- <i class="far fa-window-close"></i> -->

 
<div class="modal " id="modalAgregarCat">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">
                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Crear Paquetes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                  

                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspModulos</label>
                            <div class="input-group mt-1" style=" width: 100%;">
                                <select class="ModulosPaquetes select2" id="ModulosPaquetes" name="ModulosPaquetes[]"
                                    multiple="" style="width: 100%;" placeholder="Seleccionar Servicios" readonly
                                    aria-hidden="true" required>
                                    <!-- <select style="font-size:25px;height: 50px" class="custom-select  editarservicio_contratado" id="editarservicio_contratado" name="editarservicio_contratado" required> -->
                                    <?php foreach ($planes as $key => $value): ?>

                                    <option value="<?php echo $value["nombre"];?>"><?php echo $value["nombre"];?>
                                    </option>

                                    <?php endforeach ?>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspNombre Paquete</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="text" style="font-size:15px; height: 35px" class="form-control "
                                    id="frmPlanescategorias" name="frmPlanescategorias" placeholder="Categoria Plan">
                            </div>

                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspSKU:</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-barcode"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" class="form-control "
                                    id="frmPlanessku" name="frmPlanessku" placeholder="SKU" value="">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-4">
                            <label class="mt-1">&nbsp;&nbspCabys:</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span class="input-group-append" style="font-size:15px;height: 35px">
                                        <button type="button" class="btn btn-info btn-flat" id="frmPlanessearchCabys">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" class="form-control "
                                    id="frmPlanescabys" name="frmPlanescabys" placeholder="Cabys" value="">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-4">
                            <label class="mt-1">&nbsp;&nbspCantidad Documentos:</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="number" style="font-size:15px;height: 35px" maxlength="3" minlength="3"
                                    class="form-control " id="frmPlanesdocumentos" name="frmPlanesdocumentos"
                                    placeholder="Cantidad Documentos" value="0">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-4">
                            <label class="mt-1">&nbsp;&nbspDias Paquete:</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="number" style="font-size:15px;height: 35px" maxlength="3" minlength="3"
                                    class="form-control " id="frmPlanesdias" name="frmPlanesdias"
                                    placeholder="Días Paquetes" value="0">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-3">
                            <label class="mt-1">&nbsp;&nbspMoneda:</label>
                            <div class="input-group mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text "><i
                                            class="fas fa-search-dollar"></i></span>
                                </div>
                                <select style="font-size:15px;height: 35px" class="custom-select "
                                    id="frmPlanesMoneda" name="frmPlanesMoneda" required>
                                    <option selected disabled value="">Seleccionar Moneda</option>
                                    <option  value="CRC">Colones</option>
                                    <option  value="USD">Dolares</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-3">

                            <label class="mt-1">&nbsp;&nbspCosto:</label>
                            <div class="input-group mb-6 mt-2" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="number" style="font-size:15px;height: 35px" maxlength="3" minlength="3"
                                    class="form-control " id="frmPlanesprecio" name="frmprecio" placeholder="Monto">
                            </div>
                        </div>

                        
                        


<?php 


$tarifa_impuesto = ProductosController::ctrCargarTarifaImpuesto();

// echo '<pre>'; print_r($tarifa_impuesto); echo '</pre>';

?>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspTarifa IVA:</label>
                            <div class="input-group mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text "><i
                                            class="fas fa-percentage"></i></span>
                                </div>
                                <select style="font-size:15px;height: 35px" class="custom-select "
                                    id="frmPlanestarifaIva" name="frmPlanestarifaIva" required>
                                    <option selected disabled value="">Tarifa Impuesto</option>
                                    <?php foreach ($tarifa_impuesto as $key => $value): ?>

                                    <option value="<?php echo $value["codigo_tarifa"];?>" tarifa="<?php echo $value["tarifa_iva"];?>">
                                        <?php echo $value["nombre"];?></option>

                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>


                    </div>

                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary frmPlanesbtnGuardarCat">Guardar</button>
                </div>


            </form>


        </div>

    </div>

</div>






<div class="modal " id="modaleditarPlanes">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">
                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Editar Planes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">

                            
                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspModulos</label>
                            <div class="input-group mt-1" style=" width: 100%;">
                                <select class="frmeditplanes select2" id="frmeditplanes" name="frmeditplanes[]"
                                    multiple="" style="width: 100%;" placeholder="Seleccionar Servicios" readonly
                                    aria-hidden="true" required disabled>
                                    <!-- <select style="font-size:25px;height: 50px" class="custom-select  editarservicio_contratado" id="editarservicio_contratado" name="editarservicio_contratado" required> -->
                                    <?php foreach ($planes as $key => $value): ?>

                                    <option value="<?php echo $value["nombre"];?>"><?php echo $value["nombre"];?>
                                    </option>

                                    <?php endforeach ?>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                    <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspNombre Paquete</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="text" style="font-size:15px; height: 35px" class="form-control "
                                    id="frmeditcategorias" name="frmeditcategorias" placeholder="Categoria Plan">
                            </div>

                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <label class="mt-1">&nbsp;&nbspSKU:</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-barcode"></i></span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" class="form-control "
                                    id="frmeditPlanessku" name="frmeditPlanessku" placeholder="SKU" value="">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-4">
                            <label class="mt-1">&nbsp;&nbspCabys:</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span class="input-group-append" style="font-size:15px;height: 35px">
                                        <button type="button" class="btn btn-info btn-flat" id="frmPlaneseditsearchCabys">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <input type="text" style="font-size:15px;height: 35px" class="form-control "
                                    id="frmeditPlanescabys" name="frmeditPlanescabys" placeholder="Cabys" value="">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-4">
                            <label class="mt-1">&nbsp;&nbspCantidad Documentos:</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="number" style="font-size:15px;height: 35px" maxlength="3" minlength="3"
                                    class="form-control " id="frmeditdocumentos" name="frmeditdocumentos"
                                    placeholder="Cantidad Documentos" value="0">
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-4">
                            <label class="mt-1">&nbsp;&nbspDias Paquete:</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="number" style="font-size:15px;height: 35px" maxlength="3" minlength="3"
                                    class="form-control " id="frmeditPlanesdias" name="frmeditPlanesdias"
                                    placeholder="Días Paquetes" value="0">
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-4">
                            <label class="mt-1">&nbsp;&nbspMoneda:</label>
                            <div class="input-group mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text "><i
                                            class="fas fa-search-dollar"></i></span>
                                </div>
                                <select style="font-size:15px;height: 35px" class="custom-select "
                                    id="frmeditMoneda" name="frmeditMoneda" required>
                                    <option selected disabled value="">Seleccionar Moneda</option>
                                    <option  value="CRC">Colones</option>
                                    <option  value="USD">Dolares</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-4">

                            <label class="mt-1">&nbsp;&nbspCosto:</label>
                            <div class="input-group mb-6 mt-1" style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                            class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="number" style="font-size:15px;height: 35px" maxlength="3" minlength="3"
                                    class="form-control " id="frmeditprecio" name="frmeditprecio" placeholder="Monto">
                            </div>
                        </div>

                       

                    </div>


                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary btneditarCat">Guardar</button>
                </div>


            </form>


        </div>

    </div>

</div>



<div class="modal" id="modalCabys">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- <form role="form" method="post" enctype="multipart/form-data" id="frmClientes"> -->

            <div class="modal-header">
                <h4 style="text-align: center;" class="modal-title">Buscar Cabys</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-xs-12 col-lg-12">
                        <label>&nbsp;&nbspDescripción Porducto</label>
                        <div class="input-group mb-6" style=" width: 100%;">
                            <div class="input-group-prepend">
                                <span style="font-size:15px;" class="input-group-text"><i
                                        class="fas fa-search"></i></span>
                            </div>
                            <input type="text" style="font-size:15px;" class="form-control" id="frmPanesCabysSearch"
                                name="frmPanesCabysSearch" required placeholder="Nombre">
                        </div>
                        <br>
                    </div>

                </div>

                <div class="row justify-content-end">
                    <div class="col-xs-12 col-lg-2 justify-content-end">
                        <div class="input-group mb-2" style=" width: 100%;">
                            <div class='btn-group'>
                                <button type="button"
                                    class="btn btn-outline-secondary frmPanesBuscarCabys">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <table class="table table-bordered table-striped dt-responsive " id="frmPanestablaCabys"
                            width="100%">

                            <thead>

                                <tr>
                                    <th><strong>Acción</strong></th>
                                    <th><strong>Descripción</strong></th>
                                    <th><strong>Código</strong></th>
                                    <th><strong>Impuesto</strong></th>
                                </tr>

                            </thead>

                            <tbody class="">


                            </tbody>

                        </table>



                    </div>
                </div>

            </div>

            <div class="modal-footer justify-content-between">

                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-primary btnEnviarCorreo">Enviar</button>

            </div>

            <!-- </form>   -->
        </div>
    </div>
</div>