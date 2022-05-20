<?php
 
require_once "../controllers/sistema-facturas-facturacion.controller.php";
require_once "../models/sistema-facturas-facturacion.model.php";
 

class TableEventos{

    public function showTableEventos(){

session_start();


$id_usuario = $_SESSION["id"];

$response = CalendarioEventosController::ctrCargarEventos($id_usuario);


//  $JsonData = '{
//                "data": [';


// for($i =0; $i < count($response); $i++){



// $buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnProducto' title='Modificar Producto' idprod='".$response[$i]['idtbl_equipos']."'><i class='fa fa-shopping-cart'></i></button></div>";

//     $JsonData .= '[
                             
                                
//                    "'.$response[$i]['nombre'].'",
//                    "'.$response[$i]['sku'].'",    
//                    "₡ '.number_format( (float) $response[$i]["precio_unidad"], 2, '.', ',').'",
//                    "'.$buttons.'"
//                    ],';
                   
// }


//                 $JsonData = substr($JsonData, 0, -1);

//      $JsonData .=   '] 

//      }';

//         if(count($response) == 0) {
//    $JsonData = '{
//                "data": [] }';

//              };


echo '<pre>'; print_r( $response); echo '</pre>';
// echo $JsonData;



	  }


}


/*=============================================
  =            CONSULTAR API CABYS               =
  =============================================*/
if(isset($_GET["dato"])){

  $edit = new TableProductosClientes();

  $edit -> CabysSearch = $_GET["dato"];

  $edit -> showTableProductosClientes();

}