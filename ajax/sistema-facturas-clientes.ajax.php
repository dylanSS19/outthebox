 <?php

require_once "../controllers/sistema-facturas-clientes.controller.php";
require_once "../models/sistema-facturas-clientes.model.php";

class ajaxreporteClientes{
 
    /*=============================================
    =      AGREGAR PRODUCTOS                =
    =============================================*/
    
     public $empresa;
     public $nombre;
     public $cedula;
     public $tipo_cedula;
     public $correo;
     public $telefono;
     public $provincia;
     public $canton;
     public $distrito;
     public $direccion;
     public $listaPrecios;


    public function ajaxAgregarCliente(){

    $id_empresa = $this->empresa;
    $nombreC = $this->nombre;
    $cedulaC = $this->cedula;
    $tipo_CedulaC = $this->tipo_cedula;
    $correoC = $this->correo;
    $telefonoC = $this->telefono;
    $provinciaC = $this->provincia;
    $CantonC = $this->canton;
    $distritoC = $this->distrito;
    $direccionC = $this->direccion;
    $listaPreciosC = $this->listaPrecios;

      $response = ReporteClientesController::ctrAgregarClientes($id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $listaPreciosC);

      echo  $response;


  }

    public $cedulaVal; 
    public $EmpresaVal;


    public function ajaxValCedula(){

    $id_empresaV = $this->EmpresaVal;
    $cedulaV = $this->cedulaVal;
  

      $response = ReporteClientesController::ctrValCedula($id_empresaV, $cedulaV);

      echo json_encode($response);


  }


    public $idCliente;


    public function ajaxCargarClienteXid(){

   
    $client = $this->idCliente;
  

      $response = ReporteClientesController::ctrCargarClienteXid($client);

      echo json_encode($response);


  }


  public $id_clienteE;
  public $nombreE;
  public $cedulaE;
  public $tipo_cedulaE;
  public $correoE;
  public $telefonoE;
  public $provinciaE;
  public $cantonE;
  public $distritoE;
  public $direccionE;
  public $tipoListaE;



 public function ajaxEditarCliente(){

 $id_clienteE = $this->id_clienteE;
 $nombreCE = $this->nombreE;
 $cedulaCE = $this->cedulaE;
 $tipo_CedulaCE = $this->tipo_cedulaE;
 $correoCE = $this->correoE;
 $telefonoCE = $this->telefonoE;
 $provinciaCE = $this->provinciaE;
 $CantonCE = $this->cantonE;
 $distritoCE = $this->distritoE;
 $direccionCE = $this->direccionE;
 $tipoListaCE = $this->tipoListaE;

   $response = ReporteClientesController::ctrEditarClientes($id_clienteE, $nombreCE, $cedulaCE, $tipo_CedulaCE, $correoCE, $telefonoCE, $provinciaCE, $CantonCE, $distritoCE, $direccionCE, $tipoListaCE);

   echo $response;


}


}


  /*=============================================
  =     AGREGAR CLIENTES             =
  =============================================*/
if(isset($_POST["empresa"])){

  $edit = new ajaxreporteClientes();

 $edit -> empresa = $_POST["empresa"];
 $edit -> nombre = $_POST["nombre"];
 $edit -> cedula = $_POST["cedula"];
 $edit -> tipo_cedula = $_POST["tipo_cedula"];
 $edit -> correo = $_POST["correo"];
 $edit -> telefono = $_POST["telefono"];
 $edit -> provincia = $_POST["provincia"];
 $edit -> canton = $_POST["canton"];
 $edit -> distrito = $_POST["distrito"];
 $edit -> direccion = $_POST["direccion"];
 $edit -> listaPrecios = $_POST["listaPrecio"];
  $edit -> ajaxAgregarCliente();

}

if(isset($_POST["empresaVal"])){

  $edit = new ajaxreporteClientes();

 $edit -> EmpresaVal = $_POST["empresaVal"];
 $edit -> cedulaVal = $_POST["cedulaVal"];

  $edit -> ajaxValCedula();

}

if(isset($_POST["idcliente"])){

  $edit = new ajaxreporteClientes();

 $edit -> idCliente = $_POST["idcliente"];

  $edit -> ajaxCargarClienteXid();

}

if(isset($_POST["idclienteE"])){

  $edit = new ajaxreporteClientes();

 $edit -> id_clienteE = $_POST["idclienteE"];
 $edit -> nombreE = $_POST["nombreE"];
 $edit -> cedulaE = $_POST["cedulaE"];
 $edit -> tipo_cedulaE = $_POST["tipo_cedulaE"];
 $edit -> correoE = $_POST["correoE"];
 $edit -> telefonoE = $_POST["telefonoE"];
 $edit -> provinciaE = $_POST["provinciaE"];
 $edit -> cantonE = $_POST["cantonE"];
 $edit -> distritoE = $_POST["distritoE"];
 $edit -> direccionE = $_POST["direccionE"];
 $edit -> tipoListaE = $_POST["tipoListaE"];

  $edit -> ajaxEditarCliente();

}



