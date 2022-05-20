<?php


session_start();

header('Access-Control-Allow-Origin: *');
?>


<!DOCTYPE html>


<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
<meta http-equiv=”Pragma” content=”no-cache”>
<meta http-equiv=”Expires” content=”-1″>
<meta http-equiv=”CACHE-CONTROL” content=”NO-CACHE”>

  <title>OUT THE BOX CR</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="views/img/template/icon.png">


  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '543681613364049',
      xfbml      : true,
      version    : 'v12.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<?php




 if(isset($_SESSION["login"]) && $_SESSION["login"] == "ok" || strripos($_SERVER['REQUEST_URI'], "login") || strripos($_SERVER['REQUEST_URI'], "registro") || strripos($_SERVER['REQUEST_URI'], "recuperar-contrasena-frm1") || strripos($_SERVER['REQUEST_URI'], "recuperar-contrasena-frm2") || strripos($_SERVER['REQUEST_URI'], "machoteFactura")){?>




<!--=====================================
=            PLUGING CSS            =
======================================-->

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="views/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

     <!-- overlayScrollbars -->
  <link rel="stylesheet" href="views/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">


    <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/adminlte.min.css">

    <!-- Font Awesome -->
  <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->

  <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- daterange picker -->
  <link rel="stylesheet" href="views/plugins/daterangepicker/daterangepicker.css">

    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="views/plugins/iCheck/skins/minimal/_all.css">




    <!-- Select2 -->
  <link rel="stylesheet" href="views/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="views/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Morris chart -->
  <link rel="stylesheet" href="views/plugins/morris.js/morris.css">


  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="views/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">



      <!-- SHAKE -->
  <link rel="stylesheet" href="views/plugins/Shake/shake.css">




<!-- jQuery -->
<script src="views/plugins/jquery/jquery.min.js"></script>


 <script src="views/plugins/jquery-ui/jquery-ui.min.js"></script> 


<!-- SweetAlert2 -->
<script src="views/plugins/sweetalert2/sweetalert2.min.js"></script>


<!-- InputMask -->
<script src="views/plugins/moment/moment.min.js"></script>
<script src="views/plugins/inputmask/jquery.inputmask.min.js"></script>

 <!-- Tempusdominus Bootstrap 4 -->
<script src="views/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>




<!-- Bootstrap 4 -->
<script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- overlayScrollbars -->
<script src="views/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- AdminLTE App -->
<script src="views/dist/js/adminlte.min.js"></script>

<!-- FastClick -->
 <script src="views/plugins/fastclick/fastclick.js"></script> 

 <!-- ChartJS -->
<script src="views/plugins/chart.js/Chart.min.js"></script>

<!-- DataTables  & Plugins -->

<!-- DataTables  & Plugins -->
<script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="views/plugins/jszip/jszip.min.js"></script>
<script src="views/plugins/pdfmake/pdfmake.min.js"></script>
<script src="views/plugins/pdfmake/vfs_fonts.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- Select2 -->
<script src="views/plugins/select2/js/select2.full.min.js"></script>



<!-- date-range-picker -->
<script src="views/plugins/daterangepicker/daterangepicker.js"></script>



    <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="views/plugins/raphael/raphael.min.js"></script>
  <script src="views/plugins/morris.js/morris.min.js"></script>


<!-- bs-custom-file-input -->
<script src="views/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

  <!-- Ionicons -->
  <link rel="stylesheet" href="views/plugins/Ionicons/css/ionicons.min.css">


<!-- iCheck 1.0.1 -->
<script src="views/plugins/iCheck/icheck.min.js"></script>

   <!-- BS Stepper -->
   <script src="views/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<link rel="stylesheet" href="views/plugins/bs-stepper/css/bs-stepper.min.css">


<!-- overlayScrollbars -->
<script src="views/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>


  <!-- dropzonejs -->
  <link rel="stylesheet" href="views/plugins/dropzone/min/dropzone.min.css">
  <script src="views/plugins/dropzone/min/dropzone.min.js"></script>

<!-- GENERAR ARCHIVOS ZIP -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip-utils/0.1.0/jszip-utils.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>

<script src="extensions/jszip-master/dist/jszip.js" ></script> 


<script src="extensions/jszip-utils-master/dist/jszip-utils.js"></script>

<!-- <script src="views/plugins/push.js-master/push.js-master/bin/push.min.js"></script> -->


<script src="views/plugins/jquery-knob/jquery.knob.min.js"></script>
 
<script src="views/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- <script lang="javascript" src="dist/xlsx.full.min.js"></script> -->

<!-- Leer .CSV -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
<script src="views/plugins/PapaParse/papaparse.min.js"></script>


<script src="extensions/Face_Recognition/dist/face-api.js"></script>


 <?php }else{ ?>
  



  <?php } ?>


