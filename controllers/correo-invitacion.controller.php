<?php

ini_set('memory_limit', '1024M');
ini_set('user_agent', 'My-Application/2.5');


use  PHPMailer\PHPMailer\PHPMailer ;
use  PHPMailer\PHPMailer\Exception ;



class CorreoInvitadosController{



        static public function ctrEnviarCorreo($idevento, $idusuario){

            require_once   '../extensions/PHPMailer-master/src/Exception.php';
            require_once   '../extensions/PHPMailer-master/src/PHPMailer.php';
            require_once   '../extensions/PHPMailer-master/src/SMTP.php';

            $table = "empresas.tbl_calendario"; 
            $tableUser = "empresas.tbluser_2"; 

            $datosEvento = CalendarioEvetosModel::MdlCargarEventos($table, $idusuario);		

            $datosUsuario = CalendarioEvetosModel::MdlCargarUsuario($tableUser, $idusuario);

            return $datosUsuario; 

            $mail = new PHPMailer(true);

            $mail->isSMTP(); 
            $mail->SMTPKeepAlive = true;   
             $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true));


            $mail->Host = 'ssl://mail.outthebox-cr.com';                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'notificaciones@outthebox-cr.com';                     //SMTP username
            $mail->Password   = 'notificaciones2021';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = 
            $mail->setFrom('notificaciones@outthebox-cr.com', 'Notificaciones OutOfTheBOX');

            $mail->addAddress($datosUsuario[0]["Correo"]);

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

             //Content
             $mail->CharSet = 'UTF-8';

             //Set email format to HTML
            $mail->Subject = 'Documento Electrónico con número consecutivo '.$datosFac[0]["consecutivo"].' del  '. $date .' emitido por '.$nombre_empresa.' para '.$datosFac[0]["nombre_cliente"].'';

            $mail->Body =  html_entity_decode($Body);
            $mail->IsHTML(true);
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            // $mail->SMTPDebug = SMTP::DEBUG_SERVER

             

        }


}