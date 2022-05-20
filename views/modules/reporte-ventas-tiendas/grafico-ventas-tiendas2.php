<?php

error_reporting(0);

 
  if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                        $today = date('Y-m-d');
 
                    $startDate =date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));

                   }


if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){


 $totalventas = controladorVentasTiendas::ctrventastiendas($startDate, $endDate); 
/* echo '<pre>'; print_r($totalventas); echo '</pre>';

 exit();*/
 
          

}

  ?>

  <!-- GRAFICO -->
                 <div class="card">

                 <div class="card-header">
                <h3 class="card-title">Grafico de Ventas</h3>

              </div>
                <!-- /.card-header -->
              <div class="card-body">
   
                    <div class="row">

                      <div class="col-12">

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
                  <input type="checkbox" class="minimal" checked id="chk_kitsclaro_digital_grafico_ventas_tiendas"> KITS PREPAGO
                </label> &nbsp;&nbsp;
                   <label style="color: #FFC0CB">
                  <input type="checkbox" class="minimal" checked id="chk_kitsdigital_grafico_ventas_tiendas"> KITS PREPAGO
                </label>
              </div>
              <div class="chart" id="renueve-chart-tiendas" style="height: 300px;"></div>
            </div>


    
                        
  </div> 

                    </div>  
              </div>
              <!-- /.card-body -->
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
      labels: ['POSPAGO', 'KITS CLARO', 'KITS PREPAGO' , 'ACCESORIOS'],
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
      labels: ['POSPAGO', 'KITS CLARO', 'KITS PREPAGO' , 'ACCESORIOS'],
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
      labels: ['POSPAGO', 'KITS CLARO', 'KITS PREPAGO' ],
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
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['KITS CLARO', 'KITS PREPAGO' , 'ACCESORIOS'],
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
      labels: ['KITS CLARO', 'KITS PREPAGO' ],
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
      labels: ['POSPAGO', 'KITS CLARO', 'KITS PREPAGO' , 'ACCESORIOS'],
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
      labels: ['ACCESORIOS', 'KITS CLARO', 'KITS PREPAGO' ],
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
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['POSPAGO', 'KITS CLARO','KITS PREPAGO' ],
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
      labels: ['KITS PREPAGO', 'KITS CLARO' ],
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
      labels: ['POSPAGO', 'KITS CLARO', 'KITS PREPAGO' , 'ACCESORIOS'],
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
      labels: ['ACCESORIOS', 'POSPAGO', 'KITS PREPAGO' ],
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
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['POSPAGO', 'KITS CLARO','KITS PREPAGO' ],
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
      labels: ['KITS PREPAGO', 'KITS CLARO' ],
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
      labels: ['KITS PREPAGO'],
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
      labels: ['POSPAGO', 'KITS CLARO', 'KITS PREPAGO' , 'ACCESORIOS'],
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
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['KITS CLARO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['POSPAGO', 'KITS CLARO','KITS PREPAGO' ],
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
      labels: ['KITS PREPAGO', 'KITS CLARO' ],
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
      labels: ['KITS PREPAGO'],
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
      labels: ['POSPAGO', 'KITS CLARO', 'KITS PREPAGO' , 'ACCESORIOS'],
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
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['KITS CLARO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['POSPAGO', 'KITS CLARO','KITS PREPAGO' ],
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
      labels: ['KITS PREPAGO', 'KITS CLARO' ],
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
      labels: ['KITS PREPAGO'],
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
      labels: ['POSPAGO', 'KITS CLARO', 'KITS PREPAGO' , 'ACCESORIOS'],
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
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['KITS CLARO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['POSPAGO', 'KITS CLARO','KITS PREPAGO' ],
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
      labels: ['KITS PREPAGO', 'KITS CLARO' ],
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
      labels: ['KITS PREPAGO'],
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
      labels: ['POSPAGO', 'KITS CLARO', 'KITS PREPAGO' , 'ACCESORIOS'],
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
      labels: ['POSPAGO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['KITS CLARO', 'ACCESORIOS', 'KITS PREPAGO' ],
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
      labels: ['POSPAGO', 'KITS CLARO','KITS PREPAGO' ],
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
      labels: ['KITS PREPAGO', 'KITS CLARO' ],
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
      labels: ['KITS PREPAGO'],
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


  <!-- CUADROS -->
                 <div class="card">

                 <div class="card-header">
                <h3 class="card-title">             <?php 


echo'<p class="text-center"> <strong>Datos de Ventas del ' .  $startDate . ' al ' .  $endDate .  '</strong> </p>';
           

  ?></h3>

              </div>
                <!-- /.card-header -->
              <div class="card-body">
   
                    <div class="row">

                      


 <div class="col-lg-3 col-xs-6">


      
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php



  $vartienda="%";





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
               <p>Kits Prepago </p>

            
              

             
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

              <p>Arpu Prepago</p>
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

<!--                 <div class="col-lg-3 col-xs-6">
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
        </div> -->


      
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

              </div>
              <!-- /.card-body -->
            </div>


            <!-- FIN CUADROS -->




  <div class="form-group">
  <br> 
  <div class="input-group col-xs-12 col-md-4" >

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



/*if(isset($_GET["tienda"]) && $_GET["tienda"] != "null"){?>
          
<option disabled selected value="<?php echo $_GET["tienda"] ?>"><?php echo $_GET["tienda"] ?></option>

 <?php
}else{?>

<option selected value="">Todas</option>

<?php
}*/

?>

<option selected value="">Todas</option>
                           
                <?php 


                foreach ($tiendas as $key => $value): 

    
 echo '<option value=' .$value["idtbl_tiendas"] .' >'. $value["nombre"] .' </option>';


                  
          

                
                endforeach ?> 

            </select>

          </div>

        <?php }else{



        } 

        ?>

 </div>
 <script>

let paramstienda = new URLSearchParams(location.search);
var tienda = paramstienda.get('tienda');
console.log("tienda", tienda);

$("#reporte_tiendas").val(tienda);

 </script>


   <?php

    date_default_timezone_set('America/Costa_Rica');

    $today = date('Y-m-d');

    $startDate = date('Y-m-01', strtotime($today));

    $endDate = date('Y-m-t', strtotime($today));






 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor"){


if(isset($_GET["ID"]) && $_GET["ID"]!= "null"){

$tienda = $_GET["ID"];

}else{

$tienda = "null";


}

  $metas_tiendas = controladorVentasTiendas::ctrCargarMetasTiendas($startDate, $endDate, $tienda);



 }else{


  $metas_tiendas = controladorVentasTiendas::ctrCargarMetasTiendas($startDate, $endDate, $tienda);




 }


/*echo '<pre>'; print_r($metas_tiendas); echo '</pre>';

exit();*/

  $total_ventas=0;

  if($metas_tiendas == null){

echo '<div class ="row">

    <div class="col-md-4">
                    <p class="text-center">
                      <strong>Metas Mensuales</strong>
                    </p>
 <div class="progress-group">
                      SIN METAS
                      <span class="float-right"><b>0</b>/0</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 0%"></div>
                      </div>
                    </div>';

  }else{

    echo ' 
    <div class ="row">

    <div class="col-md-4">
                    <p class="text-center">
                      <strong>Metas Mensuales</strong>
                    </p>';

      foreach ($metas_tiendas as $key => $value) {
  
  if ($value["nombre"] == "ACCESORIOS"){

  if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor" ){
            

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

  if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor"){

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

  if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor" ){

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

      if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor" ){

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

}else if ($value["nombre"] == "KITS PREPAGO"){

 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor" ){


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

 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor" ){


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
 
 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor" ){


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

 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor" ){

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

    
}else if ($value["nombre"] == "META LLAVE"){

 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor" ){

  $today = date('Y-m-d');

  $startDate = date('Y-m-01', strtotime($today));

  $endDate = date('Y-m-t', strtotime($today));


      if(isset($_GET["tienda"]) && $_GET["tienda"]!= "null"){


      $tienda = $_GET["tienda"];


      }else{


      $tienda = "null";


      }


 $total_ventas = controladorVentasTiendas::ctrCargarVentasMetaLlaveTiendas($startDate, $endDate, $tienda);


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


echo '    <div class="progress-group">
                      '.$value[0].'
                      <span class="float-right"><b>'. $formattedNum2 .'</b>/'. $formattedNum .'</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: '. $porcentaje .'%"></div>
                        <div class="progress-bar bg-danger" style="width: '. $proyeccion_real .'%"></div>

                      </div>
                    </div>';
 

         

                }
}

echo '</div>';

  


  ?>

</div> 

<br>


<!-- TABLA INICIO CIERRE TIENDAS -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  CONTROL DE INDEXADO DE CONTRATOS </h3>
                    <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> 

              </div>
                <!-- /.card-header -->
              <div class="card-body">

                    <div class="col-md-12">
                    <p class="text-center">
                      <strong>CONTROL DE INDEXADO DE CONTRATOS</strong>
                    </p>

              <table class="table table-bordered table-striped dt-responsive display tablas" id="tablaIndexadoContratos" width="100%">

          
          
          <thead>
            
            <tr>              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>BackOffice</th>
            <th>Total Ventas</th> 
            <th>Verde 1-2 días </th>
            <th>Amarillo 3-4 días</th>
            <th>Rojo >5 días</th>
            <th>Indexados</th>          
            </tr>

          </thead>

          <tbody>

                  <?php

      
                    if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                        $today = date('Y-m-d');

                    $startDate =date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));

                   }
                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarContratosIndexados($startDate,$endDate);
