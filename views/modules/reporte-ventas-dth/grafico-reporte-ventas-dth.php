<?php

error_reporting(0);

?>

<style>
    #myBtn {
        display: none;
        position: fixed;
        bottom: 15px;
        right: 30px;
        z-index: 99;
        font-size: 15px;
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


<!--      Inicio Boton para ir arriba       -->
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
<!--      Fin Boton para ir arriba       -->



<?php

date_default_timezone_set('America/Costa_Rica');

if (isset($_GET["startDate"]) && $_GET["startDate"] != "null") {

    $startDate = $_GET["startDate"];

    $endDate = $_GET["endDate"];

} else {

    $today = date('Y-m-d');

    $startDate = date('Y-m-01', strtotime($today));

    $endDate = date('Y-m-t', strtotime($today));
}

if (isset($_GET["coordinador"]) && $_GET["coordinador"] != "null") {

    $coordinador = $_GET["coordinador"];

} else {
    $coordinador = "%";
}

$totalventas = ControladorVentasDth::ctrCargarDatosVentas($startDate, $endDate, $coordinador);
//echo '<pre>'; print_r($totalventas); echo '</pre>';

?>




<!-- GRAFICO VENTA CALLE -->
<section class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">


          <div class="card-header">
              <h3 class="card-title">Gráfico de Ventas</h3>
          </div>


        <div class="col-12">
          <div class="card-body">
              <!-- checkcard -->
                      <div class="form-group">
                        <label style="color: #FF0000">
                          <input type="checkbox" class="minimal" checked id="chk_dth_grafico_ventas_calle"> DTH
                        </label> &nbsp;&nbsp;
                        <label style="color: #3c8dbc">
                          <input type="checkbox" class="minimal" checked id="chk_internet_grafico_ventas_calle"> INTERNET
                        </label> &nbsp;&nbsp;
                        <label style="color: #a0d0e0">
                          <input type="checkbox" class="minimal" checked id="chk_pospago_grafico_ventas_calle"> POSPAGO
                        </label> &nbsp;&nbsp;
                          <label style="color: #FFC0CB">
                          <input type="checkbox" class="minimal" checked id="chk_gpon_grafico_ventas_calle"> GPON
                        </label>
                      </div>
                  <div class="chart col-12" id="revenue-chart" ></div>
              </div>

          </div>
        </div>
    </div>
  </div>



<script>
    /**********************************
     *        INICIO GRAFICOS         *
     *********************************/

    var isCheckedchk_dth_grafico_ventas_calle = document.getElementById('chk_dth_grafico_ventas_calle').checked;

    var isCheckedchk_internet_grafico_ventas_calle = document.getElementById('chk_internet_grafico_ventas_calle').checked;

    var isCheckedchk_pospago_grafico_ventas_calle = document.getElementById('chk_pospago_grafico_ventas_calle').checked;

    var isCheckedchk_gpon_grafico_ventas_calle = document.getElementById('chk_gpon_grafico_ventas_calle').checked;


    if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle ){

        $("#revenue-chart").empty();
        $("#revenue-chart svg").remove();


        "use strict";

        // AREA CHART
        var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
                <?php

if ($totalventas == null) {

    echo "{ y: 0, dth: 0, internet: 0, pospago: 0, gpon: 0 }";

} else {

    foreach ($totalventas as $key => $value) {

        if ($key === array_key_last($array)) {

            echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " }";

        } else {

            echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " },";

        }

    }

}

?>

                ],
                    xkey: 'y',
                    ykeys: ['dth', 'internet', 'pospago' , 'gpon'],
                    labels: ['DTH', 'Internet', 'Pospago' , 'GPON'],
                    lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],

        });
    }


    $('#chk_dth_grafico_ventas_calle').on('ifChecked', function(event){
        $("#revenue-chart").empty();
        $("#revenue-chart svg").remove();


        var isCheckedchk_dth_grafico_ventas_calle = document.getElementById('chk_dth_grafico_ventas_calle').checked;

        var isCheckedchk_internet_grafico_ventas_calle = document.getElementById('chk_internet_grafico_ventas_calle').checked;

        var isCheckedchk_pospago_grafico_ventas_calle = document.getElementById('chk_pospago_grafico_ventas_calle').checked;

        var isCheckedchk_gpon_grafico_ventas_calle = document.getElementById('chk_gpon_grafico_ventas_calle').checked;


        if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle){

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " },";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['dth', 'internet', 'pospago' , 'gpon'],
            labels: ['DTH', 'Internet', 'Pospago' , 'GPON'],
            lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],

            });





        }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

        "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . "},";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['dth', 'internet', 'pospago' ],
            labels: ['DTH', 'Internet', 'Pospago' ],
            lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],

            });

        }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
                element: 'revenue-chart',
                resize: true,
                parseTime: false,
                fillOpacity: 0,
                hideHover: 'true',
                behaveLikeLine: true,
                data             : [
                    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {
        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {
        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";
    }
}
?>


                ],
                xkey: 'y',
                ykeys: ['dth', 'gpon', 'pospago' ],
                labels: ['DTH', 'GPON', 'Pospago' ],
                lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],

            });


        }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle) {

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " },";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['dth', 'internet', 'gpon' ],
            labels: ['DTH', 'Internet','GPON' ],
            lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],

            });


        }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

                "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
                <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . " }";

    } else {
        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . "},";

    }
}

?>

            ],
            xkey: 'y',
            ykeys: ['dth', 'internet' ],
            labels: ['DTH', 'Internet' ],
            lineColors: ['#FF0000', '#3c8dbc'],

            });

        }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle ) {

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . "},";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['dth', 'gpon' ],
            labels: ['DTH', 'GPON' ],
            lineColors: ['#FF0000', '#FFC0CB'],

            });

        }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
                <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . "},";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['dth', 'pospago' ],
            labels: ['DTH', 'POSPAGO' ],
            lineColors: ['#FF0000', '#a0d0e0'],

            });


        }else if(isCheckedchk_dth_grafico_ventas_calle) {

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . "},";

    }
}

?>

            ],
            xkey: 'y',
            ykeys: ['dth'],
            labels: ['DTH'],
            lineColors: ['#FF0000'],
            });
        }
    }
);


    $('#chk_dth_grafico_ventas_calle').on('ifUnchecked', function(event){
        console.log("ifUnchecked");


        $("#revenue-chart").empty();
        $("#revenue-chart svg").remove();


        var isCheckedchk_dth_grafico_ventas_calle = document.getElementById('chk_dth_grafico_ventas_calle').checked;

        var isCheckedchk_internet_grafico_ventas_calle = document.getElementById('chk_internet_grafico_ventas_calle').checked;

        var isCheckedchk_pospago_grafico_ventas_calle = document.getElementById('chk_pospago_grafico_ventas_calle').checked;

        var isCheckedchk_gpon_grafico_ventas_calle = document.getElementById('chk_gpon_grafico_ventas_calle').checked;


        if(isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle){

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
                element: 'revenue-chart',
                resize: true,
                parseTime: false,
                fillOpacity: 0,
                hideHover: 'true',
                behaveLikeLine: true,
                data             : [
                <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "',internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " },";

    }

}

?>

                ],
                xkey: 'y',
                ykeys: ['internet', 'pospago' , 'gpon'],
                labels: ['Internet', 'Pospago' , 'GPON'],
                lineColors: ['#3c8dbc', '#a0d0e0', '#FFC0CB'],

            });





        }else if(isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "',internet: " . $value[2] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "',internet: " . $value[2] . ", pospago: " . $value[3] . "},";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['internet', 'pospago' ],
            labels: ['Internet', 'Pospago' ],
            lineColors: ['#3c8dbc', '#a0d0e0'],

            });



        }else if(isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle) {

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", gpon: " . $value[5] . " },";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['internet', 'gpon' ],
            labels: ['Internet','GPON' ],
            lineColors: ['#3c8dbc', '#FFC0CB'],

            });


        }else if(isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {




                "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . "},";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['pospago', 'internet' ],
            labels: ['POSPAGO', 'Internet' ],
            lineColors: ['#a0d0e0', '#3c8dbc'],

            });

        }else if(isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle ) {




                "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", gpon: " . $value[5] . "},";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['pospago', 'gpon' ],
            labels: ['POSPAGO', 'GPON' ],
            lineColors: ['#a0d0e0', '#FFC0CB'],

            });

        }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {




                "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . "},";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['dth', 'pospago' ],
            labels: ['DTH', 'POSPAGO' ],
            lineColors: ['#FF0000', '#a0d0e0'],

            });

        }else if(isCheckedchk_internet_grafico_ventas_calle) {

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . "},";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['internet'],
            labels: ['INTERNET'],
            lineColors: ['#3c8dbc'],

            });


        }else if(isCheckedchk_pospago_grafico_ventas_calle) {

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . "},";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['pospago'],
            labels: ['POSPAGO'],
            lineColors: ['#a0d0e0'],

            });


        }else if(isCheckedchk_gpon_grafico_ventas_calle) {

            "use strict";

            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            parseTime: false,
            fillOpacity: 0,
            hideHover: 'true',
            behaveLikeLine: true,
            data             : [
            <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . "},";

    }

}

