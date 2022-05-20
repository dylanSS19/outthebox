  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Consulta de empleados</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Consulta de empleados</li>
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
 $empleados = controladorConsultaEmpleados::ctrCargarEmpleados($id_empresa,$supervisor); 


  ?>

                              <div class="row">
                                  <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                      <label>&nbsp;&nbspSeleccione Empleado:</label>
                                      <div class="input-group mb-6" style=" width: 100%;">

                                          <select class="custom-select select2 empleados_consulta_empleados" required
                                              id="empleados_consulta_empleados" name="empleados_consulta_empleados"
                                              required>
                                              <option selected disabled value="">Seleccionar Empleado</option>
                                              <?php foreach ($empleados as $key => $value): ?>
                                              <option value="<?php echo $value["idtbl_empleados"];?>">
                                                  <?php echo $value["nombre_completo"];?></option>
                                              <?php endforeach ?>
                                          </select>
                                      </div>
                                      <br>
                                  </div>

                                  <!--                     <br>
<br> -->


                              </div>


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

  <div class="modal fade" id="modal-consultaEmpleado">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Consulta Empleado</h4>
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

                                  <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                          class="far fa-id-card"></i></span>

                              </div>

                              <input type="text" style="font-size:30px;height: 50px" class="form-control"
                                  id="cedula-consulta-cliente" readonly>
                              <input type="hidden" style="font-size:30px;height: 50px" class="form-control"
                                  id="IdEmpleado-consulta-cliente" name="IdEmpleado-consulta-cliente" readonly>

                          </div>
                      </div>

                      <div class="col-xs-12 col-lg-8">

                          <label>&nbsp;&nbspNombre Completo:</label>
                          <div class="input-group mb-6" style=" width: 100%;">

                              <div class="input-group-prepend">

                                  <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                          class="fas fa-user"></i></span>

                              </div>

                              <input type="text" style="font-size:30px;height: 50px" class="form-control"
                                  id="nombre-consulta-cliente" readonly>

                          </div>
                      </div>



                  </div>


                  <div class="row col-xs-12">

                      <div class="col-xs-12 col-lg-12">

                          <label>&nbsp;&nbspDirección:</label>
                          <div class="input-group mb-6" style=" width: 100%;">

                              <div class="input-group-prepend">

                                  <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                          class="fas fa-search-location"></i></span>

                              </div>

                              <input type="text" style="font-size:30px;height: 50px" class="form-control"
                                  id="direccion-consulta-cliente" readonly>

                          </div>
                      </div>



                  </div>

                  <div class="row col-xs-12">

                      <div class="col-xs-12 col-lg-4">

                          <label>&nbsp;&nbspTelefono:</label>
                          <div class="input-group mb-6" style=" width: 100%;">

                              <div class="input-group-prepend">

                                  <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                          class="fas fa-phone-alt"></i></span>

                              </div>

                              <input type="text" style="font-size:30px;height: 50px" class="form-control"
                                  id="telefono-consulta-cliente" readonly>

                          </div>
                      </div>

                      <div class="col-xs-12 col-lg-4">

                          <label>&nbsp;&nbspEstado:</label>

                          <div class="input-group mb-6" style=" width: 100%;">

                              <div class="input-group-prepend">

                                  <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                          class="fas fa-check"></i></span>

                              </div>

                              <input type="text" style="font-size:30px;height: 50px" class="form-control"
                                  id="activo-consulta-cliente" readonly>



                          </div>

                          <!--      <div class="alert alert-success alert-dismissible" style=" width: 100%;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Success alert preview. This alert is dismissable.
                </div>   -->
                      </div>


                  </div>

                  <div class="row col-xs-12">

                      <div class="col-xs-12 col-lg-4">

                          <label>&nbsp;&nbspFecha Nacimiento:</label>
                          <div class="input-group mb-6" style=" width: 100%;">

                              <div class="input-group-prepend">

                                  <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                          class="fas fa-calendar-day"></i></span>
 
                              </div>

                              <input type="text" style="font-size:30px;height: 50px" class="form-control"
                                  id="fecha-nacimiento-consulta-cliente" readonly>

                          </div>
                      </div>

                      <div class="col-xs-12 col-lg-4">

                          <label>&nbsp;&nbspFecha Ingreso:</label>
                          <div class="input-group mb-6" style=" width: 100%;">

                              <div class="input-group-prepend">

                                  <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                          class="fas fa-calendar-day"></i></span>

                              </div>

                              <input type="text" style="font-size:30px;height: 50px" class="form-control"
                                  id="fecha-ingreso-consulta-cliente" readonly>

                          </div>
                      </div>

                      <div class="col-xs-12 col-lg-4">

                          <label>&nbsp;&nbspDepartamento:</label>
                          <div class="input-group mb-6" style=" width: 100%;">

                              <div class="input-group-prepend">

                                  <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                          class="far fa-building"></i></span>

                              </div>

                              <input type="text" style="font-size:30px;height: 50px" class="form-control"
                                  id="departamento-consulta-cliente" readonly>

                          </div>
                      </div>



                  </div>



                  <div class="row col-xs-12">

                      <div class="col-xs-12 col-lg-6">

                          <label>&nbsp;&nbspPuesto:</label>
                          <div class="input-group mb-6" style=" width: 100%;">

                              <div class="input-group-prepend">

                                  <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                          class="fas fa-user-tie"></i></span>

                              </div>

                              <input type="text" style="font-size:30px;height: 50px" class="form-control"
                                  id="puesto-consulta-cliente" readonly>

                          </div>
                      </div>

                      <div class="col-xs-12 col-lg-6">

                          <label>&nbsp;&nbspCuenta Bancaria:</label>
                          <div class="input-group mb-6" style=" width: 100%;">

                              <div class="input-group-prepend">

                                  <span style="font-size:20px;height: 50px" class="input-group-text"><i
                                          class="fas fa-money-check-alt"></i></span>

                              </div>

                              <input type="text" style="font-size:30px;height: 50px" class="form-control"
                                  id="cuenta-consulta-cliente" readonly>

                          </div>
                      </div>


                      <div class="col-12 mt-3" id="imgCedulaEmpleado">


                      </div>


                      <!-- INICIO DE LOS TAPS -->

                      <div class="col-sm-12 col-md-12col-lg-12">
                          <div class="card card-info shadow-sm">
                              <div class="card-header">
                                  <h3 class="card-title">Documentos Empleado</h3>

                                  <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                          <i class="fas fa-minus"></i>
                                      </button>
                                  </div>

                              </div>



                              <div class="card-body">
                                  <div class="row">

                                      <!-- <h4>Datos de pago</h4> -->


                                      <!-- <div class="col-lg-6"> -->

                                      <div class="col-12 col-sm-12 col-lg-12">
                                          <div class="card card-dark card-tabs">
                                              <div class="card-header p-0 pt-1">
                                                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                      <li class="nav-item">
                                                          <a class="nav-link active" id="custom-tabs-one-fotos-tab"
                                                              data-toggle="pill" href="#custom-tabs-fotos" role="tab"
                                                              aria-controls="custom-tabs-one-home"
                                                              aria-selected="true">Fotos</a>
                                                      </li>


                                                      <li class="nav-item">
                                                          <a class="nav-link" id="custom-tabs-one-Dropzone-tab"
                                                              data-toggle="pill" href="#custom-tabs-Dropzone" role="tab"
                                                              aria-controls="custom-tabs-one-profile"
                                                              aria-selected="false">Documentos</a>
                                                      </li>



                                                      <!--<li class="nav-item">
                                                                                    <a class="nav-link" id="custom-tabs-one-tarjeta-tab" data-toggle="pill" href="#custom-tabs-tarjeta" role="tab"aria-controls="custom-tabs-one-messages" aria-selected="false">Pago con Tarjeta (Proximamente)</a>
                                                                                </li>-->

                                                  </ul>
                                              </div>


                                              <div class="card-body">
                                                  <div class="tab-content" id="custom-tabs-one-tabContent">


                                                      <div class="tab-pane fade show active" id="custom-tabs-fotos"
                                                          role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">



                                                          <div class="container">
                                                              <form method="post" enctype="multipart/form-data">
                                                                  <div class="row col-xs-12 mt-5">
                                                                      <input type="hidden" id="idEmpleadoImg"
                                                                          name="idEmpleadoImg">

                                                                      <input type="hidden" id="idEmpresaImg"
                                                                          name="idEmpresaImg">

                                                                      <div class="row">
                                                                          <div class="col-xs-12 col-lg-5 mr-2">
                                                                              <label>&nbsp;&nbspFoto Frontal De La
                                                                                  Identificación:</label>
                                                                              <div class="input-group mb-6"
                                                                                  style=" width: 100%;">

                                                                                  <div class="form-group">

                                                                                      <img src="views/img/users/default/anonymous.png"
                                                                                          class="img-thumbnail fotoCedulaEmpleadoFrontalVista"
                                                                                          id="preview" width="100px">

                                                                                      <input type="file"
                                                                                          class="fotoCedulaEmpleadoFrontal"
                                                                                          id="imgIdefntificacionFrontal"
                                                                                          accept="image/jpeg"
                                                                                          name="imgIdefntificacionFrontal">
                                                                                  </div>


                                                                              </div>
                                                                          </div>
                                                                          <div
                                                                              class="imgFrontalView col-lg-5 col-12 mt-4">
                                                                          </div>
                                                                      </div>

                                                                      <div class="row">
                                                                          <div class="col-xs-12 col-lg-5 mr-2">
                                                                              <div class="form-group">
                                                                                  <label>&nbsp;&nbspFoto Trasera De La
                                                                                      Identificación:</label>
                                                                                  <div class="input-group mb-6"
                                                                                      style=" width: 100%;">
                                                                                      <img src="views/img/users/default/anonymous.png"
                                                                                          class="img-thumbnail fotoCedulaEmpleadoTraseraVista"
                                                                                          id="preview" width="100px">

                                                                                      <input type="file"
                                                                                          class="fotoCedulaEmpleadoTrasera"
                                                                                          id="imgIdefntificacionTrasera"
                                                                                          accept="image/jpeg"
                                                                                          name="imgIdefntificacionTrasera">
                                                                                  </div>

                                                                              </div>
                                                                          </div>
                                                                          <div
                                                                              class="imgTraseraView col-lg-5 col-12 mt-4">
                                                                          </div>
                                                                      </div>

                                                                      <div class="row">
                                                                          <div class="col-xs-12 col-lg-5 mr-2">
                                                                              <label>&nbsp;&nbspFoto Empleado:</label>
                                                                              <div class="input-group mb-6"
                                                                                  style=" width: 100%;">

                                                                                  <div class="form-group">

                                                                                      <img src="views/img/users/default/anonymous.png"
                                                                                          class="img-thumbnail fotoEmpleadoVista"
                                                                                          id="preview" width="100px">

                                                                                      <input type="file"
                                                                                          class="fotoEmpleado"
                                                                                          id="fotoEmpleado"
                                                                                          accept="image/jpeg"
                                                                                          name="fotoEmpleado">
                                                                                  </div>


                                                                              </div>
                                                                          </div>
                                                                          <div
                                                                              class="imgEmpleadoView col-lg-5 col-12 mt-4">
                                                                          </div>
                                                                      </div>


                                                                  </div>




                                                                  <div class="col-12 col-lg-2 mt-3">
                                                                      <button type="submit"
                                                                          class="btn btn-outline-primary"
                                                                          id="btnCargarImgIdentificacion">Actualizar
                                                                          Imágenes</button>
                                                                  </div>
                                                                  <?php
																									  $imagenes = new controladorConsultaEmpleados();
																									  $imagenes->guardarImagenes();
																									?>
                                                              </form>
                                                          </div>




                                                      </div>



                                                      <div class="tab-pane fade" id="custom-tabs-Dropzone"
                                                          role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">




                                                          <!-- /.row -->
                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <div class="card card-default">
                                                                      <div class="card-header">
                                                                          <div id="actions" class="row">
                                                                              <div class="col-lg-6">
                                                                                  <div class="btn-group w-100">
                                                                                      <span
                                                                                          class="btn btn-success col fileinput-button">
                                                                                          <i class="fas fa-plus"></i>
                                                                                          <span>Cargar Archivos</span>
                                                                                      </span>
                                                                                      <button type="submit"
                                                                                          class="btn btn-primary col start">
                                                                                          <i class="fas fa-upload"></i>
                                                                                          <span>Iniciar Carga</span>
                                                                                      </button>
                                                                                      <button type="reset"
                                                                                          class="btn btn-warning col cancel">
                                                                                          <i
                                                                                              class="fas fa-times-circle"></i>
                                                                                          <span>Cancelar Carga</span>
                                                                                      </button>
                                                                                  </div>
                                                                              </div>
                                                                              <div
                                                                                  class="col-lg-6 d-flex align-items-center">
                                                                                  <div class="fileupload-process w-100">
                                                                                      <div id="total-progress"
                                                                                          class="progress progress-striped active"
                                                                                          role="progressbar"
                                                                                          aria-valuemin="0"
                                                                                          aria-valuemax="100"
                                                                                          aria-valuenow="0">
                                                                                          <div class="progress-bar progress-bar-success"
                                                                                              style="width:0%;"
                                                                                              data-dz-uploadprogress>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                          <div class="table table-striped files"
                                                                              id="previews">
                                                                              <div id="template" class="row mt-2">
                                                                                  <div class="col-auto">
                                                                                      <span class="preview"><img
                                                                                              src="data:," alt=""
                                                                                              data-dz-thumbnail /></span>
                                                                                  </div>
                                                                                  <div
                                                                                      class="col d-flex align-items-center">
                                                                                      <p class="mb-0">
                                                                                          <span class="lead"
                                                                                              data-dz-name></span>
                                                                                          (<span data-dz-size></span>)
                                                                                      </p>
                                                                                      <strong class="error text-danger"
                                                                                          data-dz-errormessage></strong>
                                                                                  </div>
                                                                                  <div
                                                                                      class="col-4 d-flex align-items-center">
                                                                                      <div class="progress progress-striped active w-100"
                                                                                          role="progressbar"
                                                                                          aria-valuemin="0"
                                                                                          aria-valuemax="100"
                                                                                          aria-valuenow="0">
                                                                                          <div class="progress-bar progress-bar-success"
                                                                                              style="width:0%;"
                                                                                              data-dz-uploadprogress>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div
                                                                                      class="col-auto d-flex align-items-center">
                                                                                      <div class="btn-group">
                                                                                          <button
                                                                                              class="btn btn-primary start">
                                                                                              <i
                                                                                                  class="fas fa-upload"></i>
                                                                                              <span>Cargar</span>
                                                                                          </button>
                                                                                          <button data-dz-remove
                                                                                              class="btn btn-warning cancel">
                                                                                              <i
                                                                                                  class="fas fa-times-circle"></i>
                                                                                              <span>Cancelar</span>
                                                                                          </button>
                                                                                          <button data-dz-remove
                                                                                              class="btn btn-danger delete">
                                                                                              <i
                                                                                                  class="fas fa-trash"></i>
                                                                                              <span>Eliminar</span>
                                                                                          </button>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="card-body">

                                                                          <div class="d-none d-sm-none d-md-block">
                                                                              <h1 id="titulo_h1">Documentos</h1>
                                                                              <table class="sortable ">
                                                                                  <thead>
                                                                                      <tr>
                                                                                          <th>Nombre Archivo</th>
                                                                                          <th>Tipo Archivo</th>
                                                                                          <th>Tamaño</th>
                                                                                          <th>Fecha Modificación</th>
                                                                                          <th>Acciones</th>
                                                                                      </tr>
                                                                                  </thead>
                                                                                  <tbody id="tbodyDocs">

                                                                                  </tbody>
                                                                              </table>

                                                                          </div>

                                                                      </div>
                                                                      <!-- /.card-body -->
                                                                      <div class="card-footer">

                                                                      </div>
                                                                  </div>
                                                                  <!-- /.card -->
                                                              </div>
                                                          </div>
                                                          <!-- /.row -->





                                                      </div>



                                                      <!--<div class="tab-pane fade" id="custom-tabs-tarjeta" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">


																						aqui va un tap 



                                                                                </div>-->

                                                  </div>
                                              </div>
                                              <!-- /.card -->
                                          </div>
                                      </div>



                                      <!-- </div> -->



                                      <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                                                    <button type="button" 
                                                                    class="btn btn-primary justify-content-end">Agregar</button>
                                                                </div> -->

                                  </div>

                              </div>

                          </div>

                      </div>




                      <!-- FIN DE LOS TAPS -->


                  </div>










              </div>
              <div class="modal-footer text-right">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                  <!-- <button type="button" class="btn btn-primary" id="btn-pagar">Pagar</button> -->
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>





  <style>
