<?php
 
require_once "../controllers/sistema-facturas-crearFatura.controller.php";
require_once "../models/sistema-facturas-crearFatura.model.php";
 

class TableCrearFactura{


public $ID_empresa;
public $listPrecio;
public $listTope;
    public function showTableCrearFactura(){

      $ID_empresa = $this->ID_empresa;
      $listPrecio = $this->listPrecio;
      $listTope = $this->listTope;

$response = CrearFactController::ctrCargarPrecioProductos($ID_empresa, $listPrecio, $listTope);



 $JsonData = '{
               "data": [';


for($i =0; $i < count($response); $i++){



$buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnProdCrear' title='Agregar Producto' idprod='".$response[$i]['idtbl_equipos']."'><i class='fa fa-shopping-cart'></i></button></div>";

    $JsonData .= '[
                             
                                
                   "'.$response[$i]['nombre'].'",
                   "'.$response[$i]['sku'].'",    
                   "₡ '.number_format( (float) $response[$i]["precio_unidad"], 2, '.', ',').'",
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



if(isset($_GET["dato"])){

  $edit = new TableCrearFactura();

  $edit -> ID_empresa = $_GET["dato"];
  $edit -> listPrecio = $_GET["listPrecio"];
  $edit -> listTope = $_GET["listTope"];

  $edit -> showTableCrearFactura();

}