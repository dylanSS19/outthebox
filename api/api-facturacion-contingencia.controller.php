<?php

require_once ("../extensions/firmarXML/firmar.php");
require_once  ("../models/api-facturacion.model.php");
// require_once  ("../extensions/tcpdf/pdf/comprobante_factura.php");
require_once  ("../extensions/factura/generaFactura.php");

header('Acceess-Control-Allow-Origin: *');

switch ($_SERVER['REQUEST_METHOD']) {

  case 'GET':
      
 
    break;


  case 'PUT':
    
 
    break;

    
  case 'POST':


$data = json_decode(file_get_contents('php://input'), true);


/*=============================================
= VALIDAR QUE LA ESTRUCTURA DE LOS DATOS RECIVIDOS
  ES UN JSON                                    =
 =============================================*/

if (api_facturacioncontroller::is_json(json_encode($data["fileContent"])) == "true"){

$validarDatosJson = api_facturacioncontroller::ValidarNodosJson($data);


$usuario = $data["fileContent"]["datosEmisor"]["usuario"];

$contrasena = $data["fileContent"]["datosEmisor"]["password"];

$cedula = $data["fileContent"]["datosEmisor"]["cedula"];


$validacionCredenciales = api_facturacioncontroller::validarCredencialesUsuario($usuario, $contrasena, $cedula);

      if($validacionCredenciales[0] == 1){
       
      $validacion = api_facturacioncontroller::ValidarCajaSucursal($data); 

      $datosUsario = api_facturacioncontroller::cargarDatosUsuario($contrasena, $cedula);


    date_default_timezone_set('America/Costa_Rica');

    $fecha_emision_factura = date('Y-m-d');
    $hora_emision_factura = date('H:i:s');

    $fecha_factura = ''.$fecha_emision_factura.'T'.$hora_emision_factura.'-06:00';
      $fecha_factura_2 = ''.$fecha_emision_factura.'T'.$hora_emision_factura.'-0600';

      /*=============================================
      =  GENERAR EL XML PARA FIRMAR                =
       =============================================*/
      $xml_factura = api_facturacioncontroller::GenerarXML($data,$fecha_factura,$datosUsario["idtbl_clientes"]);
          
     $xml_capturar = $xml_factura;

    /*=============================================
      = ACCESAR AL XML Y EXTRAER DATOS DEL MISMO    =
       =============================================*/

        $xmlparser = xml_parser_create();

        xml_parse_into_struct($xmlparser,$xml_capturar,$values);
       
        xml_parser_free($xmlparser);

  $tipo_Cedula_receptor = $data["fileContent"]["datosReceptor"]["tipoCedula"];

  if ($tipo_Cedula_receptor == "" || $tipo_Cedula_receptor == "Pasaporte" || $tipo_Cedula_receptor == "pasaporte"){

        $clave = $values[1]["value"];
        $consecutivo = $values[5]["value"];
        $cedula_receptor = $values[49]["value"];
        $tipo_cedula_emisor = $values[13]["value"];
        $cedula_emisor = $values[15]["value"];

  }else{

        $clave = $values[1]["value"];
        $consecutivo = $values[5]["value"];
        $cedula_receptor = $values[51]["value"];
        $tipo_cedula_emisor = $values[13]["value"];
        $cedula_emisor = $values[15]["value"];


  }

        
  /*=============================================
  =             RESPUESTA DEL API              =
  =============================================*/
 
        header("HTTP/1.1 200 OK");
    echo '{"success": "true", "Clave":"'.$clave.'", "Consecutivo":"'.$consecutivo.'"}';

      }else{


        header("HTTP/1.1 400 Bad Request");

      echo '{"success": "false", "reason": "CREDENCIALES INCORRECTAS"}';

      
      }

}else{

header("HTTP/1.1 403 Bad Request");
echo '{"success": "false", "reason": "Error el archivo no cuenta con el formato Json correcto."}';


}

    break;
  
  default:
    
}


 

class api_facturacioncontroller{

    public static function cargarDatosUsuario($contrasena, $cedula) {
   
  $table = "empresas.tbl_clientes";  

  $response = api_facturacionModel::MdlcargarDatosUsuario($table, $contrasena, $cedula);


    return $response;

}

