  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
      <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Evaluación De Ruta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Masivos</a></li>
                        <li class="breadcrumb-item active">Evaluación De Ruta</li>
                    </ol>
                </div>
            </div>
      </div><!-- /.container-fluid -->
    </section> 

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <?php
                $mensaje = "Selecciona la fecha";
                date_default_timezone_set('America/Costa_Rica');

                if(isset($_GET["day"]) && $_GET["day"] != "null"){
                    
                    $mensaje = date('d-m-Y', strtotime($_GET["day"]));

                }
                echo '<div class="card-header">      
                    <button  type="button" class="btn btn-default fechaPicker" id="fechaPicker">
                        <span>
                            <i class="fa fa-calendar"></i> '.$mensaje.'
                        </span>
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div>';
            ?>
            <div class="card-body">
                <?php
                    $today = "";
                    date_default_timezone_set('America/Costa_Rica');

                    if(isset($_GET["day"]) && $_GET["day"] != "null"){
                        
                        $today = $_GET["day"];

                    } else {
                        $today = date('Y-m-d');
                        
                    }

                    $todayFormat = date('d-m-Y', strtotime($today));
                    echo '<h4>Mostrando datos del: '.$todayFormat.'</h4>';

                    $firstday = date('Y-m-01', strtotime($today));

                    $lastday = date('Y-m-t', strtotime($today));
                    // Convirtiendo en timestamp las fechas
                    $fechainicio = strtotime($firstday);
                    $fechafin = strtotime($lastday);

                    $diasferiados=[ '2021-04-01','2021-04-02'];
                
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

                                // Convirtiendo en timestamp las fechas
                    $fechainicio = strtotime($today);
                    $fechafin = strtotime($lastday);
                
                    // Incremento en 1 dia
                    $diainc = 24*60*60;
                
                    // Arreglo de dias habiles, inicianlizacion
                    $diashabilesahoy = array();
                
                    // Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
                    for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
                            // Si el dia indicado, no es sabado o domingo es habil
                        if (!in_array(date('N', $midia), array(7))) { // DOC: http://www.php.net/manual/es/function.date.php
                                    // Si no es un dia feriado entonces es habil
                            if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
                                array_push($diashabilesahoy, date('Y-m-d', $midia));
                            }
                        }
                    }

                    // Convirtiendo en timestamp las fechas
                    $fechainicio = strtotime($today);
                    $fechafin = strtotime($lastday);
                    $fechaAyer = date("Y-m-d",strtotime($today."- 1 days"));
                    $diainc = 24*60*60;
                    if($today == date('Y-m-01')){
                        $fechaAyer = $today;
            
                    }else{
            
                         $fechaAyer = date("Y-m-d",strtotime($today."- 1 days"));
            
                    }
                
                    // Arreglo de dias habiles, inicianlizacion
                    $diashabilesahoy = array();
                
                    // Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
                    for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
                            // Si el dia indicado, no es sabado o domingo es habil
                        if (!in_array(date('N', $midia), array(7))) { // DOC: http://www.php.net/manual/es/function.date.php
                                    // Si no es un dia feriado entonces es habil
                                    
                            if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
                                array_push($diashabilesahoy, date('Y-m-d', $midia));
                            }
                                    
                        }
                    }



                    echo '<div class="row">';
                        $iconoVentasMeta = '';
                        $iconoVisitaDiaria = '';
                        $iconoVisitaCliente = '';
                        $iconoNuevosClientes = '';
                        $rendimientoTotal = 0;
                        $ventaHoyTotal = 0;
                        $visitaDiariaTotal = 0;
                        $visitaClienteTotal = 0;
                        $nuevosClientesTotal = 0;
                        
                        $count = 0;

                        $ventas = ReporteVentasBodegaController::CtrMetas($firstday,$lastday,$today,$fechaAyer);
                        $visitaDiaria = ReporteVentasBodegaController::CtrVisitaDiaria($firstday, $today);
                        $visitaCliente = ReporteVentasBodegaController::CtrVisitaCliente($firstday, $today);
                        $nuevosClientes = ReporteVentasBodegaController::CtrMetaNuevosClientes($firstday,$lastday,$fechaAyer,$today);

                       /* echo '<pre>'; print_r($ventas); echo '</pre>';
                        exit();*/

                        foreach($ventas as $key => $value) {

                            
                            $iconoVentasMeta = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                            $iconoVisitaDiaria = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                            $iconoVisitaCliente = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                            $iconoNuevosClientes = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                            $acumulado=0;
                            
                            
                            /*echo '<pre>'; print_r($ventas); echo '</pre>';
                            exit();*/
                            
                            $ventaMeta = ($value[2]-$value[3])/count($diashabilesahoy);
                            
                            $ventaHoy = $value[1];

                            if ($ventaHoy >= $ventaMeta) {
                                $acumulado = $acumulado + 25;
                                $iconoVentasMeta = '<i class="fas fa-check" style="color:#008f39;"></i>';
                                $rendimientoTotal = $rendimientoTotal + 1;
                                $ventaHoyTotal = $ventaHoyTotal + 1;
                            }


                            if ($visitaDiaria[$count][1] == 'Si') {
                                $acumulado = $acumulado + 25;
                                $iconoVisitaDiaria = '<i class="fas fa-check" style="color:#008f39;"></i>';
                                $rendimientoTotal = $rendimientoTotal + 1;
                                $visitaDiariaTotal = $visitaDiariaTotal + 1;
                            }

                            
                            if ($visitaCliente[$count][3] == 'Si') {
                                $acumulado = $acumulado + 25;
                                $iconoVisitaCliente = '<i class="fas fa-check" style="color:#008f39;"></i>';
                                $rendimientoTotal = $rendimientoTotal + 1;
                                $visitaClienteTotal = $visitaClienteTotal + 1;
                            }

                            
                            $nuevoMeta = ($nuevosClientes[$count][1]-$nuevosClientes[$count][2])/count($diashabilesahoy);
                            $nuevoHoy = $nuevosClientes[$count][3];
                            
                            
                            if($nuevoHoy >= $nuevoMeta) {
                                $acumulado = $acumulado + 25;
                                $iconoNuevosClientes = '<i class="fas fa-check" style="color:#008f39;"></i>';
                                $rendimientoTotal = $rendimientoTotal + 1;
                                $nuevosClientesTotal = $nuevosClientesTotal + 1;
                            }

                            $color = "#ff0000";
                            $mensaje = "Deficiente.";

                            if ($acumulado == 50){
                                $color = "#FF7B07 ";
                                $mensaje = "Regular.";
                            }

                            if ($acumulado == 75){
                                $color = "#FCCA00";
                                $mensaje = "Buena.";
                            }

                            if ($acumulado == 100){
                                $color = "#008f39";
                                $mensaje = "Excelente.";
                            }

                            

                            
                            echo '
                            <div class="col-12 col-md-6 col-lg-3 mt-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">'.$value[0].'<h3>
                                    </div>
                                    <div class="card-body text-center">
                                    
                                        <input type="text" class="knob" value="'.$acumulado.'" data-skin="tron" data-thickness="0.2" data-width="120"
                                            data-height="120" data-fgColor="'.$color.'" data-readonly="true">
                
                                        <div class="knob-label">'.$mensaje.'</div>

                                        <div class="col-10 offset-1" style="text-align: justify !important;">
                                            <p>'.$iconoVentasMeta.' Meta de TAE y Raspables.</p>
                                            <p>'.$iconoVisitaDiaria.' Efectividad de Compra.</p>
                                            <p>'.$iconoVisitaCliente.' Efectividad de Visita.</p>
                                            <p>'.$iconoNuevosClientes.' Clientes Nuevos.</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            ';
                            $count++;
                        
                        }
                    echo '</div>';

                    
                    $porcenRendimientoTotal = ($rendimientoTotal / ($count*4))*100;
                    $porcenVentaHoy = ($ventaHoyTotal / $count)*100;
                    $porcenVisitaDiaria = ($visitaDiariaTotal / $count)*100;
                    $porcenVisitaCliente = ($visitaClienteTotal / $count)*100;
                    $porcenClienteNuevo = ($nuevosClientesTotal / $count)*100;
                    $colorTotal = '#ff0000';
                    $colorVentaHoy = '#ff0000';
                    $colorVisitaDiaria = '#ff0000';
                    $colorVisitaCliete = '#ff0000';
                    $colorClienteNuevo = '#ff0000';

                    //COLOR RENDIMIENTO TOTAL
                    
                    if ($porcenRendimientoTotal >= 50){
                        $colorTotal = "#FF7B07 ";
                    }

                    if ($porcenRendimientoTotal >= 75){
                        $colorTotal = "#FCCA00";
                    }

                    if ($porcenRendimientoTotal >= 90){
                        $colorTotal = "#008f39";
                    }

                    //COLOR VENTA HOY

                    if ($porcenVentaHoy >= 50){
                        $colorVentaHoy = "#FF7B07 ";
                    }

                    if ($porcenVentaHoy >= 75){
                        $colorVentaHoy = "#FCCA00";
                    }

                    if ($porcenVentaHoy >= 90){
                        $colorVentaHoy = "#008f39";
                    }

                    //COLOR VISITA DIARIA

                    if ($porcenVisitaDiaria >= 50){
                        $colorVisitaDiaria = "#FF7B07 ";
                    }

                    if ($porcenVisitaDiaria >= 75){
                        $colorVisitaDiaria = "#FCCA00";
                    }

                    if ($porcenVisitaDiaria >= 90){
                        $colorVisitaDiaria = "#008f39";
                    }

                    //COLOR VISITA CLIENTES

                    if ($porcenVisitaCliente >= 50){
                        $colorVisitaCliete = "#FF7B07 ";
                    }

                    if ($porcenVisitaCliente >= 75){
                        $colorVisitaCliete = "#FCCA00";
                    }

                    if ($porcenVisitaCliente >= 90){
                        $colorVisitaCliete = "#008f39";
                    }

                    //COLOR NUEVOS CLIENTES

                    if ($porcenClienteNuevo >= 50){
                        $colorClienteNuevo = "#FF7B07 ";
                    }

                    if ($porcenClienteNuevo >= 75){
                        $colorClienteNuevo = "#FCCA00";
                    }

                    if ($porcenClienteNuevo >= 90){
                        $colorClienteNuevo = "#008f39";
                    }

                    //GRAFICO RENDIMIENTO TOTAL

                    echo '

                        <div class="card">
                            <div class="card-header">
                                <h4>Evaluación Total</h4>
                            </div>
                            <div class="card-body text-center">
                                <div class="offset-0 offset-md-3 offset-lg-3 col-12 col-md-6 col-lg-6 mt-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                        
                                            <input type="text" class="knob" value="'.number_format((float)$porcenRendimientoTotal,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                data-height="120" data-fgColor="'.$colorTotal.'" data-readonly="true">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';

                    echo '
                        <div class="row">
                            <div class="card col-12">
                                <div class="card-header">
                                    <h4>Evaluación Por Sección</h4>
                                </div>
                                <div class="card-body">
                                    <h4 class="row">
                                        <div class="col-12 col-md-6 col-lg-3 mt-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Meta de TAE y Raspables.</h4>
                                                </div>
                                                <div class="card-body text-center">
                                                
                                                    <input type="text" class="knob" value="'.number_format((float)$porcenVentaHoy,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                        data-height="120" data-fgColor="'.$colorVentaHoy.'" data-readonly="true">
                                                </div>
                                                
                                            </div>
                                        </div>

                                        
                                        <div class="col-12 col-md-6 col-lg-3 mt-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Efectividad de Compra.</h4>
                                                </div>
                                                <div class="card-body text-center">
                                                
                                                    <input type="text" class="knob" value="'.number_format((float)$porcenVisitaDiaria,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                        data-height="120" data-fgColor="'.$colorVisitaDiaria.'" data-readonly="true">
                                                </div>
                                                
                                            </div>
                                        </div>

                                        
                                        <div class="col-12 col-md-6 col-lg-3 mt-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Efectividad de Visita.</h4>
                                                </div>
                                                <div class="card-body text-center">
                                                
                                                    <input type="text" class="knob" value="'.number_format((float)$porcenVisitaCliente,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                        data-height="120" data-fgColor="'.$colorVisitaCliete.'" data-readonly="true">
                                                </div>
                                                
                                            </div>
                                        </div>

                                        
                                        <div class="col-12 col-md-6 col-lg-3 mt-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Clientes Nuevos.</h4>
                                                </div>
                                                <div class="card-body text-center">
                                                
                                                    <input type="text" class="knob" value="'.number_format((float)$porcenClienteNuevo,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                        data-height="120" data-fgColor="'.$colorClienteNuevo.'" data-readonly="true">
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';

                    

                ?>
            </div>


        </div>



    </section>


</div>
              