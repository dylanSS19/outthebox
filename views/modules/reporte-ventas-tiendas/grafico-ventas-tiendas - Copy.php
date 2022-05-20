<?php

error_reporting(0);
 ?>
 
  
<style>

#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;

}

#myBtn:hover {
  background-color: #555;
}
</style>


<button  onclick="topFunction()" id="myBtn" title="Go to top"> <i class="fa fa-arrow-circle-o-up"></i></button>

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

             <?php 

  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                        $today = date('Y-m-d');

                    $startDate =date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));

                   }


if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){

if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){

               $tienda = $_GET["tienda"];
          
}


 $totalventas = controladorVentasTiendas::ctrventastiendas($startDate, $endDate, $tienda); 
/* echo '<pre>'; print_r($totalventas); echo '</pre>';
*/ 
          

}

  ?>


<!-- GRAFICO -->

<div class="box box-solid">
  

  <div class="box-header">


<h3 class="box-title">Gráfico de Ventas</h3>    

  </div>



   <div class="box-body chart-responsive">
       <!-- checkbox -->
              <div class="form-group">
                <label style="color: #FF0000">
                  <input type="checkbox" class="minimal" checked id="chk_pospago_grafico_ventas_tiendas"> POSPAGO
                </label> &nbsp;&nbsp;
                <label style="color: #3c8dbc">
                  <input type="checkbox" class="minimal" checked id="chk_kitsclaro_claro_grafico_ventas_tiendas"> KITS CLARO 
                </label> &nbsp;&nbsp;
                <label style="color: #a0d0e0">
                  <input type="checkbox" class="minimal" checked id="chk_kitsclaro_digital_grafico_ventas_tiendas"> KITS DIGITAL
                </label> &nbsp;&nbsp;
                   <label style="color: #FFC0CB">
                  <input type="checkbox" class="minimal" checked id="chk_kitsdigital_grafico_ventas_tiendas"> KITS DIGITAL
                </label>
              </div>
              <div class="chart" id="renueve-chart-tiendas" style="height: 300px;"></div>
            </div>

</div>

  <script>




// TODOS 

                var isCheckedchk_pospago_grafico_ventas_tiendas = document.getElementById('chk_pospago_grafico_ventas_tiendas').checked;

                var isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_claro_grafico_ventas_tiendas').checked;

                var isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_digital_grafico_ventas_tiendas').checked;

                var isCheckedchk_kitsdigital_grafico_ventas_tiendas = document.getElementById('chk_kitsdigital_grafico_ventas_tiendas').checked;


if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas ){



  $("#renueve-chart-tiendas").empty();
$("#renueve-chart-tiendas svg").remove();


  "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

if ($totalventas ==null){


 echo "{ y: 0, pospago: 0, kitsclaro: 0, kitsdigital: 0, accesorios: 0 }";


}else{


    foreach ($totalventas as $key => $value) {
      

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." },";


      }

      

    }

} 

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' , 'accesorios'],
      labels: ['POSPAGO', 'KITS CLARO', 'KITS DIGITAL' , 'ACCESORIOS'],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],
    
    });
}






   $('#chk_pospago_grafico_ventas_tiendas').on('ifChecked', function(event){

    
      $("#renueve-chart-tiendas").empty();
$("#renueve-chart-tiendas svg").remove();


      var isCheckedchk_pospago_grafico_ventas_tiendas = document.getElementById('chk_pospago_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_claro_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_digital_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsdigital_grafico_ventas_tiendas = document.getElementById('chk_kitsdigital_grafico_ventas_tiendas').checked;


if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas){

 "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' , 'accesorios'],
      labels: ['POSPAGO', 'KITS CLARO', 'KITS DIGITAL' , 'ACCESORIOS'],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],
    
    });



 

}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' ],
      labels: ['POSPAGO', 'KITS CLARO', 'KITS DIGITAL' ],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],
    
    });

}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios', 'kitsdigital' ],
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'accesorios' ],
      labels: ['POSPAGO', 'KITS CLARO','ACCESORIOS' ],
      lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro' ],
      labels: ['POSPAGO', 'KITS CLARO' ],
      lineColors: ['#FF0000', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios' ],
      labels: ['POSPAGO', 'ACCESORIOS' ],
      lineColors: ['#FF0000', '#FFC0CB'],
    
    });

     }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsdigital' ],
      labels: ['POSPAGO', 'POSPAGO' ],
      lineColors: ['#FF0000', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas) {

  console.log("pospago chekced");

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago'],
      labels: ['POSPAGO'],
      lineColors: ['#FF0000'],
    
    });


}




});

$('#chk_pospago_grafico_ventas_tiendas').on('ifUnchecked', function(event){



      $("#renueve-chart-tiendas").empty();


$("#renueve-chart-tiendas svg").remove();


      var isCheckedchk_pospago_grafico_ventas_tiendas = document.getElementById('chk_pospago_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_claro_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_digital_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsdigital_grafico_ventas_tiendas = document.getElementById('chk_kitsdigital_grafico_ventas_tiendas').checked;


if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas){

 "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."',kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro', 'kitsdigital' , 'accesorios'],
      labels: ['KITS CLARO', 'KITS DIGITAL' , 'ACCESORIOS'],
      lineColors: ['#3c8dbc', '#a0d0e0', '#FFC0CB'],
    
    });



 

}else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."',kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."',kitsclaro: ".$value[2].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro', 'kitsdigital' ],
      labels: ['KITS CLARO', 'KITS DIGITAL' ],
      lineColors: ['#3c8dbc', '#a0d0e0'],
    
    });



}else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro', 'accesorios' ],
      labels: ['KITS CLARO','ACCESORIOS' ],
      lineColors: ['#3c8dbc', '#FFC0CB'],
    
    });


}else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital', 'kitsclaro' ],
      labels: ['POSPAGO', 'KITS CLARO' ],
      lineColors: ['#a0d0e0', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital', 'accesorios' ],
      labels: ['POSPAGO', 'ACCESORIOS' ],
      lineColors: ['#a0d0e0', '#FFC0CB'],
    
    });

     }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsdigital' ],
      labels: ['POSPAGO', 'POSPAGO' ],
      lineColors: ['#FF0000', '#a0d0e0'],
    
    });

  }else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro'],
      labels: ['INTERNET'],
      lineColors: ['#3c8dbc'],
    
    });


}else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital'],
      labels: ['POSPAGO'],
      lineColors: ['#a0d0e0'],
    
    });


}else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios'],
      labels: ['ACCESORIOS'],
      lineColors: ['#FFC0CB'],
    
    });


}




});


   $('#chk_kitsclaro_claro_grafico_ventas_tiendas').on('ifChecked', function(event){
      $("#renueve-chart-tiendas").empty();
$("#renueve-chart-tiendas svg").remove();


      var isCheckedchk_pospago_grafico_ventas_tiendas = document.getElementById('chk_pospago_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_claro_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_digital_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsdigital_grafico_ventas_tiendas = document.getElementById('chk_kitsdigital_grafico_ventas_tiendas').checked;


if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas){

 "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' , 'accesorios'],
      labels: ['POSPAGO', 'KITS CLARO', 'KITS DIGITAL' , 'ACCESORIOS'],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],
    
    });



 

}else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro', 'kitsdigital' ],
      labels: ['ACCESORIOS', 'KITS CLARO', 'KITS DIGITAL' ],
      lineColors: ['#FFC0CB', '#3c8dbc', '#a0d0e0'],
    
    });

}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios', 'kitsdigital' ],
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'accesorios' ],
      labels: ['POSPAGO', 'KITS CLARO','ACCESORIOS' ],
      lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' ],
      labels: ['POSPAGO', 'KITS CLARO','KITS DIGITAL' ],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro' ],
      labels: ['POSPAGO', 'KITS CLARO' ],
      lineColors: ['#FF0000', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital', 'kitsclaro' ],
      labels: ['KITS DIGITAL', 'KITS CLARO' ],
      lineColors: ['#a0d0e0', '#3c8dbc'],
    
    });

     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro' ],
      labels: ['ACCESORIOS', 'KITS CLARO' ],
      lineColors: ['#FFC0CB', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios' ],
      labels: ['POSPAGO', 'ACCESORIOS' ],
      lineColors: ['#FF0000', '#FFC0CB'],
    
    });

     }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsdigital' ],
      labels: ['POSPAGO', 'POSPAGO' ],
      lineColors: ['#FF0000', '#a0d0e0'],
    
    });


     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsdigital' ],
      labels: ['ACCESORIOS', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#a0d0e0'],
    
    });


}else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[1]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[1]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro'],
      labels: ['KITS CLARO'],
      lineColors: ['#3c8dbc'],
    
    });


}




});




