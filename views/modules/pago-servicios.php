        <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pagos de Servicios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Pagos</a></li>
              <li class="breadcrumb-item active">Pagos de Servicios</li>
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
            <!-- Default box -->
            <div class="card">
     <!--          <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div> -->
              <div class="card-body">




       <div class="card card-danger card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tab-pospago-tab" data-toggle="pill" href="#tab-pospago" role="tab" aria-controls="tab-pospago" aria-selected="true">  <img src="views/img/template/sim-card.png"  style=" height: 20px; width: 20px">  Pospago</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tab-dth-tab" data-toggle="pill" href="#tab-dth" role="tab" aria-controls="tab-dth" aria-selected="false"> <img src="views/img/template/antena-parabolica.png"  style=" height: 20px; width: 20px"> DTH</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tab-internet-tab" data-toggle="pill" href="#tab-internet" role="tab" aria-controls="tab-internet" aria-selected="false"> <img src="views/img/template/wifi.png"  style=" height: 20px; width: 20px"> Internet</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tab-gpon-tab" data-toggle="pill" href="#tab-gpon" role="tab" aria-controls="tab-gpon" aria-selected="false"> <img src="views/img/template/fo.png"  style=" height: 20px; width: 20px"> GPON</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="tab-pospago" role="tabpanel" aria-labelledby="tab-pospago-tab">


                                  <!--POSPAGO -->                           
                  
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio"  class="minimal" name="rd-pospago" id="rd_pospago_cedula" checked>
                        <label for="rd_pospago_cedula">
                          Cédula
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio"  class="minimal" name="rd-pospago" id="rd_pospago_contrato">
                        <label for="rd_pospago_contrato">
                          Contrato
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" class="minimal" name="rd-pospago" id="rd_pospago_telefono">
                        <label for="rd_pospago_telefono">
                          Télefono
                        </label>
                      </div>
                    </div>

<!-- 
    <div class="input-group mb-3" style=" width: 500px; height: 50px">

          <div class="input-group-prepend">

            <span class="input-group-text"><i class="far fa-id-card"></i></span>

            </div>

            <input type="text" style="height: 50px; font-size:50px" class="form-control" id="pagoservicios-pospago" name="pagoservicios-pospago" placeholder="Número Cédula" required >  

         </div>
 -->

         <div class="row">
  
                  <div class="col-xs-12 col-lg-4">

<!--                     <label>&nbsp;&nbspCódigo:</label>
 --> 
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="pagoservicios-pospago" name="pagoservicios-pospago" placeholder="# Cédula"  required >  

         </div>    

                       </div>

</div>

<br>
                       <button type="button" class="btn btn-primary"  id="btn-buscar-pospago"> Buscar</button>

                  </div>
                  <div class="tab-pane fade" id="tab-dth" role="tabpanel" aria-labelledby="tab-dth-tab">
                    <!-- DTH -->

                    

             <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio"  class="minimal" name="rd-dth" id="rd_dth_cedula" checked>
                        <label for="rd_dth_cedula">
                          Cédula
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio"  class="minimal" name="rd-dth" id="rd_dth_contrato">
                        <label for="rd_dth_contrato">
                          Contrato
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" class="minimal" name="rd-dth" id="rd_dth_telefono">
                        <label for="rd_dth_telefono">
                          Télefono
                        </label>
                      </div>
                    </div>

<div class="row">
  
                  <div class="col-xs-12 col-lg-4">

<!--                     <label>&nbsp;&nbspCódigo:</label>
 --> 
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="pagoservicios-dth" name="pagoservicios-dth" placeholder="# Cédula"  required >  

         </div>    

                       </div>

</div>




<!--     <div class="input-group mb-3" style=" width: 500px; height: 50px">

          <div class="input-group-prepend">

            <span class="input-group-text"><i class="far fa-id-card"></i></span>

            </div>

            <input type="text" style="height: 50px; font-size:50px" class="form-control" id="pagoservicios-dth" name="pagoservicios-dth" placeholder="Número Cédula" required >  

         </div> -->

         <br>

                       <button type="button" class="btn btn-primary"  id="btn-buscar-dth"> Buscar</button>

                  </div>
                  <div class="tab-pane fade" id="tab-internet" role="tabpanel" aria-labelledby="tab-internet-tab">
                    <!-- INTERNET -->

             <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio"  class="minimal" name="rd-internet" id="rdinternet_cedula" checked>
                        <label for="rd_internet_cedula">
                          Cédula
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio"  class="minimal" name="rd-internet" id="rd_internet_contrato">
                        <label for="rd_internet_contrato">
                          Contrato
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" class="minimal" name="rd-internet" id="rd_internet_telefono">
                        <label for="rd_internet_telefono">
                          Télefono
                        </label>
                      </div>
                    </div>