* {
    padding: 0;
    margin: 0;
}

/* body {
    color: #333;
    font: 14px Sans-Serif;
    padding: 50px;
    background: #eee;
} */

#titulo_h1 {
    text-align: center;
    padding: 20px 0 12px 0;
    margin: 0;
}

/* h2 {
    font-size: 16px;
    text-align: center;
    padding: 0 0 12px 0;
} */

#container {
    box-shadow: 0 5px 10px -5px rgba(0, 0, 0, 0.5);
    position: relative;
    background: white;
}

 table {
    background-color: #F3F3F3;
    border-collapse: collapse;
    width: 100%;
    margin: 15px 0;
} 
/* FE4902 */
 th {
    background-color: #0C9C9C; 
    color: #FFF;
    cursor: pointer;
    padding: 5px 10px;
} 

 th small {
    font-size: 9px;
} 

 td,
th {
    text-align: left;
} 

 a {
    text-decoration: none;
}

td a {
    color: #000000;
    display: block;
    padding: 5px 10px;
}

th a {
    padding-left: 0
} 

td:first-of-type a {
    background: url(views/img/file.png) no-repeat 10px 50%;
    padding-left: 35px;
}

th:first-of-type {
    padding-left: 35px;
}

td:not(:first-of-type) a {
    background-image: none !important;
}

