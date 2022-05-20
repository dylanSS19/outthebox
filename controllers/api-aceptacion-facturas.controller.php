<?php

require_once  ("../models/api-facturacion.model.php");
require_once ("../extensions/firmarXML/firmar.php");
header('Acceess-Control-Allow-Origin: *');

switch ($_SERVER['REQUEST_METHOD']) {
 
  case 'POST':
  
    $data = json_decode(file_get_contents('php://input'), true);

    if (api_AceptacionFacturasController::is_json(json_encode($data["fileContent"])) == "true"){

        // echo '<pre>'; print_r($data["fileContent"]); echo '</pre>';

        $usuario = $data["fileContent"]["datosReceptor"]["usuario"];

        $contrasena = $data["fileContent"]["datosReceptor"]["password"];
        
        $cedula = $data["fileContent"]["datosReceptor"]["cedula"];

        $validacionCredenciales = api_AceptacionFacturasController::validarCredencialesUsuario($usuario, $contrasena, $cedula);

        // echo '<pre>'; print_r($validacionCredenciales[0]); echo '</pre>';

        if($validacionCredenciales[0] == 1){

            $TipoDocumento = $data["fileContent"]["datosFactura"]["tipoDoc"];
          
            if(strval($TipoDocumento)  == "05" || strval($TipoDocumento) == "06" || strval($TipoDocumento) == "07"){
    
               
            }else{

                header("HTTP/1.1 404 Forbidden");
    
                echo '{"success": "false", "reason": "Tipo de documento no es valido."}';
   
                break;

            }

            $validacion = api_AceptacionFacturasController::ValidarCajaSucursal($data); 

            $datosUsario = api_AceptacionFacturasController::cargarDatosUsuario($contrasena, $cedula);

            // echo '<pre>'; print_r($datosUsario); echo '</pre>';

            //  $user = $datosUsario["usuario_token_prueba"];
            // $contrasena = $datosUsario["contrasena_token_prueba"]; 
            $contrasena = $datosUsario["contrasena_token"]; 
            $user = $datosUsario["usuario_token"];

           $token = api_AceptacionFacturasController::GenerarToken($user, $contrasena);
           $token = json_decode($token);

           if(!array_key_exists('access_token', $token)){

                    header("HTTP/1.1 403 Forbidden");

                echo '{"success": "false", "reason": "Credenciales de token incorrectas"}';

            exit();
           }

           $idcliente = $datosUsario["idtbl_clientes"];
           $xml_factura = api_AceptacionFacturasController::GenerarXML($data, $idcliente);

        //    echo '<pre>'; print_r($xml_factura); echo '</pre>';

          $DatosXml = simplexml_load_string($xml_factura);

        //    echo '<pre>'; print_r($DatosXml); echo '</pre>';


        
        $pfx = $datosUsario["ruta_12"];
        $pin = $datosUsario["pin_p12"];
        //    $pfx = $datosUsario["ruta_12_prueba"];
        //    $pin = $datosUsario["pin_p12_prueba"];
           $xml = $xml_factura;
           // $xml = '../apiHacienda/clientes/Heribertocastro/Documentos/documento'.$clave.'.xml';
           $ruta = "dfhjdfhj";
             
              $archivo_formado = api_facturacion2controller::firmar($pfx, $pin, $xml, $ruta,$DatosXml->FechaEmisionDoc);
            //   echo '<pre>'; print_r($archivo_formado); echo '</pre>';


        /*===========================================F==
         = USUARIO Y CONTRASEÑA PARA GENERAR TOQUEN DE 
        AUTENTIFUCACION ANTE HACIENDA               =
        =============================================*/
        $user = $datosUsario["usuario_token"];
        $contrasena = $datosUsario["contrasena_token"]; 
        // $user = $datosUsario["usuario_token_prueba"];
        // $contrasena = $datosUsario["contrasena_token_prueba"]; 

           $token = api_AceptacionFacturasController::GenerarToken($user, $contrasena);

           $token = json_decode($token);

           $token =  $token->{'access_token'};


       /*=============================================
      =        ENVIAR XML FIRMADO A HACIENDA        =
       =============================================*/

    if($datosUsario["tipo_personeria"] == "Fisico"){

        $tipoCedulaReceptor = "01";

    }else if($datosUsario["tipo_personeria"] == "Juridico"){

        $tipoCedulaReceptor = "02";

    }else if($datosUsario["tipo_personeria"] == "Dimex" || $datosUsario["tipo_personeria"] == "NITE"){
    
        $tipoCedulaReceptor = "03";

    } 
    
       $respuesta_hacienda = api_AceptacionFacturasController::EnviarApiFacturas($token, $archivo_formado, $DatosXml->Clave, $DatosXml->NumeroConsecutivoReceptor, $DatosXml->NumeroCedulaReceptor, $tipoCedulaReceptor, $DatosXml->FechaEmisionDoc, $data["fileContent"]["datosEmisor"]["tipoCedula"], $DatosXml->NumeroCedulaEmisor);

    if($DatosXml->NumeroConsecutivoReceptor != ""){

        header("HTTP/1.1 200 OK");
        echo '{"success": "true", "Clave":"'.$DatosXml->Clave.'", "Consecutivo":"'.$DatosXml->NumeroConsecutivoReceptor.'", "document": "'.$archivo_formado.'"}';

    }else{

        header("HTTP/1.1 404 Not Found");
        echo '{"success": "false", "Error al enviar los datos."}';

    }


    //    echo '<pre>'; print_r($respuesta_hacienda); echo '</pre>';

        }else{

            header("HTTP/1.1 401 Unauthorized");
    
            echo '{"success": "false", "reason": "El usuario no se encuentra registrado, validar credenciales."}';

            break;

        }

    }else{


    }


    break;

}


