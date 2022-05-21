
    <?php

    ini_set('memory_limit', '1024M');

    use  PHPMailer\PHPMailer\PHPMailer ;
	use  PHPMailer\PHPMailer\Exception ;

require  './extensions/PHPMailer-master/src/Exception.php' ;
require  './extensions/PHPMailer-master/src/PHPMailer.php' ;
require  './extensions/PHPMailer-master/src/SMTP.php' ;



   class ClsenviarCorreo{

       public static function CargarDatosFactura($clave){

        $table = 'empresas.tbl_sistema_facturacion_facturas_P';

        $factura = api_facturacionModel:: MdlCargarDatosFactura($table, $clave);
    
        return $factura;

        }





    public static function EnviarCorreo($clave, $idcliente){


$datosFac = ClsenviarCorreo::CargarDatosFactura($clave);


            //Load Composer's autoloader
            // require 'vendor/autoload.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = 4;                      //Enable verbose debug output
                $mail->isSMTP(); 
                $mail->SMTPKeepAlive = true;   
                 $mail->SMTPOptions = array(
        	'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
                //$mail->Host       = 'mail.outthebox-cr.com';  
                $mail->Host = 'ssl://mail.outthebox-cr.com';                    //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'facturacion@outthebox-cr.com';                     //SMTP username
                $mail->Password   = ':Az*NdbpLQK!,8M,{4S%fN';                               //SMTP password
               	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('facturacion@outthebox-cr.com', '');
                $mail->addAddress($datosFac[0][14], $datosFac[0][13]);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
              



                //Attachments
               
                 $mail->addStringAttachment(file_get_contents('http://backup.midigitalsat.com/private/apiHacienda/clientes/'.$idcliente.'/DocumentosFirmados/documento'.$clave.'.xml'), 'Factura.xml');

                  $mail->addStringAttachment(file_get_contents('http://backup.midigitalsat.com/private/apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf'), 'Factura.pdf');
       

                   $mail->addStringAttachment(file_get_contents('http://backup.midigitalsat.com/private/apiHacienda/clientes/'.$idcliente.'/DocumentosRespuesta/documentoRespuesta'.$clave.'.xml'), 'RespuestaHacienda.xml');

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'prueba envio';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if($mail->send()){
                
            echo "COREEO ok";
           
                }else{
                
                      echo "COREEO ERROR";

                };
               
            } catch (Exception $e) {
            				echo("<script>console.log('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>");

               // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }





    }


   }