tr:nth-of-type(odd) {
    background-color: #E6E6E6;
}

tr:hover td {
    background-color: #CACACA;
}

tr:hover td a {
    color: #000;
}





/* icons for file types (icons by famfamfam) */

/* images */
table tr td:first-of-type a[href$=".jpg"],
table tr td:first-of-type a[href$=".png"],
table tr td:first-of-type a[href$=".gif"],
table tr td:first-of-type a[href$=".svg"],
table tr td:first-of-type a[href$=".jpeg"] {
    background-image: url(views/img/image.png);
}

/* zips */
table tr td:first-of-type a[href$=".zip"] {
    background-image: url(views/img/zip.png);
}

/* css */
table tr td:first-of-type a[href$=".css"] {
    background-image: url(views/img/css.png);
}

/* docs */
table tr td:first-of-type a[href$=".doc"],
table tr td:first-of-type a[href$=".docx"],
table tr td:first-of-type a[href$=".ppt"],
table tr td:first-of-type a[href$=".pptx"],
table tr td:first-of-type a[href$=".pps"],
table tr td:first-of-type a[href$=".ppsx"],
table tr td:first-of-type a[href$=".xls"],
table tr td:first-of-type a[href$=".xlsx"] {
    background-image: url(views/img/office.png)
}

/* videos */
table tr td:first-of-type a[href$=".avi"],
table tr td:first-of-type a[href$=".wmv"],
table tr td:first-of-type a[href$=".mp4"],
table tr td:first-of-type a[href$=".mov"],
table tr td:first-of-type a[href$=".m4a"] {
    background-image: url(views/img/video.png);
}

/* audio */
table tr td:first-of-type a[href$=".mp3"],
table tr td:first-of-type a[href$=".ogg"],
table tr td:first-of-type a[href$=".aac"],
table tr td:first-of-type a[href$=".wma"] {
    background-image: url(views/img/audio.png);
}

/* web pages */
table tr td:first-of-type a[href$=".html"],
table tr td:first-of-type a[href$=".htm"],
table tr td:first-of-type a[href$=".xml"] {
    background-image: url(views/img/xml.png);
}

table tr td:first-of-type a[href$=".php"] {
    background-image: url(views/img/php.png);
}

table tr td:first-of-type a[href$=".js"] {
    background-image: url(views/img/script.png);
}

/* directories */
table tr.dir td:first-of-type a {
    background-image: url(views/img/folder.png);
}
  </style>