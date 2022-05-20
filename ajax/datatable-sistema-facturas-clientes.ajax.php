<?php

require_once "../controllers/sistema-facturas-clientes.controller.php";
require_once "../models/sistema-facturas-clientes.model.php";
 

class TableCliente{


public $clientes;

    public function showTableCliente(){


session_start();


$ID_empresa = $_SESSION['empresa'];

$response = ReporteClientesController::ctrCargarClientesXempresa($ID_empresa);



 $JsonData = '{
               "data": [';


for($i =0; $i < count($response); $i++){


$TipoCedula = "";

if($response[$i]['tipo_cedula'] == "01"){

$TipoCedula = "Fisico";

}else if($response[$i]['tipo_cedula'] == "02"){

$TipoCedula = "Juridico";

}else if($response[$i]['tipo_cedula'] == "03"){

$TipoCedula = "Dimex";

}else if($response[$i]['tipo_cedula'] == "Pasaporte"){

$TipoCedula = "Pasaporte";

}



$buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnClient'  idclient='".$response[$i]['idtbl_empresas_clientes']."' data-toggle='modal' data-target='#modalEditClientes'><i class='fas fa-info-circle'></i></button></div>";

    $JsonData .= '[

                   "'.($i + 1).'",         
                   "'.$buttons.'",              
                   "'.$response[$i]['Nombre'].'",
                   "'.$TipoCedula.'",    
                   "'.$response[$i]['cedula'].'"
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

  $edit = new TableCliente();

  $edit -> clientes = $_GET["dato"];

  $edit -> showTableCliente();

}