    public static function validarCredencialesUsuario($usuario, $contrasena, $cedula) {

   
  $table = "empresas.tbl_clientes";  

  $response = api_facturacionModel::MdlValidarCredencialesUsuarios ($table, $usuario, $contrasena, $cedula);


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

  $response = api_facturacionModel::MdlcargarUidadMedida($table);

    return $response;

}

public static function GenerarToken($user, $contrasena){
  

     // $data = "client_id=api-prod&username=".$user."&password=".urlencode($contrasena)."&grant_type=password";

     $data = "client_id=api-stag&username=".$user."&password=".urlencode($contrasena)."&grant_type=password"; 
    
     $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut-stag/protocol/openid-connect/token"); //ambiente pruebas

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded; charset=utf-8'));
       
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
     
        $response = curl_exec($ch);
    
    $response_info = curl_getinfo($ch);



        curl_close($ch);

        return $response;
            
  }
 

public static function EnviarApiFacturas($token, $archivo_formado, $clave, $cedula_receptor, $fecha_factura_2, $tipo_cedula_emisor, $cedula_emisor){
    

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

   $ch = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/recepcion"); //ambiente sandbox

    // $ch = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion/v1/recepcion");

          //URL de Produccion http://wcf.facturoporti.com.mx/Timbrado/Servicios.svc/ApiTimbrarCFDI
         //curl_setopt($ch, CURLOPT_URL, "http://posfacturar.com/pos_digitalsat/public/api/v5/sale/add");
        //a true, obtendremos una respuesta de la url, en otro caso,
       //true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Se define el tipo de metodo de envio de datos
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' , $authorization));
        //establecemos el verbo http que queremos utilizar para la petici??n
       
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //enviamos el array data

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS,$json_factura);
        //obtenemos la respuesta
        $response = curl_exec($ch);
        
        $response_info = curl_getinfo($ch);

        $err = curl_error($ch);

        // Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($ch);

        if($response_info["http_code"] == 202 || $response_info["http_code"] == 200){


        }else{

         $mdlestado = api_facturacioncontroller::ModificarEstadoFactura($clave);

        }


        if ($err) {

          return "Error #:" . $err;

        } else {

          return $response;

        }
            
  }


  public static function  generarCedula12Digitos ($NumCedula){

  $length = 12;
  $string = substr(str_repeat(0, $length).$NumCedula, - $length);

      return  $string;
  }


