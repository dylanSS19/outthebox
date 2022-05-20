  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agregar empleados</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Agregar empleados</li>
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




                         <button class="btn btn-primary" data-toggle="modal" data-target="#modal-agregarEmpleado">

            Agregar Empleado

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

  <div class="modal fade" id="modal-agregarEmpleado">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
                  <form role="form" id="form-agregar-personal" method="post" enctype="multipart/form-data">

                      <div class="modal-header">
              <h4 class="modal-title">Agregar Empleado</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

        <div class="row col-xs-12">

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspCédula:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="cedula-agregar-cliente" placeholder="Cédula" name="cedula-agregar-cliente" required  >

         </div>
                     </div>

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspNombre:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="nombre-agregar-cliente" name="nombre-agregar-cliente" placeholder="Nombre" required  >

         </div>
                     </div>

                                    <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspPrimer Apellido:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" name="primer-apellido-agregar-cliente" placeholder="Primer Apellido" required  >

         </div>
                     </div>



</div>

        <div class="row col-xs-12">

 <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspSegundo Apellido:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" name="segundo-apellido-agregar-cliente" placeholder="Segundo Apellido" required  >

         </div>
                     </div>


                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspTelefono:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" name="telefono-agregar-cliente"  placeholder="Telefono" required  >

         </div>
                     </div>




             <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspFecha Nacimiento:</label>
    <div class="form-group">
                 <!--  <label>Date:</label> -->
                    <div class="input-group date mb-6 datetimepicker" style=" width: 100%;" id="fecha-nacimiento-agregar-cliente" data-target-input="nearest">
                        <input type="text" style="font-size:30px;height: 50px" name="fecha-nacimiento-agregar-cliente" class="form-control datetimepicker-input" data-target="#fecha-nacimiento-agregar-cliente"/>
                        <div class="input-group-append" data-target="#fecha-nacimiento-agregar-cliente" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                     </div>



</div>

        <div class="row col-xs-12">

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspCorreo:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="mail" style="font-size:30px;height: 50px"  class="form-control" placeholder="Correo" id="correo-agregar-cliente" name="correo-agregar-cliente" required  >
       </div>
                     </div>



</div>

        <div class="row col-xs-12">

                  <div class="col-xs-12 col-lg-12">

                    <label>&nbsp;&nbspDirección:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" placeholder="Direccion Empleado" name="direccion-agregar-cliente"  required  >

         </div>
                     </div>



</div>



        <div class="row col-xs-12">


             <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspFecha Ingreso:</label>
    <div class="form-group">
                 <!--  <label>Date:</label> -->
                    <div class="input-group date mb-6 datetimepicker" style=" width: 100%;" id="fecha-ingreso-agregar-cliente" data-target-input="nearest">
                        <input type="text" style="font-size:30px;height: 50px" name="fecha-ingreso-agregar-cliente" class="form-control datetimepicker-input" data-target="#fecha-ingreso-agregar-cliente"/>
                        <div class="input-group-append" data-target="#fecha-ingreso-agregar-cliente" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                     </div>


                <?php

if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo") {

    $supervisor = "";

} elseif ($_SESSION["rol"] == "Supervisor-Tiendas") {

    $supervisor = "Tien";

} elseif ($_SESSION["rol"] == "Supervisor-DTH") {

    $supervisor = "DTH";

}

$id_empresa = $_SESSION['id_empresa'];
$departamento = controladorAgregarEmpleado::ctrCargarDepartamentos($id_empresa, $supervisor);

//echo '<pre>'; print_r($departamento); echo '</pre>';

//exit();

?>

  <style>
                                    .select2-selection__rendered {
                                        line-height: 31px !important;

                                    }

                                    .select2-container .select2-selection--single {
                                        height: 50px !important;
                                    }

                                    .select2-selection__arrow {
                                        height: 34px !important;
                                    }
                                    </style>

    <div class="col-xs-12 col-lg-8">
                                          <label>&nbsp;&nbspSeleccione Departamento:</label>
                                            <div class="input-group mb-6" style=" width: 100%;">

                                                 <select class="custom-select select2 departamento-agregar-cliente" style=" width: 100%;" required id="departamento-agregar-cliente"
                                                    name="departamento-agregar-cliente" required>
                                                    <option selected disabled value="">Seleccionar Departamento</option>
                                                    <?php foreach ($departamento as $key => $value): ?>
                                                    <option value="<?php echo $value["idtbl_departamento"]; ?>"
                                                        >
                                                        <?php echo $value["nombre"]; ?></option>
                                                    <?php endforeach?>
                                                </select>
                                            </div>
                                            <br>
                                            <input type="hidden" name="departamento" id="departamento">
                                        </div>



</div>



        <div class="row col-xs-12">

   <div class="col-xs-12 col-lg-6">
                                          <label>&nbsp;&nbspSeleccione Puesto:</label>
                                            <div class="input-group mb-6" style=" width: 100%;">
                  <select class="custom-select select2 puesto-agregar-cliente" style=" width: 100%;" required id="puesto-agregar-cliente"
                                                    name="puesto-agregar-cliente" required>
                                                    <option selected disabled value="" >Seleccionar Puesto...</option>

                                                </select>
                                            </div>
                                            <br>
                                            <input type="hidden" name="puesto" id="puesto">
                                        </div>

                  <div class="col-xs-12 col-lg-6">

                    <label>&nbsp;&nbspCuenta Bancaria:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" maxlength="22" minlength="22" style="font-size:30px;height: 50px; text-transform:uppercase"  class="form-control"
             id="cuenta-agregar-cliente" name="cuenta-agregar-cliente"  required placeholder="CR11111111111111111111"  >

         </div>
                     </div>

                        <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="chkacepto-agregar-cliente" required>
                      <label  for="chkacepto-agregar-cliente">Yo certifico que toda la información aqui descrita es real.</label>
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

$createCliente = new controladorAgregarEmpleado();

$createCliente->ctrAgregarEmpleado();

?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>