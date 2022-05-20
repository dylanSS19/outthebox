  <?PHP 
  
  $planes = ClientesController::ctrCargarPlanes();
  
  
  ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Clientes</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                          <li class="breadcrumb-item active">Clientes</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">


          <div class="container-fluid">



              <div class="row">

                  <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">

                              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">

                                  Agregar Cliente

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

                                  <table class="table table-bordered table-striped dt-responsive" id="tablaclientes"
                                      width="100%">

                                      <thead>

                                          <tr>

                                              <th style="width:5px">#</th>
                                              <th>Acciones</th>
                                              <th>Activo</th>
                                              <th>Cédula</th>
                                              <th>Nombre</th>
                                              <th>Email</th>
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



  <div class="modal " id="modalAgregarCliente">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

                  <div class="modal-header">
                      <h4 style="text-align: center;" class="modal-title">Agregar Empresas</h4>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">



                  <div class="col-xs-12 col-lg-6">
                              <label>&nbsp;&nbspServicios a Contratar:</label>
                              <div class="input-group mt-2" style=" width: 100%;">

                                  <select class="servicio_contratado select2" id="servicio_contratado"
                                      name="servicio_contratado[]" multiple="" style="width: 100%;"
                                      data-placeholder="Seleccionar Servicios" aria-hidden="true" required hidden>
                                     
                                      <?php foreach ($planes as $key => $value): ?>

                                      <option value="<?php echo $value["nombre"];?>"><?php echo $value["nombre"];?>
                                      </option>

                                      <?php endforeach ?>

                                  </select>
                              </div>
                          </div>

                      <div class="row col-xs-12">
               
                          <!-- <input type="text" style="font-size:25px;height: 50px"  class="form-control" id="servContratado[]" name="servContratado[]" required placeholder="Ubicación" >   -->

                          <div class="col-xs-12 col-lg-6">
                              <label class="mt-1">&nbsp;&nbspTipo de identificación:</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text "><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px" class="custom-select  tipocedula"
                                      id="agregartipocedulacliente" name="agregartipocedulacliente" required>
                                      <option selected disabled value="">Seleccionar...</option>
                                      <option value="Fisico">Cédula Física</option>
                                      <option value="Pasaporte">Pasaporte</option>
                                      <option value="Juridico">Cédula Jurídica</option>
                                      <option value="Dimex">DIMEX</option>
                                      <option value="Nite">NITE</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-6">
                              <label class="mt-1">&nbsp;&nbspIdentificación De Cliente:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" minlength="9"
                                      class="form-control cedula" id="agregarcedulacliente" name="agregarcedulacliente"
                                      required placeholder="Número">

                              </div>
                          </div>


                      </div>
                 

                      <div class="row">
                          <div class="col-xs-12 col-lg-5">

                              <label class="mt-1">&nbsp;&nbspNombre Empresa:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="agregarnombrecliente" name="agregarnombrecliente" required
                                      placeholder="Nombre">

                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-7">
                              <label class="mt-1">&nbsp;&nbspNombre Contacto:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="agregarnombrecontactocliente" name="agregarnombrecontactocliente" required
                                      placeholder="Nombre Contacto">

                              </div>
                          </div>

                         
                          <div class="col-xs-12 col-lg-12">
                              <label class="mt-1">&nbsp;&nbspUbicación:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="agregarubicacioncliente" name="agregarubicacioncliente" required
                                      placeholder="Ubicación">

                              </div>
                          </div>


                      </div>
                 


                      <!-- provincia -->

                      <?php 

    $provincias = ClientesController::ctrBUSCAR_PROVINCIAS();
     


    ?>

                      <div class="row">

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspProvincia:</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px" class="custom-select "
                                      id="agregarprovinciaempresas" name="agregarprovinciaempresas" required>
                                      <option selected disabled value="">Seleccionar Provincia...</option>

                                      <?php foreach ($provincias as $key => $value): ?>
                                      <!--=====================================
  este foreach captura la ruta y puedo autocompletar el otro select dependiedo de los datos que seleccione en el primero
  ======================================-->

                                      <option value="<?php echo $value["idprovincias"];?>">
                                          <?php echo $value["nombre"];?></option>


                                      <?php endforeach ?>

                                  </select>
                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-4">

                              <label class="mt-1">&nbsp;&nbspCantón</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px" class="custom-select "
                                      id="agregarcantonempresas" name="agregarcantonempresas" required>
                                      <option selected disabled value="">Seleccionar Canton...</option>

                                  </select>
                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspDistrito</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px" class="custom-select "
                                      id="agregardistritoempresas" name="agregardistritoempresas" required>
                                      <option selected disabled value="">Seleccionar Distrito...</option>

                                  </select>
                              </div>
                          </div>





                      </div>
             

                      <div class="row">
                          <div class="col-xs-12 col-lg-4">

                              <label class="mt-1">&nbsp;&nbspTelefono:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="agregartelefonocliente" name="agregartelefonocliente" required
                                      placeholder="Telefono">

                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspCorreo:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="mail" style="font-size:15px;height: 35px"
                                      class="form-control validarcorreo" id="agregarcorreocliente"
                                      name="agregarcorreocliente" required placeholder="Correo">

                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspLatitud:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="agregarlatitudcliente" name="agregarlatitudcliente" readonly required
                                      placeholder="Latitud">

                              </div>
                          </div>



                      </div>
                  

                      <div class="row">

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspLongitud:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="agregarlongitudcliente" name="agregarlongitudcliente" readonly required
                                      placeholder="Longitud">

                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspRegimen:</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px" class="custom-select "
                                      id="agregarregimencliente" name="agregarregimencliente" required>
                                      <option selected disabled value="">Seleccionar...</option>
                                      <option value="Simplificada">Simplificada</option>
                                      <option value="Tradicional">Tradicional</option>

                                  </select>
                              </div>
                          </div>


                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspCodigo:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="agregarcodigocliente" name="agregarcodigocliente" placeholder="Codigo Pagina">

                              </div>
                          </div>
                          <!--           <div class="col-xs-12 col-lg-4">
          <label>&nbsp;&nbspActividad Economica:</label> 
            <div class="input-group mb-6" style=" width: 100%;">
              <input type="text" class="form-control" style="font-size:20px;height: 50px; background: #fbfbfb;" id="actividadEmpresa" name="actividadEmpresa" >
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat" id=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><i class="fas fa-search"></i></font></font></button>
                </span>
            </div>
          <br>
          </div>   -->


                          <div class="col-xs-12 col-lg-4">
                        
                              <label class="mt-1">&nbsp;&nbspLogo Empresa</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <img src="views/img/users/default/anonymous.png" class="img-thumbnail"
                                      id="logoempresa_vista" width="100px">

                                  <input type="file" class="logoempresa " id="logoempresa" name="logoempresa">

                                  <p class="help-block">Peso máximo de la foto 4MB</p>


                              </div>
                          </div>

                      </div>

                      <h3>Datos Usuario</h3>


                      <div class="row col-xs-12 col-lg-12">

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

                          <?php 



