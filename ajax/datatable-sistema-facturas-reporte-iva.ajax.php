<?php

require_once "../controllers/sistema-facturas-reporte-iva.controller.php";
require_once "../models/sistema-facturas-reporte-iva.model.php";

class TableReporteIva{

  public $fechas1;
  public function showTableReporteIva(){

    $fechas1 = $this->fechas1;

    $Fechas = json_decode($fechas1, true);


    $fechaDesde = "";
    $FechaHasta = "";
        $fechaDesde = $Fechas[0]["FechaInicio"];
        $FechaHasta = $Fechas[0]["FechaFin"];

    

    // echo '<pre>'; print_r($Fechas); echo '</pre>';
    // echo '<pre>'; print_r($fechaDesde); echo '</pre>';
    // echo '<pre>'; print_r($FechaHasta); echo '</pre>';

    session_start();
    $idempresa =  $_SESSION["empresa"];

    $response = ReporteIvaController::ctrCargarIva($idempresa, $fechaDesde, $FechaHasta);

    // echo '<pre>'; print_r($response); echo '</pre>';

    // exit();



        $JsonData = '{
            "data": [';

          
            for($i =0; $i < count($response); $i++){

              $TotalIva = ($response[$i]["iva_uno"] + $response[$i]["iva_dos"] + $response[$i]["iva_cuatro"] + $response[$i]["iva_ocho"] + $response[$i]["iva_trece"]);

              // echo '<pre>'; print_r($ResultTipoC); echo '</pre>';

            // $buttons = "<div class='btn-group'><button class='btn btn-info btnFacGasto' idFactura='".$response[$i]["idtbl_facturas"]."'> <i class='fas fa-info-circle'></i></div>";
            
        
            $JsonData .= '[
                        "'.($i+1).'",                                                        
                        "'.date("d-m-Y", strtotime($response[$i]["fecha"])).'",
                        "'.$response[$i]["Origen"].'",                
                        "'.$response[$i]["nombre"].'",
                        "'.$response[$i]["tipo_doc"].'",
                        "'.$response[$i]["tipo_pago"].'",
                        "'.$response[$i]["consecutivo"].'",                      
                        "'.$response[$i]["exento"].'",
                        "'.$response[$i]["base"].'",
                        "'.$TotalIva.'",                       
                        "'.$response[$i]["total"].'",
                        "'.$response[$i]["afecta"].'"
                        ],';
                        
        }
        // "'.$response[$i]["idtbl_facturas"].'", 
        // "'.$response[$i]["clave"].'",
        // "'.$response[$i]["iva_dos"].'",
        // "'.$response[$i]["iva_cuatro"].'",
        // "'.$response[$i]["iva_ocho"].'",
        // "'.$response[$i]["iva_trece"].'",
        // "'.$response[$i]["estado"].'",
            $JsonData = substr($JsonData, 0, -1);

    $JsonData .=   '] 

    }';

