<?php

require_once "../controllers/subcategoria-servicios.controller.php";
require_once "../models/subcategoria-servicios.model.php";


class TableSubCategoriaServicios{

  /*=============================================
=      SHOW PRODUCTS TABLE      =
=============================================*/


  

  public function showTableSubCategoriaServicios(){


              
             $response = SubCategoriaserviciosController::ctrCargarSubCategoriaServicios();

      
           $JsonData = '{
               "data": [';

               session_start();

                for($i =0; $i < count($response); $i++){

                      if($response[$i]["activo"] =="Si" ){

                      if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" ){

                         $buttons2 = "<td><button class='btn btn-success btn-xs btnActivatarCategoriaSubServicios' userId='".$response[$i]["idtbl_sub_categoria_servicios"]."' userStatus='No'>Activado</button></td>";


                      }else{

                          $buttons2 = "<td><button class='btn btn-success btn-xs btnActivatarCategoriaSubServicios' userId='".$response[$i]["idtbl_sub_categoria_servicios"]."' userStatus='No' >Activado</button></td>";


                      }              

               

    

      
         


                 } else{

                         if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" ){

                           $buttons2 = "<td><button class='btn btn-danger btn-xs btnActivatarCategoriaSubServicios' userId='".$response[$i]["idtbl_sub_categoria_servicios"]."' userStatus='Si'>Desactivado</button></td>";

                      }else{

                         $buttons2 = "<td><button class='btn btn-danger btn-xs btnActivatarCategoriaSubServicios' userId='".$response[$i]["idtbl_sub_categoria_servicios"]."' userStatus='Si' >Desactivado</button></td>";

                      }              


                 

              

                 }





 $buttons = "<div class='btn-group'><button class='btn btn-info btnEditSubCategoriaServicio' SubCategoriaServicioId='".$response[$i]["idtbl_sub_categoria_servicios"]."' data-toggle='modal' data-target='#modalEditarCategoriaServicio'> <i class='fas fa-info-circle'></i></div>";



    $JsonData .= '[
                   "'.($i+1).'",                  
                   "'.$buttons.'",
                   "'.$buttons2.'",
                   "'.$response[$i]["categoria"].'",
                   "'.$response[$i]["codigo"].'",
                   "'.$response[$i]["nombre"].'",
                   "'.$response[$i]["palabra_clave"].'"

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



/* echo json_encode($response);*/



  }

}

/*=============================================
=      ACTIVATE PRODUCTS TABLE      =
=============================================*/

/*$activateOrders = new TableOrders();
$activateOrders -> showTableOrders();*/

if(isset($_GET["Rol"])){

  $edit = new TableSubCategoriaServicios();

  $edit -> Rol = $_GET["Rol"];

  $edit -> showTableSubCategoriaServicios();

}