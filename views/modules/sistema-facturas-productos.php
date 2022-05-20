 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Admistración</a></li>
              <li class="breadcrumb-item active">Facturas</li>
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

                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalProductos">

                  Agregar Producto

                </button>

                <button class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#modalListaProductos">

                  Importar Lista De Productos

                </button>

<!--                   <button type="button" class="btn btn-default float-right" id="daterange-btn-SistemaFacturas" >

                  <span>

                    <i class="fa fa-calendar"></i> Rango de Fecha

                  </span>

                   <i class="fa fa-caret-down"></i>


                </button> -->

             </div>

              <div class="card-body">

                  <div class="row">

                    <div class="col-sm-12">



  <table class="table table-bordered table-striped dt-responsive tablaReportProductos" id="tablaReportProductos" width="100%">

                          <thead>

                            <tr>
                              <th style="width:5px">#</th>
                              <th>Acciones</th>
                              <th>SKU</th>
                              <th>Nombre</th>
                              <th>Cabys</th>
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


<!--          MODAL AGREGAR PRODUCTOS            -->
  <div class="modal" id="modalProductos" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Productos</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

         <div class="row">

          <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspCabys:</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <input type="text" class="form-control" style="font-size:20px;height: 50px; background: #fbfbfb;" id="frmProductolblsearch" name="frmProductolblsearch" >
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat" id="frmProductosearch"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><i class="fas fa-search"></i></font></font></button>
                </span>
            </div>
          <br>
          </div>

         <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspCódigo Comercial de Mercancia o Servicio:</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmProductoCodComercial" name="frmProductoCodComercial" required placeholder="Código" >
            </div>

         </div>


<?php

$unidadMedida = ProductosController::ctrCargarUnidadMedida();

$cod_impuesto = ProductosController::ctrCargarTimpuestos();

$tarifa_impuesto = ProductosController::ctrCargarTarifaImpuesto();

?>


        <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspUnidad de Medida:</label>
          <div class="input-group" style=" width: 100%;">
            <div class="input-group-prepend">
              <span style="font-size:15px; "  class="input-group-text "><i class="fas fa-mouse-pointer"></i></span>
            </div>
          <select style="font-size:15px; height: 50px; width: 90%;" class="custom-select " id="frmProductounidadMedidaProducto" name="frmProductounidadMedidaProducto" required>
            <option selected disabled value="" >Unidad Medida</option>
            <?php foreach ($unidadMedida as $key => $value): ?>

                <option value="<?php echo $value["idtbl_unidades_medida_hacienda"]; ?>"><?php echo $value["descripcion"]; ?></option>

            <?php endforeach?>
          </select>
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

<div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspImpuesto:</label>
          <div class="input-group" style=" width: 100%;">
            <div class="input-group-prepend">
              <span style="font-size:15px;"  class="input-group-text "><i class="fas fa-percentage"></i></span>
            </div>
          <select style="font-size:15px;  width: 90%;" class="custom-select " id="frmProductoCodImpuesto" name="frmProductoCodImpuesto" required>
            <option selected disabled value="" >Impuesto</option>
            <?php foreach ($cod_impuesto as $key => $value): ?>

<option value="<?php echo $value["idtbl_impuestos"]; ?>"><?php echo $value["nombre"]; ?></option>

<?php endforeach?>
          </select>
          </div>
        </div>

        <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspTarifa IVA:</label>
          <div class="input-group" style=" width: 100%;">
            <div class="input-group-prepend">
              <span style="font-size:15px; "  class="input-group-text "><i class="fas fa-percentage"></i></span>
            </div>
          <select style="font-size:15px; width: 90%;" class="custom-select " id="frmProductotarifaIva" name="frmProductotarifaIva" required>
            <option selected disabled value="" >Tarifa Impuesto</option>
            <?php foreach ($tarifa_impuesto as $key => $value): ?>

            <option value="<?php echo $value["idtbl_tarifa_impuestos"]; ?>"><?php echo $value["nombre"]; ?></option>

            <?php endforeach?>
          </select>
          </div>
        </div>

         <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspCantidad</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-edit"></i></span>
              </div>
              <input type="number" style="font-size:15px;"  class="form-control" id="frmProductocant" name="frmProductocant" required placeholder="Cantidad" >
            </div>
         </div>

         <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspCategoria del Producto:</label>
          <div class="input-group" style=" width: 100%;">
            <div class="input-group-prepend">
              <span style="font-size:15px; "  class="input-group-text "><i class="fas fa-align-justify"></i></span>
            </div>
          <select style="font-size:15px; " class="custom-select " id="frmProductoCategoria" name="frmProductoCategoria" required>
            <option selected disabled value="" >Categoria del Producto</option>
            <option value="Bien" >Bien</option>
            <option value="Servicio" >Servicio</option>
            <option value="No Sujeto" >No Sujeto</option>           
          </select>
          </div>
        </div>
     

         <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspDescripción</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <!-- <span style="font-size:15px;" class="input-group-text"><i class=""></i>₡</span> -->
              </div>
              <textarea class="form-control" id="frmProductodescripcion" name="frmProductodescripcion" rows="3" maxlength="200" required></textarea>
            </div>
         </div>

        </div>

      </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
           <button type="button" class="btn btn-primary btnGuardarProductos" >Guardar</button>

        </div>

      </form>
    </div>
  </div>
