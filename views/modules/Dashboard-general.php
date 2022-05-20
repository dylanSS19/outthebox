 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <!-- <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">Clientes</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                         <li class="breadcrumb-item active">Clientes</li>
                     </ol>
                 </div>
             </div>
         </div>
     </div> -->
     <!-- /.content-header -->

     <!-- Main content -->
     <div class="content">

         <div class="container-fluid">

             <div class="row">

                 <div class="col-lg-12">
                     <div class="card">


                         <div class="card-body">

                             <div class="row">

                                 <div class="col-md-3 col-lg-6 mt-4" style="height: 450px;">
                                     <div class="card card-primary" style="height: 100%;">
                                         <div class="card-header">
                                             <h3 class="card-title">DTH</h3>

                                             <!-- <div class="card-tools">
                                                 <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                     <i class="fas fa-minus"></i>
                                                 </button>
                                             </div> -->
                                             <!-- /.card-tools -->
                                         </div>
                                         <!-- /.card-header -->
                                         <div class="card-body">

                                             <div class="row">

                                                 <div class="col-sm-3 col-xs-12 col-lg-6">
                                                     <div class="description-block border-right">
                                                         <span class="description-text">DTH</span>
                                                         <br>
                                                         <?php 


                                                        date_default_timezone_set("America/Costa_Rica");
                                                        $fechaHoy = date("Y-m-d");
                                                        $tiempoMesPasado = strtotime("last day of previous month");
                                                        $datosventaemensualanterior = 0;
                                                        $datosventaemensual = 0;
                                                        $actualDesde =  date("Y-m-01");
                                                        $actualhasta =  date("Y-m-d", strtotime("- 1 days"));
                                                        $anteriorDesde = date("Y-m-01", $tiempoMesPasado);
                                                        $anteriorHasta = date("Y-m-d",strtotime($actualhasta."- 1 month"));
                                                                                               

                                                      $DTHactual = DashboardGeneralController::ctrCargarVActualDth($actualDesde, $actualhasta);
                                                      $DTHanterior = DashboardGeneralController::ctrCargarVActualDth($anteriorDesde, $anteriorHasta);
                                                      $DTHhoy = DashboardGeneralController::ctrCargarVActualDth($fechaHoy, $fechaHoy);

                                                      $datosventaemensualanterior = $DTHanterior[0];
                                                      $datosventaemensual = $DTHactual[0];

                                                        echo'  <span class="description-percentage" style="font-size: 12px;"> MES ACTUAL / MES ANTERIOR</span>
                                                        <br>';
                                                        
                                                        if($datosventaemensualanterior[0]==0)  {$datosventaemensualanterior[0]=0.001;};
                                                        if($datosventaemensual[0]==0){$datosventaemensual[0]=0.001;};

                                                        // $diferencia = 1-($datosventaemensualanterior[0]/$datosventaemensual[0]*100);

                                                        $diferencia = (($datosventaemensual[0] - $datosventaemensualanterior[0]) / $datosventaemensualanterior[0]) *100 ;


                                                        if ($diferencia <= 0) {

                                                                            echo'  <span class="description-percentage text-red "><i class="fa fa-caret-down"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        }elseif ($diferencia==0) {

                                                                            echo'  <span class="description-percentage text-yellow "><i class="fa fa-caret-left"></i> '.''. number_format($diferencia,2).'%</span> '; 

                                                        }else{

                                                                            echo'  <span class="description-percentage text-green "><i class="fa fa-caret-up"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        } 
                                                        echo' <b><p style="font-size: 14px;">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</p></b>'; ?>
                                                        <!-- echo' <h5 class="description-header">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</h5>'; ?> -->

                                                     </div>
                                                     <!-- /.description-block -->
                                                 </div>
                                                 <!-- /.col -->


                                                 <div class="col-sm-3 col-xs-12 col-lg-6">
                                                     <div class="description-block border-right">
                                                         <span class="description-text">Internet</span>
                                                         <br>
                                                         <?php 
                                                       
                                                        $datosventaemensualanterior = 0;
                                                        $datosventaemensual = 0;

                                                        $Internetactual = DashboardGeneralController::ctrCargarVActualInternet($actualDesde, $actualhasta);
                                                        $Internetanterior = DashboardGeneralController::ctrCargarVActualInternet($anteriorDesde, $anteriorHasta);
                                                        $Internethoy = DashboardGeneralController::ctrCargarVActualInternet($fechaHoy, $fechaHoy);                         
                                                        $datosventaemensualanterior = $Internetanterior[0];
                                                        $datosventaemensual = $Internetactual[0];
                                                           
                                                
                                                        echo'  <span class="description-percentage" style="font-size: 12px;"> MES ACTUAL / MES ANTERIOR '.$mes_anterior.'</span>
                                                        <br>';
                                                        
                                                        if($datosventaemensualanterior[0]==0)  {$datosventaemensualanterior[0]=0.001;};
                                                        if($datosventaemensual[0]==0){$datosventaemensual[0]=0.001;};

                                                        // $diferencia = 1-($datosventaemensualanterior[0]/$datosventaemensual[0]*100);

                                                    $diferencia = (($datosventaemensual[0] - $datosventaemensualanterior[0]) / $datosventaemensualanterior[0]) *100 ;


                                                        if ($diferencia <= 0) {

                                                                            echo'  <span class="description-percentage text-red "><i class="fa fa-caret-down"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        }elseif ($diferencia==0) {

                                                                            echo'  <span class="description-percentage text-yellow "><i class="fa fa-caret-left"></i> '.''. number_format($diferencia,2).'%</span> '; 

                                                        }else{

                                                                            echo'  <span class="description-percentage text-green "><i class="fa fa-caret-up"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        } 

                                                        echo' <b><p style="font-size: 14px;">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</p></b>'; ?>
                                                        <!-- echo' <h5 class="description-header">'.number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</h5>'; ?> -->

                                                     </div>
                                                     <!-- /.description-block -->
                                                 </div>
                                                 <!-- /.col -->

                                                 <div class="col-sm-3 col-xs-12 col-lg-6">
                                                     <div class="description-block border-right">
                                                         <span class="description-text">Pospago</span>
                                                         <br>
                                                         <?php 
                                  
                                                        $datosventaemensualanterior = 0;
                                                        $datosventaemensual = 0;
                                                        $Pospagoactual = DashboardGeneralController::ctrCargarVActualPospago($actualDesde, $actualhasta);
                                                        $Pospagoanterior = DashboardGeneralController::ctrCargarVActualPospago($anteriorDesde, $anteriorHasta);
                                                        $Pospagohoy = DashboardGeneralController::ctrCargarVActualPospago($fechaHoy, $fechaHoy);

                                                        $datosventaemensualanterior = $Pospagoanterior[0];
                                                        $datosventaemensual = $Pospagoactual[0];
                                                           
                                                        // echo '<pre>'; print_r($Pospagohoy); echo '</pre>';


                                                        echo'  <span class="description-percentage" style="font-size: 12px;"> MES ACTUAL / MES ANTERIOR</span>
                                                        <br>';
                                                        
                                                        if($datosventaemensualanterior[0]==0)  {$datosventaemensualanterior[0]=0.001;};
                                                        if($datosventaemensual[0]==0){$datosventaemensual[0]=0.001;};

                                                        // $diferencia = 1-($datosventaemensualanterior[0]/$datosventaemensual[0]*100);

                                                    $diferencia = (($datosventaemensual[0] - $datosventaemensualanterior[0]) / $datosventaemensualanterior[0]) *100 ;


                                                        if ($diferencia <= 0) {

                                                                            echo'  <span class="description-percentage text-red "><i class="fa fa-caret-down"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        }elseif ($diferencia==0) {

                                                                            echo'  <span class="description-percentage text-yellow "><i class="fa fa-caret-left"></i> '.''. number_format($diferencia,2).'%</span> '; 

                                                        }else{

                                                                            echo'  <span class="description-percentage text-green "><i class="fa fa-caret-up"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        } 

                                                        echo' <b><p style="font-size: 14px;">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</p></b>'; ?>
                                                        <!-- echo' <h5 class="description-header">'. number_format($datosventaemensual[0]) .' / '. number_format($datosventaemensualanterior[0]).'</h5>'; ?> -->

                                                     </div>
                                                     <!-- /.description-block -->
                                                 </div>
                                                 <!-- /.col -->


                                                 

                                                 <div class="col-sm-3 col-xs-12 col-lg-12 ">
                                                     <table width="100%">

                                                         <thead>

                                                             <tr style="border-bottom: 2px solid black;">
                                                                 <th colspan="3" style="text-align: center;">Datos
                                                                     Diarios</th>
                                                             </tr>

                                                         </thead>

                                                         <tbody>

                                                             <tr style="border-bottom: 2px solid black;">

                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     DTH</td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     INTERNET</td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     POSPAGO</td>
                                                                 <!-- <td style="text-align: center; border: 2px solid black;">N/A</td> -->
                                                             </tr>

                                                             <tr>

                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     <?php echo $DTHhoy[0][0] ?></td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     <?php echo $Internethoy[0][0] ?></td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     <?php echo $Pospagohoy[0][0] ?></td>
                                                                 <!-- <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     N/A</td> -->
                                                             </tr>

                                                         </tbody>

                                                     </table>
                                                 </div>

                                             </div>


                                         </div>
                                         <!-- /.card-body -->
                                     </div>
                                     <!-- /.card -->
                                 </div>





                                 <div class="col-md-3 col-lg-6 mt-4" style="height: 450px;">
                                     <div class="card card-danger" style="height: 100%;">
                                         <div class="card-header">
                                             <h3 class="card-title">Tiendas</h3>


                                             <!-- /.card-tools -->
                                         </div>
                                         <!-- /.card-header -->
                                         <div class="card-body">

                                             <div class="row">


                                                 <div class="col-sm-3 col-xs-12 col-lg-6">
                                                     <div class="description-block border-right">
                                                         <span class="description-text">Pospago</span>
                                                         <br>
                                                         <?php 

                                                        date_default_timezone_set("America/Costa_Rica");
                                                        $fechaHoy = date("Y-m-d");
                                                        $tiempoMesPasado = strtotime("last day of previous month");
                                                        $datosventaemensualanterior = 0;
                                                        $datosventaemensual = 0;
                                                        $actualDesde =  date("Y-m-01");
                                                        $actualhasta =  date("Y-m-d", strtotime("- 1 days"));
                                                        $anteriorDesde = date("Y-m-01", $tiempoMesPasado);
                                                        $anteriorHasta = date("Y-m-d",strtotime($actualhasta."- 1 month"));
                                                                                               

                                                      $PospagoTiendasactual = DashboardGeneralController::ctrCargarVActualPospagoTiendas($actualDesde, $actualhasta);
                                                      $PospagoTiendasanterior = DashboardGeneralController::ctrCargarVActualPospagoTiendas($anteriorDesde, $anteriorHasta);
                                                      $PospagoTiendashoy = DashboardGeneralController::ctrCargarVActualPospagoTiendas($fechaHoy, $fechaHoy);
                                                    
                                                        // printf($PospagoTiendashoy);
                                                        // echo '<pre>'; print_r($PospagoTiendashoy[0][0]); echo '</pre>';


                                                      $datosventaemensualanterior = $PospagoTiendasanterior[0];
                                                      $datosventaemensual = $PospagoTiendasactual[0];

                                                        echo'  <span class="description-percentage" style="font-size: 12px;"> MES ACTUAL / MES ANTERIOR</span>
                                                        <br>';
                                                        
                                                        if($datosventaemensualanterior[0]==0)  {$datosventaemensualanterior[0]=0.001;};
                                                        if($datosventaemensual[0]==0){$datosventaemensual[0]=0.001;};

                                                        // $diferencia = 1-($datosventaemensualanterior[0]/$datosventaemensual[0]*100);

                                                        $diferencia = (($datosventaemensual[0] - $datosventaemensualanterior[0]) / $datosventaemensualanterior[0]) *100 ;


                                                        if ($diferencia <= 0) {

                                                                            echo'  <span class="description-percentage text-red "><i class="fa fa-caret-down"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        }elseif ($diferencia==0) {

                                                                            echo'  <span class="description-percentage text-yellow "><i class="fa fa-caret-left"></i> '.''. number_format($diferencia,2).'%</span> '; 

                                                        }else{

                                                                            echo'  <span class="description-percentage text-green "><i class="fa fa-caret-up"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        } 
                                                        echo' <b><p style="font-size: 14px;">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</p></b>'; ?>
                                                         <!-- echo' <h5 class="description-header">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</h5>'; ?> -->

                                                     </div>
                                                     <!-- /.description-block -->
                                                 </div>
                                                 <!-- /.col -->



                                                 <div class="col-sm-3 col-xs-12 col-lg-6">
                                                     <div class="description-block border-right">
                                                         <span class="description-text">Meta Llave</span>
                                                         <br>
                                                         <?php 


                                                       
                                                        $datosventaemensualanterior = 0;
                                                        $datosventaemensual = 0;
                                                        
                                                        $MllaveTiendasactual = DashboardGeneralController::ctrCargarVActualMetaLLaveTiendas($actualDesde, $actualhasta);
                                                        $MllaveTiendasanterior = DashboardGeneralController::ctrCargarVActualMetaLLaveTiendas($anteriorDesde, $anteriorHasta);
                                                        $MllaveTiendashoy = DashboardGeneralController::ctrCargarVActualMetaLLaveTiendas($fechaHoy, $fechaHoy);
                                                      
                                                        $datosventaemensualanterior = $MllaveTiendasanterior[0];
                                                        $datosventaemensual = $MllaveTiendasactual[0];
                                                        

                                                            // printf($actualDesde);
                                                            // printf($actualhasta);
                                                            // printf($anteriorDesde);
                                                            // printf($anteriorHasta);

                                                        echo'  <span class="description-percentage" style="font-size: 12px;"> MES ACTUAL / MES ANTERIOR</span>
                                                        <br>';
                                                        
                                                        if($datosventaemensualanterior[0]==0)  {$datosventaemensualanterior[0]=0.001;};
                                                        if($datosventaemensual[0]==0){$datosventaemensual[0]=0.001;};

                                                        // $diferencia = 1-($datosventaemensualanterior[0]/$datosventaemensual[0]*100);

                                                    $diferencia = (($datosventaemensual[0] - $datosventaemensualanterior[0]) / $datosventaemensualanterior[0]) *100 ;


                                                        if ($diferencia <= 0) {

                                                                            echo'  <span class="description-percentage text-red "><i class="fa fa-caret-down"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        }elseif ($diferencia==0) {

                                                                            echo'  <span class="description-percentage text-yellow "><i class="fa fa-caret-left"></i> '.''. number_format($diferencia,2).'%</span> '; 

                                                        }else{

                                                                            echo'  <span class="description-percentage text-green "><i class="fa fa-caret-up"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        } 

                                                        echo' <b><p style="font-size: 14px;">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</p></b>'; ?>
                                                         <!-- echo' <h5 class="description-header">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</h5>'; ?> -->
                                                         <span class="description-text"></span>
                                                     </div>
                                                     <!-- /.description-block -->
                                                 </div>
                                                 <!-- /.col -->



                                                 <div class="col-sm-3 col-xs-12 col-lg-6">
                                                     <div class="description-block border-right">
                                                         <span class="description-text">Recaudación</span>
                                                         <br>
                                                         <?php 


                                                       
                                                        $datosventaemensualanterior = 0;
                                                        $datosventaemensual = 0;
                                                        
                                                        $RecaudacionTiendasactual = DashboardGeneralController::ctrCargarVActualRecaudacionTiendas($actualDesde, $actualhasta);
                                                        $RecaudacionTiendasanterior = DashboardGeneralController::ctrCargarVActualRecaudacionTiendas($anteriorDesde, $anteriorHasta);
                                                        $RecaudacionTiendashoy = DashboardGeneralController::ctrCargarVActualRecaudacionTiendas($fechaHoy, $fechaHoy);
                                                      
                                                        // echo '<pre>'; print_r($RecaudacionTiendashoy[0][0]); echo '</pre>';

                                                        $datosventaemensualanterior =  $RecaudacionTiendasanterior[0];
                                                        $datosventaemensual = $RecaudacionTiendasactual[0];

                                                        echo'  <span class="description-percentage" style="font-size: 12px;"> MES ACTUAL / MES ANTERIOR</span>
                                                        <br>';
                                                        
                                                        if($datosventaemensualanterior[0]==0)  {$datosventaemensualanterior[0]=0.001;};
                                                        if($datosventaemensual[0]==0){$datosventaemensual[0]=0.001;};

                                                        // $diferencia = 1-($datosventaemensualanterior[0]/$datosventaemensual[0]*100);

                                                    $diferencia = (($datosventaemensual[0] - $datosventaemensualanterior[0]) / $datosventaemensualanterior[0]) *100 ;


                                                        if ($diferencia <= 0) {

                                                                            echo'  <span class="description-percentage text-red "><i class="fa fa-caret-down"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        }elseif ($diferencia==0) {

                                                                            echo'  <span class="description-percentage text-yellow "><i class="fa fa-caret-left"></i> '.''. number_format($diferencia,2).'%</span> '; 

                                                        }else{

                                                                            echo'  <span class="description-percentage text-green "><i class="fa fa-caret-up"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        } 


                                                        echo' <b><p style="font-size: 14px;">₡'. number_format($datosventaemensual[0]) .' / ₡'.number_format($datosventaemensualanterior[0]).'</p></b>'; ?>
                                                         <span class="description-text"></span>
                                                     </div>
                                                     <!-- /.description-block -->
                                                 </div>
                                                 <!-- /.col -->



                                                 <div class="col-sm-3 col-xs-12 col-lg-6">
                                                     <div class="description-block border-right">
                                                         <span class="description-text">Activación</span>
                                                         <br>
                                                         <?php 


                                                       
                                                        $datosventaemensualanterior = 0;
                                                        $datosventaemensual = 0;
                                                        
                                                        $ActivacionTiendasactual = DashboardGeneralController::ctrCargarVActualActivacionTiendas($actualDesde, $actualhasta);
                                                        $ActivacionTiendasanterior = DashboardGeneralController::ctrCargarVActualActivacionTiendas($anteriorDesde, $anteriorHasta);
                                                        $ActivacionTiendashoy = DashboardGeneralController::ctrCargarVActualActivacionTiendas($fechaHoy, $fechaHoy);
                                                      
                                                        // echo '<pre>'; print_r($RecaudacionTiendashoy[0][0]); echo '</pre>';

                                                        $datosventaemensualanterior =  $ActivacionTiendasanterior[0];
                                                        $datosventaemensual = $ActivacionTiendasactual[0];

                                                            // printf($actualDesde);
                                                            // printf($actualhasta);
                                                            // printf($anteriorDesde);
                                                            // printf($anteriorHasta);

                                                        echo'  <span class="description-percentage" style="font-size: 12px;"> MES ACTUAL / MES ANTERIOR</span>
                                                        <br>';
                                                        
                                                        if($datosventaemensualanterior[0]==0)  {$datosventaemensualanterior[0]=0.001;};
                                                        if($datosventaemensual[0]==0){$datosventaemensual[0]=0.001;};

                                                        // $diferencia = 1-($datosventaemensualanterior[0]/$datosventaemensual[0]*100);

                                                    $diferencia = (($datosventaemensual[0] - $datosventaemensualanterior[0]) / $datosventaemensualanterior[0]) *100 ;


                                                        if ($diferencia <= 0) {

                                                                            echo'  <span class="description-percentage text-red "><i class="fa fa-caret-down"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        }elseif ($diferencia==0) {

                                                                            echo'  <span class="description-percentage text-yellow "><i class="fa fa-caret-left"></i> '.''. number_format($diferencia,2).'%</span> '; 

                                                        }else{

                                                                            echo'  <span class="description-percentage text-green "><i class="fa fa-caret-up"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        } 

                                                        echo' <b><p style="font-size: 14px;">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</p></b>'; ?>
                                                        <!-- echo' <h5 class="description-header">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</h5>'; ?> -->
                                                         <span class="description-text"></span>
                                                     </div>
                                                     <!-- /.description-block -->
                                                 </div>
                                                 <!-- /.col -->

                                                 <div class="col-sm-3 col-xs-12 col-lg-12 ">
                                                     <table width="100%">

                                                         <thead>

                                                             <tr style="border-bottom: 2px solid black;">
                                                                 <th colspan="4" style="text-align: center;">Datos
                                                                     Diarios</th>
                                                             </tr>

                                                         </thead>

                                                         <tbody>

                                                             <tr style="border-bottom: 2px solid black;">

                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     POSPAGO</td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     META LLAVE</td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     RECAUDACIÓN</td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     ACTIVACIÓN</td>

                                                             </tr>

                                                             <tr>

                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     <?php echo $PospagoTiendashoy[0][0] ?></td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     <?php echo $MllaveTiendashoy[0][0] ?></td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     ₡
                                                                     <?php echo number_format($RecaudacionTiendashoy[0][0], 1) ?>
                                                                 </td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     <?php echo $ActivacionTiendashoy[0][0] ?></td>
                                                             </tr>

                                                         </tbody>

                                                     </table>
                                                 </div>


                                             </div>
                                             <!-- /.card-body -->
                                         </div>
                                         <!-- /.card -->
                                     </div>
                                 </div>


                                 <div class="col-md-3 col-lg-6 mt-4" style="height: 450px;">
                                     <div class="card card-warning" style="height: 100%;">
                                         <div class="card-header">
                                             <h3 class="card-title">Masivos</h3>


                                             <!-- /.card-tools -->
                                         </div>
                                         <!-- /.card-header -->
                                         <div class="card-body">

                                             <div class="row">

                                             <div class="col-sm-3 col-xs-12 col-lg-6">
                                                     <div class="description-block border-right">
                                                         <span class="description-text">TAE</span>
                                                         <br>
                                                         <?php 


                                                       
                                                        $datosventaemensualanterior = 0;
                                                        $datosventaemensual = 0;
                                                        
                                                        $TaeMasivoactual = DashboardGeneralController::ctrCargarVActualTaeMasivo($actualDesde, $actualhasta);
                                                        $TaeMasivoanterior = DashboardGeneralController::ctrCargarVActualTaeMasivo($anteriorDesde, $anteriorHasta);
                                                        $TaeMasivohoy = DashboardGeneralController::ctrCargarVActualTaeMasivo($fechaHoy, $fechaHoy);
                                                      

                                                        $datosventaemensualanterior =  $TaeMasivoanterior[0];
                                                        $datosventaemensual = $TaeMasivoactual[0];

                                                           
                                                        echo'  <span class="description-percentage" style="font-size: 12px;"> MES ACTUAL / MES ANTERIOR</span>
                                                        <br>';
                                                        
                                                        if($datosventaemensualanterior[0]==0)  {$datosventaemensualanterior[0]=0.001;};
                                                        if($datosventaemensual[0]==0){$datosventaemensual[0]=0.001;};

                                                        // $diferencia = 1-($datosventaemensualanterior[0]/$datosventaemensual[0]*100);

                                                    $diferencia = (($datosventaemensual[0] - $datosventaemensualanterior[0]) / $datosventaemensualanterior[0]) *100 ;


                                                        if ($diferencia <= 0) {

                                                                            echo'  <span class="description-percentage text-red "><i class="fa fa-caret-down"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        }elseif ($diferencia==0) {

                                                                            echo'  <span class="description-percentage text-yellow "><i class="fa fa-caret-left"></i> '.''. number_format($diferencia,2).'%</span> '; 

                                                        }else{

                                                                            echo'  <span class="description-percentage text-green "><i class="fa fa-caret-up"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        } 

                                                        echo' <b><p class="" style="font-size: 14px;"> ₡'. number_format($datosventaemensual[0]) .' /  ₡'.number_format($datosventaemensualanterior[0]).'</p></b>'; ?>
                                                        <!-- echo' <b><p class="" style="font-size: 14px;"> ₡'. number_format($datosventaemensual[0]) .' /  ₡'.number_format($datosventaemensualanterior[0]).'</h5>'; ?> -->
                                                         <span class="description-text"></span>
                                                     </div>
                                                     <!-- /.description-block -->
                                                 </div>
                                                 <!-- /.col -->


                                                 <div class="col-sm-3 col-xs-12 col-lg-6">
                                                     <div class="description-block border-right">
                                                         <span class="description-text">Kits</span>
                                                         <br>
                                                         <?php 

                                                        date_default_timezone_set("America/Costa_Rica");
                                                        $fechaHoy = date("Y-m-d");
                                                        $tiempoMesPasado = strtotime("last day of previous month");
                                                        $datosventaemensualanterior = 0;
                                                        $datosventaemensual = 0;
                                                        $actualDesde =  date("Y-m-01");
                                                        $actualhasta =  date("Y-m-d", strtotime("- 1 days"));
                                                        $anteriorDesde = date("Y-m-01", $tiempoMesPasado);
                                                        $anteriorHasta = date("Y-m-d",strtotime($actualhasta."- 1 month"));
                                                                                               

                                                      $KitsMasivoactual = DashboardGeneralController::ctrCargarVActualKitsMasivo($actualDesde, $actualhasta);
                                                      $KitsMasivoanterior = DashboardGeneralController::ctrCargarVActualKitsMasivo($anteriorDesde, $anteriorHasta);
                                                      $KitsMasivohoy = DashboardGeneralController::ctrCargarVActualKitsMasivo($fechaHoy, $fechaHoy);
                                                    
                                                       

                                                      $datosventaemensualanterior = $KitsMasivoanterior[0];
                                                      $datosventaemensual = $KitsMasivoactual[0];

                                                        echo'  <span class="description-percentage" style="font-size: 12px;"> MES ACTUAL / MES ANTERIOR</span>
                                                        <br>';
                                                        
                                                        if($datosventaemensualanterior[0]==0)  {$datosventaemensualanterior[0]=0.001;};
                                                        if($datosventaemensual[0]==0){$datosventaemensual[0]=0.001;};

                                                        // $diferencia = 1-($datosventaemensualanterior[0]/$datosventaemensual[0]*100);

                                                        $diferencia = (($datosventaemensual[0] - $datosventaemensualanterior[0]) / $datosventaemensualanterior[0]) *100 ;


                                                        if ($diferencia <= 0) {

                                                                            echo'  <span class="description-percentage text-red "><i class="fa fa-caret-down"></i>  '.number_format($diferencia,2).'%</span> ';

                                                        }elseif ($diferencia==0) {

                                                                            echo'  <span class="description-percentage text-yellow "><i class="fa fa-caret-left"></i>  '.number_format($diferencia,2).'%</span> '; 

                                                        }else{

                                                                            echo'  <span class="description-percentage text-green "><i class="fa fa-caret-up"></i> '. number_format($diferencia,2).'%</span> ';

                                                        } 

                                                        echo' <b><p class="" style="font-size: 14px;"> ₡'. number_format($datosventaemensual[0]) .' /  ₡'.number_format($datosventaemensualanterior[0]).'</p></b>'; ?>

                                                     </div>
                                                     <!-- /.description-block -->
                                                 </div>
                                                 <!-- /.col -->


                                                 

                                                    <?php 


                                                   

                                                    
                                                    $inicioMes = date('Y-m-01');

                                                    $finMes = date('Y-m-t');
                                                  
                                                    

                                                    $TaeMetahoy = DashboardGeneralController::ctrCargarVActualTaeMetaMensual($actualDesde, $actualDesde);
                                                    $TaeMasivomes = DashboardGeneralController::ctrCargarVActualTaeMasivo($inicioMes, $finMes);
                                                    $TaeMasivoHoy = DashboardGeneralController::ctrCargarVActualTaeMasivo($fechaHoy, $fechaHoy);
                                                    
                                                    $KitsMetahoy = DashboardGeneralController::ctrCargarVActualKitsMetaMensual($actualDesde, $actualDesde);
                                                    $KitsMasivomes = DashboardGeneralController::ctrCargarVActualKitsMasivo($inicioMes, $finMes);
                                                    $KitsMasivoHoy = DashboardGeneralController::ctrCargarVActualKitsMasivo($fechaHoy, $fechaHoy);
                                                    
                                                    

                                                    if($TaeMetahoy[0] == ""){ $TaeMetahoy[0][0] = 0;}
                                                    if($KitsMetahoy[0] == ""){ $KitsMetahoy[0][0] = 0;}
                                                    
                                                        $today = date('Y-m-d');

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

                                                    // tae
                                                    


                                                    $datosventaemensual1 = $TaeMasivomes[0][0];  
                                                   
                                                    $proyeccion1 = $datosventaemensual1 / count($diashabileshoy) * count($diashabilesmes) ;

                                                    $porcentaje1 = ($datosventaemensual1 /$TaeMetahoy[0][0])*100;
                       
                                                     $proyeccion_real1 = ($proyeccion1/$TaeMetahoy[0][0])*100;
                       
                                                     $proyeccion_real1 = $proyeccion_real1 - $porcentaje1;

                                                    // kits
                                                    
                                                    // echo '<pre>'; print_r($datosventaemensual1); echo '</pre>';
                                                    // echo '<pre>'; print_r($TaeMetahoy[0]); echo '</pre>';

                                                     $datosventaemensual2 = $KitsMasivomes[0][0];                                                  
                                          
                                                     $proyeccion2 = $datosventaemensual2 / count($diashabileshoy) * count($diashabilesmes) ;
 
                                                     $porcentaje2 = ($datosventaemensual2 /$KitsMetahoy[0][0])*100;
                        
                                                      $proyeccion_real2 = ($proyeccion2/$KitsMetahoy[0][0])*100;
                        
                                                      $proyeccion_real2 = $proyeccion_real2 - $porcentaje2;

                                                        
                                                    ?>



                                                 <div class="col-md-12 col-lg-12">
                                                     <p class="text-center">
                                                         <strong>Metas Mensuales</strong>
                                                     </p>
                                                     <div class="progress-group">
                                                         TAE
                                                         <span class="float-right"><b> ₡ <?php echo number_format($datosventaemensual1,2) ?>/  ₡ <?php echo number_format($TaeMetahoy[0][0],2) ?></b></span>
                                                         <div class="progress progress-sm">
                                                             <?php echo '<div class="progress-bar bg-primary" style="width: '.number_format(($datosventaemensual1 / $TaeMetahoy[0][0])*100,2).'%"></div>' ?>
                                                             
                                                             <?php echo '<div class="progress-bar bg-danger" style="width: '.$proyeccion_real1.'%"></div>' ?>
                                                             
                                                         </div>

                                                         KITS
                                                         <span class="float-right"><b> ₡ <?php echo number_format($datosventaemensual2,2) ?> / ₡ <?php echo number_format($KitsMetahoy[0][0],2) ?></b></span>
                                                         <div class="progress progress-sm">
                                                         <?php echo '<div class="progress-bar bg-primary" style="width: '.number_format(($datosventaemensual2 / $KitsMetahoy[0][0])*100,2).'%"></div>'?>
                                                             
                                                         <?php echo '<div class="progress-bar bg-danger" style="width: '.$proyeccion_real2.'%"></div>'?>
                                                             
                                                         </div>

                                                     </div>
                                                 </div>

                                                

                                                 <div class="col-sm-3 col-xs-12 col-lg-12 mt-1">
                                                     <table width="100%">

                                                         <thead>

                                                             <tr style="border-bottom: 2px solid black;">
                                                                 <th colspan="2" style="text-align: center;">Datos
                                                                     Diarios</th>
                                                             </tr>

                                                         </thead>

                                                         <tbody>

                                                             <tr style="border-bottom: 2px solid black;">

                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     TAE</td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     KITS</td>
                                                                
                                                             </tr>

                                                             <tr>

                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">₡ 
                                                                     <?php echo number_format($TaeMasivoHoy[0][0],2) ?></td>
                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">₡ 
                                                                     <?php echo number_format($KitsMasivoHoy[0][0],2) ?></td>
                                                                
                                                             </tr>

                                                         </tbody>

                                                     </table>
                                                 </div>


                                             </div>
                                             <!-- /.card-body -->
                                         </div>
                                         <!-- /.card -->
                                     </div>
                                 </div>



                                 <div class="col-md-3 col-lg-6 mt-4" style="height: 450px;">
                                     <div class="card card-info" style="height: 100%;">
                                         <div class="card-header">
                                             <h3 class="card-title">Activaciones</h3>


                                             <!-- /.card-tools -->
                                         </div>
                                         <!-- /.card-header -->
                                         <div class="card-body">

                                             <div class="row">

                                             <div class="col-sm-3 col-xs-12 col-lg-12">
                                                     <div class="description-block border-right">
                                                         <span class="description-text">Activaciones</span>
                                                         <br>
                                                         <?php 


                                                        date_default_timezone_set("America/Costa_Rica");
                                                        $fechaHoy = date("Y-m-d");
                                                        $tiempoMesPasado = strtotime("last day of previous month");
                                                        $datosventaemensualanterior = 0;
                                                        $datosventaemensual = 0;
                                                        $actualDesde =  date("Y-m-01");
                                                        $actualhasta =  date("Y-m-d", strtotime("- 1 days"));
                                                        $anteriorDesde = date("Y-m-01", $tiempoMesPasado);
                                                        $anteriorHasta = date("Y-m-d",strtotime($actualhasta."- 1 month"));
                                                                                               

                                                      $Activacionesactual = DashboardGeneralController::ctrCargarVActualActivaciones($actualDesde, $actualhasta);
                                                      $Activacionesanterior = DashboardGeneralController::ctrCargarVActualActivaciones($anteriorDesde, $anteriorHasta);
                                                      $Activacioneshoy = DashboardGeneralController::ctrCargarVActualActivaciones($fechaHoy, $fechaHoy);

                                                      $datosventaemensualanterior = $Activacionesanterior[0];
                                                      $datosventaemensual = $Activacionesactual[0];

                                                        echo'  <span class="description-percentage" style="font-size: 12px;"> MES ACTUAL / MES ANTERIOR</span>
                                                        <br>';
                                                        
                                                        if($datosventaemensualanterior[0]==0)  {$datosventaemensualanterior[0]=0.001;};
                                                        if($datosventaemensual[0]==0){$datosventaemensual[0]=0.001;};

                                                        // $diferencia = 1-($datosventaemensualanterior[0]/$datosventaemensual[0]*100);

                                                        $diferencia = (($datosventaemensual[0] - $datosventaemensualanterior[0]) / $datosventaemensualanterior[0]) *100 ;


                                                        if ($diferencia <= 0) {

                                                                            echo'  <span class="description-percentage text-red "><i class="fa fa-caret-down"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        }elseif ($diferencia==0) {

                                                                            echo'  <span class="description-percentage text-yellow "><i class="fa fa-caret-left"></i> '.''. number_format($diferencia,2).'%</span> '; 

                                                        }else{

                                                                            echo'  <span class="description-percentage text-green "><i class="fa fa-caret-up"></i> '.''. number_format($diferencia,2).'%</span> ';

                                                        } 
                                                        echo' <b><p style="font-size: 14px;">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</p></b>'; ?>
                                                        <!-- echo' <h5 class="description-header">'. number_format($datosventaemensual[0]) .' / '.number_format($datosventaemensualanterior[0]).'</h5>'; ?> -->

                                                     </div>
                                                     <!-- /.description-block -->
                                                 </div>
                                                 <!-- /.col -->

                                                 <?php 


                                                   

                                                    
$inicioMes = date('Y-m-01');

$finMes = date('Y-m-t');



$ActivacionesMetahoy = DashboardGeneralController::ctrCargarVActualActivacionesMetaMensual($actualDesde, $actualDesde);
$ActivacionesMasivomes = DashboardGeneralController::ctrCargarVActualActivaciones($inicioMes, $finMes);
$TaeMasivoHoy = DashboardGeneralController::ctrCargarVActualActivaciones($fechaHoy, $fechaHoy);


if($ActivacionesMetahoy[0] == ""){ $ActivacionesMetahoy[0][0] = 0;}


    $today = date('Y-m-d');

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


$datosventaemensual = $ActivacionesMetahoy[0][0];  

$proyeccion = $datosventaemensual / count($diashabileshoy) * count($diashabilesmes) ;

$porcentaje = ($datosventaemensual / $ActivacionesMetahoy[0][0])*100;

 $proyeccion_real = ($proyeccion / $ActivacionesMetahoy[0][0])*100;

 $proyeccion_real = $proyeccion_real - $porcentaje;



    
?>

                                                 <div class="col-md-12 col-lg-12">
                                                     <p class="text-center">
                                                         <strong>Metas Mensuales</strong>
                                                     </p>
                                                     <div class="progress-group">
                                                         Activaciones
                                                         <span class="float-right"><b>  <?php echo number_format($datosventaemensual,2) ?>/   <?php echo number_format($ActivacionesMetahoy[0][0],2) ?></b></span>
                                                         <div class="progress progress-sm">
                                                             <?php echo '<div class="progress-bar bg-primary" style="width: '.number_format(($datosventaemensual / $ActivacionesMetahoy[0][0])*100,2).'%"></div>' ?>
                                                             
                                                             <?php echo '<div class="progress-bar bg-danger" style="width: '.$proyeccion_real.'%"></div>' ?>
                                                             
                                                         </div>
                    
                                                     </div>
                                                 </div>


                                                 <div class="col-sm-3 col-xs-12 col-lg-12 " style="margin-top: 34px;">
                                                     <table width="100%">

                                                         <thead>

                                                             <tr style="border-bottom: 2px solid black;">
                                                                 <th colspan="2" style="text-align: center;">Datos
                                                                     Diarios</th>
                                                             </tr>

                                                         </thead>

                                                         <tbody>

                                                             <tr style="border-bottom: 2px solid black;">

                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     ACTIVACIONES</td>
                                                                 
                                                                
                                                             </tr>

                                                             <tr>

                                                                 <td
                                                                     style="text-align: center; border: 2px solid black;">
                                                                     <?php echo number_format($TaeMasivoHoy[0][0]) ?></td>
                                                                 
                                                                
                                                             </tr>

                                                         </tbody>

                                                     </table>
                                                 </div>



                                             </div>
                                             <!-- /.card-body -->
                                         </div>
                                         <!-- /.card -->
                                     </div>
                                 </div>


                                 <!-- <div class="col-md-3 col-lg-3 mt-4" style="height: 450px;">
                                     <div class="card card-primary" style="height: 100%;">
                                         <div class="card-header">
                                             <h3 class="card-title">Primary</h3> -->


                                             <!-- /.card-tools -->
                                         <!-- </div> -->
                                         <!-- /.card-header -->
                                         <!-- <div class="card-body"> -->

                                             <!-- <div class="row"> -->




                                             <!-- </div> -->
                                             <!-- /.card-body -->
                                         <!-- </div> -->
                                         <!-- /.card -->
                                     <!-- </div>
                                 </div> -->


                                 


                                 

                                 


                             </div>

                         </div>

                     </div>

                 </div>
                 <!-- /.col-md-6 -->
             </div>
             <!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <style>
#myDiv.fullscreen {
    z-index: 9999;
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
}

#myDiv {
    background: #FFFFFF;
    width: 500px;
    height: 500px;
}

#myDiv {
    margin-top: 8px;
}
 </style>

 <script>



 </script>