?>

            ],
            xkey: 'y',
            ykeys: ['gpon'],
            labels: ['GPON'],
            lineColors: ['#FFC0CB'],

            });


        }

});


   $('#chk_internet_grafico_ventas_calle').on('ifChecked', function(event){
    $("#revenue-chart").empty();
    $("#revenue-chart svg").remove();


    var isCheckedchk_dth_grafico_ventas_calle = document.getElementById('chk_dth_grafico_ventas_calle').checked;

    var isCheckedchk_internet_grafico_ventas_calle = document.getElementById('chk_internet_grafico_ventas_calle').checked;

    var isCheckedchk_pospago_grafico_ventas_calle = document.getElementById('chk_pospago_grafico_ventas_calle').checked;

    var isCheckedchk_gpon_grafico_ventas_calle = document.getElementById('chk_gpon_grafico_ventas_calle').checked;


if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle){

 "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " },";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth', 'internet', 'pospago' , 'gpon'],
      labels: ['DTH', 'Internet', 'Pospago' , 'GPON'],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],

    });





}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['gpon', 'internet', 'pospago' ],
      labels: ['GPON', 'Internet', 'Pospago' ],
      lineColors: ['#FFC0CB', '#3c8dbc', '#a0d0e0'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth', 'gpon', 'pospago' ],
      labels: ['DTH', 'GPON', 'Pospago' ],
      lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],

    });


}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " },";

    }

}

?>

],
  xkey: 'y',
  ykeys: ['dth', 'internet', 'gpon' ],
  labels: ['DTH', 'Internet','GPON' ],
  lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],

});

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

        "use strict";

        // AREA CHART
        var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        parseTime: false,
        fillOpacity: 0,
        hideHover: 'true',
        behaveLikeLine: true,
        data             : [
        <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " },";

    }

}

?>

        ],
        xkey: 'y',
        ykeys: ['dth', 'internet', 'pospago' ],
        labels: ['DTH', 'Internet','Pospago' ],
        lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],

        });


    }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

        "use strict";

        // AREA CHART
        var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        parseTime: false,
        fillOpacity: 0,
        hideHover: 'true',
        behaveLikeLine: true,
        data             : [
        <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . "},";

    }

}

?>

        ],
        xkey: 'y',
        ykeys: ['dth', 'internet' ],
        labels: ['DTH', 'Internet' ],
        lineColors: ['#FF0000', '#3c8dbc'],

        });

    }else if(isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

        "use strict";

        // AREA CHART
        var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        parseTime: false,
        fillOpacity: 0,
        hideHover: 'true',
        behaveLikeLine: true,
        data             : [
        <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . "},";

    }

}

?>

        ],
        xkey: 'y',
        ykeys: ['pospago', 'internet' ],
        labels: ['Pospago', 'Internet' ],
        lineColors: ['#a0d0e0', '#3c8dbc'],

        });

    }else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

        "use strict";

        // AREA CHART
        var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        parseTime: false,
        fillOpacity: 0,
        hideHover: 'true',
        behaveLikeLine: true,
        data             : [
        <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . "},";

    }

}

?>

        ],
        xkey: 'y',
        ykeys: ['gpon', 'internet' ],
        labels: ['GPON', 'Internet' ],
        lineColors: ['#FFC0CB', '#3c8dbc'],

        });

        }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle ) {




        "use strict";

        // AREA CHART
        var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        parseTime: false,
        fillOpacity: 0,
        hideHover: 'true',
        behaveLikeLine: true,
        data             : [
        <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . "},";

    }

}

?>

        ],
        xkey: 'y',
        ykeys: ['dth', 'gpon' ],
        labels: ['DTH', 'GPON' ],
        lineColors: ['#FF0000', '#FFC0CB'],

        });

        }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {




        "use strict";

        // AREA CHART
        var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        parseTime: false,
        fillOpacity: 0,
        hideHover: 'true',
        behaveLikeLine: true,
        data             : [
        <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . "},";

    }

}

?>

        ],
        xkey: 'y',
        ykeys: ['dth', 'pospago' ],
        labels: ['DTH', 'POSPAGO' ],
        lineColors: ['#FF0000', '#a0d0e0'],

        });


    }else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {

        "use strict";

        // AREA CHART
        var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        parseTime: false,
        fillOpacity: 0,
        hideHover: 'true',
        behaveLikeLine: true,
        data             : [
        <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

        ],
        xkey: 'y',
        ykeys: ['gpon', 'pospago' ],
        labels: ['GPON', 'POSPAGO' ],
        lineColors: ['#FFC0CB', '#a0d0e0'],

        });


    }else if(isCheckedchk_internet_grafico_ventas_calle) {

        "use strict";

        // AREA CHART
        var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        parseTime: false,
        fillOpacity: 0,
        hideHover: 'true',
        behaveLikeLine: true,
        data             : [
        <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', internet: " . $value[1] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[1] . "},";

    }

}

?>

        ],
        xkey: 'y',
        ykeys: ['internet'],
        labels: ['Internet'],
        lineColors: ['#3c8dbc'],

        });


    }

});


$('#chk_internet_grafico_ventas_calle').on('ifUnchecked', function(event){
$("#revenue-chart").empty();
$("#revenue-chart svg").remove();


var isCheckedchk_dth_grafico_ventas_calle = document.getElementById('chk_dth_grafico_ventas_calle').checked;

var isCheckedchk_internet_grafico_ventas_calle = document.getElementById('chk_internet_grafico_ventas_calle').checked;

var isCheckedchk_pospago_grafico_ventas_calle = document.getElementById('chk_pospago_grafico_ventas_calle').checked;

var isCheckedchk_gpon_grafico_ventas_calle = document.getElementById('chk_gpon_grafico_ventas_calle').checked;


if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle){

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'pospago' , 'gpon'],
    labels: ['DTH', 'Internet', 'Pospago' , 'GPON'],
    lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],

    });

}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", dth: " . $value[1] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", dth: " . $value[1] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'dth', 'pospago' ],
    labels: ['GPON', 'DTH', 'Pospago' ],
    lineColors: ['#FFC0CB', '#FF0000', '#a0d0e0'],

    });



}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'gpon', 'pospago' ],
    labels: ['DTH', 'GPON', 'Pospago' ],
    lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],

    });


}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'gpon' ],
    labels: ['DTH', 'Internet','GPON' ],
    lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'pospago' ],
    labels: ['DTH', 'Internet','Pospago' ],
    lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],

    });


}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet' ],
    labels: ['DTH', 'Internet' ],
    lineColors: ['#FF0000', '#3c8dbc'],

    });

}else if(isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

     "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['pospago', 'internet' ],
    labels: ['Pospago', 'Internet' ],
    lineColors: ['#a0d0e0', '#3c8dbc'],

    });

}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'internet' ],
    labels: ['GPON', 'Internet' ],
    lineColors: ['#FFC0CB', '#3c8dbc'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle ) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'gpon' ],
    labels: ['DTH', 'GPON' ],
    lineColors: ['#FF0000', '#FFC0CB'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {




    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'pospago' ],
    labels: ['DTH', 'POSPAGO' ],
    lineColors: ['#FF0000', '#a0d0e0'],

    });


}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {

     "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'pospago' ],
    labels: ['GPON', 'POSPAGO' ],
    lineColors: ['#FFC0CB', '#a0d0e0'],

    });


}else if(isCheckedchk_dth_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth'],
    labels: ['DTH'],
    lineColors: ['#FF0000'],

    });


}else if(isCheckedchk_internet_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['internet'],
    labels: ['Internet'],
    lineColors: ['#3c8dbc'],

    });

 }else if(isCheckedchk_gpon_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon'],
    labels: ['GPON'],
    lineColors: ['#FFC0CB'],

    });

}else if(isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['pospago'],
    labels: ['Pospago'],
    lineColors: ['#a0d0e0'],

    });


}


});


