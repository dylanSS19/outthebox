<?php
 

/**
 * 
 *	Gmail attachment extractor.
 *
 *	Downloads attachments from Gmail and saves it to a file.
 *	Uses PHP IMAP extension, so make sure it is enabled in your php.ini,
 *	extension=php_imap.dll
 *
 *  Credits:  Sameer Borate email: metapix[at]gmail.com
 */
 



 
set_time_limit(10000); 
 
 
/* connect to gmail with your credentials */
// $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$hostname = '{mail.outthebox-cr.com/imap/ssl}INBOX';

$username = 'facturacion@outthebox-cr.com'; # e.g somebody@gmail.com
$password = 'Facturacion2021*';
 
 
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
 
 
/* get all new emails. If set to 'ALL' instead 
 * of 'NEW' retrieves all the emails, but can be 
 * resource intensive, so the following variable, 
 * $max_emails, puts the limit on the number of emails downloaded.
 * 
 */
$emails = imap_search($inbox,'UNSEEN');
 
/* useful only if the above search is set to 'ALL' */
$max_emails = 250;
 
 $DatosClits;
 $DatosClits2;
/* if any emails found, iterate through each email */
if($emails) {
 
    $count = 1;
 
    /* put the newest emails on top */
    rsort($emails);
 
    /* for every email... */
    foreach($emails as $email_number) 
    {
 
        /* get information specific to this email */
        $overview = imap_fetch_overview($inbox,$email_number,0);
 
        /* get mail message */
        $message = imap_fetchbody($inbox,$email_number,2);
 
        /* get mail structure */
        $structure = imap_fetchstructure($inbox, $email_number);
 
        $attachments = array();
 
        /* if any attachments found... */
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
                    $documento = $attachments[$i]['attachment'];
                //    echo $nombreDoc;
                //    echo '<pre>'; print_r($attachments[$i]); echo '</pre>';
                $DatosClits = BotXmlcontroller::LeerDatosXml($documento, $nombreDoc);
                        
        if(!empty($DatosClits)){

            // echo '<pre>'; print_r($DatosClits); echo '</pre>';

            $DatosClits2 = $DatosClits;
        }

                // echo $DatosClits;
        

                }
            }
        }

 
        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
            if($attachment['is_attachment'] == 1)
            {
//                $filename =  preg_replace("/ /", "-",$attachment['name']);


 $filename =  $attachment['name'];


//    if(empty($filename)) $filename = preg_replace("/ /", "-",$attachment['filename']);
              if(empty($filename)) $filename = $attachment['filename'];
 
                if(empty($filename)) $filename = time() . ".dat";
 
                /* prefix the email number to the filename in case two emails
                 * have the attachment with the same file name.
                 */




                $fp = fopen($filename, "w+");
  

//	fopen($filename);
	        fwrite($fp, $attachment['attachment']);
                fclose($fp);


                $cedula = $DatosClits2["CedulaReceptor"];
                $clave = $DatosClits2["Clave"];

                BotXmlcontroller::GuardarDocumentos($cedula, $clave, $filename);

                if(strripos($filename, "pdf")){

                    BotXmlcontroller::ModificarDatosXml($filename, $clave);
                }

                
            }
 
        }
 
        if($count++ >= $max_emails) break;
    }
 
} 
 





/* close the connection */
imap_close($inbox);
 
echo "Terminado";
 


class BotXmlcontroller{



