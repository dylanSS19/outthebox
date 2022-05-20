<?php 

$clientes = FacturacionController::ctrCargarClientes($_SESSION['empresa']);
 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Fotos Productos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Fotos Productos</li>
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

                            <button class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#modalFotosMercado">

                                Agregar Fotos

                            </button>



                            <!-- <button type="button" class="btn btn-default float-right" id="daterange-btn-SistemaFacturas" >
                  <span>
                    
                    <i class="fa fa-calendar"></i> Rango de Fecha

                  </span>

                   <i class="fa fa-caret-down"></i>
                     
                </button> -->

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-sm-12">

                                    <table class="table table-bordered table-striped dt-responsive "
                                        id="tablaMercadoFotos" width="100%">

                                        <thead>

                                            <tr>

                                                <th style="width:5px">#</th>
                                                <th>Acciones</th>
                                                <th>Nombre</th>
                                                <th>Tipo Cédula</th>
                                                <th>Cédula</th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                        </tbody>

                                    </table>

                                </div>


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



<div class="modal" id="modalFotosMercado" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Ingresar Fotos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                    <div class="col-xs-12 col-lg-12">
                            <label>&nbsp;&nbspClientes</label>
                            <div class="input-group " style=" width: 100%;">
                                <div class="input-group-prepend">
                                    <span style="font-size:15px; height: 35px;" class="input-group-text"><i
                                            class="fas fa-edit"></i></span>
                                </div>
                                <select class="custom-select" id="MercFotosCliente" style="font-size:15px; height: 35px;"
                                        aria-hidden="true" data-placeholder="Seleccionar Cliente">
                                        <!-- <option selected disabled value="">Tipo de Pago</option> -->
                                        <?php foreach ($clientes as $key => $value): ?>

                                        <option value="<?php echo $value["idtbl_empresas_clientes"];?>">
                                            <?php echo $value["Nombre"];?></option>

                                        <?php endforeach ?>
                                    </select>
                            </div>
                        </div>

                        <!-- <div class="col-lg-12 "> -->
                        <!-- <div class="col-xs-12 col-lg-6">
                                
                                <div class="input-group mb-6 mt-2" style=" width: 100%;">

                                    <img src="views/img/users/default/anonymous.png" class="img-thumbnail" width = "400px"
                                        id="fotoDisplay_vista" idDiv="1" width="100px">

                                    <input type="file" class="fotoDisplay" id="fotoDisplay" idDiv="1"
                                        name="fotoDisplay">

                                    <p class="help-block">Peso máximo de la foto 4MB</p>

                                </div>
                            </div> -->
                        <!-- </div> -->


                        <div class="contFotos"></div>
                        <div id="wrapper">
                            <h1 class="subirImg">Subir Imágenes</h1>
                            <div id="container-input">
                                <div class="wrap-file">
                                    <div class="content-icon-camera">
                                        <input type="file" id="file" name="file[]" accept="image/*" multiple />
                                        <div class="icon-camera" style="text-align: center;"><span  class="input-group-text"><i class="fas fa-camera"></i></span></div>
                                    </div>
                                    <div id="preview-images">

                                    </div>
                                </div>
                                <button id="publish" hidden>Publicar</button>
                            </div>
                            <div class="preload">
                                <!-- <img src="assets/images/preload.gif" alt="preload" /> -->
                            </div>
                            <h2 id="success"></h2>
                        </div>

                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarClienteMerc" hidden>Guardar</button>

                </div>

            </form>
        </div>
    </div>
</div>



<style>
img {
	border: none;
}

.subirImg {
	margin: 0;
	padding: 0;
}

#wrapper {
	width: 100%;
}

.subirImg {
	padding: 50px 0;
	text-align: center;
}

h2 {
	color: green;
}

.preload {
	padding-top: 20px;
	text-align: center;
	display: none;
}

.activate-preload {
	display: block;
}

#container-input {
	width: 640px;
	margin: 0 auto;
	border: solid 1px #CCC;
	position: relative;
	overflow: hidden;
}

#container-input .wrap-file .content-icon-camera {
	width: 50px;
	overflow: hidden;
    text-align: center;
}

#container-input .wrap-file .content-icon-camera:hover {
	background-color: #e6e6e6;
}

#container-input .wrap-file .content-icon-camera .icon-camera {
	width: 36px;
	height: 36px;
	/* background: url('images/camera.png') no-repeat; */
	cursor: pointer;
	position: absolute;
	top: 8px;
	left: 8px;
}

#container-input .wrap-file .content-icon-camera #file {
	padding: 15px;
	opacity: 0;
	position: relative;
	cursor: pointer;
	left: -120px;
	z-index: 1;
}

#container-input .wrap-file #preview-images .thumbnail {
	width: 150px;
	height: 150px;
	display: inline-block;
	vertical-align: middle;
	border: solid 2px #CCC;
	background-size: cover;
	position: relative;
}

#container-input .wrap-file #preview-images .thumbnail:not(:last-child) {
	margin-right: 5px;
}

#container-input .wrap-file #preview-images .thumbnail .close-button {
	width: 20px;
	height: 20px;
	background-color: #EFEBEB;
	color: black;
	text-align: center;
	position: absolute;
	top: 5px;
	right: 5px;
	border-radius: 100px;
	cursor: pointer;
}

#container-input #publish {
	padding: 15px 35px;
	font-size: 1.1em;
	float: right;
	border: none;
	cursor: pointer;
	background-color: #8ECA67;
	color: #FFF;
}

#container-input #publish:hover {
	background-color: #6EAD45;
}

</style>