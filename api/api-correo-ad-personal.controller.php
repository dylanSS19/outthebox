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

        if (api_AdPersonal::is_json(json_encode($data["fileContent"])) == "true"){
            $correo = $data["fileContent"]["correo"];
            $correoRRHH = $data["fileContent"]["correoRRHH"];
            $nombre = $data["fileContent"]["nombre"];
            $concepto = $data["fileContent"]["concepto"];
            $dias = $data["fileContent"]["dias"];
            $planilla = $data["fileContent"]["planilla"];
            $fechaDesde = $data["fileContent"]["fechaDesde"];
            $fechaHasta = $data["fileContent"]["fechaHasta"];
            $comentario = $data["fileContent"]["comentario"];

            api_AdPersonal::generarCorreo($correo, $correoRRHH, $nombre, $concepto, $dias, $planilla, $fechaDesde, $fechaHasta, $comentario);
        }

}


class api_AdPersonal {

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
    public static function generarCorreo($correo, $correoRRHH, $nombre, $concepto, $dias, $planilla, $fechaDesde, $fechaHasta, $comentario) {
        $mail = new PHPMailer(true);
        date_default_timezone_set('America/Costa_Rica');
        $dateDesde = date("d/m/Y", strtotime($fechaDesde));
        $dateHasta = date("d/m/Y", strtotime($fechaHasta));
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
                $mail->setFrom('notificaciones@outthebox-cr.com', 'Dpto. Recursos Humanos');
                $mail->addAddress($correo);     //Add a recipient
                
                $correoRRHH = explode(',', $correoRRHH);
                
                
                for ($i = 0; $i < count($correoRRHH)-1; $i++) {
                    $mail->addAddress($correoRRHH[$i]);
                }
                

                
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // 'info@example.com', 'Information');
                // $mail->addCC('cc@example.com');


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
                            <h2>REGISTRO DE AD PERSONAL</h2>
                    
                            <p>
                                Estimado(a) <b>'.$nombre.'</b>
                            </p>

                            <p>
                                Se ha realizado un nuevo registro en la Nomina <b>'.$planilla.'</b> con el <br>concepto de <b>'.$concepto.'</b>, 
                                con fechas de <b>'.$dateDesde.'</b> <br>hasta <b>'.$dateHasta.'</b>, para un total
                                de <b>'.$dias.'</b> días, donde se añadio el comentario:<br><br>
                                <b>'.$comentario.'</b>.  
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
                $mail->Subject = 'REGISTRO DE AD PERSONAL';
                $flags = ENT_HTML5;
                $mail->Body = html_entity_decode($body, $flags);

                if ($mail->send()) {
                    $envioCorreo = "COREEO OK";
                } else {
                    $envioCorreo = "CORREO ERROR";
                };
                echo $envioCorreo;
               
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

    }
}



?>