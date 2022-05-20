<?php

require_once "../controllers/sistema-facturas-facturacion.controller.php";
require_once "../models/sistema-facturas-facturacion.model.php";

class ajaxFacturacion{


    public $ID_EMPRESA;
    public $ID_CLIENTE_cargarProductos;
    public function ajaxCargarProductos(){

    $id_empresa = $this->ID_EMPRESA;
    $id_cliente = $this->ID_CLIENTE_cargarProductos;

      $response = FacturacionController::ctrCargarProductos($id_empresa,$id_cliente);

      echo json_encode($response);


  }

  public $ID_PRODUCTO;
  public $IDCLIENTE;
  public function ajaxCargarProductosXId(){

  $id_producto = $this->ID_PRODUCTO;
  $id_cliente = $this->IDCLIENTE;

    $response = FacturacionController::ctrCargarProductosXId($id_producto,$id_cliente);

    echo json_encode($response);


}

public $ID_CLIENTE;
public function ajaxCargarClientXId(){

$id_cliente = $this->ID_CLIENTE;

  $response = FacturacionController::ctrCargarClienteXId($id_cliente);

  echo json_encode($response);


}



public $Datosempresa;
public function ajaxCargarDatosEmpresa(){

$Dtosempresa = $this->Datosempresa;


  $response = FacturacionController::ctrCargarDatosEmpresa($Dtosempresa);

  echo json_encode($response);


}



public $idUnidadMedida;
public function ajaxCargarUnidadMedida(){

$unidadM = $this->idUnidadMedida;


  $response = FacturacionController::ctrCargarUnidadMedida($unidadM);

  echo json_encode($response);


} 

 
public $ClaveFact;
public function ajaxImprimirDatosFactura(){

  $ClaveFact = $this->ClaveFact;

  $response = FacturacionController::CtrImprimirDatosFactura($ClaveFact);

  echo json_encode($response);

}

public $ivasFact;
public function ajaxImprimirDatosIva(){

  $ivasFact = $this->ivasFact;

  $response = FacturacionController::CtrImprimirDatosIva($ivasFact);

  echo json_encode($response);

}

public $DetalleFact;
public function ajaxImprimirDatosDetalle(){

  $DetalleFact = $this->DetalleFact;

  $response = FacturacionController::CtrImprimirDatosDetalle($DetalleFact);

  echo json_encode($response);

}

/*=============================================
=        CONECTAR CON API HD           =
=============================================*/

public $DtosFactura;

public function ajaxEnviarFacturaApi(){
  
     $data = $this->DtosFactura;
    // echo '<pre>'; print_r( $data); echo '</pre>';
    $ch = curl_init("https://localhost/outthebox/api/api-facturacion.controller.php");
  
    // $ch = curl_init("https://outthebox-cr.com/api/api-facturacion-pruebas.controller.php");
      //$ch = curl_init("https://posfacturar.com/pos_digitalsat/public/api/v5/sale/getBillSearch");

          //URL de Produccion http://wcf.facturoporti.com.mx/Timbrado/Servicios.svc/ApiTimbrarCFDI
         //curl_setopt($ch, CURLOPT_URL, "http://posfacturar.com/pos_digitalsat/public/api/v5/sale/add");
        //a true, obtendremos una respuesta de la url, en otro caso,
       //true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Se define el tipo de metodo de envio de datos
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
        //establecemos el verbo http que queremos utilizar para la petición
       
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //enviamos el array data

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        //obtenemos la respuesta
        $response = curl_exec($ch);
        // Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($ch);

        echo $response;
            
  }

  //public $fechaMoneda;

  public static function ajaxTipoCambioUSD($fechaMoneda) {

    //$fecha = $this->fechaMoneda;
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://outthebox-cr.com/api/api-tipo-cambio.php?Fecha='.$fechaMoneda,
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

  }


    public $CedulaSearch;
 public function ctrBuscarCedulaApi(){

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
    
            // return $response;
    
    
    } 
 

    public $addCedula;
    public $addNombre;
    public $addTpCedula;
    public $addempresa;
    public $addListPrecio;
    public $addCorreo;


