<?php

require_once "autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

require "../../../models/api-correo-mahindra.model.php";

set_time_limit(10000); 
  
 

$hostname = '{mail.outthebox-cr.com/imap/ssl}INBOX';

$username = 'mahindra@digitalsat-cr.com';
$password = 'Mahindra2022*';
 


$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());


$emails = imap_search($inbox,'UNSEEN');

$max_emails = 250;

$DatosClits;
$DatosClits2;


if($emails) {
 
    $count = 1;

    rsort($emails);
 
    foreach($emails as $email_number) 
    {
 

        $overview = imap_fetch_overview($inbox,$email_number,0);
 

        $message = imap_fetchbody($inbox,$email_number,2);
 

        $structure = imap_fetchstructure($inbox, $email_number);
 
        $attachments = array();
 
        
        if(isset($structure->parts) && count($structure->parts)){
            for($i = 0; $i < count($structure->parts); $i++) 
            {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );
               
                if($structure->parts[$i]->ifdparameters) 
                {
                    foreach($structure->parts[$i]->dparameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'filename') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;

                           

                        }
                    }
                }
 
                if($structure->parts[$i]->ifparameters) 
                {
                    foreach($structure->parts[$i]->parameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'name') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }
 
                if($attachments[$i]['is_attachment']) 
                {
                    $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
 
                    /* 4 = QUOTED-PRINTABLE encoding */
                    if($structure->parts[$i]->encoding == 3) 
                    { 
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                       
                    }
                    /* 3 = BASE64 encoding */
                    elseif($structure->parts[$i]->encoding == 4) 
                    { 
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }

                    $nombreDoc = $attachments[$i]['name'];
                    $nombrefilename = $attachments[$i]['filename'];
                    $documento = $attachments[$i]['attachment'];
                //    echo $nombreDoc;
                //    echo '<pre>'; print_r($attachments[$i]); echo '</pre>';
                // $DatosClits = BotXmlcontroller::LeerDatosExcel($documento, $nombreDoc, $nombrefilename);
                        
        // if(!empty($DatosClits)){

            // echo '<pre>'; print_r($DatosClits); echo '</pre>';

        //     $DatosClits2 = $DatosClits;
        // }

                // echo $DatosClits;
        

                }
            }
        }

 
        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
            if($attachment['is_attachment'] == 1)
            {
            //$filename =  preg_replace("/ /", "-",$attachment['name']);


                $filename =  $attachment['name'];


            //if(empty($filename)) $filename = preg_replace("/ /", "-",$attachment['filename']);
              if(empty($filename)) $filename = $attachment['filename'];
 
                if(empty($filename)) $filename = time() . ".dat";
 
                /* prefix the email number to the filename in case two emails
                 * have the attachment with the same file name.
                 */

                $fp = fopen($filename, "w+");

            //	fopen($filename);
	        fwrite($fp, $attachment['attachment']);
            fclose($fp);

            $DatosClits = BotXmlcontroller::LeerDatosExcel($filename);

                if(strripos($filename, "pdf")){


                }
              
            }
 
        }
 
        if($count++ >= $max_emails) break;
    }
 
} 


imap_close($inbox);


class BotXmlcontroller{

