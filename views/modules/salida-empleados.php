  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
      <div class="container-fluid">
        <div class="row mb-2"> 
          <div class="col-sm-6">
            <h1>Salida de Empleados</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Salida de Empleados</li>
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

            <!-- /.card -->
            <div class="card">
                   <div class="card-header">

              


                         <button class="btn btn-primary" data-toggle="modal" data-target="#modal-salidaEmpleado">
            
            Agregar Salida de Empleado

          </button>

             </div>


              <div class="card-body">











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
  <div class="modal fade" id="modal-salidaEmpleado">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
                  <form role="form" id="form-salida-personal" method="post" enctype="multipart/form-data">

                      <div class="modal-header">
              <h4 class="modal-title">Agregar Salida de Empleado</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <?php


if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){

$supervisor="";        

}elseif ($_SESSION["rol"]=="Supervisor-Tiendas"){

$supervisor=$_SESSION["user_name"];         

}



$id_empresa= $_SESSION['id_empresa'];
 $empleados = controladorSalidaEmpleado::ctrCargarEmpleados($id_empresa,$supervisor); 

 $motivos = controladorSalidaEmpleado::ctrCargarMotivos($id_empresa); 


//echo '<pre>'; print_r($conceptos); echo '</pre>';

 //exit();

  ?>

  

                                           <div class="row col-xs-12">


      <div class="col-xs-12 col-lg-8">
                                          <label>&nbsp;&nbspSeleccione Empleado:</label>
                                            <div class="input-group mb-6" style=" width: 100%;">
                                           
                                                 <select class="custom-select select2 empleados_salida_empleado" style=" width: 100%;" required id="empleados_salida_empleado"
                                                    name="empleados_salida_empleado" required>
                                                    <option selected disabled value="">Seleccionar Empleado</option>
                                                    <?php foreach ($empleados as $key => $value): ?>
                                                    <option value="<?php echo $value["cedula"];?>"
                                                        >
                                                        <?php echo $value["nombre_completo"];?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <br>
                                        </div>


                                          <div class="col-xs-12 col-lg-8">
                                          <label>&nbsp;&nbspSeleccione Motivo de Salida:</label>
                                            <div class="input-group mb-6" style=" width: 100%;">
                                           
                                                 <select class="custom-select select2 " style=" width: 100%;" required id="empleados_salida_motivo"
                                                    name="empleados_salida_motivo" required>
                                                    <option selected disabled value="">Seleccionar Motivo</option>
                                                    <?php foreach ($motivos as $key => $value): ?>
                                                    <option value="<?php echo $value["idtbl_motivos_despido"];?>"
                                                        >
                                                        <?php echo $value["nombre"];?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <br>
                                        </div>

                                 
<input type="hidden" name="nombreEmpleado" id="nombreEmpleado">

<input type="hidden" name="motivoSalida" id="motivoSalida">
                                        </div>

<div class="row col-xs-12">
   <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspFecha Salida:</label>
    <div class="form-group">
                 <!--  <label>Date:</label> -->
                    <div class="input-group date mb-6 datetimepicker" style=" width: 100%;" id="fecha-salida-salida_empleado" data-target-input="nearest">
                        <input type="text" style="font-size:30px;height: 50px" name="fecha-salida-salida_empleado" class="form-control datetimepicker-input" data-target="#fecha-salida-salida_empleado"/>
                        <div class="input-group-append" data-target="#fecha-salida-salida_empleado" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>    
                     </div>

</div>


         <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Comentarios de Salida</label>
                        <textarea class="form-control" rows="3" name="comentarios_salida_empleado" id="comentarios_salida_empleado" placeholder="Ingrese un comentario..."></textarea>
                      </div>
                    </div>
                 
                  </div>




            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary" >Guardar</button>
            </div>

                  </form>

                <?php 


      $createCliente = new controladorSalidaEmpleado();
     
      $createCliente -> ctrSalidaEmpleado();


      ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>