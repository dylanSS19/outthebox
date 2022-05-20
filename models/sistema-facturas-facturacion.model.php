<?php
 
require_once "connexion.php";

class FacturacionModel{

   
		static public function MdlCargarClientes($table, $ID_empresa) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_empresa = '$ID_empresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}


        static public function MdlCargarProductos($table, $table2, $table3, $ID_empresa,$idCliente) { 

			$stmt = Connexion::connect()->prepare("SELECT a.idtbl_equipos,
			a.sku,
			a.nombre,
			a.cabys,
			b.codigo_impuesto,
			c.codigo_tarifa,
			a.unidad_medida,
			d.precio as precio_unidad,
			a.tipo 
			 FROM $table a INNER JOIN $table2 b  on a.impuestos = b.idtbl_impuestos 
			 INNER JOIN $table3 c on a.tarifa_iva = c.idtbl_tarifa_impuestos 
			 INNER JOIN 
			(SELECT id_producto,precio FROM empresas.tbl_listas_precios_equipos 
			WHERE id_lista = (SELECT Tipo_lista FROM empresas.tbl_empresas_clientes 
			WHERE idtbl_empresas_clientes= $idCliente)) AS d ON a.idtbl_equipos = d.id_producto WHERE id_empresa = '$ID_empresa';");

			$stmt -> execute();
			//return $stmt;
			return $stmt -> fetchAll();
			

			$stmt -> close();

			$stmt =null; 

		}     

        static public function MdlCargarProductosXId($table, $table2, $table3,$table4,$id_producto, $idCliente) { 

			$stmt = Connexion::connect()->prepare("SELECT a.idtbl_equipos,
			a.sku,
			a.nombre,
			a.cabys,
			b.codigo_impuesto,
			c.codigo_tarifa,
			a.unidad_medida,
			d.precio as precio_unidad,
			a.tipo 
			FROM $table a INNER JOIN $table2 b  on a.impuestos = b.idtbl_impuestos 
			 INNER JOIN $table3 c on a.tarifa_iva = c.idtbl_tarifa_impuestos
			 INNER JOIN 
			(SELECT id_producto,precio FROM empresas.tbl_listas_precios_equipos 
			WHERE id_lista = (SELECT Tipo_lista FROM $table4
			WHERE idtbl_empresas_clientes= $idCliente)) AS d ON a.idtbl_equipos = d.id_producto
			  where idtbl_equipos = '$id_producto'");

			$stmt -> execute();
			//return $stmt;
			return $stmt -> fetchAll();
			

			$stmt -> close();

		$stmt =null;

		}  

        static public function MdlCargarClienteXId($table, $id_cliente) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_empresas_clientes = '$id_cliente'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}  

		static public function MdlCargarSucursales($table) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}  