$('#chk_pospago_grafico_ventas_calle').on('ifChecked', function(event){
$("#revenue-chart").empty();
$("#revenue-chart svg").remove();


var isCheckedchk_dth_grafico_ventas_calle = document.getElementById('chk_dth_grafico_ventas_calle').checked;

var isCheckedchk_internet_grafico_ventas_calle = document.getElementById('chk_internet_grafico_ventas_calle').checked;

var isCheckedchk_pospago_grafico_ventas_calle = document.getElementById('chk_pospago_grafico_ventas_calle').checked;

var isCheckedchk_gpon_grafico_ventas_calle = document.getElementById('chk_gpon_grafico_ventas_calle').checked;


if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle){

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'pospago' , 'gpon'],
    labels: ['DTH', 'Internet', 'Pospago' , 'GPON'],
    lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],

    });





}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_dth_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . ", dth: " . $value[1] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . ", dth: " . $value[1] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'internet', 'dth' ],
    labels: ['GPON', 'Internet', 'DTH' ],
    lineColors: ['#FFC0CB', '#3c8dbc', '#FF0000'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'gpon', 'pospago' ],
    labels: ['DTH', 'GPON', 'Pospago' ],
    lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],

    });


}else if(isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['internet', 'gpon', 'pospago' ],
    labels: ['Internet', 'GPON', 'Pospago' ],
    lineColors: ['#3c8dbc', '#FFC0CB', '#a0d0e0'],

    });



}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'gpon' ],
    labels: ['DTH', 'Internet','GPON' ],
    lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'pospago' ],
    labels: ['DTH', 'Internet','Pospago' ],
    lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],

    });


}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet' ],
    labels: ['DTH', 'Internet' ],
    lineColors: ['#FF0000', '#3c8dbc'],

    });

}else if(isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['pospago', 'internet' ],
    labels: ['Pospago', 'Internet' ],
    lineColors: ['#a0d0e0', '#3c8dbc'],

    });

}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'internet' ],
    labels: ['GPON', 'Internet' ],
    lineColors: ['#FFC0CB', '#3c8dbc'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle ) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'gpon' ],
    labels: ['DTH', 'GPON' ],
    lineColors: ['#FF0000', '#FFC0CB'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'pospago' ],
    labels: ['DTH', 'POSPAGO' ],
    lineColors: ['#FF0000', '#a0d0e0'],

    });


}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'pospago' ],
    labels: ['GPON', 'POSPAGO' ],
    lineColors: ['#FFC0CB', '#a0d0e0'],

    });


}else if(isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['pospago'],
    labels: ['Pospago'],
    lineColors: ['#a0d0e0'],

    });


}




});



$('#chk_pospago_grafico_ventas_calle').on('ifUnchecked', function(event){
$("#revenue-chart").empty();
$("#revenue-chart svg").remove();


var isCheckedchk_dth_grafico_ventas_calle = document.getElementById('chk_dth_grafico_ventas_calle').checked;

var isCheckedchk_internet_grafico_ventas_calle = document.getElementById('chk_internet_grafico_ventas_calle').checked;

var isCheckedchk_pospago_grafico_ventas_calle = document.getElementById('chk_pospago_grafico_ventas_calle').checked;

var isCheckedchk_gpon_grafico_ventas_calle = document.getElementById('chk_gpon_grafico_ventas_calle').checked;


if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle){

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'pospago' , 'gpon'],
    labels: ['DTH', 'Internet', 'Pospago' , 'GPON'],
    lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],

    });



}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_dth_grafico_ventas_calle) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . ", dth: " . $value[1] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . ", dth: " . $value[1] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['gpon', 'internet', 'dth' ],
      labels: ['GPON', 'Internet', 'DTH' ],
      lineColors: ['#FFC0CB', '#3c8dbc', '#FF0000'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth', 'gpon', 'pospago' ],
      labels: ['DTH', 'GPON', 'Pospago' ],
      lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],

    });


  }else if(isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['internet', 'gpon', 'pospago' ],
      labels: ['Internet', 'GPON', 'Pospago' ],
      lineColors: ['#3c8dbc', '#FFC0CB', '#a0d0e0'],

    });



}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " },";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth', 'internet', 'gpon' ],
      labels: ['DTH', 'Internet','GPON' ],
      lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],

    });

  }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " },";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth', 'internet', 'pospago' ],
      labels: ['DTH', 'Internet','Pospago' ],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],

    });


}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth', 'internet' ],
      labels: ['DTH', 'Internet' ],
      lineColors: ['#FF0000', '#3c8dbc'],

    });

  }else if(isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['pospago', 'internet' ],
      labels: ['Pospago', 'Internet' ],
      lineColors: ['#a0d0e0', '#3c8dbc'],

    });

     }else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {






        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['gpon', 'internet' ],
      labels: ['GPON', 'Internet' ],
      lineColors: ['#FFC0CB', '#3c8dbc'],

    });

  }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth', 'gpon' ],
      labels: ['DTH', 'GPON' ],
      lineColors: ['#FF0000', '#FFC0CB'],

    });

     }else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth', 'pospago' ],
      labels: ['DTH', 'POSPAGO' ],
      lineColors: ['#FF0000', '#a0d0e0'],

    });


     }else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['gpon', 'pospago' ],
      labels: ['GPON', 'POSPAGO' ],
      lineColors: ['#FFC0CB', '#a0d0e0'],

    });

         }else if(isCheckedchk_gpon_grafico_ventas_calle ) {




        "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . "}";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['gpon' ],
      labels: ['GPON' ],
      lineColors: ['#FFC0CB'],

    });


}else if(isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['pospago'],
      labels: ['Pospago'],
      lineColors: ['#a0d0e0'],

    });


  }else if(isCheckedchk_dth_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth'],
      labels: ['DTH'],
      lineColors: ['#FF0000'],

    });

      }else if(isCheckedchk_internet_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['internet'],
      labels: ['Internet'],
      lineColors: ['#3c8dbc'],

    });


}




});


$('#chk_gpon_grafico_ventas_calle').on('ifChecked', function(event){
      $("#revenue-chart").empty();
$("#revenue-chart svg").remove();


      var isCheckedchk_dth_grafico_ventas_calle = document.getElementById('chk_dth_grafico_ventas_calle').checked;

      var isCheckedchk_internet_grafico_ventas_calle = document.getElementById('chk_internet_grafico_ventas_calle').checked;

      var isCheckedchk_pospago_grafico_ventas_calle = document.getElementById('chk_pospago_grafico_ventas_calle').checked;

      var isCheckedchk_gpon_grafico_ventas_calle = document.getElementById('chk_gpon_grafico_ventas_calle').checked;


if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle){

 "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " },";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth', 'internet', 'pospago' , 'gpon'],
      labels: ['DTH', 'Internet', 'Pospago' , 'GPON'],
      lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],

    });





}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_dth_grafico_ventas_calle) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . ", dth: " . $value[1] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . ", dth: " . $value[1] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['gpon', 'internet', 'dth' ],
      labels: ['GPON', 'Internet', 'DTH' ],
      lineColors: ['#FFC0CB', '#3c8dbc', '#FF0000'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

   "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      parseTime: false,
      fillOpacity: 0,
      hideHover: 'true',
      behaveLikeLine: true,
     data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
      xkey: 'y',
      ykeys: ['dth', 'gpon', 'pospago' ],
      labels: ['DTH', 'GPON', 'Pospago' ],
      lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],

    });


} else if(isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

"use strict";

 // AREA CHART
 var area = new Morris.Area({
   element: 'revenue-chart',
   resize: true,
   parseTime: false,
   fillOpacity: 0,
   hideHover: 'true',
   behaveLikeLine: true,
  data             : [
 <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

 ],
   xkey: 'y',
   ykeys: ['internet', 'gpon', 'pospago' ],
   labels: ['Internet', 'GPON', 'Pospago' ],
   lineColors: ['#3c8dbc', '#FFC0CB', '#a0d0e0'],

 });



}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle) {

 "use strict";

 // AREA CHART
 var area = new Morris.Area({
   element: 'revenue-chart',
   resize: true,
   parseTime: false,
   fillOpacity: 0,
   hideHover: 'true',
   behaveLikeLine: true,
  data             : [
 <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " },";

    }

}

?>

 ],
   xkey: 'y',
   ykeys: ['dth', 'internet', 'gpon' ],
   labels: ['DTH', 'Internet','GPON' ],
   lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],

 });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'pospago' ],
    labels: ['DTH', 'Internet','Pospago' ],
    lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],

    });


}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

        "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet' ],
    labels: ['DTH', 'Internet' ],
    lineColors: ['#FF0000', '#3c8dbc'],

    });

}else if(isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {


        "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['pospago', 'internet' ],
    labels: ['Pospago', 'Internet' ],
    lineColors: ['#a0d0e0', '#3c8dbc'],

    });

}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {


        "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'internet' ],
    labels: ['GPON', 'Internet' ],
    lineColors: ['#FFC0CB', '#3c8dbc'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle ) {

        "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'gpon' ],
    labels: ['DTH', 'GPON' ],
    lineColors: ['#FF0000', '#FFC0CB'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {

        "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'pospago' ],
    labels: ['DTH', 'POSPAGO' ],
    lineColors: ['#FF0000', '#a0d0e0'],

    });


}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {

     "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'pospago' ],
    labels: ['GPON', 'POSPAGO' ],
    lineColors: ['#FFC0CB', '#a0d0e0'],

    });


}else if(isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['pospago'],
    labels: ['Pospago'],
    lineColors: ['#a0d0e0'],

    });


}

});





