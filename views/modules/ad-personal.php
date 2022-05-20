  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>AD Personal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">AD Personal</li>
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

              

<!-- 
                <button class="btn btn-outline-primary float-right buscarFacturas">
                  
                  Buscar

                </button> -->

             </div>
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


              <div class="card-body">

                <?php


if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){

$supervisor="";        

}elseif ($_SESSION["rol"]=="Supervisor-Tiendas"){

$supervisor="Tien";         

}elseif ($_SESSION["rol"]=="Supervisor-DTH"){

$supervisor="DTH";       

}



$id_empresa= $_SESSION['id_empresa'];
 $empleados = controladorAdPersonal::ctrCargarEmpleados($id_empresa,$supervisor); 

 $conceptos = controladorAdPersonal::ctrCargarConceptosADPersonal($id_empresa); 


//echo '<pre>'; print_r($empleados); echo '</pre>';

 //exit();

  ?>
    <form role="form" method="post" id="form-ad-personal" enctype="multipart/form-data">

<div class="row">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                          <label>&nbsp;&nbspSeleccione Empleado:</label>
                                            <div class="input-group mb-6" style=" width: 100%;">
                                           
                                                 <select class="custom-select select2 empleados_ad_personal" required id="empleados_ad_personal"
                                                    name="empleados_ad_personal" required>
                                                    <option selected disabled value="">Seleccionar Empleado</option>
                                                    <?php foreach ($empleados as $key => $value): ?>
                                                    <option value="<?php echo $value["cedula"];?>"
                                                        >
                                                        <?php echo $value["nombre_completo"];?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <br>

                                            
                                            <input type="hidden" name="nomEmpleado" id="nomEmpleado">
                                            <input type="hidden" name="correoEmpleado" id="correoEmpleado">

                                        </div>

<!--                     <br>
<br> -->

    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                          <label>&nbsp;&nbspSeleccione Concepto:</label>
                                            <div class="input-group mb-6" style=" width: 100%;">
                                           
                                        


                                                        <select class="custom-select select2 conceptos_ad_personal" required id="conceptos_ad_personal"
                                                    name="conceptos_ad_personal" required>
                                                    <option selected  value="">Seleccionar Concepto</option>
                                                    <?php foreach ($conceptos as $key => $value): ?>
                                                    <option value="<?php echo $value["idtbl_conceptos"];?>"
                                                        >
                                                        <?php echo $value["nombre"];?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <br>
                                        </div>

                                        <input type="hidden"  class="form-control" id="codigo_concepto_ad_personal" name="codigo_concepto_ad_personal" required readonly > 



                                        <input type="hidden" name="concepto" id="concepto">

              </div>


<!--         <div class="row col-xs-12">

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspSalario Base Mensual:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="salario_base_mensual" name="salario_base_mensual" required readonly value="0">  

         </div>                  </div>

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspSalario Base Quincenal:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="salario_base_quincenal" name="salario_base_quincenal" required readonly value="0"  >  

         </div>                  </div>

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspSalario Base Por Hora:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="salario_base_hora" name="salario_base_hora" required readonly value="0"  >  

         </div>                  </div>

               
</div> -->

<br>

<label>&nbsp;&nbspDetalle del Calculo:</label>
<div class="row col-xs-12">

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspHoras Extras:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px" readonly class="form-control numbers-only" id="horas_extras_ad_personal" name="horas_extras_ad_personal" placeholder="Horas Extras" required value="0">  

         </div>                  </div>

         </div>
<br>
         <div class="row col-xs-12">

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspDías:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px" readonly  class="form-control numbers-only" id="dias_ad_personal" name="dias_ad_personal" placeholder="Días" required value="0">  

         </div>                  </div>

         </div>
<br>
         <div class="row col-xs-12">

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspMonto:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  readonly class="form-control numbers-only" id="monto_ad_personal" name="monto_ad_personal" placeholder="Monto" required value="0">  

            <input type="hidden"   id="resultado_final" name="resultado_final"  required value="0">  


         </div>                  </div>

         </div>

            <br>     

                                  <?php



$id_empresa= $_SESSION['id_empresa'];
 $nomina = controladorAdPersonal::ctrCargarNominas($id_empresa); 



//echo '<pre>'; print_r($conceptos); echo '</pre>';

 //exit();

  ?>

          <div class="row">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                          <label>&nbsp;&nbspSeleccione una Nomina:</label>
                                            <div class="input-group mb-6" style=" width: 100%;">
                                           
                                                 <select class="custom-select select2 nomina_ad_personal" required id="nomina_ad_personal"
                                                    name="nomina_ad_personal" required>
                                                    <option selected disabled value="">Seleccionar Nomina</option>
                                                    <?php foreach ($nomina as $key => $value): ?>
                                                    <option value="<?php echo $value["idtbl_consecutivo_nomina"];?>"
                                                        >
                                                        <?php echo $value["consecutivo"];?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <br>
                                            <input type="hidden" name="nominaTxt" id="nominaTxt">
                                        </div>





              </div>
         <!-- <br> -->
         <div class="row col-xs-12">

                  <div class="col-xs-12 col-lg-4">

           <div class="form-group">
                  <label>Fechas:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" style="pointer-events: none;cursor: default;" class="form-control float-right" name="rango_fecha_ad_personal" id="rango_fecha_ad_personal">
                    <input type="hidden"  id="rango_fecha_ad_personal_desde" name="rango_fecha_ad_personal_desde" value="2021-01-01">
                    <input type="hidden"  id="rango_fecha_ad_personal_hasta" name="rango_fecha_ad_personal_hasta" value="2021-01-01">
                  </div>
                  <!-- /.input group -->
                </div>                 </div>



         </div>

               <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Comentarios</label>
                        <textarea class="form-control" rows="3" name="comentarios_ad_personal" id="comentarios_ad_personal" placeholder="Ingrese un comentario..."></textarea>
                      </div>
                    </div>
                 
                  </div>




        



              <button type="submit" class="btn btn-primary" >Guardar</button>

         </form>

                <?php 

      $createCliente = new controladorAdPersonal();

      $createCliente -> ctrAgregarNomina();

      ?>



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

