<?php

require_once "../controllers/merchandising-clientes.controller.php";
require_once "../models/merchandising-clientes.model.php";

class ajaxMerchandisingClientes{
 
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
     public $diasVisita;
     public $latitud;
     public $longitud;

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
    $diasVisita = $this->diasVisita;
    $latitud = $this->latitud;
    $longitud = $this->longitud;


      $response = MerchandisingClientesController::ctrAgregarClientes($id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $diasVisita, $latitud, $longitud);

      echo  $response;


  }

  public $CedulaSearch;


  public function ajaxBuscarCliente(){

  $Cedula = $this->CedulaSearch;

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://apis.gometa.org/cedulas/'.$Cedula,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  
  echo $response; 
  
//   echo json_encode($response);

}


}


if(isset($_POST["empresa"])){

   $add = new ajaxMerchandisingClientes();
  
   $add -> empresa = $_POST["empresa"];
   $add -> nombre = $_POST["nombre"];
   $add -> cedula = $_POST["cedula"];
   $add -> tipo_cedula = $_POST["tipo_cedula"];
   $add -> correo = $_POST["correo"];
   $add -> telefono = $_POST["telefono"];
   $add -> provincia = $_POST["provincia"];
   $add -> canton = $_POST["canton"];
   $add -> distrito = $_POST["distrito"];
   $add -> direccion = $_POST["direccion"];
   $add -> diasVisita = $_POST["diasVisita"];
   $add -> latitud = $_POST["latitud"];
   $add -> longitud = $_POST["longitud"];
    
   $add -> ajaxAgregarCliente();
  
  }

  
if(isset($_POST["CedulaSearch"])){

    $load = new ajaxMerchandisingClientes();
   
    $load -> CedulaSearch = $_POST["CedulaSearch"];
     
    $load -> ajaxBuscarCliente();
   
   }