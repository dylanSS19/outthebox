<?php
 
require_once "../controllers/sistema-facturas-facturacion.controller.php";
require_once "../models/sistema-facturas-facturacion.model.php";
 

class TableProductosClientes{


public $ID_empresa;
public $idCliente;
    public function showTableProductosClientes(){
      $ID_empresa = $this->ID_empresa;
      $idCliente = $this->idCliente;

// session_start();


// $ID_empresa = $_SESSION['empresa'];
// $ID_empresa = $_COOKIE["cookie_empresa"];

$response = FacturacionController::ctrCargarProductos($ID_empresa,$idCliente);

//echo json_encode($response);

 $JsonData = '{
               "data": [';


for($i =0; $i < count($response); $i++){



$buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnProducto' title='Agregar Producto' idprod='".$response[$i]['idtbl_equipos']."' idCliente='".$idCliente."' data-container='body' data-toggle='popover' data-trigger='hover' data-placement='top' data-content='Agregar un producto'><i class='fa fa-shopping-cart'></i></button></div>";

    $JsonData .= '[
                             
                                
                   "'.$response[$i]['nombre'].'",
                   "'.$response[$i]['sku'].'",    
                   "'.number_format( (float) $response[$i]["precio_unidad"], 2, '.', ',').'",
                   "'.$buttons.'"
                   ],';
                   
}


                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($response) == 0) {
   $JsonData = '{
               "data": [] }';

             };


// echo '<pre>'; print_r( $response); echo '</pre>';
echo $JsonData;



	  }


}


/*=============================================
  =            CONSULTAR API CABYS               =
  =============================================*/
if(isset($_GET["dato"])){

  $edit = new TableProductosClientes();

  $edit -> ID_empresa = $_GET["dato"];
  $edit -> idCliente = $_GET["idCliente"];

  $edit -> showTableProductosClientes();

}