$('#chk_kitsclaro_claro_grafico_ventas_tiendas').on('ifUnchecked', function(event){
      $("#renueve-chart-tiendas").empty();
$("#renueve-chart-tiendas svg").remove();


      var isCheckedchk_pospago_grafico_ventas_tiendas = document.getElementById('chk_pospago_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_claro_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_digital_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsdigital_grafico_ventas_tiendas = document.getElementById('chk_kitsdigital_grafico_ventas_tiendas').checked;


if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas){

 "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' , 'accesorios'],
      labels: ['POSPAGO', 'KITS CLARO', 'KITS DIGITAL' , 'ACCESORIOS'],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],
    
    });



 

}else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", pospago: ".$value[1].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", pospago: ".$value[1].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'pospago', 'kitsdigital' ],
      labels: ['ACCESORIOS', 'POSPAGO', 'KITS DIGITAL' ],
      lineColors: ['#FFC0CB', '#FF0000', '#a0d0e0'],
    
    });

}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios', 'kitsdigital' ],
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'accesorios' ],
      labels: ['POSPAGO', 'KITS CLARO','ACCESORIOS' ],
      lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' ],
      labels: ['POSPAGO', 'KITS CLARO','KITS DIGITAL' ],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro' ],
      labels: ['POSPAGO', 'KITS CLARO' ],
      lineColors: ['#FF0000', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital', 'kitsclaro' ],
      labels: ['KITS DIGITAL', 'KITS CLARO' ],
      lineColors: ['#a0d0e0', '#3c8dbc'],
    
    });

     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro' ],
      labels: ['ACCESORIOS', 'KITS CLARO' ],
      lineColors: ['#FFC0CB', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios' ],
      labels: ['POSPAGO', 'ACCESORIOS' ],
      lineColors: ['#FF0000', '#FFC0CB'],
    
    });

     }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsdigital' ],
      labels: ['POSPAGO', 'POSPAGO' ],
      lineColors: ['#FF0000', '#a0d0e0'],
    
    });


     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsdigital' ],
      labels: ['ACCESORIOS', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago'],
      labels: ['POSPAGO'],
      lineColors: ['#FF0000'],
    
    });


}else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro'],
      labels: ['KITS CLARO'],
      lineColors: ['#3c8dbc'],
    
    });

    }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios'],
      labels: ['ACCESORIOS'],
      lineColors: ['#FFC0CB'],
    
    });

        }else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital'],
      labels: ['KITS DIGITAL'],
      lineColors: ['#a0d0e0'],
    
    });


}




});


$('#chk_kitsclaro_digital_grafico_ventas_tiendas').on('ifChecked', function(event){
      $("#renueve-chart-tiendas").empty();
$("#renueve-chart-tiendas svg").remove();


      var isCheckedchk_pospago_grafico_ventas_tiendas = document.getElementById('chk_pospago_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_claro_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_digital_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsdigital_grafico_ventas_tiendas = document.getElementById('chk_kitsdigital_grafico_ventas_tiendas').checked;


if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas){

 "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' , 'accesorios'],
      labels: ['POSPAGO', 'KITS CLARO', 'KITS DIGITAL' , 'ACCESORIOS'],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],
    
    });



 

}else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_pospago_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2].", pospago: ".$value[1]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2].", pospago: ".$value[1]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro', 'pospago' ],
      labels: ['ACCESORIOS', 'KITS CLARO', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#3c8dbc', '#FF0000'],
    
    });

}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios', 'kitsdigital' ],
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],
    
    });


  }else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro', 'accesorios', 'kitsdigital' ],
      labels: ['KITS CLARO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#3c8dbc', '#FFC0CB', '#a0d0e0'],
    
    });



}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'accesorios' ],
      labels: ['POSPAGO', 'KITS CLARO','ACCESORIOS' ],
      lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' ],
      labels: ['POSPAGO', 'KITS CLARO','KITS DIGITAL' ],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro' ],
      labels: ['POSPAGO', 'KITS CLARO' ],
      lineColors: ['#FF0000', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital', 'kitsclaro' ],
      labels: ['KITS DIGITAL', 'KITS CLARO' ],
      lineColors: ['#a0d0e0', '#3c8dbc'],
    
    });

     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro' ],
      labels: ['ACCESORIOS', 'KITS CLARO' ],
      lineColors: ['#FFC0CB', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios' ],
      labels: ['POSPAGO', 'ACCESORIOS' ],
      lineColors: ['#FF0000', '#FFC0CB'],
    
    });

     }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsdigital' ],
      labels: ['POSPAGO', 'POSPAGO' ],
      lineColors: ['#FF0000', '#a0d0e0'],
    
    });


     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsdigital' ],
      labels: ['ACCESORIOS', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#a0d0e0'],
    
    });


}else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital'],
      labels: ['KITS DIGITAL'],
      lineColors: ['#a0d0e0'],
    
    });


}




});



$('#chk_kitsclaro_digital_grafico_ventas_tiendas').on('ifUnchecked', function(event){
      $("#renueve-chart-tiendas").empty();
$("#renueve-chart-tiendas svg").remove();


      var isCheckedchk_pospago_grafico_ventas_tiendas = document.getElementById('chk_pospago_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_claro_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_digital_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsdigital_grafico_ventas_tiendas = document.getElementById('chk_kitsdigital_grafico_ventas_tiendas').checked;


if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas){

 "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' , 'accesorios'],
      labels: ['POSPAGO', 'KITS CLARO', 'KITS DIGITAL' , 'ACCESORIOS'],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],
    
    });



 

}else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_pospago_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2].", pospago: ".$value[1]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2].", pospago: ".$value[1]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro', 'pospago' ],
      labels: ['ACCESORIOS', 'KITS CLARO', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#3c8dbc', '#FF0000'],
    
    });

}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios', 'kitsdigital' ],
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],
    
    });


  }else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro', 'accesorios', 'kitsdigital' ],
      labels: ['KITS CLARO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#3c8dbc', '#FFC0CB', '#a0d0e0'],
    
    });



}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'accesorios' ],
      labels: ['POSPAGO', 'KITS CLARO','ACCESORIOS' ],
      lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' ],
      labels: ['POSPAGO', 'KITS CLARO','KITS DIGITAL' ],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro' ],
      labels: ['POSPAGO', 'KITS CLARO' ],
      lineColors: ['#FF0000', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital', 'kitsclaro' ],
      labels: ['KITS DIGITAL', 'KITS CLARO' ],
      lineColors: ['#a0d0e0', '#3c8dbc'],
    
    });

     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro' ],
      labels: ['ACCESORIOS', 'KITS CLARO' ],
      lineColors: ['#FFC0CB', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios' ],
      labels: ['POSPAGO', 'ACCESORIOS' ],
      lineColors: ['#FF0000', '#FFC0CB'],
    
    });

     }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsdigital' ],
      labels: ['POSPAGO', 'POSPAGO' ],
      lineColors: ['#FF0000', '#a0d0e0'],
    
    });


     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsdigital' ],
      labels: ['ACCESORIOS', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#a0d0e0'],
    
    });

         }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4]."}";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios' ],
      labels: ['ACCESORIOS' ],
      lineColors: ['#FFC0CB'],
    
    });


}else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital'],
      labels: ['KITS DIGITAL'],
      lineColors: ['#a0d0e0'],
    
    });


  }else if(isCheckedchk_pospago_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago'],
      labels: ['POSPAGO'],
      lineColors: ['#FF0000'],
    
    });

      }else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro'],
      labels: ['KITS CLARO'],
      lineColors: ['#3c8dbc'],
    
    });


}




});