public static function GenerarXML($json_cliente, $fecha_factura, $idcliente){

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
  $TiposPago = explode(',', $mediopago);
  $api = $json_cliente["fileContent"]["datosFactura"]["api"];

  if(!isset($json_cliente["fileContent"]["datosFactura"]["comentario"])){

    $comentarioFact = "";

  }else{

    $comentarioFact = $json_cliente["fileContent"]["datosFactura"]["comentario"];

  }


  /*=============================================
  =          DATOS DETALLE  FACTURA            =
  =============================================*/

  if($tipeDoc == "03"){

  $estadoAnulacion = $json_cliente["fileContent"]["datosFactura"]["estadoAnulacion"];

  $clvRefencia = $json_cliente["fileContent"]["refenciaNota"]["clave"];

  $Anulacion = api_facturacioncontroller::ModificarEstadoAnulacion($clvRefencia, $estadoAnulacion);
  }else{

  $clvRefencia = "";

  }


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


  $datosUsario = api_facturacioncontroller::cargarDatosUsuario($contrasena, $cedula_emisor);

  if($datosUsario["tipo_personeria"] == "Fisico"){

    $tipopersoneria = "01";

  }elseif($datosUsario["tipo_personeria"] == "Juridico"){

    $tipopersoneria = "02";

  }elseif($datosUsario["tipo_personeria"] == "Dimex"){

    $tipopersoneria = "03";

  }elseif($datosUsario["tipo_personeria"] == "Nite"){

    $tipopersoneria = "04";

  }elseif($datosUsario["tipo_personeria"] == "Pasaporte" || $datosUsario["tipo_personeria"] == "" ){

    $tipopersoneria = "";

  }

  $cedula_formateada = api_facturacioncontroller::generarCedula12Digitos ($datosUsario["cedula"]);
  $a??o = date('y');
  $mes = date('m');
  $dia = date('d');

  $tipo = "";
  if($tipeDoc == "01"){

    $tipo = "FE";

  }else if($tipeDoc == "02"){

    $tipo = "ND";

  }else if($tipeDoc == "03"){

    $tipo = "NC";

  }else if($tipeDoc == "04"){

  $tipo = "TE";

  }
// $i = 0;

  do {
      
          $numUltimoConse = api_facturacioncontroller::Cargarultimoconsecutivo($id_empresa, $sucursal, $caja, $tipo);

          if($numUltimoConse[0] == "" || $numUltimoConse[0] == false || $numUltimoConse[0] == "false" || $numUltimoConse == ""){

          $ultimoconse = 1;

          }else{

          $ultimoconse = $numUltimoConse[0] + 1;

          }

  $IdFactura = "";

  $ramdon = api_facturacioncontroller::getRandomHex(50);

  $insertConse = api_facturacioncontroller::Insertarultimoconsecutivo($id_empresa, $IdFactura, $ultimoconse, $sucursal, $caja, $ramdon, $tipo);

  // echo "sdxf ".$insertConse;

  } while ($insertConse == "0");


// exit();

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
  $clave_hacienda = '506'.$dia.$mes.$a??o.$cedula_formateada.$consecutivo_hacienda.'1'.$numero2;

    date_default_timezone_set('America/Costa_Rica');

  $fecha_creacion_factura = date('Y-m-d H:i:s');
  $fecha_creacion = date('Y-m-d H:i:s');
  $cancelado = 0;
  $id_compania = $id_empresa;

  if($api == "" || !isset($json_cliente["fileContent"]["datosFactura"]["api"])){
    $api = "Si";
  }else{
    $api = $json_cliente["fileContent"]["datosFactura"]["api"];
  }
 

  $razon=""; 

      /*=============================================
      =      GUARDAR DATOS DE LA FACTURA           =
      =============================================*/

  $IdFactura = api_facturacioncontroller::GuardarDatosFactura($id_compania, $sucursal, $caja, $fecha_creacion_factura, $fecha_creacion, $cancelado, $consecutivo_hacienda, $clave_hacienda, $tipeDoc, $actividaEconomica,$condicionVenta, $cedula, $nombre , $correo , $tipoCambio, $moneda, $tipo_cedula, $plazo, $clvRefencia,$mediopago, $api, $razon, $comentarioFact);

  $insertConse = api_facturacioncontroller::Updateultimoconsecutivo($id_empresa, $IdFactura, $ramdon);

  $nomUser = str_replace ( '"' , '' ,json_encode($datosUsario["nombre"], JSON_UNESCAPED_UNICODE));
  $nomUser = str_replace ( '&' , '&amp;' ,$nomUser);
  $nomUser = str_replace ( '<' , '&lt;' ,$nomUser);
  $nomUser = str_replace ( '>' , '&gt;' ,$nomUser);

  $nomClient = str_replace ( '"' , '' ,json_encode($nombre, JSON_UNESCAPED_UNICODE));
  $nomClient = str_replace ( '&' , '&amp;' ,$nomClient);
  $nomClient = str_replace ( '<' , '&lt;' ,$nomClient);
  $nomClient = str_replace ( '>' , '&gt;' ,$nomClient);

  $cantCeros = 2;
  $canton = substr(str_repeat(0, $cantCeros).$datosUsario["canton"], - $cantCeros);
  $distrito = substr(str_repeat(0, $cantCeros).$datosUsario["distrito"], - $cantCeros);

  $archivo_XML = '<?xml version="1.0" encoding="utf-8"?>'."\n";

$archivo_XML .= '<'.$tipo_documento.' '.$header.'
    <Clave>'.$clave_hacienda.'</Clave>
    <CodigoActividad>'.$actividaEconomica.'</CodigoActividad>
    <NumeroConsecutivo>'.$consecutivo_hacienda.'</NumeroConsecutivo>
<FechaEmision>'.$fecha_factura.'</FechaEmision>
    <Emisor>
<Nombre>'.$nomUser.'</Nombre>
<Identificacion>
<Tipo>'.$tipopersoneria.'</Tipo>
<Numero>'.$datosUsario["cedula"].'</Numero>
</Identificacion>
<NombreComercial>'.$nomUser.'</NombreComercial>
<Ubicacion>
<Provincia>'.$datosUsario["provincia"].'</Provincia>
<Canton>'.$canton.'</Canton>
<Distrito>'.$distrito.'</Distrito>
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
<Nombre>'.$nomClient.'</Nombre>';

    if($tipo_cedula == "" || $tipo_cedula == "Pasaporte" || $tipo_cedula == "pasaporte"){

    // $archivo_XML .='
    // <Identificacion>
    // <Numero>'.$cedula.'</Numero>
    // </Identificacion>'."\n";

    }else{

    $archivo_XML .='
    <Identificacion>
    <Tipo>'.$tipo_cedula.'</Tipo>
    <Numero>'.$cedula.'</Numero>
    </Identificacion>'."\n";

    }


  if($provincia == "" || $provincia == 0){


  }else{

  $archivo_XML .= '<Ubicacion>
  <Provincia>'.$provincia.'</Provincia>
  <Canton>'.$canton.'</Canton>
  <Distrito>'.$distrito.'</Distrito>
  <OtrasSenas>'.$senas.'</OtrasSenas>
  </Ubicacion>'."\n";

  }

  $archivo_XML .= '<Telefono>
  <CodigoPais>506</CodigoPais>
  <NumTelefono>'.$telefono.'</NumTelefono>
  </Telefono>';

  if($correo == "" || $correo == 0){


  }else{

    $archivo_XML .= '<CorreoElectronico>'.$correo.'</CorreoElectronico>';

  }
  $archivo_XML .='</Receptor>
  <CondicionVenta>'.$condicionVenta.'</CondicionVenta>
  <PlazoCredito>0</PlazoCredito>';

  foreach ($TiposPago as $key => $value) {
    if ($key < 3){   
      $archivo_XML .=  '
  <MedioPago>'.$value.'</MedioPago>';
    }

  }

  $archivo_XML .=  '
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
$TotalMercanciasGravadas = 0;
$TotalMercanciasExentas = 0;
$TotalServiciosGrabados = 0;
$TotalServiciosExentos = 0;
$TotalComprobante = 0;
$TotalVentaNeta = 0;
$unidadMedida = array ();
$medidas = api_facturacioncontroller::cargarUidadMedida();


/*=============================================
= LLENAR DINAMICAMENTE LAS UNIDADES DE MEDIDA =
=============================================*/

foreach ($medidas as $key => $value) {

array_push($unidadMedida, $value[1]);

}


foreach ($json_cliente["fileContent"]["datosFactura"]["detalleFactura"] as $key => $value) {

$tasa_impuesto = 0;
$MercanciasGravadas = 0;
$MercanciasExentas = 0;
$ServiciosGrabados = 0;
$ServiciosExentos = 0;
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
$tasa_impuesto = floatval(str_replace ( '"' , '' ,json_encode($value["tasaImpuesto"])));

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
$tasa_impuesto = str_replace ( ',' , '' ,number_format($tasa_impuesto , 5));


// <ImpuestoNeto>0.00000</ImpuestoNeto>

$nomDetalle = str_replace ( '"' , '' ,json_encode($value["descripcionProducto"], JSON_UNESCAPED_UNICODE));
$nomDetalle = str_replace ( '&' , '&amp;' ,$nomDetalle);
$nomDetalle = str_replace ( '<' , '&lt;' ,$nomDetalle);
$nomDetalle = str_replace ( '>' , '&gt;' ,$nomDetalle);

$archivo_XML .=  '   <LineaDetalle>
      <NumeroLinea>'.$contador.'</NumeroLinea>
      <Codigo>'.str_replace ( '"' , '' ,json_encode($value["cabys"])).'</Codigo>
      <CodigoComercial>
      <Tipo>'.str_replace ( '"' , '' ,json_encode($value["tipoCodigoProducto"])).'</Tipo>
      <Codigo>'.str_replace ( '"' , '' ,json_encode($value["Codigo"])).'</Codigo>
      </CodigoComercial>
      <Cantidad>'.$cantidadDetalle.'</Cantidad>
      <UnidadMedida>'.$value["unidadMedida"].'</UnidadMedida>
      <Detalle>'.$nomDetalle.'</Detalle>
      <PrecioUnitario>'.$precioUnitario.'</PrecioUnitario>
      <MontoTotal>'.$precio_bruto.'</MontoTotal>
      <Descuento>
        <MontoDescuento>'.$montoDescuento.'</MontoDescuento>
        <NaturalezaDescuento>'.$value["motivoDescuento"].'</NaturalezaDescuento>
      </Descuento>
      <SubTotal>'.$precio_neto.'</SubTotal>';  
      
      if($tasa_impuesto == 0 || $tasa_impuesto == ""){

      }else{

  $archivo_XML .='
        <Impuesto>
        <Codigo>'.$value["tipoImpuesto"].'</Codigo>
        <CodigoTarifa>'.$value["codTasaImpuesto"].'</CodigoTarifa>
        <Tarifa>'.$tasa_impuesto.'</Tarifa>
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


$codigo = str_replace ( '"' , '' ,$value["Codigo"]);
$nombre = str_replace ( '"' , '' ,$value["descripcionProducto"]);
$cantidad = intval($cantidadDetalle);
$precio_unidad = floatval($precioUnitario);
$subtotal = floatval($precio_neto);
$descuento = floatval($montoDescuento);
$impuesto = floatval($total_impuesto);
$total = floatval($total_linea);
$cabys = str_replace ( '"' , '' ,$value["cabys"]);
$codImpuesto = str_replace ( '"' , '' ,$value["codTasaImpuesto"]);
$cosTasaImp = str_replace ( '"' , '' ,$value["tipoImpuesto"]);
$unidadM = $value["unidadMedida"];
$categoria = $value["categoria"];
if(str_replace ( '"' , '' ,$value["costo"]) != ""){

    $costo = floatval(str_replace ( '"' , '' ,$value["costo"]));

}

 
$DetalleFactura = api_facturacioncontroller::GuardarDetalleFactura($IdFactura, $codigo, $nombre, $cantidad, $precio_unidad, $subtotal, $descuento, $impuesto, $total, $costo, $cabys, $tasa_impuesto, $codImpuesto,$cosTasaImp, $unidadM,$categoria);


$contador = $contador  + 1;

}/* FIN DEL METODO QUE RECORRE EL DETALLE DE LAS FACTURAS */


    /*=============================================
    =      CALCULO TOTALES DE LA FACTURA          =
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

$ModificarDatos = api_facturacioncontroller::ModificarDatosFactura($TotalVentaNeta, $total_descuento_new, $total_impuesto_new, $otros_cargos, $TotalComprobante, $IdFactura);

// <TotalServExonerado>0.00000</TotalServExonerado>
// <TotalExonerado>0.00000</TotalExonerado>
// <TotalMercExonerada>0.00000</TotalMercExonerada>
// <TotalIVADevuelto>0.00000</TotalIVADevuelto>
// <TotalOtrosCargos>0.00000</TotalOtrosCargos>
 

$tipoCambio = str_replace ( ',' , '' ,number_format(floatval($tipoCambio) , 5 ));

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



// echo $archivo_XML;

// exit();

$dom = new  DomDocument();
$dom ->preseveWhiteSpace = FALSE ;
$dom -> loadXML($archivo_XML);
// $dom -> save('../apiHacienda/clientes/'.$idcliente.'/Documentos/documento'.$clave_hacienda.'.xml');


return $archivo_XML;


}

    public static function getRandomHex($num_bytes=4) {

      return bin2hex(openssl_random_pseudo_bytes($num_bytes));
    }

    public static function GuardarDatosFactura($id_compania, $sucursal, $caja, $fecha_factura, $fecha_creacion, $cancelado, $consecutivo_hacienda, $clave_hacienda, $tipeDoc, $actividaEconomica,$condicionVenta, $cedula, $nombre , $correo , $tipoCambio, $moneda, $tipo_cedula, $plazo, $clvRefencia, $mediopago, $api, $razon, $comentarioFact){

        $table = 'empresas.tbl_sistema_facturacion_facturas';
        $estado = "contingencia";
    
   $insertFactura = api_facturacionModel::MdlInsertarDatosFactura($table, $id_compania, $sucursal, $caja, $fecha_factura, $fecha_creacion, $cancelado, $consecutivo_hacienda, $clave_hacienda, $tipeDoc, $actividaEconomica,$condicionVenta, $cedula, $nombre , $correo , $tipoCambio, $moneda, $tipo_cedula, $plazo, $clvRefencia, $mediopago, $api, $razon, $comentarioFact, $estado);
       return $insertFactura;

        }



    public static function ModificarDatosFactura($TotalVentaNeta, $total_descuento_new, $total_impuesto_new, $otros_cargos, $TotalComprobante, $IdFactura){


        $table = 'empresas.tbl_sistema_facturacion_facturas';


       $ModificarFactura = api_facturacionModel::MdlModificarDatosFactura($table, $TotalVentaNeta, $total_descuento_new, $total_impuesto_new, $otros_cargos, $TotalComprobante, $IdFactura);
 
     return $ModificarFactura;

        }


   public static function GuardarDetalleFactura($IdFactura, $codigo, $nombre, $cantidad, $precio_unidad, $subtotal, $descuento, $impuesto, $total, $costo, $cabys, $tasa_impuesto, $codImpuesto, $cosTasaImp, $unidadM,$categoria){

        $table = 'empresas.tbl_sistema_facturacion_detalle_facturas';

        $insertDetalleFactura = api_facturacionModel::MdlInsertarDetalleFactura($table, $IdFactura, $codigo, $nombre, $cantidad, $precio_unidad, $subtotal, $descuento, $impuesto, $total, $costo, $cabys, $tasa_impuesto, $codImpuesto, $cosTasaImp, $unidadM,$categoria);

        }
    
    public static function Cargarultimoconsecutivo($id_empresa, $sucursal, $caja, $tipo){

        $table = 'empresas.tbl_ultimo_consecutivo';

        $Cargarconsecutivo = api_facturacionModel:: MdlcargarUltimoConsecutivo($table, $sucursal, $caja, $tipo, $id_empresa);

        return $Cargarconsecutivo;

        }

        //     public function CargarultimoconsecutivoTE($id_empresa, $sucursal, $caja){

        // $table = 'empresas.tbl_ultimo_consecutivo_tep_sucursal_'.$id_empresa;

        // $Cargarconsecutivo = api_facturacionModel:: MdlcargarUltimoConsecutivo($table, $sucursal, $caja);

        // return $Cargarconsecutivo;

        // }

        //     public function CargarultimoconsecutivoNC($id_empresa, $sucursal, $caja){

        // $table = 'empresas.tbl_ultimo_consecutivo_ncp_sucursal_'.$id_empresa;

        // $Cargarconsecutivo = api_facturacionModel:: MdlcargarUltimoConsecutivo($table, $sucursal, $caja);

        // return $Cargarconsecutivo;

        // }

        //     public function CargarultimoconsecutivoND($id_empresa, $sucursal, $caja){

        // $table = 'empresas.tbl_ultimo_consecutivo_ndp_sucursal_'.$id_empresa;

        // $Cargarconsecutivo = api_facturacionModel:: MdlcargarUltimoConsecutivo($table, $sucursal, $caja);

        // return $Cargarconsecutivo;

        // } 


    public static function Insertarultimoconsecutivo($id_empresa, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random, $tipo){

        $table = 'empresas.tbl_ultimo_consecutivo';

        $insertarconsecutivo = api_facturacionModel:: MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random, $tipo, $id_empresa);
            
            return  $insertarconsecutivo;

        }


        // public function InsertarultimoconsecutivoTE($id_empresa, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random){

        // $table = 'empresas.tbl_ultimo_consecutivo_tep_sucursal_'.$id_empresa;

        // $insertarconsecutivo = api_facturacionModel:: MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random);
        
        // return  $insertarconsecutivo;

        // }


        //     public function InsertarultimoconsecutivoNC($id_empresa, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random){

        // $table = 'empresas.tbl_ultimo_consecutivo_ncp_sucursal_'.$id_empresa;

        // $insertarconsecutivo = api_facturacionModel:: MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random);
        
        //   return  $insertarconsecutivo;

        // }


        //     public function InsertarultimoconsecutivoND($id_empresa, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random){

        // $table = 'empresas.tbl_ultimo_consecutivo_ndp_sucursal_'.$id_empresa;

        // $insertarconsecutivo = api_facturacionModel:: MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random);
    
        //       return  $insertarconsecutivo;
        // }



 public static function Updateultimoconsecutivo($id_empresa, $id_factura, $random){

        $table = 'empresas.tbl_ultimo_consecutivo';

        $insertarconsecutivo = api_facturacionModel:: MdlUpdateconse($table, $id_factura, $random);
    

        }


        // public function UpdateultimoconsecutivoTE($id_empresa, $id_factura, $random){

        // $table = 'empresas.tbl_ultimo_consecutivo_tep_sucursal_'.$id_empresa;

        // $insertarconsecutivo = api_facturacionModel:: MdlUpdateconse($table, $id_factura, $random);
    

        // }


        //     public function UpdateultimoconsecutivoNC($id_empresa, $id_factura, $random){

        // $table = 'empresas.tbl_ultimo_consecutivo_ncp_sucursal_'.$id_empresa;

        // $insertarconsecutivo = api_facturacionModel:: MdlUpdateconse($table, $id_factura, $random);
    

        // }


        //     public function UpdateultimoconsecutivoND($id_empresa, $id_factura, $random){

        // $table = 'empresas.tbl_ultimo_consecutivo_ndp_sucursal_'.$id_empresa;

        // $insertarconsecutivo = api_facturacionModel:: MdlUpdateconse($table, $id_factura, $random);
    

        // }



  public static function CargarDatosFactura($clave){

        $table = 'empresas.tbl_sistema_facturacion_facturas';

        $factura = api_facturacionModel:: MdlCargarDatosFactura($table, $clave);
    
        return $factura;

        }


  public static function CargarDetalleFactura($id_factura){

        $table = 'empresas.tbl_sistema_facturacion_detalle_facturas';

        $Detallefactura = api_facturacionModel:: MdlCargarDetalleFactura($table, $id_factura);
    
        return $Detallefactura;

        }

  public static function CargarDatosEmpresa($id_empresa){

        $table = 'empresas.tbl_clientes';

        $DatosEmpresa = api_facturacionModel:: MdlcargarDatosEmpresa($table, $id_empresa);
    
        return $DatosEmpresa;

        }

  public static function EliminarDatosFactura($clave){

          $table = 'empresas.tbl_sistema_facturacion_facturas';
  
          $DatosEmpresa = api_facturacionModel:: MdlEliminarDatosFactura($table, $clave);
      
          return $DatosEmpresa;
  
          }

  public static function EliminarUltConsecutivo($clave){
      
            $table = 'empresas.tbl_ultimo_consecutivo';
            $table2 = 'empresas.tbl_sistema_facturacion_facturas';
    
            $DatosEmpresa = api_facturacionModel:: MdlEliminarUltConsecutivo($table, $table2, $clave);
        
            return $DatosEmpresa;
    
            }

  public static function ValidarNodosJson($json){


            if(array_key_exists('datosReceptor', $json["fileContent"]) && array_key_exists('datosEmisor', $json["fileContent"]) && array_key_exists('datosFactura', $json["fileContent"])){

             
            }else{

            header("HTTP/1.1 400 Bad Request");
            echo '{"success": "false", "reason": "Error el archivo no cuenta con el formato Json correcto en el indice: fileContent"}';
            
            exit();
            }

            if(array_key_exists('usuario', $json["fileContent"]["datosEmisor"]) && array_key_exists('password', $json["fileContent"]["datosEmisor"]) && array_key_exists('cedula', $json["fileContent"]["datosEmisor"]) && array_key_exists('id_empresa', $json["fileContent"]["datosEmisor"])){

              

            }else{

            header("HTTP/1.1 400 Bad Request");
            echo '{"success": "false", "reason": "Error el archivo no cuenta con el formato Json correcto en el indice: fileContent{datosEmisor}"}';
            
            exit();
            }


            if(array_key_exists('nombre', $json["fileContent"]["datosReceptor"]) && array_key_exists('tipoCedula', $json["fileContent"]["datosReceptor"]) && array_key_exists('cedula', $json["fileContent"]["datosReceptor"]) && array_key_exists('direccion', $json["fileContent"]["datosReceptor"]) && array_key_exists('correo', $json["fileContent"]["datosReceptor"]) && array_key_exists('telefono', $json["fileContent"]["datosReceptor"]) && array_key_exists('provincia', $json["fileContent"]["datosReceptor"]) && array_key_exists('canton', $json["fileContent"]["datosReceptor"])  && array_key_exists('distrito', $json["fileContent"]["datosReceptor"])  && array_key_exists('senas', $json["fileContent"]["datosReceptor"]) ){

             

            }else{

            header("HTTP/1.1 400 Bad Request");
            echo '{"success": "false", "reason": "Error el archivo no cuenta con el formato Json correcto en el indice: fileContent{datosReceptor}"}';
     
            exit();
            }

            if(array_key_exists('sucursal', $json["fileContent"]["datosFactura"]) && array_key_exists('caja', $json["fileContent"]["datosFactura"]) && array_key_exists('tipoDoc', $json["fileContent"]["datosFactura"]) && array_key_exists('moneda', $json["fileContent"]["datosFactura"]) && array_key_exists('tipoCambio', $json["fileContent"]["datosFactura"]) && array_key_exists('plazoCredito', $json["fileContent"]["datosFactura"]) && array_key_exists('medioPago', $json["fileContent"]["datosFactura"]) && array_key_exists('actividadEconomica', $json["fileContent"]["datosFactura"])  && array_key_exists('detalleFactura', $json["fileContent"]["datosFactura"]) && array_key_exists('api', $json["fileContent"]["datosFactura"]) && array_key_exists('estadoAnulacion', $json["fileContent"]["datosFactura"]) && array_key_exists('comentario', $json["fileContent"]["datosFactura"])){

         

            }else{

            header("HTTP/1.1 400 Bad Request");
            echo '{"success": "false", "reason": "Error el archivo no cuenta con el formato Json correcto en el indice: fileContent{datosFactura}"}';
            
            exit();
            }


            foreach ($json["fileContent"]["datosFactura"]["detalleFactura"] as $key => $value) {

            if(array_key_exists('numeroLinea', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('cabys', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('unidadMedida', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('tipoCodigoProducto', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('Codigo', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('descripcionProducto', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('cantidad', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('precioUnitario', $json["fileContent"]["datosFactura"]["detalleFactura"][$key])  && array_key_exists('costo', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('descuento', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('motivoDescuento', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('subTotal', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('totalDetalle', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('totalDetalle', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('tipoImpuesto', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('codTasaImpuesto', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('tasaImpuesto', $json["fileContent"]["datosFactura"]["detalleFactura"][$key]) && array_key_exists('montoImpuesto', $json["fileContent"]["datosFactura"]["detalleFactura"][$key])){

      

            }else{


            header("HTTP/1.1 400 Bad Request");

            echo '{"success": "false", "reason": "Error el archivo no cuenta con el formato Json correcto en el indice: fileContent{datosFactura:[detalleFactura]}"}';
           
            exit();

            }



            }


    }


  public static function ValidarCajaSucursal($json){

    $caja = $json["fileContent"]["datosFactura"]["caja"];

    $sucursal = $json["fileContent"]["datosFactura"]["sucursal"];

    $id_empresa = $json["fileContent"]["datosEmisor"]["id_empresa"];


    $table = "empresas.tbl_sucursal_".$id_empresa;

        $respuestaS = api_facturacionModel::MdlValidarSucursal($table, $sucursal);

        if(!$respuestaS){

                    header("HTTP/1.1 400 Bad Request");
                    echo '{"success": "false", "reason": "Datos de la Sucursal no existentes en sistema."}';
                    exit();

        }else{


            $table = "empresas.tbl_cajas_".$id_empresa;

            $idsucursal = $respuestaS["idtbl_sucursal"];

            $respuestaS = api_facturacionModel::MdlValidarCaja($table, $caja, $idsucursal);



            if(!$respuestaS){

                    header("HTTP/1.1 400 Bad Request");
                     echo '{"success": "false", "reason": "Datos de la caja no ligados a la sucursal o datos no existentes"}';
            
                    exit();


            }else{



            }

        }

  }


    public static function ModificarEstadoFactura($clave){

        $table = 'empresas.tbl_sistema_facturacion_facturas';

        $DatosEmpresa = api_facturacionModel::MdlModificarEstadoFactura($table, $clave);
    
        return $DatosEmpresa;

    }


    public static function GuardarXmlFirmado($clave, $xml){

        $table = 'empresas.tbl_sistema_facturacion_facturas';

        $DatosEmpresa = api_facturacionModel::MdlGuardarXmlFirmado($table, $clave, $xml);
    
        return $DatosEmpresa;

    }


    public static function ModificarEstadoAnulacion($clave, $estadoAnulacion){

        $table = 'empresas.tbl_sistema_facturacion_facturas';

        $DatosEmpresa = api_facturacionModel::MdlModificarEstadoAnulacion($table, $clave, $estadoAnulacion);
    
    }

}