<?php

   
  
require_once ("../extensions/firmarXML/firmar.php");
require_once  ("../models/api-facturacion.model2.php");
// require_once  ("../extensions/tcpdf/pdf/comprobante_factura.php");
require_once  ("../extensions/factura/generaFactura.php");

use  PHPMailer\PHPMailer\PHPMailer ;
use  PHPMailer\PHPMailer\Exception ;
use Spatie\Async\Pool;

require  '../extensions/PHPMailer-master/src/Exception.php' ;
require  '../extensions/PHPMailer-master/src/PHPMailer.php' ;
require  '../extensions/PHPMailer-master/src/SMTP.php' ;

header('Acceess-Control-Allow-Origin: *');
header('Content-Type: multipart/form-data');

switch ($_SERVER['REQUEST_METHOD']) {

  case 'GET':

if(isset($_GET['id'])){

  $string = "heribertocastro117460435";

  $cantidad_caracteres = strlen($string);


/*=============================================
=                        =
=============================================*/
  if($cantidad_caracteres > 20){

    $quitar_caracteres = $cantidad_caracteres - 20;

     $usuario =  str_shuffle(substr($string, $quitar_caracteres));
     $contrasena = str_shuffle(substr($string, $quitar_caracteres));

  }else{

    


  }

   


    header("HTTP/1.1 200 Aceptado");


}else{

$clave = '123456789';



$enviarCorreo = api_facturacioncontroller2::EnviarCorreo();
echo '<pre>'; print_r($enviarCorreo); echo '</pre>';

// $resultado = "Hola de nuevo";

//     echo $resultado;

    // header("HTTP/1.1 200 OK");


}
    
 
    break;


  case 'PUT':
    


    break;

    
  case 'POST':
   

 
 $data = json_decode(file_get_contents('php://input'), true);

/* $usuario = $data["fileContent"]["datosEmisor"]["usuario"];


 echo '{"RETURN ":DATA: '.$usuario .'}';

 return;*/



 //$data =  json_decode( $data1, true);


/*=============================================
= VALIDAR QUE LA ESTRUCTURA DE LOS DATOS RECIVIDOS
  ES UN JSON                                    =
 =============================================*/



if (api_facturacioncontroller2::is_json(json_encode($data["fileContent"])) == "true"){



$usuario = $data["fileContent"]["datosEmisor"]["usuario"];

$contrasena = $data["fileContent"]["datosEmisor"]["password"];

$cedula = $data["fileContent"]["datosEmisor"]["cedula"];





$validacionCredenciales = api_facturacioncontroller2::validarCredencialesUsuario($usuario, $contrasena, $cedula);


 


      if($validacionCredenciales[0] == 1){
       

      $datosUsario = api_facturacioncontroller2::cargarDatosUsuario($contrasena, $cedula);

    date_default_timezone_set('America/Costa_Rica');

    $fecha_emision_factura = date('Y-m-d');
    $hora_emision_factura = date('h:i:s');

    $fecha_factura = ''.$fecha_emision_factura.'T'.$hora_emision_factura.'-06:00';
      $fecha_factura_2 = ''.$fecha_emision_factura.'T'.$hora_emision_factura.'-0600';
      /*=============================================
      =  GENERAR EL XML PARA FIRMAR                =
       =============================================*/

  

      $xml_factura = api_facturacioncontroller2::GenerarXML($data,$fecha_factura,$datosUsario["idtbl_clientes"]);


          
     $xml_capturar = $xml_factura;

    /*=============================================
      = ACCESAR AL XML Y EXTRAER DATOS DEL MISMO    =
       =============================================*/

        $xmlparser = xml_parser_create();

        xml_parse_into_struct($xmlparser,$xml_capturar,$values);
       
        xml_parser_free($xmlparser);


// echo '<pre>'; print_r($values); echo '</pre>';


      $clave = $values[1]["value"];
      $consecutivo = $values[5]["value"];
      $tipo_cedula_receptor = $values[49]["value"];
      $cedula_receptor = $values[51]["value"];
      $tipo_cedula_emisor = $values[13]["value"];
      $cedula_emisor = $values[15]["value"];


      /*=============================================
      =  RUTA DEL ARCHIVO P1, CONTRASEÑA Y ARCHIVO, SE FIRMA EL XML =
       =============================================*/

      $pfx = $datosUsario["ruta_12_prueba"];
      $pin = $datosUsario["pin_p12_prueba"];
      $xml = $xml_factura;
      // $xml = '../apiHacienda/clientes/Heribertocastro/Documentos/documento'.$clave.'.xml';
      $ruta = "dfhjdfhj";
        
         $archivo_formado = api_facturacion2controller::firmar($pfx, $pin, $xml, $ruta,$fecha_factura);
 

       /*===========================================F==
         = USUARIO Y CONTRASEÑA PARA GENERAR TOQUEN DE 
        AUTENTIFUCACION ANTE HACIENDA               =
        =============================================*/

        $user = $datosUsario["usuario_token_prueba"];
        $contrasena = $datosUsario["contrasena_token_prueba"]; 

           $token = api_facturacioncontroller2::GenerarToken($user, $contrasena);

           $token = json_decode($token);

           $token =  $token->{'access_token'};
          

       /*=============================================
      =        ENVIAR XML FIRMADO A HACIENDA        =
       =============================================*/


 $respuesta_hacienda = api_facturacioncontroller2::EnviarApiFacturas($token, $archivo_formado, $clave, $tipo_cedula_receptor, $cedula_receptor, $fecha_factura_2, $tipo_cedula_emisor, $cedula_emisor);

$generarpdf = generarPdf::crearPDF($clave, $datosUsario["idtbl_clientes"]);

$dom = new  DomDocument();
$dom ->preseveWhiteSpace = FALSE ;
$dom -> loadXML(base64_decode($archivo_formado));
$dom -> save('../apiHacienda/clientes/'.$datosUsario["idtbl_clientes"].'/DocumentosFirmados/documento'.$clave.'.xml');

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
$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$datosUsario["idtbl_clientes"].'/DocumentosFirmados/documento'.$clave.'.xml';
$localfile = '../apiHacienda/clientes/'.$datosUsario["idtbl_clientes"].'/DocumentosFirmados/documento'.$clave.'.xml';

 ssh2_scp_send($connection, $localfile, $remotefile, 0644);
                    // download all the files
// $localfile = fopen('../apiHacienda/clientes/Heribertocastro/DocumentosFirmados/documento'.$clave.'.xml', "r");
   
$envioCorreo = api_facturacioncontroller2::EnviarCorreo($clave, $datosUsario["idtbl_clientes"]);


        header("HTTP/1.1 200 OK");
echo '{"success": "true", "Clave":"'.$clave.'", "Consecutivo":"'.$consecutivo.'", "document": "'.$archivo_formado.'"}';

ssh2_exec($connection, 'exit');

      }else{


        header("HTTP/1.1 403 Forbidden");

      echo '{"success": "false", "reason": "CREDENCIALES INCORRECTAS"}';




      }




}else{

header("HTTP/1.1 403 Forbidden");
echo "Error el archivo no cuenta con el formato Json correcto.";


}


    break;
  
  default:
    
}