$('#chk_kitsdigital_grafico_ventas_tiendas').on('ifChecked', function(event){
      $("#renueve-chart-tiendas").empty();
$("#renueve-chart-tiendas svg").remove();


      var isCheckedchk_pospago_grafico_ventas_tiendas = document.getElementById('chk_pospago_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_claro_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_digital_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsdigital_grafico_ventas_tiendas = document.getElementById('chk_kitsdigital_grafico_ventas_tiendas').checked;


if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas){

 "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' , 'accesorios'],
      labels: ['POSPAGO', 'KITS CLARO', 'KITS DIGITAL' , 'ACCESORIOS'],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],
    
    });



 

}else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_pospago_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2].", pospago: ".$value[1]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2].", pospago: ".$value[1]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro', 'pospago' ],
      labels: ['ACCESORIOS', 'KITS CLARO', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#3c8dbc', '#FF0000'],
    
    });

}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios', 'kitsdigital' ],
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],
    
    });


  }else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro', 'accesorios', 'kitsdigital' ],
      labels: ['KITS CLARO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#3c8dbc', '#FFC0CB', '#a0d0e0'],
    
    });



}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'accesorios' ],
      labels: ['POSPAGO', 'KITS CLARO','ACCESORIOS' ],
      lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' ],
      labels: ['POSPAGO', 'KITS CLARO','KITS DIGITAL' ],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro' ],
      labels: ['POSPAGO', 'KITS CLARO' ],
      lineColors: ['#FF0000', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital', 'kitsclaro' ],
      labels: ['KITS DIGITAL', 'KITS CLARO' ],
      lineColors: ['#a0d0e0', '#3c8dbc'],
    
    });

     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro' ],
      labels: ['ACCESORIOS', 'KITS CLARO' ],
      lineColors: ['#FFC0CB', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios' ],
      labels: ['POSPAGO', 'ACCESORIOS' ],
      lineColors: ['#FF0000', '#FFC0CB'],
    
    });

     }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsdigital' ],
      labels: ['POSPAGO', 'POSPAGO' ],
      lineColors: ['#FF0000', '#a0d0e0'],
    
    });


     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsdigital' ],
      labels: ['ACCESORIOS', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#a0d0e0'],
    
    });


}else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital'],
      labels: ['KITS DIGITAL'],
      lineColors: ['#a0d0e0'],
    
    });


}




});


    

     
$('#chk_kitsdigital_grafico_ventas_tiendas').on('ifUnchecked', function(event){
      $("#renueve-chart-tiendas").empty();
$("#renueve-chart-tiendas svg").remove();


      var isCheckedchk_pospago_grafico_ventas_tiendas = document.getElementById('chk_pospago_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_claro_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas = document.getElementById('chk_kitsclaro_digital_grafico_ventas_tiendas').checked;

      var isCheckedchk_kitsdigital_grafico_ventas_tiendas = document.getElementById('chk_kitsdigital_grafico_ventas_tiendas').checked;


if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas){

 "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' , 'accesorios'],
      labels: ['POSPAGO', 'KITS CLARO', 'KITS DIGITAL' , 'ACCESORIOS'],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],
    
    });



 

}else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_pospago_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2].", pospago: ".$value[1]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2].", pospago: ".$value[1]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro', 'pospago' ],
      labels: ['ACCESORIOS', 'KITS CLARO', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#3c8dbc', '#FF0000'],
    
    });

}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios', 'kitsdigital' ],
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],
    
    });


  }else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2].", accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro', 'accesorios', 'kitsdigital' ],
      labels: ['KITS CLARO', 'ACCESORIOS', 'KITS DIGITAL' ],
      lineColors: ['#3c8dbc', '#FFC0CB', '#a0d0e0'],
    
    });



}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", accesorios: ".$value[4]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'accesorios' ],
      labels: ['POSPAGO', 'KITS CLARO','ACCESORIOS' ],
      lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2].", kitsdigital: ".$value[3]." },";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro', 'kitsdigital' ],
      labels: ['POSPAGO', 'KITS CLARO','KITS DIGITAL' ],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],
    
    });


}else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsclaro' ],
      labels: ['POSPAGO', 'KITS CLARO' ],
      lineColors: ['#FF0000', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital', 'kitsclaro' ],
      labels: ['KITS DIGITAL', 'KITS CLARO' ],
      lineColors: ['#a0d0e0', '#3c8dbc'],
    
    });

     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsclaro' ],
      labels: ['ACCESORIOS', 'KITS CLARO' ],
      lineColors: ['#FFC0CB', '#3c8dbc'],
    
    });

  }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsdigital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'accesorios' ],
      labels: ['POSPAGO', 'ACCESORIOS' ],
      lineColors: ['#FF0000', '#FFC0CB'],
    
    });

     }else if(isCheckedchk_pospago_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'kitsdigital' ],
      labels: ['POSPAGO', 'POSPAGO' ],
      lineColors: ['#FF0000', '#a0d0e0'],
    
    });


     }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas && isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4].", kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios', 'kitsdigital' ],
      labels: ['ACCESORIOS', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#a0d0e0'],
    
    });

         }else if(isCheckedchk_kitsdigital_grafico_ventas_tiendas ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', accesorios: ".$value[4]."}";


      }else{

        echo "{ y: '".$value[0]."', accesorios: ".$value[4]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['accesorios' ],
      labels: ['ACCESORIOS' ],
      lineColors: ['#FFC0CB'],
    
    });


}else if(isCheckedchk_kitsclaro_digital_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsdigital: ".$value[3]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsdigital'],
      labels: ['KITS DIGITAL'],
      lineColors: ['#a0d0e0'],
    
    });


  }else if(isCheckedchk_pospago_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', pospago: ".$value[1]." }";


      }else{

        echo "{ y: '".$value[0]."', pospago: ".$value[1]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['pospago'],
      labels: ['POSPAGO'],
      lineColors: ['#FF0000'],
    
    });

      }else if(isCheckedchk_kitsclaro_claro_grafico_ventas_tiendas) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'renueve-chart-tiendas',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

    foreach ($totalventas as $key => $value) {

      if ($key === array_key_last($array)){

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2]." }";


      }else{

        echo "{ y: '".$value[0]."', kitsclaro: ".$value[2]."},";


      }

      

    }

      

      ?>

    ],
      xkey: 'y',
      ykeys: ['kitsclaro'],
      labels: ['KITS CLARO'],
      lineColors: ['#3c8dbc'],
    
    });


}




});

 



</script> 






<!-- FIN GRAFICO -->



   
 <div class="row justify-content-center">



             <?php 

if(isset($_GET["startDate"]) && $_GET["startDate"]!= "null"){

     date_default_timezone_set('America/Costa_Rica');

      $today = date('Y-m-d');

      $firstday = $_GET["startDate"];

      $lastday = $_GET["endDate"];

      $startDate = date('d-m-Y', strtotime($firstday));

    $endDate = date('d-m-Y', strtotime($lastday));

}else{

      date_default_timezone_set('America/Costa_Rica');

      $today = date('Y-m-d');

      $firstday = date('Y-m-01', strtotime($today));

      $lastday = date('Y-m-t', strtotime($today));

      $startDate = date('d-m-Y', strtotime($firstday));

    $endDate = date('d-m-Y', strtotime($lastday));



};

echo'<p class="text-center"> <strong>Datos de Ventas del ' .  $startDate . ' al ' .  $endDate .  '</strong> </p>';


           

  ?>

    <div class="col-lg-3 col-xs-6">


      
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php




    if(isset($_GET["startDate"]) && $_GET["startDate"]!= "null"){

     date_default_timezone_set('America/Costa_Rica');

      $today = date('Y-m-d');

      $startDate = $_GET["startDate"];

      $endDate = $_GET["endDate"];

  

}else{

          date_default_timezone_set('America/Costa_Rica');

      $today = date('Y-m-d');

      $startDate = date('Y-m-01', strtotime($today));

      $endDate = date('Y-m-t', strtotime($today));

  


};

if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){

  if($_GET["tienda"]== "Todas..."){

  $vartienda="%";


  }else{

$vartienda= $_GET["tienda"];


  }

  

}else{

  $vartienda="%";

  };




      $total_ventas_pospago = controladorVentasTiendas::ctrCargarVentasPospago($startDate, $endDate);
   

      


              echo ' <h4 style="font-size: 22px">'.''. $total_ventas_pospago[0] .'</h4>';

              ?>
               
              <p>Pospago</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="moreinfopospago" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
        <div class="col-lg-3 col-xs-6">
        
          <div class="small-box bg-blue">
            <div class="inner">
        <?php



  $total_ventas_prepago_digital = controladorVentasTiendas::ctrCargarVentasPrepagoDigital($startDate, $endDate);




              echo ' <h4 style="font-size: 22px">'.''. $total_ventas_prepago_digital[0] .'</h4>';

                 ?>  
               <p>Kits Digital </p>

            
              

             
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="moreinfokitsclarodigital" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
        
          <div class="small-box bg-yellow">
            <div class="inner">
            <?php


   $total_ventas_prepago_claro = controladorVentasTiendas::ctrCargarVentasPrepagoClaro($startDate, $endDate);




       
   echo ' <h4 style="font-size: 22px">'.''. $total_ventas_prepago_claro[0] .'</h4>'
              ?>  

              <p>Kits Claro</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="moreinfokitsclaroclaro"class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


      
                <div class="col-lg-3 col-xs-6">
        
          <div class="small-box bg-red">
            <div class="inner">
            <?php

 


   $total_ventas_prepago_kitsdigital = controladorVentasTiendas::ctrCargarVentasAccesorios($startDate, $endDate);
