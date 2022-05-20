
<?php
 
 require_once "../controllers/sistema-facturas-datosFacturacion.controller.php";
 require_once "../models/sistema-facturas-datosFacturacion.model.php";
 
 class ajaxDatosFacturacion{

  public $pin;
  public $usuario;
  public $contrasena;
  public $documento;
  public $empresa;


  public function ajaxAgregarDatosFacturacion(){

    $pin = $this->pin;
    $usuario = $this->usuario;
    $contrasena = $this->contrasena;
    $documento = $this->documento;
    $empresa = $this->empresa;

     
    $response = DatosFacturacionController::ctrAgregarDatosFacturacion($empresa, $pin, $usuario, $contrasena, $documento);

    echo $response;
    // echo json_encode($response);

  }


  public $pin_P;
  public $usuario_P;
  public $contrasena_P;
  public $documento_P;
  public $empresa_P;


  public function ajaxAgregarDatosFacturacionPruebas(){

    $pin = $this->pin_P;
    $usuario = $this->usuario_P;
    $contrasena = $this->contrasena_P;
    $documento = $this->documento_P;
    $empresa = $this->empresa_P;

     
    $response = DatosFacturacionController::ctrAgregarDatosFacturacionPruebas($empresa, $pin, $usuario, $contrasena, $documento);

    // echo json_encode($response);
    echo $response;


  }

}


if(isset($_FILES["documento"])){

$add = new ajaxDatosFacturacion();

$add -> documento = $_FILES["documento"];
$add -> usuario = $_POST["usuario"];
$add -> contrasena = $_POST["contrasena"];
$add -> pin = $_POST["pin"];
$add -> empresa = $_POST["empresa"];


$add -> ajaxAgregarDatosFacturacion();

}


if(isset($_FILES["documento_P"])){

$add = new ajaxDatosFacturacion();
    
$add -> documento_P = $_FILES["documento_P"];
$add -> usuario_P = $_POST["usuario_P"];
$add -> contrasena_P = $_POST["contrasena_P"];
$add -> pin_P = $_POST["pin_P"];
$add -> empresa_P = $_POST["empresa_P"];

$add -> ajaxAgregarDatosFacturacionPruebas();
    
}