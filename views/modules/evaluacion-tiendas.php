  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
      <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Evaluación De Tiendas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Masivos</a></li>
                        <li class="breadcrumb-item active">Evaluación De Tiendas</li>
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
                    <button  type="button" class="btn btn-default fechaPickerTiendas" id="fechaPickerTiendas">
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
                    echo '<h4 style="font-size: 20px">Mostrando datos del: '.$todayFormat.'</h4>';

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
                    $fecahinicio = strtotime($firstday);
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

                    // Convirtiendo en timestamp las fechas
                    $fechainicio = strtotime($today);
                    $fechafin = strtotime($lastday);
                    $fechaAntier = date("Y-m-d",strtotime($today."- 2 days"));
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

                    $fechainicio = date("Y-m-1",strtotime($today));
                    $fechafin = strtotime($lastday);
                    $fechaAyer = date("Y-m-d",strtotime($today."- 1 days"));
                    $fechaAntier = date("Y-m-d",strtotime($today."- 2 days"));
                    

                    $evaluacion = ControladorEvaluacionTiendas::CtrCargarEvaluacion($fechainicio, $fechaAntier, $fechaAyer, $today);
                    
                   /* echo '<pre>'; print_r($evaluacion); echo '</pre>';
                            exit();*/

                    echo '<div class="row">';
                        
                        $contador = 0;
                        $acumuladoHoraInicio = 0;
                        $acumuladoMetaPospago = 0;
                        $acumuladoPendientes = 0;
                        $acumuladoRecaudacion = 0;
                        $acumuladoMetaLLave = 0;
                        $acumuladoTotal = 0;

                        foreach($evaluacion as $key => $value) {
                            $contador = $contador+1;
                            
                            $acumulado = 0;
                            $horaInicioIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                            $metaPospagoIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                            $pendientesIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                            $metaRecaudacionIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                            $metaLlaveIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';

                            /*********************
                             * HORA DE INICIO    *
                             ********************/
                            $estado = $value["estado"];
                           if ($estado == "SI"){
                               $acumulado = $acumulado + 20;
                               $acumuladoHoraInicio = $acumuladoHoraInicio + 1;
                               $horaInicioIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';
                           }


                            /*********************
                             * META POSPAGO HOY  *
                             ********************/
                           $metaPospago = $value["meta pospago"];
                           $pospagoHoy = $value["pospagohoy"];
                           $pospagoAyer = $value["pospagoayer"];

                           $newMetaPospago = ($metaPospago - $pospagoAyer) / count($diashabilesahoy);

                           if ($newMetaPospago <= $pospagoHoy){
                               $acumulado = $acumulado + 20;
                               $acumuladoMetaPospago = $acumuladoMetaPospago + 1;
                               $metaPospagoIcon= '<i class="fas fa-check" style="color:#008f39;"></i>';
                           }


                            /*********************
                             *    PENDIENTES     *
                             ********************/
                           $pendientes = $value["estado pendientes"];
                           if ($pendientes == "Si"){
                               $acumulado = $acumulado + 20;
                               $acumuladoPendientes = $acumuladoPendientes + 1;
                               $pendientesIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';
                           }


                            /***********************
                             * META DE RECAUDACION *
                             **********************/
                           $metaRecaudacion = $value["meta recaudacion"];
                           $recaudacionHoy = $value["recaudacionhoy"];
                           $recaudacionAyer = $value["recaudacionayer"];
                           $newMetaRecaudacion = ($metaRecaudacion - $recaudacionAyer) / count($diashabilesahoy);

                           if ($newMetaRecaudacion <= $recaudacionHoy){
                               $acumulado = $acumulado + 20;
                               $acumuladoRecaudacion = $acumuladoRecaudacion + 1;
                               $metaRecaudacionIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';
                           }


                            /*********************
                             *    META LLAVE     *
                             ********************/
                           $metaLlave = $value["meta llave"];
                           $llaveHoy = $value["llavehoy"];
                           $llaveayer = $value["llaveayer"];
                           
                           $newMetaLLave = ($metaLlave - $llaveayer) / count($diashabilesahoy);

                           if ($newMetaLLave <= $llaveHoy){
                               $acumulado = $acumulado + 20;
                               $acumuladoMetaLLave = $acumuladoMetaLLave + 1;
                               $metaLlaveIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';
                           }

                           $color = "#ff0000";
                           $mensaje = "Deficiente.";

                           if ($acumulado >= 50){
                               $color = "#FF7B07 ";
                               $mensaje = "Regular.";
                           }

                           if ($acumulado >= 75){
                               $color = "#FCCA00";
                               $mensaje = "Buena.";
                           }

                           if ($acumulado >= 90){
                               $color = "#008f39";
                               $mensaje = "Excelente.";
                           }


                            
                            echo '
                            <div class="col-12 col-md-6 col-lg-3 mt-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">'.$value["nombre"].'<h3>
                                    </div>
                                    <div class="card-body text-center">
                                    
                                        <input type="text" class="knobTiendas" value="'.$acumulado.'" data-skin="tron" data-thickness="0.2" data-width="120"
                                            data-height="120" data-fgColor="'.$color.'" data-readonly="true">
                
                                        <div class="knobTiendas-label">'.$mensaje.'</div>

                                        <div class="col-10 offset-1" style="text-align: justify !important;">
                                            <p>'.$horaInicioIcon.' Hora de Apertura.</p>
                                            <p>'.$metaPospagoIcon.' Meta de Pospago.</p>
                                            <p>'.$pendientesIcon.' Lista de Pendientes.</p>
                                            <p>'.$metaRecaudacionIcon.' Meta de Recaudación.</p>
                                            <p>'.$metaLlaveIcon.' Meta de LLaves.</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            ';
                            
                        }
                    echo '</div>';
                    
                    $acumuladoTotal = $acumuladoHoraInicio + $acumuladoMetaPospago + $acumuladoPendientes + $acumuladoRecaudacion + $acumuladoMetaLLave;

                    $porcenHoraInicio = ($acumuladoHoraInicio / $contador)*100;
                    $porcenMetaPospago = ($acumuladoMetaPospago / $contador)*100;
                    $porcenPendientes = ($acumuladoPendientes / $contador)*100;
                    $porcenRecaudacion = ($acumuladoRecaudacion / $contador)*100;
                    $porcenMetaLlave = ($acumuladoMetaLLave / $contador)*100;
                    $porcenAcumuladoTotal = ($acumuladoTotal / ($contador*5))*100;
                   
                   
                    $colorHoraInicio = '#ff0000';
                    $colormetaPospago = '#ff0000';
                    $colorPendientes = '#ff0000';
                    $colorRecaudacion = '#ff0000';
                    $colorAcumuladoTotal = '#ff0000';
                    $colorMetaLLaves = '#ff0000';

                    //COLOR HORA DE INICIO
                    
                    if ($porcenHoraInicio >= 50){
                        $colorHoraInicio = "#FF7B07 ";
                    }

                    if ($porcenHoraInicio >= 75){
                        $colorHoraInicio = "#FCCA00";
                    }

                    if ($porcenHoraInicio >= 90){
                        $colorHoraInicio = "#008f39";
                    }

                    //COLOR META POSPAGO

                    if ($porcenMetaPospago >= 50){
                        $colormetaPospago = "#FF7B07 ";
                    }

                    if ($porcenMetaPospago >= 75){
                        $colormetaPospago = "#FCCA00";
                    }

                    if ($porcenMetaPospago >= 90){
                        $colormetaPospago = "#008f39";
                    }

                    //COLOR PENDIENTES

                    if ($porcenPendientes >= 50){
                        $colorPendientes = "#FF7B07 ";
                    }

                    if ($porcenPendientes >= 75){
                        $colorPendientes = "#FCCA00";
                    }

                    if ($porcenPendientes >= 90){
                        $colorPendientes = "#008f39";
                    }

                    //COLOR RECAUDACION

                    if ($porcenRecaudacion >= 50){
                        $colorRecaudacion = "#FF7B07 ";
                    }

                    if ($porcenRecaudacion >= 75){
                        $colorRecaudacion = "#FCCA00";
                    }

                    if ($porcenRecaudacion >= 90){
                        $colorRecaudacion = "#008f39";
                    }

                    //COLOR META LLAVES

                    if ($porcenMetaLlave >= 50){
                        $colorMetaLLaves = "#FF7B07 ";
                    }

                    if ($porcenMetaLlave >= 75){
                        $colorMetaLLaves = "#FCCA00";
                    }

                    if ($porcenMetaLlave >= 90){
                        $colorMetaLLaves = "#008f39";
                    }

                    //COLOR ACUMULADO TOTAL

                    if ($porcenAcumuladoTotal >= 50){
                        $colorAcumuladoTotal = "#FF7B07 ";
                    }

                    if ($porcenAcumuladoTotal >= 75){
                        $colorAcumuladoTotal = "#FCCA00";
                    }

                    if ($porcenAcumuladoTotal >= 90){
                        $colorAcumuladoTotal = "#008f39";
                    }


                    //GRAFICO ACUMULADO TOTAL

                    echo '

                        <div class="card">
                            <div class="card-header">
                                <h4>Evaluación Total</h4>
                            </div>
                            <div class="card-body text-center">
                                <div class="offset-0 offset-md-3 offset-lg-3 col-12 col-md-6 col-lg-6 mt-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                        
                                            <input type="text" class="knobTiendas" value="'.number_format((float)$porcenAcumuladoTotal,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                data-height="120" data-fgColor="'.$colorAcumuladoTotal.'" data-readonly="true">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';

                    //GRAFICOS POR SECCION
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
                                                    <h4 class="card-title">Apertura a Tiempo.</h4>
                                                </div>
                                                <div class="card-body text-center">
                                                
                                                    <input type="text" class="knobTiendas" value="'.number_format((float)$porcenHoraInicio,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                        data-height="120" data-fgColor="'.$colorHoraInicio.'" data-readonly="true">
                                                </div>
                                                
                                            </div>
                                        </div>

                                
                                <div class="col-12 col-md-6 col-lg-3 mt-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Meta de Pospago.</h4>
                                        </div>
                                        <div class="card-body text-center">

                                            <input type="text" class="knobTiendas" value="'.number_format((float)$porcenMetaPospago,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                data-height="120" data-fgColor="'.$colormetaPospago.'" data-readonly="true">
                                        </div>

                                    </div>
                                </div>

                                        
                                        <div class="col-12 col-md-6 col-lg-3 mt-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Lista de Pendientes.</h4>
                                                </div>
                                                <div class="card-body text-center">
                                                
                                                    <input type="text" class="knobTiendas" value="'.number_format((float)$porcenPendientes,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                        data-height="120" data-fgColor="'.$colorPendientes.'" data-readonly="true">
                                                </div>
                                                
                                            </div>
                                        </div>

                                        
                                        <div class="col-12 col-md-6 col-lg-3 mt-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Meta de Recaudación.</h4>
                                                </div>
                                                <div class="card-body text-center">
                                                
                                                    <input type="text" class="knobTiendas" value="'.number_format((float)$porcenRecaudacion,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                        data-height="120" data-fgColor="'.$colorRecaudacion.'" data-readonly="true">
                                                </div>
                                                
                                            </div>
                                        </div>


                                        <div class="col-12 col-md-6 col-lg-3 mt-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Meta de Llaves.</h4>
                                                </div>
                                                <div class="card-body text-center">
                                                
                                                    <input type="text" class="knobTiendas" value="'.number_format((float)$porcenMetaLlave,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                        data-height="120" data-fgColor="'.$colorMetaLLaves.'" data-readonly="true">
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
              