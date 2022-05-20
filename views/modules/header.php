    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item togglesidebar" id="togglesidebar">
        <a class="nav-link"  data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <!-- <a href="home" class="nav-link">Home</a> -->
      </li>
   <!--    <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

     <!-- SEARCH FORM -->
 
 

  

<?php  
$idUsuario = $_SESSION["id"];
$empresas = ReporteFacturasController::ctrCargarEmpresasUsuarios($idUsuario);

if(isset($_SESSION["empresa"])){

echo  '<div class="col-xs-12 col-lg-4 float-right">                  
                        <div class="input-group" style=" width: 100%;">
                          <div class="input-group-prepend">
                            <span style="font-size:15px;height: 30px"  class="input-group-text "><i class="fa fa-bars"></i></span>
                            </div>
                            <select style="font-size:13px;height: 30px" class="custom-select  empresaheader float-right " id="empresaheader" name="empresaheader" required>
                            
                               <option selected disabled value=""  >Seleccionar Empresa</option>';                   

                                                                                      
                                /*<option value="'.$_SESSION["empresa"].'" selected disabled>'.$_SESSION["NomEmpresa"].'</option>';*/
                                        
                              foreach ($empresas as $key => $value):
                  
                               echo "<option value='".$value['id_empresa']."' subM='".$value['modulos']."'>".$value['Nombre']."</option>";
                
                               endforeach ;

                           echo '</select>'; 
                        echo '</div>';
              echo '</div>';

}else{ ?>

<div class="col-xs-12 col-lg-4 float-right">                   
                        <div class="input-group" style=" width: 100%;">
                          <div class="input-group-prepend">
                            <span style="font-size:15px;height: 30px"  class="input-group-text "><i class="fa fa-bars"></i></span>
                            </div>
                            <select style="font-size:13px;height: 30px" class="custom-select  empresaheader float-right " id="empresaheader" name="empresaheader" required>
                              <option selected disabled value=""  >Seleccionar Empresa</option>                    
                              <?php foreach ($empresas as $key => $value): ?>
                  
                                <option value="<?php echo $value["id_empresa"];?>" subM='<?php echo $value["modulos"];?>'><?php echo $value["Nombre"];?></option>
                
                              <?php endforeach ?>
                            </select> 
                        </div>
              </div>


<?php } ?>
<!-- <div class="row"> -->


<?php 

$PlanesCliente = sidebarController::ctrCargarPlanesClientes($_SESSION["empresa"]);

$IdPaquete = $PlanesCliente[0]["idPlan"];
$cantDocumentos = $PlanesCliente[0]["cantDocumentos"];
$nombrePaquete = $PlanesCliente[0]["nombrePlan"];
$fechaCreacion = date("Y-m-d", strtotime($PlanesCliente[0]["fechaCreacion"]));
$fechaFin = date("Y-m-d", strtotime($PlanesCliente[0]["fecha_fin"]));
$Planes = sidebarController::ctrCargarPlanesid($IdPaquete);
// echo '<pre>'; print_r($Planes[0]["modulos"]); echo '</pre>';

if(strripos($Planes[0]["modulos"], "Facturacion")){

$CantFacturas = sidebarController::ctrCargarCantFacturas($_SESSION["empresa"], $fechaCreacion, $fechaFin);
$facturasRealizadas = $CantFacturas[0]["cantFact"];

}

if($cantDocumentos == "0"){
  // $cantDocumentos = '<i class="fas fa-infinity"></i>';
  $cantDocumentos = 'ilimitado';
}

?>

<?php if(strripos($Planes[0]["modulos"], "Facturacion")){ ?>
  <div class=" col-7 d-none d-md-block d-lg-none d-lg-block d-xl-none d-xl-block">
    <div class="float-right">
      <a href="#" class="dropdown-item">
        <div class="media">
          <div class="media-body">
            <h3 class="dropdown-item-title">
            <?php  echo $nombrePaquete; ?>
            <span class="float-right text-sm text-danger"><i class="fas fa-file"></i></span>
            </h3>
            <p class="text-sm"><?php  echo 'Paquete: '.$cantDocumentos.' / '.'Realizadas: '.$facturasRealizadas; ?> <br> <?php  echo 'Vencimiento: '.$fechaFin; ?></p>            
            <!-- <p class="text-sm text-muted"><?php  echo 'Vence: '.$fechaFin; ?></p>  -->
          </div>
        </div>
      </a>
    </div> 
  </div>
  <?php } ?>
<!-- </div> -->


    <!-- Right navbar links -->
    <!--<ul class="navbar-nav ml-auto">
       Messages Dropdown Menu 
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        </div>
      </li>-->

      <!-- Notifications Dropdown Menu -->
     <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
           <a href="#" class="dropdown-item">
            <div class="media">
               <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> 
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Plan Contratado
                  <span class="float-right text-sm text-danger"><i class="fas fa-file"></i></span>
                </h3>
                <p class="text-sm">Paquete: 10 / realizadas: 20</p>
                 <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p> 
              </div>
            </div>
          </a> 
        </div>
      </li>-->

      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> -->

    </ul>
  </nav>
  <!-- /.navbar