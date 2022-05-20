<?php
 
require_once "../controllers/planes-clientes.controller.php";
require_once "../models/planes-clientes.model.php";

class ajaxPlanesClientes{
   
 
  public $categoria;

  public function ajaxCargarCategorias(){

    $categoria = $this->categoria;

    $response = PlanesClientesController::ctrCargarCategorias($categoria);

    echo json_encode($response);

  }


  public $idcategoria;

  public function ajaxCargarDatosCategoria(){

    $categoria = $this->idcategoria;

    $response = PlanesClientesController::ctrCargarDatosCategoria($categoria);

    echo json_encode($response);

  }

  public $privilegio;
  public $Cliente;

  public function ajaxAgregarPrivilegio(){

    $privilegio = $this->privilegio;
    $Cliente = $this->Cliente;

    $response = PlanesClientesController::ctrAgregarPrivilegio($privilegio, $Cliente);

    echo $response;

  }


  public $Editarclientes;
  public $EditardiaPago;
  public $EditardiaMax;
  public $EditarplanSelect;
  public $EditarcatSelect;
  public $Editartotal;

  public function ajaxEditarPlanesClientes(){

    $Editarclientes = $this->Editarclientes;
    $EditardiaPago = $this->EditardiaPago;
    $EditardiaMax = $this->EditardiaMax;
    $EditarplanSelect = $this->EditarplanSelect;
    $EditarcatSelect = $this->EditarcatSelect;
    $Editartotal = $this->Editartotal;

    $response = PlanesClientesController::ctrEditarPlanesClientes($Editarclientes, $EditardiaPago, $EditardiaMax, $EditarplanSelect, $EditarcatSelect, $Editartotal);

    echo $response;

  }


  public $PackSelect;
 

  public function ajaxCargarDatosPaquetes(){

    $PackSelect = $this->PackSelect;
   

    $response = PlanesClientesController::ctrCargarDatosPaquetes($PackSelect, $IdEmp);

    echo json_encode($response);

  }

  public $deletePack;

  public function ajaxElimianrPaquete(){

    $deletePack = $this->deletePack;
 

    $response = PlanesClientesController::ctrElimianrPaquete($deletePack);

    echo $response;

  }


  public $IdEmp;
  public function ajaxCargarPaquetes(){

    $IdEmp = $this->IdEmp;
    $response = PlanesClientesController::ctrCargarPaquetes($IdEmp);

    echo json_encode($response);

  }

  public $paquetesId;
  public function ajaxCargarPaquetesID(){

    $paquetesId = $this->paquetesId;

    $response = PlanesClientesController::ctrCargarPaquetesID($paquetesId);

    echo json_encode($response);

  }

  public $clientes;
  public $fecha_fin;
  public $fecha_extencion;
  public $idPlan;
  public $nombrePlan;
  public $precioPlan;
  public $cantDocumentos;
  public $total_pagar;
  public $estado;
  public $ClaveHacienda;
  public $RutFoto;
  public function ajaxAgregarPlanesClientes(){

    $clientes = $this->clientes;
    $fecha_fin = $this->fecha_fin;
    $fecha_extencion = $this->fecha_extencion;
    $idPlan = $this->idPlan;
    $nombrePlan = $this->nombrePlan;
    $precioPlan = $this->precioPlan;
    $cantDocumentos = $this->cantDocumentos;
    $total_pagar = $this->total_pagar;
    $estado = $this->estado;
    $Clave = $this->ClaveHacienda;
    $RutFoto = $this->RutFoto;

    $response = PlanesClientesController::ctrAgregarPlanesClientes($clientes, $fecha_fin, $fecha_extencion, $idPlan, $nombrePlan, $precioPlan, $cantDocumentos, $total_pagar, $estado, $Clave, $RutFoto);

    echo $response;

  }

  public $FotoComprovante;
  public $DatosEmpresa;
  public $Clave;

  public function ajaxIngresarComprobante(){

    $FotoComprovante = $this->FotoComprovante;
    $DatosEmpresa = $this->DatosEmpresa;
    $Clave = $this->Clave;
     
    $response = PlanesClientesController::ctrIngresarComprobante($FotoComprovante, $DatosEmpresa, $Clave);

    echo $response;

  }

}

if(isset($_POST["categorias"])){

  $edit = new ajaxPlanesClientes();

  $edit -> categoria = $_POST["categorias"];

  $edit -> ajaxCargarCategorias();

}

if(isset($_POST["idcategorias"])){

  $edit = new ajaxPlanesClientes();

  $edit -> idcategoria = $_POST["idcategorias"];

  $edit -> ajaxCargarDatosCategoria();

}

if(isset($_POST["privilegios"])){

  $edit = new ajaxPlanesClientes();

  $edit -> privilegio = $_POST["privilegios"];
  $edit -> Cliente = $_POST["cliente"];

  $edit -> ajaxAgregarPrivilegio();

}

if(isset($_POST["clientes"])){

  $edit = new ajaxPlanesClientes();

  $edit -> clientes = $_POST["clientes"];
  $edit -> fecha_fin = $_POST["fecha_fin"];
  $edit -> fecha_extencion = $_POST["fecha_extencion"];
  $edit -> idPlan = $_POST["idPlan"];
  $edit -> nombrePlan = $_POST["nombrePlan"];
  $edit -> precioPlan = $_POST["precioPlan"];
  $edit -> cantDocumentos = $_POST["cantDocumentos"];
  $edit -> total_pagar = $_POST["total_pagar"];
  $edit -> estado = $_POST["estado"];
  $edit -> ClaveHacienda = $_POST["ClaveHacienda"];
  $edit -> RutFoto = $_POST["RutFoto"];

  $edit -> ajaxAgregarPlanesClientes();

}

if(isset($_POST["IDPacSeleccionado"])){

  $edit = new ajaxPlanesClientes();

  $edit -> PackSelect = $_POST["IDPacSeleccionado"];

  
  $edit -> ajaxCargarDatosPaquetes();

}

if(isset($_POST["deletePack"])){

  $edit = new ajaxPlanesClientes();

  $edit -> deletePack = $_POST["deletePack"];

  $edit -> ajaxElimianrPaquete();

}

// if(isset($_POST["clientes"])){

//   $edit = new ajaxPlanesClientes();

//   $edit -> Editarclientes = $_POST["Editarclientes"];
//   $edit -> EditardiaPago = $_POST["Editardia_pago"];
//   $edit -> EditardiaMax = $_POST["Editarmax_dia"];
//   $edit -> EditarplanSelect = $_POST["EditarplanSelect"];
//   $edit -> EditarcatSelect = $_POST["Editarcategoria_plan"];
//   $edit -> Editartotal = $_POST["Editartotal_pagar"];

//   $edit -> ajaxEditarPlanesClientes();

// }

if(isset($_POST["paquetes"])){

  $edit = new ajaxPlanesClientes();

  $edit -> paquetes = $_POST["paquetes"];
  $edit -> IdEmp = $_POST["IdEmp"];

  $edit -> ajaxCargarPaquetes();

}

if(isset($_POST["paquetesId"])){

  $edit = new ajaxPlanesClientes();

  $edit -> paquetesId = $_POST["paquetesId"];

  $edit -> ajaxCargarPaquetesID();

}


if(isset($_FILES["FotoComprovante"])){

  $edit = new ajaxPlanesClientes();

  $edit -> FotoComprovante = $_FILES["FotoComprovante"];
  $edit -> DatosEmpresa = $_POST["DatosEmpresa"];
  $edit -> Clave = $_POST["Clave"];

  $edit -> ajaxIngresarComprobante();

}