/*   echo '<pre>'; print_r($total_ventas_prepago_kitsdigital); echo '</pre>';
*/



       
   echo ' <h4 style="font-size: 22px">'.'₡'. number_format($total_ventas_prepago_kitsdigital[0],2) .'</h4>';
              ?>  

              <p>Accesorios</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="moreinfoaccesorios" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">


      
          <div class="small-box bg-purple">
            <div class="inner">
              <?php




    if(isset($_GET["startDate"]) && $_GET["startDate"]!= "null"){

     date_default_timezone_set('America/Costa_Rica');

      $today = date('Y-m-d');

      $startDate = $_GET["startDate"];

      $endDate = $_GET["endDate"];

  

}else{

          date_default_timezone_set('America/Costa_Rica');

      $today = date('Y-m-d');

      $startDate = date('Y-m-01', strtotime($today));

      $endDate = date('Y-m-t', strtotime($today));

  


};

if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){

  if($_GET["tienda"]== "Todas..."){

  $vartienda="%";


  }else{

$vartienda= $_GET["tienda"];


  }

  

}else{

  $vartienda="%";

  };




      $total_ventas_recuadaciones = controladorVentasTiendas::ctrCargarVentasRecaudaciones($startDate, $endDate);
     


              echo ' <h4 style="font-size: 20px">'. '₡'. number_format($total_ventas_recuadaciones[0],2,'.',',') .'</h4>';

              ?>
               
              <p>Recaudaciones</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="moreinforecaudacion" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
        <div class="col-lg-3 col-xs-6">
        
          <div class="small-box bg-green">
            <div class="inner">
        <?php



  $total_ventas_arpu = controladorVentasTiendas::ctrCargarVentasArpuPospago($startDate, $endDate);




              echo ' <h4 style="font-size: 20px">'. '₡'. number_format($total_ventas_arpu[0],2,'.',',') .'</h4>';

                 ?>  
               <p>Arpu Pospago </p>

            
              

             
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="moreinfopospago" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
        
          <div class="small-box bg-maroon">
            <div class="inner">
            <?php


   $total_ventas_arpu_prepago_digital = controladorVentasTiendas::ctrCargarVentasArpuPrepagoDigital($startDate, $endDate);



       
              echo ' <h4 style="font-size: 20px">'. '₡'. number_format($total_ventas_arpu_prepago_digital[0],2,'.',',') .'</h4>';
              ?>  

              <p>Arpu Prepago Digital</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="moreinfokitsclarodigital"class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


      
                <div class="col-lg-3 col-xs-6">
        
          <div class="small-box bg-teal">
            <div class="inner">
            <?php




   $total_ventas_arpu_prepago_claro = controladorVentasTiendas::ctrCargarVentasArpuPrepagoClaro($startDate, $endDate);
/*   echo '<pre>'; print_r($total_ventas_prepago_kitsdigital); echo '</pre>';
*/



       
               echo ' <h4 style="font-size: 20px">'. '₡'. number_format($total_ventas_arpu_prepago_claro[0],2,'.',',') .'</h4>';

              ?>  

              <p>Arpu Prepago Claro</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="moreinfokitsclaroclaro" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

                <div class="col-lg-3 col-xs-6">
        <div class="color-palette-set">
          <div class="small-box bg-navy disabled color-palette">

            <div class="inner">
            <?php


   $total_ventas_pospago = controladorVentasTiendas::ctrCargarVentasPOSPAGO($startDate, $endDate);



       
                  echo ' <h4 style="font-size: 20px">'. '₡'. number_format($total_ventas_pospago[0],2,'.',',') .'</h4>';

              ?>  

              <p>POSPAGO</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="moreinfopospago"class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
            </div>
        </div>


      
                <div class="col-lg-3 col-xs-6">
        
          <div class="small-box bg-gray disabled color-palette">
            <div class="inner">
            <?php




   $total_ventas_activaciones = controladorVentasTiendas::ctrCargarVentasActivaciones($startDate, $endDate);
/*   echo '<pre>'; print_r($total_ventas_prepago_kitsdigital); echo '</pre>';
*/



       
   echo ' <h4 style="font-size: 22px">'.''. $total_ventas_activaciones[0] .'</h4>';
              ?>  

              <p>Activaciones</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="moreinfoactivaciones" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        </div>
      

<h3 class="box-title">Metas Mensuales</h3>   


<div class="form-group">
  <br> 
  <div class="input-group col-xs-12 col-md-6" >

    <?php



if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" ){

$usuario = null;

$tiendas = controladorVentasTiendas::ctrCargarTiendas($usuario);

}else{

$usuario = $_SESSION["user_name"];

$tiendas = controladorVentasTiendas::ctrCargarTiendas($usuario);


}





if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" ){?>

  <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
  <select class="form-control input-lg reporte_tiendas select2"   value="<?php echo $_GET["vendedor"] ?>"  name="reporte_tiendas" id="reporte_tiendas" required >
      
<?php



if(isset($_GET["tienda"]) && $_GET["tienda"] != "null"){?>
          
<option disabled selected value="<?php echo $_GET["tienda"] ?>"><?php echo $_GET["tienda"] ?></option>

 <?php
}else{?>

<option disabled selected value="">Tiendas</option>

<?php
}

?>
                           
                <?php 


                foreach ($tiendas as $key => $value): ?>
          
                <option value="<?php echo $value["idtbl_tiendas"];?>" ><?php echo $value["nombre"];?></option>
                
                <?php endforeach ?> 

            </select>

          </div>

        <?php }else{



        } ?>

 </div>




 <div class="row justify-content-center">

 <div class="col-md-6">

  <?php

    date_default_timezone_set('America/Costa_Rica');

    $today = date('Y-m-d');

    $startDate = date('Y-m-01', strtotime($today));

    $endDate = date('Y-m-t', strtotime($today));






 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Tiendas"){


if(isset($_GET["ID"]) && $_GET["ID"]!= "null"){

$tienda = $_GET["ID"];

}else{

$tienda = "null";


}

  $metas_tiendas = controladorVentasTiendas::ctrCargarMetasTiendas($startDate, $endDate, $tienda);



 }else{


  $metas_tiendas = controladorVentasTiendas::ctrCargarMetasTiendas($startDate, $endDate, $tienda);



 }



  $total_ventas=0;
               


