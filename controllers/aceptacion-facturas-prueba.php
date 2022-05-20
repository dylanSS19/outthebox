      <?php


      require_once  ("../models/api-facturacion.model.php");


use  PHPMailer\PHPMailer\PHPMailer ;
use  PHPMailer\PHPMailer\Exception ;

require  '../extensions/PHPMailer-master/src/Exception.php' ;
require  '../extensions/PHPMailer-master/src/PHPMailer.php' ;
require  '../extensions/PHPMailer-master/src/SMTP.php' ;

$servername = "midigitalsat.com";
$username = "admin";
$password = "Heriberto9109";

try {
  $conn = new PDO("mysql:host=$servername;dbname=empresas", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  date_default_timezone_set('America/Costa_Rica');

      $stmt = $conn->prepare("SELECT clave,id_compania FROM empresas.tbl_sistema_facturacion_facturas_P where estado_factura='enviado' and fecha_factura > DATE_ADD(NOW(), INTERVAL - 1 DAY) limit 1 ");

      $stmt -> execute();

            $response =  $stmt ->fetchAll(\PDO::FETCH_ASSOC);


    $stmt =null;


            foreach ($response as $key => $value) {


            $idEmpresa = $value["id_compania"];
            $Clave_Factura = $value["clave"];


            $stmt = $conn->prepare("SELECT * FROM empresas.tbl_clientes where idtbl_clientes = '$idEmpresa'");

                              $stmt -> execute();

                        $response =  $stmt ->fetch(\PDO::FETCH_ASSOC);

                        $stmt =null;


            $data = "client_id=api-stag&username=".$response["usuario_token_prueba"]."&password=".$response["contrasena_token_prueba"]."&grant_type=password"; 
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

                  $token = json_decode($response);

                  $token =  $token->{'access_token'};

            $authorization = "Authorization: Bearer ".$token."";

            $ch = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/recepcion/".$Clave_Factura);
        
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' , $authorization));                  
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
                  $responseapi = curl_exec($ch);
                  // Se cierra el recurso CURL y se liberan los recursos del sistema
                  curl_close($ch);

                 

                 $responseapi= json_decode($responseapi, true);

              
                 $fecha= date("Y-m-d H:i:s", strtotime($responseapi["fecha"]));
                 $estado=ucfirst($responseapi["ind-estado"]);
                 $xml_string=base64_decode($responseapi["respuesta-xml"]);


                  $json = json_encode(simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA));

                  $json= json_decode($json, true);

                  $msg= json_encode( $json["DetalleMensaje"]) ;

             


               if(!isset($estado)){

                      $stmt = $conn->prepare("Update empresas.tbl_sistema_facturacion_facturas_P set fecha_estado='".$fecha."', estado_factura ='". $estado."' ,detalle_estado_hacienda='".$msg."' where clave = '".$Clave_Factura."'");

     

                  if($stmt->execute()){

                    $response ="ok";
                  }

                  else{

                    $response = "error";
                  }

                   $stmt =null;
//GENERA XML RESPUESTA

 $dom = new  DomDocument();
$dom ->preseveWhiteSpace = FALSE ;
$dom -> loadXML($xml_string);
$dom -> save('../apiHacienda/clientes/'.$idEmpresa.'/DocumentosRespuesta/documentoRespuesta'.$Clave_Factura.'.xml');


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
$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/DocumentosRespuesta/documentoRespuesta'.$Clave_Factura.'.xml';
$localfile = '../apiHacienda/clientes/'.$idEmpresa.'/DocumentosRespuesta/documentoRespuesta'.$Clave_Factura.'.xml';

ssh2_scp_send($connection, $localfile, $remotefile, 0644);

ssh2_exec($connection, 'exit');


//ENVIA CORREO


$envioCorreo = bot_aceptacion_pruebas::EnviarCorreo($Clave_Factura,$idEmpresa);


          






                }



   
             


      }

} catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
}
    





    class bot_aceptacion_pruebas{

        public function CargarDatosFactura($clave){

        $table = 'empresas.tbl_sistema_facturacion_facturas_P';

        $factura = api_facturacionModel:: MdlCargarDatosFactura($table, $clave);
    
        return $factura;

        }


    public function EnviarCorreo($clave, $idcliente){


$datosFac = bot_aceptacion_pruebas::CargarDatosFactura($clave);


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
                $mail->addAttachment('http://upee-cr.com/apiHacienda/clientes/'.$idcliente.'/DocumentosFirmados/documento'.$clave.'.xml','Factura.xml');         //Add attachments
                $mail->addAttachment('http://upee-cr.com/apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf', 'Factura.pdf');    //         //Add attachments
                $mail->addAttachment('http://upee-cr.com/apiHacienda/clientes/'.$idcliente.'/DocumentosRespuesta/documentoRespuesta'.$clave.'.xml', 'RespuestaHacienda.pdf');  

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


     public function CargarDatosFactura2($clave){

        $table = 'empresas.tbl_sistema_facturacion_facturas';

        $factura = api_facturacionModel:: MdlCargarDatosFactura($table, $clave);
    
        return $factura;

        }


    }