<?php
 
require_once "../controllers/emision-facturas.controller.php";
require_once "../models/emision-facturas.model.php";


class AjaxEmisionFacturas{

	 
	public $idusuario;
	
	public function ajaxCargarRutaUsuario(){

        $idusuario = $this->idusuario;

		$response = EmisionFacturasController::Cargausuariorutas($idusuario);

		echo json_encode($response);
        // echo $response;


    }



	public $idFact;
	
	public function ajaxModificarEstadoFactura(){

        $idFactura = $this->idFact;

		$response = EmisionFacturasController::ctrModificarEstadoFactura($idFactura);

		echo json_encode($response);
        // echo $response;


    }

	public $loadidFact;
	
	public function ajaxCargarDatosFactura(){

        $idFactura = $this->loadidFact;

		$response = EmisionFacturasController::ctrCargarDatosFactura($idFactura);

		echo json_encode($response);
        // echo $response;

    }

	public $loadnumFactura;
	
	public function ajaxCargarDatosDetalleFactura(){

        $idFactura = $this->loadnumFactura;

		$response = EmisionFacturasController::ctrCargarDatosDetalleFactura($idFactura);

		echo json_encode($response);
        // echo $response;

    }

	public $xlsxFacturas;
	public $xlsxEmpresa;

	
	public function ajaxGuardarFacturas(){

        $archivo = $this->xlsxFacturas;
        $empresa = $this->xlsxEmpresa;
		$hoy = date('Y-m-d');

		$ruta = "../extensions/ExcelFacturas/".$empresa;
		
		if (!file_exists($ruta)) {

			mkdir("../extensions/ExcelFacturas/".$empresa, 0777,true);
			
		}

		$x = 0;
		$y = 5;
	   	$Strings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	  
       $NombreDocumento =  'facturas-'.$hoy.'-'.substr(str_shuffle($Strings), $x, $y);
		$ruta = "../extensions/ExcelFacturas/".$empresa."/".$NombreDocumento.".xlsx";

		if(move_uploaded_file($archivo['tmp_name'], $ruta)){

			echo $NombreDocumento;

		}else{

			echo "false";

		}
		

    }


/*=============================================
=        CONECTAR CON API OTB                 =
=============================================*/

public $DatosFactura;

public function ajaxEnviarFacturaApi(){
  
  $data = $this->DatosFactura;
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

if(isset($_POST["usuarioRuta"])){

	$var = new AjaxEmisionFacturas();

	$var -> idusuario = $_POST["usuarioRuta"];

	$var -> ajaxCargarRutaUsuario();

}

if(isset($_POST["FactId"])){

	$var = new AjaxEmisionFacturas();

	$var -> idFact = $_POST["FactId"];

	$var -> ajaxModificarEstadoFactura();

}

if(isset($_FILES["xlsxFacturas"])){

	$var = new AjaxEmisionFacturas();

	$var -> xlsxFacturas = $_FILES["xlsxFacturas"];
	$var -> xlsxEmpresa = $_POST["xlsxEmpresa"];

	$var -> ajaxGuardarFacturas();

}

if(isset($_POST["loadidFact"])){

	$var = new AjaxEmisionFacturas();

	$var -> loadidFact = $_POST["loadidFact"];

	$var -> ajaxCargarDatosFactura();

}

if(isset($_POST["loadnumFactura"])){

	$var = new AjaxEmisionFacturas();

	$var -> loadnumFactura = $_POST["loadnumFactura"];

	$var -> ajaxCargarDatosDetalleFactura();

}

if(isset($_POST["DatosFactura"])){

	$var = new AjaxEmisionFacturas();

	$var -> DatosFactura = $_POST["DatosFactura"];

	$var -> ajaxEnviarFacturaApi();

}