if($metas_tiendas == null){


echo '
              <div class="progress-group">';

              

                        echo '<span class="progress-text">DTH</span>
                          <span class="progress-number"><b>0</b>/ 0 </span>';

                  
                  

                   echo' <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 0 %"></div>
                        <div class="progress-bar progress-bar-red" style="width:0 %"></div>
                   
                    </div>
                  </div>';

echo '
              <div class="progress-group">';

              

                        echo '<span class="progress-text">GPON</span>
                          <span class="progress-number"><b>0</b>/ 0 </span>';

                  
                  

                   echo' <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 0 %"></div>
                        <div class="progress-bar progress-bar-red" style="width:0 %"></div>
                   
                    </div>
                  </div>';
                  echo '
              <div class="progress-group">';

              

                        echo '<span class="progress-text">INTERNET</span>
                          <span class="progress-number"><b>0</b>/ 0 </span>';

                  
                  

                   echo' <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 0 %"></div>
                        <div class="progress-bar progress-bar-red" style="width:0 %"></div>
                   
                    </div>
                  </div>';

                  echo '
              <div class="progress-group">';

              

                        echo '<span class="progress-text">POSPAGO</span>
                          <span class="progress-number"><b>0</b>/ 0 </span>';

                  
                  

                   echo' <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 0 %"></div>
                        <div class="progress-bar progress-bar-red" style="width:0 %"></div>
                   
                    </div>
                  </div>';




}else{





  foreach ($metas_tiendas as $key => $value) {
  
  if ($value["nombre"] == "ACCESORIOS"){

  if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Tiendas" ){
            

      $today = date('Y-m-d');

      $startDate = date('Y-m-01', strtotime($today));

      $endDate = date('Y-m-t', strtotime($today));
if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){

$tienda = $_GET["tienda"];

}else{

$tienda = "null";

}
      


 $total_ventas = controladorVentasTiendas::ctrCargarVentasAccesoriosTienda($startDate, $endDate,$tienda);


                     
  
}

}else if ($value["nombre"] == "ACTIVACIONES"){

  if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Tiendas"){

  $today = date('Y-m-d');

  $startDate = date('Y-m-01', strtotime($today));

  $endDate = date('Y-m-t', strtotime($today));

      if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){

      $tienda = $_GET["tienda"];

      }else{

      $tienda = "null";

      }

 $total_ventas = controladorVentasTiendas::ctrCargarVentasActivacionesTiendas($startDate, $endDate, $tienda);




  }




  
                  

 }else if ($value["nombre"] == "ARPU"){

  if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Tiendas" ){

  $today = date('Y-m-d');

  $startDate = date('Y-m-01', strtotime($today));

  $endDate = date('Y-m-t', strtotime($today));


      if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){


      $tienda = $_GET["tienda"];


      }else{


      $tienda = "null";


      }


 $total_ventas = controladorVentasTiendas::ctrCargarVentasArpuPospagoTiendas($startDate, $endDate, $tienda);


  }

}else if ($value["nombre"] == "DTH"){

      if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Tiendas" ){

  $today = date('Y-m-d');

  $startDate = date('Y-m-01', strtotime($today));

  $endDate = date('Y-m-t', strtotime($today));


      if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){


      $tienda = $_GET["tienda"];


      }else{


      $tienda = "null";


      }

 $total_ventas = controladorVentasTiendas::ctrCargarVentasDTHTiendas($startDate, $endDate, $tienda);

}

}else if ($value["nombre"] == "KITS DIGITAL"){

 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Tiendas" ){


  $today = date('Y-m-d');

  $startDate = date('Y-m-01', strtotime($today));

  $endDate = date('Y-m-t', strtotime($today));


      if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){


      $tienda = $_GET["tienda"];


      }else{


      $tienda = "null";


      }


 $total_ventas = controladorVentasTiendas::ctrCargarVentasPrepagoDigitalTiendas($startDate, $endDate, $tienda);


  }


}else if ($value["nombre"] == "KITS PREPAGO"){

 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Tiendas" ){


  $today = date('Y-m-d');

  $startDate = date('Y-m-01', strtotime($today));

  $endDate = date('Y-m-t', strtotime($today));


      if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){


      $tienda = $_GET["tienda"];


      }else{


      $tienda = "null";


      }


 $total_ventas = controladorVentasTiendas::ctrCargarVentasPrepagoDigitalTiendas($startDate, $endDate, $tienda);


  }

    
}else if ($value["nombre"] == "POSPAGO"){
 
 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Tiendas" ){


  $today = date('Y-m-d');

  $startDate = date('Y-m-01', strtotime($today));

  $endDate = date('Y-m-t', strtotime($today));


      if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){


      $tienda = $_GET["tienda"];


      }else{


      $tienda = "null";


      }


 $total_ventas = controladorVentasTiendas::ctrCargarVentasPospagoTiendas($startDate, $endDate, $tienda);


  }


    
}else if ($value["nombre"] == "RECAUDACIONES"){

 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Tiendas" ){

  $today = date('Y-m-d');

  $startDate = date('Y-m-01', strtotime($today));

  $endDate = date('Y-m-t', strtotime($today));


      if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){


      $tienda = $_GET["tienda"];


      }else{


      $tienda = "null";


      }


 $total_ventas = controladorVentasTiendas::ctrCargarVentasRecaudacionesTiendas($startDate, $endDate, $tienda);


  }

    
}

                  date_default_timezone_set('America/Costa_Rica');

                  $today = date('Y-m-d');

                   $firstday = date('Y-m-01', strtotime($today));

             $lastday = date('Y-m-t', strtotime($today));

        // Convirtiendo en timestamp las fechas
        $fechainicio = strtotime($firstday);
        $fechafin = strtotime($lastday);
       
        // Incremento en 1 dia
        $diainc = 24*60*60;
       
        // Arreglo de dias habiles, inicianlizacion
        $diashabilesmes = array();
       
        // Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
        for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
                // Si el dia indicado, no es sabado o domingo es habil
                if (!in_array(date('N', $midia), array(7))) { // DOC: http://www.php.net/manual/es/function.date.php
                        // Si no es un dia feriado entonces es habil
                        if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
                                array_push($diashabilesmes, date('Y-m-d', $midia));
                        }
                }
        }

              // Convirtiendo en timestamp las fechas
        $fechainicio = strtotime($firstday);
        $fechafin = strtotime($today);
       
        // Incremento en 1 dia
        $diainc = 24*60*60;
       
        // Arreglo de dias habiles, inicianlizacion
        $diashabileshoy = array();
       
        // Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
        for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
                // Si el dia indicado, no es sabado o domingo es habil
                if (!in_array(date('N', $midia), array(7))) { // DOC: http://www.php.net/manual/es/function.date.php
                        // Si no es un dia feriado entonces es habil
                        if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
                                array_push($diashabileshoy, date('Y-m-d', $midia));
                        }
                }
        }
       
       /* var_dump(count($diashabilesmes));
        var_dump(count($diashabileshoy));
*/

          
/*  var_proyeccion_kits_prepago = datos_kits_prepago / Contador_de_dias_hoy * Contador_de_dias_mes
*/ $proyeccion = $total_ventas[0] / count($diashabileshoy) * count($diashabilesmes) ;
// echo '<pre>'; print_r($total_ventas[0]); echo '</pre>';
// echo '<pre>'; print_r($proyeccion); echo '</pre>';

$porcentaje = ($total_ventas[0]/$value[1])*100;

// echo '<pre>'; print_r($porcentaje); echo '</pre>';

$proyeccion_real = ($proyeccion/$value[1])*100;
// echo '<pre>'; print_r($proyeccion_real); echo '</pre>';


$proyeccion_real = $proyeccion_real - $porcentaje;
// echo '<pre>'; print_r($proyeccion_real); echo '</pre>';



//echo ".number_format($porcentaje,2)." %""'";

echo ' '.number_format($porcentaje,2)." %" . '';

$formattedNum = number_format($value[1], 0);


$formattedNum2 = number_format($total_ventas[0], 0);



 

              echo '
              <div class="progress-group">';

              

                        echo '<span class="progress-text">'.$value[0].'</span>
                          <span class="progress-number"><b>'. $formattedNum2 .'</b>/'. $formattedNum .' </span>';

                  
                  

                   echo' <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: '. $porcentaje .'%"></div>
                        <div class="progress-bar progress-bar-red" style="width: '. $proyeccion_real .'%"></div>
                   
                    </div>
                  </div>';

                }
}


  ?>
                 
</div> 
</div> 





            <section class="content">

                   <div class="box">

               <div class="box-header">

                VENTAS GENERALES
          
        </div>
            <!-- /.box-header -->
 
                <table class="table table-bordered table-striped dt-responsive display" id="tablasventasreporteventastiendas" width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>Pospago</th>
            <th>Kits Claro</th>
            <th>Kits Digital</th>
            <th>Accesorios</th>
            </tr>

          </thead>

          <tbody>

                  <?php
                  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                    date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTotales($startDate, $endDate);
/*              echo '<pre>'; print_r($ventas); echo '</pre>';
*/             
           


                  foreach ($ventas as $key => $value2) {


               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>

              <td>'.$value2["pospago"].'</td>
               <td>'.$value2["claro"].'</td>
               <td>'.$value2["digital"].'</td>
                <td>₡'. number_format($value2["kitsdisgital"],2,'.',',').'</td>
                        
                                         
            </tr>';

             }

                    ?>   

          </tbody>

    <tfoot >
      <tr>
        <td></td>
 
        <td  style="font-weight: bold;">Total:</td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
   
      </tr> 

          <!--  <td  style="font-weight: bold;"><?php echo(array_sum($array_dth));?></td>                
        <td  style="font-weight: bold;"><?php echo(array_sum($array_internet));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_pospago));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_gpon));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td> -->
                  
  </tfoot> 

        </table>




          </div>
 

<br id="boxtablasventaspospagoreporteventastiendas">

<br>
     
     <div class="box" >

               <div class="box-header">

                VENTAS POSPAGO
          
        </div>
            <!-- /.box-header -->
 
                <table class="table table-bordered table-striped dt-responsive display" id="tablasventaspospagoreporteventastiendas" width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>Gestor</th>
            <th>Plan Subsidiado</th>
            <th>Plan Aportados</th>
            <th>Financiados Puros</th>
            <th>Portabilidad</th>
            <th>Total</th>
            <th>Acciones</th>
            </tr>

          </thead>

          <tbody>

                  <?php
                  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                    date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

                              $ventas="";      

              $ventas = controladorVentasTiendas::ctrCargarVentasTablaPospago($startDate, $endDate);