<!--     <div class="input-group mb-3" style=" width: 500px; height: 50px">

          <div class="input-group-prepend">

            <span class="input-group-text"><i class="far fa-id-card"></i></span>

            </div>

            <input type="text" style="height: 50px; font-size:50px" class="form-control" id="pagoservicios-internet" name="pagoservicios-internet" placeholder="# Cédula" required >  

         </div>
 -->

         <div class="row">
  
                  <div class="col-xs-12 col-lg-4">

<!--                     <label>&nbsp;&nbspCódigo:</label>
 --> 
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="pagoservicios-internet" name="pagoservicios-internet" placeholder="# Cédula"  required >  

         </div>    

                       </div>

</div>

<br>

                       <button type="button" class="btn btn-primary"  id="btn-buscar-internet"> Buscar</button>
                  </div>
                  <div class="tab-pane fade" id="tab-gpon" role="tabpanel" aria-labelledby="tab-gpon-tab">
                   <!-- GPON -->

             <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio"  class="minimal" name="rd-gpon" id="rd_gpon_cedula" checked>
                        <label for="rd_gpon_cedula">
                          Cédula
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio"  class="minimal" name="rd-gpon" id="rd_gpon_contrato">
                        <label for="rd_gpon_contrato">
                          Contrato
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" class="minimal" name="rd-gpon" id="rd_gpon_telefono">
                        <label for="rd_gpon_telefono">
                          Télefono
                        </label>
                      </div>
                    </div>


<!--     <div class="input-group mb-3" style=" width: 500px; height: 50px">

          <div class="input-group-prepend">

            <span class="input-group-text"><i class="far fa-id-card"></i></span>

            </div>

            <input type="text" style="height: 50px; font-size:50px" class="form-control" id="pagoservicios-gpon" name="pagoservicios-gpon" placeholder="# Cédula" required >  

         </div> -->

              <div class="row">
  
                  <div class="col-xs-12 col-lg-4">

<!--                     <label>&nbsp;&nbspCódigo:</label>
 --> 
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="pagoservicios-gpon" name="pagoservicios-gpon"  placeholder="# Cédula"  required >  

         </div>    

                       </div>

</div>

<br>

                       <button type="button" class="btn btn-primary"  id="btn-buscar-gpon"> Buscar</button>

         </div>

                  </div>

                  <br>
                  <div class="row datos-cliente" style="display:none" >
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  Datos Cliente
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">


      <div class="row">

  <!-- CLIENTE -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspCliente:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="pagoservicios-nombre-cliente" name="pagoservicios-nombre-cliente" value="Luis Alfonso Perez" required readonly  placeholder="CLIENTE" >  

         </div>                  </div>


 
  <!-- CONTRATO -->
                <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspContrato Técnico:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="pagoservicios-contrato-cliente" name="pagoservicios-contrato-cliente" value="2231036" required placeholder="CONTRATO" >  

         </div>                  </div>

<!-- ID CLIENTE -->
          <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspID Cliente:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="pagoservicios-id-cliente" name="pagoservicios-id-cliente" value="0.1323214" required placeholder="ID CLIENTE" >  

         </div>                  </div>



               
</div>

      <div class="row">

  <!-- TELEFONO -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspTélefono:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="pagoservicios-telefono-cliente" name="pagoservicios-telefono-cliente" value="70123652" placeholder="Télefono" >  

         </div>                  </div>


 



               
</div>
          

               


