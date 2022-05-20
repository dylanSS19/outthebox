<?php


use  PHPMailer\PHPMailer\PHPMailer ;
use  PHPMailer\PHPMailer\Exception ;

class RecuperarContrasenaFrm1Controller{

	/*=============================================
	=  CARGAR NUMERO DE TELEFONO DEL CLIENTE   =
	=============================================*/

		static public function ctrCargarTelefonoCliente($value){

	       $table = "empresas.tbl_clientes"; 
	           
			$response = RecuperarContrasenaFrm1Model::MdlCargarTelefonoCliente($table, $value);	
			

			return $response;


		} 


/*=============================================
	=  CARGAR NOMBRE DE USUARIO DEL CLIENTE   =
	=============================================*/

		static public function ctrCargarUsuarioCliente($value){

	       $table = "empresas.tbluser_2"; 
	           
			$response = RecuperarContrasenaFrm1Model::MdlCargarUsuarioCliente($table, $value);	
			

			return $response;


		}


/*=============================================
=  INGRESAR CODIGO VALIDACION   =
=============================================*/

		static public function ctrAgregarCodigoValidacion($usuario, $codigo){

	       $table = "empresas.tbluser_2"; 
	           
			$response = RecuperarContrasenaFrm1Model::MdlAgregarCodigoValidacion($table, $usuario, $codigo);	
			

			return $response;


		}


		static public function ctrValidarCorreo($usuario, $correoValid){

			$table = "empresas.tbluser_2"; 
				
			 $response = RecuperarContrasenaFrm1Model::MdlValidarCorreo($table, $usuario, $correoValid);	
			 
 
			 return $response;
 
 
		}

		 static public function ctrValidarCorreoVacio($usuario){

			$table = "empresas.tbluser_2"; 
				
			 $response = RecuperarContrasenaFrm1Model::MdlValidarCorreoVacio($table, $usuario);	
			 
			 return $response;
 
		}

		static public function ctrModificarCorreo($addusuario, $addCorreo){

			$table = "empresas.tbluser_2"; 
				
			 $response = RecuperarContrasenaFrm1Model::MdlModificarCorreo($table, $addusuario, $addCorreo);	
			 
			 return $response;
 
		}

		static public function ctrEnviarCorreo($Sendcodigo, $SendCorreo, $SendUser){

			require  '../extensions/PHPMailer-master/src/Exception.php' ;
			require  '../extensions/PHPMailer-master/src/PHPMailer.php' ;
			require  '../extensions/PHPMailer-master/src/SMTP.php' ;
	
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
	
	
	$table = "empresas.tbluser_2";
	$CodActivacion = RecuperarContrasenaFrm1Model::MdlModificarCodigoAct($table, $Sendcodigo, $SendUser);
	
				//$mail->Host       = 'mail.outthebox-cr.com';  
				$mail->Host = 'ssl://mail.outthebox-cr.com';                    //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'notificaciones@outthebox-cr.com';                     //SMTP username
				$mail->Password   = 'notificaciones2021';                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
				
				//Recipients
				$mail->setFrom('notificaciones@outthebox-cr.com', 'outthebox-cr');
				$mail->addAddress($SendCorreo, '');     //Add a recipient
				// $mail->addAddress('ellen@example.com');               //Name is optional
				// $mail->addReplyTo('info@example.com', 'Information');
			  
				//Attachments
			   
			$mail->AddEmbeddedImage("../views/img/top.png", "top", "top.png");
	
			$mail->AddEmbeddedImage("../views/img/botton.png", "botton", "botton.png");
	
			$Body='<!DOCTYPE html>
			<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
			<head>
			<title>Page 1</title>
			
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
			
			</head>
			<body bgcolor="#ffffff" vlink="blue" link="blue">
			<div id="page1-div" style="width:899px;height:600px;">
			<img src="cid:top">
			<p style="margin: 0; padding: 0;top:194px;left:25px;white-space:nowrap;font-size:22px;font-family:QWMEMI+ArialMT;color:#0388a6;" >Estimado(a)&#160;Usuario: '.$SendUser.'</p>
			<p style="font-size:21px;line-height:25px;font-family:OTWQDY+QuicksandBook;color:#0388a6;margin: 0; padding: 0;position:absolute;top:281px;left:58px;white-space:nowrap">El código de verificación&#160;asignado es ('.$Sendcodigo.')&#160;</p>
			<p style="font-size:27px;font-family:OIVKOB+QuicksandBold;color:#0388a6;margin: 0; padding: 0;position:absolute;top:434px;left:55px;white-space:nowrap" ><b>Out&#160;of&#160;the&#160;box&#160;to&#160;be&#160;out&#160;of&#160;this&#160;world!</b></p>
			<p style="font-size:13px;font-family:OTWQDY+QuicksandBook;color:#0388a6;margin: 0; padding: 0;position:absolute;top:504px;left:87px;white-space:nowrap" >Si&#160;tiene&#160;dificultad&#160;para&#160;ingresar&#160;al&#160;sistema&#160;o&#160;realizar&#160;los&#160;procesos,&#160;</p>
			<p style="font-size:13px;font-family:OTWQDY+QuicksandBook;color:#0388a6;margin: 0; padding: 0;position:absolute;top:520px;left:209px;white-space:nowrap" >debe comunicarse&#160;con&#160;su&#160;proveedor.</p>
			<img src="cid:botton">
			</div>
			</body>
			</html>';
			
			// number_format( (float) $response[$i]["descuento"], 2, '.', ',')
				//Content
			   
				$mail->CharSet = 'UTF-8';
				$mail->Subject = 'Código Cambio Contraseña';
				$mail->Body    = html_entity_decode($Body);
				$mail->isHTML(true);
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
				if($mail->send()){
				
				echo "ok";
		   
				}else{
				
				echo "COREEO ERROR";
	
				};
			   
			} catch (Exception $e) {
			
				echo("<script>console.log('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>");
	
			   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
 
		}

}