/*              echo '<pre>'; print_r($ventas); echo '</pre>';
             
              exit();*/
           


                  foreach ($ventas as $key => $value2) {


               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>

              <td>'.strtoupper($value2["backoffice"]).'</td>

              <td class="bg-info">'.$value2["totalventas"].'</td>
              <td class="bg-success">'.$value2["verde"].'</td>
              <td class="bg-warning">'.$value2["amarillo"].'</td>
              <td class="bg-danger">'.$value2["rojo"].'</td>
              <td class="bg-primary">'.$value2["indexadas"].'</td>
                        
                                         
            </tr>';

             }

                    ?>   

          </tbody>



        </table>  



      

</div> 

      </div>
              <!-- /.card-body -->
            </div>

</div> 

<!-- TABLA INICIO CIERRE TIENDAS -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  INICIO CIERRE TIENDAS </h3>
                    <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> 

              </div>
                <!-- /.card-header -->
              <div class="card-body">

                    <div class="col-md-12">
                    <p class="text-center">
                      <strong>INICIO CIERRE TIENDAS</strong>
                    </p>

              <table class="table table-bordered table-striped dt-responsive display tablaEstadoTiendas" id="tablaEstadoTiendas" width="100%">

          
          
          <thead>
            
            <tr>              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>Estado</th>
            <th>Estado2</th>
            <th>Acciones</th>           
            </tr>

          </thead>

          <tbody>

                  <?php

      
                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarEstadoTiendas();
            /*  echo '<pre>'; print_r($ventas); echo '</pre>';
             
              exit();*/
           


                  foreach ($ventas as $key => $value2) {


               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["nombre"]).'</td>'; 

              if($value2["estado"]=="Abierto"){

/* echo '<td>'.strtoupper($value2["estado"]).'</td>';*/
echo "<td> <input type='hidden' value='ABIERTO'> <div class='d-flex justify-content-center'><span title='ABIERTO' style='display:inline;text-align:center; color: green;'><i style='text-align:center;' class='fa fa-check-circle fa-3x text-infomargin-left-5 add-tooltip' aria-hidden='true' data-original-title='ABIERTO'data-html='true'></i></span>&nbsp</div></td>";

              }elseif($value2["estado"]=="No Disponible"){

echo "<td> <input type='hidden' value='NO DISPONIBLE'><div class='d-flex justify-content-center'><span title='NO DISPONIBLE' style='display:inline; color: blue;'><i style='text-align:center;' class='fas fa-exclamation-circle fa-3x text-infomargin-left-5 add-tooltip' aria-hidden='true' data-original-title='NO DISPONIBLE'data-html='true'></i></span>&nbsp</div></td>";
              }else{

echo "<td> <input type='hidden' value='CERRADO'><div class='d-flex justify-content-center'><span title='CERRADO' style='display:inline; color: red;'><i style='text-align:center;' class='fa fa-times-circle fa-3x text-infomargin-left-5 add-tooltip' aria-hidden='true' data-original-title='CERRADO'data-html='true'></i></span>&nbsp</div></td>";
              }

              echo '<td>'.strtoupper($value2["estado"]).'</td>';
             
                echo '<td> <div class="btn-group d-flex justify-content-center">
                  
                  <button class="btn btn-info btnEstadoTiendas" idtienda="'.$value2["idtienda"].'"  id="btnEstadoTiendas"> <i class="fa fa-info-circle"></i></button>

                </div> 

                </td>
                        
                                         
            </tr>';

             }

                    ?>   

          </tbody>



        </table>  



      