/*              echo '<pre>'; print_r($ventas); echo '</pre>';
*/             
           


                  foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.$value2["gestor"].'</td>
              <td>'.$value2["subsidiado"].'</td>
               <td>'.$value2["aportado"].'</td>
               <td>'.$value2["financiado"].'</td>
              <td>'.$value2["portabilidad"].'</td> 
              <td>'.$value2["total"].'</td> 

             
              <td>            
                
                <div class="btn-group">
                  
                  <button class="btn btn-info btnVentasTiendasPospagoDetail" gestor="'.$value2["gestor"].'"  tienda="'.$value2["tienda"].'"  data-toggle="modal" id="btnVentasTiendasPospagoDetail" data-target="#modalVentasTiendasPospagoDetails"> <i class="fa fa-info-circle"></i></button>

                </div>

              </td>      
                                         
            </tr>';

             }

                    ?>   

          </tbody>

    <tfoot >
      <tr>
        <td></td>
        <td></td>      
        <td  style="font-weight: bold;">Total:</td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td></td>
   
      </tr> 

          <!--  <td  style="font-weight: bold;"><?php echo(array_sum($array_dth));?></td>                
        <td  style="font-weight: bold;"><?php echo(array_sum($array_internet));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_pospago));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_gpon));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td> -->
                  
  </tfoot> 

        </table>




          </div>


          
          <br id="boxtablasventaskitsclarodigitalreporteventastiendas">

          <br>

     <div class="box">

               <div class="box-header">

                VENTAS KITS DIGITAL
          
        </div>
            <!-- /.box-header -->
 
                <table class="table table-bordered table-striped dt-responsive display" id="tablasventaskitsdigitalreporteventastiendas" width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>Gestor</th>
             <th>Cantidad</th>
            <th>Total Sin IVA</th>           
            <th>Promedio</th>       
            <th>Acciones</th>
            </tr>

          </thead>

          <tbody>

                  <?php
                  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                    date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTablaKitsDigital($startDate, $endDate);
             
   


                  foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.$value2["gestor"].'</td>
              <td>'.$value2["cantidad"].'</td>
                             <td>₡'. number_format($value2["total"],2,'.',',').'</td>

                              <td>₡'. number_format($value2["promedio"],2,'.',',').'</td>

      
             
              <td>            
                
                <div class="btn-group">
                  
                          <button class="btn btn-info btnVentasTiendasKitsDigitalDetail" gestor="'.$value2["gestor"].'"  tienda="'.$value2["tienda"].'"  data-toggle="modal" id="btnVentasTiendasKitsDigitalDetail" data-target="#modalVentasTiendasKitsDigitalDetails"> <i class="fa fa-info-circle"></i></button>

                </div>

              </td>      
                                         
            </tr>';

             }

                    ?>   

          </tbody>

    <tfoot >
      <tr>
        <td></td>
        <td></td>      
        <td  style="font-weight: bold;">Total:</td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
                <td></td>
   
      </tr> 

          <!--  <td  style="font-weight: bold;"><?php echo(array_sum($array_dth));?></td>                
        <td  style="font-weight: bold;"><?php echo(array_sum($array_internet));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_pospago));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_gpon));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td> -->
                  
  </tfoot> 

        </table>




          </div>


             
                    <br id="boxtablasventaskitsclaroclaroreporteventastiendas">
     <br>

     <div class="box">

               <div class="box-header">

                VENTAS KITS CLARO
          
        </div>
            <!-- /.box-header -->
 
                <table class="table table-bordered table-striped dt-responsive display" id="tablasventaskitsclaroreporteventastiendas" width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>Gestor</th>
             <th>Cantidad</th>
            <th>Total Sin IVA</th>           
            <th>Promedio</th>       
            <th>Acciones</th>
            </tr>

          </thead>

          <tbody>

                  <?php
                  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                    date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTablaKitsClaro($startDate, $endDate);
/*              echo '<pre>'; print_r($ventas); echo '</pre>';
*/             
   


                  foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.$value2["gestor"].'</td>
              <td>'.$value2["cantidad"].'</td>
       <td>₡'. number_format($value2["total"],2,'.',',').'</td>

                              <td>₡'. number_format($value2["promedio"],2,'.',',').'</td>
      
             
              <td>            
                
                <div class="btn-group">
                  

                  <button class="btn btn-info btnVentasTiendasKitsClaroDetail" gestor="'.$value2["gestor"].'"  tienda="'.$value2["tienda"].'"  data-toggle="modal" id="btnVentasTiendasKitsClaroDetail" data-target="#modalVentasTiendasKitsClaroDetails"> <i class="fa fa-info-circle"></i></button>


                </div>

              </td>      
                                         
            </tr>';

             }

                    ?>   

          </tbody>

    <tfoot >
      <tr>
        <td></td>
        <td></td>      
        <td  style="font-weight: bold;">Total:</td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
                <td></td>
   
      </tr> 

          <!--  <td  style="font-weight: bold;"><?php echo(array_sum($array_dth));?></td>                
        <td  style="font-weight: bold;"><?php echo(array_sum($array_internet));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_pospago));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_gpon));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td> -->
                  
  </tfoot> 

        </table>

          
          <br id="boxtablasventasaccesoriosreporteventastiendas">
           <br>

     <div class="box">

               <div class="box-header">

                ACCESORIOS
          
        </div>
            <!-- /.box-header -->
 
                <table class="table table-bordered table-striped dt-responsive display" id="tablasventasaccesoriosreporteventastiendas" width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>Gestor</th>
             <th>Cantidad</th>
            <th>Total Sin IVA</th>           
            <th>Promedio</th>       
            <th>Acciones</th>
            </tr>

          </thead>

          <tbody>

                  <?php
                  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                    date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTablaAccesorios($startDate, $endDate);
/*              echo '<pre>'; print_r($ventas); echo '</pre>';
*/             
   


                  foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.$value2["gestor"].'</td>
              <td>'.$value2["cantidad"].'</td>
               <td>₡'. number_format($value2["total"],2,'.',',').'</td>

                              <td>₡'. number_format($value2["promedio"],2,'.',',').'</td>
      
             
              <td>            
                
                <div class="btn-group">
                  
                   <button class="btn btn-info btnVentasTiendasAccesoriosDetail" gestor="'.$value2["gestor"].'"  tienda="'.$value2["tienda"].'"  data-toggle="modal" id="btnVentasTiendasAccesoriosDetail" data-target="#modalVentasTiendasAccesoriosDetails"> <i class="fa fa-info-circle"></i></button>

                </div>

              </td>      
                                         
            </tr>';

             }

                    ?>   

          </tbody>

    <tfoot >
      <tr>
        <td></td>
        <td></td>      
        <td  style="font-weight: bold;">Total:</td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
                <td></td>
   
      </tr> 

          <!--  <td  style="font-weight: bold;"><?php echo(array_sum($array_dth));?></td>                
        <td  style="font-weight: bold;"><?php echo(array_sum($array_internet));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_pospago));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_gpon));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td> -->
                  
  </tfoot> 

        </table>




          </div>

          <br id="boxtablasventasrecaudacionesreporteventastiendas">

          <br>

           <div class="box">

               <div class="box-header">

                RECAUDACIONES
          
        </div>
            <!-- /.box-header -->
 
                <table class="table table-bordered table-striped dt-responsive display" id="tablasventasrecaudacionesreporteventastiendas" width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>Gestor</th>
             <th>Total</th>            
            <th>Acciones</th>
            </tr>

          </thead>

          <tbody>

                  <?php
                  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                    date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTablaRecaudaciones($startDate, $endDate);
             
   


                  foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.$value2["gestor"].'</td>
               <td>₡'. number_format($value2["total"],2,'.',',').'</td>

                            
                
             
              <td>            
                
                <div class="btn-group">
                  
                   <button class="btn btn-info btnVentasTiendasRecaudacionesDetail" gestor="'.$value2["gestor"].'"  tienda="'.$value2["tienda"].'"  data-toggle="modal" id="btnVentasTiendasRecaudacionesDetail" data-target="#modalVentasTiendasRecaudacionesDetails"> <i class="fa fa-info-circle"></i></button>

                </div>

              </td>      
                                         
            </tr>';

             }

                    ?>   

          </tbody>

    <tfoot >
      <tr>
        <td></td>
        <td></td>
        <td  style="font-weight: bold;">Total:</td>
   
        <td style="font-weight: bold;"></td>
                <td></td>
   
      </tr> 

          <!--  <td  style="font-weight: bold;"><?php echo(array_sum($array_dth));?></td>                
        <td  style="font-weight: bold;"><?php echo(array_sum($array_internet));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_pospago));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_gpon));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td> -->
                  
  </tfoot> 

        </table>




          </div>

          <br id="boxtablasventastaereporteventastiendas">

          <br>

           <div class="box">

               <div class="box-header">

                TAE
          
        </div>
            <!-- /.box-header -->
 
                <table class="table table-bordered table-striped dt-responsive display" id="tablasventastaereporteventastiendas" width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>Gestor</th>
            <th>Total</th>            
            <th>Acciones</th>
            </tr>

          </thead>

          <tbody>

                  <?php
                  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                    date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTablaTae($startDate, $endDate);