    if(count($response) == 0) {
    $JsonData = '{
            "data": [] }';

        };


    echo $JsonData;

  }

  public $fechas2;
  public function showTableReporteGastos(){

    $Fechas = $this->fechas2;

    $Fechas = json_decode($Fechas, true);


    $fechaDesde = "";
    $FechaHasta = "";
        $fechaDesde = $Fechas[0]["FechaInicio"];
        $FechaHasta = $Fechas[0]["FechaFin"];

    



    session_start();
    $idempresa =  $_SESSION["empresa"];

    $response = ReporteIvaController::ctrCargarCompras($idempresa, $fechaDesde, $FechaHasta);

    // echo '<pre>'; print_r($response); echo '</pre>';

    // exit();



        $JsonData = '{
            "data": [';

          
            for($i =0; $i < count($response); $i++){

                $TotalIva = ($response[$i]["iva_uno"] + $response[$i]["iva_dos"] + $response[$i]["iva_cuatro"] + $response[$i]["iva_ocho"] + $response[$i]["iva_trece"]);

              // echo '<pre>'; print_r($ResultTipoC); echo '</pre>';

            // $buttons = "<div class='btn-group'><button class='btn btn-info btnFacGasto' idFactura='".$response[$i]["idtbl_sistema_facturacion_Factura_gastos"]."'> <i class='fas fa-info-circle'></i></div>";
            
            $JsonData .= '[
                "'.($i+1).'",                                                        
                "'.date("d-m-Y", strtotime($response[$i]["fechaEmision"])).'",
                "'.$response[$i]["Proveedor"].'",
                "'.$response[$i]["Cedula_Proveedor"].'",
                "'.$response[$i]["tipo_doc"].'",
                "'.$response[$i]["consecutivo"].'",
                "'.$response[$i]["condicion_venta"].'",
                "'.$response[$i]["exento"].'",                      
                "'.$response[$i]["base"].'",
                "'.$TotalIva.'",                       
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


    echo $JsonData;

  }

  public $fechas3;
  public function showTableReporteRiva(){

    $Fechas = $this->fechas3;

    $Fechas = json_decode($Fechas, true);


    $fechaDesde = "";
    $FechaHasta = "";
        $fechaDesde = $Fechas[0]["FechaInicio"];
        $FechaHasta = $Fechas[0]["FechaFin"];

    



    session_start();
    $idempresa =  $_SESSION["empresa"];

    $response = ReporteIvaController::ctrCargarResumenIvaFacturas($idempresa, $fechaDesde, $FechaHasta);

    // echo '<pre>'; print_r($response); echo '</pre>';

    // exit();



        $JsonData = '{
            "data": [';

          
            for($i =0; $i < count($response); $i++){

                // $TotalIva = ($response[$i]["iva_uno"] + $response[$i]["iva_dos"] + $response[$i]["iva_cuatro"] + $response[$i]["iva_ocho"] + $response[$i]["iva_trece"]);

              // echo '<pre>'; print_r($ResultTipoC); echo '</pre>';

            // $buttons = "<div class='btn-group'><button class='btn btn-info btnFacGasto' idFactura='".$response[$i]["idtbl_sistema_facturacion_Factura_gastos"]."'> <i class='fas fa-info-circle'></i></div>";
            
            $JsonData .= '[
                "'.($i+1).'",                                                        
                "'.$response[$i]["tipo"].'",
                "'.$response[$i]["exentasservicios"].'",
                "'.$response[$i]["gravadasservicios"].'",
                "'.$response[$i]["ivaservicios"].'",
                "'.$response[$i]["totalservicios"].'",
                "'.$response[$i]["exentasbienes"].'",
                "'.$response[$i]["gravadasbienes"].'",                      
                "'.$response[$i]["ivabienes"].'",
                "'.$response[$i]["totalbienes"].'",                       
                "'.$response[$i]["exentasnosujetas"].'",                       
                "'.$response[$i]["gravadasnosujetas"].'",                       
                "'.$response[$i]["ivanosujetas"].'",                       
                "'.$response[$i]["totalnosujetas"].'"
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


  public $fechas4;
  public function showTableReporteRgastos(){

    $Fechas = $this->fechas3;

    $Fechas = json_decode($Fechas, true);


    $fechaDesde = "";
    $FechaHasta = "";
        $fechaDesde = $Fechas[0]["FechaInicio"];
        $FechaHasta = $Fechas[0]["FechaFin"];

    



    session_start();
    $idempresa =  $_SESSION["empresa"];

    $datosEmpresa = ReporteIvaController::ctrCargarDatosEmpresa($idempresa);
    $response = ReporteIvaController::ctrCargarResumenGastosFacturas($idempresa, $datosEmpresa[0]["cedula"], $fechaDesde, $FechaHasta);

    // echo '<pre>'; print_r($response); echo '</pre>';

    // exit();



        $JsonData = '{
            "data": [';

          
            for($i =0; $i < count($response); $i++){

                // $TotalIva = ($response[$i]["iva_uno"] + $response[$i]["iva_dos"] + $response[$i]["iva_cuatro"] + $response[$i]["iva_ocho"] + $response[$i]["iva_trece"]);

              // echo '<pre>'; print_r($ResultTipoC); echo '</pre>';

            // $buttons = "<div class='btn-group'><button class='btn btn-info btnFacGasto' idFactura='".$response[$i]["idtbl_sistema_facturacion_Factura_gastos"]."'> <i class='fas fa-info-circle'></i></div>";
            
            $JsonData .= '[
                "'.($i+1).'",                                                        
                "'.$response[$i]["tipo"].'",
                "'.$response[$i]["exentasSERVICIOS"].'",
                "'.$response[$i]["subtotalSERVICIOS"].'",
                "'.$response[$i]["ivaSERVICIOS"].'",
                "'.$response[$i]["totalSERVICIOS"].'",
                "'.$response[$i]["exentasBIENES"].'",
                "'.$response[$i]["subtotalBIENES"].'",                      
                "'.$response[$i]["ivaBIENES"].'",
                "'.$response[$i]["totalBIENES"].'",                       
                "'.$response[$i]["exentasNOSUJETAS"].'",                       
                "'.$response[$i]["subtotalNOSUJETAS"].'",                       
                "'.$response[$i]["ivaNOSUJETAS"].'",                       
                "'.$response[$i]["totalNOSUJETAS"].'"
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


if(isset($_GET["fechas1"])){

    $edit = new TableReporteIva();
  
    $edit -> fechas1 = $_GET["fechas1"];
  
    $edit -> showTableReporteIva();
  
}

if(isset($_GET["fechas2"])){

    $edit = new TableReporteIva();
  
    $edit -> fechas2 = $_GET["fechas2"];
  
    $edit -> showTableReporteGastos();
  
}

if(isset($_GET["fechas3"])){

    $edit = new TableReporteIva();
  
    $edit -> fechas3 = $_GET["fechas3"];
  
    $edit -> showTableReporteRiva();
  
}

if(isset($_GET["fechas4"])){

    $edit = new TableReporteIva();
  
    $edit -> fechas3 = $_GET["fechas4"];
  
    $edit -> showTableReporteRgastos();
  
}