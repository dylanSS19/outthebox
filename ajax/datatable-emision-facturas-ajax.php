<?php

require_once "../controllers/emision-facturas.controller.php";
require_once "../models/emision-facturas.model.php";
 

class TableEmisionFacturas{

    public $fechaInicio;
    public $fechaFin;
    public $ruta;

  public function showTableEmisionFacturas(){

session_start();

$fechaInicio = $this->fechaInicio;
$fechaFin = $this->fechaFin;
$ruta = $this->ruta;


if($fechaInicio == "n"){

    date_default_timezone_set('America/Costa_Rica');

    $fechaInicio = date('Y-m-d');
    $fechaFin = date('Y-m-d');
}

if($ruta == "n"){

  $ruta = "";

}

$value = $_SESSION["id"];
$empresa = $_SESSION['empresa'];

// if($_SESSION["rol"]=="AllMarket-Admin" || $_SESSION["rol"]=="AllMarket-supervisor"){

    $data = array("fechaInicio" => $fechaInicio,
    "FechaFin" => $fechaFin,
    "empresa" => $empresa,	                 
    "ruta" => $ruta);

  $response = EmisionFacturasController::ctrCargarFacturas($data);


// }elseif ($_SESSION["rol"]=="AllMarket-Vendedor") {

//     date_default_timezone_set('America/Costa_Rica');

//     $fechainicio = date('Y-m-d');
//     $fechafin = date('Y-m-d');

//     $data = array("fechaInicio" =>  $fechainicio,
//     "FechaFin" => $fechafin,
//     "empresa" => $empresa,	                 
//     "ruta" => $_GET["Ruta"]);

//     $response = EmisionFacturasController::CargarFacturasXruta($data);
  
// }

// echo '<pre>'; print_r($response); echo '</pre>';

// exit();
 $JsonData = '{
    "data": [';


 

 for($i =0; $i < count($response); $i++){


if($response[$i]["estado_factura"] == "Pendiente"){

  $buttons = "<div class='btn-group mr-4'><button class='btn btn-outline-primary btnemitir' idFactura='".$response[$i]["idtbl_facturacion_emitir_facturas"]."' numFact='".$response[$i]["numeroFactura"]."'> <i class=''>Facturar</i></div>";
  // $buttons .= "&nbsp&nbsp<div class='btn-group'><button class='btn btn-outline-danger btnanular' idFactura='".$response[$i]["idtbl_facturacion_emitir_facturas"]."'> <i class=''>Anular</i></div>";
  $buttons .= "<input class='form-check-input chkFacturar' type='checkbox' id='".$response[$i]["idtbl_facturacion_emitir_facturas"]."' numFact='".$response[$i]["numeroFactura"]."' style='width:25px; height:25px;'>";
  // $buttons .= "<div class='form-check'><input class='form-check-input' type='checkbox' class='chkFacturar' id='".$response[$i]["idtbl_facturacion_emitir_facturas"]."' numFact='".$response[$i]["numeroFactura"]."' ><label class='form-check-label' for='+ response[i].idtbl_subModulos_outthebox +'></label></div>";
  
}else{

  $buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnemitir' idFactura='".$response[$i]["idtbl_facturacion_emitir_facturas"]."' numFact='".$response[$i]["numeroFactura"]."' disabled> <i class=''>Facturar</i></div>";
  // $buttons .= "&nbsp&nbsp<div class='btn-group'><button class='btn btn-outline-danger btnanular' idFactura='".$response[$i]["idtbl_facturacion_emitir_facturas"]."' disabled> <i class=''>Anular</i></div>";
  $buttons .= "<input class='form-check-input chkFacturar' type='checkbox' id='".$response[$i]["idtbl_facturacion_emitir_facturas"]."' numFact='".$response[$i]["numeroFactura"]."' style='width:25px; height:25px;'>";

}


 $JsonData .= '[
                   "'.($i+1).'",                  
                   "'.$buttons.'",                 
                    "'.$response[$i]["nombre_cliente"].'",
                    "'.$response[$i]["cedula_cliente"].'",
                    "'.$response[$i]["correo_cliente"].'",
                    "'.date("Y-m-d", strtotime($response[$i]["fecha_factura"])).'"
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




if(isset($_GET["Ruta"])){

  $edit = new TableEmisionFacturas();

  $edit -> ruta = $_GET["Ruta"];
  $edit -> fechaInicio = $_GET["startDate"];
  $edit -> fechaFin = $_GET["endDate"];

  $edit -> showTableEmisionFacturas();

}