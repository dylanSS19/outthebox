<?php
 
require_once "connexion.php";

class api_facturacionModel {


		static public function MdlValidarCredencialesUsuarios($table, $usuario, $contrasena, $cedula) {

	
				$stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
	             SELECT *
	             FROM $table
	             WHERE usuario_facturacion = '$usuario' AND contrasena_facturacion = '$contrasena' and cedula = '$cedula'), 1, 0)");				

				$stmt -> execute();

				return $stmt->fetch();
							// return $stmt;

				$stmt -> close();

				$stmt =null;

	}


		static public function MdlcargarDatosUsuario($table, $contrasena, $cedula) {

	
				$stmt = Connexion::connect()->prepare("SELECT  * FROM $table WHERE contrasena_facturacion = '$contrasena' and cedula = '$cedula'");				

				$stmt -> execute();

				return $stmt->fetch();
							// return $stmt;

				$stmt -> close();

				$stmt =null;

	}


		static public function MdlcargarUidadMedida($table) {

				$stmt = Connexion::connect()->prepare("SELECT  * FROM $table WHERE tipo = 'servicio'");				

				$stmt -> execute();

				return $stmt->fetchAll();
							// return $stmt;

				$stmt -> close();

				$stmt =null;

	}



			static public function MdlcargarDatosEmpresa($table, $id_empresa) {

				$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE idtbl_clientes = '$id_empresa'");				

				$stmt -> execute();

				return $stmt->fetchAll();

				// return $stmt;

				$stmt -> close();

				$stmt =null;

	} 

				static public function MdlInsertarDatosFactura($table, $id_compania, $sucursal, $caja, $fecha_factura, $fecha_creacion, $cancelado, $consecutivo_hacienda, $clave_hacienda, $tipeDoc, $actividaEconomica,$condicionVenta, $cedula, $nombre , $correo , $tipoCambio, $moneda, $tipo_cedula, $plazo, $clvRefencia, $mediopago, $api, $razon, $comentarioFact) {
			
			$db = Connexion::connect();

			$estado = "enviado";

			$stmt = $db->prepare("INSERT INTO  $table (id_compania, sucursal, caja, fecha_factura, fecha_creacion, cancelado, consecutivo, clave, tipo_documento, codigo_actividad, condicion_venta, tipo_personeria, cedula_cliente, nombre_cliente, correo_cliente, tipo_cambio, codigo_moneda, fecha_estado, estado_factura, plazo_credito, referencia, medios_pago, api, razon, comentarios) VALUES(:id_compania, :sucursal, :caja, :fecha_factura, :fecha_creacion, :cancelado, :consecutivo, :clave, :tipo_documento, :codigo_actividad, :condicion_venta, :tipo_personeria, :cedula_cliente, :nombre_cliente, :correo_cliente, :tipo_cambio, :codigo_moneda, :fecha_estado, :estado_factura, :plazo_credito, :referencia, :medios_pago, :api, :razon, :comentarios)");				
 
			    $stmt->bindParam(":id_compania",$id_compania, PDO::PARAM_STR);					
				$stmt->bindParam(":sucursal",$sucursal, PDO::PARAM_STR);	
				$stmt->bindParam(":caja",$caja, PDO::PARAM_STR);
				$stmt->bindParam(":fecha_factura",$fecha_factura, PDO::PARAM_STR);
				$stmt->bindParam(":fecha_creacion",$fecha_creacion, PDO::PARAM_STR);
				$stmt->bindParam(":cancelado",$cancelado, PDO::PARAM_STR);	
				$stmt->bindParam(":consecutivo",$consecutivo_hacienda, PDO::PARAM_STR);	
				$stmt->bindParam(":clave",$clave_hacienda, PDO::PARAM_STR);	
				$stmt->bindParam(":tipo_documento",$tipeDoc, PDO::PARAM_STR);	
				$stmt->bindParam(":codigo_actividad",$actividaEconomica, PDO::PARAM_STR);
				$stmt->bindParam(":condicion_venta",$condicionVenta, PDO::PARAM_STR);
				$stmt->bindParam(":cedula_cliente",$cedula, PDO::PARAM_STR);			
				$stmt->bindParam(":nombre_cliente",$nombre, PDO::PARAM_STR);	
				$stmt->bindParam(":correo_cliente",$correo, PDO::PARAM_STR);	
				$stmt->bindParam(":tipo_cambio",$tipoCambio, PDO::PARAM_STR);	
				$stmt->bindParam(":codigo_moneda",$moneda, PDO::PARAM_STR);	
				$stmt->bindParam(":fecha_estado",$fecha_factura, PDO::PARAM_STR);	
				$stmt->bindParam(":estado_factura",$estado, PDO::PARAM_STR);	
				$stmt->bindParam(":tipo_personeria",$tipo_cedula, PDO::PARAM_STR);
				$stmt->bindParam(":plazo_credito",$plazo, PDO::PARAM_STR);
				$stmt->bindParam(":referencia",$clvRefencia, PDO::PARAM_STR);
				$stmt->bindParam(":medios_pago",$mediopago, PDO::PARAM_STR);
				$stmt->bindParam(":api",$api, PDO::PARAM_STR);
				$stmt->bindParam(":razon",$razon, PDO::PARAM_STR);
				$stmt->bindParam(":comentarios",$comentarioFact, PDO::PARAM_STR);

		if($stmt->execute()){


		return $db->lastInsertId();
		

		}else{


		return $stmt->errorInfo()[2];


		}

		$stmt -> close();

		$stmt =null;


	}


				static public function MdlModificarDatosFactura($table, $TotalVentaNeta, $total_descuento_new, $total_impuesto_new, $otros_cargos, $TotalComprobante, $IdFactura) {

				$stmt = Connexion::connect()->prepare("UPDATE $table SET subtotal=:subtotal, descuento=:descuento, impuesto=:impuesto, otros_cargos=:otros_cargos, total=:total WHERE idtbl_sistema_facturacion_facturas=:IdFactura");				

			$stmt->bindParam(":subtotal",$TotalVentaNeta, PDO::PARAM_STR);
			$stmt->bindParam(":descuento",$total_descuento_new, PDO::PARAM_STR);
			$stmt->bindParam(":impuesto",$total_impuesto_new, PDO::PARAM_STR);	
			$stmt->bindParam(":otros_cargos",$otros_cargos, PDO::PARAM_STR);	
			$stmt->bindParam(":total",$TotalComprobante, PDO::PARAM_STR);	
			$stmt->bindParam(":IdFactura",$IdFactura, PDO::PARAM_STR);

		if($stmt->execute()){

			return "OK";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


	}





static public function MdlInsertarDetalleFactura($table, $IdFactura, $codigo, $nombre, $cantidad, $precio_unidad, $subtotal, $descuento, $impuesto, $total, $costo, $cabys, $tasa_impuesto, $codImpuesto, $cosTasaImp, $unidadM,$categoria) {

				$stmt = Connexion::connect()->prepare("INSERT INTO  $table (id_factura, codigo, nombre, cantidad, precio_unidad, subtotal, descuento, impuesto, total, costo, cabys, tasa_Impuesto, codImpuesto, codTasaImp, unidadMedida, categoria) VALUES(:id_factura, :codigo, :nombre, :cantidad, :precio_unidad, :subtotal, :descuento, :impuesto, :total, :costo, :cabys, :tasa_Impuesto, :codImpuesto, :codTasaImp, :unidadMedida, :categoria)");				

		    $stmt->bindParam(":id_factura",$IdFactura, PDO::PARAM_STR);	
			$stmt->bindParam(":codigo",$codigo, PDO::PARAM_STR);	
			$stmt->bindParam(":nombre",$nombre, PDO::PARAM_STR);	
			$stmt->bindParam(":cantidad",$cantidad, PDO::PARAM_STR);
			$stmt->bindParam(":precio_unidad",$precio_unidad, PDO::PARAM_STR);
			$stmt->bindParam(":subtotal",$subtotal, PDO::PARAM_STR);	
			$stmt->bindParam(":descuento",$descuento, PDO::PARAM_STR);	
			$stmt->bindParam(":impuesto",$impuesto, PDO::PARAM_STR);	
			$stmt->bindParam(":total",$total, PDO::PARAM_STR);	
			$stmt->bindParam(":costo",$costo, PDO::PARAM_STR);
			$stmt->bindParam(":cabys",$cabys, PDO::PARAM_STR);
			$stmt->bindParam(":tasa_Impuesto",$tasa_impuesto, PDO::PARAM_STR);
			$stmt->bindParam(":codImpuesto",$codImpuesto, PDO::PARAM_STR);
			$stmt->bindParam(":codTasaImp",$cosTasaImp, PDO::PARAM_STR);
			$stmt->bindParam(":unidadMedida",$unidadM, PDO::PARAM_STR);
			$stmt->bindParam(":categoria",$categoria, PDO::PARAM_STR);

		if($stmt->execute()){

			return "OK";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


	}


	static public function MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja, $random, $tipo, $id_empresa) {

		$db = Connexion::connect();


// $ultimo_consecutivo = "221";
			$stmt = $db->prepare("INSERT IGNORE INTO  $table (ultimo_consecutivo, sucursal, caja, random, tipo, id_empresa) VALUES(:ultimo_consecutivo, :sucursal, :caja, :random, :tipo, :id_empresa)");				

		    // $stmt->bindParam(":id_factura",$id_factura, PDO::PARAM_STR);	
			$stmt->bindParam(":ultimo_consecutivo",$ultimo_consecutivo, PDO::PARAM_STR);
			$stmt->bindParam(":sucursal",$sucursal, PDO::PARAM_STR);	
			$stmt->bindParam(":caja",$caja, PDO::PARAM_STR);
			$stmt->bindParam(":random",$random, PDO::PARAM_STR);
			$stmt->bindParam(":tipo",$tipo, PDO::PARAM_STR);
			$stmt->bindParam(":id_empresa",$id_empresa, PDO::PARAM_STR);

		if($stmt->execute()){


		return $db->lastInsertId();
		

		}else{


		return $stmt->errorInfo()[2];


		}

		$stmt -> close();

		$stmt =null;


	}


	static public function MdlcargarUltimoConsecutivo($table, $sucursal , $caja, $tipo, $id_empresa) {

		$stmt = Connexion::connect()->prepare("SELECT ifnull(max(ultimo_consecutivo),0) FROM $table where sucursal = '$sucursal' and caja = '$caja' and tipo = '$tipo' and id_empresa = '$id_empresa'");				

		$stmt -> execute();

		return $stmt->fetch();
							// return $stmt;

		$stmt -> close();

		$stmt =null;

	}

		static public function MdlCargarDatosFactura($table, $clave) {

		$stmt = Connexion::connect()->prepare("SELECT * FROM $table where clave = '$clave'");				

		$stmt -> execute();

		return $stmt->fetchAll();
							// return $stmt;

		$stmt -> close();

		$stmt =null;

	}



			static public function MdlCargarDetalleFactura($table, $id_factura) {

		$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_factura = '$id_factura'");				

		$stmt -> execute();

		return $stmt->fetchAll();
							// return $stmt;

		$stmt -> close();

		$stmt =null;

	}



	static public function MdlCargarEstadoFacturas($table, $clave_fac, $idempresa, $fechaFac) {

		$stmt = Connexion::connect()->prepare("SELECT * FROM $table where clave = '$clave_fac' and id_compania = '$idempresa' and fecha_factura between '$fechaFac 00:00:00' and '$fechaFac 23:59:59'");				

		$stmt -> execute();

		return $stmt->fetchAll();
		// return $stmt;

		$stmt -> close();

		$stmt =null;

	}

	/*=============================================
		=  VALIDAR QUE LA CONSECUTIVO NO EXISTA      =
		=============================================*/

			static public function MdlUpdateconse($table, $id_factura, $random) {

		$db = Connexion::connect();

		$stmt = $db->prepare("UPDATE $table SET id_factura='$id_factura' WHERE random = '$random'");				



		if($stmt->execute()){


		return 'ok';
		

		}else{


		return $stmt->errorInfo()[2];


		}

		$stmt -> close();

		$stmt =null;


		}

	static public function MdlValidarSucursal($table, $sucursal) {

		$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE idsucursal = '$sucursal' ");				

		$stmt -> execute();

		return $stmt->fetch();
		// return $stmt;

		$stmt -> close();

		$stmt =null;

	}

		static public function MdlValidarCaja($table, $caja, $idsucursal) {

		$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE idcaja = '$caja' and idsucursal = '$idsucursal'");				

		$stmt -> execute();

		return $stmt->fetch();
		// return $stmt;

		$stmt -> close();

		$stmt =null;

	}


		static public function MdlModificarEstadoFactura($table, $clave) {

		$stmt = Connexion::connect()->prepare("UPDATE $table SET estado_factura = 'Por Enviar' where clave = '$clave'");				

	
		if($stmt->execute()){


		return 'ok';
		

		}else{


		return $stmt->errorInfo()[2];


		}

		$stmt -> close();

		$stmt =null;

	}



		static public function MdlGuardarXmlFirmado($table, $clave, $xml) {

		$stmt = Connexion::connect()->prepare("UPDATE $table SET xml_firmado = '$xml' where clave = '$clave'");				

	
		if($stmt->execute()){


		return 'ok';
		

		}else{


		return $stmt->errorInfo()[2];


		}

		$stmt -> close();

		$stmt =null;

	}



 
	static public function MdlModificarEstadoAnulacion($table, $clave, $estadoAnulacion) {

		$stmt = Connexion::connect()->prepare("UPDATE $table SET estado_anulacion='$estadoAnulacion'  WHERE clave= '$clave'");				


		if($stmt->execute()){

			return "OK";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


	}


	static public function MdlInsertarDatosEmisor($table, $nombre, $cedula, $tipo_cedula, $correo, $direccion, $telefono, $provincia, $canton, $distrito, $senas, $idFactura) {

		$stmt = Connexion::connect()->prepare("INSERT INTO  $table (nombre, cedula, tipo_cedula, correo, direccion, telefono, provincia, canton, distrito, senas, idFactura) VALUES(:nombre, :cedula, :tipo_cedula, :correo, :direccion, :telefono, :provincia, :canton, :distrito, :senas, :idFactura)");				

		$stmt->bindParam(":nombre",$nombre, PDO::PARAM_STR);	
		$stmt->bindParam(":cedula",$cedula, PDO::PARAM_STR);	
		$stmt->bindParam(":tipo_cedula",$tipo_cedula, PDO::PARAM_STR);	
		$stmt->bindParam(":correo",$correo, PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$direccion, PDO::PARAM_STR);
		$stmt->bindParam(":telefono",$telefono, PDO::PARAM_STR);	
		$stmt->bindParam(":provincia",$provincia, PDO::PARAM_STR);	
		$stmt->bindParam(":canton",$canton, PDO::PARAM_STR);	
		$stmt->bindParam(":distrito",$distrito, PDO::PARAM_STR);	
		$stmt->bindParam(":senas",$senas, PDO::PARAM_STR);
		$stmt->bindParam(":idFactura",$idFactura, PDO::PARAM_STR);
		
	if($stmt->execute()){

		return "OK";
	}

	else{

		return $stmt->errorInfo()[2];
	}

	$stmt -> close();

	$stmt =null;


	}


	static public function MdlCargarIdFactura($table, $clave) {

		$stmt = Connexion::connect()->prepare("SELECT idtbl_sistema_facturacion_Factura_gastos FROM $table WHERE clave = '$clave'");				

		$stmt -> execute();

		return $stmt->fetch();
		// return $stmt;

		$stmt -> close();

		$stmt =null;

	}

	
static public function MdlUpdateDatosFacturaGastos($table, $clave, $procesado, $estado, $consecutivoReceptor) {

		$stmt = Connexion::connect()->prepare("UPDATE $table SET procesado=:procesado, estadoProcesado=:estadoProcesado, consecutivoReceptor=:consecutivoReceptor WHERE clave=:clave");				

	$stmt->bindParam(":clave",$clave, PDO::PARAM_STR);
	$stmt->bindParam(":procesado",$procesado, PDO::PARAM_STR);
	$stmt->bindParam(":estadoProcesado",$estado, PDO::PARAM_STR);
	$stmt->bindParam(":consecutivoReceptor",$consecutivoReceptor, PDO::PARAM_STR);


if($stmt->execute()){

	return "OK";
}

else{

	return $stmt->errorInfo()[2];
}

$stmt -> close();

$stmt =null;


}



static public function MdlEliminarDatosFactura($table, $clave) { 

	$stmt = Connexion::connect()->prepare("DELETE FROM $table WHERE clave = '$clave'");

	if($stmt->execute()){

		return "ok";
	}

	else{

		return $stmt->errorInfo()[2];
	}

	$stmt -> close();

	$stmt =null;

}

static public function MdlEliminarUltConsecutivo($table, $table2, $clave) { 

	$stmt = Connexion::connect()->prepare("DELETE a.* FROM $table a
	INNER JOIN $table2 b ON a.id_factura = b.idtbl_sistema_facturacion_facturas
	WHERE (b.clave = '$clave')");

	if($stmt->execute()){

		return "ok";
	}

	else{

		return $stmt->errorInfo()[2];
	}

	$stmt -> close();

	$stmt =null;

}

}