</head>

<!--=====================================
=            BODY DOCUMENT            =
======================================-->

<!-- <body class="hold-transition skin-black-light sidebar-collapse login-page"> -->


<?php


// echo '<pre>'; print_r($_SESSION["login"]); echo '</pre>';


  if(isset($_SESSION["login"]) && $_SESSION["login"] == "ok"){

   echo '<body class="hold-transition sidebar-mini layout-fixed">';


}else{

   echo '<body class="hold-transition sidebar-mini layout-fixed login-page" >';

};


                    
  if(isset($_SESSION["login"]) && $_SESSION["login"] == "ok"){



echo '<div class="wrapper">


<a id="whatsappbtn" class="float">
<i class="fab fa-whatsapp fa-3x my-float"></i>
</a>

<style>

.float{
  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#0C9;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  box-shadow: 2px 2px 3px #999;
  z-index : 1
}

.my-float{
  margin-top:7px;
}

</style>';


echo '<style>

#myBtn {
  display: none;
  position: fixed;
  bottom: 110px;
  right: 30px;
  z-index: 99;
  font-size: 16px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 8px;
  border-radius: 4px;
 height:40px; 
 width:40px;

}

#myBtn:hover {
  background-color: #555;
}
</style>

<div id="overlay2" style="display:none;">
                  <div class="spinner"></div>
                  <br/>
                  <h1>Cargando ...</h1> 
              </div>


<style type="text/css">
  
  #overlay2 {
  background: #ffffff;
  color: #666666;
  position: fixed;
  height: 100%;
  width: 100%;
  z-index: 5000;
  top: 0;
  left: 0;
  float: left;
  text-align: center;
  padding-top: 25%;
  opacity: .80;
}

.spinner {
    margin: 0 auto;
    height: 64px;
    width: 64px;
    animation: rotate 0.8s infinite linear;
    border: 5px solid firebrick;
    border-right-color: transparent;
    border-radius: 50%;
}
@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}



</style>


<button  onclick="topFunction()" id="myBtn" title="Go to top"> <i class="fas fa-chevron-up"></i></button>

<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
';
/*=============================================
=               HEADER           =
=============================================*/

include "modules/header.php";

/*=============================================
=               SIDEBAR           =
=============================================*/

include "modules/sidebar.php";

