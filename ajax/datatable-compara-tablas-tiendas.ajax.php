<?php

require_once "../controllers/reporte-ventas-tiendas.controller.php";
require_once "../models/reporte-ventas-tiendas-model.php";

 
class TableSales{

  /*=============================================
=      SHOW PRODUCTS TABLE      =
=============================================*/


  public $desde1;

  public $hasta1; 


  public $desde2;

  public $hasta2; 



  public function showTableSales(){



    $Vardesde1 = $this->desde1;

     $Varhasta1 = $this->hasta1;

    $Vardesde2 = $this->desde2;

     $Varhasta2 = $this->hasta2;



                     
              $response = controladorVentasTiendas::ctrCargarVentasTotalesCompararTablas($Vardesde1, $Varhasta1,$Vardesde2, $Varhasta2);
        


    $JsonData = '{
               "data": [';

            

                for($i =0; $i < count($response); $i++){


                   $posp = $response[$i]["pospago"];
                  $posp2 = $response[$i]["pospago2"];



    
if($posp==0)  {$posp=0.001;};
  if($posp2==0){$posp2=0.001;};

                  try {
      $difposp= (($posp2 - $posp) / $posp) *100;
      $difposp2= ($posp2 - $posp);
} catch (ArithmeticError | Exception $e) {
                      $difposp= 0;
                    $difposp2= 0;
};





       


                  $claro = $response[$i]["claro"];
                  $claro2 = $response[$i]["claro2"];
  if($claro==0)  {$claro=0.001;};
  if($claro2==0) {$claro2=0.001;};

                  try {
       $difclaro= (($claro2 - $claro) / $claro2) *100;
      $difclaro2= ($claro2 - $claro);
} catch (ArithmeticError | Exception $e) {
                      $difclaro= 0;
                    $difclaro2= 0;
};





                  $digital = $response[$i]["digital"];
                  $digital2 = $response[$i]["digital2"];

  if($digital==0)  {$digital=0.001;};
  if($digital2==0) {$digital2=0.001;};
              

                  try {
       $didigital= (($digital2 - $digital) / $digital2) *100;
      $didigital2= ($digital2 - $digital);
} catch (ArithmeticError | Exception $e) {
                      $didigital= 0;
                    $didigital2= 0;
}


          

                  $acce = $response[$i]["accesorios"];
                  $acce2 = $response[$i]["accesorios2"];

                    if($acce==0)  {$acce=0.001;};
  if($acce2==0) {$acce2=0.001;};


                  try {
       $diacce= (($acce2 - $acce) / $acce2) *100;
      $diacce2= ($acce2 - $acce);
} catch (ArithmeticError | Exception $e) {

                      $diacce= 0;
                    $diacce2= 0;
}

        




              

if($difposp2 > 0){

$buttonsdifposp= "<div class='description-block border-right'><span class='description-percentage text-green'><i class='fa fa-caret-up'></i> ".number_format($difposp,2,'.',',')."%</span><h5 class='description-header'>".number_format($difposp2,0,'.',',')."</h5></div>";

}else if($difposp2 < 0){

  $buttonsdifposp= "<div class='description-block border-right'><span class='description-percentage text-red'><i class='fa fa-caret-down'></i> ".number_format($difposp,2,'.',',') ."%</span><h5 class='description-header'>".number_format($difposp2,0,'.',',')."</h5></div>";


  
}else{

  $buttonsdifposp= "<div class='description-block border-right'><span class='description-percentage text-yellow'><i class='fa fa-caret-left'></i> ".number_format($difposp,2,'.',',')."%</span><h5 class='description-header'>".number_format($difposp2,0,'.',',')."</h5></div>";


  
}

if($difclaro2 > 0){

$buttonsdiclaro= "<div class='description-block border-right'><span class='description-percentage text-green'><i class='fa fa-caret-up'></i> ". number_format($difclaro,2,'.',',')."%</span><h5 class='description-header'>".number_format($difclaro2,0,'.',',')."</h5></div>";

}else if($difclaro2 < 0){

  $buttonsdiclaro= "<div class='description-block border-right'><span class='description-percentage text-red'><i class='fa fa-caret-down'></i> ".number_format($difclaro,2,'.',',')."%</span><h5 class='description-header'>".number_format($difclaro2,0,'.',',')."</h5></div>";


  
}else {

  $buttonsdiclaro= "<div class='description-block border-right'><span class='description-percentage text-yellow'><i class='fa fa-caret-left'></i> ".number_format($difclaro,2,'.',',')."%</span><h5 class='description-header'>".number_format($difclaro2,0,'.',',')."</h5></div>";


  
}


if($didigital2 > 0){

$buttonsdidigital= "<div class='description-block border-right'><span class='description-percentage text-green'><i class='fa fa-caret-up'></i> ". number_format($didigital,2,'.',',') ."%</span><h5 class='description-header'>".number_format($didigital2,0,'.',',')."</h5></div>";

}else if($didigital2 < 0){

  $buttonsdidigital= "<div class='description-block border-right'><span class='description-percentage text-red'><i class='fa fa-caret-down'></i> ".number_format($didigital,2,'.',',')."%</span><h5 class='description-header'>".number_format($didigital2,0,'.',',')."</h5></div>";


  
}else {

  $buttonsdidigital= "<div class='description-block border-right'><span class='description-percentage text-yellow'><i class='fa fa-caret-left'></i> ".number_format($didigital,2,'.',',')."%</span><h5 class='description-header'>".number_format($didigital2,0,'.',',')."</h5></div>";


  
}


if($diacce2 > 0){

$buttonsdiacce= "<div class='description-block border-right'><span class='description-percentage text-green'><i class='fa fa-caret-up'></i> ".number_format($diacce,2,'.',',')."%</span><h5 class='description-header'>₡".number_format($diacce2,0,'.',',')."</h5></div>";

}else if($diacce2 < 0){

  $buttonsdiacce= "<div class='description-block border-right'><span class='description-percentage text-red'><i class='fa fa-caret-down'></i> ".number_format($diacce,2,'.',',')."%</span><h5 class='description-header'₡>".number_format($diacce2,0,'.',',')."</h5></div>";


  
}else {

  $buttonsdiacce= "<div class='description-block border-right'><span class='description-percentage text-yellow'><i class='fa fa-caret-left'></i> ".number_format($diacce,2,'.',',')."%</span><h5 class='description-header'₡>".number_format($diacce2,0,'.',',')."</h5></div>";


  
}        



    $JsonData .= '[
                   
                   "'.$response[$i]["tienda"].'",
                    "'.$response[$i]["supervisor"].'",
                   "'.$response[$i]["pospago"].'",
                   "'.$response[$i]["pospago2"].'",
                   "'. $buttonsdifposp .'",
                   "'.$response[$i]["claro"].'",
                   "'.$response[$i]["claro2"].'",
                   "'. $buttonsdiclaro .'",
                   "'.$response[$i]["digital"].'",
                   "'.$response[$i]["digital2"].'",
                   "'. $buttonsdidigital .'",
                    "'.$response[$i]["accesorios"].'",
                   "'.$response[$i]["accesorios2"].'",
                   "'. $buttonsdiacce .'"

                   ],';


                }
                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($response) == 0) {
   $JsonData = '{
               "data": [] }';

             };


    
    echo $JsonData;

  /* echo json_encode($response);*/



  }

}
/*=============================================
=      ACTIVATE PRODUCTS TABLE      =
=============================================*/

/*$activateOrders = new TableOrders();
$activateOrders -> showTableOrders();*/

if(isset($_GET["desde1"])){

  $edit = new TableSales();

  $edit -> desde1 = $_GET["desde1"];

  $edit -> hasta1 = $_GET["hasta1"];

    $edit -> desde2 = $_GET["desde2"];

  $edit -> hasta2 = $_GET["hasta2"];

  $edit -> showTableSales();

}