class api_facturacioncontroller2{


        public  function generarDocs() {

   


 

}

    public static function cargarDatosUsuario($contrasena, $cedula) {
   
  $table = "empresas.tbl_clientes";  

  $response = api_facturacionModel2::MdlcargarDatosUsuario($table, $contrasena, $cedula);


    return $response;

}

    public static function validarCredencialesUsuario($usuario, $contrasena, $cedula) {

   
  $table = "empresas.tbl_clientes";  

  $response = api_facturacionModel2::MdlValidarCredencialesUsuarios ($table, $usuario, $contrasena, $cedula);


    return $response;

}


    public static function is_json($string,$return_data = false) {

   $data = json_decode($string);
     return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
}

      public static  function _isValidXML($xml) {
            $doc = @simplexml_load_string($xml);
            if ($doc) {
                return  "true"; //this is valid
            } else {
                return  "false"; //this is not valid
            }
        }




    public static function cargarUidadMedida() {
   
  $table = "empresas.tbl_unidades_medida_hacienda";  

  $response = api_facturacionModel2::MdlcargarUidadMedida($table);

    return $response;

}

public function GenerarToken($user, $contrasena){
  

     // $data = "client_id=api-prod&username=".$user."&password=".urlencode($contrasena)."&grant_type=password";

     $data = "client_id=api-stag&username=".$user."&password=".$contrasena."&grant_type=password"; 
    // $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut/protocol/openid-connect/token"); 
   $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut-stag/protocol/openid-connect/token"); //ambiente pruebas
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


public function EnviarApiFacturas($token, $archivo_formado, $clave, $tipo_cedula_receptor, $cedula_receptor, $fecha_factura_2, $tipo_cedula_emisor, $cedula_emisor){
        
    $authorization = "Authorization: Bearer ".$token."";

$json_factura = '{
  "clave": "'.$clave.'",
  "fecha": "'.$fecha_factura_2.'",
  "emisor": {
    "tipoIdentificacion": "'.$tipo_cedula_emisor.'",
    "numeroIdentificacion": "'.$cedula_emisor.'"
  },
  "receptor": {
    "tipoIdentificacion": "'.$tipo_cedula_receptor.'",
    "numeroIdentificacion": "'.$cedula_receptor.'"
  },
  "comprobanteXml":"'.$archivo_formado.'"
}';


// echo '<pre>'; print_r($json_factura); echo '</pre>';
    
   $ch = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/recepcion"); //ambiente sandbox

    // $ch = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion/v1/recepcion");

   
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

        // Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($ch);


        if ($err) {

          return "Error #:" . $err;

        } else {

          return $response;

        }

   
            
  }




public function  generarCedula12Digitos ($NumCedula)
{

$length = 12;
$string = substr(str_repeat(0, $length).$NumCedula, - $length);

    return  $string;
}



public function GenerarXML($json_cliente, $fecha_factura, $idcliente){



/*=============================================
=             DATOS EMISOR                   =
=============================================*/

$usuario = $json_cliente["fileContent"]["datosEmisor"]["usuario"];
$contrasena = $json_cliente["fileContent"]["datosEmisor"]["password"];
$cedula_emisor = $json_cliente["fileContent"]["datosEmisor"]["cedula"];
$id_empresa = $json_cliente["fileContent"]["datosEmisor"]["id_empresa"];



/*=============================================
=            DATOS  RECEPTOR              =
=============================================*/

$nombre = $json_cliente["fileContent"]["datosReceptor"]["nombre"];
$tipo_cedula = $json_cliente["fileContent"]["datosReceptor"]["tipoCedula"];
$cedula = $json_cliente["fileContent"]["datosReceptor"]["cedula"];
$direccion = $json_cliente["fileContent"]["datosReceptor"]["direccion"];
$correo = $json_cliente["fileContent"]["datosReceptor"]["correo"];
$telefono = $json_cliente["fileContent"]["datosReceptor"]["telefono"];
$provincia = $json_cliente["fileContent"]["datosReceptor"]["provincia"];
$canton = $json_cliente["fileContent"]["datosReceptor"]["canton"];
$distrito = $json_cliente["fileContent"]["datosReceptor"]["distrito"];
$senas = $json_cliente["fileContent"]["datosReceptor"]["senas"];


/*=============================================
=           DATOS FACTURA                  =
=============================================*/
$sucursal = $json_cliente["fileContent"]["datosFactura"]["sucursal"];
$caja = $json_cliente["fileContent"]["datosFactura"]["caja"];
$tipeDoc = $json_cliente["fileContent"]["datosFactura"]["tipoDoc"];
$moneda = $json_cliente["fileContent"]["datosFactura"]["moneda"];
$condicionVenta = $json_cliente["fileContent"]["datosFactura"]["condicionVenta"];
$plazo = $json_cliente["fileContent"]["datosFactura"]["plazoCredito"];
$mediopago = $json_cliente["fileContent"]["datosFactura"]["medioPago"];
$tipoCambio = $json_cliente["fileContent"]["datosFactura"]["tipoCambio"];
$actividaEconomica = $json_cliente["fileContent"]["datosFactura"]["actividadEconomica"];

/*=============================================
=          DATOS DETALLE  FACTURA            =
=============================================*/




if($condicionVenta == "02"){

$plazoCredito = '<PlazoCredito>'.$plazo.'</PlazoCredito>';

}else{

$plazoCredito;

}

if($tipeDoc == "01"){

$tipo_documento = 'FacturaElectronica';
$header = 'xmlns:ds="http://www.w3.org/2000/09/xmldsig#"';
$header .=' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
$header .=' xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/facturaElectronica"';
$header .=' xsi:schemaLocation="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/facturaElectronica https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/facturaElectronica.xsd">';


}elseif($tipeDoc == "04"){

$tipo_documento = 'TiqueteElectronico';
$header = 'xmlns:ds="http://www.w3.org/2000/09/xmldsig#"';
$header .=' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
$header .=' xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/tiqueteElectronico"';
$header .=' xsi:schemaLocation="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/tiqueteElectronico https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/tiqueteElectronico.xsd">';

}elseif($tipeDoc == "03"){

$tipo_documento = 'NotaCreditoElectronica';
$header = 'xmlns:ds="http://www.w3.org/2000/09/xmldsig#"';
$header .=' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
$header .=' xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/notaCreditoElectronica"';
$header .=' xsi:schemaLocation="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/notaCreditoElectronica https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/notaCreditoElectronica.xsd">';

}elseif($tipeDoc == "02"){

$tipo_documento = 'NotaDebitoElectronica';
$header = 'xmlns:ds="http://www.w3.org/2000/09/xmldsig#"';
$header .=' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
$header .=' xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/notaDebitoElectronica"';
$header .=' xsi:schemaLocation="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/notaDebitoElectronica https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/notaDebitoElectronica.xsd">';

}

$header = str_replace ( '&gt' , '>' ,$header);



 

$otrosCargos = '<OtrosCargos>
<TipoDocumento>01</TipoDocumento>
<NumeroIdentidadTercero>000123456789</NumeroIdentidadTercero>
<NombreTercero>batressc</NombreTercero>
<Detalle>este es el detalle de otros cargos</Detalle>
<Porcentaje>0.00000</Porcentaje>
<MontoCargo>0.00000</MontoCargo>
</OtrosCargos>';


$datosUsario = api_facturacioncontroller2::cargarDatosUsuario($contrasena, $cedula_emisor);



if($datosUsario["tipo_personeria"] == "Fisico"){

  $tipopersoneria = "01";

}elseif($datosUsario["tipo_personeria"] == "Juridico"){

  $tipopersoneria = "02";

}elseif($datosUsario["tipo_personeria"] == "Dimex"){

  $tipopersoneria = "03";

}elseif($datosUsario["tipo_personeria"] == "Nite"){

  $tipopersoneria = "04";

}elseif($datosUsario["tipo_personeria"] == "Pasaporte"){

  $tipopersoneria = "";

}

$cedula_formateada = api_facturacioncontroller2::generarCedula12Digitos ($datosUsario["cedula"]);
$año = date('y');
$mes = date('m');
$dia = date('d');




if($tipeDoc == "01"){

$numUltimoConse = api_facturacioncontroller2::Cargarultimoconsecutivo($id_empresa, $sucursal, $caja);

}else if($tipeDoc == "02"){

$numUltimoConse = api_facturacioncontroller2::CargarultimoconsecutivoND($id_empresa, $sucursal, $caja);

}else if($tipeDoc == "03"){

$numUltimoConse = api_facturacioncontroller2::CargarultimoconsecutivoNC($id_empresa, $sucursal, $caja);

}else if($tipeDoc == "04"){

$numUltimoConse = api_facturacioncontroller2::CargarultimoconsecutivoTE($id_empresa, $sucursal, $caja);

}





if($numUltimoConse[0] == "" || $numUltimoConse[0] == false || $numUltimoConse[0] == "false"){

$ultimoconse = 1;

}else{


$ultimoconse = $numUltimoConse[0] + 1;


}



$numero = $ultimoconse;

$cantCeros = 3;
$sucursal1 = substr(str_repeat(0, $cantCeros).$sucursal, - $cantCeros);

$cantCeros = 5;
$puntoVenta = substr(str_repeat(0, $cantCeros).$caja, - $cantCeros);

$cantCeros = 10;
$numero1 = substr(str_repeat(0, $cantCeros).$numero, - $cantCeros);

$cantCeros = 8;
$numero2 = substr(str_repeat(0, $cantCeros).$numero, - $cantCeros);

$consecutivo_hacienda = $sucursal1.$puntoVenta.$tipeDoc.$numero1;
$clave_hacienda = '506'.$dia.$mes.$año.$cedula_formateada.$consecutivo_hacienda.'1'.$numero2;

    date_default_timezone_set('America/Costa_Rica');

$fecha_creacion_factura = date('Y-m-d h:i:s');
$fecha_creacion = date('Y-m-d h:i:s');
$cancelado = 0;
$id_compania = $id_empresa;



/*=============================================
=      GUARDAR DATOS DE LA FACTURA           =
=============================================*/

$IdFactura = api_facturacioncontroller2::GuardarDatosFactura($id_compania, $sucursal, $caja, $fecha_creacion_factura, $fecha_creacion, $cancelado, $consecutivo_hacienda, $clave_hacienda, $tipeDoc, $actividaEconomica,$condicionVenta, $cedula, $nombre , $correo , $tipoCambio, $moneda);


 
if($tipeDoc == "01"){

$insertConse = api_facturacioncontroller2::Insertarultimoconsecutivo($id_empresa, $IdFactura, $ultimoconse, $sucursal, $caja);

}else if($tipeDoc == "02"){

$insertConse = api_facturacioncontroller2::InsertarultimoconsecutivoND($id_empresa, $IdFactura, $ultimoconse, $sucursal, $caja);

}else if($tipeDoc == "03"){

$insertConse = api_facturacioncontroller2::InsertarultimoconsecutivoNC($id_empresa, $IdFactura, $ultimoconse, $sucursal, $caja);

}else if($tipeDoc == "04"){

$insertConse = api_facturacioncontroller2::InsertarultimoconsecutivoTE($id_empresa, $IdFactura, $ultimoconse, $sucursal, $caja);

}


$archivo_XML = '<?xml version="1.0" encoding="utf-8"?>'."\n";

$archivo_XML .= '<'.$tipo_documento.' '.$header.'
    <Clave>'.$clave_hacienda.'</Clave>
    <CodigoActividad>'.$actividaEconomica.'</CodigoActividad>
    <NumeroConsecutivo>'.$consecutivo_hacienda.'</NumeroConsecutivo>
<FechaEmision>'.$fecha_factura.'</FechaEmision>
    <Emisor>
<Nombre>'.$datosUsario["nombre"].'</Nombre>
<Identificacion>
<Tipo>'.$tipopersoneria.'</Tipo>
<Numero>'.$datosUsario["cedula"].'</Numero>
</Identificacion>
<NombreComercial>'.$datosUsario["nombre"].'</NombreComercial>
<Ubicacion>
<Provincia>'.$datosUsario["provincia"].'</Provincia>
<Canton>'.$datosUsario["canton"].'</Canton>
<Distrito>0'.$datosUsario["distrito"].'</Distrito>
<Barrio>01</Barrio>
<OtrasSenas>'.$datosUsario["direccion"].'</OtrasSenas>
</Ubicacion>
<Telefono>
<CodigoPais>506</CodigoPais>
<NumTelefono>'.$datosUsario["telefono"].'</NumTelefono>
</Telefono>
<CorreoElectronico>'.$datosUsario["email"].'</CorreoElectronico>
    </Emisor>
    <Receptor>
<Nombre>'.$nombre.'</Nombre>
<Identificacion>
<Tipo>'.$tipo_cedula.'</Tipo>
<Numero>'.$cedula.'</Numero>
</Identificacion>
<Ubicacion>
<Provincia>'.$provincia.'</Provincia>
<Canton>'.$canton.'</Canton>
<Distrito>'.$distrito.'</Distrito>
<OtrasSenas>'.$senas.'</OtrasSenas>
</Ubicacion>
<Telefono>
<CodigoPais>506</CodigoPais>
<NumTelefono>'.$telefono.'</NumTelefono>
</Telefono>
<CorreoElectronico>'.$correo.'</CorreoElectronico>
 </Receptor>
  <CondicionVenta>'.$condicionVenta.'</CondicionVenta>
  <PlazoCredito>0</PlazoCredito>
  <MedioPago>'.$mediopago.'</MedioPago>
  <DetalleServicio>'."\n";


/*=============================================
=          DATOS DETALLE  FACTURA            =
=============================================*/


$detalle_factura_items = "";
$detalle_factura_impuesto_exonerado = "";
$contador = 1;

$total_factura = 0;
$total_exento = 0;
$total_gravado = 0;
$total_impuesto = 0;
$total_descuento = 0;
$subtotal_factura_new = 0;
$total_exento_new = 0;
$total_gravado_new = 0;
$total_impuesto_new = 0;
$total_descuento_new = 0;
$tasa_impuesto = 0;
$MercanciasGravadas = 0;
$MercanciasExentas = 0;
$ServiciosGrabados = 0;
$ServiciosExentos = 0;
$TotalMercanciasGravadas = 0;
$TotalMercanciasExentas = 0;
$TotalServiciosGrabados = 0;
$TotalServiciosExentos = 0;
$total_exento = 0;
$total_gravado = 0;
$TotalComprobante = 0;
$TotalVentaNeta = 0;
$unidadMedida = array ();
$medidas = api_facturacioncontroller2::cargarUidadMedida();


/*=============================================
= LLENAR DINAMICAMENTE LAS UNIDADES DE MEDIDA =
=============================================*/

foreach ($medidas as $key => $value) {

array_push($unidadMedida, $value[1]);

}


foreach ($json_cliente["fileContent"]["datosFactura"]["detalleFactura"] as $key => $value) {

$total_linea = 0;
$total_impuesto = 0;
$total_descuento = 0;
$cantidadDetalle =0;
$precioUnitario = 0;
$montoDescuento = 0;
$montoIVA = 0;
$precio_bruto = 0;
$precio_neto = 0;
$costo = 0;

$detalle_factura_impuesto_exonerado = '<Exoneracion>
<TipoDocumento>01</TipoDocumento>
<NumeroDocumento>BA3-21444-03</NumeroDocumento>
<NombreInstitucion>Ba3 Software Corporation</NombreInstitucion>
<FechaEmision>2021-07-27T9:33:00-06:00</FechaEmision>
<PorcentajeExoneracion>1</PorcentajeExoneracion>
<MontoExoneracion>0.00000</MontoExoneracion>
</Exoneracion>';


$precioUnitario = floatval(str_replace ( '"' , '' ,json_encode($value["precioUnitario"])));
$cantidadDetalle = intval(str_replace ( '"' , '' ,json_encode($value["cantidad"])));
$montoDescuento = floatval(str_replace ( '"' , '' ,json_encode($value["descuento"])));


$precio_bruto = $precioUnitario * $cantidadDetalle;
$precio_bruto = str_replace ( ',' , '' ,number_format($precio_bruto , 5 ));

$precio_neto = $precio_bruto - $montoDescuento ;
$precio_neto = str_replace ( ',' , '' ,number_format($precio_neto , 5 ));

if(floatval(str_replace ( '"' , '' ,json_encode($value["tasaImpuesto"]))) == 0 ){


$total_linea = floatval($precio_bruto) - floatval($montoDescuento);


if(in_array( str_replace ( '"' , '' ,json_encode($value["unidadMedida"])) , $unidadMedida , true )){

$ServiciosExentos = $precio_bruto;

}else{

$MercanciasExentas = $precio_bruto;

}




}else{

if(in_array( str_replace ( '"' , '' ,json_encode($value["unidadMedida"])) , $unidadMedida , true )){

$ServiciosGrabados = $precio_bruto;

}else{

$MercanciasGravadas = $precio_bruto;

}


$tasa_impuesto = floatval(str_replace ( '"' , '' ,json_encode($value["tasaImpuesto"])));
$porcentaje_iva = floatval($tasa_impuesto) / 100;
$total_impuesto = floatval($precio_neto) * floatval($porcentaje_iva);
$total_gravado = floatval($precio_bruto);
$total_linea = floatval($precio_neto) + floatval($total_impuesto);

}

$total_linea = str_replace ( ',' , '' ,number_format($total_linea , 5 ));
$total_gravado = str_replace ( ',' , '' ,number_format($total_gravado , 5 ));
$total_impuesto = str_replace ( ',' , '' ,number_format($total_impuesto , 5 ));
$precioUnitario = str_replace ( ',' , '' ,number_format($precioUnitario , 5 ));
$montoDescuento = str_replace ( ',' , '' ,number_format($montoDescuento , 5 ));
$precio_bruto = str_replace ( ',' , '' ,number_format($precio_bruto , 5 ));
$precio_neto = str_replace ( ',' , '' ,number_format($precio_neto , 5 ));
$tasa_impuesto = str_replace ( ',' , '' ,number_format($tasa_impuesto , 4));

// <ImpuestoNeto>0.00000</ImpuestoNeto>

$archivo_XML .=  '   <LineaDetalle>
      <NumeroLinea>'.$contador.'</NumeroLinea>
      <Codigo>'.str_replace ( '"' , '' ,json_encode($value["cabys"])).'</Codigo>
      <CodigoComercial>
      <Tipo>'.str_replace ( '"' , '' ,json_encode($value["tipoCodigoProducto"])).'</Tipo>
      <Codigo>'.str_replace ( '"' , '' ,json_encode($value["Codigo"])).'</Codigo>
      </CodigoComercial>
      <Cantidad>'.$cantidadDetalle.'</Cantidad>
      <UnidadMedida>'.str_replace ( '"' , '' ,json_encode($value["unidadMedida"])).'</UnidadMedida>
      <Detalle>'.str_replace ( '"' , '' ,json_encode($value["descripcionProducto"])).'</Detalle>
      <PrecioUnitario>'.$precioUnitario.'</PrecioUnitario>
      <MontoTotal>'.$precio_bruto.'</MontoTotal>
      <Descuento>
        <MontoDescuento>'.$montoDescuento.'</MontoDescuento>
        <NaturalezaDescuento>'.str_replace ( '"' , '' ,json_encode($value["motivoDescuento"])).'</NaturalezaDescuento>
      </Descuento>
      <SubTotal>'.$precio_neto.'</SubTotal>';  

      if($tasa_impuesto == 0 || $tasa_impuesto == ""){

      }else{

  $archivo_XML .='
        <Impuesto>
        <Codigo>'.str_replace ( '"' , '' ,json_encode($value["tipoImpuesto"])).'</Codigo>
        <CodigoTarifa>'.str_replace ( '"' , '' ,json_encode($value["codTasaImpuesto"])).'</CodigoTarifa>
        <Tarifa>'.str_replace ( '"' , '' ,json_encode($value["tasaImpuesto"])).'</Tarifa>
        <Monto>'.$total_impuesto.'</Monto>
        </Impuesto>';
      }       
      $archivo_XML .='
      <MontoTotalLinea>'.$total_linea.'</MontoTotalLinea>
    </LineaDetalle>'."\n";

if($contador > 1){

$total_impuesto_new = floatval($total_impuesto_new) + floatval($total_impuesto);
$total_descuento_new = floatval($total_descuento_new) + floatval($montoDescuento);
$TotalMercanciasGravadas = floatval($TotalMercanciasGravadas) + floatval($MercanciasGravadas);
$TotalMercanciasExentas = floatval($TotalMercanciasExentas) + floatval($MercanciasExentas);
$TotalServiciosGrabados = floatval($TotalServiciosGrabados) + floatval($ServiciosGrabados);
$TotalServiciosExentos = floatval($TotalServiciosExentos) + floatval($ServiciosExentos);

}else{

$total_impuesto_new =  floatval($total_impuesto);
$total_descuento_new =  floatval($montoDescuento);
$TotalMercanciasGravadas = floatval($MercanciasGravadas);
$TotalMercanciasExentas = floatval($MercanciasExentas);
$TotalServiciosGrabados = floatval($ServiciosGrabados);
$TotalServiciosExentos = floatval($ServiciosExentos);

}


$codigo = str_replace ( '"' , '' ,json_encode($value["Codigo"]));
$nombre = str_replace ( '"' , '' ,json_encode($value["descripcionProducto"]));
$cantidad = intval($cantidadDetalle);
$precio_unidad = floatval($precioUnitario);
$subtotal = floatval($precio_neto);
$descuento = floatval($montoDescuento);
$impuesto = floatval($total_impuesto);
$total = floatval($total_linea);

if(str_replace ( '"' , '' ,json_encode($value["costo"])) != ""){

    $costo = floatval(str_replace ( '"' , '' ,json_encode($value["costo"])));

}


$DetalleFactura = api_facturacioncontroller2::GuardarDetalleFactura($IdFactura, $codigo, $nombre, $cantidad, $precio_unidad, $subtotal, $descuento, $impuesto, $total, $costo);


$contador = $contador  + 1;


}/* FIN DEL METODO QUE RECORRE EL DETALLE DE LAS FACTURAS */


/*=============================================
=      CALCULO TOTALES DE LA FACTURA            =
=============================================*/


$total_exento = floatval($TotalMercanciasExentas) + floatval($TotalServiciosExentos);
$total_gravado = floatval($TotalServiciosGrabados) + floatval($TotalMercanciasGravadas);

$total_factura = floatval($total_exento) + floatval($total_gravado);

$TotalVentaNeta = floatval($total_factura) - floatval($total_descuento_new);

$TotalComprobante = floatval($TotalVentaNeta) + floatval($total_impuesto_new);


$TotalMercanciasGravadas = str_replace ( ',' , '' ,number_format($TotalMercanciasGravadas , 5 ));

$TotalMercanciasExentas = str_replace ( ',' , '' ,number_format($TotalMercanciasExentas , 5 ));

$TotalServiciosGrabados = str_replace ( ',' , '' ,number_format($TotalServiciosGrabados , 5 ));

$TotalServiciosExentos = str_replace ( ',' , '' ,number_format($TotalServiciosExentos , 5 ));

$total_exento = str_replace ( ',' , '' ,number_format($total_exento , 5 ));

$total_gravado = str_replace ( ',' , '' ,number_format($total_gravado , 5 ));

$total_impuesto_new = str_replace ( ',' , '' ,number_format($total_impuesto_new , 5 ));

$total_descuento_new = str_replace ( ',' , '' ,number_format($total_descuento_new , 5 ));

$total_factura = str_replace ( ',' , '' ,number_format($total_factura , 5 ));

$TotalVentaNeta = str_replace ( ',' , '' ,number_format($TotalVentaNeta , 5 ));

$TotalComprobante = str_replace ( ',' , '' ,number_format($TotalComprobante , 5 ));

$otros_cargos = 0;

$ModificarDatos = api_facturacioncontroller2::ModificarDatosFactura($TotalVentaNeta, $total_descuento_new, $total_impuesto_new, $otros_cargos, $TotalComprobante, $IdFactura);

// <TotalServExonerado>0.00000</TotalServExonerado>
// <TotalExonerado>0.00000</TotalExonerado>
// <TotalMercExonerada>0.00000</TotalMercExonerada>
// <TotalIVADevuelto>0.00000</TotalIVADevuelto>
// <TotalOtrosCargos>0.00000</TotalOtrosCargos>

$archivo_XML .= '  </DetalleServicio>
  <ResumenFactura>
    <CodigoTipoMoneda>
<CodigoMoneda>'.$moneda.'</CodigoMoneda>
<TipoCambio>'.$tipoCambio.'</TipoCambio>
</CodigoTipoMoneda>
    <TotalServGravados>'.$TotalServiciosGrabados.'</TotalServGravados>
    <TotalServExentos>'.$TotalServiciosExentos.'</TotalServExentos>
    <TotalMercanciasGravadas>'.$TotalMercanciasGravadas.'</TotalMercanciasGravadas>
    <TotalMercanciasExentas>'.$TotalMercanciasExentas.'</TotalMercanciasExentas>   
    <TotalGravado>'.$total_gravado.'</TotalGravado>
    <TotalExento>'.$total_exento.'</TotalExento>
    <TotalVenta>'.$total_factura.'</TotalVenta>
    <TotalDescuentos>'.$total_descuento_new.'</TotalDescuentos>
    <TotalVentaNeta>'.$TotalVentaNeta.'</TotalVentaNeta>
    <TotalImpuesto>'.$total_impuesto_new.'</TotalImpuesto>
    <TotalComprobante>'.$TotalComprobante.'</TotalComprobante>
  </ResumenFactura>';

  if($tipeDoc == "03" || $tipeDoc == "02"){

$documentoReferencia = $json_cliente["fileContent"]["refenciaNota"]["tipoDoc"];
$claveReferencia = $json_cliente["fileContent"]["refenciaNota"]["clave"];
$fechaEmision = $json_cliente["fileContent"]["refenciaNota"]["fechaEmision"];
$horaEmision = $json_cliente["fileContent"]["refenciaNota"]["horaEmision"];
$codigo = $json_cliente["fileContent"]["refenciaNota"]["codigo"];
$razon = $json_cliente["fileContent"]["refenciaNota"]["razon"];

$archivo_XML .=  '   
  <InformacionReferencia>
    <TipoDoc>'.$documentoReferencia.'</TipoDoc>
    <Numero>'.$claveReferencia.'</Numero>
    <FechaEmision>'.$fechaEmision.'T'.$horaEmision.'-06:00</FechaEmision>
    <Codigo>'.$codigo.'</Codigo>
    <Razon>'.$razon.'</Razon>
  </InformacionReferencia>';

  }else{


  }

$archivo_XML .= '</'.$tipo_documento.'>';


$dom = new  DomDocument();
$dom ->preseveWhiteSpace = FALSE ;
$dom -> loadXML($archivo_XML);
$dom -> save('../apiHacienda/clientes/'.$idcliente.'/Documentos/documento'.$clave_hacienda.'.xml');


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
$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/Documentos/documento'.$clave_hacienda.'.xml';
$localfile = '../apiHacienda/clientes/'.$idcliente.'/Documentos/documento'.$clave_hacienda.'.xml';

 ssh2_scp_send($connection, $localfile, $remotefile, 0644);

ssh2_exec($connection, 'exit');

return $archivo_XML;


}