<!--                      <div class="input-group mb-3" style=" width: 100%;">

          <div class="input-group-prepend">

            <span class="input-group-text" style="font-size:20px;height: 50px"> <i class="fas fa-mobile-alt"> </i>&nbsp;&nbspCliente</span>

            </div>

            <input type="text" style="font-size:30px ;height: 50px" class="form-control" id="pagoservicios-nombre-cliente" name="pagoservicios-nombre-cliente" value="Luis Alfonso Perez" >  

         </div>

           

                        

           <div class="input-group mb-3" style=" width:100%;">

          <div class="input-group-prepend">

            <span class="input-group-text" style="font-size:20px;height: 50px"><i class="fas fa-mobile-alt"> </i>&nbsp;&nbspContrato Técnico</span>

            </div>

            <input type="text" style="font-size:20px;height: 50px" class="form-control" id="pagoservicios-contrato-cliente" name="pagoservicios-contrato-cliente" value="2231036" >  

         </div>

                             

           <div class="input-group mb-3" style=" width: 100%;">

          <div class="input-group-prepend">

            <span class="input-group-text" style="font-size:20px;height: 50px"><i class="fas fa-mobile-alt"> </i>&nbsp;&nbspID Cliente</span>

            </div>

            <input type="text" style="font-size:20px;height: 50px" class="form-control" id="pagoservicios-id-cliente" name="pagoservicios-id-cliente" value="0.1323214" >  

         </div>

                           
           <div class="input-group mb-3" style=" width: 100%;">

          <div class="input-group-prepend">

            <span class="input-group-text" style="font-size:20px;height: 50px"><i class="fas fa-mobile-alt"> </i>&nbsp;&nbspTélefono</span>

            </div>

            <input type="text" style="font-size:20px;height: 50px" class="form-control" id="pagoservicios-telefono-cliente" name="pagoservicios-telefono-cliente" value="70123652" >  

         </div> -->


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->



     <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  Datos Facturación
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                        <div class="box-body">
          <table id="tablaspendientes" class="table table-bordered table-striped dt-responsive" width="100%">
                  <thead>
                  <tr>
                    <th># Documento</th>
                    <th>Fecha Vencimiento</th>
                    <th>Total</th>
                    <th style="width: 55px">Pagar</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>2005161563642</td>
                    <td>12-03-2021</td>
                    <td>₡20.000</td>
      <td> <div class="btn-group">
                  
                  <button class="btn btn-info btnOrderDetail" data-toggle="modal" data-target="#modal-xl">  <i class="fas fa-cash-register"></i></button>

                </div> </td>

                   
                  </tr>

                   <tr>
                    <td>2005161561100</td>
                    <td>12-02-2021</td>
                    <td>₡20.000</td>
            <td> <div class="btn-group">
                  
                  <button class="btn btn-info btnOrderDetail" data-toggle="modal" data-target="#modal-xl"> <i class="fas fa-cash-register"></i></button>

                </div> </td>

                   
                  </tr>

                   <tr>
                    <td>2005161560324</td>
                    <td>12-01-2021</td>
                    <td>₡20.000</td>
      <td> <div class="btn-group">
                  
                  <button class="btn btn-info btnOrderDetail" data-toggle="modal" data-target="#modal-xl"> <i class="fas fa-cash-register"></i></button>

                </div> </td>
          
                  </tr>
             
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Total Facturas: 3</th>
                    <th>Total</th>
                    <th>₡60.000</th>
                    <th></th>
                
                  </tr>
                  </tfoot>
                </table>
       
     </div>

        

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->


        </div>
        <!-- /.row -->
          
      
    
          </div>


      </div>


              </div>
              <!-- /.card-body -->
          <!--     <div class="card-footer">
                Footer
              </div> -->
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <!-- Default box --> 
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reporte</h3>
       
          

                <div class="card-tools">
                                               <button type="button" class="btn btn-default float-right" id="daterange-btn-reporte-ventas-pago-servicios">

            <span>
              
              <i class="fa fa-calendar"></i> Rango de Fecha

            </span>

             <i class="fa fa-caret-down"></i>
            
            
          </button>
               <!--    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body">



              

                 <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablasbtn" id="tablasbtn" width="100%">
          
          <thead>
            
            <tr>
              
            <th style="width:5px">#</th>
            <th>Producto</th> 
            <th>Fecha</th> 
            <th>Cédula</th> 
            <th>Nombre</th> 
            <th>Monto</th>  
            <th style="width: 75px">Acciones</th>          
                   
            </tr>

          </thead>

          <tbody>
