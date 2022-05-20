<?php 

if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){

    $usuario = "%";
  
  }else{
  
    $usuario = $_SESSION["id"];
  
  }
  
  $ID_empresa = $_COOKIE['cookie_empresa'];
  
  $Rutas = CrearFactController::ctrCargarRutas($usuario, $ID_empresa);
  

?>
 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Rutas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">

            
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-outline card-dark ">
                        <div class="card-header">
            
                        <div class="row">
                        <?php if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){?> 
                                                   
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <!-- <label>&nbsp;&nbspRuta:</label> -->
                                <div class="input-group" style=" width: 100%;">
                                    <div class="input-group-prepend">
                                        <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                class="fas fa-truck"></i></span>
                                    </div>
                                    <select style="font-size:15px;height: 35px" class="custom-select " id="frmRutasRuta"
                                        name="frmRutasRuta" >
                                        <option selected disabled value="">Seleccionar Ruta</option>
                                        <?php foreach ($Rutas as $key => $value): ?>

                                        <option value="<?php echo $value["idtbl_rutas"];?>" Valcoord="<?php echo $value["valida_coordenadas"];?>">
                                            <?php echo $value["nombre"];?>
                                        </option>

                                        <?php endforeach ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <!-- <label>&nbsp;&nbspRuta:</label> -->
                                <div class="input-group" style=" width: 100%;">
                                    <div class="input-group-prepend">
                                        <span style="font-size:15px;height: 35px" class="input-group-text"><i
                                                class="fas fa-calendar-day"></i></span>
                                    </div>
                                    <select style="font-size:15px;height: 35px" class="custom-select " id="frmRutasDias"
                                        name="frmRutasDias" >
                                        <option  value="">Seleccionar Día</option>
                                        <option  value="L">Lunes</option>
                                        <option  value="K">Martes</option>
                                        <option  value="M">Miercoles</option>
                                        <option  value="J">Jueves</option>
                                        <option  value="V">Viernes</option>
                                        <option  value="S">Sabado</option>
                                        <option  value="D">Domingo</option>

                                    </select>
                                </div>
                            </div>
                            
                                                                 
                            <?php }else{ ?> <?php } ?>
                        

                        </div>
                           

                    <!-- <input type="text" style="font-size:15px;" class="form-control"
                    id="frmRutaNomUsuario" name="frmRutaNomUsuario" 
                    autocomplete="off"  placeholder="" hidden> -->

                        </div>

                        <div class="card-body">

                            <div class="addclientes">




                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>


    </div>


</div>