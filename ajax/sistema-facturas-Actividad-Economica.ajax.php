<?php

require_once "../controllers/sistema-facturas-actividadEco.controller.php";
require_once "../models/sistema-facturas-actividadEco.model.php";

class ajaxActividadEconomica{
  
  public $empresa;
  public $codigo;
  public $nombre;

  public function ajaxingresarActividad(){

    $idempresa = $this->empresa;
    $codigoActividad = $this->codigo;
    $nombreActividad = $this->nombre;

    $response = ActividadEconomicaController::ctrIngresarActividadesEconomicas($idempresa, $codigoActividad, $nombreActividad);

    echo $response;

    
  }

}

if(isset($_POST["codigo"])){

    $edit = new ajaxActividadEconomica();
  
   $edit -> empresa = $_POST["empresa"];
   $edit -> codigo = $_POST["codigo"];
   $edit -> nombre = $_POST["nombre"];

    $edit -> ajaxingresarActividad();
  
  }