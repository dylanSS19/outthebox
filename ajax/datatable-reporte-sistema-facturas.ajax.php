<?php

require_once "../controllers/reporte-sistema-facturacion.controller.php";
require_once "../models/reporte-sistema-facturacion.model.php";


class TableReporteFacturas{




        public $IdFactura;

  public function showTableReporteDetalleFacturas(){

session_start();
   $factura = $this->IDfactura;

    $response = ReporteFacturasController::ctrDetalleFactura($factura);
      
           $JsonData = '{
               "data": [';
    

                for($i =0; $i < count($response); $i++){

        
      
    $JsonData .= '[
                   "'.($i+1).'",      
                   "'.$response[$i]["nombre"].'",
                   "'.$response[$i]["codigo"].'",
                   "'.$response[$i]["cantidad"].'",   
                    "'.number_format( (float) $response[$i]["precio_unidad"], 2, '.', ',').'",
                   "'.number_format( (float) $response[$i]["cantidad"] * $response[$i]["precio_unidad"], 2, '.', ',').'",                
                   "'.number_format( (float) $response[$i]["descuento"], 2, '.', ',').'",                   
                   "'.number_format( (float) $response[$i]["impuesto"], 2, '.', ',').'",
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



/* echo json_encode($response);
*/


  }

  /*=============================================
=      SHOW PRODUCTS TABLE      =
=============================================*/
  
 
    public $filtros;

  public function showTableReporteFacturas(){

session_start();
$filtros = $this->Filtros;

$filtros = json_decode($filtros, true);

foreach($filtros as $value){

$fechaDesde = $value["FechaInicio"];
$FechaHasta = $value["FechaFin"];
$clave = "";
$consecutivo = $value["consecutivo"];
$cedula = $value["cedula"];
$estado = $value["estado"];
$tipodoc = $value["tipoDoc"];
}

$id_empresa = $_SESSION['empresa'];
              
    $response = ReporteFacturasController::ctrCargarFacturas($id_empresa, $fechaDesde, $FechaHasta, $consecutivo, $clave, $cedula, $estado, $tipodoc);
  
      
           $JsonData = '{
               "data": [';
    

                for($i =0; $i < count($response); $i++){


                 if($response[$i]["codigo_moneda"] == "CRC"){

                  $simboloMoneda = "₡";

                 }else{

                  $simboloMoneda = "$";

                 }

if($response[$i]["estado_factura"] == "Rechazado"){


  $buttons2 = "<a href='#' class='' title='Documento Rechazado' style='display:inline; color: red;'><i class='fa fa-times-circle text-infomargin-left-5 add-tooltip' aria-hidden='true' data-original-title='Enviado Entidad Tributaria'data-html='true'></i></a>&nbsp";

}else if($response[$i]["estado_factura"] == "enviado" || $response[$i]["estado_factura"] == "Por Enviar"){


  $buttons2 = "<a href='#' class='' title='Enviando Documento' style='display:inline; color: blue;'><i class='fa fa-check-circle text-infomargin-left-5 add-tooltip' aria-hidden='true' data-original-title='Enviado Entidad Tributaria'data-html='true'></i></a>&nbsp";

}else{

  $buttons2 = "<a href='#' class='' title='Documento Aceptado' style='display:inline; color: green;'><i class='fa fa-check-circle text-infomargin-left-5 add-tooltip' aria-hidden='true' data-original-title='Enviado Entidad Tributaria'data-html='true'></i></a>&nbsp";

}


if($response[$i]["estado_anulacion"] == "Total"){

  $buttons4 = "<a href='#' class='' title='Documento Anulado' style='display:inline; color: red;'><i class='fas fa-ban text-infomargin-left-5 add-tooltip' aria-hidden='true' data-original-title='Enviado Entidad Tributaria' data-html='true'></i></a>&nbsp";

}else{


$buttons4 = "";

}




if($response[$i]["estado_correo"] == "COREEO OK"){

  $buttons5 = "<a href='#' class='' title='Distribuido' style='display:inline; color: green;'><i class='far fa-envelope-open text-infomargin-left-5 add-tooltip' aria-hidden='true' data-original-title='Enviado Entidad Tributaria' data-html='true'></i></a>";


}else{


  $buttons5 = "<a href='#' class='' title='No Distribuido' style='display:inline; color: red;'><i class='far fa-envelope text-infomargin-left-5 add-tooltip' aria-hidden='true' data-original-title='Enviado Entidad Tributaria' data-html='true'></i></a>";

}


 $buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnFactura' title='Detalle Documento' idFactura='".$response[$i]["idtbl_sistema_facturacion_facturas"]."' claveF='".$response[$i]["clave"]."' comp='".$response[$i]["id_compania"]."'> <i class='fas fa-info-circle'></i></div>";
  // $buttons2 = "<div class='btn-group'><button class='btn btn-outline-danger'><i class='fas fa-ban' aria-hidden='true' data-original-title='Enviado Entidad Tributaria'></i></div>&nbsp";


 // $buttons3 = "<div class='btn-group'><button class='btn btn-secondary btnImprimir' idFactura='".$response[$i]["clave"]."' comp='".$response[$i]["id_compania"]."'> <i class='fa fa-print'></i></div>";
 
// $buttons3 = "<div class='dropdown'><button class='btn btn-success btn-xs dropdown-toggle' type='button' data-toggle='dropdown'>Acciones<span class='caret'></span></button><ul class='dropdown-menu'><li><a href='' target='_blank'>Comprobante</a></li><li class='divider'></li><li><a >Ver +</a></li><li><a>Editar</a></li><li><a>Borrar</a></li></ul></div>";

$buttons3 = "<div class='btn-group'> <button type='button' class='btn btn-outline-secondary'><i class='fa fa-print'></i></button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'> <span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item btnImprimir' idFactura='".$response[$i]["clave"]."' comp='".$response[$i]["id_compania"]."'>Ver PDF</a><a class='dropdown-item descargar' idF='".$response[$i]["clave"]."' Clv='".$response[$i]["id_compania"]."'>Descargar Documentos</a></div></div>";




if($response[$i]["tipo_documento"] == "01"){

$tipoDoc = "Factura Electronica";

}else if($response[$i]["tipo_documento"] == "02"){

$tipoDoc = "Nota Debito Electronica";

}else if($response[$i]["tipo_documento"] == "03"){

$tipoDoc = "Nota Crédito Electronica";

}else if($response[$i]["tipo_documento"] == "04"){

$tipoDoc = "Tiquete Electronico";

}else if($response[$i]["tipo_documento"] == "08"){

$tipoDoc = "Factura Electronica Compras";

}

$total = 0;



if($response[$i]["tipo_documento"] == "03"){

  $total = $response[$i]["total"] * -1;

}else{

  $total = $response[$i]["total"] ;

}



    $JsonData .= '[
                   "'.($i+1).'",           
                   "'.$buttons2.''.$buttons4.''.$buttons5.'",  
                   "'.$buttons.'",
                   "'.date("d-m-Y", strtotime($response[$i]["fecha_factura"])).'",
                   "'.$response[$i]["consecutivo"].'",
                   "'.$tipoDoc.'",    
                   "'.$response[$i]["nombre_cliente"].'",
                   "'.$response[$i]["codigo_moneda"].'",                   
                   "'.$total.'"

                   ],';

    // $JsonData .= '[
    //                "'.($i+1).'",                  
    //                "'.$buttons.'",      
    //                "'.$response[$i]["nombre_cliente"].'",
    //                "'.$response[$i]["cedula_cliente"].'",
    //                "'.date("Y-m-d", strtotime($response[$i]["fecha_factura"])).'",
    //                "'.$response[$i]["consecutivo"].'",
    //                "'.$response[$i]["clave"].'",
    //                "'.$buttons2.''.$buttons4.'",
    //                "'.$simboloMoneda.' '.number_format( (float) $response[$i]["subtotal"], 2, '.', ',' ).'",
    //                "'.$simboloMoneda.' '.number_format( (float) $response[$i]["impuesto"], 2, '.', ',' ) .'",
    //                "'.$simboloMoneda.' '.number_format( (float) $response[$i]["total"], 2, '.', ',').'"


    //                ],';


                }


                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($response) == 0) {
   $JsonData = '{
               "data": [] }';

             };


    echo $JsonData;



/* echo json_encode($response);*/



  }




}

/*=============================================
=      ACTIVATE PRODUCTS TABLE      =
=============================================*/

/*$activateOrders = new TableOrders();
$activateOrders -> showTableOrders();*/

if(isset($_GET["Filtros"])){

  $edit = new TableReporteFacturas();

  $edit -> Filtros = $_GET["Filtros"];

  $edit -> showTableReporteFacturas();

}


if(isset($_GET["IDfactura"])){

  $edit = new TableReporteFacturas();

  $edit -> IDfactura = $_GET["IDfactura"];

  $edit -> showTableReporteDetalleFacturas();

}