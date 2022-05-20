  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
        <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Evaluación Calle</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Ventas</a></li>
                            <li class="breadcrumb-item active">Evaluación Calle</li>
                        </ol>
                    </div>
                </div> 
        </div><!-- /.container-fluid -->
    </section> 

    <section class="content">
        <div class="card col-12">
            <div class="card-body">
                <div class="row">
                    <!--****************************************
                        *    INICIO CARD KILOMETRAJE DIARIO    *
                        ****************************************-->
                    <div class="card col-12">
                        <div class="card-header">
                            <?php
                                $mensaje = "Selecciona una fecha";
                                date_default_timezone_set('America/Costa_Rica');

                                if(isset($_GET["day"]) && $_GET["day"] != "null"){
                                    
                                    $mensaje = date('d-m-Y', strtotime($_GET["day"]));

                                }
                                echo '    
                                    <button  type="button" class="btn btn-default fechaPickerCalles" id="fechaPickerCalles">
                                        <span>
                                            <i class="fa fa-calendar"></i> '.$mensaje.'
                                        </span>
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                ';
                            ?>
                        </div>

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

                                $fechaInicio = date("Y-m-1",strtotime($today));
                                $fechaAyer = date("Y-m-d",strtotime($today."- 1 days"));

                                $evaluacionCombustible = EvaluacionCalleController::ctrCargarKmMetas($fechaInicio,$fechaAyer,$today);
                                $evaluacionVentas = EvaluacionCalleController::ctrCargarMetas($fechaInicio,$fechaAyer,$today);

                               /* echo '<pre>'; print_r($diashabilesmes); echo '</pre>';
                                exit();*/

                                echo '<div class="row">';
                                $acumulado = 0;
                                $count = 0;
                                $metaKmDiarioIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                $metaInternetIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                $metaGponIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                $metaDthIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                $metaPospagoIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                $newMetaDiaria = 0;
                                $acumCombustible = 0;
                                $acumInternet = 0;
                                $acumGpon = 0;
                                $acumDth = 0;
                                $acumPospago = 0;
                                
                                foreach ($evaluacionCombustible as $key => $value) {
                                    $acumulado = 0;
                                    $metaKmDiarioIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                    $metaInternetIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                    $metaGponIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                    $metaDthIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                    $metaPospagoIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                    
                                    /**
                                     * META COMBUSTIBLE
                                     */
                                    $kmAyer = $value["kmhastaayer"];
                                    $kmMeta = $value["cantidad"];
                                    $kmHoy = $value["kmhoy"];

                                    $newMetaDiaria = ($kmMeta-$kmAyer) / count($diashabilesahoy);

                                    if($kmHoy < $newMetaDiaria) {
                                        $acumulado = $acumulado+20;
                                        $metaKmDiarioIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';
                                        $acumCombustible += 1;
                                    }


                                    /**
                                     * META INTERNET
                                     */
                                    $metaInternet = $evaluacionVentas[$count]["cantidadInternet"];
                                    $vendHastaAyer = $evaluacionVentas[$count]["vendInternet"];
                                    $vendHoy = $evaluacionVentas[$count]["vendHoyInternet"];

                                    $newMetaDiaria = ($metaInternet-$vendHastaAyer)/ count($diashabilesahoy);

                                    if ($newMetaDiaria <= $vendHoy) {
                                        $acumulado = $acumulado+20;
                                        $metaInternetIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';
                                        $acumInternet += 1;
                                    }
                                    

                                    /**
                                     * META GPON
                                     */
                                    $metaGpon = $evaluacionVentas[$count]["cantidadGpon"];
                                    $vendHastaAyer = $evaluacionVentas[$count]["vendGpon"];
                                    $vendHoy = $evaluacionVentas[$count]["vendHoyGpon"];
                                        

                                    $newMetaDiaria = ($metaGpon-$vendHastaAyer)/ count($diashabilesahoy);

                                    if ($newMetaDiaria <= $vendHoy) {
                                        $acumulado = $acumulado+20;
                                        $metaGponIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';
                                        $acumGpon += 1;
                                    }

                                    
                                    /**
                                     * META DTH
                                     */
                                    $metaDth = $evaluacionVentas[$count]["cantidadDth"];
                                    $vendHastaAyer = $evaluacionVentas[$count]["vendDth"];
                                    $vendHoy = $evaluacionVentas[$count]["vendHoyDth"];

                                    $newMetaDiaria = ($metaDth-$vendHastaAyer)/ count($diashabilesahoy);

                                    if ($newMetaDiaria <= $vendHoy) {
                                        $acumulado = $acumulado+20;
                                        $metaDthIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';
                                        $acumDth += 1;
                                    }


                                    /** 
                                     * META POSPAGO
                                     */
                                    $metaPospago = $evaluacionVentas[$count]["cantidadPospago"];
                                    $vendHastaAyer = $evaluacionVentas[$count]["vendPospago"];
                                    $vendHoy = $evaluacionVentas[$count]["vendHoyPospago"];

                                    $newMetaDiaria = ($metaPospago-$vendHastaAyer)/ count($diashabilesahoy);

                                    if ($newMetaDiaria <= $vendHoy) {
                                        $acumulado = $acumulado+20;
                                        $metaPospagoIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';
                                        $acumPospago += 1;
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
                                                    <h3 class="card-title">'.$value["movil"].'<h3>
                                                    <p class="card-text" style="font-size: 16px;">Placa: '.$value["placa"].'</p>
                                                </div>
                                                <div class="card-body text-center">
                                                
                                                    <input type="text" class="knobCalle" value="'.$acumulado.'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                        data-height="120" data-fgColor="'.$color.'" data-readonly="true">
                            
                                                    <div class="knobCalle-label">'.$mensaje.'</div>

                                                    <div class="col-10 offset-1" style="text-align: left;">
                                                        <p>'.$metaKmDiarioIcon.' Meta de Kilometraje Diario.</p>
                                                        <p>'.$metaInternetIcon.' Meta de Paquetes Internet Diario.</p>
                                                        <p>'.$metaGponIcon.' Meta de Paquetes GPON Diario.</p>
                                                        <p>'.$metaDthIcon.' Meta de Paquetes DTH Diario.</p>
                                                        <p>'.$metaPospagoIcon.' Meta de Paquetes Pospago Diario.</p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    ';
                                
                                    $count++;
                                }

                                //cierre row graficos
                                echo "</div>";
                                
                            ?>
                            

                        </div>
                    </div>
                    <!--*************************************
                        *    FIN CARD KILOMETRAJE DIARIO    *
                        *************************************-->



                    <!--*****************************************
                        *    INICIO CARD KILOMETRAJE MENSUAL    *
                        *****************************************-->
                        <div class="card col-12 mt-4">

                            <div class="card-header">
                                <h2 class="card-title" style="font-size:26px">Evaluación Mensual De Combustible</h2>
                            </div>

                            <div class="card-body">
                            <?php
                                    
                                    echo '<div class="row">';

                                    $acumuladoMensual = 0;
                                    $kmMeta = 0;
                                    $kmMensual = 0;
                                    $metaKmMensualIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';
                                    
                                    foreach ($evaluacionCombustible as $key => $value) {
                                        $metaKmMensualIcon = '<i class="fas fa-check" style="color:#008f39;"></i>';

                                        $kmMeta = $value["cantidad"];
                                        $kmTotal = $value["kmTotal"];
                                        
                                        if($kmMeta != 0) {
                                            $acumuladoMensual = ($kmTotal/$kmMeta)*100;
                                        }
                                        else {
                                            $acumuladoMensual = 0;
                                        }

                                        if($acumuladoMensual >= 100) {
                                            $acumuladoMensual = 100;
                                            $metaKmMensualIcon = '<i class="fas fa-times" style="color: #ff0000;"></i>';
                                        }

                                        if($kmHoy > $newMetaDiaria) {
                                            $metaKmMensualIcon = '';
                                        }
    
                                        $color = "#008f39";
                                        $mensaje = "Excelente.";
    
                                        if ($acumuladoMensual >= 25){
                                            $color = "#FCCA00";
                                            $mensaje = "Buena.";                                            
                                        }
    
                                        if ($acumuladoMensual >= 50){
                                            $color = "#FF7B07 ";
                                            $mensaje = "Regular.";
                                        }
    
                                        if ($acumuladoMensual >= 80){
                                            $color = "#ff0000";
                                            $mensaje = "Deficiente.";
                                        }

                                        echo '
                                            <div class="col-12 col-md-6 col-lg-3 mt-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">'.$value["movil"].'<h3>
                                                        <p class="card-text" style="font-size: 16px;">Placa: '.$value["placa"].'</p>
                                                    </div>
                                                    <div class="card-body text-center">
                                                    
                                                        <input type="text" class="knobCalle" value="'.round($acumuladoMensual,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                            data-height="120" data-fgColor="'.$color.'" data-readonly="true">
                                
                                                        <div class="knobCalle-label">'.$mensaje.'</div>

                                                        <div class="col-10 offset-1" style="text-align: left;">
                                                            <p>'.$metaKmMensualIcon.' Meta de Kilometraje Mensual.</p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        ';

                                    }
                                    //CIERRE DE LOS GRAFICOS KM RECORRIDOS POR MES
                                    echo '</div>';

                            ?>
                            </div>
                        </div>


                    <!--**************************************
                        *    FIN CARD KILOMETRAJE MENSUAL    *
                        **************************************-->


                    <!--*****************************************
                        *      INICIO CARD PROMEDIO GENERAL     *
                        *****************************************-->
                        <div class="card col-12 mt-4">
                            <div class="card-header">
                                <h2 class="card-title" style="font-size:26px">Evaluación General Por Meta</h2>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <?php
                                        /**
                                         * PROMEDIO COMBUSTIBLE
                                         */

                                        $promCombustible = ($acumCombustible/$count) * 100;
                                        $color = "#ff0000";
                                        $mensaje = "Deficiente.";

                                        if ($promCombustible >= 50){
                                            $color = "#FF7B07 ";
                                            $mensaje = "Regular.";
                                        }

                                        if ($promCombustible >= 75){
                                            $color = "#FCCA00";
                                            $mensaje = "Buena.";
                                        }

                                        if ($promCombustible >= 90){
                                            $color = "#008f39";
                                            $mensaje = "Excelente.";
                                        }

                                        echo '
                                                <div class="col-12 col-md-6 col-lg-3 mt-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Combustible<h3>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        
                                                            <input type="text" class="knobCalle" value="'.round($promCombustible,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                                data-height="120" data-fgColor="'.$color.'" data-readonly="true">
                                    
                                                            <div class="knobCalle-label">'.$mensaje.'</div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            ';

                                        /**
                                         * PROMEDIO INTERNET
                                         */
                                        $promInternet = ($acumInternet/$count) * 100;
                                        $color = "#ff0000";
                                        $mensaje = "Deficiente.";

                                        if ($promInternet >= 50){
                                            $color = "#FF7B07 ";
                                            $mensaje = "Regular.";
                                        }

                                        if ($promInternet >= 75){
                                            $color = "#FCCA00";
                                            $mensaje = "Buena.";
                                        }

                                        if ($promInternet >= 90){
                                            $color = "#008f39";
                                            $mensaje = "Excelente.";
                                        }

                                        echo '
                                                <div class="col-12 col-md-6 col-lg-3 mt-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Internet<h3>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        
                                                            <input type="text" class="knobCalle" value="'.round($promInternet,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                                data-height="120" data-fgColor="'.$color.'" data-readonly="true">
                                    
                                                            <div class="knobCalle-label">'.$mensaje.'</div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            ';
                                        /**
                                         * PROMEDIO GPON
                                         */
                                        $promGpon = ($acumGpon/$count) * 100;
                                        $color = "#ff0000";
                                        $mensaje = "Deficiente.";

                                        if ($promGpon >= 50){
                                            $color = "#FF7B07 ";
                                            $mensaje = "Regular.";
                                        }

                                        if ($promGpon >= 75){
                                            $color = "#FCCA00";
                                            $mensaje = "Buena.";
                                        }

                                        if ($promGpon >= 90){
                                            $color = "#008f39";
                                            $mensaje = "Excelente.";
                                        }

                                        echo '
                                                <div class="col-12 col-md-6 col-lg-3 mt-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">GPON<h3>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        
                                                            <input type="text" class="knobCalle" value="'.round($promGpon,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                                data-height="120" data-fgColor="'.$color.'" data-readonly="true">
                                    
                                                            <div class="knobCalle-label">'.$mensaje.'</div>
                                                        </div>
                                                         
                                                    </div>
                                                </div>
                                            ';

                                        /**
                                         * PROMEDIO DTH
                                         */
                                        $promDth = ($acumDth/$count) * 100;
                                        $color = "#ff0000";
                                        $mensaje = "Deficiente.";

                                        if ($promDth >= 50){
                                            $color = "#FF7B07 ";
                                            $mensaje = "Regular.";
                                        }

                                        if ($promDth >= 75){
                                            $color = "#FCCA00";
                                            $mensaje = "Buena.";
                                        }

                                        if ($promDth >= 90){
                                            $color = "#008f39";
                                            $mensaje = "Excelente.";
                                        }

                                        echo '
                                                <div class="col-12 col-md-6 col-lg-3 mt-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">DTH<h3>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        
                                                            <input type="text" class="knobCalle" value="'.round($promDth,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                                data-height="120" data-fgColor="'.$color.'" data-readonly="true" >
                                    
                                                            <div class="knobCalle-label">'.$mensaje.'</div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            ';

                                        /**
                                         * PROMEDIO POSPAGO
                                         */
                                        $promPospago = ($acumPospago/$count) * 100;
                                        $color = "#ff0000";
                                        $mensaje = "Deficiente.";

                                        if ($promPospago >= 50){
                                            $color = "#FF7B07 ";
                                            $mensaje = "Regular.";
                                        }

                                        if ($promPospago >= 75){
                                            $color = "#FCCA00";
                                            $mensaje = "Buena.";
                                        }

                                        if ($promPospago >= 90){
                                            $color = "#008f39";
                                            $mensaje = "Excelente.";
                                        }

                                        echo '
                                                <div class="col-12 col-md-6 col-lg-3 mt-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Pospago<h3>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        
                                                            <input type="text" class="knobCalle" value="'.round($promPospago,1).'" data-skin="tron" data-thickness="0.2" data-width="120"
                                                                data-height="120" data-fgColor="'.$color.'" data-readonly="true" >
                                    
                                                            <div class="knobCalle-label">'.$mensaje.'</div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            ';
                                    ?>
                                </div>
                            </div>
                        
                        </div>
                        <!--**********************************
                        *      FIN CARD PROMEDIO GENERAL     *
                        **************************************-->
                        

                        <!--**************************************
                        *       INICIO CARD PROMEDIO TOTAL       *
                        ******************************************-->

                        <div class="card col-12">
                            <div class="card-header">
                                <h2 class="card-title" style="font-size:26px">Evaluación General</h2>
                            </div>

                            <div class="card-body">
                                <div class="row text-center">
                                    <?php
                                        $PromGeneral = ($promCombustible+$promInternet+$promGpon+$promDth+$promPospago) / 5;
                                        $color = "#ff0000";
                                        $mensaje = "Deficiente.";

                                        if ($PromGeneral >= 50){
                                            $color = "#FF7B07 ";
                                            $mensaje = "Regular.";
                                        }

                                        if ($PromGeneral >= 75){
                                            $color = "#FCCA00";
                                            $mensaje = "Buena.";
                                        }

                                        if ($PromGeneral >= 90){
                                            $color = "#008f39";
                                            $mensaje = "Excelente.";
                                        }

                                        echo '
                                                <div class="col-12 mt-3">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                        
                                                            <input type="text" class="knobCalle" value="'.round($PromGeneral,1).'" data-skin="tron" data-thickness="0.2" data-width="130"
                                                                data-height="120" data-fgColor="'.$color.'" data-readonly="true" >
                                    
                                                            <div class="knobCalle-label">'.$mensaje.'</div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            ';

                                    ?>
                                        
                                </div>
                            </div>
                            
                        </div>

                        <!--***********************************
                        *       FIN CARD PROMEDIO TOTAL       *
                        ***************************************-->


                </div>
            </div>

        </div>
    </section>

</div>