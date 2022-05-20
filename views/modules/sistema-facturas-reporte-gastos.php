<?php  

$ID_empresa = $_SESSION['empresa'];

$sucursales = FacturacionController::ctrCargarSucursales($ID_empresa);
$Actividad = FacturacionController::ctrCargarActividadE($ID_empresa);

?>
 
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">Reporte Gastos</h1>
                 </div><!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                         <li class="breadcrumb-item active">Gastos</li>
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




                             <!-- <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalFactGastos">
                  
                  Agregar Productos

                </button> -->


                             <button type="button" class="btn btn-default float-right" id="daterange-btn-ReportGastos">

                                 <span>

                                     <i class="fa fa-calendar"></i> Rango de Fecha

                                 </span>

                                 <i class="fa fa-caret-down"></i>

                             </button>

                         </div>

                         <div class="card-body">

                             <div class="row">

                                 <div class="col-sm-12">

                                     <table class="table table-bordered table-striped dt-responsive "
                                         id="tablaReportGastos" width="100%">

                                         <thead>

                                             <tr>
                                                 <th style="width:5px">#</th>
                                                 <th>Acciones</th>
                                                 <th>Nombre</th>
                                                 <th>Consecutivo</th>
                                                 <th>Fecha Factura</th>
                                                 <th>Total Factura</th>
                                             </tr>

                                         </thead>

                                         <tbody>




                                         </tbody>

                                         <tfoot>
                                             <tr>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td style="font-weight: bold;">Total:</td>
                                                 <td></td>

                                             </tr>

                                         </tfoot>


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


 <div class="modal" id="modalDfacturasGastos">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">

             <div class="modal-header">
                 <h4 style="text-align: center;" class="modal-title">Detalle Documento</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>

             <div class="modal-body">



                 <h6 class="ml-3"><strong>Datos Emisor</strong></h6>


                 <div class="col-xs-12 col-lg-6">
                     <div class="input-group mb-6" style=" width: 100%;">
                         <div class="input-group-prepend">
                             <span style="font-size:20px;height: 30px" class="input-group-text"><i class=""
                                     style="width: 65px;">Nombre:</i></span>
                         </div>
                         <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;" minlength="9"
                             class="form-control " id="FrmRepotGastnomEmisor" name="FrmRepotGastnomEmisor" disabled
                             placeholder="Nombre">
                     </div>
                 </div>



                 <div class="col-xs-12 col-lg-6">
                     <div class="input-group mb-6" style=" width: 100%;">
                         <div class="input-group-prepend">
                             <span style="font-size:20px;height: 30px" class="input-group-text"><i class=""
                                     style="width: 65px;">Cédula:</i></span>
                         </div>
                         <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;" minlength="9"
                             class="form-control " id="FrmRepotGastcedEmisor" name="FrmRepotGastcedEmisor" disabled
                             placeholder="Cédula">
                     </div>
                 </div>


                 <!-- <div class="col-xs-12 col-lg-6">
                     <div class="input-group mb-6" style=" width: 100%;">
                         <div class="input-group-prepend">
                             <span style="font-size:20px;height: 30px" class="input-group-text"><i class=""
                                     style="width: 65px;">Correo:</i></span>
                         </div>
                         <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;" minlength="9"
                             class="form-control " id="FrmRepotGastmailemisor" name="FrmRepotGastmailemisor" disabled placeholder="Correo">
                     </div>
                 </div> -->

                 <!-- <div class="row " > -->
                 <div class="col-xs-12 col-lg-7">
                     <div class="input-group mb-6" style=" width: 100%;">
                         <div class="input-group-prepend">
                             <span style="font-size:20px; height: 30px;" class="input-group-text"><i
                             style="width: 65px;" class="">Clave:</i></span>
                         </div>
                         <input type="text" style="font-size:20px;width: 30px;height: 30px;  background: #fbfbfb;"
                             minlength="9" class="form-control " id="FrmRepotGastclaveFacts"
                             name="FrmRepotGastclaveFacts" disabled placeholder="Clave Factura">
                     </div>
                     <!-- </div> -->

                 </div>
                 <br>



                 <div class="row">

                     <div class="col-xs-12 col-lg-12">

                         <table class="table table-bordered table-striped dt-responsive" id="tblDetalleFacGasto"
                             width="100%">

                             <thead>

                                 <tr>

                                     <th style="width:5px">#</th>
                                     <th>Nombre</th>
                                     <th>Codigo</th>
                                     <th>Cantidad</th>
                                     <th>Precio Unitario</th>
                                     <th>Sub Total</th>
                                     <th>Descuento</th>
                                     <th>Impuesto</th>
                                     <th>Total</th>

                                 </tr>

                             </thead>

                             <tbody>


                             </tbody>

                         </table>

                     </div>

                 </div>



                 <style type="text/css">
                 .tabla_totales {
                     width: 100%;
                     /*border: 1px solid #999;*/

                     border-collapse: collapse;
                     margin: 0 0 1em 0;
                     caption-side: top;
                     border-style: solid;
                     border-color: #FFFFFF;
                 }

                 .tableAbajoText {
                     text-align: left;
                     font-weight: bold;
                     font-style: Arial;
                     padding: 0.3em;
                     border-bottom: 1px solid #e0e0e1;
                     width: 25%;
                 }


                 .tableAbajoNum {
                     text-align: right;
                     font-weight: bold;
                     font-style: Arial;
                     padding: 0.3em;
                     border-bottom: 1px solid #e0e0e1;
                     width: 25%;
                 }


                 .titulo {

                     text-align: center;

                 }

                 .cont_table {
                     margin-top: 25px;
                 }
                 </style>

                 <div class=" container cont_table">

                     <div class="row">


                         <div class="col-xs-12 col-lg-6">
                             <div class="callout callout-info">
                                 <h5>
                                     <p>Procesar Documento</p>
                                 </h5>

                                 <!-- <div class="col-xs-12 col-lg-12"> -->

                                     <div class="row">


                                         <!-- <div class="row"> -->
                                         <div class="col-xs-12 col-lg-6">
                                             <!-- <label>&nbsp;&nbspTipo Documento:</label> -->
                                             <div class="input-group mt-1" style=" width: 100%;">
                                                 <div class="input-group-prepend">
                                                     <span style="font-size:15px;height: 35px"
                                                         class="input-group-text "><i class="fa fa-bars"></i></span>
                                                 </div>
                                                 <select style="font-size:15px;height: 35px" class="custom-select"
                                                     id="FrmRepotGastSucursal" name="FrmRepotGastSucursal">
                                                     <option selected disabled value="">Seleccionar Sucursal</option>
                                                     <?php foreach ($sucursales as $key => $value): ?>
                                                    <option value="<?php echo $value["idsucursal"];?>"
                                                        idSucursal="<?php echo $value["idtbl_sucursal"];?>">
                                                        <?php echo $value["nombre"];?></option>
                                                    <?php endforeach ?>
                                                 </select>
                                             </div>
                                         </div>


                                         <div class="col-xs-12 col-lg-6">

                                             <!-- <label>&nbsp;&nbspTipo Documento:</label> -->
                                             <div class="input-group mt-1" style=" width: 100%;">
                                                 <div class="input-group-prepend">
                                                     <span style="font-size:15px;height: 35px"
                                                         class="input-group-text "><i class="fa fa-bars"></i></span>
                                                 </div>
                                                 <select style="font-size:15px;height: 35px" class="custom-select"
                                                     id="FrmRepotGastCaja" name="FrmRepotGastCaja">
                                                     <option selected disabled value="">Seleccionar Caja</option>
                                                    
                                                 </select>
                                             </div>
                                         </div>


                                         <div class="col-xs-12 col-lg-12">
                                        <div class="input-group mt-1" style=" width: 100%;">
                                            <div class="input-group-prepend">
                                                <span style="font-size:15px; " class="input-group-text "><i
                                                        class="fas fa-bars"></i></span>
                                            </div>
                                            <select style="font-size:15px; " class="custom-select "
                                                id="FrmRepotGastActividad" name="FrmRepotGastActividad" required>
                                                <option selected disabled value="">Seleccionar Actividad Economica
                                                </option>
                                                <?php foreach ($Actividad as $key => $value): ?>

                                                <option value="<?php echo $value["codigo"];?>">
                                                    <?php echo $value["nombre"];?></option>

                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                      
                                    </div>

                                         <div class="col-xs-12 col-lg-12">
                                         <!-- <label>&nbsp;&nbspTipo Documento:</label> -->
                                         <div class="input-group mt-1" style=" width: 100%;">
                                             <div class="input-group-prepend">
                                                 <span style="font-size:15px;height: 35px" class="input-group-text "><i
                                                         class="fa fa-bars"></i></span>
                                             </div>
                                             <select style="font-size:15px;height: 35px" class="custom-select"
                                                 id="FrmRepotGastEstadoDoc" name="FrmRepotGastEstadoDoc">
                                                 <option selected disabled value="">Seleccionar Estado</option>
                                                 <option value="05">Aceptar</option>
                                                 <option value="06">Aceptación Parcial</option>
                                                 <option value="07">Rechazar</option>
                                             </select>
                                         </div>
                                     </div>


                                     <div class="col-xs-12 col-lg-12">
                                         <div class="input-group mb-12 mt-1" style=" width: 100%;">
                                             <div class="input-group-prepend">

                                             </div>
                                             <!-- <textarea  style="font-size:20px;height: 200px; background: #fbfbfb; word-wrap: break-word;word-break: break-all;"   class="form-control" id="observaciones" name="observaciones" disabled >   -->
                                             <textarea id="FrmRepotGastcoment" name="FrmRepotGastcoment" rows="3"
                                                 placeholder="Comentarios" style="width:100%;" wrap="hard"></textarea>
                                         </div>
                                     </div>

                                     <div class="col-xs-12 col-lg-12 ">
                                         <div class="input-group mb-12 mt-1 d-flex flex-column-reverse" style=" width: 100%;">
                                             <button type="button"
                                                 class="btn btn-outline-primary btnReportGastAceptacion">Enviar</button>
                                         </div>
                                     </div>

                                 </div>



                             </div>
                         </div>

                         <div class="col-xs-12 col-lg-2">


                         </div>

                         <div class="col-xs-12 col-lg-4">


                             <div class="callout callout-info">
                                 <h5>
                                     <p>Totales Factura</p>
                                 </h5>
                                 <div class="input-group mb-12" style=" width: 100%;">
                                     <div class="input-group-prepend">

                                     </div>

                                     <table class="tabla_totales">

                                         <thead>

                                             <tr>
                                                 <!-- <th class="titulo" colspan="2"><strong>Totales Factura</strong></th> -->
                                             </tr>

                                         </thead>

                                         <tbody>

                                             <tr>
                                                 <td class="tableAbajoText">Monto Neto:</td>
                                                 <td class="tableAbajoNum subGasto"></td>
                                             </tr>
                                             <tr>
                                                 <td class="tableAbajoText">Descuento:</td>
                                                 <td class="tableAbajoNum Gastodescuento"></td>
                                             </tr>
                                             <tr>
                                                 <td class="tableAbajoText">IVA:</td>
                                                 <td class="tableAbajoNum Gastoiva"></td>
                                             </tr>
                                             <tr>
                                                 <td class="tableAbajoText">Monto Total:</td>
                                                 <td class="tableAbajoNum Gastototal"></td>
                                             </tr>

                                         </tbody>

                                     </table>


                                 </div>
                             </div>


                         </div>



                     </div>

                 </div>


                 <!-- MODAL BODY -->

             </div>

             <div class="modal-footer justify-content-between">

                 <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

             </div>


         </div>
     </div>
 </div>