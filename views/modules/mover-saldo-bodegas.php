<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Movimiento Saldo</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Admistración</a></li>
              <li class="breadcrumb-item active">Movimiento Saldo</li>
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

                      <button class="btn btn-primary" data-toggle="modal" data-target="#modalmoversaldo">
            
            Mover Saldo

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

        <table class="table table-bordered table-striped dt-responsive" id="tablamoversaldobodegas" width="100%">
          
          <thead>
            
            <tr>
              
            <th style="width:5px">#</th>
            <th>Acciones</th> 
            <th>Nombre</th> 
            <th>cliente</th>  
            <th>saldo</th>     
                   
            </tr>

          </thead>

          <tbody>


             
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



     <div class="modal fade " id="modalmoversaldo">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

           
                  <form role="form" class="formulario_saldos" method="post" enctype="multipart/form-data">

            <div class="modal-header">
              <h4 style="text-align: center;" class="modal-title">TRANSFERENCIA SALDOS</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">


 <!-- Nombre clientes -->

 <?php 


$value = $_SESSION["id"];


if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){


  // $bodegas = MoverSaldoController::ctrCargarBodegas($value);
    $nombres_clientes = Movimiento_saldosController::ctrCargarClientes();
    


}elseif ($_SESSION["rol"]=="Cliente") {


    $bodegas = MoverSaldoController::ctrCargarBodegasxusuario($value);


}





     
    date_default_timezone_set('America/Costa_Rica');

  ?>


 <div class="container row col-xs-12 col-lg-12">



      <div class="col-xs-12 col-lg-4">
                    <label>&nbsp;&nbspFecha:</label>
      <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend d-none d-md-block">

            <span style="font-size:15px;height: 100%" class="input-group-text"><i class="fas fa-calendar-alt"></i></span>

            </div>

            <input type="hidden" style="font-size:20px;height: 35%"  class="form-control fecha_ingreso" id="fecha_ingreso" name="fecha_ingreso" value="<?php  echo date('Y-m-d h:i:s') ?>" readonly>  
    <?php  echo '<input type="date" style="font-size:20px;height: 35%"  class="form-control fecha_1" id="fecha_1" name="fecha_1" value="'.date('Y-m-d').'" readonly>'?>

         </div>                 
          </div>

 <?php if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){   ?>

                 <div class="col-xs-12 col-lg-4 " >
              <label>&nbsp;&nbspCliente:</label>

                 <div class="input-group " style=" width: 100%;">
                    <div class="input-group-prepend d-none d-md-block">
                      <span style="font-size:15px;height: 100%"  class="input-group-text "><i class="fas fa-user-tie"></i></span>
                    </div>
                      <select  class="cliente " style="font-size:20px; height: 100%; width: 85%" id="cliente" name="cliente" required>
                    <option selected disabled value=""  >Seleccionar...</option>                    
         
                     <?php foreach ($nombres_clientes as $key => $value): ?>

                  
                <option value="<?php echo $value["idtbl_clientes"];?>"><?php echo $value["nombre"];?></option>
                

                <?php endforeach ?>

                    </select> 

                   </div>
                  </div>

<?php } ?>

  </div>


        <div class="container row col-xs-12 col-lg-12">
<br>

<?php if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){ ?>

<div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspBodega #1:</label>


      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend d-none d-md-block">
                      <span style="font-size:15px;height: 100%"  class="input-group-text "><i class="fas fa-user-tie"></i></span>
                    </div>
                      <select  class="bodega_inicial " style="font-size:20px; height: 100%; width: 85%" id="bodega_inicial" name="bodega_inicial" required>
                   <!--  <option selected  value=""  >Seleccionar...</option> -->

                    </select> 

                   </div>
                  </div>




<?php } else { ?>


<div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspBodega #1:</label>


      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend d-none d-md-block">
                      <span style="font-size:15px;height: 100%"  class="input-group-text "><i class="fas fa-user-tie"></i></span>
                    </div>
                      <select  class="bodega_inicial " style="font-size:20px; height: 100%; width: 85%" id="bodega_inicial" name="bodega_inicial" required>
                    <option selected disabled value=""  >Seleccionar...</option>                    
         
                     <?php foreach ($bodegas as $key => $value): ?>

                  
                <option value="<?php echo $value["idtbl_bodegas"];?>"><?php echo $value["nombre"];?></option>
                

                <?php endforeach ?>

                    </select> 

                   </div>
                  </div>




<?php } ?>

                 





<div class="col-xs-12 col-lg-2">
                    <label>&nbsp;&nbspSaldo en bodega:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend d-none d-md-block">

            <span style="font-size:15px;height: 100%" class="input-group-text"><i class=""></i>₡</span>

            </div>

            <input type="text" style="font-size:20px;height: 35%"   minlength="0" class="form-control saldo" id="saldo" name="saldo" required placeholder="saldo" readonly>  

         </div>                 
          </div>



<div class="col-xs-12 col-lg-2">
                    <label>&nbsp;&nbspSaldo a transferir:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend d-none d-md-block">

            <span style="font-size:15px;height: 100%" class="input-group-text"><i class=""></i>₡</span>

            </div>

            <input type="text" style="font-size:20px;height: 35%"   minlength="0" class="form-control saldo_transferir" id="saldo_transferir" name="saldo_transferir" required placeholder="saldo">  

         </div>                 
          </div>






<?php if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){ ?> 


                 <div class="col-xs-12 col-lg-4">


<label>&nbsp;&nbspBodega #2:</label>


      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend d-none d-md-block">
                      <span style="font-size:15px;height: 100%"  class="input-group-text "><i class="fas fa-user-tie"></i></span>
                    </div>
                      <select  class="bodega_final" style="font-size:20px; height: 100%; width: 85%" id="bodega_final" name="bodega_final" required>
                    <!-- <option selected disabled value=""  >Seleccionar...</option>                              -->

                    </select> 

                   </div>
                  </div>






<?php }else{ ?>  




                 <div class="col-xs-12 col-lg-4">


<label>&nbsp;&nbspBodega #2:</label>


      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend d-none d-md-block">
                      <span style="font-size:15px;height: 100%"  class="input-group-text "><i class="fas fa-user-tie"></i></span>
                    </div>
                      <select  class="bodega_final" style="font-size:20px; height: 100%; width: 85%" id="bodega_final" name="bodega_final" required>
                    <option selected disabled value=""  >Seleccionar...</option>                    
         
                     <?php foreach ($bodegas as $key => $value): ?>

                  
                <option value="<?php echo $value["idtbl_bodegas"];?>"><?php echo $value["nombre"];?></option>
                

                <?php endforeach ?>

                    </select> 

                   </div>
                  </div>




 <?php } ?>


               
 </div> 




            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary btn_guardar_movimiento" >Guardar</button>
            </div>
          </form>

      <?php 

      $agregar_saldo = new MoverSaldoController();

      $agregar_saldo -> ctringresarMovimeinto();

      ?>

              
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>