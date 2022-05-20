<?php  


require_once "../controllers/movimiento-saldos.controller.php";
require_once "../models/movimiento-saldos.model.php";

class Ajax_Movimeinto_saldos{ 

/*=============================================
  =    CARGAR NOMBRES CLIENTE           =
  =============================================*/

  public $varcedula;

  public function ajaxCaragar_bodegas(){

    $value = $this->varcedula;
  
  $response = Movimiento_saldosController::ctrCargarbodegas($value);

    echo json_encode($response);

  } 


}

  if(isset($_POST["var_cedula"])){

    $valbodegas= new Ajax_Movimeinto_saldos();

    $valbodegas -> varcedula = $_POST["var_cedula"];

    $valbodegas -> ajaxCaragar_bodegas();
  }