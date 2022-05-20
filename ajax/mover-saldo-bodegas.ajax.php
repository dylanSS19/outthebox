<?php

require_once "../controllers/mover-saldo-bodegas.controller.php";
require_once "../models/mover-saldo-bodegas.model.php";

class ajaxMoverSaldoBodegas{


/*=============================================
	 =    CARGAR SALDO BODEGAS             =
=============================================*/
  
  public $var_bodega_inicial;
  
  public function ajaxCargarSaldo(){


    $value = $this->var_bodega_inicial;

    $response = MoverSaldoController::ctrCargarSalarioBodega($value);

    echo json_encode($response);

   
  }


/*=============================================
	 =    CARGAR SALDO BODEGAS             =
=============================================*/
  
  public $var_bodegas;
  
  public function ajaxCargarBodegasxcliente(){


    $value = $this->var_bodegas;

    $response = MoverSaldoController::ctrCargarBodegasxcliente($value);

    echo json_encode($response);

   
  }





}



 /*=============================================
  =            CARGAR SALDO BODEGAS            =
  =============================================*/
if(isset($_POST["var_bodega_inicial"])){

  $edit = new ajaxMoverSaldoBodegas();

  $edit -> var_bodega_inicial = $_POST["var_bodega_inicial"];

  $edit -> ajaxCargarSaldo();

}



 /*=============================================
  =     CARGAR BODEGAS POR CLIENTE             =
  =============================================*/
if(isset($_POST["var_bodegas"])){

  $edit = new ajaxMoverSaldoBodegas();

  $edit -> var_bodegas = $_POST["var_bodegas"];

  $edit -> ajaxCargarBodegasxcliente();

}