<?php

require_once "../controllers/mover-saldo-bodegas.controller.php";
require_once "../models/mover-saldo-bodegas.model.php";


class TableTransferenciaSaldos{


  public function showTableBodegas(){

session_start();

$value = $_SESSION["id"];


if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){

  $response = MoverSaldoController::ctrCargarBodegas($value);


}elseif ($_SESSION["rol"]=="Cliente") {

    $response = MoverSaldoController::ctrCargarBodegasxusuario($value);

}



 $JsonData = '{
    "data": [';




 for($i =0; $i < count($response); $i++){



 $buttons = "<div class='btn-group'><button class='btn btn-info btnEditClient' ClientId='".$response[$i]["idtbl_bodegas"]."' data-toggle='modal' data-target='#'> <i class='fas fa-info-circle'></i></div>";


 $JsonData .= '[
                   "'.($i+1).'",                  
                   "'.$buttons.'",                 
                    "'.$response[$i]["nombre"].'",
                    "'.$response[$i]["cliente"].'",
                    "'.$response[$i]["saldo"].'"
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




if(isset($_GET["Rol"])){

  $edit = new TableTransferenciaSaldos();

  $edit -> Rol = $_GET["Rol"];

  $edit -> showTableBodegas();

}