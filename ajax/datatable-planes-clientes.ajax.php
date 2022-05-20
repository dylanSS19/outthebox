<?php

require_once "../controllers/planes-clientes.controller.php";
require_once "../models/planes-clientes.model.php";


class TablePlanesCliente{

 
  public function showTablePlanesCliente(){

    session_start();

    $idEmpresa = $_SESSION['empresa'];

    $response = PlanesClientesController::ctrCargarPlanesClientes($idEmpresa);


 $JsonData = '{
    "data": [';




 for($i =0; $i < count($response); $i++){



 $buttons = "<div class='btn-group'><button class='btn btn-info ' paquete='".$response[$i]["idtbl_clientes_planes"]."' cliente = '".$response[$i]["cliente"]."' data-toggle='modal' data-target='#'> <i class='fas fa-info-circle'></i></div>";


 $JsonData .= '[
                   "'.($i+1).'",                  
                   "'.$buttons.'",                 
                    "'.$response[$i]["nombrePlan"].'",
                    "'.$response[$i]["estado"].'",
                    "'.date("Y-m-d", strtotime($response[$i]["fecha_fin"])).'",
                    "'.number_format( (float) $response[$i]["total_pagar"], 2, '.', ',').'"              
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

  }

}




if(isset($_GET["val"])){

  $edit = new TablePlanesCliente();

  $edit -> Rol = $_GET["val"];

  $edit -> showTablePlanesCliente();

}