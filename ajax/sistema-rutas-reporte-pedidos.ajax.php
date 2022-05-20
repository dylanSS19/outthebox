
<?php

require_once "../controllers/sistema-rutas-reporte-pedidos.controller.php";
require_once "../models/sistema-rutas-reporte-pedidos.model.php";

class ajaxReportPedidos{
 

        public $idFact;

        
    public function ajaxCargarDetalleFacturas(){

    $idFactura = $this->idFact;
  

        $response = ReportPedidosController::ctrCargarDetalleFacturas($idFactura);

        echo json_encode($response);

    }

}

if(isset($_GET["idFact"])){

    $edit = new ajaxRutas();
  
    $edit -> idFact = $_GET["idFact"];
 
    
    $edit -> ajaxCargarIDruta();
  
  }