class api_AceptacionFacturasController{


    public static function is_json($string, $return_data = false) {

        $data = json_decode($string);
          return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
     }

     public static function validarCredencialesUsuario($usuario, $contrasena, $cedula) {

   
        $table = "empresas.tbl_clientes";  
      
        $response = api_facturacionModel::MdlValidarCredencialesUsuarios ($table, $usuario, $contrasena, $cedula);
      
      
          return $response;
      
      }

      public static function cargarDatosUsuario($contrasena, $cedula) {
   
        $table = "empresas.tbl_clientes";  
      
        $response = api_facturacionModel::MdlcargarDatosUsuario($table, $contrasena, $cedula);
      
      
          return $response;
      
      }


      public function GenerarToken($user, $contrasena){
  

        // $data = "client_id=api-prod&username=".$user."&password=".urlencode($contrasena)."&grant_type=password";
           $data = "client_id=api-prod&username=".$user."&password=".urlencode($contrasena)."&grant_type=password";
   
        // $data = "client_id=api-stag&username=".$user."&password=".$contrasena."&grant_type=password"; 
       $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut/protocol/openid-connect/token"); 
    //   $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut-stag/protocol/openid-connect/tokens"); //ambiente pruebas
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


     public function EnviarApiFacturas($token, $archivo_formado, $clave, $consecutivo, $cedula_receptor, $tipoCedulaReceptor, $fecha_factura_2, $tipo_cedula_emisor, $cedula_emisor){
    

        $authorization = "Authorization: Bearer ".$token."";
      
      
      $json_factura = '{
        "clave": "'.$clave.'",
        "fecha": "'.$fecha_factura_2.'",
        "emisor": {
          "tipoIdentificacion": "'.$tipo_cedula_emisor.'",
          "numeroIdentificacion": "'.$cedula_emisor.'"
        },
        "receptor": {
            "tipoIdentificacion": "'.$tipoCedulaReceptor.'",
            "numeroIdentificacion": "'.$cedula_receptor.'"
          },
        "consecutivoReceptor": "'.$consecutivo.'",
        "comprobanteXml":"'.$archivo_formado.'"
      }';
      
   
      // echo '<pre>'; print_r($json_factura); echo '</pre>';
    //   exit();
          
        //  $ch = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/recepcion"); //ambiente sandbox
      
          $ch = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion/v1/recepcion");
      
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
              
              $response_info = curl_getinfo($ch);
      
              $err = curl_error($ch);
      
              // Se cierra el recurso CURL y se liberan los recursos del sistema
              curl_close($ch);
      
              if($response_info["http_code"] == 202 || $response_info["http_code"] == 200){
      
      
              }else{
      
            //    $mdlestado = api_facturacioncontroller::ModificarEstadoFactura($clave);

            return $response_info;
      
              }
      
      
              if ($err) {
      
                return "Error #:" . $err;
      
              } else {
      
                return $response;
      
              }
                  
        }


