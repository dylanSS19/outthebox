<?php

require_once "../controllers/sucursal-cajas-facturacion.controller.php";
require_once "../models/sucursal-cajas-facturacion.model.php";

class ajaxSucursalesCajas{

 
/*=============================================
	 =    CARGAR SALDO BODEGAS             =
=============================================*/
  
  public $varjson;
  
  public function ajaxCargarSaldo(){


    $value = $this->varjson;

    $response = SucursalesCajasController::crEnviarDatos($value);

    echo json_encode($response);

   
  }

  public $id_factura;
  public $ultimo_consecutivo;
  public $sucursal;
  public $caja;
  public $tipo;
  public $id_empresa;
  public $tabla;

  public function ajaxInsertarUltimoConse(){


    $id_factura = $this->id_factura;
    $ultimo_consecutivo = $this->ultimo_consecutivo;
    $sucursal = $this->sucursal;
    $caja = $this->caja;
    $tipo = $this->tipo;
    $id_empresa = $this->id_empresa;
    $tabla = $this->tabla;

    $response = SucursalesCajasController::ctrInsertarUltimoConse($id_factura, $ultimo_consecutivo, $sucursal, $caja, $tipo, $id_empresa, $tabla);

    echo $response;

  }


  public $SearchTabla;
  public $Searchtipo;
  public $SearchSucursal;
  public $SearchCaja;
  public $Searchempresa;
 
  public function ajaxCargarUltimoConse(){

    $SearchTabla = $this->SearchTabla;
    $Searchtipo = $this->Searchtipo;
    $SearchSucursal = $this->SearchSucursal;
    $SearchCaja = $this->SearchCaja;
    $Searchempresa = $this->Searchempresa;


    $response = SucursalesCajasController::ctrCargarUltimoConse($SearchTabla, $Searchtipo, $SearchSucursal, $SearchCaja, $Searchempresa);

    echo json_encode($response);

  }

}


 /*=============================================
  =     CARGAR BODEGAS POR CLIENTE             =
  =============================================*/
if(isset($_POST["jsonPrueba"])){

  $edit = new ajaxSucursalesCajas();

  $edit -> varjson = $_POST["jsonPrueba"];

  $edit -> ajaxCargarSaldo();

}

if(isset($_POST["ultimo_consecutivo"])){

  $edit = new ajaxSucursalesCajas();

  $edit -> id_factura = $_POST["id_factura"];
  $edit -> ultimo_consecutivo = $_POST["ultimo_consecutivo"];
  $edit -> sucursal = $_POST["sucursal"];
  $edit -> caja = $_POST["caja"];
  $edit -> tipo = $_POST["tipo"];
  $edit -> id_empresa = $_POST["id_empresa"];
  $edit -> tabla = $_POST["tabla"];


  $edit -> ajaxInsertarUltimoConse();

}

if(isset($_POST["SearchTabla"])){

  $edit = new ajaxSucursalesCajas();

  $edit -> SearchTabla = $_POST["SearchTabla"];
  $edit -> Searchtipo = $_POST["Searchtipo"];
  $edit -> SearchSucursal = $_POST["SearchSucursal"];
  $edit -> SearchCaja = $_POST["SearchCaja"];
  $edit -> Searchempresa = $_POST["Searchempresa"];

  $edit -> ajaxCargarUltimoConse();

}
