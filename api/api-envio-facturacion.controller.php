<?php
use  PHPMailer\PHPMailer\PHPMailer ;
use  PHPMailer\PHPMailer\Exception ;


require  '../extensions/PHPMailer-master/src/Exception.php' ;
require  '../extensions/PHPMailer-master/src/PHPMailer.php' ;
require  '../extensions/PHPMailer-master/src/SMTP.php' ;


header('Acceess-Control-Allow-Origin: *');

switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
        
        $data = json_decode(file_get_contents('php://input'), true);


    /****************************
         
        {"fileContent":{
        "correo": "hcastro@digitalsat-cr.com",
        "nombre": "Digitalsat",
        "nombreProveedor": "Out The Box",
        "tipoDocumento": "Factura",
        "numeroDoc": "098765",
        "claveDoc": 1515,
        "moneda": "USD",
        "monto": 25000,
        "fecha": "2021-12-04"
        }
    }  
   
     ****************************/


        if (api_EnvioFacturacionController::is_json(json_encode($data["fileContent"])) == "true"){
            
            
            $claveDoc = "";
            $correo = $data["fileContent"]["correo"];
            $nombre = $data["fileContent"]["nombre"];
            $nombreProveedor = $data["fileContent"]["nombreProveedor"];
            $tipoDocumento = $data["fileContent"]["tipoDocumento"];
            $numeroDoc = $data["fileContent"]["numeroDoc"];
            $claveDoc = $data["fileContent"]["claveDoc"];         
            $moneda = $data["fileContent"]["moneda"];
            $monto = $data["fileContent"]["monto"];
            $fecha = $data["fileContent"]["fecha"];
          
            if($tipoDocumento == "01"){

                $tipoDocumento = "FACTURA ELECTRONICA";

            }else if($tipoDocumento == "02"){

                $tipoDocumento = "NOTA DEBITO ELECTRONICA";

            }else if($tipoDocumento == "03"){
               
                $tipoDocumento = "NOTA CREDITO ELECTRONICA";

            }else if($tipoDocumento == "04"){

                $tipoDocumento = "TIQUETE ELECTRONICO";

            }


            api_EnvioFacturacionController::generarCorreo($correo, $nombre, $nombreProveedor,$tipoDocumento, $numeroDoc, $claveDoc, $moneda, $monto, $fecha);
        }

}


class api_EnvioFacturacionController {

    /****************************
     *                          *
     *     VALIDACION DE JSON   *
     *                          *
     ****************************/
    public static function is_json($string, $return_data = false) {

        $data = json_decode($string);
          return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
     }


    /****************************
     *                          *
     *     CREACION DE CORREO   *
     *                          *
     ****************************/
    public static function generarCorreo($correo, $nombre, $nombreProveedor,$tipoDocumento, $numeroDoc, $claveDoc, $moneda, $monto, $fecha) {
        $mail = new PHPMailer(true);
        date_default_timezone_set('America/Costa_Rica');
        $date = date("d/m/Y", strtotime($fecha));
            try {
                //Server settings
                // $mail->SMTPDebug = 2;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.outthebox-cr.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'notificaciones@outthebox-cr.com';                     //SMTP username
                $mail->Password   = 'notificaciones2021';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('notificaciones@outthebox-cr.com', 'Notificación de Recepción Documento');
                $mail->addAddress($correo);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');


                $mail->AddEmbeddedImage("../assets/img/top.png", "top", "top.png");
                $mail->AddEmbeddedImage("../assets/img/botton.png", "botton", "botton.png");

                
                $body = '
                    <!DOCTYPE html>
                    <html lang="en">
                    <img src="cid:top">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    
                    <body>
                        <div style="font-family: Arial, Helvetica, sans-ser">
                            <h2>REGISTRO DE '.$tipoDocumento.'</h2>
                    
                            <p>
                                Estimado(a) <b>'.$nombre.'</b>
                            </p>

                            <p>
                                Le informamos que hemos recibido un Documento de: 
                            </p>

                            <p>
                                Proveedor: <b>'.$nombreProveedor.'.</b> <br>
                                Fecha: <b>'.$date.'</b> <br>
                                Tipo: <b>'.$tipoDocumento.'</b> <br>
                                Número: <b>'.$numeroDoc.'</b> <br>
                                Clave: <b>'.$claveDoc.'</b> <br>
                                Monto: <b>'.$moneda.' '.number_format($monto,2,".",",").'</b> 
                            </p>

                            <p>
                                Dicho documento ya está en nuestras Bases de Datos para su pertinente aceptación y 
                                <br> proceso contable.
                            </p>
                            
                            <p>Saludos.</p>
                            
                            <p>
                                Equipo de Operaciones <br> 
                                Out The Box
                            </p>
                        </div>
                        <img src="cid:botton">
                    
                    
                    </body>
                    
                    </html>
                ';

                //Content
                $mail->CharSet = 'UTF-8';
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Registro de factura';
                $flags = ENT_HTML5;
                $mail->Body = html_entity_decode($body, $flags);

                if ($mail->send()) {

                    $envioCorreo = "COREEO OK ";

                } else {

                    $envioCorreo = "CORREO ERROR";
                    
                };


                echo $envioCorreo;
               
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

    }
}