     public function GenerarXML($json, $idcliente){


        /*=============================================
        =             DATOS RECEPTOR                   =
        =============================================*/

        $usuario = $json["fileContent"]["datosReceptor"]["usuario"];
        $password = $json["fileContent"]["datosReceptor"]["password"];
        $cedulaReceptor = $json["fileContent"]["datosReceptor"]["cedula"];
        $id_empresa = $json["fileContent"]["datosReceptor"]["id_empresa"];

        /*=============================================
        =             DATOS EMISOR                   =
        =============================================*/

        $cedulaEmisor = $json["fileContent"]["datosEmisor"]["cedula"];


        /*=============================================
        =             DATOS FACTURA                   =
        =============================================*/

        $clave = $json["fileContent"]["datosFactura"]["clave"];
        $fechaEmision = $json["fileContent"]["datosFactura"]["fechaEmision"];
        $horaEmision = $json["fileContent"]["datosFactura"]["horaEmision"];
        $comentario = $json["fileContent"]["datosFactura"]["comentario"];
        $sucursal = $json["fileContent"]["datosFactura"]["sucursal"];
        $caja = $json["fileContent"]["datosFactura"]["caja"];
        $tipoDoc = $json["fileContent"]["datosFactura"]["tipoDoc"];
        $actividadEconomica = $json["fileContent"]["datosFactura"]["actividadEconomica"];
        $api = $json["fileContent"]["datosFactura"]["api"];
        $CondicionImpuesto = $json["fileContent"]["datosFactura"]["CondicionImpuesto"];
        $MontoTotalImpuestoAcreditar = $json["fileContent"]["datosFactura"]["MontoTotalImpuestoAcreditar"];
        $MontoTotalDeGastoAplicable = $json["fileContent"]["datosFactura"]["MontoTotalDeGastoAplicable"];
        $MontoTotalImpuesto = $json["fileContent"]["datosFactura"]["MontoTotalImpuesto"];
        $TotalFactura = $json["fileContent"]["datosFactura"]["TotalFactura"];
        $categoria = $json["fileContent"]["datosFactura"]["categoria"];

        /*=============================================
        =  DECLARACION DE VARIABLES Y CALCULOS   =
        =============================================*/

        if($tipoDoc == "05"){

            $Mensaje = "1";
            $estado= "Aceptado";
        }else if($tipoDoc == "06"){

            $Mensaje = "2";
            $estado= "Aceptado Parcial";
        }else if($tipoDoc == "07"){

            $Mensaje = "3";
            $estado= "Rechazado";
        }
        

        $tipo = "MR";

        do {
   
            $numUltimoConse = api_AceptacionFacturasController::Cargarultimoconsecutivo($id_empresa, $sucursal, $caja, $tipo);
                 
            if($numUltimoConse[0] == "" || $numUltimoConse[0] == false || $numUltimoConse[0] == "false"){
    
            $ultimoconse = 1;
    
            }else{
    
            $ultimoconse = $numUltimoConse[0] + 1;
    
            }
    
            // echo '<pre>'; print_r($ultimoconse); echo '</pre>';

    $IdFactura = "";
    
    $ramdon = api_AceptacionFacturasController::getRandomHex(50);
    
    $insertConse = api_AceptacionFacturasController::Insertarultimoconsecutivo($id_empresa, $IdFactura, $ultimoconse, $sucursal, $caja, $ramdon, $tipo);
     
    $IdFactura = api_AceptacionFacturasController::CargarIdFactura($clave);

    $insertConse = api_AceptacionFacturasController::Updateultimoconsecutivo($id_empresa, $IdFactura[0], $ramdon);

    


    $numero = $ultimoconse;


    $cantCeros = 3;
    $sucursal = substr(str_repeat(0, $cantCeros).$sucursal, - $cantCeros);
    
    $cantCeros = 10;
    $numero = substr(str_repeat(0, $cantCeros).$numero, - $cantCeros);

    $cantCeros = 5;
    $caja = substr(str_repeat(0, $cantCeros).$caja, - $cantCeros);
    
    $cantCeros = 2;
    $tipoDoc = substr(str_repeat(0, $cantCeros).$tipoDoc, - $cantCeros);

    $consecutivoReceptor = $sucursal.$caja.$tipoDoc.$numero;
 
    $procesado = "Si";

    $procesado = "Si";

    api_AceptacionFacturasController::UpdateDatosFacturaGastos($clave, $procesado, $estado, $consecutivoReceptor, $categoria);

    // echo '<pre>'; print_r($insertConse); echo '</pre>';
    
    } while ($insertConse == "0");

        $cantCeros = 12;
        $cedulaReceptor = substr(str_repeat(0, $cantCeros).$cedulaReceptor, - $cantCeros);
        $cedulaEmisor = substr(str_repeat(0, $cantCeros).$cedulaEmisor, - $cantCeros);

        $archivo_XML = '<?xml version="1.0" encoding="utf-8"?>'."\n";

        $tipo_documento = 'MensajeReceptor';
        $header = 'xmlns:ds="http://www.w3.org/2000/09/xmldsig#"';
        $header .=' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
        $header .=' xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/mensajeReceptor"';
        $header .=' xsi:schemaLocation="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/mensajeReceptor https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/mensajeReceptor.xsd">';
        

        $archivo_XML .= '<'.$tipo_documento.' '.$header.'
        <Clave>'.$clave.'</Clave>
        <NumeroCedulaEmisor>'.$cedulaEmisor.'</NumeroCedulaEmisor>
        <FechaEmisionDoc>'.$fechaEmision.'T'.$horaEmision.'-06:00</FechaEmisionDoc>
        <Mensaje>'.$Mensaje.'</Mensaje>
        <DetalleMensaje>'.$comentario.'</DetalleMensaje>
        <MontoTotalImpuesto>'.$MontoTotalImpuesto.'</MontoTotalImpuesto>';

                if($actividadEconomica != "" || $actividadEconomica != 0){

        $archivo_XML .='
        <CodigoActividad>'.$actividadEconomica.'</CodigoActividad>';

                }

                if($CondicionImpuesto != ""){

        $archivo_XML .='
        <CondicionImpuesto>'.$CondicionImpuesto.'</CondicionImpuesto>';

                }

                if($MontoTotalImpuestoAcreditar != ""){

        $archivo_XML .='
        <MontoTotalImpuestoAcreditar>'.$MontoTotalImpuestoAcreditar.'</MontoTotalImpuestoAcreditar>';

                }

                if($MontoTotalImpuestoAcreditar != ""){

        $archivo_XML .='
        <MontoTotalDeGastoAplicable>'.$MontoTotalImpuestoAcreditar.'</MontoTotalDeGastoAplicable>';

                }

        $archivo_XML .= '
        <TotalFactura>'.$TotalFactura.'</TotalFactura>
        <NumeroCedulaReceptor>'.$cedulaReceptor.'</NumeroCedulaReceptor>
        <NumeroConsecutivoReceptor>'.$consecutivoReceptor.'</NumeroConsecutivoReceptor>';

        $archivo_XML .= '
    </'.$tipo_documento.'>';
        
       

        return $archivo_XML;

     }


