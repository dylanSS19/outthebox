<?php

require_once "../controllers/categoria-servicios.controller.php";
require_once "../models/categoria-servicios.model.php";

class ajaxCategoriaServicios{

	    /*=============================================
  =                  EDITAR CLIENTES                 =
  =============================================*/
  
  public $CategoriaServicioId;
  
  public function ajaxCategoriaServicioEditar(){

    $item = "idtbl_tipo_servicios";

    $value = $this->CategoriaServicioId;

    $response = CategoriaserviciosController::ctrCargarCategoriaClientesEditar($item, $value);

    echo json_encode($response);

    

  }

	    /*=============================================
  =                  ACTIVAR CATEGORIA SERVICIOS                 =
  =============================================*/



  public $userIdActivate;
  public $userStatus;

  public function ajaxActivateUser(){

    $table = "`upee-cr`.tbl_tipo_servicios";

    $item1 = "activo";

    $value1 = $this->userStatus;

    $item2 = "idtbl_tipo_servicios";

    $value2 = $this->userIdActivate;

    $response = CategoriaserviciosModel::MdlActivateUser($table, $item1, $value1, $item2, $value2);

 echo json_encode($response);
    
  }



    /*=============================================
  =                  VALIDAR CATEGORIA SERVICIO                =
  =============================================*/

  public $varcategoriaservicio;

  public function ajaxValidarCategoriaServicio(){

    $item = "nombre";

    $value = $this->varcategoriaservicio;

    $response = CategoriaserviciosController::ctrCargarCategorias($item, $value);

    echo json_encode($response);

  }





}

 /*=============================================
  =                  EDIT CLIENTS OBJECT                =
  =============================================*/
if(isset($_POST["CategoriaServicioId"])){

  $edit = new ajaxCategoriaServicios();

  $edit -> CategoriaServicioId = $_POST["CategoriaServicioId"];

  $edit -> ajaxCategoriaServicioEditar();

}


  /*=============================================
  =       ACTIVATE USER OBJECT                =
  =============================================*/
if(isset($_POST["userStatus"])){

    $userStatus = new ajaxCategoriaServicios();

    $userStatus -> userIdActivate = $_POST["userId"];

    $userStatus -> userStatus = $_POST["userStatus"];

    $userStatus -> ajaxActivateUser();

}



  /*=============================================
  =       VALIDAR CEDULA OBJECT                =
  =============================================*/

  if(isset($_POST["varcategoriaservicio"])){

    $valCode = new ajaxCategoriaServicios();

    $valCode -> varcategoriaservicio = $_POST["varcategoriaservicio"];

    $valCode -> ajaxValidarCategoriaServicio();
  }

  /*=============================================
  =       LOAD CANTONES OBJECT                =
  =============================================*/

  if(isset($_POST["varProvincia"])){

    $valprovincia= new ajaxCategoriaServicios();

    $valprovincia -> varProvincia = $_POST["varProvincia"];

    $valprovincia -> ajaxCantones();
  }


  /*=============================================
  =       LOAD DISTRITOS OBJECT                =
  =============================================*/

    if(isset($_POST["varCantones"])){

    $valcantones= new ajaxCategoriaServicios();

    $valcantones -> varCantones = $_POST["varCantones"];

    $valcantones -> ajaxdistritos();
  }