</div> 

      </div>
              <!-- /.card-body -->
            </div>

            <!-- TABLA CRITICAS BO -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  CRITICAS POR BACKOFFICE </h3>
                    <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> 

              </div>
                <!-- /.card-header -->
              <div class="card-body">

                    <div class="col-md-12">
                    <p class="text-center">
                      <strong>CRITICAS POR BACKOFFICE</strong>
                    </p>

              <table class="table table-bordered table-striped dt-responsive display tablas" id="tablaCriticasxBO" width="100%">

          
          
          <thead>
            
            <tr>              
            <th style="width:10px">#</th>
            <th>BackOffice</th>
            <th>Cantidad</th>        
            </tr>

          </thead>

          <tbody>

                  <?php

      
              

              $today = date('Y-m-d');

              $startDate =date('Y-m-01', strtotime($today."- 1 month"));

              $endDate = date('Y-m-t', strtotime($today."- 1 month"));

               
                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarCriticasxBO($startDate,$endDate);
           /*   echo '<pre>'; print_r($ventas); echo '</pre>';
             
              exit();*/
           


                  foreach ($ventas as $key => $value2) {


               echo '<tr>
              
              <td>'.($key+1).'</td>     
         
             
              <td>'.strtoupper($value2["bo"]).'</td>
              <td>'.$value2["total"].'</td>
            
                        
                                         
            </tr>';

             }

                    ?>   

          </tbody>



        </table>  



      