     public function getRandomHex($num_bytes=4) {

        return bin2hex(openssl_random_pseudo_bytes($num_bytes));

      }

     public function Cargarultimoconsecutivo($id_empresa, $sucursal, $caja, $tipo){

        $table = 'empresas.tbl_ultimo_consecutivo';

        $Cargarconsecutivo = api_facturacionModel:: MdlcargarUltimoConsecutivo($table, $sucursal, $caja, $tipo, $id_empresa);

        return $Cargarconsecutivo;

        }

        public function Insertarultimoconsecutivo($id_empresa, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random, $tipo){

            $table = 'empresas.tbl_ultimo_consecutivo';
    
            $insertarconsecutivo = api_facturacionModel:: MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random, $tipo, $id_empresa);
        
            }

            
        public function Updateultimoconsecutivo($id_empresa, $id_factura, $random){

    $table = 'empresas.tbl_ultimo_consecutivo';

    $insertarconsecutivo = api_facturacionModel::MdlUpdateconse($table, $id_factura, $random);


    }

        public function UpdateDatosFacturaGastos($clave, $procesado, $estado, $consecutivoReceptor,$categoria){

        $table = 'empresas.tbl_sistema_facturacion_Factura_gastos';
    
        $insertarconsecutivo = api_facturacionModel::MdlUpdateDatosFacturaGastos($table, $clave, $procesado, $estado, $consecutivoReceptor, $categoria);
    
        }


        public function CargarIdFactura($clave){

        $table = 'empresas.tbl_sistema_facturacion_Factura_gastos';
    
        $IdFactura = api_facturacionModel::MdlCargarIdFactura($table, $clave);
    
        return $IdFactura;
    }


      public function ValidarCajaSucursal($json){

        $caja = $json["fileContent"]["datosFactura"]["caja"];
    
        $sucursal = $json["fileContent"]["datosFactura"]["sucursal"];
    
        $id_empresa = $json["fileContent"]["datosReceptor"]["id_empresa"];
    
    
        $table = "empresas.tbl_sucursal_".$id_empresa;
    
            $respuestaS = api_facturacionModel::MdlValidarSucursal($table, $sucursal);
    
    
    
            if(!$respuestaS){
    
                        header("HTTP/1.1 403 Forbidden");                    
                        echo '{"success": "false", "reason": "Datos de la Sucursal no existentes en sistema."}';
                        exit();
    
            }else{
    
    
                $table = "empresas.tbl_cajas_".$id_empresa;
    
                $idsucursal = $respuestaS["idtbl_sucursal"];
    
                $respuestaS = api_facturacionModel::MdlValidarCaja($table, $caja, $idsucursal);
    
                if(!$respuestaS){
    
                        header("HTTP/1.1 403 Forbidden");                       
                        echo '{"success": "false", "reason": "Datos de la caja no ligados a la sucursal o datos no existentes."}';
                        exit();
    
    
                }else{
    
    
    
                }
    
    
            }
    
    
    
      }


}