$('#chk_gpon_grafico_ventas_calle').on('ifUnchecked', function(event){
$("#revenue-chart").empty();
$("#revenue-chart svg").remove();


   var isCheckedchk_dth_grafico_ventas_calle = document.getElementById('chk_dth_grafico_ventas_calle').checked;

   var isCheckedchk_internet_grafico_ventas_calle = document.getElementById('chk_internet_grafico_ventas_calle').checked;

   var isCheckedchk_pospago_grafico_ventas_calle = document.getElementById('chk_pospago_grafico_ventas_calle').checked;

   var isCheckedchk_gpon_grafico_ventas_calle = document.getElementById('chk_gpon_grafico_ventas_calle').checked;


if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle){

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . ", gpon: " . $value[5] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'pospago' , 'gpon'],
    labels: ['DTH', 'Internet', 'Pospago' , 'GPON'],
    lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0', '#FFC0CB'],

    });


}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_dth_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . ", dth: " . $value[1] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . ", dth: " . $value[1] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'internet', 'dth' ],
    labels: ['GPON', 'Internet', 'DTH' ],
    lineColors: ['#FFC0CB', '#3c8dbc', '#FF0000'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'gpon', 'pospago' ],
    labels: ['DTH', 'GPON', 'Pospago' ],
    lineColors: ['#FF0000', '#FFC0CB', '#a0d0e0'],

    });


}else if(isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . ", gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['internet', 'gpon', 'pospago' ],
    labels: ['Internet', 'GPON', 'Pospago' ],
    lineColors: ['#3c8dbc', '#FFC0CB', '#a0d0e0'],

    });



}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", gpon: " . $value[5] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'gpon' ],
    labels: ['DTH', 'Internet','GPON' ],
    lineColors: ['#FF0000', '#3c8dbc', '#FFC0CB'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . ", pospago: " . $value[3] . " },";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet', 'pospago' ],
    labels: ['DTH', 'Internet','Pospago' ],
    lineColors: ['#FF0000', '#3c8dbc', '#a0d0e0'],

    });


}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

        "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'internet' ],
    labels: ['DTH', 'Internet' ],
    lineColors: ['#FF0000', '#3c8dbc'],

    });

}else if(isCheckedchk_pospago_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

     "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['pospago', 'internet' ],
    labels: ['Pospago', 'Internet' ],
    lineColors: ['#a0d0e0', '#3c8dbc'],

    });

  }else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_internet_grafico_ventas_calle ) {

     "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", internet: " . $value[2] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'internet' ],
    labels: ['GPON', 'Internet' ],
    lineColors: ['#FFC0CB', '#3c8dbc'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_gpon_grafico_ventas_calle ) {

     "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", gpon: " . $value[5] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'gpon' ],
    labels: ['DTH', 'GPON' ],
    lineColors: ['#FF0000', '#FFC0CB'],

    });

}else if(isCheckedchk_dth_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {

     "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth', 'pospago' ],
    labels: ['DTH', 'POSPAGO' ],
    lineColors: ['#FF0000', '#a0d0e0'],

    });


}else if(isCheckedchk_gpon_grafico_ventas_calle && isCheckedchk_pospago_grafico_ventas_calle ) {

     "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . ", pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon', 'pospago' ],
    labels: ['GPON', 'POSPAGO' ],
    lineColors: ['#FFC0CB', '#a0d0e0'],

    });

}else if(isCheckedchk_gpon_grafico_ventas_calle ) {

     "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . "}";

    } else {

        echo "{ y: '" . $value[0] . "', gpon: " . $value[5] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['gpon' ],
    labels: ['GPON' ],
    lineColors: ['#FFC0CB'],

    });


} else if(isCheckedchk_pospago_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', pospago: " . $value[3] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['pospago'],
    labels: ['Pospago'],
    lineColors: ['#a0d0e0'],

    });


}else if(isCheckedchk_dth_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', dth: " . $value[1] . "},";

    }

}

?>

    ],
    xkey: 'y',
    ykeys: ['dth'],
    labels: ['DTH'],
    lineColors: ['#FF0000'],

    });

}else if(isCheckedchk_internet_grafico_ventas_calle) {

    "use strict";

    // AREA CHART
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    parseTime: false,
    fillOpacity: 0,
    hideHover: 'true',
    behaveLikeLine: true,
    data             : [
    <?php

foreach ($totalventas as $key => $value) {

    if ($key === array_key_last($array)) {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . " }";

    } else {

        echo "{ y: '" . $value[0] . "', internet: " . $value[2] . "},";

    }
}

?>

    ],
    xkey: 'y',
    ykeys: ['internet'],
    labels: ['Internet'],
    lineColors: ['#3c8dbc'],

    });


}

});

</script>


<!--******************************************

            FIN GRAFICO DE VENTAS

***********************************************-->






<!--******************************************

            INICIO DATOS DE VENTAS

***********************************************-->

<div class="row">
      <div class="card mt-5 collapsed-card col-12">



          <?php

if (isset($_GET["startDate"]) && $_GET["startDate"] != "null") {

    date_default_timezone_set('America/Costa_Rica');

    $today = date('Y-m-d');

    $firstday = $_GET["startDate"];

    $lastday = $_GET["endDate"];

    $startDate = date('d-m-Y', strtotime($firstday));

    $endDate = date('d-m-Y', strtotime($lastday));

    echo '<div class="card-header"><h3 class="card-title"> DATOS DE VENTAS DEL ' . $startDate . ' AL ' . $endDate . ' </h3>';
} else {

    date_default_timezone_set('America/Costa_Rica');

    $today = date('Y-m-d');

    $firstday = date('Y-m-01', strtotime($today));

    $lastday = date('Y-m-t', strtotime($today));

    $startDate = date('d-m-Y', strtotime($firstday));

    $endDate = date('d-m-Y', strtotime($lastday));

    echo '<div class="card-header"><h3 class="card-title" > DATOS DE VENTAS DEL ' . $startDate . ' AL ' . $endDate . ' </h3>';

}
;

?>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>


      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-md-6" >



            <div class="small-box bg-info">
              <div class="inner">
                <?php

date_default_timezone_set('America/Costa_Rica');

if (isset($_GET["startDate"]) && $_GET["startDate"] != "null") {

    $startDate = $_GET["startDate"];

    $endDate = $_GET["endDate"];

} else {

    $today = date('Y-m-d');

    $startDate = date('Y-m-01', strtotime($today));

    $endDate = date('Y-m-t', strtotime($today));
}

if (isset($_GET["coordinador"]) && $_GET["coordinador"] != "null") {

    $coordinador = $_GET["coordinador"];

} else {
    $coordinador = "%";
}

$total_ventas_dth = ControladorVentasDth::ctrCargarVentasDTHCoordinador($startDate, $endDate, $coordinador);

$formattedNum2 = number_format($total_ventas_dth[0], 0);
//echo '<pre>'; print_r($total_ventas_dth); echo '</pre>';
echo ' <h4>' . '' . $formattedNum2 . '</h4>';

?>

                <p>Ventas DTH</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>



    <div class="col-lg-3 col-md-6">

            <div class="small-box bg-green">
              <div class="inner">
          <?php

date_default_timezone_set('America/Costa_Rica');

if (isset($_GET["startDate"]) && $_GET["startDate"] != "null") {

    $startDate = $_GET["startDate"];

    $endDate = $_GET["endDate"];

} else {

    $today = date('Y-m-d');

    $startDate = date('Y-m-01', strtotime($today));

    $endDate = date('Y-m-t', strtotime($today));
}

if (isset($_GET["coordinador"]) && $_GET["coordinador"] != "null") {

    $coordinador = $_GET["coordinador"];

} else {
    $coordinador = "%";
}

$total_ventas_internet = ControladorVentasDth::ctrCargarVentasInternetcoordinador($startDate, $endDate, $coordinador);

$formattedNum2 = number_format($total_ventas_internet[0], 0);

echo '<h4>' . $formattedNum2 . '<sup style="font-size: 12px"></sup></h4>

            <p>Ventas Internet</p>';

?>


              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>



    <div class="col-lg-3 col-md-6">

      <div class="small-box bg-yellow">
        <div class="inner">
          <?php
date_default_timezone_set('America/Costa_Rica');

if (isset($_GET["startDate"]) && $_GET["startDate"] != "null") {

    $startDate = $_GET["startDate"];

    $endDate = $_GET["endDate"];

} else {

    $today = date('Y-m-d');

    $startDate = date('Y-m-01', strtotime($today));

    $endDate = date('Y-m-t', strtotime($today));
}

if (isset($_GET["coordinador"]) && $_GET["coordinador"] != "null") {

    $coordinador = $_GET["coordinador"];

} else {
    $coordinador = "%";
}

$total_ventas_pospago = ControladorVentasDth::ctrCargarVentasPospagocoordinador($startDate, $endDate, $coordinador);