/*=============================================
=               CONTENT           =
=============================================*/

    if($_SESSION["rol"]=="Administrador"){
 

    if(isset($_GET["route"])) {


  if($_GET["route"] == "home" ||
     $_GET["route"] == "activaciones" ||
     $_GET["route"] == "clientes" ||
     $_GET["route"] == "pago-servicios" ||
     $_GET["route"] == "paquetes" ||
     $_GET["route"] == "categoria-servicios" ||
     $_GET["route"] == "subcategoria-servicios" ||
     $_GET["route"] == "recargas" ||
     $_GET["route"] == "ventas" ||
     $_GET["route"] == "movimiento-saldos" ||
     $_GET["route"] == "mover-saldo-bodegas" ||
     $_GET["route"] == "creacion-usuarios-clientes" ||
     $_GET["route"] == "recuperar-contrasena-frm1" ||
     $_GET["route"] == "recuperar-contrasena-frm2" ||
     $_GET["route"] == "reporte-sistema-facturacion" ||
     $_GET["route"] == "sucursal-cajas-facturacion" ||
     $_GET["route"] == "sistema-facturas-productos" ||
     $_GET["route"] == "sistema-facturas-clientes" ||
     $_GET["route"] == "sistema-facturas-actividadEconomica" ||
     $_GET["route"] == "inicio-facturacion" ||
     $_GET["route"] == "sistema-facturas-facturacion" ||
     $_GET["route"] == "sistema-facturas-crearFactura" ||
     $_GET["route"] == "reporte-tiendas" ||
     $_GET["route"] == "ad-personal" ||
     $_GET["route"] == "consulta-empleados" ||
     $_GET["route"] == "agregar-empleados" ||
     $_GET["route"] == "salida-empleados" ||
     $_GET["route"] == "aceptacion-inventarios" ||
     $_GET["route"] == "reporte-control-calidad" ||
     $_GET["route"] == "reporte-ventas-dth" ||
     $_GET["route"] == "reporte-ventas-bodega" ||
     $_GET["route"] == "sistema-facturas-reporte-gastos" ||
     $_GET["route"] == "registro" ||
     $_GET["route"] == "evaluacion-tiendas" ||
     $_GET["route"] == "planes-categoria" ||
     $_GET["route"] == "planes-clientes" ||
     $_GET["route"] == "sistema-facturas-reporte-iva" ||
     $_GET["route"] == "aceptacion-planes-clientes" ||
     $_GET["route"] == "sistema-facturas-datosFacturacion" ||
     $_GET["route"] == "sistema-facturas-clientes-masivo" ||
     $_GET["route"] == "control-asistencia" ||
     $_GET["route"] == "machoteFactura" ||
     $_GET["route"] == "logout2" ||
     $_GET["route"] == "merchandising-clientes" ||
     $_GET["route"] == "merchandising-fotos" ||
     $_GET["route"] == "Dashboard-general" ||
     $_GET["route"] == "emision-facturas" ||
     $_GET["route"] == "emision-facturas-facturar" ||
     $_GET["route"] == "logout")
     
      {

    include "modules/".$_GET["route"].".php";

  } else {

    include "modules/404.php";

  }

} else {

include "modules/home.php";

}
            

    }else if($_SESSION["rol"]=="Invitado"){

                if(isset($_GET["route"])) {
        
        
          if($_GET["route"] == "home" ||
             $_GET["route"] == "clientes" ||
             $_GET["route"] == "creacion-usuarios-clientes" ||
             $_GET["route"] == "logout" ||
             $_GET["route"] == "logout2")
        
              {
        
            include "modules/".$_GET["route"].".php";
        
          } else {
        
            include "modules/404.php";
        
          }
        
        } else {
        
        include "modules/home.php";
        
        }
        
        
                       
      }else if($_SESSION["rol"]=="UsuarioOTB" || $_SESSION["rol"]=="Supervisor-Tiendas" || $_SESSION["rol"]=="Supervisor-DTH"){

        if(isset($_GET["route"])) {

          $subModulos = json_decode($_SESSION["subModulos"]);


          $subModulos =  str_replace ( '[' , '' ,$subModulos);
          $subModulos =  str_replace ( ']' , '' ,$subModulos);


          $subMod = $_GET["route"];

         $idSubmod = sidebarController::ctrIDSubModulo($subMod, $subModulos);

         echo("<script>console.log('sub modulos ". $idSubmod .  "');</script>");

          
          if(in_array( $idSubmod[0]["idtbl_subModulos_outthebox"] , $subModulos, true )) {
            
            // if(in_array( $idSubmod, $subModulos, true )) {
          
         
            include "modules/".$_GET["route"].".php";
                  
          }elseif($_GET["route"] == "logout"){

            include "modules/".$_GET["route"].".php";

          }elseif($_GET["route"] == "logout2"){

            include "modules/".$_GET["route"].".php";

          }elseif($_GET["route"] == "home"){

            include "modules/".$_GET["route"].".php";

          }elseif($_GET["route"] == "machoteFactura"){

            include "modules/".$_GET["route"].".php";

          }else{

                include "modules/404.php";

          }

  // if($_GET["route"] == "home" ||
  //    $_GET["route"] == "clientes" ||
  //    $_GET["route"] == "logout")

  //     {

  // include "modules/".$_GET["route"].".php";

  // } else {

  // include "modules/404.php";

  // }

} else {

include "modules/home.php";

}


               
}else{

echo '<script>

      swal({

        type: "error",
        title: "¡Su usuario no esta activo, favor contacte a su supervisor!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false

      }).then((result)=>{

        if(result.value){

          window.location = "login";
        }

        });       

      </script>'  ;

      session_destroy();
      session_commit();


               
              }   






/*=============================================
=               FOOTER           =
=============================================*/
if (strripos($_SERVER['REQUEST_URI'], "machoteFactura") ){



}else{

  include "modules/footer.php";

}