/*              echo '<pre>'; print_r($ventas); echo '</pre>';
*/             
   


                  foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.$value2["gestor"].'</td>
              <td class="myCOL">'.$value2["total"].'</td>
                
             
              <td>            
                
                <div class="btn-group">
                  
                   <button class="btn btn-info btnVentasTiendasTaeDetail" gestor="'.$value2["gestor"].'"  tienda="'.$value2["tienda"].'"  data-toggle="modal" id="btnVentasTiendasTaeDetail" data-target="#modalVentasTiendasTaeDetails"> <i class="fa fa-info-circle"></i></button>

                </div>

              </td>      
                                         
            </tr>';

             }

                    ?>   

          </tbody>

    <tfoot >
      <tr>
        <td></td>
        <td></td>
        <td  style="font-weight: bold;">Total:</td>
   
        <td style="font-weight: bold;"></td>
                <td></td>
   
      </tr> 

          <!--  <td  style="font-weight: bold;"><?php echo(array_sum($array_dth));?></td>                
        <td  style="font-weight: bold;"><?php echo(array_sum($array_internet));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_pospago));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_gpon));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td> -->
                  
  </tfoot> 

        </table>




          </div>

<!--            Link: <a href="#toTop" class="toTop">Scroll to TOP &uarr;</a>
 Target: <a accesoriosme="toTop"></a> -->


                    <br id="boxtablasventasactivacionesreporteventastiendas">

          <br>

           <div class="box">

               <div class="box-header">

                ACTIVACIONES
          
        </div>
            <!-- /.box-header -->
 
                <table class="table table-bordered table-striped dt-responsive display" id="tablasventasactivacionesreporteventastiendas" width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>Gestor</th>
            <th>Total</th>            
            <th>Acciones</th>
            </tr>

          </thead>

          <tbody>

                  <?php
                  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                    date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTablaActivaciones($startDate, $endDate);
             
   


                  foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.$value2["gestor"].'</td>
              <td>'.$value2["total"].'</td>
                
             
              <td>            
                
                <div class="btn-group">
                  
                   <button class="btn btn-info btnVentasTiendasActivacionesDetail" gestor="'.$value2["gestor"].'"  tienda="'.$value2["tienda"].'"  data-toggle="modal" id="btnVentasTiendasActivacionesDetail" data-target="#modalVentasTiendasActivacionesDetails"> <i class="fa fa-info-circle"></i></button>

                </div>

              </td>      
                                         
            </tr>';

             }

                    ?>   

          </tbody>

    <tfoot >
      <tr>
        <td></td>
        <td></td>
        <td  style="font-weight: bold;">Total:</td>
   
        <td style="font-weight: bold;"></td>
                <td></td>
   
      </tr> 

          <!--  <td  style="font-weight: bold;"><?php echo(array_sum($array_dth));?></td>                
        <td  style="font-weight: bold;"><?php echo(array_sum($array_internet));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_pospago));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_gpon));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td> -->
                  
  </tfoot> 

        </table>




          </div>



             <br>



    <div class="box">
      <div class="box-header with-border">

       
             <button  type="button" class="btn btn-default" id="rango1tiendas">

            <span>
              
              <i class="fa fa-calendar"></i> Rango de Fecha 1

            </span>

             <i class="fa fa-caret-down"></i>
            
            
          </button>

           <button  type="button" class="btn btn-default" id="rango2tiendas">

            <span>
              
              <i class="fa fa-calendar"></i> Rango de Fecha 2

            </span>

             <i class="fa fa-caret-down"></i>
            
            
          </button>
      
        <div class="box-tools pull-right">
           <button type="button" id="btnbuscartablacomparativatiendas" class="btn btn-primary">Buscar</button>

        </div>
          



  

<br>



<!-- <div class="form-group">
  <br> 
  <div class="input-group col-xs-12 col-md-8" >




  <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
  <select class="form-control input-lg "  name="tipoproductocomparatablasdth" id="tipoproductocomparatablasdth" >
      


<option disabled selected value="">Seleccionar...</option>

              <option value="DTH" >DTH</option>
              <option value="Internet" >Internet</option>


                           
              

            </select>

          </div>

      

 </div> -->

           <input type="hidden" id="dtdesde1tiendas" name="dtdesde1tiendas">
          <input type="hidden" id="dtdesde2tiendas" name="dtdesde2tiendas">
          <input type="hidden" id="dthasta1tiendas" name="dthasta1tiendas">
          <input type="hidden" id="dthasta2tiendas" name="dthasta2tiendas">


</div>




<div class="box-body">


   <table class="table table-bordered dt-responsive TablaComparativaTiendas" id="TablaComparativaTiendas" width="100%">
          
          <thead>
            
            <tr>
              
            <th>Tienda</th>
            <th>Pospago 1</th>
            <th>Pospago 2</th>
            
             <th>Diferencia</th>
            <th>Kits Claro 1</th>
            <th>Kits Claro 2</th>
             <th>Diferencia</th>
            <th>Kits Digital 1</th>
            <th>Kits Digital 2</th>
             <th>Diferencia</th>
            <th>Accesorios 1</th>
            <th>Accesorios 2</th>
             <th>Diferencia</th>

    

          

            </tr>
 
          </thead>

          <tbody>



                          
            

          </tbody>

              <tfoot >
      <tr>
       
        <td  style="font-weight: bold;">Total:</td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
        <td style="font-weight: bold;"></td>
   
      </tr> 

          <!--  <td  style="font-weight: bold;"><?php echo(array_sum($array_dth));?></td>                
        <td  style="font-weight: bold;"><?php echo(array_sum($array_internet));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_pospago));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_gpon));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td>
        <td  style="font-weight: bold;"><?php echo(array_sum($array_total));?></td> -->
                  
  </tfoot> 



        </table>





      </div>
      <!-- /.box-body -->

    </div>
    <!-- /.box -->



               <!-- 





                -->
      

                
           
              <br>

<?php  if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Tiendas" ) { ?>


    <div class="box">

               <div class="box-header">

                VENTAS TIENDAS SUPERVISOR
          
        </div>
            <!-- /.box-header -->
 
                <table class="table table-bordered table-striped dt-responsive display"  width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Supervisor</th>
            <th>Pospago</th>
            <th>Kits Claro</th>
            <th>Kits Digital</th>
            <th>Accesorios</th>
            </tr>

<?php 



            $ventasxsupervisor= "" ;
            $ventasxsupervisor = controladorVentasTiendas::ctrCargarVentasTotalesXSupervisortiendas($startDate, $endDate);
          
   


?>




          </thead>

          <tbody>

                  <?php
                  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                    date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

                            
              $ventasxsupervisor="";
              $ventasxsupervisor = controladorVentasTiendas::ctrCargarVentasTotalesXSupervisortiendas($startDate, $endDate);
  

           


                  foreach ($ventasxsupervisor as $key => $value2) {


               echo '<tr>
              
              <td>'.($key+1).'</td>                 
              <td>'.strtoupper($value2["nombre"]).'</td>
              <td>'.$value2["pospago"].'</td>
              <td>'.$value2["claro"].'</td>
              <td>'.$value2["digital"].'</td>
              <td>₡'. number_format($value2["accesorios"],2,'.',',').'</td>
                        
                                         
            </tr>';

             }

                    ?>   

          </tbody>


        </table>


          </div>


<?php } ?>
      

        </section>


           <!--=====================================
=            MODAL DETAIL POSPAGO          =
======================================-->



<!-- Modal -->
<div id="modalVentasTiendasTaeDetails" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">
   
    <div class="modal-content">

    
      <!--=====================================
=            MODAL HEADER          =
======================================-->

      <div class="modal-header" style="background:#3c8bdc; color: white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Detalle de Ventas</h4>

      </div>

      <!--=====================================
=            MODAL BODY          =
======================================-->

      <div class="modal-body">

       <div class="box-body">

           <div class="panel">INFORMACIÓN DETALLADA DE VENTAS</div>

             <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped dt-responsive" width="100%" id="tableVentasTiendaDetailsTae">
             <thead>
                   <tr>
                     <th style="width:10px">#</th>
                     <th>Tienda</th> 
                     <th>Gestor</th>                    
                     <th>Fecha Venta</th>
                     <th>Producto</th>
                     <th>Total</th>
                                                     
                   </tr>
                   </thead>  
                     <tbody id="tbodyid_tableVentasTiendaDetailsTae">

                     </tbody>

   <!--                       <tfoot id="tfootid_tableVentasCalleDetails">
                  
  </tfoot>  -->
                   </table> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



     


       </div>

      </div>

      <!--=====================================
=            MODAL FOOTER           =
======================================-->

      <div class="modal-footer">

      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

      </div>

 

    </div>

  </div>

</div>


           <!--=====================================
=            MODAL DETAIL ACTIVACIONES          =
======================================-->



<!-- Modal -->
<div id="modalVentasTiendasActivacionesDetails" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">
   
    <div class="modal-content">

    
      <!--=====================================
