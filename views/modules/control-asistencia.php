  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Control de Asistencia</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Control de Asistencia</li>
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

                      <!-- aqui inicia el tap menu -->
                      <form method="post" enctype="multipart/form-data">
                          <div class="card card-default">
                              <!-- <div class="card-header">
                                    <h3 class="card-title"></h3>
                                </div> -->
                              <div class="card-body p-0">
                                  <div class="bs-stepper">
                                      <div class="bs-stepper-header" role="tablist">
                                          <!-- your steps here -->
                                          <div class="step" data-target="#val-user-part">
                                              <button type="button" class="step-trigger" role="tab"
                                                  aria-controls="val-user-part" id="val-user-part-trigger">
                                                  <span class="bs-stepper-circle">1</span>
                                                  <span class="bs-stepper-label">Validar Usuario</span>
                                              </button>
                                          </div>
                                          <div class="line"></div>
                                          <div class="step" data-target="#Foto-part">
                                              <button type="button" class="step-trigger" role="tab"
                                                  aria-controls="Foto-part" id="Foto-part-trigger">
                                                  <span class="bs-stepper-circle">2</span>
                                                  <span class="bs-stepper-label">Tomar Fotos</span>
                                              </button>
                                          </div>
                                      </div>
                                      <div class="bs-stepper-content">
                                          <!-- your steps content here -->
                                          <div id="val-user-part" class="content" role="tabpanel"
                                              aria-labelledby="val-user-part-trigger">


                                              <!-- AGREGAR AQUI LOS DIVS -->

                                              <div class="global mt-2">


                                                  <div class="col-xs-12 col-lg-6">

                                                      <label>&nbsp;&nbspCédula:</label>
                                                      <div class="input-group mb-6" style=" width: 100%;">

                                                          <div class="input-group-prepend">

                                                              <span style="font-size:20px;height: 50px"
                                                                  class="input-group-text"><i
                                                                      class="fas fa-mobile-alt"></i></span>

                                                          </div>

                                                          <input autocomplete="off" type="text"
                                                              style="font-size:30px;height: 50px" class="form-control"
                                                              id="cedula-control-asistencia" placeholder="Cédula"
                                                              name="cedula-control-asistencia" required>

                                                          <input type="hidden" class="form-control"
                                                              id="idEmpleadopicsnap" name="idEmpleadopicsnap" required>
                                                          <input type="hidden" class="form-control"
                                                              id="id_empresaControlAsistencia"
                                                              name="id_empresaControlAsistencia" required>
                                                          <input type="hidden" class="form-control" id="nombreEmpleado"
                                                              name="nombreEmpleado" required>
                                                          <input type="hidden" class="form-control" id="empresa"
                                                              name="empresa" required>

                                                      </div>
                                                  </div>



                                              </div>

                                              <div class="row">

                                                  <div class="col-6 col-sm-8 col-md-8 col-lg-8 ">
                                                      <button class="btn btn-outline-primary mt-4"
                                                          id="btnSiguienteModel" type="button">Siguiente</button>
                                                  </div>

                                              </div>

                                          </div>




                                          <div id="Foto-part" class="content" role="tabpanel"
                                              aria-labelledby="Foto-part-trigger">



                                              <!-- AGREGAR AQUI LOS DIVS -->

                                                <div class="row">


                                                    <div class="col-xs-12 col-sm-12  col-lg-12">

                                                      <video class="previewsnap hidden-xs img-responsive"
                                                          style="width:480;height: 360;display: block" playsinline
                                                          autoplay></video>
                                                      <canvas id="canvasnap" style="display:none"
                                                          class="snap hidden-xs img-responsive"></canvas>


                                                      <!-- <img src='' style="display:none" id='picsnapcontrol' name='picsnapcontrol' style='max-height:100%'> -->
                                                      <input type="hidden" class="fromcanvas" name="fromcanvas"
                                                          id="fromcanvas" value="">

                                                    </div>


                                                  <div class="col-xs-12 col-lg-12 ">

                                                      <button type="button"
                                                          class="btn btn-outline-primary snapbtn mt-4 mb-4">Tomar
                                                          foto</button>

                                                  </div>



                                              </div>



                                              <div class="row">

                                                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 ">
                                                      <button class="btn btn-outline-primary" type="button"
                                                          onclick="stepper.previous()">Anterior</button>
                                                  </div>


                                                  <div
                                                      class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end">

                                                      <button type="submit"
                                                          class="btn btn-outline-primary btnValidarAsis" hidden>Validar
                                                          Asistencia</button>
                                                  </div>

                                              </div>

                                              <!-- <button type="button" class="btn btn-primary justify-content-end">Pagar</button> -->
                                          </div>

                                      </div>
                                  </div>
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">

                              </div>
                          </div>
                      </form>

                      <?php
                      
                        $imagenes = new controladorControlAsistencia();
                        $imagenes->comparaFoto();

                      ?>

                      <!-- /.card -->

                      <!-- aqui termina el tap menu -->

                      <!-- Aqui va el codigo viejo  -->


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