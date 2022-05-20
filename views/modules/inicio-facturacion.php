<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Emision Facturas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Emision Facturas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
 
    <div class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-header">

                            <?php 


if(isset($_SESSION['empresa'])){

    $empresa = $_SESSION['empresa'];

date_default_timezone_set('America/Costa_Rica');
if(isset($_GET['startDate'])){

    $fechaInicio = $_GET['startDate'];
    $fechaFin = $_GET['endDate'];

}else{

    $fechaInicio = date('Y-m-01');

    $fechaFin = date('Y-m-t');

}

$añoactual = date('Y');
$añoanterior = strtotime ('-1 year' , strtotime($añoactual));
$añoanterior = date('Y',$añoanterior);



$FecActual = date('Y-m-d');
$FecActualmenosdias = strtotime ('-1 days' , strtotime($FecActual));
$FecActualmenosdias = date('Y-m-d',$FecActualmenosdias);

$FecActualmenosmes = strtotime ('-1 month' , strtotime($FecActualmenosdias));
$FecActualmenosmes = date('Y-m-d',$FecActualmenosmes);

$primerdiaactual = date('Y-m-01');

$primerdiaactuallmenosmes = strtotime ('-1 month' , strtotime($primerdiaactual));
$primerdiaactuallmenosmes = date('Y-m-d',$primerdiaactuallmenosmes);

// var_dump($FecActual);
// var_dump($FecActualmenosdias);
// var_dump($FecActualmenosmes);
// var_dump($primerdiaactual);
// var_dump($primerdiaactuallmenosmes);
 
$topClients = InicioFacturacionController::ctrCargarTopClientes($fechaInicio, $fechaFin, $empresa);

$topProducts = InicioFacturacionController::ctrCargarTopProductos($fechaInicio, $fechaFin, $empresa);

$CompVentas = InicioFacturacionController::ctrCargarCompVentas($añoactual, $añoanterior, $empresa);

$PorsentajeMeses = InicioFacturacionController::ctrCargarPorcentXmes($FecActualmenosdias, $primerdiaactual, $FecActualmenosmes, $primerdiaactuallmenosmes, $empresa);

$cantFacturas = InicioFacturacionController::ctrCargarFacturas($fechaInicio, $fechaFin, $empresa);

$cantTiquetes = InicioFacturacionController::ctrCargartiquetes($fechaInicio, $fechaFin, $empresa);

$cantNotasC = InicioFacturacionController::ctrCargarNotasC($fechaInicio, $fechaFin, $empresa);

$cantNotasD = InicioFacturacionController::ctrCargarNotasD($fechaInicio, $fechaFin, $empresa);

$CompVentasSemanas = InicioFacturacionController::ctrCargarPorcentXSemanas($empresa);


$arrayAnoAct = [];
for($i =0; $i < count($CompVentas); $i++){
    
    array_push($arrayAnoAct , $CompVentas[$i]["totalañoactual"]);

}

$totalFactAnual = array_sum($arrayAnoAct);

// var_dump($CompVentasSemanas);
// var_dump($PorsentajeMeses[1]["total"]);

// var_dump($arrayAnoAct);
try {

if($PorsentajeMeses[0]["total"] == 0){

    $sumaMesAnterior = 0;

}else{

    $sumaMesAnterior = (($PorsentajeMeses[0]["total"]) / $PorsentajeMeses[1]["total"] -1) * 100;

}

// var_dump(number_format( (float) $sumaMesAnterior, 1, '.', ','));

$TotalComPorMes = number_format( (float) $sumaMesAnterior, 1, '.', ',');


} catch (Exception $e) {
    // throw new Exception ("No se encuentras facturas realizadas en esta fecha");
echo '<h3>',  $e->getMessage(), "\n </h3>";
}


}else{ ?>

<script>


 Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "Seleccionar Empresa!",
    footer: ""
  });


</script>



    