    public static function LeerDatosExcel($nombreDoc) {

        $ruta_archivo = "./".$nombreDoc;

          move_uploaded_file($nombreDoc, $ruta_archivo);

            $documento = IOFactory::load($ruta_archivo);
	
            $totalDeHojas = $documento->getSheetCount();

            $indiceHoja = 0;

            $hojaActual = $documento->getSheet($indiceHoja);

            $numeroMayorDeFila = $hojaActual->getHighestRow(); // Numérico

            for ($indiceFila = 11; $indiceFila <= $numeroMayorDeFila; $indiceFila++) {

                $Coorusuario_entrega = "B".$indiceFila;
                $celdausuario_entrega = $hojaActual->getCell($Coorusuario_entrega);
                $usuario_entrega = $celdausuario_entrega->getValue();

                $Coorusuario_recibe = "D".$indiceFila;
                $celdausuario_recibe = $hojaActual->getCell($Coorusuario_recibe);
                $usuario_recibe = $celdausuario_recibe->getValue();

                $Coornumero_transferencia = "E".$indiceFila;
                $celdanumero_transferencia = $hojaActual->getCell($Coornumero_transferencia);
                $numero_transferencia = $celdanumero_transferencia->getValue();

                $Coorfuente = "H".$indiceFila;
                $celdafuente = $hojaActual->getCell($Coorfuente);
                $fuente = $celdafuente->getValue();

                $Coorsub_tipo_transferencia = "I".$indiceFila;
                $celdasub_tipo_transferencia = $hojaActual->getCell($Coorsub_tipo_transferencia);
                $sub_tipo_transferencia = $celdasub_tipo_transferencia->getValue();

                $Coorfecha_transferencia = "K".$indiceFila;
                $celdafecha_transferencia = $hojaActual->getCell($Coorfecha_transferencia);
                $fecha_transferencia = $celdafecha_transferencia->getValue();

                $Coornombre_producto = "L".$indiceFila;
                $celdanombre_producto = $hojaActual->getCell($Coornombre_producto);
                $nombre_producto = $celdanombre_producto->getValue();

                $Coorcategoria_emisor = "M".$indiceFila;
                $celdacategoria_emisor = $hojaActual->getCell($Coorcategoria_emisor);
                $categoria_emisor = $celdacategoria_emisor->getValue();

                $Coorcategoria_destinatario = "N".$indiceFila;
                $celdacategoria_destinatario = $hojaActual->getCell($Coorcategoria_destinatario);
                $categoria_destinatario = $celdacategoria_destinatario->getValue();

                $Coorcantidad_requerimiento = "O".$indiceFila;
                $celdacantidad_requerimiento = $hojaActual->getCell($Coorcantidad_requerimiento);
                $cantidad_requerimiento = $celdacantidad_requerimiento->getValue();

                $Coormrp = "Q".$indiceFila;
                $celdamrp = $hojaActual->getCell($Coormrp);
                $mrp = $celdamrp->getValue();

                $Coorcomision = "R".$indiceFila;
                $celdacomision = $hojaActual->getCell($Coorcomision);
                $comision = $celdacomision->getValue();

                $Coorcbc = "T".$indiceFila;
                $celdacbc = $hojaActual->getCell($Coorcbc);
                $cbc = $celdacbc->getValue();

                $Coorimpuesto = "U".$indiceFila;
                $celdaimpuesto = $hojaActual->getCell($Coorimpuesto);
                $impuesto = $celdaimpuesto->getValue();

                $Coormonto_debitado_emisor = "V".$indiceFila;
                $celdamonto_debitado_emisor = $hojaActual->getCell($Coormonto_debitado_emisor);
                $monto_debitado_emisor = $celdamonto_debitado_emisor->getValue();

                $Coormonto_acreditado_destinatario = "X".$indiceFila;
                $celdamonto_acreditado_destinatario = $hojaActual->getCell($Coormonto_acreditado_destinatario);
                $monto_acreditado_destinatario = $celdamonto_acreditado_destinatario->getValue();

                $Coormonto_pagado = "Z".$indiceFila;
                $celdamonto_pagado = $hojaActual->getCell($Coormonto_pagado);
                $monto_pagado = $celdamonto_pagado->getValue();

                $Coormonto_neto = "AB".$indiceFila;
                $celdamonto_neto = $hojaActual->getCell($Coormonto_neto);
                $monto_neto = $celdamonto_neto->getValue();

                $data = array("usuario_entrega" => $usuario_entrega,
                "usuario_recibe" => $usuario_recibe,
                "numero_transferencia" => $numero_transferencia,	                 
                "fuente" => $fuente,
                "sub_tipo_transferencia" => $sub_tipo_transferencia,
                "fecha_transferencia" => $fecha_transferencia,
                "nombre_producto" => $nombre_producto,
                "categoria_emisor" => $categoria_emisor,
                "categoria_destinatario" => $categoria_destinatario,
                "cantidad_requerimiento" => $cantidad_requerimiento,
                "mrp" => $mrp, 
                "comision" => $comision,
                "cbc" => $cbc,
                "impuesto" => $impuesto,
                "monto_debitado_emisor" => $monto_debitado_emisor,
                "monto_acreditado_destinatario" => $monto_acreditado_destinatario, 
                "monto_pagado" => $monto_pagado,
                "monto_neto" => $monto_neto);

                if($data["numero_transferencia"] != ""){
                    $guardarDatos = BotXmlcontroller::GuardarDatosExcel($data);
                }
           
                // exit();

            }
        
        unlink($nombreDoc);

    }