</div>


<div class="modal" id="modalEditarProductos" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Productos</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>
 
        <div class="modal-body">

         <div class="row">

          <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspCabys:</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <input type="text" class="form-control" style="font-size:20px;height: 50px; background: #fbfbfb;" id="frmProductoEditlblsearch" name="frmProductoEditlblsearch" >
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat" id="frmEditProductosearch"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><i class="fas fa-search"></i></font></font></button>
                </span>
            </div>
          <br>
          </div>

         <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspCódigo Comercial de Mercancia o Servicio:</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" readonly id="frmProductoEditCodComercial" name="frmProductoEditCodComercial" required placeholder="Código" >
            </div>

         </div>


<?php

$unidadMedida = ProductosController::ctrCargarUnidadMedida();

$cod_impuesto = ProductosController::ctrCargarTimpuestos();

$tarifa_impuesto = ProductosController::ctrCargarTarifaImpuesto();
?>


        <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspUnidad de Medida:</label>
          <div class="input-group" style=" width: 100%;">
            <div class="input-group-prepend">
              <span style="font-size:15px; height: 35px;"  class="input-group-text "><i class="fas fa-mouse-pointer"></i></span>
            </div>
          <select style="font-size:15px; height: 35px;" class="custom-select " id="frmProductoEditunidadMedidaProducto" name="frmProductoEditunidadMedidaProducto" required>
            <option selected disabled value="" >Seleccionar Unidad Medida</option>
            <?php foreach ($unidadMedida as $key => $value): ?>

                <option value="<?php echo $value["idtbl_unidades_medida_hacienda"]; ?>"><?php echo $value["descripcion"]; ?></option>

            <?php endforeach?>
          </select>
          </div>
        </div>

        <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspImpuesto:</label>
          <div class="input-group" style=" width: 100%;">
            <div class="input-group-prepend">
              <span style="font-size:15px;"  class="input-group-text "><i class="fas fa-percentage"></i></span>
            </div>
          <select style="font-size:15px;  width: 90%;" class="custom-select " id="frmProductoEditCodImpuesto" name="frmProductoEditCodImpuesto" required>
            <option selected disabled value="" >Impuesto</option>
            <?php foreach ($cod_impuesto as $key => $value): ?>

<option value="<?php echo $value["idtbl_impuestos"]; ?>"><?php echo $value["nombre"]; ?></option>

<?php endforeach?>
          </select>
          </div>
        </div>

        <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspTarifa IVA:</label>
          <div class="input-group" style=" width: 100%;">
            <div class="input-group-prepend">
              <span style="font-size:15px; height: 35px;"  class="input-group-text "><i class="fas fa-percentage"></i></span>
            </div>
          <select style="font-size:15px; height: 35px; " class="custom-select " id="frmProductoEdittarifaIva" name="frmProductoEdittarifaIva" required>
            <option selected disabled value="" >Seleccionar Unidad Medida</option>
            <?php foreach ($tarifa_impuesto as $key => $value): ?>

          <option value="<?php echo $value["idtbl_tarifa_impuestos"]; ?>"><?php echo $value["nombre"]; ?></option>

          <?php endforeach?>
          </select>
          </div>
        </div>

         <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspCantidad</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-edit"></i></span>
              </div>
              <input type="number" style="font-size:15px;"  class="form-control" id="frmProductoEditcant" name="frmProductoEditcant" required placeholder="Cantidad" >
            </div>
         </div>

         <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspCategoria del Producto:</label>
          <div class="input-group" style=" width: 100%;">
            <div class="input-group-prepend">
              <span style="font-size:15px; "  class="input-group-text "><i class="fas fa-align-justify"></i></span>
            </div>
          <select style="font-size:15px;" class="custom-select " id="frmProductoEditCategoria" name="frmProductoEditCategoria" required>
            <option selected disabled value="" >Categoria del Producto</option>
            <option value="Bien" >Bien</option>
            <option value="Servicio" >Servicio</option>
            <option value="No Sujeto" >No Sujeto</option>           
          </select>
          </div>
        </div>

         <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspDescripción</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <!-- <span style="font-size:15px;" class="input-group-text"><i class=""></i>₡</span> -->
              </div>
              <textarea class="form-control" id="frmProductoEditdescripcion" name="frmProductoEditdescripcion" rows="3" required></textarea>
            </div>
         </div>