=            MODAL HEADER          =
======================================-->

      <div class="modal-header" style="background:#3c8bdc; color: white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Detalle de Ventas</h4>

      </div>

      <!--=====================================
=            MODAL BODY          =
======================================-->

      <div class="modal-body">

       <div class="box-body">

           <div class="panel">INFORMACIÓN DETALLADA DE VENTAS</div>

             <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped dt-responsive" width="100%" id="tableVentasTiendaDetailsActivaciones">
             <thead>
                   <tr>
                     <th style="width:10px">#</th>
                     <th>Tienda</th> 
                     <th>Gestor</th>
                     <th>Tipo Venta</th>
                     <th>Fecha Venta</th>
                     <th>Cedula</th>
                     <th>Nombre</th>
                                                     
                   </tr>
                   </thead>  
                     <tbody id="tbodyid_tableVentasTiendaDetailsActivaciones">

                     </tbody>

   <!--                       <tfoot id="tfootid_tableVentasCalleDetails">
                  
  </tfoot>  -->
                   </table> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



     


       </div>

      </div>

      <!--=====================================
=            MODAL FOOTER           =
======================================-->

      <div class="modal-footer">

      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

      </div>

 

    </div>

  </div>

</div>
     

           
   <!--=====================================
=            MODAL DETAIL POSPAGO          =
======================================-->



<!-- Modal -->
<div id="modalVentasTiendasPospagoDetails" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">
   
    <div class="modal-content">

    
      <!--=====================================
=            MODAL HEADER          =
======================================-->

      <div class="modal-header" style="background:#3c8bdc; color: white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Detalle de Ventas</h4>

      </div>

      <!--=====================================
=            MODAL BODY          =
======================================-->

      <div class="modal-body">

       <div class="box-body">

           <div class="panel">INFORMACIÓN DETALLADA DE VENTAS</div>

             <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped dt-responsive tableVentasTiendaDetailsPospago" width="100%" id="tableVentasTiendaDetailsPospago">
             <thead>
                   <tr>
                     <th style="width:10px">#</th>
                     <th>Tienda</th> 
                     <th>Gestor</th>
                     <th>Tipo Venta</th>
                     <th>Fecha Venta</th>
                     <th>Cedula</th>
                     <th>Nombre</th>
                                                     
                   </tr>
                   </thead>  
                     <tbody id="tbodyid_tableVentasTiendaDetailsPospago">

                     </tbody>

   <!--                       <tfoot id="tfootid_tableVentasCalleDetails">
                  
  </tfoot>  -->
                   </table> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



     


       </div>

      </div>

      <!--=====================================
=            MODAL FOOTER           =
======================================-->

      <div class="modal-footer">

      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

      </div>

 

    </div>

  </div>

</div>


   <!--=====================================
=            MODAL DETAIL KITS CLARO DIGITAL          =
======================================-->



<!-- Modal -->
<div id="modalVentasTiendasKitsDigitalDetails" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">
   
    <div class="modal-content">

    
      <!--=====================================
=            MODAL HEADER          =
======================================-->

      <div class="modal-header" style="background:#3c8bdc; color: white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Detalle de Ventas</h4>

      </div>

      <!--=====================================
=            MODAL BODY          =
======================================-->

      <div class="modal-body">

       <div class="box-body">

           <div class="panel">INFORMACIÓN DETALLADA DE VENTAS</div>

             <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped dt-responsive" width="100%" id="tableVentasTiendaDetailsKitsDigital">
             <thead>
                   <tr>
                     <th style="width:10px">#</th>
                     <th>Tienda</th> 
                     <th>Gestor</th>
                     <th>Cantidad</th>
                     <th>Articulo</th>
                     <th>Total</th>
                     <th>Promedio</th>
                                                     
                   </tr>
                   </thead>  
                     <tbody id="tbodyid_tableVentasTiendaDetailsKitsDigital">

                     </tbody>

   <!--                       <tfoot id="tfootid_tableVentasCalleDetails">
                  
  </tfoot>  -->
                   </table> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



     


       </div>

      </div>

      <!--=====================================
=            MODAL FOOTER           =
======================================-->

      <div class="modal-footer">

      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

      </div>

 

    </div>

  </div>

</div>

 <!--=====================================
=            MODAL DETAIL KITS CLARO CLARO          =
======================================-->



<!-- Modal -->
<div id="modalVentasTiendasKitsClaroDetails" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">
   
    <div class="modal-content">

    
      <!--=====================================
=            MODAL HEADER          =
======================================-->

      <div class="modal-header" style="background:#3c8bdc; color: white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Detalle de Ventas</h4>

      </div>

      <!--=====================================
=            MODAL BODY          =
======================================-->

      <div class="modal-body">

       <div class="box-body">

           <div class="panel">INFORMACIÓN DETALLADA DE VENTAS</div>

             <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped dt-responsive" width="100%" id="tableVentasTiendaDetailsKitsClaro">
             <thead>
                   <tr>
                     <th style="width:10px">#</th>
                     <th>Tienda</th> 
                     <th>Gestor</th>
                     <th>Cantidad</th>
                     <th>Articulo</th>
                     <th>Total</th>
                     <th>Promedio</th>
                                                     
                   </tr>
                   </thead>  
                     <tbody id="tbodyid_tableVentasTiendaDetailsKitsClaro">

                     </tbody>

   <!--                       <tfoot id="tfootid_tableVentasCalleDetails">
                  
  </tfoot>  -->
                   </table> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



     


       </div>

      </div>

      <!--=====================================
=            MODAL FOOTER           =
======================================-->

      <div class="modal-footer">

      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

      </div>

 

    </div>

  </div>

</div>

<!--=====================================
=            MODAL DETAIL KITS DIGITAL         =
======================================-->



<!-- Modal -->
<div id="modalVentasTiendasAccesoriosDetails" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">
   
    <div class="modal-content">

    
      <!--=====================================
=            MODAL HEADER          =
======================================-->

      <div class="modal-header" style="background:#3c8bdc; color: white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Detalle de Ventas</h4>

      </div>

      <!--=====================================
=            MODAL BODY          =
======================================-->

      <div class="modal-body">

       <div class="box-body">

           <div class="panel">INFORMACIÓN DETALLADA DE VENTAS</div>

             <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped dt-responsive" width="100%" id="tableVentasTiendaDetailsAccesorios">
             <thead>
                   <tr>
                     <th style="width:10px">#</th>
                     <th>Tienda</th> 
                     <th>Gestor</th>
                     <th>Cantidad</th>
                     <th>Articulo</th>
                     <th>Total</th>
                     <th>Promedio</th>
                                                     
                   </tr>
                   </thead>  
                     <tbody id="tbodyid_tableVentasTiendaDetailsAccesorios">

                     </tbody>

   <!--                       <tfoot id="tfootid_tableVentasCalleDetails">
                  
  </tfoot>  -->
                   </table> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



     


       </div>

      </div>

      <!--=====================================
=            MODAL FOOTER           =
======================================-->

      <div class="modal-footer">

      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

      </div>

 

    </div>

  </div>

</div>

<!--=====================================
=            MODAL DETAIL RECAUDACIONES         =
======================================-->



<!-- Modal -->
<div id="modalVentasTiendasRecaudacionesDetails" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">
   
    <div class="modal-content">

    
      <!--=====================================
=            MODAL HEADER          =
======================================-->

      <div class="modal-header" style="background:#3c8bdc; color: white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Detalle de Ventas</h4>

      </div>

      <!--=====================================
=            MODAL BODY          =
======================================-->

      <div class="modal-body">

       <div class="box-body">

           <div class="panel">INFORMACIÓN DETALLADA DE VENTAS</div>

             <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped dt-responsive" width="100%" id="tableVentasTiendaDetailRecaudaciones">
             <thead>
                   <tr>
                     <th style="width:10px">#</th>
                     <th>Tienda</th> 
                     <th>Gestor</th>
                     <th>Fecha Ingreso</th>
                     <th>Cédula</th>
                     <th>Nombre</th>
                     <th>Tipo</th>
                     <th>Monto</th>
                                                     
                   </tr>
                   </thead>  
                     <tbody id="tbodyid_tableVentasTiendaDetailRecaudaciones">

                     </tbody>

<!--      <tfoot >
      <tr>
        <td></td>
        <td></td>
         <td></td>
        <td></td>
         <td></td>
        <td></td>
        <td  style="font-weight: bold;">Total:</td>
   
        <td style="font-weight: bold;"></td>
                   
      </tr> 

  </tfoot>  -->
                   </table> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



     


       </div>

      </div>

      <!--=====================================
=            MODAL FOOTER           =
======================================-->

      <div class="modal-footer">

      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

      </div>

 

    </div>

  </div>

</div>