<?php
 
require_once "../controllers/planes-categoria.controller.php";
require_once "../models/planes-categoria.model.php";


class TablePlanesCategoria{


  public function showTablePlanesCategoria(){

    $response = PlanesCategoriasController::ctrCargarCategorias();

 $JsonData = '{
    "data": [';




 for($i =0; $i < count($response); $i++){



 $buttons = "<div class='btn-group'><button class='btn btn-outline-info btnEditpaquete' paquete='".$response[$i]["idtbl_categoria_planes"]."' data-toggle='modal' data-target='#'> <i class='fas fa-info-circle'></i></div>";

if($response[$i]["estado"] == "Activo"){

  $buttons2 = "<div class='btn-group ml-1'><button class='btn btn-outline-success btnEstadoPaquete' title='Desactivar Paquete' paquete='".$response[$i]["idtbl_categoria_planes"]."' estado='".$response[$i]["estado"]."'> <i class='far fa-check-circle'></i></div>";

}else{

  $buttons2 = "<div class='btn-group ml-1'><button class='btn btn-outline-danger btnEstadoPaquete' title='Activar Paquete' paquete='".$response[$i]["idtbl_categoria_planes"]."' estado='".$response[$i]["estado"]."' disabled> <i class='far fa-window-close'></i></div>";

}




$modulos = str_replace ( '"' , '' ,$response[$i]["modulos"]);
// $modulos = str_replace ( '"]' , '' ,$response[$i]["modulos"]);

// echo '<pre>'; print_r($modulos); echo '</pre>';



 $JsonData .= '[
                   "'.($i+1).'",                  
                   "'.$buttons.''.$buttons2.'",                 
                    "'.$response[$i]["nombre"].'",
                    "'.$modulos.'",
                    "'.number_format( (float) $response[$i]["precio"], 2, '.', ',' ).'"
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

  public $Descripcion;
  public function showTableCabys(){

    $Descripcion = $this->Descripcion;
      
        $response = PlanesCategoriasController::ctrCargarCabys($Descripcion);
    
    $descripcion = json_decode($response);


    $JsonData = '{
                  "data": [';


    for($i =0; $i < count($descripcion->cabys); $i++){



    $buttons = "<div class='btn-group'><button class='btn btn-outline-primary frmPlanesNunCabys' title='Agregar Cabys' desc='".str_replace ( '"' , '' , $descripcion->cabys[$i]->{'descripcion'})."' cod='".$descripcion->cabys[$i]->{'codigo'}."'><i class='fas fa-info-circle'></i></button></div>";




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




if(isset($_GET["val"])){

  $edit = new TablePlanesCategoria();

  $edit -> Rol = $_GET["val"];

  $edit -> showTablePlanesCategoria();

}


if(isset($_GET["cabysSearch"])){

  $edit = new TablePlanesCategoria();

  $edit -> Descripcion = $_GET["cabysSearch"];

  $edit -> showTableCabys();

}