if($_SESSION["rol"] == "Administrador"){

    $idusuario = "%";

}else{

    $idusuario = $_SESSION["id"];

}



$Users = ClientesController::ctrCargarUsuarios($idusuario);

// echo '<pre>'; print_r($Users); echo '</pre>';

 ?>



                          <div class="col-xs-12 col-lg-4" hidden id="usuarioExistente"
                              style="width: 100%; height: 100%">
                              <label class="mt-1">&nbsp;&nbspUsuario:</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;" class="input-group-text "><i
                                              class="fas fa-user-tie"></i></span>
                                  </div>
                                  <select style="font-size:15px; width: 80%;" class="custom-select select2"
                                      id="Usuarioempresas" name="Usuarioempresas" required>
                                      <option selected disabled value="">Seleccionar Tipo Cédula</option>
                                      <?php foreach ($Users as $key => $value): ?>

                                      <option value="<?php echo $value["idtbluser_2"];?>"><?php echo $value["nombre"];?>
                                      </option>


                                      <?php endforeach ?>
                                  </select>
                              </div>
                          </div>



                          <div class="col-xs-12 col-lg-3" id="idnombre">
                              <label class="mt-1">&nbsp;&nbspNombre:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="agregarnombre" name="agregarnombre" required placeholder="Nombre">

                              </div>
                          </div>




                          <div class="col-xs-12 col-lg-3" id="idusuario">
                              <label class="mt-1">&nbsp;&nbspNombre Usuario:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="agregarusuario" name="agregarusuario" required placeholder="Nombre Usuario">

                              </div>
                          </div>



                          <div class="col-xs-12 col-lg-3" id="idcontrasena">
                              <label class="mt-1">&nbsp;&nbspContraseña:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="agregarcontrasena" name="agregarcontrasena" required placeholder="Contraseña">

                              </div>
                          </div>



                          <div class="col-xs-12 col-lg-3" id="idprivilegio">
                              <label class="mt-1">&nbsp;&nbspPrivilegios:</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text "><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px"
                                      class="custom-select cleancombo privilegio" id="privilegio" name="privilegio"
                                      required>
                                      <option selected disabled value="">Seleccionar...</option>
                                      <option value="Cliente Admin">Cliente</option>
                                  </select>
                              </div>
                          </div>




                          <div class="col-xs-12 col-lg-4">
                              <br>
                              <div class="checkbox">
                                  <input type="checkbox" class="form-check-input chkUsuarioExistente"
                                      style="font-size:20px;height: 100px" id="chkUsuarioExistente"
                                      name="chkUsuarioExistente">
                                  <label class="form-check-label" style="font-size:20px;height: 100px"
                                      for="chkUsuarioExistente">Usuario Existente.</label>
                              </div>

                          </div>


                      </div>

                      <!-- <h3 id="txt_empresa" hidden>Documentos Empresa</h3> -->


                      <div class="row col-xs-12 col-lg-12" id="datos_empresa" hidden>


                          <!-- <div class="col-xs-12 col-lg-3">
                              <label>&nbsp;&nbspPin P12:</label>
                              <div class="input-group mb-6" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:25px;height: 50px" class="form-control"
                                      id="pin_p12" name="pin_p12" placeholder="Usuario">

                              </div>
                          </div> -->

                          <!-- <div class="col-xs-12 col-lg-3">
                              <label>&nbsp;&nbspUsuario token:</label>
                              <div class="input-group mb-6" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:25px;height: 50px" class="form-control"
                                      id="usuario_token" name="usuario_token" placeholder="Usuario">

                              </div>
                          </div> -->


                          <!-- <div class="col-xs-12 col-lg-3">
                              <label>&nbsp;&nbspContraseña token:</label>
                              <div class="input-group mb-6" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:25px;height: 50px" class="form-control"
                                      id="contrasena_token" name="contrasena_token" placeholder="Contraseña">

                              </div>
                          </div> -->


                          <!-- <div class="col-xs-12 col-lg-3" style="position : relative;">
                              <label>&nbsp;&nbspDocumento p12</label>
                              <div class="input-group mb-6" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                       <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span> 

                                  </div>

                                  <input type="file" id="documento_p12" name="documento_p12" multiple>

                              </div>
                          </div> -->

                      </div>

                   
                      <!-- <h4 id="txt_pruebas" hidden>Datos Ambiente Pruebas</h4> -->

                      <div class="row col-xs-12 col-lg-12" id="datos_empresa_prueba" hidden>

                          <!-- <div class="col-xs-12 col-lg-3">
                              <label>&nbsp;&nbspPin P12:</label>
                              <div class="input-group mb-6" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:25px;height: 50px" class="form-control"
                                      id="pin_p12_prueba" name="pin_p12_prueba" placeholder="Usuario">

                              </div>
                          </div> -->


                          <!-- <div class="col-xs-12 col-lg-3">
                              <label>&nbsp;&nbspUsuario token:</label>
                              <div class="input-group mb-6" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:25px;height: 50px" class="form-control"
                                      id="usuario_token_prueba" name="usuario_token_prueba" placeholder="Usuario">

                              </div>
                          </div> -->


                          <!-- <div class="col-xs-12 col-lg-3">
                              <label>&nbsp;&nbspContraseña token:</label>
                              <div class="input-group mb-6" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:25px;height: 50px" class="form-control"
                                      id="contrasena_token_prueba" name="contrasena_token_prueba"
                                      placeholder="Contraseña">

                              </div>
                          </div> -->


                          <!-- <div class="col-xs-12 col-lg-3" style="position : relative;">
                              <label>&nbsp;&nbspDocumento p12</label>
                              <div class="input-group mb-6" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                       <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span> 

                                  </div>

                                  <input type="file" id="documento_p12_prueba" name="documento_p12_prueba" multiple>

                              </div>
                          </div> -->





                      </div>





                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
              </form>

              <?php 

      $createCliente = new ClientesController();

      $createCliente -> ctrAgregarCLiente();

      // $createCliente -> ctrPruebaPivilegios();
      
      ?>


          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>


  <div class="modal " id="modalEditarCliente">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">

              <form role="form" method="post" enctype="multipart/form-data">

                  <div class="modal-header">
                      <h4 style="text-align: center;" class="modal-title">Editar Cliente</h4>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">

                      <div class="row col-xs-12">

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspServicios Contratados:</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <!-- <div class="input-group-prepend">
                    <span style="font-size:20px;height: 50px"  class="input-group-text "><i class="far fa-flag"></i></span>
                    </div> -->
                                  <select class="editarservicio_contratado select2" id="editarservicio_contratado"
                                      name="editarservicio_contratado[]" multiple="" style="width: 100%;"
                                      placeholder="Seleccionar Servicios" readonly aria-hidden="true" required disabled> 
                                      <!-- <select style="font-size:25px;height: 50px" class="custom-select  editarservicio_contratado" id="editarservicio_contratado" name="editarservicio_contratado" required> -->
                                      <?php foreach ($planes as $key => $value): ?>

                                      <option value="<?php echo $value["nombre"];?>"><?php echo $value["nombre"];?>
                                      </option>

                                      <?php endforeach ?>

                                  </select>
                              </div>
                          </div>

                          <input type="text" style="font-size:25px;height: 50px" class="form-control"
                              id="servContratado" name="servContratado[]" value="" required placeholder="Ubicación"
                              hidden>



                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspTipo de identificación:</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text "><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px"
                                      class="custom-select  editartipocedulacliente" id="editartipocedulacliente"
                                      name="editartipocedulacliente" required>
                                      <option selected disabled value="">Seleccionar...</option>
                                      <option value="Fisico">Cédula Física</option>
                                      <option value="Pasaporte">Pasaporte</option>
                                      <option value="Juridico">Cédula Jurídica</option>
                                      <option value="Dimex">DIMEX</option>
                                      <option value="Nite">NITE</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspIdentificación De Cliente:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" minlength="9"
                                      class="form-control editarcedulacliente" id="editarcedulacliente"
                                      name="editarcedulacliente" required placeholder="Número">

                              </div>
                          </div>


                      </div>
                 

                      <div class="row">
                          <div class="col-xs-12 col-lg-4">

                              <label class="mt-1">&nbsp;&nbspNombre Empresa:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editarnombrecliente" name="editarnombrecliente" required placeholder="Nombre">

                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-8">
                              <label class="mt-1">&nbsp;&nbspNombre Contacto:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editarnombrecontactocliente" name="editarnombrecontactocliente" required
                                      placeholder="Nombre Contacto">

                              </div>
                          </div>

                    
                          <div class="col-xs-12 col-lg-12">
                              <label class="mt-1">&nbsp;&nbspUbicación:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editarubicacioncliente" name="editarubicacioncliente" required
                                      placeholder="Ubicación">

                              </div>
                          </div>


                      </div>
                  


                      <!-- provincia -->

                      <?php 

    $provincias = ClientesController::ctrBUSCAR_PROVINCIAS();
     


    ?>

                      <div class="row">

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspProvincia:</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px" class="custom-select "
                                      id="editarprovinciaempresas" name="editarprovinciaempresas" required>
                                      <option selected disabled value=""></option>

                                      <?php foreach ($provincias as $key => $value): ?>
                                      <!--=====================================
  este foreach captura la ruta y puedo autocompletar el otro select dependiedo de los datos que seleccione en el primero
  ======================================-->

                                      <option value="<?php echo $value["idprovincias"];?>">
                                          <?php echo ucfirst(strtolower($value["nombre"]));?></option>


                                      <?php endforeach ?>

                                  </select>
                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-4">

                              <label class="mt-1">&nbsp;&nbspCantón</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px" class="custom-select "
                                      id="editarcantonempresas" name="editarcantonempresas" required>
                                      <!-- <option selected disabled value="" >Seleccionar Canton...</option> -->

                                  </select>
                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspDistrito</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px" class="custom-select "
                                      id="editardistritoempresas" name="editardistritoempresas" required>
                                      <!-- <option selected disabled  value="" >Seleccionar Distrito...</option> -->

                                  </select>
                              </div>
                          </div>


                      </div>
                  

                      <div class="row">
                          <div class="col-xs-12 col-lg-4">

                              <label class="mt-1">&nbsp;&nbspTelefono:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editartelefonocliente" name="editartelefonocliente" required
                                      placeholder="Telefono">

                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspCorreo:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="mail" style="font-size:15px;height: 35px"
                                      class="form-control validarcorreo" id="editarcorreocliente"
                                      name="editarcorreocliente" required placeholder="Correo">

                              </div>
                          </div>


                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspRegimen:</label>
                              <div class="input-group mt-2" style=" width: 100%;">
                                  <div class="input-group-prepend">
                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="far fa-flag"></i></span>
                                  </div>
                                  <select style="font-size:15px;height: 35px" class="custom-select "
                                      id="editarregimencliente" name="editarregimencliente" required>
                                      <option selected disabled value="">Seleccionar...</option>
                                      <option value="Simplificada">Simplificada</option>
                                      <option value="Tradicional">Tradicional</option>

                                  </select>
                              </div>
                          </div>



                      </div>
                   

                      <div class="row">



                          <div class="col-xs-12 col-lg-4">
                              <label class="mt-1">&nbsp;&nbspCodigo:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editarcodigocliente" name="editarcodigocliente" placeholder="Codigo Pagina">

                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-4" hidden>
                              <label class="mt-1">&nbsp;&nbspIDEmpresa:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editar_idempresa" name="editar_idempresa" value=""
                                      placeholder="Codigo Pagina">

                              </div>
                          </div>
                          <br>

                      </div>

           
                      <h3 class="mt-2" id="txt_empresa_editar" hidden>Documentos Empresa</h3>


                      <div class="row col-xs-12 col-lg-12" id="datos_empresa_editar" hidden>


                          <div class="col-xs-12 col-lg-3">
                              <label class="mt-1">&nbsp;&nbspPin P12:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editarpin_p12" name="editarpin_p12" placeholder="Usuario">

                              </div>
                          </div>

                          <div class="col-xs-12 col-lg-3">
                              <label class="mt-1">&nbsp;&nbspUsuario token:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editarusuario_token" name="editarusuario_token" placeholder="Usuario">

                              </div>
                          </div>


                          <div class="col-xs-12 col-lg-3">
                              <label class="mt-1">&nbsp;&nbspContraseña token:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editarcontrasena_token" name="editarcontrasena_token"
                                      placeholder="Contraseña">

                              </div>
                          </div>


                          <div class="col-xs-12 col-lg-3" style="position : relative;">
                              <label class="mt-1">&nbsp;&nbspDocumento p12</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <!-- <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span> -->

                                  </div>

                                  <input type="file" id="editardocumento_p12" name="editardocumento_p12" multiple>

                              </div>
                          </div>

                      </div>

  
                      <h4 class="mt-2" id="txt_pruebas_editar" hidden>Datos Ambiente Pruebas</h4>

                      <div  class="row col-xs-12 col-lg-12" id="datos_empresa_prueba_editar" hidden>

                          <div class="col-xs-12 col-lg-3">
                              <label class="mt-1">&nbsp;&nbspPin P12:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>
                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editarpin_p12_prueba" name="editarpin_p12_prueba" placeholder="Usuario">

                              </div>
                          </div>


                          <div class="col-xs-12 col-lg-3">
                              <label class="mt-1">&nbsp;&nbspUsuario token:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editarusuario_token_prueba" name="editarusuario_token_prueba"
                                      placeholder="Usuario">

                              </div>
                          </div>


                          <div class="col-xs-12 col-lg-3">
                              <label class="mt-1">&nbsp;&nbspContraseña token:</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                              class="fas fa-mobile-alt"></i></span>

                                  </div>

                                  <input type="text" style="font-size:15px;height: 35px" class="form-control"
                                      id="editarcontrasena_token_prueba" name="editarcontrasena_token_prueba"
                                      placeholder="Contraseña">

                              </div>
                          </div>


                          <div class="col-xs-12 col-lg-3" style="position : relative;">
                              <label class="mt-1">&nbsp;&nbspDocumento p12</label>
                              <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                  <div class="input-group-prepend">

                                      <!-- <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span> -->

                                  </div>

                                  <input type="file" id="editardocumento_p12_prueba" name="editardocumento_p12_prueba"
                                      multiple>

                              </div>
                          </div>
                      </div>


                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
              </form>

              <?php 

      $createCliente = new ClientesController();

      // $createCliente -> ctrPruebaPivilegios();
      $createCliente -> ctrEditarCLiente();
      


      ?>


          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>



  <div class="modal" id="modalActividadEconomica">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <!-- <form role="form" method="post" enctype="multipart/form-data" id="frmClientes"> -->

              <div class="modal-header">
                  <h4 style="text-align: center;" class="modal-title">Buscar Cabys</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body">

                  <div class="row">

                      <div class="col-xs-12 col-lg-12">
                          <label>&nbsp;&nbspNombre Porducto</label>
                          <div class="input-group mb-6" style=" width: 100%;">
                              <div class="input-group-prepend">
                                  <span style="font-size:15px;" class="input-group-text"><i
                                          class="fas fa-search"></i></span>
                              </div>
                              <input type="text" style="font-size:15px;" class="form-control"
                                  id="frmProductoCabysSearch" name="frmProductoCabysSearch" required
                                  placeholder="Nombre">
                          </div>
                          <br>
                      </div>

                  </div>

                  <div class="row justify-content-end">
                      <div class="col-xs-12 col-lg-2 justify-content-end">
                          <div class="input-group mb-2" style=" width: 100%;">
                              <div class='btn-group'>
                                  <button type="button" class="btn btn-outline-secondary BuscarCabys">Buscar</button>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-12 col-lg-12">
                          <table class="table table-bordered table-striped dt-responsive " id="tablaProductos"
                              width="100%">

                              <thead>

                                  <tr>
                                      <th><strong>Acción</strong></th>
                                      <th><strong>Descripción</strong></th>
                                      <th><strong>Código</strong></th>
                                      <th><strong>Impuesto</strong></th>
                                  </tr>

                              </thead>

                              <tbody class="">


                              </tbody>

                          </table>



                      </div>
                  </div>


              </div>

              <div class="modal-footer justify-content-between">

                  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                  <button type="button" class="btn btn-primary btnEnviarCorreo">Enviar</button>

              </div>

              <!-- </form>   -->
          </div>
      </div>
  </div>