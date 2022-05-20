<?php

require_once  "../controllers/reporte-ventas-dth.controller.php";
require_once  "../models/reporte-ventas-dth.model.php";


class Ajax_inicio_cierre_rutas{

 public $id_usuario;

  public function ajaxCargarInicioRutas(){
 
  $id_usuario = $this->id_usuario;
  
  $response = ControladorVentasDth::ctrCargarInicioRutas($id_usuario);

  echo json_encode($response);

  }

   public $placa;
   public $fecha;

  public function ajaxCargarInformacionRutas(){
 
    $placa = $this->placa;
    $fecha = $this->fecha;
  
    $response = ControladorVentasDth::ctrCargarInformacionRutas($placa, $fecha);

    echo json_encode($response);


  }

 

   public $placa_cierre;
   public $fecha_cierre;

  public function ajaxCargarInformacionCierreRutas(){
 
    $placa_cierre = $this->placa_cierre;
    $fecha_cierre = $this->fecha_cierre;
  
  $response = ControladorVentasDth::ctrCargarInformacionCierreRutas($placa_cierre, $fecha_cierre);

    echo json_encode($response);


  }



   public $id_usuario_vehiculo;

     public $rol;

  public function ajaxCargarDatosPlaca(){
 
    $id_usuario_vehiculo = $this->id_usuario_vehiculo;

    $rol = $this->rol;

  
  $response = ControladorVentasDth::ctrCargarInformacionPlaca($id_usuario_vehiculo,$rol);

    echo json_encode($response);


  }

}



if(isset($_POST["id_usuario"])){

  $usuario_apertura = new Ajax_inicio_cierre_rutas();

  $usuario_apertura-> id_usuario = $_POST["id_usuario"];

  $usuario_apertura-> ajaxCargarInicioRutas();

}

if(isset($_POST["id_usuario_vehiculo"])){

  $usuario_apertura = new Ajax_inicio_cierre_rutas();

  $usuario_apertura-> id_usuario_vehiculo = $_POST["id_usuario_vehiculo"];

   $usuario_apertura-> rol = $_POST["rol"];

  $usuario_apertura-> ajaxCargarDatosPlaca();

}


if(isset($_POST["placa"])){

  $placa_apertura = new Ajax_inicio_cierre_rutas();

  $placa_apertura-> placa = $_POST["placa"];
  $placa_apertura-> fecha = $_POST["fecha"];

  $placa_apertura-> ajaxCargarInformacionRutas();

}


if(isset($_POST["placa_cierre"])){

  $placa_apertura = new Ajax_inicio_cierre_rutas();

  $placa_apertura-> placa_cierre = $_POST["placa_cierre"];
  $placa_apertura-> fecha_cierre = $_POST["fecha_cierre"];

  $placa_apertura-> ajaxCargarInformacionCierreRutas();

}