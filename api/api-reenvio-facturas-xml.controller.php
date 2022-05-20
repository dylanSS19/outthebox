<?php

    
  
require_once ("../extensions/firmarXML/firmar.php");
require_once  ("../models/api-facturacion.model.php");
// require_once  ("../extensions/tcpdf/pdf/comprobante_factura.php");
require_once  ("../extensions/factura/generaFactura.php");
 
use  PHPMailer\PHPMailer\PHPMailer ;
use  PHPMailer\PHPMailer\Exception ;

require  '../extensions/PHPMailer-master/src/Exception.php' ;
require  '../extensions/PHPMailer-master/src/PHPMailer.php' ;
require  '../extensions/PHPMailer-master/src/SMTP.php' ;

header('Acceess-Control-Allow-Origin: *');

switch ($_SERVER['REQUEST_METHOD']) {

  case 'GET':

    
 
    break;


  case 'PUT':
    


    break;

    
  case 'POST':

$data = json_decode(file_get_contents('php://input'), true);

$archivo_formado = $data["xml"];

$data=base64_decode($data["xml"]);



$Xml=simplexml_load_string($data);

$cedula = $Xml->Emisor->Identificacion->Numero;

$fecha_factura_2 = $Xml->FechaEmision;

$clave = $Xml->Clave;

$cedula_receptor =  $Xml->Receptor->Identificacion->Numero;

$tipo_cedula_emisor = $Xml->Emisor->Identificacion->Tipo;




        
  $datosUsario = api_facturacioncontroller::cargarDatosUsuario($cedula);

 

       /*===========================================F==
         = USUARIO Y CONTRASEÑA PARA GENERAR TOQUEN DE 
        AUTENTIFUCACION ANTE HACIENDA               =
        =============================================*/

        $user = $datosUsario["usuario_token"];
        $contrasena = $datosUsario["contrasena_token"]; 

           $token = api_facturacioncontroller::GenerarToken($user, $contrasena);
          

           $token = json_decode($token);

           $token   =  $token->{'access_token'};

        

       /*=============================================
      =        ENVIAR XML FIRMADO A HACIENDA        =
       =============================================*/


 $respuesta_hacienda = api_facturacioncontroller::EnviarApiFacturas($token, $archivo_formado, $clave, $cedula_receptor, $fecha_factura_2, $tipo_cedula_emisor, $cedula);


 
        header("HTTP/1.1 200 OK");
echo '{"success": "true", "Clave":"'.$clave.'"}';




    break;
  
  default:
    
}


class api_facturacioncontroller{

    public static function cargarDatosUsuario($cedula) {
   
  $table = "empresas.tbl_clientes";  

  $response = api_facturacionModel::MdlcargarDatosUsuarioReenvio($table,$cedula);

    return $response;

}


public function GenerarToken($user, $contrasena){
  

     $data = "client_id=api-prod&username=".$user."&password=".urlencode($contrasena)."&grant_type=password";

     // $data = "client_id=api-stag&username=".$user."&password=".$contrasena."&grant_type=password"; 
    $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut/protocol/openid-connect/token"); 
   // $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut-stag/protocol/openid-connect/token"); //ambiente pruebas
      //$ch = curl_init("https://posfacturar.com/pos_digitalsat/public/api/v5/sale/getBillSearch");

// curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
// curl_setopt($ch, CURLOPT_USERPWD, "163928b0-fc2b-485d-9cc9-de6c3b853d5f:ba58b332fad04e0"); 
//Your credentials goes here

          //URL de Produccion http://wcf.facturoporti.com.mx/Timbrado/Servicios.svc/ApiTimbrarCFDI
         //curl_setopt($ch, CURLOPT_URL, "http://posfacturar.com/pos_digitalsat/public/api/v5/sale/add");
        //a true, obtendremos una respuesta de la url, en otro caso,
       //true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Se define el tipo de metodo de envio de datos
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded; charset=utf-8'));
        //establecemos el verbo http que queremos utilizar para la petición
       
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //enviamos el array data

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        //obtenemos la respuesta
        $response = curl_exec($ch);
        // Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($ch);


        return $response;
            
  }


public function EnviarApiFacturas($token, $archivo_formado, $clave, $cedula_receptor, $fecha_factura_2, $tipo_cedula_emisor, $cedula_emisor){
        
    $authorization = "Authorization: Bearer ".$token."";

$json_factura = '{
  "clave": "'.$clave.'",
  "fecha": "'.$fecha_factura_2.'",
  "emisor": {
    "tipoIdentificacion": "'.$tipo_cedula_emisor.'",
    "numeroIdentificacion": "'.$cedula_emisor.'"
  },
  "comprobanteXml":"'.$archivo_formado.'"
}';



    
   // $ch = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/recepcion"); //ambiente sandbox

    $ch = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion/v1/recepcion");

   
      //$ch = curl_init("https://posfacturar.com/pos_digitalsat/public/api/v5/sale/getBillSearch");

// curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
// curl_setopt($ch, CURLOPT_USERPWD, "163928b0-fc2b-485d-9cc9-de6c3b853d5f:ba58b332fad04e0"); 
//Your credentials goes here


          //URL de Produccion http://wcf.facturoporti.com.mx/Timbrado/Servicios.svc/ApiTimbrarCFDI
         //curl_setopt($ch, CURLOPT_URL, "http://posfacturar.com/pos_digitalsat/public/api/v5/sale/add");
        //a true, obtendremos una respuesta de la url, en otro caso,
       //true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Se define el tipo de metodo de envio de datos
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' , $authorization));
        //establecemos el verbo http que queremos utilizar para la petición
       
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //enviamos el array data

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS,$json_factura);
        //obtenemos la respuesta
        $response = curl_exec($ch);
        
        $err = curl_error($ch);

        $response_info = curl_getinfo($ch);

        // Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($ch);

        if($response_info["http_code"] == 202 || $response_info["http_code"] == 200){

$mdlestado = api_facturacioncontroller::ModificarEstadoFactura($clave);

        }else{

         

        }

        if ($err) {

          return "Error #:" . $err;

        } else {

          return $response;

        }

   
            
  }






}