<tr>

             <td>1</td>   
              <td>DTH</td>
              <td>19-03-2021</td>
              <td class="text-uppercase">503850197</td>        
              <td class="text-uppercase">Heriberto Castro F</td>  
              <td>₡25.000.00</td> 
                  <td>            
                 
                     <div class="btn-group">
                  
                  <button class="btn btn-info btnClienteDetalle"> <i class="fa fa-info-circle"></i></button>

                                </div>

                                                 <div class="btn-group">
                  
                  <button class="btn" style="background-color: grey;"> <i class="fas fa-print"></i></button>

                                </div>

              </td>  

              </tr>

              <tr>

             <td>2</td>   
              <td>DTH</td>
              <td>19-03-2021</td>
              <td class="text-uppercase">503850197</td>        
              <td class="text-uppercase">Heriberto Castro F</td>  
              <td>₡25.000.00</td> 
                  <td>            
                 
                     <div class="btn-group">
                  
                  <button class="btn btn-info"> <i class="fa fa-info-circle"></i></button>

                                </div>

                                <div class="btn-group">
                  
                  <button class="btn" style="background-color: grey;"> <i class="fas fa-print"></i></button>

                                </div>



              </td>  

              </tr>
         
         

 <!--          <?php
        
                     

              $clientes = ClientesController::ctrCargarClientes();


              foreach ($clientes as $key => $value2) {

               echo '<tr>
              
              <td>'.($key+1).'</td>
                
              <td>            
                 
                <div class="btn-group">
                  
                  <button class="btn btn-info btnClienteDetalle" orderId2="'.$value2["codigo"].'" data-toggle="modal" data-target="#"> <i class="fa fa-info-circle"></i></button>

                                </div>

              </td>  
              <td>'.$value2["codigo"].'</td>
              <td>'.$value2["cedula"].'</td>
              <td class="text-uppercase">'.$value2["nombre"].'</td>        
              <td class="text-uppercase">'.$value2["nombre_contacto"].'</td>  
              <td>'.$value2["regimen"].'</td> 
              <td>'.$value2["telefono"].'</td>
              <td>'.$value2["mail"].'</td> 
              <td>'.$value2["provincia"].'</td> 
              <td>'.$value2["canton"].'</td> 
              <td>'.$value2["distrito"].'</td> 
              <td>'.$value2["latitud"].'</td> 
              <td>'.$value2["longitud"].'</td> 
              <td>'.$value2["activo"].'</td> 


            </tr>';

             }
           
             ?>    -->
             
          </tbody>


        </table>

        </div>


              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Footer
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div>
    </section>

    
  <!--   <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a> -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Pago</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                                      <div class="box-body table-responsive no-padding">
          <table id="tablas" class="table table-bordered table-striped dt-responsive" width="100%">
                  <thead>
              <!--     <tr>
                    <th># Documento</th>
                    <th>Fecha Vencimiento</th>
                    <th>Total</th>
                    <th>Pagar</th>
                  </tr> -->
                  </thead>
                  <tbody>
                  <tr>
                    <td>Estado:</td>
                    <td>Pendiente</td>
                  
                      
                  </tr>

                   <tr>

                    <td>Transacción:</td>
                    <td>2005161560324</td>
                                       
                  </tr>

                   <tr>

                    <td>Tipo Transacción:</td>
                    <td>Pago Factura</td>
                            
                  </tr>


                    <tr>

                    <td>Fecha Pago:</td>
                    <td>2021-03-08</td>
                            
                  </tr>

                      <tr>

                    <td>Forma Pago:</td>
                    <TD class = "select">    <select>        
            <option value="efectivo">Efectivo</option>
            <option value="tarjeta">Tarjeta</option>
           
    </select>
  <!--   <TD ALIGN="center"></TD> -->
    </TD>  
                            
                  </tr>  

                      <tr>

                    <td>Monto:</td>
                    <td>₡20.000</td>
                            
                  </tr>               
                  </tbody>
                
                </table>
       
     </div>
     <div class="input-group mb-3" style=" width: 100%;">

          <div class="input-group-prepend">

            <span class="input-group-text"><i class="far fa-envelope"></i>&nbsp;&nbspNotificación</span>

            </div>

            <input type="mail" class="form-control" id="pagoservicios-nombre-cliente" name="pagoservicios-nombre-cliente" placeholder="Correo" >  

         </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              <button type="button" class="btn btn-primary" id="btn-pagar">Pagar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
