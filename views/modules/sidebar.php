<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <!--     <a href="home" class="brand-link">
      <img src="views/img/template/logoupee-header.png"  alt="Claro Upee!" class="brand-image " style="opacity: 1">
      <span class="brand-text font-weight-light">Para servirle!</span>
    </a> -->

    <!--        <div class="sidebarlogo">  
          <img src="views/img/template/logoupee2.png"  alt="Claro Upee!" class="brand-image rounded mx-auto d-block" style="width:170px; height: 80px ">
      </div> -->


    <a href="#" class="brand-link logo-switch">
        <img src="views/img/template/icon.png" alt="OTB Logo Small" class="brand-image-xl logo-xs">
        <img src="views/img/template/logo.png" alt="OTB Logo Large" class="brand-image-xs logo-xl"
            style="left: 60px;width:120px; height: 60px">
    </a>
 
 
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php 
          echo '<img id="profilePic" src="" class="img-circle elevation-2" alt="User Image">';
          ?>
            </div>
            <div class="info">
                <!--           <?php  echo '<a href="#modal-perfil" class="d-block">' .   $_SESSION["user_name"] . ' </a>'; ?>
 -->
                <?php  


                if(!$_SESSION["nombre_perfil"]){

                header("Location: logout");
                }

      
          ?>


                <span id="userProfile">Perfil</span>
                <br>
                <span style="cursor: pointer" id="badgeperfil" class="badge badge-secondary badgeperfil">Perfil</span>

                <!-- data-toggle="modal" data-target="#modal-perfil"
 -->
            </div>



        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-header">MENU</li>
                <li class="nav-item">
                    <a href="home" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>

                <?php 
  
// if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){
  
// }elseif($_SESSION["rol"]=="Supervisor-Tiendas"){

// }elseif($_SESSION["rol"]=="Supervisor-DTH"){
 
// }elseif($_SESSION["rol"]=="Invitado"){

// }

$RolUsuario = sidebarController::ctrCargarRolUsuario($_SESSION["id"]);
$_SESSION["rol"] = $RolUsuario[0]["privilegios"];
echo '<script> sessionStorage.setItem("rol", "' . $_SESSION['rol'] . '");</script>';

if(!isset($_SESSION["empresa"]) || $RolUsuario[0]["privilegios"] == "Invitado"){

    echo "<script>
    var Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 10000
   });
 
     Toast.fire({
         icon: 'error',
         title: 'Seleccione o cree una empresa, para obtener el maximo provecho del sistema.'
       })
       </script>";

}else{

// $SubmodulosUsuario = sidebarController::ctrCargarSubmodulosUser($_SESSION["id"], $_SESSION["empresa"]);
// $_SESSION["subModulos"] = $SubmodulosUsuario[0]["modulos"];

// $modulosCliente = sidebarController::ctrCargarModulosCliente($_SESSION["empresa"]);
// $_SESSION["privempresa"] = $modulosCliente[0]["privilegio"];
    // echo '<pre>'; print_r($_SESSION["privempresa"]); echo '</pre>';

}



