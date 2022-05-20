<?php

require_once "connexion.php";

class api_facturacionModel2 {


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

				$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE idtbl_empresas = '$id_empresa'");				

				$stmt -> execute();

				return $stmt->fetchAll();

				// return $stmt;

				$stmt -> close();

				$stmt =null;

	}

				static public function MdlInsertarDatosFactura($table, $id_compania, $sucursal, $caja, $fecha_factura, $fecha_creacion, $cancelado, $consecutivo_hacienda, $clave_hacienda, $tipeDoc, $actividaEconomica,$condicionVenta, $cedula, $nombre , $correo , $tipoCambio, $moneda) {
			
			$db = Connexion::connect();

			$stmt = $db->prepare("INSERT INTO  $table (id_compania, sucursal, caja, fecha_factura, fecha_creacion, cancelado, consecutivo, clave, tipo_documento, codigo_actividad, condicion_venta, cedula_cliente, nombre_cliente, correo_cliente, tipo_cambio, codigo_moneda, fecha_estado, estado_factura) VALUES(:id_compania, :sucursal, :caja, :fecha_factura, :fecha_creacion, :cancelado, :consecutivo, :clave, :tipo_documento, :codigo_actividad, :condicion_venta, :cedula_cliente, :nombre_cliente, :correo_cliente, :tipo_cambio, :codigo_moneda, :fecha_estado, :estado_factura)");				

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
				$stmt->bindParam(":estado_factura","Enviado", PDO::PARAM_STR);	

			

		if($stmt->execute()){


		return $db->lastInsertId();
		

		}else{


		//return $stmt->errorInfo()[2];

		              echo '{"RETURN ":DATASSSSS: '.  $stmt->errorInfo()[2]  .'}';

 return;


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





static public function MdlInsertarDetalleFactura($table, $IdFactura, $codigo, $nombre, $cantidad, $precio_unidad, $subtotal, $descuento, $impuesto, $total, $costo) {

				$stmt = Connexion::connect()->prepare("INSERT INTO  $table (id_factura, codigo, nombre, cantidad, precio_unidad, subtotal, descuento, impuesto, total, costo) VALUES(:id_factura, :codigo, :nombre, :cantidad, :precio_unidad, :subtotal, :descuento, :impuesto, :total, :costo)");				

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
			
		if($stmt->execute()){

			return "OK";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


	}


	static public function MdlInsertarUltimoConsecutivo($table, $id_factura, $ultimo_consecutivo, $sucursal, $caja) {

$db = Connexion::connect();

			$stmt = $db->prepare("INSERT INTO  $table (id_factura, ultimo_consecutivo, sucursal, caja) VALUES(:id_factura, :ultimo_consecutivo, :sucursal, :caja)");				

		    $stmt->bindParam(":id_factura",$id_factura, PDO::PARAM_STR);	
			$stmt->bindParam(":ultimo_consecutivo",$ultimo_consecutivo, PDO::PARAM_STR);
			$stmt->bindParam(":sucursal",$sucursal, PDO::PARAM_STR);	
			$stmt->bindParam(":caja",$caja, PDO::PARAM_STR);

		if($stmt->execute()){


		return $db->lastInsertId();
		

		}else{


		return $stmt->errorInfo()[2];


		}

		$stmt -> close();

		$stmt =null;


	}


	static public function MdlcargarUltimoConsecutivo($table, $sucursal , $caja) {

		$stmt = Connexion::connect()->prepare("SELECT max(ultimo_consecutivo) FROM $table where sucursal = '$sucursal' and caja = '$caja'");				

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

			static public function MdlValUltimoConsecutivo($table, $value) {

					$stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
	             SELECT *
	             FROM $table
	             WHERE ultimo_consecutivo = '$value'), 'Exists', 'no')");			

					$stmt -> execute();

					return $stmt -> fetch();

					$stmt -> close();

				$stmt =null;


		}





}