<?php

require_once "../controllers/sistema-facturas-reporte-gastos.controller.php";
require_once "../models/sistema-facturas-reporte-gastos.model.php";


class TableReporteGastos{

    public $dato;
  public function showTableReporteGastos(){

    session_start();

    $Fechas = $this->dato;

    $Fechas = json_decode($Fechas, true);


    $fechaDesde = "";
    $FechaHasta = "";
        $fechaDesde = $Fechas[0]["FechaInicio"];
        $FechaHasta = $Fechas[0]["FechaFin"];

    

    // echo '<pre>'; print_r($Fechas); echo '</pre>';
    // echo '<pre>'; print_r($fechaDesde); echo '</pre>';
    // echo '<pre>'; print_r($FechaHasta); echo '</pre>';


    $idempresa =  $_SESSION["empresa"];

    $response = ReporteGastosController::ctrCargarGastos($idempresa, $fechaDesde, $FechaHasta);

    // echo '<pre>'; print_r($response); echo '</pre>';

    // exit();



        $JsonData = '{
            "data": [';

          
            for($i =0; $i < count($response); $i++){

              $ResultTipoC = ($response[$i]["totalComprobante"] * $response[$i]["tipoCambio"]);

              // echo '<pre>'; print_r($ResultTipoC); echo '</pre>';

            $buttons = "<div class='btn-group'><button class='btn btn-info btnFacGasto' idFactura='".$response[$i]["idtbl_sistema_facturacion_Factura_gastos"]."'> <i class='fas fa-info-circle'></i></div>";
            
            $JsonData .= '[
                        "'.($i+1).'",                  
                        "'.$buttons.'",                   
                        "'.str_replace ( '"' , '' ,$response[$i]["nombreEmisor"]).'",
                        "'.$response[$i]["consecutivo"].'",
                        "'.date("d-m-Y", strtotime($response[$i]["fechaEmision"])).'",
                        "'.$ResultTipoC.'"
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


  public function showTableReporteGastosDetalle(){


    $DetalleFac = $this->DetalleFac;

    $response = ReporteGastosController::ctrCargarGastosDetalle($DetalleFac);

    // echo '<pre>'; print_r($response); echo '</pre>';

    // exit();

        $JsonData = '{
            "data": [';

          

            for($i =0; $i < count($response); $i++){





            $JsonData .= '[
                        "'.($i+1).'",                                    
                        "'.str_replace ( '"' , '' ,$response[$i]["nombre"]).'",
                        "'.$response[$i]["codigo"].'",
                        "'.$response[$i]["cantidad"].'",
                        "'.number_format( (float) $response[$i]["precioUnidad"], 2, '.', ',').'",
                        "'.number_format( (float) $response[$i]["subTotal"], 2, '.', ',').'",
                        "'.number_format( (float) $response[$i]["descuento"], 2, '.', ',').'",
                        "'.number_format( (float) $response[$i]["iva"], 2, '.', ',').'",
                        "'.number_format( (float) $response[$i]["total"], 2, '.', ',').'"           
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



if(isset($_GET["dato"])){

    $edit = new TableReporteGastos();
  
    $edit -> dato = $_GET["dato"];
  
    $edit -> showTableReporteGastos();
  
  }

  if(isset($_GET["DetalleFac"])){

    $edit = new TableReporteGastos();
  
    $edit -> DetalleFac = $_GET["DetalleFac"];
  
    $edit -> showTableReporteGastosDetalle();
  
  }