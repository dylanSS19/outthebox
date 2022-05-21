
    <?php

    ini_set('memory_limit', '1024M');
    ini_set('user_agent', 'My-Application/2.5');

    use  PHPMailer\PHPMailer\PHPMailer ;
	use  PHPMailer\PHPMailer\Exception ;

require  '/bot_aceptacion_docs_produccion/PHPMailer-master/src/Exception.php';
require  '/bot_aceptacion_docs_produccion/PHPMailer-master/src/PHPMailer.php';
require  '/bot_aceptacion_docs_produccion/PHPMailer-master/src/SMTP.php';
require_once  ("/bot_aceptacion_docs_produccion/factura/generaFactura2.php");

//require_once  ("/bot_aceptacion_docs_produccion/factura/generaBody.php");

 
   class ClsenviarCorreo{



    public static function EnviarCorreo($clave, $idcliente,$receptor){

    



        

/*GENERA RESPUESTA HACIENDA*/

            $idEmpresa = $idcliente;


            $Clave_Factura = $clave;

            $servername = "midigitalsat.com";
            $username = "admin";
            $password = "Heriberto9109";

           $conn = new PDO("mysql:host=$servername;dbname=empresas", $username, $password);

            $stmt = $conn->prepare("SELECT usuario_token,contrasena_token,nombre,cco FROM empresas.tbl_clientes where idtbl_clientes = '$idEmpresa'");

            $stmt -> execute();

            $response =  $stmt ->fetch(\PDO::FETCH_ASSOC);


            $stmt =null;

            $nombre_empresa=$response["nombre"];

            $cco=$response["cco"];


            $data = "client_id=api-prod&username=".$response["usuario_token"]."&password=".urlencode($response["contrasena_token"])."&grant_type=password"; 
            // $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut/protocol/openid-connect/token"); 
            $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut/protocol/openid-connect/token"); //ambiente pruebas
          
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
                 /* echo '<pre>'; print_r($response); echo '</pre>';
                  exit();*/
                  // Se cierra el recurso CURL y se liberan los recursos del sistema
                  curl_close($ch);

                  $token = json_decode($response);

           $token =  $token->{'access_token'}; 


            $authorization = "Authorization: Bearer ".$token."";

            $ch = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion/v1/recepcion/".$Clave_Factura);
        
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' , $authorization));                  
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
                  $responseapi = curl_exec($ch);
                  // Se cierra el recurso CURL y se liberan los recursos del sistema
                  curl_close($ch);         

                 $responseapi= json_decode($responseapi, true);                         

                if(isset($responseapi["ind-estado"])){ 
                
                 $fecha= date("Y-m-d H:i:s", strtotime($responseapi["fecha"]));
                 $estado=ucfirst($responseapi["ind-estado"]);
                 $xml_string=base64_decode($responseapi["respuesta-xml"]);

                 $xml_string=str_replace(array("&amp;quot;"),"",$xml_string);

              
                 $json = json_encode(simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA));

                 $json= json_decode($json, true);

                  $msg= str_replace("'","\"",$json["DetalleMensaje"]); 

                      if(empty($msg)){
                $msg="";
              }
            
         if (file_exists('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/DocumentosRespuesta/documentoRespuesta'.$Clave_Factura.'.xml')) {
             unlink('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/DocumentosRespuesta/documentoRespuesta'.$Clave_Factura.'.xml');
    
} 


//GENERA XML RESPUESTA

 $dom = new  DomDocument("1.0", "utf-8");
$dom ->preseveWhiteSpace = FALSE ;
$dom->loadXML($xml_string) ;
$dom->encoding = "utf-8";
$dom -> save('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/DocumentosRespuesta/documentoRespuesta'.$Clave_Factura.'.xml');






/*CONTINUA CORREO*/




$servername = "midigitalsat.com";
$username = "admin";
$password = "Heriberto9109";

        $conn = new PDO("mysql:host=$servername;dbname=empresas", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM tbl_sistema_facturacion_facturas where clave = '$clave'");

                         $stmt -> execute();

                        $datosFac =  $stmt ->fetchAll();
                     

                        $stmt =null;

                          

$generarpdf = generarPdf::crearPDF($clave, $idcliente);

/*return $generarpdf;

exit;*/

/*    $localfile = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf';

     $ipremoteserver='midigitalsat.com';

$username = 'root';
$password = '2dE}QmPP.3_gau66';
                    // Make our connection
$connection = ssh2_connect($ipremoteserver, 6060);

                    // Authenticate
if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');

                    // Create our SFTP resource
if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');

$remotefile = '/var/www/outthebox/documento/documento'.$clave.'.pdf';


  if(ssh2_scp_send($connection, $localfile, $remotefile, 0644)){
            echo "OK";
        }else{

  echo "MAME";
        }

 ssh2_exec($connection, 'exit');*/




//$generarbody = generarBody::generarBody($clave2, $idcliente2);


         if (file_exists('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/DocumentosRespuesta/documentoRespuesta'.$Clave_Factura.'.xml')) {
             unlink('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/DocumentosFirmados/documento'.$clave.'.xml');
    
} 

$archivo_formado=$datosFac[0]["xml_firmado"];
$dom = new  DomDocument();
$dom ->preseveWhiteSpace = FALSE ;
$dom -> loadXML(base64_decode($archivo_formado));
$dom -> save('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/DocumentosFirmados/documento'.$clave.'.xml');



    
            $mail = new PHPMailer(true);

            try {
                
                $mail->isSMTP(); 
                $mail->SMTPKeepAlive = true;   
                 $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
               
                $mail->Host = 'ssl://mail.outthebox-cr.com';                    //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'facturacion@outthebox-cr.com';                     //SMTP username
                $mail->Password   = ':Az*NdbpLQK!,8M,{4S%fN';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = 
                $mail->setFrom('facturacion@outthebox-cr.com', $nombre_empresa);
  if($receptor===""){

    $mail->addAddress($datosFac[0]["correo_cliente"]);

                    if (!empty($cco)) {
          $cco = explode(',', $cco);
        foreach($cco as $email => $name) {

   $mail->addBCC($name);
   
   
}
}


      
                }else{ 




                    
         $recipients = explode(',', $receptor);
        foreach($recipients as $email => $name) {

   $mail->addAddress($name);}  
                 
                };

$mail->AddEmbeddedImage("/bot_aceptacion_docs_produccion/top.png", "top", "top.png");

$mail->AddEmbeddedImage("/bot_aceptacion_docs_produccion/botton.png", "botton", "botton.png");


                $Body='<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
<head>
<title>Page 1</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

</head>
<body bgcolor="#ffffff" vlink="blue" link="blue">
<div id="page1-div" style="width:899px;height:600px;">
<img src="cid:top">
<p style="margin: 0; padding: 0;top:194px;left:25px;white-space:nowrap;font-size:22px;font-family:QWMEMI+ArialMT;color:#0388a6;" >Estimado(a)&#160;Cliente: ' .$datosFac[0]["nombre_cliente"].'</p>
<p style="font-size:21px;line-height:25px;font-family:OTWQDY+QuicksandBook;color:#0388a6;margin: 0; padding: 0;position:absolute;top:281px;left:58px;white-space:nowrap">Adjunto&#160;encontrará&#160;su&#160;Documento&#160;Tributario&#160;<br/>Electrónico&#160;(DTE)&#160;número:&#160; <b>' .$datosFac[0]["consecutivo"].'.</b></p>
<p style="font-size:21px;line-height:25px;font-family:OTWQDY+QuicksandBook;color:#0388a6;margin: 0; padding: 0;position:absolute;top:350px;left:58px;white-space:nowrap" >Estos&#160;documentos&#160;se&#160;encuentran&#160;disponibles&#160;en&#160;<br/>formato&#160;XML&#160;y&#160;PDF.</p>
<p style="font-size:22px;font-family:OIVKOB+QuicksandBold;color:#0388a6;margin: 0; padding: 0;position:absolute;top:229px;left:300px;white-space:nowrap" ><b>' .$nombre_empresa.'</b></p>
<p style="font-size:27px;font-family:OIVKOB+QuicksandBold;color:#0388a6;margin: 0; padding: 0;position:absolute;top:434px;left:55px;white-space:nowrap" ><b>Out&#160;of&#160;the&#160;box&#160;to&#160;be&#160;out&#160;of&#160;this&#160;world!</b></p>
<p style="font-size:13px;font-family:OTWQDY+QuicksandBook;color:#0388a6;margin: 0; padding: 0;position:absolute;top:504px;left:87px;white-space:nowrap" >Si&#160;tiene&#160;dificultad&#160;para&#160;ingresar&#160;al&#160;sistema&#160;o&#160;visualizar&#160;los&#160;documentos,&#160;</p>
<p style="font-size:13px;font-family:OTWQDY+QuicksandBook;color:#0388a6;margin: 0; padding: 0;position:absolute;top:520px;left:209px;white-space:nowrap" >comunicarse&#160;con&#160;su&#160;proveedor.</p>
<img src="cid:botton">
</div>
</body>
</html>';
                                
   

                  $mail->addStringAttachment(file_get_contents('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/DocumentosFirmados/documento'.$clave.'.xml'), 'Doc'.$clave.'.xml');

                  $mail->addStringAttachment(file_get_contents('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf'), 'Doc'.$clave.'.pdf');       

                   $mail->addStringAttachment(file_get_contents('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/DocumentosRespuesta/documentoRespuesta'.$clave.'.xml'), 'RespuestaHacienda'.$clave.'.xml');


$date=date_create($datosFac[0]["fecha_factura"]);
$date= date_format($date,"d/m/Y");

                //Content
                $mail->CharSet = 'UTF-8';

                                                            //Set email format to HTML
                $mail->Subject = 'Documento Electrónico con número consecutivo '.$datosFac[0]["consecutivo"].' del  '. $date .' emitido por '.$nombre_empresa.' para '.$datosFac[0]["nombre_cliente"].'';

                $mail->Body =  html_entity_decode($Body);
                $mail->IsHTML(true);


                              
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if($estado=="Aceptado" ||  $estado=="Rechazado"){

                            if($mail->send()){
                
            $envioCorreo= "COREEO OK";
           
                }else{
                
              $envioCorreo= "CORREO ERRORee";

                };

                }else{

                    $envioCorreo= "CORREO ERRORooo";

                    };

             

       


$stmt = $conn->prepare("Update empresas.tbl_sistema_facturacion_facturas set fecha_estado='".$fecha."', estado_factura ='". $estado."' ,detalle_estado_hacienda='".$msg."',estado_correo='".$envioCorreo."' where clave = '".$clave."'");

     

                  if($stmt->execute()){

                     return $envioCorreo;
                  }

                  else{

                    return $envioCorreo;
                  }

                   $stmt =null;
  

                

               
            } catch (Exception $e) {
            				

               // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                $envioCorreo= "CORREO ERROR";
                
              $stmt = $conn->prepare("Update empresas.tbl_sistema_facturacion_facturas set fecha_estado='".$fecha."', estado_factura ='". $estado."' ,detalle_estado_hacienda='".$msg."',estado_correo='".$envioCorreo."' where clave = '".$clave."'");

     

                  if($stmt->execute()){

                     return $envioCorreo;
                  }

                  else{

                    return $envioCorreo;
                  }

                   $stmt =null;
            }


}


    }


   }