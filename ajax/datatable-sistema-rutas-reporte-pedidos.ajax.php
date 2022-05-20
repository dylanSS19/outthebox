<?php

require_once "../controllers/sistema-rutas-reporte-pedidos.controller.php";
require_once "../models/sistema-rutas-reporte-pedidos.model.php";
 
class TableReportPedidos{


public $pedidos;
public $StarDate;
public $EndDate;
public $ruta;

    public function showTableReportPedidos(){

        $StarDate = $this->StarDate;
        $EndDate = $this->EndDate;
        $ruta = $this->ruta;
// session_start();

$ID_empresa = $_COOKIE['cookie_empresa'];

$response = ReportPedidosController::ctrCargarFacturas($ID_empresa, $StarDate, $EndDate, $ruta);

// echo '<pre>'; print_r($response); echo '</pre>';

// exit();

 $JsonData = '{
               "data": [';


for($i =0; $i < count($response); $i++){



$buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnDetPedido'  idFactura ='".$response[$i]["idtbl_factura"]."'><i class='fas fa-info-circle'></i></button></div>";

    $JsonData .= '[
                   "'.($i + 1).'",              
                   "'.$buttons.'",              
                   "'.date("Y-m-d", strtotime($response[$i]["fecha"])).'",
                   "'.$response[$i]["nombre"].'",
                   "'.$response[$i]["cedula"].'",    
                   "'.$response[$i]["estado"].'"
                   ],';

}


                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($response) == 0) {
   $JsonData = '{
               "data": [] }';

             };


// echo '<pre>'; print_r($results->results[0]); echo '</pre>';
echo $JsonData;



	  }

    public $idFact;
    public function showTableReportPedidosDetalle(){

      $idFactura = $this->idFact;

$response = ReportPedidosController::ctrCargarDetalleFacturas($idFactura);


$JsonData = '{
             "data": [';


for($i =0; $i < count($response); $i++){



  $JsonData .= '[
                 "'.($i + 1).'",              
                 "'.$response[$i]["descripcion"].'",              
                 "'.$response[$i]["sku"].'",
                 "'.$response[$i]["cantidad"].'",
                 "'.$response[$i]["precio_unitario"].'",    
                 "'.$response[$i]["descuento"].'",
                 "'.$response[$i]["impuesto"].'",    
                 "'.$response[$i]["total"].'"
                 ],';

}


              $JsonData = substr($JsonData, 0, -1);

   $JsonData .=   '] 

   }';

      if(count($response) == 0) {
 $JsonData = '{
             "data": [] }';

           };


// echo '<pre>'; print_r($results->results[0]); echo '</pre>';
echo $JsonData;



  }



}




if(isset($_GET["dato"])){

  $edit = new TableReportPedidos();

  $edit -> pedidos = $_GET["dato"];
  $edit -> StarDate = $_GET["StarDate"];
  $edit -> EndDate = $_GET["EndDate"];
  $edit -> ruta = $_GET["Ruta"];

  $edit -> showTableReportPedidos();

}

if(isset($_GET["idFact"])){

  $edit = new TableReportPedidos();

  $edit -> idFact = $_GET["idFact"];

  
  $edit -> showTableReportPedidosDetalle();

}