		static public function MdlCargarCajas($table, $idSucursal) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idsucursal = '$idSucursal'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		} 

		static public function MdlCargarDatosEmpresa($table, $Dtosempresa) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_clientes = '$Dtosempresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		} 

		static public function MdlCargarUnidadMedida($table, $unidadM) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_unidades_medida_hacienda = '$unidadM'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		} 
 
		static public function MdlCargarActividadE($table, $ID_empresa) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_empresa = '$ID_empresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		} 

	/*=================================
	=      CARGAR TIPOS DE MONEDA     =
	===================================*/
	static public function MdlCargarTipoMoneda($table) {
		$stmt = Connexion::connect()->prepare("SELECT distinct nombre,codigo FROM $table;");
		$stmt -> execute();

		return $stmt -> fetchAll();
		//return $stmt;

		$stmt -> close();

		$stmt =null;
	}
 
	static public function MdlIngresarCliente($table, $addCedula, $addNombre, $addTpCedula, $addempresa, $addListPrecio, $addCorreo) { 

		$stmt = Connexion::connect()->prepare("INSERT INTO $table(id_empresa, Nombre, tipo_cedula, cedula, correo, Tipo_lista, nombre_fantasia, activo) VALUES(:id_empresa, :Nombre, :tipo_cedula, :cedula, :correo, :Tipo_lista, :nombre_fantasia, :activo)");

		$activo = 'Si';
	$stmt->bindParam(":id_empresa",$addempresa, PDO::PARAM_STR);
	$stmt->bindParam(":Nombre",$addNombre, PDO::PARAM_STR);
	$stmt->bindParam(":tipo_cedula",$addTpCedula, PDO::PARAM_STR);
	$stmt->bindParam(":cedula",$addCedula, PDO::PARAM_STR);
	$stmt->bindParam(":correo",$addCorreo, PDO::PARAM_STR);
	$stmt->bindParam(":Tipo_lista",$addListPrecio, PDO::PARAM_STR);
	$stmt->bindParam(":nombre_fantasia",$nombre_fantasia, PDO::PARAM_STR);
	$stmt->bindParam(":activo",$activo, PDO::PARAM_STR);
	
	if($stmt->execute()){

		return "ok";
	}

	else{

		return $stmt->errorInfo()[2];
	}

	$stmt -> close();

	$stmt =null;

	} 

	
	static public function MdlImprimirDatosFactura($table1, $table2, $clave) {
		$stmt = Connexion::connect()->prepare("SELECT     a.idtbl_sistema_facturacion_facturas,
		a.id_compania,
		a.sucursal,
		a.caja,
		a.fecha_factura,
		a.fecha_creacion,
		a.cancelado,
		a.consecutivo,
		a.clave,
		IF(a.tipo_documento = '01', 'Factura Electronica', IF(a.tipo_documento = '04', 'Tiquete Electronico', IF(a.tipo_documento = '03', 'Nota Credito Electronica', IF(a.tipo_documento = '02', 'Nota Debito Electronica', '')))) as tipo_documento,
		a.codigo_actividad,
		IF(a.condicion_venta = '01', 'Contado', IF(a.condicion_venta = '02', 'Credito', '')) as condicion_venta,
		a.tipo_personeria,
		a.cedula_cliente,
		a.nombre_cliente,
		a.correo_cliente,
		a.tipo_cambio,
		a.codigo_moneda,
		a.subtotal,
		a.descuento,
		a.impuesto,
		a.otros_cargos,
		a.total,
		a.fecha_estado,
		a.estado_factura,
		a.estado_correo,
		a.detalle_estado_hacienda,
		a.xml_firmado,
		a.plazo_credito,
		a.referencia,
		a.estado_anulacion,
		a.medios_pago,
		a.api,
		a.razon,
		a.nombre_emisor,
		a.cedula_emisor,
		a.correo_emisor,
		a.comentarios,
		b.idtbl_clientes,
		b.nombre_ficticio,
		b.nombre,
		b.tipo_personeria,
		b.cedula,
		b.direccion,
		b.telefono,
		b.email,
		b.id_forma_pago,
		b.dias_credito,
		b.dia_pago,
		b.Tipo_lista,
		b.id_empresa,
		b.logo,
		b.cod_actividad from $table1 a inner join $table2 b on a.id_compania = b.idtbl_clientes where clave = '$clave'");
		$stmt -> execute();

		return $stmt -> fetchAll();
		//return $stmt;

		$stmt -> close();

		$stmt =null;
	}


	static public function MdlImprimirDatosIva($table1, $table2, $idFact) {
		$stmt = Connexion::connect()->prepare("SELECT 
		IF(a.tarifa_iva = '0',
			'IVA 0%',
			IF(a.tarifa_iva = '1',
				'IVA 1%',
				IF(a.tarifa_iva = '2',
					'IVA 2%',
					IF(a.tarifa_iva = '4',
						'IVA 4%',
						IF(a.tarifa_iva = '8',
							'IVA 8%',
							IF(a.tarifa_iva = '13',
								'IVA 13%',
								'')))))) as 'Tipo_iva',
			ifnull(b.impuesto, 0) as totalIva
								
	FROM
		(SELECT 
			nombre, codigo_tarifa, tarifa_iva
		FROM
		$table1) AS a
			LEFT JOIN
		(SELECT 
			sum(impuesto) as impuesto, tasa_Impuesto, codImpuesto
		FROM
		$table2
		WHERE
			id_factura = '$idFact'
		GROUP BY codImpuesto) AS b ON a.codigo_tarifa = b.codImpuesto
	GROUP BY a.tarifa_iva");
		$stmt -> execute();

		return $stmt -> fetchAll();
		//return $stmt;

		$stmt -> close();

		$stmt =null;
	}

	static public function MdlImprimirDatosDetalle($table, $idFact) {
		$stmt = Connexion::connect()->prepare("SELECT * from $table where id_factura = '$idFact'");
		$stmt -> execute();

		return $stmt -> fetchAll();
		//return $stmt;

		$stmt -> close();

		$stmt =null;
	}
	
	static public function MdlFormasPago($table) {
		$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_empresa = '2'");
		$stmt -> execute();

		return $stmt -> fetchAll();
		//return $stmt;

		$stmt -> close();

		$stmt =null;
	}

}