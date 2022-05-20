<?php

require_once "../controllers/aceptacion-planes-clientes.controller.php";
require_once "../models/aceptacion-planes-clientes.model.php";


class TableAceptacionPlanes{

    // public $idEmpresa; 

    public function showTableAceptacionPlanes(){


        // $idEmpresa = $this->idEmpresa;

        $response = controladorAceptacionPlanes::ctrCargarPlanes();
            
       $JsonData = '{
         "data": [';

         session_start();

                for($i =0; $i < count($response); $i++){

        $buttons = "<div class='btn-group'><button class='btn btn-outline-info btnAcepPlan' ClientId='".$response[$i]["idtbl_clientes_planes"]."' data-toggle='modal' data-target='#'> <i class='fas fa-info-circle'></i></div>";

        $JsonData .= '[
                    "'.($i+1).'",                  
                    "'.$response[$i]["nombre"].'",
                    "'.$response[$i]["nombrePlan"].'",
                    "'.$response[$i]["total_pagar"].'",
                    "'.$response[$i]["estado"].'",
                    "'.$buttons.'"
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


/*=============================================
=      ACEPTACION DE PLANES    =
=============================================*/

/*$activateOrders = new TableOrders();
$activateOrders -> showTableOrders();*/

if(isset($_GET["datos"])){

    $edit = new TableAceptacionPlanes();
  
    $edit -> Rol = $_GET["datos"];
  
    $edit -> showTableAceptacionPlanes();
  
  }