<?php

require_once "../controllers/sistema-facturas-clientes.controller.php";
require_once "../models/sistema-facturas-clientes.model.php";
 

class TableSearchCedula{


public $cedulabuscar;
    public function showTableSearchCedula(){

        $Cedula = $this->cedulabuscar;

// session_start();


// $ID_empresa = $_SESSION['empresa'];

$response = ReporteClientesController::ctrCargarcedula($Cedula);

$results = json_decode($response);

 $JsonData = '{
               "data": [';

 
for($i =0; $i < count($results->results); $i++){



$buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnCedulaSearch'  idtipo='".$results->results[$i]->guess_type."' nom='".$results->results[$i]->fullname."' ced='".$results->results[$i]->cedula."'><i class='fas fa-info-circle'></i></button></div>";

    $JsonData .= '[
                                 
                   "'.$buttons.'",              
                   "'.$results->results[$i]->fullname.'",
                   "'.$results->results[$i]->guess_type.'",    
                   "'.$results->results[$i]->cedula.'"
                   ],';

}


                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($results->results) == 0) {
   $JsonData = '{
               "data": [] }';

             };


// echo '<pre>'; print_r($results->results[0]); echo '</pre>';
echo $JsonData;



	  }


}




if(isset($_GET["cedulaSearch"])){

  $edit = new TableSearchCedula();

  $edit -> cedulabuscar = $_GET["cedulaSearch"];

  $edit -> showTableSearchCedula();

}