<?php } ?>

                        </div>

                        <div class="card-body">

                            <div class="row">
                                <!-- INICIO DE LOS REPORTES -->
                                <div class="col-lg-12 col-md-12 col-sm-12">

                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <button type="button" class="btn btn-default "
                                                id="daterange-btn-dashboardFact">

                                                <span>

                                                    <i class="fa fa-calendar"></i> Rango de Fecha

                                                </span>

                                                <i class="fa fa-caret-down"></i>


                                            </button>

                                        </div>
                                        <br><br>
                                        <div class="col-lg-6 col-12">
                                            <!-- small box -->
                                            <div class="small-box bg-info">
                                                <div class="inner">

                                                    <h3 class="text-center"> <?php echo $cantFacturas[0]["cantidad"] ?>
                                                    </h3>

                                                    <p class="text-center">Facturas Electonicas</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion-document"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">More info <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <!-- small box -->
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <h3 class="text-center"> <?php echo $cantTiquetes[0]["cantidad"] ?>
                                                    </h3>

                                                    <p class="text-center">Tiquetes Electronicos</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion-document"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">More info <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-12">
                                            <!-- small box -->
                                            <div class="small-box bg-secondary">
                                                <div class="inner">
                                                    <h3 class="text-center"> <?php echo $cantNotasC[0]["cantidad"] ?>
                                                    </h3>

                                                    <p class="text-center">Notas Credico Electronicas</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion-document"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">More info <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <!-- small box -->
                                            <div class="small-box bg-primary">
                                                <div class="inner">
                                                    <h3 class="text-center"> <?php echo $cantNotasD[0]["cantidad"] ?>
                                                    </h3>

                                                    <p class="text-center">Notas Debido Electronicas</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion-document"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">More info <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>

                                        </div>

                                        <!-- <div class="card"> -->
                                        <div class="col-md-4">

                                            <!-- <button type="button" class="btn btn-default "
                                                id="daterange-btn-dashboardFact">

                                                <span>

                                                    <i class="fa fa-calendar"></i> Rango de Fecha

                                                </span>

                                                <i class="fa fa-caret-down"></i>


                                            </button> -->

                                            <div class="chart-responsive ">
                                                <canvas id="graficoClientes" height="150"></canvas>
                                            </div>
                                            <!-- ./chart-responsive -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-2">


                                            <ul class="chart-legend clearfix">
                                                <?php
                                            
                                            for($i =0; $i < count($topClients); $i++){

                                                // echo '<li><i class="far fa-circle text-danger"></i> '.$topClients[$i]["nombre_cliente"].'</i></li>';
                                                if($i == 0){

                                                    echo '<li style="font-size: 12px;"><i class="far fa-circle text-danger"></i> '.$topClients[$i]["nombre_cliente"].'</i></li><br>';

                                                }else if($i == 1){

                                                    echo '<li style="font-size: 12px;"><i class="far fa-circle text-success"></i> '.$topClients[$i]["nombre_cliente"].'</i></li><br>';

                                                }else if($i == 2){

                                                    echo '<li style="font-size: 12px;"><i class="far fa-circle text-warning"></i> '.$topClients[$i]["nombre_cliente"].'</i></li><br>';

                                                }else if($i == 3){

                                                    echo '<li style="font-size: 12px;"><i class="far fa-circle text-info"></i> '.$topClients[$i]["nombre_cliente"].'</i></li><br>';

                                                }else if($i == 4){

                                                    echo '<li style="font-size: 12px;"><i class="far fa-circle text-primary"></i> '.$topClients[$i]["nombre_cliente"].'</i></li><br>';

                                                }

                                            }
                                            
                                            ?>
                                                <!-- <li><i class="far fa-circle text-danger"></i> COMISION PERMANENCIA DTH</li>
                                                <li><i class="far fa-circle text-success"></i> Recarga Tiempo Aire Electrónico</li>
                                                <li><i class="far fa-circle text-warning"></i> Tarjeta Prepago 1000 </li>
                                                <li><i class="far fa-circle text-info"></i> Tarjeta Prepago 2000 </li>
                                                <li><i class="far fa-circle text-primary"></i> TAE </li>  -->
                                            </ul>

                                        </div>
                                        <!-- </div> -->

                                        <div class="col-md-4">

                                            <!-- <button type="button" class="btn btn-default "
                                            id="daterange-btn-dashboardFact">

                                            <span>

                                                <i class="fa fa-calendar"></i> Rango de Fecha

                                            </span>

                                            <i class="fa fa-caret-down"></i>

                                        </button> -->

                                            <div class="chart-responsive">
                                                <canvas id="GraficoProductos" height="150"></canvas>
                                            </div>
                                            <!-- ./chart-responsive -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-2 ">

                                            <ul class="chart-legend clearfix">
                                                <?php

                                            for($i =0; $i < count($topProducts); $i++){

                                                // echo '<li><i class="far fa-circle text-danger"></i> '.$topClients[$i]["nombre_cliente"].'</i></li>';
                                                if($i == 0){

                                                    echo '<li style="font-size: 12px;"><i class="far fa-circle text-danger"></i> '.$topProducts[$i]["nombre"].'</i></li><br>';

                                                }else if($i == 1){

                                                    echo '<li style="font-size: 12px;"><i class="far fa-circle text-success"></i> '.$topProducts[$i]["nombre"].'</i></li><br>';

                                                }else if($i == 2){

                                                    echo '<li style="font-size: 12px;"><i class="far fa-circle text-warning"></i> '.$topProducts[$i]["nombre"].'</i></li><br>';

                                                }else if($i == 3){

                                                    echo '<li style="font-size: 12px;"><i class="far fa-circle text-info"></i> '.$topProducts[$i]["nombre"].'</i></li><br>';

                                                }else if($i == 4){

                                                    echo '<li style="font-size: 12px;"><i class="far fa-circle text-primary"></i> '.$topProducts[$i]["nombre"].'</i></li><br>';

                                                }

                                            }

                                            ?>
                                                <!-- <li><i class="far fa-circle text-danger"></i> COMISION PERMANENCIA DTH</li>
                                                <li><i class="far fa-circle text-success"></i> Recarga Tiempo Aire Electrónico</li>
                                                <li><i class="far fa-circle text-warning"></i> Tarjeta Prepago 1000 </li>
                                                <li><i class="far fa-circle text-info"></i> Tarjeta Prepago 2000 </li>
                                                <li><i class="far fa-circle text-primary"></i> TAE </li>  -->
                                            </ul>
                                        </div>

                                        <!-- /.col-md-6 -->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <!-- <br>
                                            <br> -->
                                            <div class="card">
                                                <div class="card-header border-0">
                                                    <div class="d-flex justify-content-between">
                                                        <h3 class="card-title">Vista por Meses</h3>
                                                        <!-- <a href="javascript:void(0);">View Report</a> -->
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <p class="d-flex flex-column">
                                                            <span class="text-bold text-lg">
                                                                <?php echo '₡ '.number_format( (float) $totalFactAnual, 2, '.', ',') ?>
                                                            </span>
                                                            <span>Total Facturado - <?php echo date('Y') ?> </span>
                                                        </p>
                                                        <p class="ml-auto d-flex flex-column text-right">


                                                            <?php 
                                                            
                                                            if($TotalComPorMes > 0){

                                                                echo "  <span class='text-success'>
                                                                        <i class='fas fa-arrow-up'></i> ".$TotalComPorMes." %
                                                                        </span>";

                                                            }else if($TotalComPorMes == 0){

                                                                echo "  <span class='text-warning'>
                                                                        <i class='fas fa-arrow-right'></i> ".$TotalComPorMes." %
                                                                        </span>";

                                                            }else if($TotalComPorMes < 0){


                                                                echo "  <span class='text-danger'>
                                                                        <i class='fas fa-arrow-down'></i> ".$TotalComPorMes." %
                                                                        </span>";

                                                            }
                                                            
                                                           
                                                            
                                                            ?>

                                                            <span
                                                                class="text-muted"><?php echo 'Desde '.$primerdiaactuallmenosmes.' / Hasta '.$FecActualmenosdias ?>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <!-- /.d-flex -->

                                                    <div class="position-relative mb-4">
                                                        <canvas id="sales-chart" height="200"></canvas>
                                                    </div>

                                                    <div class="d-flex flex-row justify-content-end">
                                                        <span class="mr-2">
                                                            <i class="fas fa-square text-primary"></i> Año Actual
                                                        </span>

                                                        <span>
                                                            <i class="fas fa-square text-gray"></i> Año Anterior
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /.card -->
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 mb-6">
                                            <div class="card ">
                                                <div class="card-header border-0">
                                                    <div class="d-flex justify-content-between">
                                                        <h3 class="card-title">Vista por Semanas</h3>
                                                        <!-- <a href="javascript:void(0);">View Report</a> -->
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <p class="d-flex flex-column">
                                                            <span class="text-bold text-lg"></span>
                                                            <span></span>
                                                        </p>
                                                        <p class="ml-auto d-flex flex-column text-right">
                                                            <span class="text-success">
                                                                <!-- <i class="fas fa-arrow-up"></i>  -->
                                                            </span>
                                                            <span class="text-muted"></span>
                                                        </p>
                                                    </div>
                                                    <!--  /.d-flex -->
                                                </div>
                                                <div class="position-relative mb-4">
                                                    <canvas id="visitors-chart" height="200"></canvas>
                                                </div>
                                     
                                                <div class="d-flex flex-row justify-content-end">
                                                    <span class="mr-2">
                                                        <i class="fas fa-square text-primary"></i> Año Actual
                                                    </span>

                                                    <span>
                                                        <i class="fas fa-square text-gray"></i> Año Anterior
                                                    </span>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <!-- /.col-md-6 -->

                                </div>

                            </div><!-- FIN CONTENEDOR DIVS -->

                        </div><!-- FIN ROW -->

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