    public static function GuardarDatosExcel($data) {

        $table = "masivos.tbl_movimientos_mahindra"; 	
      
		$response =  BotXmlcontroller::MdlInsertarDatosMahindra($table, $data);	

		return $response;

    }

    public static function connect() {

        $link = new PDO("mysql:host=midigitalsat.com;dbname=empresas",
        "admin",
        "Heriberto9109");

        $link->exec("set names utf8");

        return $link;

    }

    static public function MdlInsertarDatosMahindra($table, $data) {
			
        $db = BotXmlcontroller::connect();

        $stmt = $db->prepare("INSERT IGNORE  INTO  $table (usuario_entrega, usuario_recibe, numero_transferencia, fuente, sub_tipo_transferencia, fecha_transferencia, nombre_producto, categoria_emisor, categoria_destinatario, cantidad_requerimiento, mrp, comision, cbc, impuesto, monto_debitado_emisor, monto_acreditado_destinatario, monto_pagado, monto_neto) VALUES(:usuario_entrega, :usuario_recibe, :numero_transferencia, :fuente, :sub_tipo_transferencia, :fecha_transferencia, :nombre_producto, :categoria_emisor, :categoria_destinatario, :cantidad_requerimiento, :mrp, :comision, :cbc, :impuesto, :monto_debitado_emisor, :monto_acreditado_destinatario, :monto_pagado, :monto_neto)");				

            $stmt->bindParam(":usuario_entrega",$data["usuario_entrega"], PDO::PARAM_STR);					
            $stmt->bindParam(":usuario_recibe",$data["usuario_recibe"], PDO::PARAM_STR);	
            $stmt->bindParam(":numero_transferencia",$data["numero_transferencia"], PDO::PARAM_STR);
            $stmt->bindParam(":fuente",$data["fuente"], PDO::PARAM_STR);
            $stmt->bindParam(":sub_tipo_transferencia",$data["sub_tipo_transferencia"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_transferencia",$data["fecha_transferencia"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_transferencia",$data["fecha_transferencia"], PDO::PARAM_STR);	
            $stmt->bindParam(":nombre_producto",$data["nombre_producto"], PDO::PARAM_STR);	
            $stmt->bindParam(":categoria_emisor",$data["categoria_emisor"], PDO::PARAM_STR);	
            $stmt->bindParam(":categoria_destinatario",$data["categoria_destinatario"], PDO::PARAM_STR);
            $stmt->bindParam(":cantidad_requerimiento",$data["cantidad_requerimiento"], PDO::PARAM_STR);
            $stmt->bindParam(":mrp",$data["mrp"], PDO::PARAM_STR);			
            $stmt->bindParam(":comision",$data["comision"], PDO::PARAM_STR);	
            $stmt->bindParam(":cbc",$data["cbc"], PDO::PARAM_STR);	
            $stmt->bindParam(":impuesto",$data["impuesto"], PDO::PARAM_STR);	
            $stmt->bindParam(":monto_debitado_emisor",$data["monto_debitado_emisor"], PDO::PARAM_STR);	
            $stmt->bindParam(":monto_acreditado_destinatario",$data["monto_acreditado_destinatario"], PDO::PARAM_STR);	
            $stmt->bindParam(":monto_pagado",$data["monto_pagado"], PDO::PARAM_STR);	
            $stmt->bindParam(":monto_neto",$data["monto_neto"], PDO::PARAM_STR);
           

        if($stmt->execute()){
            return $db->lastInsertId();
        }else{
            return $stmt->errorInfo()[2];
        }

        $stmt -> close();

        $stmt =null;


    }



}