if($_SESSION["subModulos"] == "[]"){

   echo "<script>
   var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });

    Toast.fire({
        icon: 'error',
        title: 'Usuario sin permisos asignados, consulte al administrador.'
      })
      </script>";


}else{

    // echo '<pre>'; print_r($_SESSION["rol"]); echo '</pre>';



if($_SESSION["rol"]=="Invitado"){

    $modulos = sidebarController::ctrCargarModulos();

    // echo '<pre>'; print_r($modulos); echo '</pre>';

        $modulosEmpresas = '["Invitado"]';
             
        $modulosEmpresas = str_replace ( '"' , '' ,$modulosEmpresas);
        $modulosEmpresas = str_replace ( '[' , '' ,$modulosEmpresas);
        $modulosEmpresas = str_replace ( ']' , '' ,$modulosEmpresas);
        $modulosEmpresas = explode(',', $modulosEmpresas);
           
    // echo '<pre>'; print_r($modulosEmpresas); echo '</pre>';

}else{

    $modulos = sidebarController::ctrCargarModulos();

    $modulosEmpresas = json_decode($_SESSION["privempresa"]);

      
    $modulosEmpresas = str_replace ( '"' , '' ,$modulosEmpresas);
    $modulosEmpresas = str_replace ( '[' , '' ,$modulosEmpresas);
    $modulosEmpresas = str_replace ( ']' , '' ,$modulosEmpresas);
    $modulosEmpresas = explode(',', $modulosEmpresas);
    
}
           
          for ($i=0; $i < count($modulos); $i++) { 
                
            foreach ($modulosEmpresas as $key => $value) {
        
                // echo '<pre>'; print_r($value); echo '</pre>';
                // echo '<pre>'; print_r($modulos[$i]["nombre"]); echo '</pre>';

              if($value == $modulos[$i]["nombre"]){
        
               
                echo'  <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon '.$modulos[$i]["icono"].'"></i>
                  <p>
                  '.$modulos[$i]["nombreFront"].'
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">';
        
                if($_SESSION["rol"]=="Invitado"){

                    $idMod = $modulos[$i]["idtbl_modulos_outthebox"];
                    $usuario = $_SESSION["id"];

                    $Submodulos = sidebarController::ctrCargarSubModulos($idMod);

                    $Usuariosmodulos = sidebarController::ctrUsuariosInvitadosModulos($usuario);

                // echo '<pre>'; print_r($Usuariosmodulos); echo '</pre>';

                    $Usuariosmodulos = str_replace ( '"' , '' ,$Usuariosmodulos[0]["modulos"]);
                    $Usuariosmodulos = str_replace ( '[' , '' ,$Usuariosmodulos);
                    $Usuariosmodulos = str_replace ( ']' , '' ,$Usuariosmodulos);
                    $Usuariosmodulos = explode(',', $Usuariosmodulos);


                }else{

                $idMod = $modulos[$i]["idtbl_modulos_outthebox"];
                $usuario = $_SESSION["id"];
                $empresa = $_SESSION["empresa"];
                $Submodulos = sidebarController::ctrCargarSubModulos($idMod);
                $Usuariosmodulos = sidebarController::ctrUsuariosModulos($usuario, $empresa);

                // echo '<pre>'; print_r($Submodulos); echo '</pre>';

                // echo '<pre>'; print_r($Usuariosmodulos); echo '</pre>';

                                   
                $Usuariosmodulos = str_replace ( '"' , '' ,$Usuariosmodulos[0]["modulos"]);
                $Usuariosmodulos = str_replace ( '[' , '' ,$Usuariosmodulos);
                $Usuariosmodulos = str_replace ( ']' , '' ,$Usuariosmodulos);
                $Usuariosmodulos = explode(',', $Usuariosmodulos);
              }
                foreach ($Submodulos as $key => $value) {
                 
                    foreach ($Usuariosmodulos as $key => $subUsuarios) {
        
                    if($value["idtbl_subModulos_outthebox"] == $subUsuarios){
                    
        
                    if($value["tipoRama"] == "Multiple"){
        
                        $SubNibeles = sidebarController::ctrCargarSubModulos($value["idtbl_subModulos_outthebox"]);
        
                        echo'<li class="nav-item">
                        <a href="'.$value["nombreArchivo"].'" class="nav-link" >
                          <i class="fas fa-boxes nav-icon"></i>
                          <p>
                          '.$value["nombre"].'
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">';
                      
                        foreach ($SubNibeles as $key => $subN1) {
        
                            // $etiquetas =   str_replace ( "'" , '' ,$subN1["etiquetahtml"]);
                            // echo $etiquetas;
                            if($subN1["tipoRama"] == "Multiple"){
        
                                $SubNibeles2 = sidebarController::ctrCargarSubModulos($subN1["idtbl_subModulos_outthebox"]);
                     
                                echo'<li class="nav-item">
                                <a href="'.$subN1["nombreArchivo"].'" class="nav-link">
                                  <i class="fas fa-boxes nav-icon"></i>
                                  <p>
                                  '.$subN1["nombre"].'
                                    <i class="fas fa-angle-left right"></i>
                                  </p>
                                </a>
                                <ul class="nav nav-treeview">';
                              
                                foreach ($SubNibeles2 as $key => $subN2) {
                
                                    $etiquetas =   str_replace ( "'" , '' ,$subN2["etiquetahtml"]);
                                    echo $etiquetas;
                
                                }
                                 
                                echo'</ul>
                              </li>';
                
                    
                            }else{
                
                                $etiquetas =   str_replace ( "'" , '' ,$subN1["etiquetahtml"]);
                                echo $etiquetas;
                
                            }
        
                        }
                         
                        echo'</ul>
                      </li>';
        
                        
                    }else{
        
                        $etiquetas =   str_replace ( "'" , '' ,$value["etiquetahtml"]);
                        echo $etiquetas;
        
                    }
            
                       
                    }
                  
                  }
                
                }
                
                echo '</ul>
              </li>';
        
          
              }
        
        
            }
            
          }
    }
