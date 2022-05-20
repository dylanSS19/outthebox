<?php

require_once "../controllers/clientes.controller.php";
require_once "../models/clientes.model.php";

class ajaxClientes{
 
	    /*=============================================
  =                  EDITAR CLIENTES                 =
  =============================================*/
  
  public $ClientId;
  
  public function ajaxClientesEditar(){

    $item = "idtbl_clientes";

    $value = $this->ClientId;

    $response = ClientesController::ctrCargarClientesEditar($item, $value);

    echo json_encode($response);

    

  }

	    /*=============================================
  =                  ACTIVAR USUARIOS                 =
  =============================================*/



  public $userIdActivate;
  public $userStatus;

  public function ajaxActivateUser(){

    $table = "empresas.view_clientes";

    $item1 = "activo";

    $value1 = $this->userStatus;

    $item2 = "idtbl_clientes";

    $value2 = $this->userIdActivate;

    $response = ClientesModel::MdlActivateUser($table, $item1, $value1, $item2, $value2);

 echo json_encode($response);
    
  }


  /*=============================================
  =       LOAD CANTONES FOR PROVINCIAS                =
  =============================================*/
public $varProvincia;

  public function ajaxCantones(){

    $item = "idprovincia"; //campo en la tabla al que se va ir a buscar 

    $value = $this->varProvincia;

    $response = ClientesController::ctrBUSCAR_CANTONES($item, $value);

    echo json_encode($response);


  }  


  /*=============================================
  =       LOAD DISTRITOS FOR CANTONES                =
  =============================================*/
public $varCantones;
public $varProv;
  public function ajaxdistritos(){

    $item = "canton"; //campo en la tabla al que se va ir a buscar 

    $value = $this->varCantones;
    $value2 = $this->varProv;
    $response = ClientesController::ctrBUSCAR_Distritos($item, $value, $value2);

    echo json_encode($response);


  }

    /*=============================================
  =                  VALIDAR CEDULA                =
  =============================================*/

  public $cedula;

  public function ajaxValidarCedula(){

    $item = "cedula";

    $value = $this->cedula;

    $response = ClientesController::ctrCargarCedulas($item, $value);

    echo json_encode($response);

  }





}

 /*=============================================
  =                  EDIT CLIENTS OBJECT                =
  =============================================*/
if(isset($_POST["ClientId"])){

  $edit = new ajaxClientes();

  $edit -> ClientId = $_POST["ClientId"];

  $edit -> ajaxClientesEditar();

}


  /*=============================================
  =       ACTIVATE USER OBJECT                =
  =============================================*/
if(isset($_POST["userStatus"])){

    $userStatus = new ajaxClientes();

    $userStatus -> userIdActivate = $_POST["userId"];

    $userStatus -> userStatus = $_POST["userStatus"];

    $userStatus -> ajaxActivateUser();

}



  /*=============================================
  =       VALIDAR CEDULA OBJECT                =
  =============================================*/

  if(isset($_POST["cedula"])){

    $valCode = new ajaxClientes();

    $valCode -> cedula = $_POST["cedula"];

    $valCode -> ajaxValidarCedula();
  }

  /*=============================================
  =       LOAD CANTONES OBJECT                =
  =============================================*/

  if(isset($_POST["varProvincia"])){

    $valprovincia= new ajaxClientes();

    $valprovincia -> varProvincia = $_POST["varProvincia"];

    $valprovincia -> ajaxCantones();
  }


  /*=============================================
  =       LOAD DISTRITOS OBJECT                =
  =============================================*/

    if(isset($_POST["varCantones"])){

    $valcantones= new ajaxClientes();

    $valcantones -> varCantones = $_POST["varCantones"];
    $valcantones -> varProv = $_POST["var_provincia"];
    $valcantones -> ajaxdistritos();
  }