echo '</div>';

    }else{

     
            echo("<script>console.log('PHP: USER222 ". $_SERVER['REQUEST_URI'] .  "');</script>");
       
            
            if(strripos($_SERVER['REQUEST_URI'], "login")){

              include "modules/login.php";

            }else if (strripos($_SERVER['REQUEST_URI'], "registro") ){

              include "modules/registro.php";

            }else if (strripos($_SERVER['REQUEST_URI'], "recuperar-contrasena-frm1") ){

              include "modules/recuperar-contrasena-frm1.php";

            }else if (strripos($_SERVER['REQUEST_URI'], "recuperar-contrasena-frm2") ){

              include "modules/recuperar-contrasena-frm2.php";

            }else if (strripos($_SERVER['REQUEST_URI'], "machoteFactura") ){

              include "modules/machoteFactura.php";

            }else{

      include "modules/landing.php";

            }

            
    }

        
?>


<?php

 if(isset($_SESSION["login"]) && $_SESSION["login"] == "ok" || strripos($_SERVER['REQUEST_URI'], "login") || strripos($_SERVER['REQUEST_URI'], "registro") || strripos($_SERVER['REQUEST_URI'], "recuperar-contrasena-frm1") || strripos($_SERVER['REQUEST_URI'], "recuperar-contrasena-frm2")){?>


<script src="views/js/pago-servicios.js" ></script> 

<script src="views/js/dateformat.js" ></script> 

<script src="views/js/recargas.js" ></script> 

<script src="views/js/paquetes.js" ></script> 

<script src="views/js/activaciones.js" ></script> 

<script src="views/js/clientes.js" ></script> 

<script src="views/js/categoria-servicios.js" ></script> 

<script src="views/js/subcategoria-servicios.js" ></script> 

<script src="views/js/ventas.js" ></script> 

<script src="views/js/template.js" ></script> 

<script src="views/js/movimiento-saldos.js"></script>

<script src="views/js/mover-saldo-bodegas.js"></script> 

<script src="views/js/creacion-usuarios-clientes.js"></script> 

<script src="views/js/recuperar-contrasena-frm1.js"></script> 

<script src="views/js/recuperar-contrasena-frm2.js"></script> 

<script src="views/js/reporte-sistema-facturacion.js"></script>

<script src="views/js/sucursales-cajas-facturacion.js"></script> 

<script src="views/js/sistema-facturas-productos.js"></script> 

<script src="views/js/sistema-facturas-clientes.js"></script> 

<script src="views/js/reporte-ventas-tiendas.js" ></script> 

<script src="views/js/sistema-facturas-actividadEconomica.js"></script>

<script src="views/js/sistema-facturas-facturacion.js"></script>

<script src="views/js/sistema-facturas-crearFactura.js"></script>

<script src="views/js/ad-personal.js" ></script> 

<script src="views/js/consulta-empleado.js" ></script> 

<script src="views/js/agregar-empleados.js" ></script> 

<script src="views/js/salida-empleados.js" ></script> 

<script src="views/js/aceptacion-inventarios.js" ></script> 

<script src="views/js/inicio-facturacion.js"></script>

<script src="views/js/reporte-control-calidad.js"></script>

<script src="views/js/reporte-ventas-dth.js"></script>

<script src="views/js/reporte-ventas-bodega.js"></script>

<script src="views/js/sistema-facturas-reporte-gastos.js"></script>

<!-- <script src="views/js/evaluacion-tiendas.js"></script> -->

<script src="views/js/planes-categoria.js"></script>

<script src="views/js/planes-clientes.js"></script>

<script src="views/js/home.js" ></script> 

<script src="views/js/sistema-facturas-reporte-iva.js"></script>

<script src="views/js/registro.js"></script>

<script src="views/js/aceptacion-planes-clientes.js"></script>

<script src="views/js/sistema-facturas-datosFacturacion.js"></script>

<script src="views/js/sistema-facturas-clientes-masivo.js"></script>

<script src="views/js/control-asistencia.js"></script>

<script src="views/js/merchandising-clientes.js"></script>

<script src="views/js/merchandising-fotos.js"></script>

<script src="views/js/sorttable.js"></script>

<script src="views/js/emision-facturas.js"></script>

<script src="views/js/emision-facturas-facturar.js"></script>



<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '543681613364049',
      xfbml      : true,
      version    : 'v12.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>  

<script src="views/js/conexionFacebook.js"></script>


 <?php }else{ ?>

<script src="views/js/conexionFacebook.js"></script>

<?php } ?>
 

</body>
</html>