    public function ajaxIngresarCliente(){
    
    $addCedula = $this->addCedula;
    $addNombre = $this->addNombre;
    $addTpCedula = $this->addTpCedula;
    $addempresa = $this->addempresa; 
    $addListPrecio = $this->addListPrecio;
    $addCorreo = $this->addCorreo;

  
      $response = FacturacionController::ctrIngresarCliente($addCedula, $addNombre, $addTpCedula, $addempresa, $addListPrecio, $addCorreo);
    
      echo $response;
    
    }


public $id_sucursal;
public $empresa;
public function ajaxCargarCajas(){

$sucursal = $this->id_sucursal;
$empresa = $this->empresa;

  $response = FacturacionController::ctrCargarCajas($empresa, $sucursal);

  echo json_encode($response);


}


}


if(isset($_POST["ID_empresa"])){

    $edit = new ajaxFacturacion();
  
   $edit -> ID_EMPRESA = $_POST["ID_empresa"];
   $edit -> ID_CLIENTE_cargarProductos = $_POST["ID_cliente"];
  
    $edit -> ajaxCargarProductos();
  
  }


  if(isset($_POST["id_producto"])){

    $edit = new ajaxFacturacion();
  
   $edit -> ID_PRODUCTO = $_POST["id_producto"];
   $edit -> IDCLIENTE  = $_POST["id_client"];
  
    $edit -> ajaxCargarProductosXId();
  
  }

 
  if(isset($_POST["id_cliente"])){

    $edit = new ajaxFacturacion();
  
   $edit -> ID_CLIENTE = $_POST["id_cliente"];
   
  
    $edit -> ajaxCargarClientXId();
  
  }


  if(isset($_POST["sucursal"])){

    $edit = new ajaxFacturacion();
  
   $edit -> id_sucursal = $_POST["sucursal"];
   $edit -> empresa = $_POST["empresa"];
    $edit -> ajaxCargarCajas();
  
  }

  if(isset($_POST["DatosEmpresa"])){

    $edit = new ajaxFacturacion();
  
   $edit -> Datosempresa = $_POST["DatosEmpresa"];

    $edit -> ajaxCargarDatosEmpresa();
  
  }

  if(isset($_POST["id_unidad"])){

    $edit = new ajaxFacturacion();
  
   $edit -> idUnidadMedida = $_POST["id_unidad"];

    $edit -> ajaxCargarUnidadMedida();
  
  }

  if(isset($_POST["DatosFactura"])){

    $edit = new ajaxFacturacion();
  
   $edit -> DtosFactura = $_POST["DatosFactura"];

    $edit -> ajaxEnviarFacturaApi();
  
  }

  if(isset($_POST["fechaMoneda"])) {
    $edit = new ajaxFacturacion();
  
    $fechaMoneda = $_POST["fechaMoneda"];

    $edit -> ajaxTipoCambioUSD($fechaMoneda);
  }


  if(isset($_POST["ClaveFact"])) {
    $load = new ajaxFacturacion();
  
    $load -> ClaveFact = $_POST["ClaveFact"];

    $load -> ajaxImprimirDatosFactura();
  }


  if(isset($_POST["ivasFact"])) {
    $load = new ajaxFacturacion();
  
    $load -> ivasFact = $_POST["ivasFact"];

    $load -> ajaxImprimirDatosIva();
  }

  if(isset($_POST["DetalleFact"])) {
    $load = new ajaxFacturacion();
  
    $load -> DetalleFact = $_POST["DetalleFact"];

    $load -> ajaxImprimirDatosDetalle();
  }

  if(isset($_POST["CedulaSearch"])) {
    $load = new ajaxFacturacion();
  
    $load ->  CedulaSearch = $_POST["CedulaSearch"];

    $load -> ctrBuscarCedulaApi();
  }
 

  if(isset($_POST["addCedula"])) {
    $load = new ajaxFacturacion();
  
    $load ->  addCedula = $_POST["addCedula"];
    $load ->  addNombre = $_POST["addNombre"];
    $load ->  addTpCedula = $_POST["addTpCedula"];
    $load ->  addempresa = $_POST["addempresa"];
    $load ->  addListPrecio = $_POST["addListPrecio"];
    $load ->  addCorreo = $_POST["addCorreo"];


    $load -> ajaxIngresarCliente();
  }