<script>
let empresa = sessionStorage.getItem('empresa');

function currencyFormat(num) {
    return '₡' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

//! INICIO GRAFICO CLIENTES QUE MAS HAN COMPRADO
var pieChartCanvas = $('#graficoClientes').get(0).getContext('2d');
var pieData = {
    labels: [

        <?php 

            for($i =0; $i < count($topClients); $i++){

                
                if( $i == 4){

                    echo '"'.$topClients[$i]["nombre_cliente"].'"';

                }else{

                    echo '"'.$topClients[$i]["nombre_cliente"].'",';

                }

            }
            
        ?>

    ],
    datasets: [{
        data: [

            <?php 
            for($i =0; $i < count($topClients); $i++){
           
                if( $i == 4){

                    echo ''.ceil($topClients[$i]["total"]).'';

                }else{

                    echo ''.ceil($topClients[$i]["total"]).',';

                }

            }

            ?>
        ],
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
    }]
}
var pieOptions = {
    legend: {
        display: false
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {

                let label = data.labels[tooltipItem.index];
                let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                return ' ' + label + ': ' + currencyFormat(value);

            }
        }
    }
}

var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions
})

//! INICIO GRAFICO PRODUCTOS MAS COMPRADOS 
var pieChartCanvas2 = $('#GraficoProductos').get(0).getContext('2d');
var pieData2 = {
    labels: [

        <?php 

            for($i =0; $i < count($topProducts); $i++){

                
                if( $i == 4){

                    echo '"'.$topProducts[$i]["nombre"].'"';

                }else{

                    echo '"'.$topProducts[$i]["nombre"].'",';

                }

            }
            
        ?>

    ],
    datasets: [{
        data: [

            <?php 
            for($i =0; $i < count($topProducts); $i++){
           
                if( $i == 4){

                    echo ''.ceil($topProducts[$i]["subtotal"]).'';

                }else{

                    echo ''.ceil($topProducts[$i]["subtotal"]).',';

                }

            }

            ?>
        ],
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
    }]
}

