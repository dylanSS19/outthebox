<?php

require_once "../controllers/clientes.controller.php";
require_once "../models/clientes.model.php";


class TableClientes{

  /*=============================================
=      SHOW PRODUCTS TABLE      =
=============================================*/
public $idEmpresa; 

  public function showTableClientes(){

    $idEmpresa = $this->idEmpresa;

              $response = ClientesController::ctrCargarClientes($idEmpresa);
                  
             $JsonData = '{
               "data": [';

               session_start();

                for($i =0; $i < count($response); $i++){

                      if($response[$i]["activo"] =="Si" ){

                      if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" ){

                         $buttons2 = "<td><button class='btn btn-outline-success btn-xs btnActivatarClientes' userId='".$response[$i]["idtbl_clientes"]."' userStatus='No'>Activado</button></td>";


                      }else{

                          $buttons2 = "<td><button class='btn btn-outline-success btn-xs btnActivatarClientes' userId='".$response[$i]["idtbl_clientes"]."' userStatus='No' >Activado</button></td>";


                      }              
         

                 } else{

                         if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" ){

                           $buttons2 = "<td><button class='btn btn-outline-danger btn-xs btnActivatarClientes' userId='".$response[$i]["idtbl_clientes"]."' userStatus='Si'>Desactivado</button></td>";

                      }else{

                         $buttons2 = "<td><button class='btn btn-outline-danger btn-xs btnActivatarClientes' userId='".$response[$i]["idtbl_clientes"]."' userStatus='Si' >Desactivado</button></td>";

                      }              


                 

              

                 }





 $buttons = "<div class='btn-group'><button class='btn btn-outline-info btnEditClient' ClientId='".$response[$i]["idtbl_clientes"]."' data-toggle='modal' data-target='#modalEditarCliente'> <i class='fas fa-info-circle'></i></div>";



    $JsonData .= '[
                   "'.($i+1).'",                  
                   "'.$buttons.'",
                   "'.$buttons2.'",
                     "'.$response[$i]["cedula"].'",
                   "'.$response[$i]["nombre"].'",
                    "'.$response[$i]["email"].'"
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



   /* echo  json_encode($response);*/



  }

}

/*=============================================
=      ACTIVATE PRODUCTS TABLE      =
=============================================*/

/*$activateOrders = new TableOrders();
$activateOrders -> showTableOrders();*/

if(isset($_GET["idEmpresa"])){

  $edit = new TableClientes();

  $edit -> idEmpresa = $_GET["idEmpresa"];

  $edit -> showTableClientes();

}