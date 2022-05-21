<?php
    ini_set('memory_limit', '1024M');
    ini_set('user_agent', 'My-Application/2.5');

    use  PHPMailer\PHPMailer\PHPMailer ;
    use  PHPMailer\PHPMailer\Exception ;

require  './PHPMailer-master/src/Exception.php';
require  './PHPMailer-master/src/PHPMailer.php';
require  './PHPMailer-master/src/SMTP.php';

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
                $mail->setFrom('facturacion@outthebox-cr.com');  

   $mail->addAddress('heri9109@gmail.com');  

                
    
           

                //$mail->IsHTML(true);


                //Content
                $mail->CharSet = 'UTF-8';

                                                            //Set email format to HTML
                $mail->Subject = 'Documento Electrónico';

     
                  $mail->AddEmbeddedImage("./image.png", "my-attach", "image.png");
                  $mail->Body = 'Embedded Image: <img alt="PHPMailer" src="cid:my-attach">';
                $mail->IsHTML(true);
             


                              
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                                         if($mail->send()){
                
            echo "COREEO OK";
           
                }else{
                
              echo "CORREO ERROR";

                };

               
            } catch (Exception $e) {
            				

               echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
           /*     $envioCorreo= "CORREO ERROR";
      
                echo $envioCorreo;*/
               

            }