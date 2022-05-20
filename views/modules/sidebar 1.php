
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
  <img src="views/img/template/logo.png" alt="OTB Logo Large" class="brand-image-xs logo-xl" style="left: 60px;width:120px; height: 60px">
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
 -->  </div>



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
  
          if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){
   
if(strpos($_SESSION["privempresa"],'Tiendas')){

    echo'<li class="nav-item">
            <a href="reporte-tiendas" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                KPIS Tiendas
              </p>
            </a>
         </li> ';

          echo'<li class="nav-item">
            <a href="reporte-ventas-dth" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                KPIS DTH
              </p>
            </a>
         </li> ';

echo'<li class="nav-item">
                <a href="reporte-ventas-bodega" class="nav-link">
                <i class="fas fa-chart-pie nav-icon"></i>
                  <p>Evaluacion De Ruta</p>
                </a>
              </li>';

  /**  INICIO INVENTARIOS  **/
           echo'<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-boxes nav-icon"></i>
              <p>
                Inventarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
          
              <li class="nav-item">
                <a href="aceptacion-inventarios" class="nav-link">
                  <i class="nav-icon fas fa-bullhorn"></i>
                  <p>Aceptacion</p>
                </a>
              </li>
             
            </ul>
          </li>';

          /**  FIN INVENTARIOS  **/

/** INICIO PLANILLA MOVIL **/
    echo'   <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list size: 2x"></i>
              <p>
                Planilla Movil
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                  <p>
                    Colaboradores 
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="consulta-empleados" class="nav-link">
                    <i class="fas fa-search nav-icon"></i>
                      <p>Consulta</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../examples/register.html" class="nav-link">
                      <i class="fas fa-plus nav-icon"></i>
                      <p>Registro</p>
                    </a>
                  </li>
          
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="ad-personal" class="nav-link">
                  <i class="nav-icon fas fa-bullhorn"></i>
                  <p>AD Personal</p>
                </a>
              </li>
             
            </ul>
          </li>';
          /** FIN PLANILLA MOVIL **/





}


          /* INICIO SECCION REPORTES */
          echo'<li class="nav-item">

          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i> 
              <p>
                Reportes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
    
              
             <li class="nav-item">
                <a href="reporte-control-calidad" class="nav-link">
                  <i class="fas fa-file-invoice nav-icon"></i>
                  <p>Reporte Control De Calidad</p>
                </a>
              </li>
             
            </ul>
          </li>';
          /* FIN SECCION REPORTES */

if(strpos($_SESSION["privempresa"],'Facturacion')){

    echo'  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Facturación
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">


	<li class="nav-item">
            <a href="clientes" class="nav-link">
             <i class="nav-icon fas fa-user-tag"></i>
              <p>
                Clientes
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="inicio-facturacion" class="nav-link">
             <i class="nav-icon fas fa-user-tag"></i>
              <p>
               Dashboard Facturación
              </p>
            </a>
          </li>


            <li class="nav-item a">
            <a href="sistema-facturas-crearFactura" class="nav-link">
             <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
              <p>
               Crear Pedidos
              </p>
            </a>
          </li>



            <li class="nav-item a">
            <a href="sistema-facturas-facturacion" class="nav-link">
             <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
              <p>
               Facturar
              </p>
            </a>
          </li>

 
            <li class="nav-item">
            <a href="reporte-sistema-facturacion" class="nav-link">
             <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
              <p>
               Reporte Facturas
              </p>
            </a>
          </li>


  	<li class="nav-item">
            <a href="sistema-facturas-reporte-gastos" class="nav-link">
             <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
              <p>
               Reporte Gastos
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="sucursal-cajas-facturacion" class="nav-link">
             <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
              <p>
               Sucursales y Cajas
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="sistema-facturas-productos" class="nav-link">
             <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
              <p>
               Productos
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="sistema-facturas-clientes" class="nav-link">
             <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
              <p>
               Clientes
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="sistema-facturas-actividadEconomica" class="nav-link">
             <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
              <p>
               Actividad Economica
              </p>
            </a>
          </li>                        
            </ul>
          </li>';

}



      echo'<li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users-cog"></i>
        <p>
          Administrativo
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right"></span>
        </p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">

      <li class="nav-item">
      <a href="clientes" class="nav-link">
      <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
        <p>
          Clientes
        </p>
      </a>
      </li>

      <li class="nav-item">
      <a href="planes-categoria" class="nav-link">
      <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
        <p>
        Crear Planes
        </p>
      </a>
      </li>


      <li class="nav-item">
      <a href="planes-clientes" class="nav-link">
      <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
        <p>
        Planes Clientes
        </p>
      </a>
      </li>


      <li class="nav-item">
      <a href="creacion-usuarios-clientes" class="nav-link">
      <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
        <p>
        Gestión Usuarios
        </p>
      </a>
      </li>

      <li class="nav-item">
      <a href="recuperar-contrasena-frm1" class="nav-link">
      <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
        <p>
        Recuperar Contraseña
        </p>
      </a>
      </li>

        
      </ul>
      </li>';



}elseif($_SESSION["rol"]=="Supervisor-Tiendas"){

   
if(strpos($_SESSION["privempresa"],'Tiendas')){

    echo'<li class="nav-item">
            <a href="reporte-tiendas" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                KPIS Tiendas
              </p>
            </a>
          </li>'  ;

/**  INICIO INVENTARIOS  **/
           echo'<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-boxes nav-icon"></i>
              <p>
                Inventarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
    
              
              <li class="nav-item">
                <a href="aceptacion-inventarios" class="nav-link">
                  <i class="nav-icon fas fa-bullhorn"></i>
                  <p>Aceptacion</p>
                </a>
              </li>
             
            </ul>
          </li>';

          /**  FIN INVENTARIOS  **/

/** INICIO PLANILLA MOVIL **/
    echo'          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list size: 2x"></i>
              <p>
                Planilla Movil
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                  <p>
                    Colaboradores 
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="consulta-empleados" class="nav-link">
                    <i class="fas fa-search nav-icon"></i>
                      <p>Consulta </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../examples/register.html" class="nav-link">
                      <i class="fas fa-plus nav-icon"></i>
                      <p>Registro</p>
                    </a>
                  </li>
          
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="ad-personal" class="nav-link">
                  <i class="nav-icon fas fa-bullhorn"></i>
                  <p>AD Personal</p>
                </a>
              </li>
             
            </ul>
          </li>';
          /** FIN PLANILLA MOVIL **/

}

}elseif($_SESSION["rol"]=="Supervisor-DTH"){

   
if(strpos($_SESSION["privempresa"],'Tiendas')){

      echo'<li class="nav-item">
            <a href="reporte-ventas-dth" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                KPIS DTH
              </p>
            </a>
         </li> ';

/** INICIO PLANILLA MOVIL **/
    echo'          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list size: 2x"></i>
              <p>
                Planilla Movil
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                  <p>
                    Colaboradores 
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="consulta-empleados" class="nav-link">
                    <i class="fas fa-search nav-icon"></i>
                      <p>Consulta </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../examples/register.html" class="nav-link">
                      <i class="fas fa-plus nav-icon"></i>
                      <p>Registro</p>
                    </a>
                  </li>
          
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="ad-personal" class="nav-link">
                  <i class="nav-icon fas fa-bullhorn"></i>
                  <p>AD Personal</p>
                </a>
              </li>
             
            </ul>
          </li>';
          /** FIN PLANILLA MOVIL **/

}

}elseif($_SESSION["rol"]=="Invitado"){


  // if(!isset($_SESSION["privempresa"]) || $_SESSION["privempresa"] == "" || $_SESSION["privempresa"] == "null"){
  
        echo'<li class="nav-item">
              <a href="clientes" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                  Registro Empresa
                </p>
              </a>
           </li> ';
  
  // }
  
  }


 

         


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
 -->    </div>
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
                  <img class="profile-user-img img-fluid img-circle"
                       src=""
                       alt="User profile picture"
                       id="imageResult">
                </div>

                <br>
                <br>
                <input id="currentPicture" name="currentPicture"  type="hidden" value="">
                <input id="username_perfil_edit"  name="username_perfil_edit" type="hidden" <?php  echo 'value="' .    $_SESSION["user_name"] . '"';  ?>>



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
                <input id="upload-profile-pic" name="upload-profile-pic" type="file" onchange="readURL(this);" class="form-control border-0">
                <label id="upload-label" for="upload-profile-pic" class="font-weight-light text-muted">Escojer archivo</label>
                <div class="input-group-append">
                    <label for="upload-profile-pic" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Escojer archivo</small></label>
                </div>
            </div>

     <br>
                <br>
                 <!-- Upload image input-->
       

                     <div class="form-group row">
                        <label for="name_perfil" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input type="text"   autocomplete="off"class="form-control" value="" id="name_perfil" required name="name_perfil" placeholder="Nombre">                          
                        </div>
                      </div>



                             <div class="input-group row">
           <label for="username_perfil" class="col-sm-3 col-form-label">Contraseña</label>

           <?php  echo '<input type="password"  autocomplete="off" class="form-control pwd" value="'.    $_SESSION["pass_perfil"] . '" id="pass_perfil" required name="pass_perfil" placeholder="Contraseña">';    ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span id="lockbtn"class="fas fa-eye reveal"></span>
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
              <button type="submit" class="btn btn-primary" >Guardar</button>
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
