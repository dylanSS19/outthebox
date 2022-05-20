<?php

require_once "../controllers/sucursal-cajas-facturacion.controller.php";
require_once "../models/sucursal-cajas-facturacion.model.php";

 
class TableSucursalesCajas{

  /*=============================================
=      SHOW PRODUCTS TABLE      =
=============================================*/

public $idempresa ;
  public function showTableSucursalesCajas(){

$idempresa = $this->IdEmpresa;
          
             $response = SucursalesCajasController::ctrCargarSucursal($idempresa);
             
            //  echo '<pre>'; print_r($response); echo '</pre>';
      
           $JsonData = '{
               "data": [';

               session_start();

                for($i =0; $i < count($response); $i++){

                
         $buttons = "<div class='btn-group'><button class='btn btn-info btnAddconse' idsucursalId='".$response[$i]["idsucursal"]."' idcajaId='".$response[$i]["idcaja"]."' data-toggle='modal' data-target='#'> <i class='fas fa-info-circle'></i></div>";

    $JsonData .= '[
                   "'.($i+1).'",                  
                   "'.$buttons.'",
                   "'.$response[$i]["nombre"].'",
                   "'.$response[$i]["idsucursal"].'",
                   "'.$response[$i]["caja"].'",
                   "'.$response[$i]["idcaja"].'"
                   ],';


                }



                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($response) == 0) {
   $JsonData = '{
               "data": [] }';

             };


    // echo $JsonData;



 echo $JsonData;



  }

}

/*=============================================
=      ACTIVATE PRODUCTS TABLE      =
=============================================*/

/*$activateOrders = new TableOrders();
$activateOrders -> showTableOrders();*/

if(isset($_GET["IdEmpresa"])){

  $edit = new TableSucursalesCajas();

  $edit -> IdEmpresa = $_GET["IdEmpresa"];

  $edit -> showTableSucursalesCajas();

}