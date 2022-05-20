<?php

require_once "../controllers/reporte-ventas-dth.controller.php";
require_once "../models/reporte-ventas-dth.model.php";


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



                     
              $response = ControladorVentasDth::ctrCargarVentasTotalesCompararTablas($Vardesde1, $Varhasta1,$Vardesde2, $Varhasta2);
        

            

             $JsonData = '{
               "data": [';

            

                for($i =0; $i < count($response); $i++){



                                    $dth = $response[$i]["dth"];
                  $dth2 = $response[$i]["dth2"];



    
if($dth==0)  {$dth=0.001;};
  if($dth2==0){$dth2=0.001;};

                  try {
      $difdth= (($dth2 - $dth) / $dth) *100;
      $difdth2= ($dth2 - $dth);
} catch (ArithmeticError | Exception $e) {
                      $difdth= 0;
                    $difdth2= 0;
};

       


                  $int = $response[$i]["internet"];
                  $int2 = $response[$i]["internet2"];
  if($int==0)  {$int=0.001;};
  if($int2==0) {$int2=0.001;};

                  try {
       $difint= (($int2 - $int) / $int2) *100;
      $difint2= ($int2 - $int);
} catch (ArithmeticError | Exception $e) {
                      $difint= 0;
                    $difint2= 0;
};





                  $pos = $response[$i]["pospago"];
                  $pos2 = $response[$i]["pospago2"];

  if($pos==0)  {$pos=0.001;};
  if($pos2==0) {$pos2=0.001;};
              

                  try {
       $dipos= (($pos2 - $pos) / $pos2) *100;
      $dipos2= ($pos2 - $pos);
} catch (ArithmeticError | Exception $e) {
                      $dipos= 0;
                    $dipos2= 0;
}


          

                  $gpon = $response[$i]["gpon"];
                  $gpon2 = $response[$i]["gpon2"];

                    if($gpon==0)  {$gpon=0.001;};
  if($gpon2==0) {$gpon2=0.001;};


                  try {
       $digpon= (($gpon2 - $gpon) / $gpon2) *100;
      $digpon2= ($gpon2 - $gpon);
} catch (ArithmeticError | Exception $e) {

                      $digpon= 0;
                    $digpon2= 0;
}

        


                  $tot = $response[$i]["total"];
                  $tot2 = $response[$i]["total2"];
              
                                if($tot==0)  {$tot=0.001;};
  if($tot2==0) {$tot2=0.001;};


                  try {
       $ditot= (($tot2 - $tot) / $tot2) *100;
      $ditot2= ($tot2 - $tot);
} catch (ArithmeticError | Exception $e) {
  
                      $ditot= 0;
                    $ditot2= 0;
}

              

if($difdth2 > 0){

$buttonsdifdth= "<div class='description-block border-right'><span class='description-percentage text-green'><i class='fa fa-caret-up'></i> ".number_format($difdth,2,'.',',')."%</span><h5 class='description-header'>".number_format($difdth2,0,'.',',')."</h5></div>";

}else if($difdth2 < 0){

  $buttonsdifdth= "<div class='description-block border-right'><span class='description-percentage text-red'><i class='fa fa-caret-down'></i> ".number_format($difdth,2,'.',',') ."%</span><h5 class='description-header'>".number_format($difdth2,0,'.',',')."</h5></div>";


  
}else{

  $buttonsdifdth= "<div class='description-block border-right'><span class='description-percentage text-yellow'><i class='fa fa-caret-left'></i> ".number_format($difdth,2,'.',',')."%</span><h5 class='description-header'>".number_format($difdth2,0,'.',',')."</h5></div>";


  
}

if($difint2 > 0){

$buttonsdiint= "<div class='description-block border-right'><span class='description-percentage text-green'><i class='fa fa-caret-up'></i> ". number_format($difint,2,'.',',')."%</span><h5 class='description-header'>".number_format($difint2,0,'.',',')."</h5></div>";

}else if($difint2 < 0){

  $buttonsdiint= "<div class='description-block border-right'><span class='description-percentage text-red'><i class='fa fa-caret-down'></i> ".number_format($difint,2,'.',',')."%</span><h5 class='description-header'>".number_format($difint2,0,'.',',')."</h5></div>";


  
}else {

  $buttonsdiint= "<div class='description-block border-right'><span class='description-percentage text-yellow'><i class='fa fa-caret-left'></i> ".number_format($difint,2,'.',',')."%</span><h5 class='description-header'>".number_format($difint2,0,'.',',')."</h5></div>";


  
}


if($dipos2 > 0){

$buttonsdipos= "<div class='description-block border-right'><span class='description-percentage text-green'><i class='fa fa-caret-up'></i> ". number_format($dipos,2,'.',',') ."%</span><h5 class='description-header'>".number_format($dipos2,0,'.',',')."</h5></div>";

}else if($dipos2 < 0){

  $buttonsdipos= "<div class='description-block border-right'><span class='description-percentage text-red'><i class='fa fa-caret-down'></i> ".number_format($dipos,2,'.',',')."%</span><h5 class='description-header'>".number_format($dipos2,0,'.',',')."</h5></div>";


  
}else {

  $buttonsdipos= "<div class='description-block border-right'><span class='description-percentage text-yellow'><i class='fa fa-caret-left'></i> ".number_format($dipos,2,'.',',')."%</span><h5 class='description-header'>".number_format($dipos2,0,'.',',')."</h5></div>";


  
}


if($digpon2 > 0){

$buttonsdigpon= "<div class='description-block border-right'><span class='description-percentage text-green'><i class='fa fa-caret-up'></i> ".number_format($digpon,2,'.',',')."%</span><h5 class='description-header'>".number_format($digpon2,0,'.',',')."</h5></div>";

}else if($digpon2 < 0){

  $buttonsdigpon= "<div class='description-block border-right'><span class='description-percentage text-red'><i class='fa fa-caret-down'></i> ".number_format($digpon,2,'.',',')."%</span><h5 class='description-header'>".number_format($digpon2,0,'.',',')."</h5></div>";


  
}else {

  $buttonsdigpon= "<div class='description-block border-right'><span class='description-percentage text-yellow'><i class='fa fa-caret-left'></i> ".number_format($digpon,2,'.',',')."%</span><h5 class='description-header'>".number_format($digpon2,0,'.',',')."</h5></div>";


  
}

if($ditot2 > 0){

$buttonsditot= "<div class='description-block border-right'><span class='description-percentage text-green'><i class='fa fa-caret-up'></i> ". number_format($ditot,2,'.',',')."%</span><h5 class='description-header'>".number_format($ditot2,0,'.',',')."</h5></div>";

}else if($ditot2 < 0){

  $buttonsditot= "<div class='description-block border-right'><span class='description-percentage text-red'><i class='fa fa-caret-down'></i> ".number_format($ditot,2,'.',',')."%</span><h5 class='description-header'>".number_format($ditot2,0,'.',',')."</h5></div>";


  
}else {

  $buttonsditot= "<div class='description-block border-right'><span class='description-percentage text-yellow'><i class='fa fa-caret-left'></i> ".number_format($ditot,2,'.',',')."%</span><h5 class='description-header'>".number_format($ditot2,0,'.',',')."</h5></div>";


  
}



    $JsonData .= '[
                   
                   "'.$response[$i]["coordinador"].'",
                   "'.$response[$i]["nombre"].'",
                   "'.$response[$i]["representante"].'",
                   "'.$response[$i]["division"].'",
                   "'.$response[$i]["dth"].'",
                   "'.$response[$i]["dth2"].'",
                    "'. $buttonsdifdth .'",
                   "'.$response[$i]["internet"].'",
                    "'.$response[$i]["internet2"].'",
                     "'. $buttonsdiint .'",
                   "'.$response[$i]["pospago"].'",
                   "'.$response[$i]["pospago2"].'",
                    "'. $buttonsdipos .'",
                   "'.$response[$i]["gpon"].'",
                    "'.$response[$i]["gpon2"].'",
                      "'. $buttonsdigpon .'",
                   "'.$response[$i]["total"].'",                                                 
                   "'.$response[$i]["total2"].'",
                     "'. $buttonsditot .'"

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
=      dthIVATE PRODUCTS TABLE      =
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