</div> 

      </div>
              <!-- /.card-body -->
            </div>


         <!-- TABLA NO ENCOMIENDAS -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  NO ENVIADOS A ENCOMIENDAS </h3>
                    <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> 

              </div>
                <!-- /.card-header -->
              <div class="card-body">

                    <div class="col-md-12">
                    <p class="text-center">
                      <strong>NO ENVIADOS A ENCOMIENDAS</strong>
                    </p>

              <table class="table table-bordered table-striped dt-responsive display tablas" id="tablaNoEncomienda" width="100%">

          
          
          <thead>
            
            <tr>              
            <th style="width:10px">#</th>
            <th>Tiendas</th>
            <th>BackOffice</th>
            <th>Cantidad</th>        
            </tr>

          </thead>

          <tbody>

                  <?php

      
                     

               
                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarPendientesEncomiendas();
           /*   echo '<pre>'; print_r($ventas); echo '</pre>';
             
              exit();*/
           
                  foreach ($ventas as $key => $value2) {


               echo '<tr>
              
              <td>'.($key+1).'</td>     
         
             <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.strtoupper($value2["backoffice"]).'</td>
              <td>'.$value2["pendientes"].'</td>
            
                        
                                         
            </tr>';

             }

                    ?>   

          </tbody>



        </table>  



      

