 <?php 
 $PlanesCliente = sidebarController::ctrCargarPlanesClientes($_SESSION["empresa"]);

$IdPaquete = $PlanesCliente[0]["idPlan"];
$cantDocumentos = $PlanesCliente[0]["cantDocumentos"];
$nombrePaquete = $PlanesCliente[0]["nombrePlan"];
$fechaCreacion = date("Y-m-d", strtotime($PlanesCliente[0]["fechaCreacion"]));
$fechaFin = date("Y-m-d", strtotime($PlanesCliente[0]["fecha_fin"]));
// $hoy = $fechaCreacion;
$desabilitar = "";
$vencido = "No";
$hoy = date("Y/m/d");
// echo '<pre>'; print_r($IdPaquete); echo '</pre>';

if($IdPaquete == ""){


}else{

$Planes = sidebarController::ctrCargarPlanesid($IdPaquete);

if(strripos($Planes[0]["modulos"], "Facturacion")){

    $CantFacturas = sidebarController::ctrCargarCantFacturas($_SESSION["empresa"], $fechaCreacion, $fechaFin);
    $facturasRealizadas = $CantFacturas[0]["cantFact"];
    
}

    $date1 = new DateTime($hoy);
    $date2 = new DateTime($fechaFin);

    // $diff = abs($date1 - $date2);
    // $años = floor($diff / (365*60*60*24));
    // $meses = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
    // $dias = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    $diff = date_diff($date2, $date1);
 
    $años = $diff->y;
    $meses = $diff->m;
    $dias = $diff->days;
    $invert = $diff->invert;


    if($invert == "0"){

        if($años >= "0" && $meses >= "0" && $dias >= "0"){

            echo "<script>
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 30000
        });
        
            Toast.fire({
                icon: 'warning',
                title: 'El paquete contratado se encuentra vencido.'
            })

            </script>";

            $desabilitar = "disabled";
            $vencido = "Si";
        }else if( $meses >= "0" && $dias >= "0"){

            echo "<script>
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 30000
        });
        
            Toast.fire({
                icon: 'warning',
                title: 'El paquete contratado se encuentra vencido.'
            }) 

            </script>";

            $desabilitar = "disabled";
            $vencido = "Si";
        }else if($dias >= "0"){

            echo "<script>
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 30000
        });
        
            Toast.fire({
                icon: 'warning',
                title: 'El paquete contratado se encuentra vencido.'
            })
           
            </script>";

            $desabilitar = "disabled";
            $vencido = "Si";
        }


    }else if ($facturasRealizadas  >= $cantDocumentos){

        echo "<script>
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 30000
    });
    
        Toast.fire({
            icon: 'warning',
            title: 'El paquete contratado a exedido el limite de documentos contratados.'
        })

        </script>";

        $desabilitar = "disabled";
        $vencido = "Si";
    }
}
 
 ?>
 
 
 
 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Facturas</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                          <li class="breadcrumb-item active">Facturas</li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>
 
      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">

                      <div class="card">
                          <!-- /.card-header -->
                          <!-- <div class="card-body">


                          </div> -->
                          <!-- /.card-body -->
                      </div>




                      <!-- /.card -->
                      <div class="card">

                          <div class="card-header">

                              <div class="row">

                                  <!-- <div class="col-xs-12 col-lg-12"> -->
                                  <div class="col-xs-12 col-lg-4 ">
                                      <label>&nbsp;&nbspCédula:</label>
                                      <div class="input-group mb-6" style=" width: 100%;">
                                          <div class="input-group-prepend">
                                              <span style="font-size:15px;height: 30px" class="input-group-text"><i
                                                      class="fa fa-id-card"></i></span>
                                          </div>
                                          <input type="text" style="font-size:15px;height: 30px" class="form-control"
                                              id="cedulaBuscar" name="cedulaBuscar" required placeholder="Cédula">
                                      </div>
                                  </div>


                                  <div class="col-xs-12 col-lg-4 ">
                                      <label>&nbsp;&nbspConsecutivo:</label>
                                      <div class="input-group mb-6" style=" width: 100%;">
                                          <div class="input-group-prepend">
                                              <span style="font-size:15px;height: 30px" class="input-group-text"><i
                                                      class="fa fa-hashtag"></i></span>
                                          </div>
                                          <input type="text" style="font-size:15px;height: 30px" class="form-control"
                                              id="consecutivoBuscar" name="consecutivoBuscar" required
                                              placeholder="Consecutivo">
                                      </div>
                                  </div>

                                  <br>

                                  <div class="col-xs-12 col-lg-4">
                                      <label>&nbsp;&nbspEstado:</label>
                                      <div class="input-group" style=" width: 100%;">
                                          <div class="input-group-prepend">
                                              <span style="font-size:15px;height: 30px" class="input-group-text "><i
                                                      class="fa fa-bars"></i></span>
                                          </div>
                                          <select style="font-size:15px;height: 30px"
                                              class="custom-select  estadoFactura" id="estadoFactura"
                                              name="estadoFactura" required>
                                              <option selected  value="%">Todos</option>
                                              <option value="Aceptado">Aceptado</option>
                                              <option value="Rechazado">Rechazado</option>
                                          </select>
                                      </div>
                                  </div>

                                  <br>

                                  <div class="col-xs-12 col-lg-4">
                                      <br>
                                      <label>&nbsp;&nbspTipo Documento:</label>
                                      <div class="input-group" style=" width: 100%;">
                                          <div class="input-group-prepend">
                                              <span style="font-size:15px;height: 30px" class="input-group-text "><i
                                                      class="fa fa-bars"></i></span>
                                          </div>
                                          <select style="font-size:15px;height: 30px"
                                              class="custom-select  tipodocumento" id="tipodocumento"
                                              name="tipodocumento" required>
                                              <option selected disabled value="">Seleccionar...</option>
                                              <option value="01">Factura Electronica</option>
                                              <option value="04">Tiquete Electronico</option>
                                              <option value="03">Nota Credito</option>
                                              <option value="02">Nota Debito</option>
                                          </select>
                                      </div>
                                  </div>

                                  <!-- </div> -->
                              </div>



                              <br>
                              <button type="button" class="btn btn-default " id="daterange-btn-SistemaFacturas">

                                  <span>

                                      <i class="fa fa-calendar"></i> Rango de Fecha

                                  </span>

                                  <i class="fa fa-caret-down"></i>


                              </button>


                              <button class="btn btn-outline-primary float-right buscarFacturas">

                                  Buscar

                              </button>

                          </div>



                          <div class="card-body">
                              <!-- <table id="tablaSistemaFacturas" class="table table-bordered table-hover" width="100%"> -->
                              <div class="box-body">
                                  <table 
                                      class="table table-bordered table-striped dt-responsive" id="tablaSistemaFacturas" width="100%">

                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Estado</th>
                                              <th>Acciones</th>
                                              <th>Fecha</th>
                                              <th>Consecutivo</th>
                                              <th>Tipo Documento</th>
                                              <th>Nombre Cliente</th>
                                              <th>Moneda</th>
                                              <th>Total</th>
                                          </tr>
                                      </thead>
                                      <tbody>


                                      </tbody>

                                      <tfoot >
      <tr>
        <td></td>
        <td></td>          
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>      
        <td ></td>  
        <td  style="font-weight: bold;">Total:</td>
        <td></td>
   
      </tr> 

                  
  </tfoot> 


                                  </table>
                              </div>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->


                  </div>
                  <!-- /.col -->
              </div>
              <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




  <div class="modal" id="modalDfacturas">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">

              <div class="modal-header">
                  <h4 style="text-align: center;" class="modal-title">Detalle Documento</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body">





                  <h6 class="ml-3"><strong>Datos Receptor</strong></h6>


                  <div class="col-xs-12 col-lg-6">
                      <div class="input-group mb-6" style=" width: 100%;">
                          <div class="input-group-prepend">
                              <span style="font-size:20px;height: 30px" class="input-group-text"><i class=""
                                      style="width: 65px;">Nombre:</i></span>
                          </div>
                          <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;" minlength="9"
                              class="form-control " id="nomReceptor" name="nomReceptor" disabled placeholder="Nombre">
                      </div>
                  </div>



                  <div class="col-xs-12 col-lg-6">
                      <div class="input-group mb-6" style=" width: 100%;">
                          <div class="input-group-prepend">
                              <span style="font-size:20px;height: 30px" class="input-group-text"><i class=""
                                      style="width: 65px;">Cédula:</i></span>
                          </div>
                          <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;" minlength="9"
                              class="form-control " id="cedReceptor" name="cedReceptor" disabled placeholder="Cédula">
                      </div>
                  </div>


                  <div class="col-xs-12 col-lg-6">
                      <div class="input-group mb-6" style=" width: 100%;">
                          <div class="input-group-prepend">
                              <span style="font-size:20px;height: 30px" class="input-group-text"><i class=""
                                      style="width: 65px;">Correo:</i></span>
                          </div>
                          <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;" minlength="9"
                              class="form-control " id="mailReceptor" name="mailReceptor" disabled placeholder="Correo">
                      </div>
                  </div>

                  <br>


                  <div class="row clvNotas" hidden>
                      <div class="col-xs-12 col-lg-6">
                          <div class="input-group mb-6" style=" width: 100%;">
                              <div class="input-group-prepend">
                                  <span style="font-size:20px;height: 30px" class="input-group-text"><i class=""
                                          style="width: 85px;">Referencia:</i></span>
                              </div>
                              <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;" minlength="9"
                                  class="form-control " id="clvDocumento" name="clvDocumento" disabled
                                  placeholder="Referencia Factura">
                          </div>
                      </div>

                  </div>
                  <br>

                  <div class="row ml-3">
                      <div class="col-xs-12 col-lg-2" style="height: 40px;">
                          <div class="input-group" style=" width: 100%;">
                              <div class='btn-group'>
                                  <button type="button" class="btn btn-outline-secondary btnCorreo" idFactura="">Reenvio
                                      Correo</button>
                              </div>
                          </div>
                      </div>

                      <div class="col-xs-12 col-lg-2" style="height: 40px;">
                          <div class="input-group mb-2" style=" width: 100%;">
                              <div class='btn-group'>
                                  <button type="button" class="btn btn-outline-danger btnEliminar" idFactura="" vencido="<?php echo $vencido; ?>" <?php echo $desabilitar; ?>>Nota
                                      Crédito</button>
                              </div>
                          </div>
                      </div>

                      <div class="col-xs-12 col-lg-2" style="height: 40px;">
                          <div class="input-group" style=" width: 100%;">
                              <div class='btn-group'>
                                  <button type='button' class='btn btn-outline-secondary'
                                      style="cursor: pointer;">Documentos</button>
                                  <button type='button' class='btn btn-default dropdown-toggle dropdown-icon'
                                      style="cursor: pointer;" data-toggle='dropdown'> <span class='sr-only'>Toggle
                                          Dropdown</span></button>
                                  <div class='dropdown-menu' style="cursor: pointer;" role='menu'><a
                                          class='dropdown-item btnImprimir' idFactura="" comp="">Ver PDF</a><a
                                          class='dropdown-item descargar' idF="" Clv="">Descargar Documentos</a></div>
                              </div>
                          </div>
                      </div>
                  </div>


                  <div class="row">

                      <div class="col-xs-12 col-lg-12">

                          <table class="table table-bordered table-striped dt-responsive" id="tblDetalleFac"
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
                                      <p>Observaciones</p>
                                  </h5>
                                  <div class="input-group mb-12" style=" width: 100%;">
                                      <div class="input-group-prepend">

                                      </div>
                                      <!-- <textarea  style="font-size:20px;height: 200px; background: #fbfbfb; word-wrap: break-word;word-break: break-all;"   class="form-control" id="observaciones" name="observaciones" disabled >   -->
                                      <textarea id="observaciones" name="observaciones" rows="5" style="width:100%;"
                                          wrap="soft" disabled> </textarea>
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
                                          <td class="tableAbajoNum Mneto"></td>
                                      </tr>
                                      <tr>
                                          <td class="tableAbajoText">Descuento:</td>
                                          <td class="tableAbajoNum Mdescuento"></td>
                                      </tr>
                                      <tr>
                                          <td class="tableAbajoText">IVA:</td>
                                          <td class="tableAbajoNum Miva"></td>
                                      </tr>
                                      <tr>
                                          <td class="tableAbajoText">Monto Total:</td>
                                          <td class="tableAbajoNum Mtotal"></td>
                                      </tr>

                                  </tbody>

                              </table>
									  

                                  </div>
                              </div>

                              <!-- <table class="tabla_totales">

                                  <thead>

                                      <tr>
                                          <th class="titulo" colspan="2"><strong>Totales Factura</strong></th>
                                      </tr>

                                  </thead>

                                  <tbody>

                                      <tr>
                                          <td class="tableAbajoText">Monto Neto:</td>
                                          <td class="tableAbajoNum Mneto"></td>
                                      </tr>
                                      <tr>
                                          <td class="tableAbajoText">Descuento:</td>
                                          <td class="tableAbajoNum Mdescuento"></td>
                                      </tr>
                                      <tr>
                                          <td class="tableAbajoText">IVA:</td>
                                          <td class="tableAbajoNum Miva"></td>
                                      </tr>
                                      <tr>
                                          <td class="tableAbajoText">Monto Total:</td>
                                          <td class="tableAbajoNum Mtotal"></td>
                                      </tr>

                                  </tbody>

                              </table> -->








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


  <div class="modal" id="modalCorreo">
      <div class="modal-dialog modal-xs">
          <div class="modal-content">
              <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

                  <div class="modal-header">
                      <h4 style="text-align: center;" class="modal-title">Correo</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="modal-body">

                      <div class="row">

                          <div class="col-xs-12 col-lg-12">
                              <div class="callout callout-danger">
                                  <h5>
                                      <p class="estadoCorreo">Correo Enviado</p>
                                  </h5>
                                  <div class="input-group mb-12" style=" width: 100%;">
                                      <div class="input-group-prepend">
                                          <span style="font-size:20px;height: 32px" class="input-group-text"><i class=""
                                                  style="width: 65px;">a</i></span>
                                      </div>
                                      <input type="text" style="font-size:20px;height: 32px; background: #fbfbfb;"
                                          minlength="9" class="form-control " id="mailReenvioReceptor"
                                          name="mailReenvioReceptor" disabled>
                                  </div>
                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-12">
                              <div class="input-group mb-12" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:20px;height: 32px" class="input-group-text"><i class=""
                                              style="width: 65px;">Correo:</i></span>
                                  </div>
                                  <input type="text" style="font-size:20px;height: 32px; background: #fbfbfb;"
                                      minlength="9" class="form-control " id="mailReenvio" name="mailReenvio"
                                      placeholder="Correo">

                              </div>
                              <br>
                          </div>

                          <div class="col-xs-12 col-lg-12">
                              <div class="input-group mb-12" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <!-- <span style="font-size:20px;height: 32px" class="input-group-text"><i class="" style="width: 65px;">Correo:</i></span> -->
                                  </div>
                                  <p><strong>Ingresar los correos separados por una coma.</strong></p>
                              </div>
                              <br>
                          </div>

                      </div>

                  </div>

                  <div class="modal-footer justify-content-between">

                      <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                      <button type="button" class="btn btn-primary btnEnviarCorreo">Enviar</button>

                  </div>

              </form>
          </div>
      </div>
  </div>