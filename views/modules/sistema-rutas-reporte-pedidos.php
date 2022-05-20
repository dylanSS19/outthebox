  
  <?php 
  
    $usuario = "%";
  
  $ID_empresa = $_COOKIE['cookie_empresa'];
  
  $Rutas = CrearFactController::ctrCargarRutas($usuario, $ID_empresa);
  
  
  ?>
  
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Reporte Pedidos</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                          <li class="breadcrumb-item active">Pedidos</li>
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

                              </div>

                              <br>
                              <button type="button" class="btn btn-default " id="daterange-btn-reportPedidos">

                                  <span>

                                      <i class="fa fa-calendar"></i> Rango de Fecha

                                  </span>

                                  <i class="fa fa-caret-down"></i>


                              </button>

                              <?php if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){?> 

                              <div class="col-xs-12 col-lg-4 float-right">
                                      
                                      <!-- <label>&nbsp;&nbspTipo Documento:</label> -->
                                      <div class="input-group" style=" width: 100%;">
                                          <div class="input-group-prepend">
                                              <span style="font-size:15px;height: 30px" class="input-group-text "><i
                                                      class="fa fa-bars"></i></span>
                                          </div>
                                          <select style="font-size:15px;height: 30px"
                                              class="custom-select" id="FrmRepotPedidoRuta"
                                              name="FrmRepotPedidoRuta" >
                                              <option selected disabled value="">Seleccionar Ruta</option>

                                              <?php foreach ($Rutas as $key => $value): ?>

                                                <option value="<?php echo $value["idtbl_rutas"];?>" Valcoord="<?php echo $value["valida_coordenadas"];?>">
                                                    <?php echo $value["nombre"];?>
                                                </option>

                                              <?php endforeach ?>

                                          </select>
                                      </div>
                                  </div>
                            
                                  <?php }else{ ?> <?php } ?>
                              <!-- <button class="btn btn-outline-primary float-right buscarFacturas">

                                  Buscar

                              </button> -->

                          </div>


                          <div class="card-body">
                              <!-- <table id="tablaSistemaFacturas" class="table table-bordered table-hover" width="100%"> -->
                              <div class="box-body">
                                  <table class="table table-bordered table-striped dt-responsive"
                                      id="tablareportPedidos" width="100%">

                                      <thead>
                                          <tr>

                                              <th>#</th>
                                              <th>Acciones</th>
                                              <th>Fecha</th>
                                              <th>Nombre</th>
                                              <th>Cédula</th>
                                              <th>Estado</th>

                                          </tr>
                                      </thead>
                                      <tbody>


                                      </tbody>

                                      <!-- <tfoot >
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

                  
  </tfoot>  -->


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


  <div class="modal" id="modalreportPedidosDetalle">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">

              <div class="modal-header">
                  <h4 style="text-align: center;" class="modal-title">Detalle Pedidos</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body">

                  <div class="row">

                      <div class="col-xs-12 col-lg-12">

                          <table class="table table-bordered table-striped dt-responsive" id="tablareportPedidosDetalle"
                              width="100%">

                              <thead>

                                  <tr>

                                      <th style="width:5px">#</th>
                                      <th>Nombre</th>
                                      <th>Codigo</th>
                                      <th>Cantidad</th>
                                      <th>Precio Unitario</th>                                      
                                      <th>Descuento</th>
                                      <th>Impuesto</th>
                                      <th>Total</th>

                                  </tr>

                              </thead>

                              <tbody>


                              </tbody>

                              <tfoot >

                                <tr>
                                    <td></td>
                                    <td></td>          
                                    <td></td>
                                    <td></td>
                                    <td style="font-weight: bold;">Totales:</td>
                                    <td></td>                                         
                                    <td></td>
                                    <td></td>
                            
                                </tr> 
                
                            </tfoot> 

                          </table>

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