echo '<h4>' . $total_ventas_pospago[0] . '<sup style="font-size: 20px"></sup></h4>';

?>

          <p>Ventas Pospago</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
            <a href="#" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>



    <div class="col-lg-3 col-md-6">

      <div class="small-box bg-red">
        <div class="inner">

          <?php
date_default_timezone_set('America/Costa_Rica');

if (isset($_GET["startDate"]) && $_GET["startDate"] != "null") {

    $startDate = $_GET["startDate"];

    $endDate = $_GET["endDate"];

} else {

    $today = date('Y-m-d');

    $startDate = date('Y-m-01', strtotime($today));

    $endDate = date('Y-m-t', strtotime($today));
}

if (isset($_GET["coordinador"]) && $_GET["coordinador"] != "null") {

    $coordinador = $_GET["coordinador"];

} else {
    $coordinador = "%";
}

$total_ventas_activaciones = ControladorVentasDth::ctrCargarVentaGPONcoordinadores($startDate, $endDate, $coordinador);

echo '<h4>' . $total_ventas_activaciones[0] . '<sup ></sup></h4>';

?>

                <p>GPON</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>



    </div>
  </div>
  </div>
</div>

<!--******************************************

            FIN DATOS DE VENTAS

***********************************************-->






<!--******************************************

            INICIO METAS MENSUALES

***********************************************-->

<div class="row">
  <div class="card mt-1 collapsed-card col-12">
      <div class="card-header">
            <h3 class="card-title">METAS MENSUALES</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
      </div>
      <div class="card-body">
      <div class="row justify-content-center">

        <div class="col-md-8">

      <?php

if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

    if (isset($_GET["coordinador"])) {

        $coordinador = $_GET["coordinador"];

    } else {

        $coordinador = "null";

    }

    $metas_DTH = ControladorVentasDth::ctrmetasdth($coordinador);

} else if ($_SESSION["sub_tipo"] == "1. Coordinador") {

    $vendedor = $_SESSION["id"];
    $metas_DTH = ControladorVentasDth::ctrmetasdth($vendedor);

} else {

    $vendedor = $_SESSION["id"];
    $metas_DTH = ControladorVentasDth::ctrmetasdth($vendedor);

}

$total_ventas = 0;

