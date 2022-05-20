<?php

require_once "../controllers/sistema-rutas.controller.php";
require_once "../models/sistema-rutas.model.php";

class ajaxRutas{
 

     public $idRuta;
     public $diaVis;
     
    public function ajaxCargarClientesRuta(){

    $idRuta = $this->idRuta;
    $diaVis = $this->diaVis;

      $response = RutasController::ctrCargarClientesRuta($idRuta, $diaVis);

      echo json_encode($response);

  }

  public $idusuario;
     
  public function ajaxCargarIDruta(){

  $idusuario = $this->idusuario;

    $response = RutasController::ctrCargarIDruta($idusuario);

    echo json_encode($response);

}

public $comentario;
public $ruta;
public $cliente;
public $longitud;
public $latitud;     



public function ajaxInsertNocompraRuta(){

$comentario = $this->comentario;
$ruta = $this->ruta;
$cliente = $this->cliente;
$longitud = $this->longitud;
$latitud = $this->latitud;

  $response = RutasController::ctrInsertNocompraRuta($comentario, $ruta, $cliente, $longitud, $latitud);

  echo json_encode($response);

}


}


if(isset($_POST["idRuta"])){

    $edit = new ajaxRutas();
  
    $edit -> idRuta = $_POST["idRuta"];
    $edit -> diaVis = $_POST["diaVis"];
    
    $edit -> ajaxCargarClientesRuta();
  
  }

  if(isset($_POST["idusuario"])){

    $edit = new ajaxRutas();
  
    $edit -> idusuario = $_POST["idusuario"];
 
    
    $edit -> ajaxCargarIDruta();
  
  }

  if(isset($_POST["ruta"])){

    $edit = new ajaxRutas();
   
    $edit -> comentario = $_POST["comentario"];
    $edit -> ruta = $_POST["ruta"];
    $edit -> cliente = $_POST["cliente"];
    $edit -> longitud = $_POST["longitud"];
    $edit -> latitud = $_POST["latitud"];
 
    $edit -> ajaxInsertNocompraRuta();
  
  }

 