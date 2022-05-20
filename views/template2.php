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

  <link rel="icon" href="views/img/template/iconupee.png">




<?php
 if(isset($_SESSION["login"]) && $_SESSION["login"] == "ok" || strripos($_SERVER['REQUEST_URI'], "login")){?>




<!--=====================================
=            PLUGING CSS            =
======================================-->


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


 <!-- fullCalendar -->
 <link rel="stylesheet" href="views/plugins/fullcalendar/main.css">

  <!-- dropzonejs -->
  <link rel="stylesheet" href="views/plugins/dropzone/min/dropzone.min.css">

<!-- SweetAlert2 -->
<script src="views/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- jQuery -->
<script src="views/plugins/jquery/jquery.min.js"></script>


 <script src="views/plugins/jquery-ui/jquery-ui.min.js"></script> 



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

<!-- InputMask -->
<script src="views/plugins/moment/moment.min.js"></script>
<script src="views/plugins/inputmask/jquery.inputmask.min.js"></script>

<!-- date-range-picker -->
<script src="views/plugins/daterangepicker/daterangepicker.js"></script>

  <!--   jquery.signature.package-1.2.1 -->
<script type="text/javascript" src="views/plugins/jquery.signature.package-1.2.1/js/jquery.signature.js"></script> 

 <script type="text/javascript" src="views/plugins/jquery.signature.package-1.2.1/js/jquery.ui.touch-punch.min.js"></script>

    <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="views/plugins/raphael/raphael.min.js"></script>
  <script src="views/plugins/morris.js/morris.min.js"></script>


<!-- bs-custom-file-input -->
<script src="views/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

  <!-- Ionicons -->
  <link rel="stylesheet" href="views/plugins/Ionicons/css/ionicons.min.css">

<!-- iCheck 1.0.1 -->
<script src="views/plugins/iCheck/icheck.min.js"></script>

<!-- GENERAR ARCHIVOS ZIP -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip-utils/0.1.0/jszip-utils.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>

<!-- Format nunbers -->


<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/gh/timdown/jshashtable/hashtable.js"></script>

<script src="https://cdn.jsdelivr.net/gh/hardhub/jquery-numberformatter/src/jquery.numberformatter.js"></script>


   <!-- fullCalendar -->
  <script src="views/plugins/fullcalendar/main.js"></script>

  <script src="views/plugins/fullcalendar/locales-all.js"></script>


<!-- dropzonejs -->
<script src="views/plugins/dropzone/min/dropzone.min.js"></script>

<script src="views/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<link rel="stylesheet" href="views/plugins/bs-stepper/css/bs-stepper.min.css">
<!-- <link rel="stylesheet" href="bs-stepper.min.css"> -->

<!-- 
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
</script> -->

<!-- <script>
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
</script> -->
 <?php }else{ ?>




  <?php } ?>


</head>
<!--=====================================
=            BODY DOCUMENT            =
======================================-->


<!-- <body class="hold-transition skin-black-light sidebar-collapse login-page"> -->





 