var pieOptions2 = {
    legend: {
        display: false
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {

                let label = data.labels[tooltipItem.index];
                let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                return ' ' + label + ': ' + currencyFormat(value);

            }
        }
    }
}

// Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
// eslint-disable-next-line no-unused-vars

var pieChart2 = new Chart(pieChartCanvas2, {
    type: 'doughnut',
    data: pieData2,
    options: pieOptions2
})


//! INICIO GRAFICO COMPARATIVO POR MESES 

var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
}

var mode = 'index'
var intersect = true

var $salesChart = $('#sales-chart')
// eslint-disable-next-line no-unused-vars
var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
        labels: ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
        datasets: [{
                backgroundColor: '#007bff',
                borderColor: '#007bff',
                data: [<?php 
              
          for($i =0; $i < count($CompVentas); $i++){

            if( $i == 11){

                // echo ''.number_format( (float) $CompVentas[$i]["totalañoactual"], 2, '.', ',').'';
                echo ''.ceil($CompVentas[$i]["totalañoactual"]).'';
            }else{

                // echo ''.number_format( (float) $CompVentas[$i]["totalañoactual"], 2, '.', ',').',';
                echo ''.ceil($CompVentas[$i]["totalañoactual"]).',';
            }

          }
          
          ?>]
            },
            {
                backgroundColor: '#ced4da',
                borderColor: '#ced4da',

                data: [<?php 
              
              for($i =0; $i < count($CompVentas); $i++){
    
                if( $i == 11){
    
                    echo ''.ceil($CompVentas[$i]["totalañoanterior"]).'';
                    // echo ''.number_format( (float) $CompVentas[$i]["totalañoanterior"], 2, '.', ',').'';
    
                }else{
                    
                    echo ''.ceil($CompVentas[$i]["totalañoanterior"]).',';
                    // echo ''.number_format( (float) $CompVentas[$i]["totalañoanterior"], 2, '.', ',').',';
    
                }
                
              }
              
              ?>]
            }
        ]
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {

                    let label = data.labels[tooltipItem.index];
                    let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                    return currencyFormat(value);

                }
            }
        },
        hover: {
            mode: mode,
            intersect: intersect
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                // display: false,
                gridLines: {
                    display: true,
                    lineWidth: '4px',
                    color: 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                },
                ticks: $.extend({
                    beginAtZero: true,

                    // Include a dollar sign in the ticks
                    callback: function(value) {
                        if (value >= 1000) {
                            // value /= 1000
                            // value += 'k'
                        }

                        //   return '₡' + number_format( (float) value, 2, '.', ',')
                        return currencyFormat(value)
                    }
                }, ticksStyle)
            }],
            xAxes: [{
                display: true,
                gridLines: {
                    display: false
                },
                ticks: ticksStyle
            }]
        }
    }
})