if ($metas_DTH == null) {

    echo '

                        <div class="progress-group">';

    echo '<span class="progress-text">DTH</span>
                                    <span class="progress-number float-right"><b>0</b>/ 0 </span>';

    echo ' <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 0 %"></div>
                                <div class="progress-bar progress-bar-red" style="width:0 %"></div>

                            </div>
                            </div>';

    echo '
                        <div class="progress-group">';

    echo '<span class="progress-text">GPON</span>
                                    <span class="progress-number float-right"><b>0</b>/ 0 </span>';

    echo ' <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 0 %"></div>
                                <div class="progress-bar progress-bar-red" style="width:0 %"></div>

                            </div>
                            </div>';
    echo '
                        <div class="progress-group">';

    echo '<span class="progress-text">INTERNET</span>
                                    <span class="progress-number float-right"><b>0</b>/ 0 </span>';

    echo ' <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 0 %"></div>
                                <div class="progress-bar progress-bar-red" style="width:0 %"></div>

                            </div>
                            </div>';

    echo '
                        <div class="progress-group">';

    echo '<span class="progress-text">POSPAGO</span>

                                    <span class="progress-number float-right"><b>0</b>/ 0 </span>';

    echo ' <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 0 %"></div>
                                <div class="progress-bar progress-bar-red" style="width:0 %"></div>

                            </div>
                            </div>
                            </div>';

} else {

    foreach ($metas_DTH as $key => $value) {

        if ($value["nombre"] == "DTH") {

            if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

                if (isset($_GET["vendedor"]) && $_GET["vendedor"] != "null") {

                    $coordinador = $_GET["vendedor"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasDTHCoordinador($startDate, $endDate, $coordinador);

                } else if (isset($_GET["coordinador"]) && $_GET["coordinador"] != "null") {

                    $coordinador = $_GET["coordinador"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasDTHCoordinador($startDate, $endDate, $coordinador);

                } else {

                    $coordinador = 'null';

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasDTHCoordinador($startDate, $endDate, $coordinador);

                }

            } else if ($_SESSION["sub_tipo"] == "1. Coordinador") {

                $coordinador = $_GET["vendedor"];

                $today = date('Y-m-d');

                $startDate = date('Y-m-01', strtotime($today));

                $endDate = date('Y-m-t', strtotime($today));

                $total_ventas = ControladorVentasDth::ctrCargarVentasDTHCoordinador($startDate, $endDate, $coordinador);

            } else {

                $coordinador = $_SESSION["id"];

                $today = date('Y-m-d');

                $startDate = date('Y-m-01', strtotime($today));

                $endDate = date('Y-m-t', strtotime($today));

                $total_ventas = ControladorVentasDth::ctrCargarVentasDTHCoordinador($startDate, $endDate, $coordinador);

            }

        } else if ($value["nombre"] == "INTERNET") {

            if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

                if (isset($_GET["vendedor"]) && $_GET["vendedor"] != "null") {

                    $coordinador = $_GET["vendedor"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasInternetcoordinador($startDate, $endDate, $coordinador);

                } else if (isset($_GET["coordinador"]) && $_GET["coordinador"] != "null") {

                    $coordinador = $_GET["coordinador"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasInternetcoordinador($startDate, $endDate, $coordinador);

                } else {

                    $coordinador = "null";

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasInternetcoordinador($startDate, $endDate, $coordinador);

                }

            } else if ($_SESSION["sub_tipo"] == "1. Coordinador") {

                if (isset($_GET["vendedor"]) && $_GET["vendedor"] != "null") {

                    $coordinador = $_GET["vendedor"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasInternetcoordinador($startDate, $endDate, $coordinador);

                } else {

                    $coordinador = $_SESSION["id"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasInternetcoordinador($startDate, $endDate, $coordinador);

                }

            } else {

                $coordinador = $_SESSION["id"];

                $today = date('Y-m-d');

                $startDate = date('Y-m-01', strtotime($today));

                $endDate = date('Y-m-t', strtotime($today));

                $total_ventas = ControladorVentasDth::ctrCargarVentasInternetcoordinador($startDate, $endDate, $coordinador);

            }

        } else if ($value["nombre"] == "POSPAGO") {

            if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

                if (isset($_GET["vendedor"]) && $_GET["vendedor"] != "null") {

                    $coordinador = $_GET["vendedor"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasPospagocoordinador($startDate, $endDate, $coordinador);

                } else if (isset($_GET["coordinador"]) && $_GET["coordinador"] != "null") {

                    $coordinador = $_GET["coordinador"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasPospagocoordinador($startDate, $endDate, $coordinador);

                } else {

                    $coordinador = "null";

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasPospagocoordinador($startDate, $endDate, $coordinador);

                }

            } else if ($_SESSION["sub_tipo"] == "1. Coordinador") {

                if (isset($_GET["vendedor"]) && $_GET["vendedor"] != "null") {

                    $coordinador = $_GET["vendedor"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasPospagocoordinador($startDate, $endDate, $coordinador);

                } else {

                    $coordinador = $_SESSION["id"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentasPospagocoordinador($startDate, $endDate, $coordinador);

                }

            } else {

                $coordinador = $_SESSION["id"];

                $today = date('Y-m-d');

                $startDate = date('Y-m-01', strtotime($today));

                $endDate = date('Y-m-t', strtotime($today));

                $total_ventas = ControladorVentasDth::ctrCargarVentasPospagocoordinador($startDate, $endDate, $coordinador);

            }

        } else if ($value["nombre"] == "GPON") {

            if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

                if (isset($_GET["vendedor"]) && $_GET["vendedor"] != "null") {

                    $coordinador = $_GET["vendedor"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentaGPONcoordinadores($startDate, $endDate, $coordinador);

                } else if (isset($_GET["coordinador"]) && $_GET["coordinador"] != "null") {

                    $coordinador = $_GET["coordinador"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentaGPONcoordinadores($startDate, $endDate, $coordinador);

                } else {

                    $coordinador = "null";

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentaGPONcoordinadores($startDate, $endDate, $coordinador);

                }

            } else if ($_SESSION["sub_tipo"] == "1. Coordinador") {

                if (isset($_GET["vendedor"]) && $_GET["vendedor"] != "null") {

                    $coordinador = $_GET["vendedor"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentaGPONcoordinadores($startDate, $endDate, $coordinador);

                } else {

                    $coordinador = $_SESSION["id"];

                    $today = date('Y-m-d');

                    $startDate = date('Y-m-01', strtotime($today));

                    $endDate = date('Y-m-t', strtotime($today));

                    $total_ventas = ControladorVentasDth::ctrCargarVentaGPONcoordinadores($startDate, $endDate, $coordinador);

                }

            } else {

                $coordinador = "null";

                $today = date('Y-m-d');

                $startDate = date('Y-m-01', strtotime($today));

                $endDate = date('Y-m-t', strtotime($today));

                $total_ventas = ControladorVentasDth::ctrCargarVentaGPONcoordinadores($startDate, $endDate, $coordinador);

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
        $diainc = 24 * 60 * 60;

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
        $diainc = 24 * 60 * 60;

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
         */$proyeccion = $total_ventas[0] / count($diashabileshoy) * count($diashabilesmes);

        $porcentaje = ($total_ventas[0] / $value["Total"]) * 100;

        $proyeccion_real = ($proyeccion / $value["Total"]) * 100;

        $proyeccion_real = $proyeccion_real - $porcentaje;

        //echo ".number_format($porcentaje,2)." %""'";

        echo ' ' . number_format($porcentaje, 2) . " %" . '';

        $formattedNum = number_format($value["Total"], 0);

        $formattedNum2 = number_format($total_ventas[0], 0);

        echo '
                        <div class="progress-group">';

        echo '<span class="progress-text">' . $value[0] . '</span>
                                    <span class="progress-number"><b>' . $formattedNum2 . '</b>/' . $formattedNum . ' </span>';

        echo ' <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: ' . $porcentaje . '%"></div>
                                <div class="progress-bar progress-bar-red" style="width: ' . $proyeccion_real . '%"></div>

                            </div>
                            </div>';

    }

}

?>

      </div>
      </div>
  </div>
</div>

<!--********************************************


            FIN METAS MENSUALES


************************************************-->




<!--********************************************


        INICIO VENTAS POR MOVIL


***********************************************-->



<?php

if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {?>
    <!-- Main content -->




     <div class="card mt-1 collapsed-card col-12">

        <div class="card-header">

          <h3 class="card-title">VENTAS POR MOVIL</h3>
          <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
      </div>
            <!--   card-header     -->


    <div class="card-body">


          <table class="table table-bordered table-striped dt-responsive " width="100%" id="tablasventasXcoordinadorreporteventascalle">

            <thead>

              <tr>

              <th style="width:10px">#</th>
              <th>Categoria</th>
              <th>Movil</th>
              <th>Placa</th>
              <th>Coordinador</th>
              <th>DTH</th>
              <th>Internet</th>
              <th>Pospago</th>
              <th>GPON</th>
              <th>Total</th>

        <!-- FORMA DE OCULTAR UNA COLUMNA  -->

              </tr>

            </thead>
            <tbody>

                    <?php
if (isset($_GET["startDate"]) && $_GET["startDate"] != "null") {

    $startDate = $_GET["startDate"];

    $endDate = $_GET["endDate"];

} else {

    date_default_timezone_set('America/Costa_Rica');

    $today = date('Y-m-d');

    $startDate = date('Y-m-01', strtotime($today));

    $endDate = date('Y-m-t', strtotime($today));

}

    $ventas = ControladorVentasDth::ctrCargarVentasTotales($startDate, $endDate);
    /*  echo '<pre>'; print_r($ventas); echo '</pre>';

    exit();*/

    $cont_vueltas_si = 0;

    foreach ($ventas as $key => $value2) {

        $cont_vueltas_si = $cont_vueltas_si + 1;

        echo '<tr>


                  <td>' . (intval($cont_vueltas_si)) . '</td>
                  <td >' . $value2["tipopago"] . '</td>
                  <td >' . $value2["movil"] . '</td>
                  <td >' . $value2["placa"] . '</td>
                  <td >' . $value2["coordinador"] . '</td>
                  <td >' . $value2["dth"] . '</td>
                  <td >' . $value2["internet"] . '</td>
                  <td >' . $value2["pospago"] . '</td>
                  <td >' . $value2["gpon"] . '</td>
                  <td >' . $value2["total"] . '</td>

                </tr>';

    }

    ?>

            </tbody>

        <tfoot >
            <tr>

              <td></td>
              <td></td>
              <td></td>
            <td></td>
                    <td  style="font-weight: bold;">Total:</td>
              <td style="font-weight: bold;"></td>
              <td style="font-weight: bold;"></td>
              <td style="font-weight: bold;"></td>
              <td style="font-weight: bold;"></td>
              <td style="font-weight: bold;"></td>
            </tr>

                <!--  <td  style="font-weight: bold;"><?php echo (array_sum($array_dth)); ?></td>
              <td  style="font-weight: bold;"><?php echo (array_sum($array_internet)); ?></td>
              <td  style="font-weight: bold;"><?php echo (array_sum($array_pospago)); ?></td>
              <td  style="font-weight: bold;"><?php echo (array_sum($array_gpon)); ?></td>
              <td  style="font-weight: bold;"><?php echo (array_sum($array_total)); ?></td>
              <td  style="font-weight: bold;"><?php echo (array_sum($array_total)); ?></td> -->

          </tfoot>

          </table>




    </div>
  </div>

  <!--***********************************************
    *                                               *
    *             FIN VENTAS POR MOVIL              *
    *                                               *
    *************************************************-->


  <!--***********************************************
    *                                               *
    *             VENTAS POR SUPERVISOR             *
    *                                               *
    *************************************************-->

    <div class="card mt-1 collapsed-card col-12">

        <div class="card-header">
            <h3 class="card-title">VENTAS POR SUPERVISOR</h3>

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
          <table class="table table-bordered table-striped dt-responsive display" id="tablasventasXsupervisorreporteventascalle"  width="100%">



              <thead>

                <tr>

                <th style="width:10px">#</th>
                <th>Supervisor</th>
                <th>DTH</th>
                <th>Internet</th>
                <th>Pospago</th>
                <th>GPON</th>
                <th>Total</th>
                </tr>

              </thead>

              <tbody>

                      <?php
if (isset($_GET["startDate"]) && $_GET["startDate"] != "null") {

        $startDate = $_GET["startDate"];

        $endDate = $_GET["endDate"];

    } else {

        date_default_timezone_set('America/Costa_Rica');

        $today = date('Y-m-d');

        $startDate = date('Y-m-01', strtotime($today));

        $endDate = date('Y-m-t', strtotime($today));

    }

    $ventas = ControladorVentasDth::ctrCargarVentasTotalesXSupervisor($startDate, $endDate);
    /*  echo '<pre>'; print_r($ventas); echo '</pre>';

    exit();*/

    $array_dth = array();
    $array_internet = array();
    $array_pospago = array();
    $array_gpon = array();
    $array_total = array();

    foreach ($ventas as $key => $value2) {
        array_push($array_dth, $value2["dth"]);
        array_push($array_internet, $value2["internet"]);
        array_push($array_pospago, $value2["pospago"]);
        array_push($array_gpon, $value2["gpon"]);
        array_push($array_total, $value2["total"]);

        echo '<tr>

                        <td>' . ($key + 1) . '</td>

                        <td>' . $value2["supervisor"] . '</td>
                        <td>' . $value2["dth"] . '</td>
                        <td>' . $value2["internet"] . '</td>
                        <td>' . $value2["pospago"] . '</td>
                        <td>' . $value2["gpon"] . '</td>
                        <td>' . $value2["total"] . '</td>


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
                <td style="font-weight: bold;"></td>


              </tr>

                  <!--  <td  style="font-weight: bold;"><?php echo (array_sum($array_dth)); ?></td>
                <td  style="font-weight: bold;"><?php echo (array_sum($array_internet)); ?></td>
                <td  style="font-weight: bold;"><?php echo (array_sum($array_pospago)); ?></td>
                <td  style="font-weight: bold;"><?php echo (array_sum($array_gpon)); ?></td>
                <td  style="font-weight: bold;"><?php echo (array_sum($array_total)); ?></td>
                <td  style="font-weight: bold;"><?php echo (array_sum($array_total)); ?></td> -->

            </tfoot>


        </table>




          </div>
    </div>

    <!-- /.card -->
<?php

    ?>

<!--*****************************************************


            FIN TABLA VENTAS POR SUPERVISOR


*********************************************************-->





<!--*****************************************************


            INICIO TABLA CON RANGO DE FECHAS


*********************************************************-->




    <div class="card mt-1 collapsed-card col-12">
        <div class="card-header ">

            <h3 class="card-title">COMPARACIÓN POR RANGO DE FECHAS</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
        </div>

          <input type="hidden" id="dtdesde1" name="dtdesde1">
          <input type="hidden" id="dtdesde2" name="dtdesde2">
          <input type="hidden" id="dthasta1" name="dthasta1">
          <input type="hidden" id="dthasta2" name="dthasta2">


        <div class="card-body">
            <div class="row">
                <button  type="button" class="btn btn-default" style="margin: 5px" id="rango1">
                    <span>
                        <i class="fa fa-calendar"></i> Rango de Fecha 1
                    </span>
                    <i class="fa fa-caret-down"></i>
                </button>
                <button  type="button" class="btn btn-default" style="margin: 5px" id="rango2">
                    <span>
                        <i class="fa fa-calendar "></i> Rango de Fecha 2
                    </span>
                    <i class="fa fa-caret-down"></i>
                </button>

                <div class="card-tools pull-right">
                    <button type="button" id="btnbuscartablacomparativacalle" class="btn btn-primary" style="margin: 5px">Buscar</button>
                </div>

            </div>
                <table class="table table-bordered dt-responsive TablaComparativaCalle" id="TablaComparativaCalle" width="100%">

                    <thead>
                        <tr>
                        <th>Coordinador</th>
                        <th>Grupo</th>
                        <th>Representante</th>
                        <th>Division</th>
                        <th>DTH 1</th>
                        <th>DTH 2</th>
                        <th>Diferencia</th>
                        <th>Internet 1</th>
                        <th>Internet 2</th>
                        <th>Diferencia</th>
                        <th>Pospago 1</th>
                        <th>Pospago 2</th>
                        <th>Diferencia</th>
                        <th>GPON 1</th>
                        <th>GPON 2</th>
                        <th>Diferencia</th>
                        <th>Total 1</th>
                        <th>Total 2</th>
                        <th>Diferencia</th>


                        </tr>

                    </thead>

                    <tbody>
                    </tbody>


                    <tfoot >
                        <tr>
                        <td></td>
                            <td></td>
                            <td></td>
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
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>

                        </tr>

                            <!--  <td  style="font-weight: bold;"><?php echo (array_sum($array_dth)); ?></td>
                            <td  style="font-weight: bold;"><?php echo (array_sum($array_internet)); ?></td>
                            <td  style="font-weight: bold;"><?php echo (array_sum($array_pospago)); ?></td>
                            <td  style="font-weight: bold;"><?php echo (array_sum($array_gpon)); ?></td>
                            <td  style="font-weight: bold;"><?php echo (array_sum($array_total)); ?></td>
                            <td  style="font-weight: bold;"><?php echo (array_sum($array_total)); ?></td> -->

                    </tfoot>


                </table>
      </div>
      <!-- /.card-body -->
    </div>

   <!-- /.card -->


<!--**************************************


      FIN TABLA CON RANGO DE FECHAS


*******************************************-->




<!--**************************************


      INICIO TABLA REPORTE MENSUAL POR AÑO


*******************************************-->



 <div class="card mt-1 collapsed-card col-12">

    <div class="card-header">

        <h3 class="card-title">VENTAS MENSUALES</h3>
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

          <button  type="button" class="btn btn-default rangoanualcalle mb-3" id="rangoanualcalle">
            <span>
                <i class="fa fa-calendar"></i> Selecciona año
            </span>
                <i class="fa fa-caret-down"></i>
            </button>

            <input type="hidden" id="dtanualcalle" name="dtanualcalle">


        <table class="table table-bordered table-striped dt-responsive display tablasventasreporteventasanuales" id="tablasventasreporteventasanuales" width="100%">



          <thead>

            <tr>

            <th>MES</th>
            <th>DTH</th>
            <th>INTERNET</th>
            <th>POSPAGO</th>
            <th>GPON</th>
            <th>TOTAL</th>

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

        </tr>
      </tfoot>

    </table>

</div>


          </div>



 <!--**************************************


      FIN TABLA REPORTE POR MES ANUAL


*******************************************-->






 <!--**************************************


      INICIO TABLA CONVENIO DE PAGOS


*******************************************-->



  <div class="card mt-1 collapsed-card col-12">

    <div class="card-header">

        <h3 class="card-title">CONVENIOS DE PAGOS PENDIENTES</h3>
        <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-plus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>

    </div>



<div class="card-body">


   <table class="table table-bordered dt-responsive" id="TablaConvenios" width="100%">

          <thead>

            <tr>
           <th>ID</th>
           <th>Coordinador</th>
            <th>Nombre Cliente</th>
            <th>Fecha Venta</th>
            <th>Monto</th>

            </tr>

          </thead>

          <tbody>

                  <?php

    $ventas = ControladorVentasDth::ctrCargarConvenios();
    //echo '<pre>'; print_r($ventas); echo '</pre>';

    $cont_vueltas_si = 0;

    foreach ($ventas as $key => $value2) {

        $cont_vueltas_si = $cont_vueltas_si + 1;

        echo '<tr>
              <td>' . (intval($cont_vueltas_si)) . '</td>
              <td >' . $value2["representante"] . '</td>
               <td >' . $value2["cliente"] . '</td>
              <td >' . $value2["fecha_ingreso"] . '</td>
              <td class="myCOL">' . $value2["saldo"] . '</td>

            </tr>';

    }

    ?>

          </tbody>

                                    <tfoot >
      <tr>
       <td></td>
        <td></td>
         <td></td>
        <td  style="font-weight: bold;">Total:</td>
        <td style="font-weight: bold;"></td>


      </tr>

          <!--  <td  style="font-weight: bold;"><?php echo (array_sum($array_dth)); ?></td>
        <td  style="font-weight: bold;"><?php echo (array_sum($array_internet)); ?></td>
        <td  style="font-weight: bold;"><?php echo (array_sum($array_pospago)); ?></td>
        <td  style="font-weight: bold;"><?php echo (array_sum($array_gpon)); ?></td>
        <td  style="font-weight: bold;"><?php echo (array_sum($array_total)); ?></td>
        <td  style="font-weight: bold;"><?php echo (array_sum($array_total)); ?></td> -->

  </tfoot>






        </table>





      </div>
      <!-- /.card-body -->

    </div>
    <!-- /.card -->

 <!--**************************************


      FIN TABLA CONVENIO DE PAGOS


*******************************************-->




 <!--**************************************


      INICIO APERTURA/CIERRE DE RUTAS


*******************************************-->



<div class="card collapsed-card col-12 mt-1">
  <div class="card-header">
        <h3 class="card-title">  APERTURA/CIERRE DE RUTAS </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
  </div>

  <!-- INICIO CARD BODY -->
  <div class="card-body col-12 mb-5">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 mb-4">

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control date" autocomplete="off" id="datepicker" aria-describedby="basic-addon1">
                </div>

            </div>
            <!--       Date: <input type='text' class='date' id="datepicker"> -->
        </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-striped dt-responsive display tbl-apertura-rutas" width="100%" id="tbl-apertura-rutas">
                <thead>

                    <tr>

                    <?php

    if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

        echo '<th style="width:10px">#</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Placa</th>
                                <th>Hora Inicio</th>
                                <th>Hora Cierre</th>
                                <th>KM Inicio</th>
                                <th>KM Cierre</th>
                                <th>KM Distancia</th>
                            <th>Pasajeros</th>
                                <th>Estado</th>
                                <th>Acciones</th>';
    } else {
        echo '  <th style="width:10px">#</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Placa</th>
                                <th>KM Inicio</th>
                                <th>KM Cierre</th>
                                <th>KM Distancia</th>
                            <th>Pasajeros</th>
                                <th>Estado</th>
                                <th>Acciones</th>';
    }
    ?>
                    </tr>

                </thead>

            <tbody>

            <?php

    if (isset($_GET["startDate"])) {
        $startDate = $_GET["startDate"];
        $endDate = $_GET["endDate"];
    } else {
        date_default_timezone_set('America/Costa_Rica');
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d');
    }

    $apertura = ControladorVentasDth::ctrCargarInicioCierreRutas($startDate, $endDate);
    /*echo '<pre>'; print_r($apertura); echo '</pre>';*/

    foreach ($apertura as $key => $value2) {

        if ($value2["latitud"] == "") {
            $placa = '<td>' . strtoupper($value2["placa"]) . '&nbsp&nbsp<span class="glyphicon glyphicon-alert" style="color:red"> </span></td>';
        } else {
            $placa = '<td>' . strtoupper($value2["placa"]) . '</td>';
        }
        ;

        if ($value2["Estado"] == "Cerrado") {
            $btncierre = '<td>
                                    <div class="btn-group">
                                        <button class="btn btn-info btn-info-ruta" placa="' . $value2["placa"] . '" fecha="' . $value2["fechainicio"] . '" data-toggle="modal" data-target="#detalle-ruta"> <i class="fa fa-info-circle"></i></button>
                                    </div>
                                </td>';

        } else if ($value2["Estado"] == "No Creado") {

            $btncierre = '<td>
                        <div class="btn-group">
                            <button class="btn btn-info btn-info-ruta disabled"  disabled placa="' . $value2["placa"] . ' " fecha="' . $value2["fechainicio"] . '" data-toggle="modal" data-target="#detalle-ruta"> <i class="fa fa-info-circle"></i></button>
                        </div>
                    </td>';

        } else {

            $btncierre = '<td>
                        <div class="btn-group">
                            <button class="btn btn-info btn-info-ruta" placa="' . $value2["placa"] . '" fecha="' . $value2["fechainicio"] . '" data-toggle="modal" data-target="#detalle-ruta"> <i class="fa fa-info-circle"></i></button>
                        </div>
                    </td>';

        }

        if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

            echo '<tr>

              <td>' . ($key + 1) . '</td>
              <td>' . $value2["coordinador"] . '</td>
              <td>' . date("d-m-Y", strtotime($value2["fechainicio"])) . '</td>
             ' . $placa . '
               <td>' . date("d-m-Y h:m:s", strtotime($value2["fechainicio"])) . '</td>
               <td>' . date("d-m-Y h:m:s", strtotime($value2["fechafinal"])) . '</td>
                <td>' . $value2["kilo_inicio"] . '</td>
              <td>' . $value2["kilo_cierre"] . '</td>
              <td>' . $value2["recorrido"] . '</td>
                            <td>' . $value2["personas"] . '</td>

              <td>' . $value2["Estado"] . '</td>

              ' . $btncierre . '


            </tr>';

        } else {

            echo '<tr>
               <td>' . ($key + 1) . '</td>
              <td>' . $value2["coordinador"] . '</td>
              <td>' . date("d-m-Y", strtotime($value2["fechainicio"])) . '</td>
             ' . $placa . '
               <td>' . $value2["kilo_inicio"] . '</td>
              <td>' . $value2["kilo_cierre"] . '</td>
              <td>' . $value2["recorrido"] . '</td>
              <td>' . $value2["personas"] . '</td>
              <td>' . $value2["Estado"] . '</td>

              ' . $btncierre . '


            </tr>';

        }

    }

    ?>

          </tbody>

        </table>

</div>
</div>

  </div> <!-- FIN CARD BODY -->
</div>

<?php }?>


 <!--**************************************


      FIN APERTURA/CIERRE DE RUTAS


*******************************************-->





</section>
    <!-- /.content -->


<!--=====================================
=            MODAL ORDER DETAIL          =
======================================-->



<!-- Modal -->
<div id="modalVentasCalleDetail" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">


      <!--=====================================
=            MODAL HEADER          =
======================================-->

      <div class="modal-header" style="background:#3c8bdc; color: white">

        <h4 class="card-title">Detalle de Ventas</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!--=====================================
=            MODAL BODY          =
======================================-->

      <div class="modal-body">

       <div class="card-body">

           <div class="panel">INFORMACIÓN DETALLADA DE VENTAS</div>

             <div class="card">
            <div class="card-header">

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding">
          <table class="table table-bordered table-striped dt-responsive" width="100%" id="tableVentasCalleDetails">
             <thead>
                   <tr>
                     <th>Vendedor</th>
                     <th>Representante</th>
                     <th>Sub Tipo</th>
                     <th>Zona</th>
                     <th>DTH</th>
                     <th>Internet</th>
                     <th>Pospago</th>
                     <th>GPON</th>
                     <th>Total</th>
                   </tr>
                   </thead>
                     <tbody id="tbodyid_tableVentasCalleDetails">

                     </tbody>

                         <tfoot id="tfootid_tableVentasCalleDetails">

  </tfoot>
                   </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->






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


<!--=========================================
=                                           =
=         MODAL INFORMACION DE RUTA         =
=                                           =
=============================================-->


<!-- Modal -->
<div id="detalle-ruta" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

     <form role="form" method="post" enctype="multipart/form-data">

      <!--=====================================
=            MODAL HEADER          =
======================================-->

    <div class="modal-header" style="background:#3c8bdc; color: white">
        <h3 class="card-title">Detalle De La Ruta</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

      <!--=====================================
=            MODAL BODY          =
======================================-->

      <div class="modal-body">

       <div class="card-body">


    <div class=" mb-3"><label>Información Ruta</label></div>



<!--==============================================
=        MOSTRAR USUARIO       =
===============================================-->

        <div class="form-group">

          <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" class="form-control input-lg usuario-ruta" id="usuario-ruta" name="usuario-ruta"  placeholder="USUARIO" readonly required>
            </div>

         </div>



<!--==============================================
=        MOSTRAR PLACA      =
===============================================-->

        <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-automobile"></i></span>

            <input type="text" class="form-control input-lg placa-ruta" id="placa-ruta" name="placa-ruta"  placeholder="PLACA" readonly required>

          </div>

         </div>


<label>Apertura Ruta</label>

<!--==============================================
=        MOSTRAR KILOMETRAJE      =
===============================================-->

        <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-dashboard"></i></span>

                            <?php

if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

    echo '<input type="text" class="form-control input-lg kg-inicio" id="kg-inicio" name="kg-inicio"  placeholder="KILOMETRAJE" required>';
} else {
    echo '<input type="text" class="form-control input-lg kg-inicio" id="kg-inicio" name="kg-inicio"  placeholder="KILOMETRAJE" readonly required>';
}
?>


          </div>

         </div>


<div class="card card-solid">

            <div class="">

              <h3 class="card-title">Foto Kilometraje Apertura</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">

              <div id="carousel-foto-inicio-ruta"  class="carousel slide carousel-foto-inicio-ruta" data-ride="carousel">

                <ol class="carousel-indicators">

                  <!-- <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li> -->
                <!--   <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li> -->
                </ol>
                <div class="carousel-inner">

                  <div class="item active"><img src="public/icons/antena-parabolica.png"></div>

                </div>

                <a class="left carousel-control" href="#carousel-foto-inicio-ruta" data-slide="prev">

                  <span class="fa fa-angle-left"></span>

                </a>

                <a class="right carousel-control" href="#carousel-foto-inicio-ruta" data-slide="next">
                  <span class="fa fa-angle-right"></span>

                </a>

              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

            <input type="hidden" name="currentfoto_kilometraje_editar_apertura" id="currentfoto_kilometraje_editar_apertura">




<label>Cierre Ruta</label>



<div class="alert alert-danger mensaje_advertencia" id="mensaje_advertencia" style="display: none;" role="alert">
  Datos del cierre no han sido ingresados
</div>


<!--==============================================
=        MOSTRAR KILOMETRAJE      =
===============================================-->

        <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-dashboard"></i></span>

                                        <?php

if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

    echo '<input type="text" class="form-control input-lg kg-cierre" id="kg-cierre" name="kg-cierre"  placeholder="KILOMETRAJE" required>';
} else {
    echo '<input type="text" class="form-control input-lg kg-cierre" id="kg-cierre" name="kg-cierre"  placeholder="KILOMETRAJE" readonly required>';
}
?>



          </div>

         </div>


<div class="card card-solid">

            <div class="card-header with-border">

              <h3 class="card-title">Foto Kilometraje Cierre</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">

              <div id="carousel-foto-cierre-ruta"  class="carousel slide carousel-foto-cierre-ruta" data-ride="carousel">

                <ol class="carousel-indicators">


                </ol>
                <div class="carousel-inner">

                  <div class="item active"><img src="public/icons/antena-parabolica.png"></div>

                </div>

                <a class="left carousel-control" href="#carousel-foto-cierre-ruta" data-slide="prev">

                  <span class="fa fa-angle-left"></span>

                </a>

                <a class="right carousel-control" href="#carousel-foto-cierre-ruta" data-slide="next">
                  <span class="fa fa-angle-right"></span>

                </a>

              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <input type="hidden" name="currentfoto_kilometraje_editar_cierre" id="currentfoto_kilometraje_editar_cierre">





<label>Kilometros Recorridos</label>

  <div class="form-group">

    <div class="input-group">

      <span class="input-group-addon"><i class="fa fa-dashboard"></i></span>

      <input type="text" class="form-control input-lg kg-recorridos-cierre" id="kg-recorridos-cierre" name="kg-recorridos-cierre"  placeholder="Kilometros Recorridos" readonly required>

     </div>

  </div>






<div id="map"></div>

 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6DXuX_kl6D4J3_Du6ud68odvppSg5i3g&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 450px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>


       </div>

      </div>


                  <input type="hidden" class="fecha-cierre" id="fecha-cierre" name="fecha-cierre" required>
                  <input type="hidden" class="fecha-inicio" id="fecha-inicio" name="fecha-inicio" required>


        <input type="hidden" class="form-control input-lg id-inicio" id="id-inicio" name="id-inicio"  readonly required>



                         <input type="hidden" class="form-control input-lg id-cierre" id="id-cierre" name="id-cierre" readonly required>





      <!--=====================================
=            MODAL FOOTER           =
======================================-->

      <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

     <?php

if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

    echo ' <button type="submit" class="btn btn-primary noEnterSubmit" id="btn-editar-ruta">Editar</button>';

}

?>




      </div>

      </form>


       <?php

$AgregarCierre = new ControladorVentasDth();

$AgregarCierre->ctrActualizarRuta();

?>

    </div>

  </div>

</div>

