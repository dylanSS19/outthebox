 <?php 
   
 // if($_SESSION["rol"]=="AllMarket-Admin" || $_SESSION["rol"]=="AllMarket-supervisor"){

  $rutas = EmisionFacturasController::Cargarutas();

 // }else{

//   $idUsuario = $_SESSION["id"];

  // $rutas = EmisionFacturasController::CargarutasXusuario($idUsuario);

 // } 
//  echo '<pre>'; print_r($rutas); echo '</pre>';
 
   ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">Emision Facturas</h1>
                 </div><!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                         <li class="breadcrumb-item active">Emision Facturas</li>
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



                             <!-- <div class="col-xs-12 col-lg-4 float-right">
                                 <div class="input-group" style=" width: 100%;">
                                     <div class="input-group-prepend">
                                          <span style="font-size:15px;height: 30px"  class="input-group-text "><i class="fa fa-bars"></i></span> 
                                     </div>
                                     <select style="font-size:15px;height: 30px" class="custom-select "
                                         id="rutas_vendedores" name="rutas_vendedores" required>
                                         <option selected disabled value="">Seleccionar...</option>

                                         <?php foreach ($rutas as $key => $value): ?>

                                         <option value="<?php echo $value["nombre"];?>"><?php echo $value["nombre"];?>
                                         </option>

                                         <?php endforeach ?>

                                     </select>
                                 </div>
                             </div> -->


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


                             <button type="button" class="btn btn-default " id="daterange-btn-emisionFact">

                                 <span>

                                     <i class="fa fa-calendar"></i> Rango de Fecha

                                 </span>

                                 <i class="fa fa-caret-down"></i>


                             </button>

                             <button class="btn btn-outline-secondary ml-4 float-right" data-toggle="modal"
                                 data-target="#modalCargarFacturas">

                                 Cargar Facturas

                             </button>

                             <button class="btn btn-outline-info ml-4 float-right" id="btnSelectAll">

                                 Seleccionar Todas

                             </button>

                             <button class="btn btn-outline-info ml-4 float-right" id="btnFacturarAll">

                                 Facturar

                             </button>


                         </div>

                         <div class="card-body">

                             <div class="row">

                                 <div class="col-sm-12">


                                     <table class="table table-bordered table-striped dt-responsive"
                                         id="tablaEmisionFacturas" width="100%">

                                         <thead>

                                             <tr>
                                                 <th style="width:5px">#</th>
                                                 <th>Acciones</th>
                                                 <th>Nombre</th>
                                                 <th>Cédula</th>
                                                 <th>Correo</th>
                                                 <th>Fecha Factura</th>
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




 <div class="modal" id="modalCargarFacturas" style="overflow-y: scroll;">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form role="form" method="post" enctype="multipart/form-data">

                 <div class="modal-header">
                     <h4 style="text-align: center;" class="modal-title">Cargar Facturas</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>

                 <div class="modal-body">

                     <div class="row">

                         <style type="text/css">
                         #csvFacturas {
                             opacity: 0;
                         }

                         #labelCsvFacturas {
                             position: absolute;
                             top: 50%;
                             left: 1rem;
                             transform: translateY(-50%);
                         }
                         </style>

                         <div class="col-12 col-lg-10 offset-lg-1">
                             <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">



                                 <input id="csvFacturas" name="csvFacturas" type="file" class="form-control border-0"
                                     accept=".csv" hasSelection={this.state.fileLoaded}
                                     onInputChange={this.handleFileLoad}>
                                 <label id="labelCsvFacturas" for="csvFacturas"
                                     class="font-weight-light text-muted">Elegir
                                     archivo</label>
                                 <div class="input-group-append">
                                     <label for="csvFacturas" class="btn btn-light m-0 rounded-pill px-4"> <i
                                             class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                             class="text-uppercase font-weight-bold text-muted">Elegir
                                             archivo</small></label>
                                 </div>

                             </div>
                             <label style="font-size:14px;" class="text-secondary"><em><b>Importante:</b> El archivo
                                     debe ser solamente en formato .csv</em></label>
                         </div>

                         <?php 

                        $ID_empresa = $_SESSION['empresa'];
                        $sucursales = FacturacionController::ctrCargarSucursales($ID_empresa);
                        $Actividad = FacturacionController::ctrCargarActividadE($ID_empresa);
                         ?>

                         <!-- <div class="row mt-4"> -->
                             <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-4">
                                 <div class="input-group mb-6" style=" width: 100%;">
                                     <div class="input-group-prepend ">
                                         <span style="font-size:15px;" class="input-group-text "><i
                                                 class="fas fa-store-alt"></i></span>
                                     </div>
                                     <select class="custom-select frmFactEmisucursal" id="frmFactEmisucursal"
                                         name="frmFactEmisucursal" required>
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

                             <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-4">
                                 <div class="input-group mb-6" style=" width: 100%;">
                                     <div class="input-group-prepend ">
                                         <span style="font-size:15px;" class="input-group-text "><i
                                                 class="fas fa-cash-register"></i></span>
                                     </div>
                                     <select class="custom-select " id="frmFactEmicaja" name="frmFactEmicaja" required>
                                         <option selected disabled value="">Seleccionar Caja</option>
                                     </select>
                                 </div>
                                 <br>
                             </div>
                         <!-- </div> -->

                         <div class="col-xs-12 col-lg-12">
                                        <div class="input-group" style=" width: 100%;">
                                            <div class="input-group-prepend">
                                                <span style="font-size:15px; " class="input-group-text "><i
                                                        class="fas fa-bars"></i></span>
                                            </div>
                                            <select style="font-size:15px; " class="custom-select "
                                                id="frmFactEmiActividad" name="frmFactEmiActividad" required>
                                                <option selected disabled value="">Seleccionar Actividad Economica
                                                </option>
                                                <?php foreach ($Actividad as $key => $value): ?>
                                                  
                                                  <option value="<?php echo $value["codigo"];?>">
                                                  <?php echo $value["nombre"];?></option>
                                               
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <br>
                                    </div>


                         <div class="col-xs-12 col-lg-12 mt-4">
                             <!-- <label class="mt-4">&nbsp;&nbspDocumentación</label> -->

                             <button class="btn btn-outline-primary documentacion" type="button">
                                 Descargar Documentación
                             </button>

                             <button class="btn btn-outline-primary btnAddFacturas float-right" type="button">

                                 Procesar Facturas

                             </button>

                         </div>

                     </div>

                 </div>

                 <div class="modal-footer justify-content-between">

                     <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                     <!-- <button type="button" class="btn btn-primary btnGuardarCliente">Guardar</button> -->

                 </div>

             </form>
         </div>
     </div>
 </div>