    public function EnviarCorreo($clave, $idcliente){


$datosFac = api_facturacioncontroller2::CargarDatosFactura($clave);


            //Load Composer's autoloader
            // require 'vendor/autoload.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                // $mail->SMTPDebug = 2;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.digitalsat-cr.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'dsalazar@digitalsat-cr.com';                     //SMTP username
                $mail->Password   = 'salazar123456';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('dsalazar@digitalsat-cr.com', '');
                $mail->addAddress($datosFac[0][14], $datosFac[0][13]);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                $mail->addAttachment('../apiHacienda/clientes/'.$idcliente.'/DocumentosFirmados/documento'.$clave.'.xml','Factura.xml');         //Add attachments
                $mail->addAttachment('../apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf', 'Factura.pdf');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'prueba envio';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
               
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }





    }



    public function GuardarDatosFactura($id_compania, $sucursal, $caja, $fecha_factura, $fecha_creacion, $cancelado, $consecutivo_hacienda, $clave_hacienda, $tipeDoc, $actividaEconomica,$condicionVenta, $cedula, $nombre , $correo , $tipoCambio, $moneda){

        $table = 'empresas.tbl_sistema_facturacion_facturas';

        $id_compania = intval($id_compania);
        $sucursal = strval($sucursal);
        $consecutivo_hacienda = strval($consecutivo_hacienda);
        $clave_hacienda = strval($clave_hacienda);
        $tipeDoc = strval($tipeDoc);
        $actividaEconomica = strval($actividaEconomica);
        $condicionVenta = strval($condicionVenta);
        $cedula = strval($cedula);
        $nombre = strval($nombre);
        $correo = strval($correo);
        $tipoCambio = strval($tipoCambio);
        $moneda = strval($moneda);




 echo '{"RETURN ":DATA: '.$moneda .'}';

 return;



       $insertFactura = api_facturacionModel2::MdlInsertarDatosFactura($table, $id_compania, $sucursal, $caja, $fecha_factura, $fecha_creacion, $cancelado, $consecutivo_hacienda, $clave_hacienda, $tipeDoc, $actividaEconomica,$condicionVenta, $cedula, $nombre , $correo , $tipoCambio, $moneda);


 
       return $insertFactura;

        }



    public function ModificarDatosFactura($TotalVentaNeta, $total_descuento_new, $total_impuesto_new, $otros_cargos, $TotalComprobante, $IdFactura){


        $table = 'empresas.tbl_sistema_facturacion_facturas';


       $ModificarFactura = api_facturacionModel2::MdlModificarDatosFactura($table, $TotalVentaNeta, $total_descuento_new, $total_impuesto_new, $otros_cargos, $TotalComprobante, $IdFactura);
 
     return $ModificarFactura;

        }


   public function GuardarDetalleFactura($IdFactura, $codigo, $nombre, $cantidad, $precio_unidad, $subtotal, $descuento, $impuesto, $total, $costo){

        $table = 'empresas.tbl_sistema_facturacion_detalle_facturas';

        $insertDetalleFactura = api_facturacionModel2::MdlInsertarDetalleFactura($table, $IdFactura, $codigo, $nombre, $cantidad, $precio_unidad, $subtotal, $descuento, $impuesto, $total, $costo);

        }
    
    public function Cargarultimoconsecutivo($id_empresa, $sucursal, $caja){

        $table = 'empresas.tbl_ultimo_consecutivo_sucursal_'.$id_empresa;

        $Cargarconsecutivo = api_facturacionModel2:: MdlcargarUltimoConsecutivo($table, $sucursal, $caja);

        return $Cargarconsecutivo;

        }

            public function CargarultimoconsecutivoTE($id_empresa, $sucursal, $caja){

        $table = 'empresas.tbl_ultimo_consecutivo_te_sucursal_'.$id_empresa;

        $Cargarconsecutivo = api_facturacionModel2:: MdlcargarUltimoConsecutivo($table, $sucursal, $caja);

        return $Cargarconsecutivo;

        }

            public function CargarultimoconsecutivoNC($id_empresa, $sucursal, $caja){

        $table = 'empresas.tbl_ultimo_consecutivo_nc_sucursal_'.$id_empresa;

        $Cargarconsecutivo = api_facturacionModel2:: MdlcargarUltimoConsecutivo($table, $sucursal, $caja);

        return $Cargarconsecutivo;

        }

            public function CargarultimoconsecutivoND($id_empresa, $sucursal, $caja){

        $table = 'empresas.tbl_ultimo_consecutivo_nd_sucursal_'.$id_empresa;

        $Cargarconsecutivo = api_facturacionModel2:: MdlcargarUltimoConsecutivo($table, $sucursal, $caja);

        return $Cargarconsecutivo;

        } 


    public function Insertarultimoconsecutivo($id_empresa, $id_factura, $ultimo_consecutivo, $sucursal, $caja){

        $table = 'empresas.tbl_ultimo_consecutivo_sucursal_'.$id_empresa;

        $insertarconsecutivo = api_facturacionModel2:: MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja);
    

        }


        public function InsertarultimoconsecutivoTE($id_empresa, $id_factura, $ultimo_consecutivo, $sucursal, $caja){

        $table = 'empresas.tbl_ultimo_consecutivo_te_sucursal_'.$id_empresa;

        $insertarconsecutivo = api_facturacionModel2:: MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja);
    

        }


            public function InsertarultimoconsecutivoNC($id_empresa, $id_factura, $ultimo_consecutivo, $sucursal, $caja){

        $table = 'empresas.tbl_ultimo_consecutivo_nc_sucursal_'.$id_empresa;

        $insertarconsecutivo = api_facturacionModel2:: MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja);
    

        }


            public function InsertarultimoconsecutivoND($id_empresa, $id_factura, $ultimo_consecutivo, $sucursal, $caja){

        $table = 'empresas.tbl_ultimo_consecutivo_nd_sucursal_'.$id_empresa;

        $insertarconsecutivo = api_facturacionModel2:: MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja);
    

        }


    public function CargarDatosFactura($clave){

        $table = 'empresas.tbl_sistema_facturacion_facturas';

        $factura = api_facturacionModel2:: MdlCargarDatosFactura($table, $clave);
    
        return $factura;

        }


    public function CargarDetalleFactura($id_factura){

        $table = 'empresas.tbl_sistema_facturacion_detalle_facturas';

        $Detallefactura = api_facturacionModel2:: MdlCargarDetalleFactura($table, $id_factura);
    
        return $Detallefactura;

        }

    public function CargarDatosEmpresa($id_empresa){

        $table = 'empresas.tbl_clientes';

        $DatosEmpresa = api_facturacionModel2:: MdlcargarDatosEmpresa($table, $id_empresa);
    
        return $DatosEmpresa;

        }







}
   

$pool->add(new api_facturacioncontroller2(generarDocs));