<?php

require_once "../controllers/sistema-facturas-productos.controller.php";
require_once "../models/sistema-facturas-productos.model.php";


class TableCabys{


	public $CabysSearch;

    public function showTableCabys(){

		$buscarSearch = $this->CabysSearch;

$PRODUCTOS = ProductosController::ctrCargarCabys($buscarSearch);

$descripcion = json_decode($PRODUCTOS);


 $JsonData = '{
               "data": [';


for($i =0; $i < count($descripcion->cabys); $i++){



$buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnAddNunCabys' title='Detalle Documento' desc='".str_replace ( '"' , '' , $descripcion->cabys[$i]->{'descripcion'})."' cod='".$descripcion->cabys[$i]->{'codigo'}."'><i class='fas fa-info-circle'></i></button></div>";




    $JsonData .= '[
                                  
                   "'.$buttons.'",              
                   "'.str_replace ( '"' , '' , $descripcion->cabys[$i]->{'descripcion'}).'",
                   "'.$descripcion->cabys[$i]->{'codigo'}.'",    
                   "'.$descripcion->cabys[$i]->{'impuesto'}.'"
                   ],';

}


                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($descripcion->cabys) == 0) {
   $JsonData = '{
               "data": [] }';

             };


echo $JsonData;



	  }


}


/*=============================================
  =            CONSULTAR API CABYS               =
  =============================================*/
if(isset($_GET["cabysSearch"])){

  $edit = new TableCabys();

  $edit -> CabysSearch = $_GET["cabysSearch"];

  $edit -> showTableCabys();

}