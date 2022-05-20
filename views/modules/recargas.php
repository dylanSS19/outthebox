
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Recargas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Pagos</a></li>
              <li class="breadcrumb-item active">Recargas</li>
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
        <h3 class="card-title">Que tipo de recarga desea hacer?</h3>
         <br>  
          <br>  

             <!--         <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> -->

                                <div class="row">
    <div class="col-xs-12 col-lg-4 text-center">
          <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal-local"  id="btn-recarga-local">Local</button> 

      &nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp

          <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal-internacional" id="btn-recarga-internacional">Internacional</button>

    </div>
  </div>
              </div>



   
             
              <!-- /.card-body -->


              <!-- <div class="card-footer">
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

                <h3 style="font-size:15px"  class="card-title d-block d-sm-none">Reporte</h3>

                <h3 style="font-size:35px;"  class="card-title text-center d-none d-sm-block ">Reporte</h3>


         
          

                <div class="card-tools">
                                               <button type="button" class="btn btn-default float-right" id="daterange-btn-reporte-ventas-recargas">

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
            <th>Tipo</th> 
            <th>Fecha</th> 
            <th>País</th> 
            <th>Número</th> 
            <th>Monto</th>  
            <th style="width: 75px">Acciones</th>          
                   
            </tr>

          </thead>

          <tbody>
<tr>

             <td>1</td>   
              <td>LOCAL</td>
              <td>19-03-2021</td>
              <td class="text-uppercase">Costa Rica</td>        
              <td class="text-uppercase">86335806</td>  
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
              <td>INTERNACIONAL</td>
              <td>19-03-2021</td>
              <td class="text-uppercase">Nicaragua</td>        
              <td class="text-uppercase">75451256</td>  
              <td>₡15.000.00</td> 
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
<!--               <div class="card-footer">
                Footer
              </div>
 -->              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


 <div class="modal fade cleanmodal" id="modal-local">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
                  <form role="form" id="btn-pagar-recagar-local" method="post" enctype="multipart/form-data">

            <div class="modal-header">
              <h4 style="text-align: center;" class="modal-title">Recarga Local</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">



    <div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">



       <label style="font-size:25px" class="saldorecargalocal d-block d-sm-none">DISPONIBLE: ₡10000.00 </label>


       <label style="font-size:35px" class="saldorecargalocal d-none d-sm-block" >DISPONIBLE: ₡10000.00 </label>



 
  </div>
</div>

      <div class="row">

  <!-- TELEFONO -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspTélefono:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="recarga-local-numero" name="recarga-local-numero" value="" required placeholder="Número" onkeypress='validate(event)'>    

         </div>                  </div>


   <!-- MONTO -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspMonto:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control"  id="recarga-local-monto" name="recarga-local-monto"  value="" required placeholder="Monto" onkeypress='validate(event)'>    

         </div>                  </div>



               
</div>



                                     
 <!--     <div class="input-group mb-6" style=" width: 50%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i>&nbsp;&nbspNúmero Telefono</span>

            </div>

            <input style="font-size:30px;height: 50px" maxlength="8"  minlength="8" class="form-control" id="recarga-local-numero" name="recarga-local-numero" required placeholder="Número" onkeypress='validate(event)'>  

         </div>

         <br>


           <div class="input-group mb-6" style=" width: 50%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="fas fa-money-bill-alt"></i>&nbsp;&nbspMonto</span>

            </div>

            <input style="font-size:30px;height: 50px" type="number" class="form-control" id="recarga-local-monto" name="recarga-local-monto" required placeholder="Monto" >  

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







   <div class="modal fade cleanmodal" id="modal-internacional">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
                  <form role="form" id="btn-pagar-recagar-internacional" method="post" enctype="multipart/form-data">

            <div class="modal-header">
              <h4 style="text-align: center;" class="modal-title">Recarga Internacional</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">



    <div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">

       <label style="font-size:25px" class="saldorecargalocal d-block d-sm-none">DISPONIBLE: ₡10000.00 </label>


       <label style="font-size:35px" class="saldorecargalocal d-none d-sm-block" >DISPONIBLE: ₡10000.00 </label>
 
  </div>
</div>


     <div class="row">


                              <div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspPaís:</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select cleancombo" id="combo-pais-recarga-internacional" required>
                    <option selected disabled value="" >Seleccionar País...</option>
                        <option value="Guatemala">Guatemala</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Nicaragua">Nicaragua</option>

                  </select> 
                   </div>
                  </div>








  <!-- TELEFONO -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspTélefono:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="recarga-internacional-numero1" name="recarga-internacional-numero" value="" required placeholder="Número" onkeypress='validate(event)'>    

         </div>                  </div>


   <!-- MONTO -->
                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspMonto:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control"  id="recarga-internacional-monto" name="recarga-internacional-monto" value="" required placeholder="Monto" onkeypress='validate(event)'>    

         </div>                  </div>



               
</div>




<!-- 
 <div class="input-group" style=" width: 50%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i>&nbsp;&nbspPaís</span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select cleancombo" id="combo-pais-recarga-internacional">
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
              <button type="submit" class="btn btn-primary" ">Pagar</button>
            </div>
          </form>

              
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 