//! INICIO GRAFICO COMPARATIVO POR SEMANAS
var $visitorsChart = $('#visitors-chart')
// eslint-disable-next-line no-unused-vars
var visitorsChart = new Chart($visitorsChart, {
    data: {
        labels: [<?php 
            for($i =0; $i < count($CompVentasSemanas); $i++){
           
                if( $i == 4){

                    echo ''.ceil($CompVentasSemanas[$i]["semana"]).'';

                }else{

                    echo ''.ceil($CompVentasSemanas[$i]["semana"]).',';

                }

            }

            ?>],
        datasets: [{
                type: 'line',
                data: [<?php 
            for($i =0; $i < count($CompVentasSemanas); $i++){
           
                if( $i == 4){

                    echo ''.ceil($CompVentasSemanas[$i]["totalañoactual"]).'';

                }else{

                    echo ''.ceil($CompVentasSemanas[$i]["totalañoactual"]).',';

                }

            }

            ?>],
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                pointBorderColor: '#007bff',
                pointBackgroundColor: '#007bff',
                fill: false
                // pointHoverBackgroundColor: '#007bff',
                // pointHoverBorderColor    : '#007bff'
            },
            {
                type: 'line',
                data: [<?php 
            for($i =0; $i < count($CompVentasSemanas); $i++){
           
                if( $i == 4){

                    echo ''.ceil($CompVentasSemanas[$i]["totalañoanterior"]).'';

                }else{

                    echo ''.ceil($CompVentasSemanas[$i]["totalañoanterior"]).',';

                }

            }

            ?>],
                backgroundColor: 'tansparent',
                borderColor: '#ced4da',
                pointBorderColor: '#ced4da',
                pointBackgroundColor: '#ced4da',
                fill: false
                // pointHoverBackgroundColor: '#ced4da',
                // pointHoverBorderColor    : '#ced4da'
            }
        ]
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {

                    let label = data.labels[tooltipItem.index];
                    let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                    return currencyFormat(value);

                }
            }
        },
        hover: {
            mode: mode,
            intersect: intersect
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                // display: false,
                gridLines: {
                    display: true,
                    lineWidth: '4px',
                    color: 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                },
                ticks: $.extend({
                    beginAtZero: true,

                    // Include a dollar sign in the ticks
                    callback: function(value) {
                      
                        return currencyFormat(value)
                    }
                }, ticksStyle)
            }],
            xAxes: [{
                display: true,
                gridLines: {
                    display: false
                },
                ticks: ticksStyle
            }]
        }
    }
})
</script>