    public static function LeerDatosXml($documento, $nombreDoc) {
   
        $datosFactura = array();
 
        if(strripos($documento, "xml")){

            $Xml=simplexml_load_string($documento);
          
         
            
            $datosDetalleFactura = array();
            $Consecutivo = $Xml->NumeroConsecutivo;
            $Consecutivo = strval($Consecutivo);
    
                if($Consecutivo[9] == "1" || $Consecutivo[9] == "2" || $Consecutivo[9] == "3" || $Consecutivo[9] == "4" || $Consecutivo[9] == "8"){
    
                    if ($Xml->Mensaje){
    

                    }else{

                        if($Xml->ResumenFactura->CodigoTipoMoneda->CodigoMoneda == "CRC" ||   !isset($Xml->ResumenFactura->CodigoTipoMoneda->CodigoMoneda) || $Xml->ResumenFactura->CodigoTipoMoneda->TipoCambio == "0" || $Xml->ResumenFactura->CodigoTipoMoneda->TipoCambio == 0){

                            $tipoCambio = "1";
                            $codigoMoneda = "CRC";
                        }else{

                            $tipoCambio = $Xml->ResumenFactura->CodigoTipoMoneda->TipoCambio;
                            $codigoMoneda = $Xml->ResumenFactura->CodigoTipoMoneda->CodigoMoneda;
                        }

                        
            
                        $datosFactura = array("Clave" => $Xml->Clave,
                        "Consecutivo" => $Xml->NumeroConsecutivo,
                        "ActividadEconomica" => $Xml->CodigoActividad,
                        "FechaEmision" => $Xml->FechaEmision,
                        "NombreEmisor" => $Xml->Emisor->Nombre,
                        "NombreComercialEmisor" => $Xml->Emisor->NombreComercial,      
                        "CedulaEmisor" => $Xml->Emisor->Identificacion->Numero,
                        "TipoCedulaEmisor" => $Xml->Emisor->Identificacion->Tipo,
                        "NombreReceptor" => $Xml->Receptor->Nombre,
                        "NombreComercialReceptor" => $Xml->Receptor->NombreComercial,
                        "CedulaReceptor" => $Xml->Receptor->Identificacion->Numero,
                        "TipoCedulaReceptor" => $Xml->Receptor->Identificacion->Tipo,
                        "CodicionVenta" => $Xml->CondicionVenta,
                        "MedioPago" => $Xml->MedioPago,
                        "Moneda" => $Xml->ResumenFactura->CodigoTipoMoneda->CodigoMoneda,
                        "TipoCambio" => $tipoCambio,
                        "TotalGravado" => $Xml->ResumenFactura->TotalGravado,
                        "TotalExento" => $Xml->ResumenFactura->TotalExento,
                        "TotalDescuento" => $Xml->ResumenFactura->TotalDescuentos,
                        "TotalIva" => $Xml->ResumenFactura->TotalImpuesto,
                        "TotalFactura" => $Xml->ResumenFactura->TotalComprobante,
                        "TipoDocumento" => $Consecutivo[8].''.$Consecutivo[9],
                        "OtrosCargos" => $Xml->ResumenFactura->TotalOtrosCargos);
                  
                        $datos =  BotXmlcontroller::InsertarDatosXml($datosFactura);
    
                             
                        for($i = 0; $i < count($Xml->DetalleServicio->LineaDetalle); $i++){
    
                            $datosDetalleFactura =array ("idFactura" => $datos,
                            "nombre" => $Xml->DetalleServicio->LineaDetalle[$i]->Detalle,
                            "codigo" => $Xml->DetalleServicio->LineaDetalle[$i]->CodigoComercial->Codigo,
                            "cabys" => $Xml->DetalleServicio->LineaDetalle[$i]->Codigo,
                            "precioUnidad" => $Xml->DetalleServicio->LineaDetalle[$i]->PrecioUnitario,
                            "cantidad" => $Xml->DetalleServicio->LineaDetalle[$i]->Cantidad,      
                            "descuento" => $Xml->DetalleServicio->LineaDetalle[$i]->Descuento->MontoDescuento,
                            "iva" => $Xml->DetalleServicio->LineaDetalle[$i]->Impuesto->Monto,
                            "tarifaIva" => $Xml->DetalleServicio->LineaDetalle[$i]->Impuesto->Tarifa,
                            "subTotal" => $Xml->DetalleServicio->LineaDetalle[$i]->SubTotal,
                            "total" => $Xml->DetalleServicio->LineaDetalle[$i]->MontoTotalLinea,
                            "codImpuesto" => $Xml->DetalleServicio->LineaDetalle[$i]->Impuesto->CodigoTarifa,
                            "codTasaImp" => $Xml->DetalleServicio->LineaDetalle[$i]->Impuesto->Codigo
                            );
    
                            if($datos == "" || $datos == 0 || $datos == "0"){


                            }else{

                                $dtDetalle =  BotXmlcontroller::InsertarDatosDetalleXml($datosDetalleFactura);

                            }

                            
                        }

                        $crearCorreo =  BotXmlcontroller::CrearCorreo($datosFactura);
                    }

        }else{


        }
        
                
                             
            }else{

             

            }  
    
            

      return $datosFactura;

      }