</div> 

      </div>
              <!-- /.card-body -->
            </div>



<!-- TABLA VENTAS GENERALES -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  VENTAS GENERALES </h3>
                    <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> 

              </div>
                <!-- /.card-header -->
              <div class="card-body">
   
                    

                <table class="table table-bordered table-striped dt-responsive display" id="tablasventasreporteventastiendas" width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Tienda</th>
            <th>Pospago</th>
            <th>Kits Claro</th>
            <th>Kits Prepago</th>
            <th>Accesorios</th>
            </tr>

          </thead>

          <tbody>

                  <?php

                    if(isset($_GET["startDate"]) && $_GET["startDate"] != "null"){

               $startDate = $_GET["startDate"];

               $endDate = $_GET["endDate"];

                   }else{


                        $today = date('Y-m-d');

                    $startDate =date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));

                   }
                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTotales($startDate, $endDate);
              //echo '<pre>'; print_r($ventas); echo '</pre>';
             
           


                  foreach ($ventas as $key => $value2) {


               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>

              <td>'.$value2["pospago"].'</td>
               <td>'.$value2["claro"].'</td>
               <td>'.$value2["digital"].'</td>
                <td>'. number_format($value2["kitsdisgital"],2,'.',',').'</td>
                        
                                         
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

                 
  </tfoot> 

        </table>  

                      

    
                        


              </div>
              <!-- /.card-body -->
            </div>


            <!-- FIN TABLA VENTAS GENERALES  -->




     
 <!-- TABLA VENTAS POSPAGO -->


<!-- <br id="boxtablasventaspospagoreporteventastiendas">

<br>

                 <div class="card">

                 <div class="card-header">
                <h3 class="card-title">  VENTAS POSPAGO </h3>

              </div>
              <div class="card-body">
   
                    

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
 
             $ventas="";      

              $ventas = controladorVentasTiendas::ctrCargarVentasTablaPospago($startDate, $endDate);
             
           

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

                  
  </tfoot> 

        </table>

            </div>
            </div> -->


            <!-- FIN TABLA VENTAS POSPAGO  -->




          
          <span id="boxtablasventaskitsclarodigitalreporteventastiendas">  </span>

          
          <!-- TABLA VENTAS KITS PREPAGO -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  VENTAS KITS PREPAGO </h3>

                   <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>

              </div>
                <!-- /.card-header -->
              <div class="card-body">
   
                    

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
        

                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTablaKitsDigital($startDate, $endDate);
             
   


                  foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.$value2["gestor"].'</td>
              <td>'.$value2["cantidad"].'</td>
              <td>'. $value2["total"].'</td>
              <td>'. $value2["promedio"].'</td>     
             
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

                  
  </tfoot> 

        </table>

            </div>
              <!-- /.card-body -->
            </div>


            <!-- FIN TABLA VENTAS KITS PREPAGO  -->


             
               <span id="boxtablasventaskitsclaroclaroreporteventastiendas">  </span>


          <!-- TABLA VENTAS KITS CLARO -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  VENTAS KITS CLARO </h3>

                   <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>

              </div>
                <!-- /.card-header -->
              <div class="card-body">
   
                    

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
               <td>'.$value2["total"].'</td>
              <td>'.$value2["promedio"].'</td>   
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

                  
  </tfoot> 

        </table>

            </div>
              <!-- /.card-body -->
            </div>


            <!-- FIN TABLA VENTAS KITS CLARO  -->







          
                          <span id="boxtablasventasaccesoriosreporteventastiendas">  </span>



          <!-- TABLA VENTAS ACCESORIOS -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  VENTAS ACCESORIOS </h3>
                   <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>

              </div>
                <!-- /.card-header -->
              <div class="card-body">
   
                    
 
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
              <td>'.$value2["total"].'</td>
              <td>'.$value2["promedio"].'</td> 
      
             
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


                  
  </tfoot> 

        </table>

            </div>
              <!-- /.card-body -->
            </div>


            <!-- FIN TABLA VENTAS RECAUDACIONES  -->



       
  <span id="boxtablasventasrecaudacionesreporteventastiendas">  </span>



                    <!-- TABLA VENTAS ACCESORIOS -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  VENTAS RECAUDACIONES </h3>
                   <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>

              </div>
                <!-- /.card-header -->
              <div class="card-body">
   
                    
 
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


                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTablaRecaudaciones($startDate, $endDate);
             
   


                  foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.$value2["gestor"].'</td>
               <td>'.$value2["total"].'</td>
                                     
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

                  
  </tfoot> 

        </table>

            </div>
              <!-- /.card-body -->
            </div>


            <!-- FIN TABLA VENTAS RECAUDACIONES  -->




            <span id="boxtablasventastaereporteventastiendas">  </span>


                              <!-- TABLA VENTAS TAE -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  VENTAS TAE </h3>
                   <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>

              </div>
                <!-- /.card-header -->
              <div class="card-body">
   
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
                            
              $ventas="";
              $ventas = controladorVentasTiendas::ctrCargarVentasTablaTae($startDate, $endDate);
/*              echo '<pre>'; print_r($ventas); echo '</pre>';
*/             
   


                  foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>         
         
              <td>'.strtoupper($value2["tienda"]).'</td>
              <td>'.$value2["gestor"].'</td>
                <td>'.$value2["total"].'</td>                
             
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


                  
  </tfoot> 

        </table>

            </div>
              <!-- /.card-body -->
            </div>


            <!-- FIN TABLA VENTAS TAE  -->





                      <span id="boxtablasventasactivacionesreporteventastiendas">  </span>



                                        <!-- TABLA VENTAS ACTIVACIONES -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  VENTAS ACTIVACIONES </h3>
                   <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>

              </div>
                <!-- /.card-header -->
              <div class="card-body">
   
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

                  
  </tfoot> 

        </table>


            </div>
              <!-- /.card-body -->
            </div>


            <!-- FIN TABLA VENTAS ACTIVACIONES  -->

           
                                        <!-- TABLA VENTAS COMPARAR -->
                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title">  COMPARAR VENTAS </h3>
                   <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
               

         

              </div>
                <!-- /.card-header -->
              <div class="card-body">

                    <button  type="button" class="btn btn-default" id="rango1tiendas">

            <span>
              
              <i class="fa fa-calendar"></i> Rango Fecha 1

            </span>

             <i class="fa fa-caret-down"></i>
            
            
          </button>

           <button  type="button" class="btn btn-default" id="rango2tiendas">

            <span>
              
              <i class="fa fa-calendar"></i> Rango Fecha 2

            </span>

             <i class="fa fa-caret-down"></i>
            
            
          </button>
      
        <div class="float-right">
           <button type="button" id="btnbuscartablacomparativatiendas" class="btn btn-primary">Buscar</button>

        </div>

       <input type="hidden" id="dtdesde1tiendas" name="dtdesde1tiendas">
          <input type="hidden" id="dtdesde2tiendas" name="dtdesde2tiendas">
          <input type="hidden" id="dthasta1tiendas" name="dthasta1tiendas">
          <input type="hidden" id="dthasta2tiendas" name="dthasta2tiendas">

          <br>
          <br>
   
                   <table class="table table-bordered dt-responsive TablaComparativaTiendas" id="TablaComparativaTiendas" width="100%">
          
          <thead>
            
            <tr>
              
            <th>Tienda</th>
            <th>Supervisor</th>
            <th>Pospago 1</th>
            <th>Pospago 2</th>
            
             <th>Diferencia</th>
            <th>Kits Claro 1</th>
            <th>Kits Claro 2</th>
             <th>Diferencia</th>
            <th>Kits Prepago 1</th>
            <th>Kits Prepago 2</th>
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
        
       <td style="font-weight: bold;"></td>
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

                  
  </tfoot> 



        </table>
          

            </div>
              <!-- /.card-body -->
            </div>


            <!-- FIN TABLA COMPARAR  -->


      
                
           
                                    <span id="boxtablasventasactivacionesreporteventastiendas">  </span>


                                                      <!-- TABLA VENTAS X SUPERVISOR -->

            <?php  if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor" ) { ?>

                 <div class="card collapsed-card">

                 <div class="card-header">
                <h3 class="card-title"> VENTAS TIENDAS SUPERVISOR </h3>
                   <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>

              </div>
                <!-- /.card-header -->
              <div class="card-body">
   
                <table class="table table-bordered table-striped dt-responsive display"  width="100%">

          
          
          <thead>
            
            <tr>
              
            <th style="width:10px">#</th>
            <th>Supervisor</th>
            <th>Pospago</th>
            <th>Kits Claro</th>
            <th>Kits Prepago</th>
            <th>Accesorios</th>
            </tr>

<?php 



            $ventasxsupervisor= "" ;
            $ventasxsupervisor = controladorVentasTiendas::ctrCargarVentasTotalesXSupervisortiendas($startDate, $endDate);
          
   


?>




          </thead>

          <tbody>

                  <?php
                            
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
              <!-- /.card-body -->
            </div>

            <?php } ?>


           <!--=====================================
