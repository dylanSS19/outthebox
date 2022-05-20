<?php

require_once "../controllers/reporte-sistema-facturacion.controller.php";
require_once "../models/reporte-sistema-facturacion.model.php";

class ajaxReporteFacturas{
  
	/*=============================================
  =     CARGAR DETALLE FACTURAS                =
  =============================================*/
  
  public $factura;
  
  public function ajaxDetalleFactura(){

    $factura = $this->IDfactura;

    $response = ReporteFacturasController::ctrDetalleFactura($factura);

    echo json_encode($response);

    
  }

  public $facturaF;
  
  public function ajaxFactura(){

    $facturaF = $this->IDfacturaF;

    $response = ReporteFacturasController::ctrFactura($facturaF);

    echo json_encode($response);

    
  }

  public $idEmpresa;
  
  public function ajaxCargarDatosEmpresa(){

    $idEmpresa = $this->idEmpresa;

    $response = ReporteFacturasController::ctrCargarDatosEmpresa($idEmpresa);

    echo json_encode($response);

    
  }

/*=============================================
=        CONECTAR CON API OUTTHEBOX          =
=============================================*/

  public $DatosFactura;

public function ajaxCargaDatosFactura(){
  

     $data = $this->DatosFactura;
    // echo '<pre>'; print_r( $data); echo '</pre>';
   $ch = curl_init("https://outthebox-cr.com/api/api-facturacion.controller.php");
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




/*=============================================
=        CONECTAR CON API ENVIO CORREO          =
=============================================*/

  public $apiCorreo;

public function ajaxEnvioCorreo(){
  
     $data = $this->apiCorreo;
    // echo '<pre>'; print_r( $data); echo '</pre>';
   $ch = curl_init("http://backup.midigitalsat.com/api/api_envio_correo.php");
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



  public $UrlZipclave;
  public $UrlZipempresa;

public function ajaxZIPFactura(){
  
      $clave = $this->UrlZipclave;
     $idEmpresa = $this->UrlZipempresa;


     $ipremoteserver='backup.midigitalsat.com';
     $urlremoteserver='https://backup.midigitalsat.com';

$username = 'root';
$password = 'Heriberto9109';
                    // Make our connection
$connection = ssh2_connect($ipremoteserver, 6060);

                    // Authenticate
if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');

                    // Create our SFTP resource
if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');


$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/DocumentosRespuesta/documentoRespuesta'.$clave.'.xml';
$localfile = '/var/www/outthebox/documento/DocumentoRespuesta'.$clave.'.xml';
ssh2_scp_recv($connection, $remotefile, $localfile);


$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/DocumentosFirmados/documento'.$clave.'.xml';
$localfile = '/var/www/outthebox/documento/DocumentoFirmado'.$clave.'.xml';
ssh2_scp_recv($connection, $remotefile, $localfile);


$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/facturaPDF/Documento'.$clave.'.pdf';
$localfile = '/var/www/outthebox/documento/Documento'.$clave.'.pdf';
ssh2_scp_recv($connection, $remotefile, $localfile);

ssh2_exec($connection, 'exit');

      
            
  }

  /*=============================================
=        DESCRAGAR PDF DEL BACK UP          =
=============================================*/

public $UrlPdf;
public $UrlPdfclave;
public $UrlPdfempresa;

public function ajaxPDFFactura(){

   $url = $this->UrlPdf;
   $clave = $this->UrlPdfclave;
   $empresa = $this->UrlPdfempresa;

   $ipremoteserver='backup.midigitalsat.com';
   $urlremoteserver='https://backup.midigitalsat.com';

$username = 'root';
$password = 'Heriberto9109';
                  // Make our connection
$connection = ssh2_connect($ipremoteserver, 6060);

                  // Authenticate
if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');

                  // Create our SFTP resource
if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');
$remotefile  = $url;
$localfile = '/var/www/outthebox/documento/documento'.$clave.'.pdf';



/*ssh2_scp_recv($connection, $remotefile, $localfile);
*/
if(ssh2_scp_recv($connection, $remotefile, $localfile)){
          echo "OK";
      }else{

      echo "MAME";

      }

    ssh2_exec($connection, 'exit');

          
}

}



if(isset($_POST["idEmpresa"])){

  $edit = new ajaxReporteFacturas();

  $edit -> idEmpresa = $_POST["idEmpresa"];

  $edit -> ajaxCargarDatosEmpresa();

}


if(isset($_POST["IdFactura"])){

  $edit = new ajaxReporteFacturas();

  $edit -> IDfactura = $_POST["IdFactura"];

  $edit -> ajaxDetalleFactura();

}

if(isset($_POST["IdFacturaF"])){

  $edit = new ajaxReporteFacturas();

  $edit -> IDfacturaF = $_POST["IdFacturaF"];

  $edit -> ajaxFactura();

}

if(isset($_POST["DatosFactura"])){

  $edit = new ajaxReporteFacturas();

  $edit -> DatosFactura = $_POST["DatosFactura"];

  $edit -> ajaxCargaDatosFactura();

}


if(isset($_POST["apiCorreo"])){

  $edit = new ajaxReporteFacturas();

  $edit -> apiCorreo = $_POST["apiCorreo"];

  $edit -> ajaxEnvioCorreo();

}


if(isset($_POST["UrlZipclave"])){

  $edit = new ajaxReporteFacturas();

  $edit -> UrlZipclave = $_POST["UrlZipclave"];

  $edit -> UrlZipempresa = $_POST["UrlZipempresa"];

  $edit -> ajaxZIPFactura();

}

if(isset($_POST["UrlPdf"])){

  $edit = new ajaxReporteFacturas();

  $edit -> UrlPdf = $_POST["UrlPdf"];

  $edit -> UrlPdfclave = $_POST["UrlPdfclave"];

  $edit -> UrlPdfempresa = $_POST["UrlPdfempresa"];

  $edit -> ajaxPDFFactura();

}