      static public function connect(){

		$link = new PDO("mysql:host=midigitalsat.com;dbname=empresas",
			            "admin",
			            "Heriberto9109");

		$link->exec("set names utf8");

		return $link;

	}

      public static function InsertarDatosXml($datosFactura) {

        $table = "empresas.tbl_sistema_facturacion_Factura_gastos";

       $respuesta = BotXmlcontroller::MdlInsertDatosFactura($table, $datosFactura);

       return $respuesta;

      }

      public static function InsertarDatosDetalleXml($datosDetalleFactura) {

        $table = "empresas.tbl_sistema_facturacion_detalle_Factura_gastos";

       $respuesta = BotXmlcontroller::MdlInsertDatosDetalleFactura($table, $datosDetalleFactura);

       return $respuesta;

      }


      public static function ModificarDatosXml($ruta, $clave) {

        $table = "empresas.tbl_sistema_facturacion_Factura_gastos";

       $respuesta = BotXmlcontroller::MdlModificarDatosFactura($table, $ruta, $clave);

       return $respuesta;

      }


      public static function CrearCorreo($datosFactura) {


        
        $datosClientes = BotXmlcontroller::CargarDatosCliente($datosFactura["CedulaReceptor"]);

        $correo = '{"fileContent":{
            "correo": "'.$datosClientes[0]["email"].'",
            "nombre": "'.$datosFactura["NombreReceptor"].'",
            "nombreProveedor": "'.$datosFactura["NombreEmisor"].'",
            "tipoDocumento": "'.$datosFactura["TipoDocumento"].'",
            "numeroDoc": "'.$datosFactura["Consecutivo"].'",
            "claveDoc": "'.$datosFactura["Clave"].'",
            "moneda": "'.$datosFactura["Moneda"].'",
            "monto": "'.$datosFactura["TotalFactura"].'",
            "fecha": "'.$datosFactura["FechaEmision"].'"
            }
        }';

        $enviarCorreo = BotXmlcontroller::EnviarCorreo($correo);
        // echo '<pre>'; print_r($correo); echo '</pre>';
        // echo '<pre>'; print_r($enviarCorreo); echo '</pre>';


      }


      public static function EnviarCorreo($datosCorreo) {

        $data = $datosCorreo;
        // echo '<pre>'; print_r( $data); echo '</pre>';
       $ch = curl_init("https://outthebox-cr.com/api/api-envio-facturacion.controller.php");
          //$ch = curl_init("https://posfacturar.com/pos_digitalsat/public/api/v5/sale/getBillSearch");
    
              //URL de Produccion http://wcf.facturoporti.com.mx/Timbrado/Servicios.svc/ApiTimbrarCFDI
             //curl_setopt($ch, CURLOPT_URL, "http://posfacturar.com/pos_digitalsat/public/api/v5/sale/add");
            //a true, obtendremos una respuesta de la url, en otro caso,
           //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Se define el tipo de metodo de envio de datos
            curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
            //establecemos el verbo http que queremos utilizar para la petición
           
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            //enviamos el array data
    
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
    
            // echo $response;

       return $response;

      }



      public static function GuardarDocumentos($cedula, $clave, $nombreDoc) {
 
        $datosClientes = BotXmlcontroller::CargarDatosCliente($cedula);
        
        $directorio = "/mnt/blockstorage/html/private/apiHacienda/clientes/".$datosClientes[0]["idtbl_clientes"]."/FacturasGastos/".$clave;

        if (!file_exists($directorio)) {

            mkdir($directorio, 0777,true);
        
        }

        $group="www-data";
        $owner ="www-data";
        exec("chown -R ".$owner.":".$group." /mnt/blockstorage/html/private/apiHacienda/clientes/".$datosClientes[0]["idtbl_clientes"]."/FacturasGastos");
//        exec(" mv ".$nombreDoc."  /mnt/blockstorage/html/private/apiHacienda/clientes/".$datosClientes[0]["idtbl_clientes"]."/FacturasGastos/".$clave."");

$ruta_destino_archivo = "/mnt/blockstorage/html/private/apiHacienda/clientes/".$datosClientes[0]["idtbl_clientes"]."/FacturasGastos/".$clave."/".$nombreDoc;

rename($nombreDoc, $ruta_destino_archivo);

// echo "Nombre documento ".$nombreDoc;



}



      static public function MdlInsertDatosFactura($table, $datosFactura) {

        $db =  BotXmlcontroller::connect();

        $stmt = $db->prepare("INSERT IGNORE INTO $table(clave, consecutivo, actividadEconomica, fechaEmision, nombreEmisor, nombreComerEmisor, cedulaEmisor, tipoCedEmisor, nombreReceptor, nombreComerReceptor, cedulaReceptor, tipoCedReceptor, condicionVenta, MedioPago, moneda, tipoCambio, totalGabado, totalExento, totalDescuento, totalIva, totalComprobante, tipo_doc, otrosCargos) VALUES (:clave, :consecutivo, :actividadEconomica, :fechaEmision, :nombreEmisor, :nombreComerEmisor, :cedulaEmisor, :tipoCedEmisor, :nombreReceptor, :nombreComerReceptor, :cedulaReceptor, :tipoCedReceptor, :condicionVenta, :MedioPago, :moneda, :tipoCambio, :totalGabado, :totalExento, :totalDescuento, :totalIva, :totalComprobante, :tipo_doc, :otrosCargos)");

        $stmt->bindParam(":clave",$datosFactura["Clave"], PDO::PARAM_STR);
        $stmt->bindParam(":consecutivo",$datosFactura["Consecutivo"], PDO::PARAM_STR);
        $stmt->bindParam(":actividadEconomica",$datosFactura["ActividadEconomica"], PDO::PARAM_STR);	
        $stmt->bindParam(":fechaEmision",$datosFactura["FechaEmision"], PDO::PARAM_STR);
        $stmt->bindParam(":nombreEmisor",$datosFactura["NombreEmisor"], PDO::PARAM_STR);
        $stmt->bindParam(":nombreComerEmisor",$datosFactura["NombreComercialEmisor"], PDO::PARAM_STR);
        $stmt->bindParam(":cedulaEmisor",$datosFactura["CedulaEmisor"], PDO::PARAM_STR);
        $stmt->bindParam(":tipoCedEmisor",$datosFactura["TipoCedulaEmisor"], PDO::PARAM_STR);
        $stmt->bindParam(":nombreReceptor",$datosFactura["NombreReceptor"], PDO::PARAM_STR);
        $stmt->bindParam(":nombreComerReceptor",$datosFactura["NombreComercialReceptor"], PDO::PARAM_STR);
        $stmt->bindParam(":cedulaReceptor",$datosFactura["CedulaReceptor"], PDO::PARAM_STR);
        $stmt->bindParam(":tipoCedReceptor",$datosFactura["TipoCedulaReceptor"], PDO::PARAM_STR);
        $stmt->bindParam(":condicionVenta",$datosFactura["CodicionVenta"], PDO::PARAM_STR);
        $stmt->bindParam(":MedioPago",$datosFactura["MedioPago"], PDO::PARAM_STR);
        $stmt->bindParam(":moneda",$datosFactura["Moneda"], PDO::PARAM_STR);
        $stmt->bindParam(":tipoCambio",$datosFactura["TipoCambio"], PDO::PARAM_STR);
        $stmt->bindParam(":totalGabado",$datosFactura["TotalGravado"], PDO::PARAM_STR);
        $stmt->bindParam(":totalExento",$datosFactura["TotalExento"], PDO::PARAM_STR);
        $stmt->bindParam(":totalDescuento",$datosFactura["TotalDescuento"], PDO::PARAM_STR);
        $stmt->bindParam(":totalIva",$datosFactura["TotalIva"], PDO::PARAM_STR);
        $stmt->bindParam(":totalComprobante",$datosFactura["TotalFactura"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc",$datosFactura["TipoDocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":otrosCargos",$datosFactura["OtrosCargos"], PDO::PARAM_STR);

        
        
        if($stmt->execute()){

            return $db->lastInsertId();
        }

        else{

            return $stmt->errorInfo()[2];
        }

        $stmt -> close();

        $stmt =null;


}

static public function MdlInsertDatosDetalleFactura($table, $datosDetalleFactura) {
                
    $stmt = BotXmlcontroller::connect()->prepare("INSERT INTO $table(idFactura, nombre, codigo, cabys, precioUnidad, cantidad, descuento, iva, tarifaIva, subTotal, total, codImpuesto, codTasaImp) VALUES (:idFactura, :nombre, :codigo, :cabys, :precioUnidad, :cantidad, :descuento, :iva, :tarifaIva, :subTotal, :total, :codImpuesto, :codTasaImp)");

    $stmt->bindParam(":idFactura",$datosDetalleFactura["idFactura"], PDO::PARAM_STR);
    $stmt->bindParam(":nombre",$datosDetalleFactura["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":codigo",$datosDetalleFactura["codigo"], PDO::PARAM_STR);	
    $stmt->bindParam(":cabys",$datosDetalleFactura["cabys"], PDO::PARAM_STR);
    $stmt->bindParam(":precioUnidad",$datosDetalleFactura["precioUnidad"], PDO::PARAM_STR);
    $stmt->bindParam(":cantidad",$datosDetalleFactura["cantidad"], PDO::PARAM_STR);
    $stmt->bindParam(":descuento",$datosDetalleFactura["descuento"], PDO::PARAM_STR);
    $stmt->bindParam(":iva",$datosDetalleFactura["iva"], PDO::PARAM_STR);
    $stmt->bindParam(":tarifaIva",$datosDetalleFactura["tarifaIva"], PDO::PARAM_STR);
    $stmt->bindParam(":subTotal",$datosDetalleFactura["subTotal"], PDO::PARAM_STR);
    $stmt->bindParam(":total",$datosDetalleFactura["total"], PDO::PARAM_STR);
     $stmt->bindParam(":codImpuesto",$datosDetalleFactura["codImpuesto"], PDO::PARAM_STR);
    $stmt->bindParam(":codTasaImp",$datosDetalleFactura["codTasaImp"], PDO::PARAM_STR);
    
    if($stmt->execute()){

        return "ok";
    }

    else{

        return $stmt->errorInfo()[2];
    }

    $stmt -> close();

    $stmt =null;


}


public static function CargarDatosCliente($cedula) {

    $table = "empresas.tbl_clientes";

   $respuesta = BotXmlcontroller::MdlCargarDatosCliente($table, $cedula);

   return $respuesta;

  }



  static public function MdlCargarDatosCliente($table, $cedula) {

	$stmt = BotXmlcontroller::connect()->prepare("SELECT * FROM $table where cedula = '$cedula' order by idtbl_clientes desc limit 1");

	$stmt -> execute();

	return $stmt -> fetchAll();

	$stmt -> close();

$stmt =null;


}


static public function MdlModificarDatosFactura($table, $ruta, $clave) {

    $stmt = BotXmlcontroller::connect()->prepare("UPDATE $table set documento_1 = '$ruta' WHERE clave = '$clave'");

    $stmt -> execute();
    
    return $stmt -> fetchAll();
    
    $stmt -> close();
    
    $stmt =null;


}


}


?>