// if(strpos($_SESSION["privempresa"],'nada')){



// }else if(strpos($_SESSION["privempresa"],'Facturacion')){

//   include "modulos-sidebar/Facturacion/sideber-facturacion.php";

// }elseif(strpos($_SESSION["privempresa"],'Planilla')){




// }elseif(strpos($_SESSION["privempresa"],'Todo')){





// }






         


?>





            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
        <!--  <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a> -->
        <a href="logout" class="btn btn-secondary hide-on-collapse pos-left">Salir</a>
        <!--       <a href="logout" class="btn btn-secondary hide-on-collapse pos-right">Salir</a>
 -->
    </div>
    <!-- /.sidebar-custom -->
</aside>

<style>
#upload-profile-pic {
    opacity: 0;
}

#upload-label {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
}

.image-area {
    border: 2px dashed rgba(255, 255, 255, 0.7);
    padding: 1rem;
    position: relative;
}

.image-area::before {
    content: 'Uploaded image result';
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.8rem;
    z-index: 1;
}

.image-area img {
    z-index: 2;
    position: relative;
}
</style>



<div class="modal fade cleanmodal" id="modal-perfil">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">


            <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <h4 style="text-align: center;" class="modal-title">Perfil</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">






                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="" alt="User profile picture"
                                    id="imageResult">
                            </div>

                            <br>
                            <br>
                            <input id="currentPicture" name="currentPicture" type="hidden" value="">
                            <input id="username_perfil_edit" name="username_perfil_edit" type="hidden"
                                <?php  echo 'value="' .    $_SESSION["user_name"] . '"';  ?>>



                            <!-- Upload image input-->
                            <!--   <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                <input id="upload-profile-pic" name="upload-profile-pic" type="file" onchange="readURL(this);" class="form-control border-0">
                <label id="upload-label" for="upload" class="font-weight-light text-muted">Escojer archivo</label>
                <div class="input-group-append">
                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Escojer archivo</small></label>
                </div>
            </div>
 -->

                            <!-- Upload image input-->
                            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                <input id="upload-profile-pic" name="upload-profile-pic" type="file"
                                    onchange="readURL(this);" class="form-control border-0">
                                <label id="upload-label" for="upload-profile-pic"
                                    class="font-weight-light text-muted">Escojer archivo</label>
                                <div class="input-group-append">
                                    <label for="upload-profile-pic" class="btn btn-light m-0 rounded-pill px-4"> <i
                                            class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                            class="text-uppercase font-weight-bold text-muted">Escojer
                                            archivo</small></label>
                                </div>
                            </div>

                            <br>
                            <br>
                            <!-- Upload image input-->


                            <div class="form-group row">
                                <label for="name_perfil" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" autocomplete="off" class="form-control" value="" id="name_perfil"
                                        required name="name_perfil" placeholder="Nombre">
                                </div>
                            </div>



                            <div class="input-group row">
                                <label for="username_perfil" class="col-sm-3 col-form-label">Contraseña</label>

                                <?php  echo '<input type="password"  autocomplete="off" class="form-control pwd" value="'.    $_SESSION["pass_perfil"] . '" id="pass_perfil" required name="pass_perfil" placeholder="Contraseña">';    ?>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span id="lockbtn" class="fas fa-eye reveal"></span>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!--    <div class="input-group-append">
            <div class="input-group-text">
              <span id="lockbtn"class="fas fa-eye reveal"></span>
            
          </div>
           </div>   -->


                </div>



                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>

            <?php 

      $createCliente = new UserController();

      $createCliente -> ctrActualizarPerfil();

      ?>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>