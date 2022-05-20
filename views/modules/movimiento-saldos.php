 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Movimiento Saldos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Admistración</a></li>
              <li class="breadcrumb-item active">Movimiento Saldos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">



 
     

      <div class="container">



        <div class="row">

          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">

                      <button class="btn btn-primary" data-toggle="modal" data-target="#modalmovimientoSaldo">
            
            Agregar Saldo

          </button>



   <!--        <button type="button" class="btn btn-default float-right" id="daterange-btn-pospago">

            <span>
              
              <i class="fa fa-calendar"></i> Rango de Fecha

            </span>

             <i class="fa fa-caret-down"></i>
            
            
          </button> -->

             </div>
              <div class="card-body">

   <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive" id="tablaclientes" width="100%">
          
          <thead>
            
            <tr>
              
            <th style="width:5px">#</th>
            <th>Acciones</th> 
            <th>Activo</th> 
            <th>Codigo</th>  
            <th>Cédula</th> 
            <th>Nombre</th> 
            <th>Encargado</th> 
            <th>Régimen</th>
            <th>Télefono</th>
            <th>Email</th>
            <th>Provincia</th>
            <th>Canton</th>
            <th>Distrito</th>
            <th>Latitud</th>
            <th>Longitud</th>



            
                   
            </tr>

          </thead>

          <tbody>

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



           <div class="modal fade cleanmodal" id="modalmovimientoSaldo">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

           
                  <form role="form" class="formulario_saldos" method="post" enctype="multipart/form-data">

            <div class="modal-header">
              <h4 style="text-align: center;" class="modal-title">SALDO</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">


 <!-- Nombre clientes -->

 <?php 

    $nombres_clientes = Movimiento_saldosController::ctrCargarClientes();
     
date_default_timezone_set('America/Costa_Rica');
  ?>


 
        <div class="container row col-xs-12">


<div class="col-xs-12 col-lg-6">
                    <label>&nbsp;&nbspFecha:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:15px;height: 100%" class="input-group-text"><i class="fas fa-calendar-alt"></i></span>

            </div>

            <input type="hidden" style="font-size:20px;height: 35%"  class="form-control fecha_ingreso" id="fecha_ingreso" name="fecha_ingreso" value="<?php  echo date('Y-m-d h:i:s') ?>" readonly>  
            <input type="text" style="font-size:20px;height: 35%"  class="form-control fecha_1" id="fecha_1" name="fecha_1" value="<?php  echo date('Y-m-d') ?>" readonly>  

         </div>                 
          </div>
           


                 <div class="col-xs-12 col-lg-6">


<label>&nbsp;&nbspNombre Cliente:</label>


      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:15px;height: 100%"  class="input-group-text "><i class="fas fa-user-tie"></i></span>
                    </div>
                      <select  class="nombre_cliente" style="font-size:20px; height: 100%; width: 85%" id="nombre_cliente" name="nombre_cliente" required>
                    <option selected disabled value=""  >Seleccionar...</option>                    
         
                     <?php foreach ($nombres_clientes as $key => $value): ?>

                  
                <option value="<?php echo $value["cedula"];?>"><?php echo $value["nombre"];?></option>
                

                <?php endforeach ?>

                    </select> 

                   </div>
                  </div>
                 
<br>


                 <div class="col-xs-12 col-lg-6">

<label>&nbsp;&nbspBanco:</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:15px;height: 100%"  class="input-group-text "><i class="fa fa-th-list"></i></span>
                    </div>
                      <select  class="banco_empresa" style="font-size:15px; height: 100%; width: 85%" id="banco_empresa" name="banco_empresa" required>
                    <option selected disabled value=""  >Seleccionar...</option>                    
         
                     <?php foreach ($nombres_clientes as $key => $value): ?>

                  
                <option value="<?php echo $value["cedula"];?>"><?php echo $value["nombre"];?></option>
                

                <?php endforeach ?>

                    </select> 

                   </div>
         
                  </div>


<br>

                  <div class="col-xs-12 col-lg-6">
                    <label>&nbsp;&nbspCuenta Deposito:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:15px;height: 100%" class="input-group-text"><i class="far fa-edit"></i></span>

            </div>

            <input type="text" style="font-size:20px;height: 35%"   minlength="0" class="form-control cuenta" id="cuenta" name="cuenta" required placeholder="Cuenta">  

         </div>                 
          </div>

<br>

                  <div class="col-xs-12 col-lg-6">
                    <label>&nbsp;&nbspRefencia Deposito:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:15px;height: 100%" class="input-group-text"><i class="far fa-edit"></i></span>

            </div>

            <input type="text" style="font-size:20px;height: 35%"   minlength="0" class="form-control referencia" id="referencia" name="referencia" required placeholder="Referencia">  

         </div>                 
          </div>

<br>

                  <div class="col-xs-12 col-lg-6">
                    <label>&nbsp;&nbspMonto:</label>
           <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:15px;height: 100%" class="input-group-text"><i class=""></i>₡</span>

            </div>

            <input type="number" style="font-size:20px;height: 35%"   minlength="0" class="form-control monto_saldo" id="monto_saldo" name="monto_saldo" required placeholder="Monto" readonly>  

         </div>                 
          </div>



<br>




               
 </div> 


<div class="bodegas_cliente">







</div>

  <input type="hidden"  id="monto-saldo-bodega"  name="monto-saldo-bodega" value="0" required> 
   <input type="hidden"  id="id-bodegas"  name="id-bodegas" value="0" required> 

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary" >Guardar</button>
            </div>
          </form>

      <?php 

      $agregar_saldo = new Movimiento_saldosController();

      $agregar_saldo -> ctrinsertar_saldo();

      ?>

              
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>