<?php



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

    if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){
 

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
    $_GET["route"] == "sistema-facturas-facturacion" ||
    $_GET["route"] == "sistema-facturas-actividadEconomica" ||
    $_GET["route"] == "calendar" ||
    $_GET["route"] == "invitados-eventos" ||
    $_GET["route"] == "emision-facturas" ||
    $_GET["route"] == "inicio-facturacion" ||
     $_GET["route"] == "logout")

      {

    include "modules/".$_GET["route"].".php";

  } else {

    include "modules/404.php";

  }

} else {

include "modules/home.php";

}
            

    }else if($_SESSION["rol"]=="Instalador"){

  if(isset($_GET["route"])) {


  if($_GET["route"] == "home" ||
     $_GET["route"] == "reportes" ||
     $_GET["route"] == "categories" ||
     $_GET["route"] == "products" ||
     $_GET["route"] == "clients" ||
     $_GET["route"] == "sales" ||
     $_GET["route"] == "create-sale" ||
     $_GET["route"] == "report-quantity" ||
     $_GET["route"] == "report-series" ||
     $_GET["route"] == "installation-form" ||  

     $_GET["route"] == "logout")

      {

    include "modules/".$_GET["route"].".php";

  } else {

    include "modules/404.php";

  }

} else {

include "modules/home.php";

}   

    }else if($_SESSION["rol"]=="Vendedor" && $_SESSION["sub_tipo"]!="3. Socio"){




        if(isset($_GET["route"])) {
  if($_GET["route"] == "home" ||
     $_GET["route"] == "users" ||
     $_GET["route"] == "categories" ||
     $_GET["route"] == "products" ||
     $_GET["route"] == "clients" ||
     $_GET["route"] == "sales" ||
     $_GET["route"] == "create-sale" ||
   
      $_GET["route"] == "promocionales" || 
     $_GET["route"] == "activaciones" || 
     $_GET["route"] == "sales-dth" || 
     $_GET["route"] == "sales-gpon" || 
     $_GET["route"] == "sales-internet" || 
     $_GET["route"] == "ventas-postpago" || 
     $_GET["route"] == "logout"|| 
     $_GET["route"] == "report-sales-group"
   ) {

    include "modules/".$_GET["route"].".php";

  } else {

    include "modules/404.php";

  }



}else {

include "modules/home.php";

}               
    }else if($_SESSION["rol"]=="Vendedor-Instalador"){

      
        if(isset($_GET["route"])) {


  if($_GET["route"] == "home" ||
     $_GET["route"] == "users" ||
     $_GET["route"] == "categories" ||
     $_GET["route"] == "products" ||
     $_GET["route"] == "clients" ||
     $_GET["route"] == "sales" ||
     $_GET["route"] == "create-sale" ||
     $_GET["route"] == "report-quantity" ||
     $_GET["route"] == "report-series" ||
     $_GET["route"] == "activaciones" || 
     $_GET["route"] == "sales-dth" || 
     $_GET["route"] == "sales-gpon" || 
     $_GET["route"] == "sales-internet" ||
      $_GET["route"] == "promocionales" ||  
     $_GET["route"] == "ventas-postpago" || 
     $_GET["route"] == "report-quantity" ||
     $_GET["route"] == "report-series" ||
     $_GET["route"] == "installation-form" ||  
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
$_GET["route"] == "calendar" ||
$_GET["route"] == "logout")

{

include "modules/".$_GET["route"].".php";

} else {

include "modules/404.php";

}

} else {

include "modules/home.php";

}
 
}else if($_SESSION["rol"]=="AllMarket-Admin" || $_SESSION["rol"]=="AllMarket-supervisor" || $_SESSION["rol"]=="AllMarket-Vendedor"){

  if(isset($_GET["route"])) {

if($_GET["route"] == "home" ||
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
 
}else if($_SESSION["rol"]=="Masivo"){

        if(isset($_GET["route"])) {


  if($_GET["route"] == "home" ||
     $_GET["route"] == "map" ||
     $_GET["route"] == "clients-masivo" ||
       $_GET["route"] == "home-masivo" || 
     $_GET["route"] == "logout")

      {

    include "modules/".$_GET["route"].".php";

  } else {

    include "modules/404.php";

  }

} else {

include "modules/home.php";

}


               
} else{

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

include "modules/footer.php";

echo '</div>';

    }else{

     

            echo("<script>console.log('PHP: USER ". $_SERVER['REQUEST_URI'] .  "');</script>");
            
            if(strripos($_SERVER['REQUEST_URI'], "login")){

              include "modules/login.php";

            }else{

      include "modules/landing.php";

            }



      

    }

        
?>


<?php

 if(isset($_SESSION["login"]) && $_SESSION["login"] == "ok" || strripos($_SERVER['REQUEST_URI'], "login") ){?>




<script src="views/js/pago-servicios.js" ></script> 

<script src="views/js/dateformat.js" ></script> 

<script src="views/js/recargas.js" ></script> 

<script src="views/js/paquetes.js" ></script> 

<script src="views/js/activaciones.js" ></script> 

<script src="views/js/home.js" ></script> 

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

<script src="views/js/sistema-facturas-facturacion.js"></script>

<script src="views/js/sistema-facturas-actividadEconomica.js"></script>

<script src="views/js/calendario.js"></script>

<script src="views/js/invitados-eventos.js"></script>

<script src="views/js/emision-facturas.js"></script>

<script src="views/js/emision-facturas-facturar.js"></script>

<script src="views/js/inicio-facturacion.js"></script>

<script src="views/js/sidebar.js"></script>

 <?php }else{ 



 } ?>


</body>
</html>
