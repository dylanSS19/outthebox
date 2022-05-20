<?php

require_once "../controllers/subcategoria-servicios.controller.php";
require_once "../models/subcategoria-servicios.model.php";

class ajaxSubCategoriaServicios{

	    /*=============================================
  =                  EDITAR CLIENTES                 =
  =============================================*/ 
  
  public $SubCategoriaServicioId;
  
  public function ajaxSubCategoriaServicioEditar(){

    $item = "idtbl_sub_categoria_servicios";

    $value = $this->SubCategoriaServicioId;

    $response = SubCategoriaserviciosController::ctrCargarSubCategoriaClientesEditar($item, $value);

    echo json_encode($response);

    

  }

	    /*=============================================
  =                  ACTIVAR CATEGORIA SERVICIOS                 =
  =============================================*/



  public $userIdActivate;
  public $userStatus;

  public function ajaxActivateUser(){

    $table = "`upee-cr`.tbl_sub_categoria_servicios";

    $item1 = "activo";

    $value1 = $this->userStatus;

    $item2 = "idtbl_sub_categoria_servicios";

    $value2 = $this->userIdActivate;

    $response = SubCategoriaserviciosModel::MdlActivateUser($table, $item1, $value1, $item2, $value2);

 echo json_encode($response);
    
  }



    /*=============================================
  =                  VALIDAR CATEGORIA SERVICIO                =
  =============================================*/

  public $varcategoriaservicio;

  public function ajaxValidarSubCategoriaServicio(){

    $item = "nombre";

    $value = $this->varcategoriaservicio;

    $response = SubCategoriaserviciosController::ctrCargarSubCategorias($item, $value);

    echo json_encode($response);

  }





}

 /*=============================================
  =                  EDIT CLIENTS OBJECT                =
  =============================================*/
if(isset($_POST["SubCategoriaServicioId"])){

  $edit = new ajaxSubCategoriaServicios();

  $edit -> SubCategoriaServicioId = $_POST["SubCategoriaServicioId"];

  $edit -> ajaxSubCategoriaServicioEditar();

}


  /*=============================================
  =       ACTIVATE USER OBJECT                =
  =============================================*/
if(isset($_POST["userStatus"])){

    $userStatus = new ajaxSubCategoriaServicios();

    $userStatus -> userIdActivate = $_POST["userId"];

    $userStatus -> userStatus = $_POST["userStatus"];

    $userStatus -> ajaxActivateUser();

}



  /*=============================================
  =       VALIDAR CEDULA OBJECT                =
  =============================================*/

  if(isset($_POST["varcategoriaservicio"])){

    $valCode = new ajaxSubCategoriaServicios();

    $valCode -> varcategoriaservicio = $_POST["varcategoriaservicio"];

    $valCode -> ajaxValidarSubCategoriaServicio();
  }



