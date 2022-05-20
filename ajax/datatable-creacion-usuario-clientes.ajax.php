<?php

require_once "../controllers/creacion-usuarios-clientes.controller.php";
require_once "../models/creacion-usuarios-clientes.model.php";

class ajaxCreacionUsuarioClientes{

/*=============================================
=      CARGAR TABLA USUARIOS      =
=============================================*/
 

  public function showTableUsuario(){

session_start();

$IDempresa = $_SESSION['empresa'];

 $response = UsuariosClienteController::ctrCargarUsuarioClientes($IDempresa);

//  echo '<pre>'; print_r($response); echo '</pre>';


 $JsonData = '{
               "data": [';

               

                for($i =0; $i < count($response); $i++){
if($response[$i]["status"] == "Disponible"){

 $buttons = "<div class='btn-group'><button class='btn btn-outline-success EstadoUsuario' estado_usuario='".$response[$i]["status"]."' id_tblusuario='".$response[$i]["idtbluser_2"]."' IDUsuarioCliente='".$response[$i]["nombre"]."' data-toggle='modal' data-target='#'> <i class='f'></i>Activo</div>";

}else{

 $buttons = "<div class='btn-group'><button class='btn btn-outline-danger EstadoUsuario'  estado_usuario='".$response[$i]["status"]."' id_tblusuario='".$response[$i]["idtbluser_2"]."' IDUsuarioCliente='".$response[$i]["nombre"]."' data-toggle='modal' data-target='#'> <i class='f'></i>Desactivo</div>";

}

$buttons2 = "<div class='btn-group '><button class='btn btn-outline-warning mr-2 modPrivilegios'   id_usuario='".$response[$i]["idtbluser_2"]."'  data-toggle='modal' data-target='#'> <i class='fas fa-user-edit'></i></div>";




    $JsonData .= '[
                   "'.($i+1).'",                  
                   "'.$buttons2.''.$buttons.'",      
                    "'.$response[$i]["nombre"].'"          
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



if(isset($_GET["Rol"])){

  $edit = new ajaxCreacionUsuarioClientes();

  $edit -> Rol = $_GET["Rol"];

  $edit -> showTableUsuario();

}