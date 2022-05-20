<?php

require_once "../controllers/sistema-facturas-actividadEco.controller.php";
require_once "../models/sistema-facturas-actividadEco.model.php";


class TableActividadesEconomicas{

	public $actividadE;
 
    public function showTableActividadeEconomica(){

		$actividadE = $this->actividadE;

        session_start();      
        $idempresa = $_SESSION['empresa'];

$response = ActividadEconomicaController::ctrCargarActividadesEconomicas($idempresa);

 $JsonData = '{
               "data": [';


for($i =0; $i < count($response); $i++){

$buttons = "<div class='btn-group'><button class='btn btn-outline-primary'  act='".$response[$i]['idtbl_actividad_economica_clientes']."'><i class='fas fa-info-circle'></i></button></div>";

    $JsonData .= '[
                    "'.($i + 1).'",               
                   "'.$buttons.'",                               
                   "'.$response[$i]['nombre'].'",
                   "'.$response[$i]['codigo'].'"              
                   ],';

}


                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($response) == 0) {
   $JsonData = '{
               "data": [] }';

             };


// echo '<pre>'; print_r($response); echo '</pre>';
echo $JsonData;



	  }


}


if(isset($_GET["dato"])){

  $edit = new TableActividadesEconomicas();

  $edit -> actividadE = $_GET["dato"];

  $edit -> showTableActividadeEconomica();

}