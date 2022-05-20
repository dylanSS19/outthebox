<?php
 
require_once "../controllers/emision-facturas-facturar.controller.php";
require_once "../models/emision-facturas-facturar.model.php";
 

class AjaxemitirFacturasFact{

    public $idFactura;
    public function ajaxCargarDetalleFactura(){

        $idFactura = $this->idFactura;

		$response = emitirFacturasFactController::ctrCargarDetalleFactura($idFactura);

		echo json_encode($response);


    }

    public $Factura;
    public function ajaxCargarFactura(){

        $idFactura = $this->Factura;

		$response = emitirFacturasFactController::ctrCargarFactura($idFactura);

		echo json_encode($response);


    }

    public $Datosempresa;
    public function ajaxCargarDatosEmpresa(){

    $Datosempresa = $this->Datosempresa;


    $response = FacturacionController::ctrCargarDatosEmpresa($Datosempresa);

    echo json_encode($response);


    }

    public $consecutivo;
    public $clave;
    public $estado;
    public $idfact;
    public function ajaxModificarDatosFactura(){

    $conse = $this->consecutivo;
    $clave = $this->clave;
    $estado = $this->estado;
    $idfact = $this->idfact;

    $response = emitirFacturasFactController::ctrModificarDatosFactura($conse, $clave, $estado, $idfact);

    echo $response;

 
    }

/*=============================================
=        CONECTAR CON API HD           =
=============================================*/

public $DtosFactura;

public function ajaxEnviarFacturaApi(){
  
  $data = $this->DtosFactura;
  // echo '<pre>'; print_r( $data); echo '</pre>';
  // $ch = curl_init("https://outthebox-cr.com/api/api-facturacion-pruebas.controller.php");
  $ch = curl_init("https://localhost/outthebox/api/api-facturacion-pruebas.controller.php");


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


}


if(isset($_POST["idFactura"])){

	$var = new AjaxemitirFacturasFact();

	$var -> idFactura = $_POST["idFactura"];

	$var -> ajaxCargarDetalleFactura();

}

if(isset($_POST["Factura"])){

	$var = new AjaxemitirFacturasFact();

	$var -> Factura = $_POST["Factura"];

	$var -> ajaxCargarFactura();

}

if(isset($_POST["DatosEmpresa"])){

    $edit = new AjaxemitirFacturasFact();
  
   $edit -> Datosempresa = $_POST["DatosEmpresa"];

    $edit -> ajaxCargarDatosEmpresa();
  
  }

  if(isset($_POST["DatosFactura"])){

    $edit = new AjaxemitirFacturasFact();
  
   $edit -> DtosFactura = $_POST["DatosFactura"];

    $edit -> ajaxEnviarFacturaApi();
  
  }

  if(isset($_POST["conse"])){

    $edit = new AjaxemitirFacturasFact();
  
   $edit -> consecutivo = $_POST["conse"];
   $edit -> clave = $_POST["clave"];
   $edit -> estado = $_POST["estado"];
   $edit -> idfact = $_POST["facId"];

    $edit -> ajaxModificarDatosFactura();
  
  }