<?php

require_once "../controllers/sistema-facturas-actividadEco.controller.php";
require_once "../models/sistema-facturas-actividadEco.model.php";


class TableActividades{

	public $actividadE;

    public function showTableActividades(){

		$actividadE = $this->actividadE;

$response = ActividadEconomicaController::ctrCargarActividad();

 $JsonData = '{
               "data": [';


for($i =0; $i < count($response); $i++){

$buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnAddActividad' title='Agregar Actividad' act='".$response[$i]['codigo_actividad']."' nomAct ='".$response[$i]['nombre_actividad']."'><i class=''>Agregar</i></button></div>";

    $JsonData .= '[
                                  
                   "'.$buttons.'",                               
                   "'.$response[$i]['nombre_actividad'].'",
                   "'.$response[$i]['codigo_actividad'].'"              
                   ],';

}


                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($response) == 0) {
   $JsonData = '{
               "data": [] }';

             };


//echo '<pre>'; print_r($response); echo '</pre>';
echo $JsonData;



	  }


}


/*=============================================
  =            CONSULTAR API CABYS               =
  =============================================*/
if(isset($_GET["dato"])){

  $edit = new TableActividades();

  $edit -> actividadE = $_GET["dato"];

  $edit -> showTableActividades();

}