=            MODAL ESTADO TIENDAS          =
======================================-->



     <div class="modal fade" id="modalEstadoTiendas">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Acciones</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                   <table class="table table-bordered table-striped dt-responsive" width="100%" id="tableDetalleEstadoTiendas">
             <thead>
                   <tr>
                     <th style="width:10px">#</th>
                     <th>Tienda</th> 
                     <th>Gestor</th>                    
                     <th>Accion</th>
                     <th>Hora</th>
                     
                                                     
                   </tr>
                   </thead>  
                     <tbody id="tbodyid_tableDetalleEstadoTiendas">

                     </tbody>


                   </table> 
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
         </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


           <!--=====================================
=            MODAL DETAIL TAE          =
======================================-->



     <div class="modal fade" id="modalVentasTiendasTaeDetails">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Ventas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

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


                   </table> 
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
         </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


                 <!--=====================================
=            MODAL DETAIL ACTIVACIONES          =
======================================-->



     <div class="modal fade" id="modalVentasTiendasActivacionesDetails">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Ventas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

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
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
         </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




     

           
   <!--=====================================
=            MODAL DETAIL POSPAGO          =
======================================-->


     <div class="modal fade" id="modalVentasTiendasPospagoDetails">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Ventas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

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

                   </table> 
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
         </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




   <!--=====================================
=            MODAL DETAIL KITS CLARO PREPAGO          =
======================================-->



     <div class="modal fade" id="modalVentasTiendasKitsDigitalDetails">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Ventas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

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
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
         </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



 <!--=====================================
=            MODAL DETAIL KITS CLARO CLARO          =
======================================-->

     <div class="modal fade" id="modalVentasTiendasKitsClaroDetails">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Ventas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

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
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
         </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->





<!--=====================================
=            MODAL DETAIL ACCESORIOS         =
======================================-->


     <div class="modal fade" id="modalVentasTiendasAccesoriosDetails">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Ventas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

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
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
         </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->





<!--=====================================
=            MODAL DETAIL RECAUDACIONES         =
======================================-->


     <div class="modal fade" id="modalVentasTiendasRecaudacionesDetails">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Ventas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

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

                   </table> 
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
         </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