<input type="text" class="form-control" style="font-size:20px;height: 50px; background: #fbfbfb;" id="id_cliente" name="id_cliente" hidden>

        </div>

      </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
           <button type="button" class="btn btn-primary btneditarProductos" >Guardar</button>

        </div>

      </form>
    </div>
  </div>
</div>
 

<div class="modal" id="modalListaPrecios">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- <form role="form" method="post" enctype="multipart/form-data" id="frmClientes"> -->
      <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Listas de Precios</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="card-body">

          <input id="idProductoModal" name="idProductoModal" type=hidden> </input>
          <input  id="sku" name="sku" type=hidden>
  

          <table class="table " id="tablaListaPrecios" width="100%">

            <thead >

              <tr>
                <th><strong>#</strong></th>
                <th style="display:none;">Identificador</th>
                <th class="js-dataTable-column" data-editable="false"><strong>Nombre Lista</strong></th>
                <th class="js-dataTable-column" data-editable="false"><strong>Precio Venta Sin IVA</strong></th>
                <th class="js-dataTable-column" data-editable="false"><strong>Costo</strong></th>
                <th class="js-dataTable-column" data-editable="false"><strong>Margen</strong></th>
                <th class="js-dataTable-column" data-editable="false"><strong>Porcentaje</strong></th>
              </tr>

            </thead>

            <tbody class="">


            </tbody>

            
           </table>

           <div class="row mt-5">
              <div class="col-2">
                  <div class="form-check">
                    <input class="form-check-input " type="radio" name="chkCostos" id="ultimo" value="ultimo" >
                    <label class="form-check-label" for="ultimo">
                      Último
                    </label>
                  </div>
              </div>
              <div class="col-2">
                <div class="form-check">
                  <input class="form-check-input " type="radio" name="chkCostos" id="promedio" value="promedio">
                  <label class="form-check-label" for="promedio">
                    Promedio
                  </label>
                </div>
              </div>
            </div>

        </div>

        <div class="modal-footer text-right">

           <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>

        </div>

      </div>
    </div>


      </div>



      <!-- </form>   -->
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
          <label>&nbsp;&nbspNombre Producto</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmProductoCabysSearch" name="frmProductoCabysSearch" required placeholder="Nombre" >
            </div>
            <br>
         </div>

        </div>

      <div class="row justify-content-end">
        <div class="col-xs-12 col-lg-2 justify-content-end">
          <div class="input-group mb-2" style=" width: 100%;">
            <div class='btn-group'>
              <button type="button" class="btn btn-outline-secondary BuscarCabys">Buscar</button>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-lg-12">
          <table class="table table-bordered table-striped dt-responsive " id="tablaProductos" width="100%">

            <thead >

              <tr>
                <th><strong>Acción</strong></th>
                <th><strong>Descripción</strong></th>
                <th><strong>Código</strong></th>
                <th><strong>Impuesto</strong></th>
              </tr>

            </thead>

            <tbody>


            </tbody>

           </table>



      </div>
    </div>


      </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
           

        </div>

      <!-- </form>   -->
    </div>
  </div>
</div>
<!-- FIN MODAL INFO PRODUCTOS -->


<!-- MODAL IMPORTAR LISTA PRODUCTOS -->

<div class="modal" id="modalListaProductos" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="text-align: center;" class="modal-title">Importar Lista De Productos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
              <div class="row">

              <div class="col-12 col-lg-10 offset-lg-1 mt-2">
                <label style="font-size:16px;" class="text-secondary"><em><b>Nota:</b> Si aun no tienes la el formato requerido, descarga el archivo 
                donde encontraras una guía y el machote con la estructura requerida.</em></label>
                <button type="button" class="btn btn-outline-primary btnDocumentacionProductos" id="btnDocumentacionProductos">Obtener Archivo</button>
              </div>
                <div class="col-12 col-lg-10 offset-lg-1 mt-3">
                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                        <input id="inputCsvProductos" name="inputCsvProductos" type="file" accept=".csv"
                            class="form-control border-0" >
                        <label id="labelCsvProductos" for="inputCsvProductos" class="font-weight-light text-muted">Elegir
                            archivo</label>
                        <div class="input-group-append">
                            <label for="inputCsvProductos" class="btn btn-light m-0 rounded-pill px-4"> <i
                                    class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                    class="text-uppercase font-weight-bold text-muted">Elegir archivo</small></label>
                        </div>
                        
                    </div>
                    <label style="font-size:14px;" class="text-secondary"><em><b>Importante:</b> El archivo debe ser solamente en formato .csv</em></label>
                </div>

              </div>


              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                  <button type="button" class="btn btn-primary btnGuardarListaProductos" id="btnGuardarListaProductos">Guardar</button>
              </div>
            </form>
        </div>
    </div>
</div>


<style>
  #inputCsvProductos {
      opacity: 0;
  }

  #labelCsvProductos {
      position: absolute;
      top: 50%;
      left: 1rem;
      transform: translateY(-50%);
  }

</style>