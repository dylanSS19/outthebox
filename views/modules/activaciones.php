
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Activaciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">pagos</a></li>
              <li class="breadcrumb-item active">Activaciones</li>
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
              <div class="card-header">
                <h3 class="card-title">Qué tipo de activación deseas realizar?</h3>
         <br>  
           <br>  
           <div class="row">
    <div class="col-xs-12 col-lg-4 text-center">
      <button type="button" st class="btn btn-default " data-toggle="modal" data-target="#modal-sim"  id="btn-sim-activaciones">SIM</button> 

      &nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp

          <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal-portabilidad" id="btn-portabilidad-activaciones">Portabilidad</button>

    </div>
  </div>

          <!--       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> -->
              </div>
        
              <!-- /.card-body -->
            <!--   <div class="card-footer">
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->











   <div class="modal fade cleanmodal" id="modal-sim">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

           
                  <form role="form" id="btn-validar-activacion-sim" method="post" enctype="multipart/form-data">

            <div class="modal-header">
              <h4 style="text-align: center;" class="modal-title">Activación SIM</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

      <div class="row">

        <!-- CEDULA -->
                                      <div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspPaís:</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select cleancombo"  id="combo-tipo-id-activacion-sim" required>
                  <option selected disabled value=""  >Seleccionar...</option>
                    <option value="DIMEX">DIMEX</option>
                    <option value="TIM">TIM</option>
                    <option value="Cédula Física">Cédula Física</option>
                    <option value="Pasaporte">Pasaporte</option>
                    <option value="Cédula Jurídica">Cédula Jurídica</option>

                  </select> 
                   </div>
                  </div>

  <!-- Identificación De Cliente -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspIdentificación De Cliente:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px" maxlength="11"  minlength="11" class="form-control" id="activaciones-sim-cedula" name="activaciones-sim-cedula" required placeholder="Número">    

         </div>                  </div>


   <!-- Nombre -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspNombre:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control"  id="activaciones-sim-nombre" name="activaciones-sim-nombre" required placeholder="Nombre">    

         </div>                  </div>



               
</div>


      <div class="row">

  <!-- PRIMER APELLIDO -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspPrimer Apellido:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px" maxlength="11"  minlength="11" class="form-control" id="activaciones-sim-primer-apellido" name="activaciones-sim-primer-apellido" required placeholder="Primer Apellido">    

         </div>                  </div>

  <!-- SEGUNDO APELLIDO -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspSegundo Apellido:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px" maxlength="11"  minlength="11" class="form-control" id="activaciones-sim-segundo-apellido" name="activaciones-sim-segundo-apellido" required placeholder="Segundo Apellido">    

         </div>                  </div>


   <!-- PROVINCIA -->
                  <div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspProvincia</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select cleancombo" id="combo-provincia-activacion-sim" required>
                    <option selected disabled value=""  >Seleccionar...</option>
                    <option value="San Jose">San Jose</option>
               
                  </select> 
                   </div>
                  </div>



               
</div>


      <div class="row">




   <!-- Canton -->
                  <div class="ol-xs-12 col-lg-4">
<label>&nbsp;&nbspCanton</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select cleancombo" id="combo-canton-activacion-sim" required>
                    <option selected disabled value=""  >Seleccionar...</option>
                    <option value="San Jose">San Jose</option>
               
                  </select> 
                   </div>
                  </div>

                     <!-- DISTRITO -->
                  <div class="ol-xs-12 col-lg-4">
<label>&nbsp;&nbspDistrito</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select cleancombo" id="combo-distrito-activacion-sim" required>
                    <option selected disabled value=""  >Seleccionar...</option>
                    <option value="San Jose">San Jose</option>
               
                  </select> 
                   </div>
                  </div>


                    <!-- SIM -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspSIM:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px" maxlength="21"  minlength="21" class="form-control" id="activaciones-sim-sim" name="activaciones-sim-sim" required placeholder="SIM">  

         </div>                  </div>




               
</div>






<!-- 

 -->



 
<!--  -->



<!--  -->


 




 

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              <button type="submit" id="btn-activacion-sim" class="btn btn-primary" >Validar</button>
            </div>
          </form>

              
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



   <div class="modal fade cleanmodal" id="modal-portabilidad">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
                  <form role="form" id="btn-pagar-recagar-internacional" method="post" enctype="multipart/form-data">

            <div class="modal-header">
              <h4 style="text-align: center;" class="modal-title">Portabilidad</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">



    <div class="container h-100">
<!--   <div class="row h-100 justify-content-center align-items-center">

       <label style="font-size:35px" class="saldorecargalocal">DISPONIBLE: ₡10000.00 </label>

 
  </div> -->

</div>


<!-- 


 -->


       <div class="row">




   <!-- PAIS -->
                  <div class="ol-xs-12 col-lg-4">
<label>&nbsp;&nbspPaís</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select cleancombo" id="combo-pais-recarga-internacional" required>
                    <option selected disabled value=""  >Seleccionar...</option>
                         <option value="Guatemala">Guatemala</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Nicaragua">Nicaragua</option>
               
                  </select> 
                   </div>
                  </div>



                    <!-- NUMERO -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspNúmero:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="number" style="font-size:30px;height: 50px" class="form-control" maxlength="8"  minlength="8" class="form-control" id="recarga-internacional-numero1" name="recarga-internacional-numero" onkeypress='validate(event)' required placeholder="Número" >    

         </div>                  </div>


                             <!-- MONTO -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspMonto:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="number" style="font-size:30px;height: 50px" class="form-control"  id="recarga-internacional-monto" name="recarga-internacional-monto" required placeholder="Monto" >    

         </div>                  </div>




               
</div>


<!-- 



 -->




<!-- 
 <div class="input-group" style=" width: 50%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i>&nbsp;&nbspPaís</span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select " id="combo-pais-recarga-internacional">
                    <option value="Guatemala">Guatemala</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Nicaragua">Nicaragua</option>
                  </select> 
                   </div>
         
         

         <br>



                                     
     <div class="input-group mb-6" style=" width: 50%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i>&nbsp;&nbspNúmero Telefono</span>

            </div>

            <input style="font-size:30px;height: 50px" maxlength="8"  minlength="8" class="form-control" id="recarga-internacional-numero1" name="recarga-internacional-numero" onkeypress='validate(event)' required placeholder="Número" >  

         </div>

         <br>


           <div class="input-group mb-6" style=" width: 50%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="fas fa-money-bill-alt"></i>&nbsp;&nbspMonto</span>

            </div>

            <input style="font-size:30px;height: 50px" type="number" class="form-control" id="recarga-internacional-monto" name="recarga-internacional-monto" required placeholder="Monto" >  

         </div> -->


            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary" >Pagar</button>
            </div>
          </form>

              
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 