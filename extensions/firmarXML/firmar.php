<?php

		require(dirname(__FILE__) . '/hacienda/firmador.php');
		use Hacienda\Firmador;


class api_facturacion2controller{


 
		function firmar($pfx, $pin, $xml, $ruta, $fecha_factura)
		{
			// modules_loader("Document");
			$pfx = $pfx;
			$pin = $pin; // PIN de 4 dígitos de la llave criptográfica
			$xml = $xml;

			// Nuevo firmador
			$firmador = new Firmador();

			// Se firma XML y se recibe un string resultado en Base64
			// $base64 = $firmador->firmarXml($pfx, $pin, base64_decode($xml), $fecha_factura, $firmador::TO_BASE64_STRING);
			$base64 = $firmador->firmarXml($pfx, $pin, $xml, $fecha_factura, $firmador::TO_BASE64_STRING);
			
			// print_r($base64);

			// Se firma XML y se recibe un string resultado en Xml
			// $xml_string = $firmador->firmarXml($pfx, $pin, base64_decode($xml),$fecha_factura, $firmador::TO_XML_STRING);

			return $base64;
			// Se firma XML, se guarda en disco duro ($ruta) y se recibe el número de bytes del archivo guardado. En caso de error se recibe FALSE
			// $archivo = $firmador->firmarXml($pfx, $pin, $xml, $firmador::TO_XML_FILE, $ruta);
			// print_r($archivo);
		}

}