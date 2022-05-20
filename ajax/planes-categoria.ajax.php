<?php

require_once "../controllers/planes-categoria.controller.php";
require_once "../models/planes-categoria.model.php";

class ajaxPlanesCategoria{
   
	    /*=============================================
  =                  EDITAR CLIENTES                 =
  =============================================*/
  
  public $modulosPaquete;
  public $nombrePaquete;
  public $skuPaquete;
  public $cabysPaquete;
  public $planesPaquete;
  public $diasPaquete;
  public $precioPaquete;
  public $ivaPaquete;
  public $codTarifaPaquete;
  public $tarifaPaquete;
  public $moneda;
  public function ajaxAgregarCategoria(){


    $modulosPaquete = $this->modulosPaquete;
    $nombrePaquete = $this->nombrePaquete;
    $skuPaquete = $this->skuPaquete;
    $cabysPaquete = $this->cabysPaquete;
    $planesPaquete = $this->planesPaquete;
    $diasPaquete = $this->diasPaquete;
    $precioPaquete = $this->precioPaquete;
    $ivaPaquete = $this->ivaPaquete;
    $codTarifaPaquete = $this->codTarifaPaquete;
    $tarifaPaquete = $this->tarifaPaquete;
    $moneda = $this->moneda;
    $response = PlanesCategoriasController::ctrAgregarCategoria($modulosPaquete, $nombrePaquete, $skuPaquete, $cabysPaquete, $planesPaquete, $diasPaquete, $precioPaquete , $ivaPaquete, $codTarifaPaquete, $tarifaPaquete, $moneda);

    echo $response;

  }

  public $Valplan;
  public $Valpaquete;
  
  public function ajaxValidarPaquetes(){


    $planes = $this->Valplan;
    $categorias = $this->Valpaquete;


    $response = PlanesCategoriasController::ctrValidarPaquetes($planes, $categorias);

    echo json_encode($response);

  }

  public $loadCategoria;
  
  public function ajaxCargarCategoria(){

    $categorias = $this->loadCategoria;


    $response = PlanesCategoriasController::ctrCargarCategoriaEditar($categorias);

    echo json_encode($response);

  }


  public $editaridPaquete;
  public $editarNombre;
  public $editarSku;
  public $editarCabys;
  public $editarCantDocumentos;
  public $editarDias;
  public $editarPrecio;
  public $editarMoneda;

  public function ajaxModificarCategoria(){


    $editaridPaquete = $this->editaridPaquete;
    $editarNombre = $this->editarNombre;
    $editarSku = $this->editarSku;
    $editarCabys = $this->editarCabys;
    $editarCantDocumentos = $this->editarCantDocumentos;
    $editarDias = $this->editarDias;
    $editarPrecio = $this->editarPrecio;
    $editarMoneda = $this->editarMoneda;

    $response = PlanesCategoriasController::ctrModificarCategoria($editaridPaquete, $editarNombre, $editarSku, $editarCabys, $editarCantDocumentos, $editarDias, $editarPrecio, $editarMoneda);

    echo $response;

  }

  public $fecha;
  public $estado;
  public $IdPaq;

  public function ajaxModificarEstado(){

    $fecha = $this->fecha;
    $estado = $this->estado;
    $IdPaq = $this->IdPaq;

    $response = PlanesCategoriasController::ctrModificarEstado($fecha, $estado, $IdPaq);

    echo $response;

  }


}


if(isset($_POST["modulosPaquete"])){

    $edit = new ajaxPlanesCategoria();
  
    $edit -> modulosPaquete = $_POST["modulosPaquete"];
    $edit -> nombrePaquete = $_POST["nombrePaquete"];
    $edit -> skuPaquete = $_POST["skuPaquete"];
    $edit -> cabysPaquete = $_POST["cabysPaquete"];
    $edit -> planesPaquete = $_POST["planesPaquete"];
    $edit -> diasPaquete = $_POST["diasPaquete"];
    $edit -> precioPaquete = $_POST["precioPaquete"];
    $edit -> ivaPaquete = $_POST["ivaPaquete"];
    $edit -> codTarifaPaquete = $_POST["codTarifaPaquete"];
    $edit -> tarifaPaquete = $_POST["tarifaPaquete"];
    $edit -> moneda = $_POST["moneda"];

    $edit -> ajaxAgregarCategoria();
  
  }

 
  if(isset($_POST["Validplan"])){

    $edit = new ajaxPlanesCategoria();
  
    $edit -> Valplan = $_POST["Validplan"];
    $edit -> Valpaquete = $_POST["Validcategoria"];

    $edit -> ajaxValidarPaquetes();
  
  }

  if(isset($_POST["loadCategoria"])){

    $edit = new ajaxPlanesCategoria();
  
    $edit -> loadCategoria = $_POST["loadCategoria"];

    $edit -> ajaxCargarCategoria();
  
  }


  if(isset($_POST["idPaquete"])){

    $edit = new ajaxPlanesCategoria();
  
    $edit -> editaridPaquete = $_POST["idPaquete"];
    $edit -> editarNombre = $_POST["editarNombre"];
    $edit -> editarSku = $_POST["editarSku"];
    $edit -> editarCabys = $_POST["editarCabys"];
    $edit -> editarCantDocumentos = $_POST["editarCantDocumentos"];
    $edit -> editarDias = $_POST["editarDias"];
    $edit -> editarPrecio = $_POST["editarPrecio"];
    $edit -> editarMoneda = $_POST["editarMoneda"];

    $edit -> ajaxModificarCategoria();
  
  }



  if(isset($_POST["IdPaq"])){

    $edit = new ajaxPlanesCategoria();
  
    $edit -> fecha = $_POST["fecha"];
    $edit -> estado = $_POST["estado"];
    $edit -> IdPaq = $_POST["IdPaq"];

    $edit -> ajaxModificarEstado();
  
  }