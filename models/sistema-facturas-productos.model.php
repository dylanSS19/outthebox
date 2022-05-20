<?php
 
require_once "connexion.php";

class ProductosModel{

  
/*============================================= 
=          CARGAR PRODUCTOS    =
=============================================*/

		static public function MdlCargarEmpresasUsuarios($table, $idusuario) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}

/*============================================= 
=          CARGAR UNIDAD MEDIDA    =
=============================================*/

		static public function MdlCargarUnidadMedida($table) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table order by descripcion asc");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}



/*============================================= 
=          CARGAR UNIDAD MEDIDA    =
=============================================*/

		static public function MdlAgregarProductos($table, $id_empresa, $cabys, $codigo, $unidad, $tarifa, $cantidad, $descripcion, $codImpuesto, $categoria) { 

			$stmt = Connexion::connect()->prepare("INSERT INTO $table(sku, nombre, cabys, impuestos, id_empresa, activo, tarifa_iva, unidad_medida, cantidad, tipo) VALUES(:sku, :nombre, :cabys, :impuestos, :id_empresa, :activo, :tarifa_iva, :unidad_medida, :cantidad, :tipo)");

		$activo = 'Si';
		$stmt->bindParam(":id_empresa",$id_empresa, PDO::PARAM_STR);
		$stmt->bindParam(":cabys",$cabys, PDO::PARAM_STR);
		$stmt->bindParam(":sku",$codigo, PDO::PARAM_STR);
		$stmt->bindParam(":unidad_medida",$unidad, PDO::PARAM_STR);
		$stmt->bindParam(":tarifa_iva",$tarifa, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad",$cantidad, PDO::PARAM_STR);
		$stmt->bindParam(":nombre",$descripcion, PDO::PARAM_STR);
		$stmt->bindParam(":impuestos",$codImpuesto, PDO::PARAM_STR);
		$stmt->bindParam(":activo",$activo, PDO::PARAM_STR);
		$stmt->bindParam(":tipo",$categoria, PDO::PARAM_STR);

 
		if($stmt->execute()){

			return "ok";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;

		}


/*============================================= 
= CARGAR PRODUCTOS POR EMPRESA SELECCIONADA   =
=============================================*/

		static public function MdlCargarProductos($table, $id_empresa) { 

			
			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_empresa = '$id_empresa' order by nombre asc");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}

/*============================================= 
= CARGAR PRODUCTOS POR ID SELECCIONADA   =
=============================================*/

		static public function MdlCargarProductosXid($table, $id_proucto) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_equipos = '$id_proucto'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}




/*============================================= 
=          EDITAR PRODUCTOS   =
=============================================*/

		static public function MdlEditarProductos($table, $Id_producto, $CodCabys, $Codigo_comercial, $Unidad_Medida, $Tarifa, $Cantidad, $Descripcion,  $impuesto, $categoria) { 

			$stmt = Connexion::connect()->prepare("UPDATE $table SET nombre ='$Descripcion', cabys ='$CodCabys', unidad_medida ='$Unidad_Medida', tarifa_iva ='$Tarifa', cantidad='$Cantidad', impuestos ='$impuesto', tipo = '$categoria'  WHERE idtbl_equipos = '$Id_producto'");

			
		if($stmt->execute()){

			return "ok";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;

		}

		static public function MdlCargarTimpuestos($table) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where activo = 'Si'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}

		static public function MdlCargarTarifaImpuesto($table) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}
	
	/*==================================
	=      CARGAR LISTAS PRECIOS       =
	===================================*/

	static public function MdlCargarListasPrecios($table1, $table2, $table3, $idProducto, $idEmpresa) {
		
		$stmt = Connexion::connect()->prepare("SELECT 
												a.idtbl_listas_precio,
												b.idtbl_listas_precios_equipos,
												a.nombre,
												IFNULL(b.precio, 0) AS precio,
												IFNULL(b.costo, 0) AS costo,
												IFNULL(b.margen, 0) AS margen,
												IFNULL(b.porcentaje, 0) AS porcentaje,
    											c.tipo_costo
											FROM
												(SELECT 
													idtbl_listas_precio, nombre
												FROM
													$table1
												WHERE
													idempresa = '$idEmpresa' AND activo = 'Si') AS a
													LEFT JOIN
												(SELECT 
													idtbl_listas_precios_equipos,id_producto, id_lista, precio, costo, margen, porcentaje
												FROM
													$table2
												WHERE
													id_producto = '$idProducto'
												GROUP BY id_lista) AS b ON a.idtbl_listas_precio = b.id_lista
												LEFT JOIN
    											(SELECT idtbl_equipos,tipo_costo 
												FROM $table3) AS c ON c.idtbl_equipos = b.id_producto ;");




		$stmt -> execute();

		return $stmt -> fetchAll();
		// return $stmt;

		$stmt -> close();

		$stmt =null;
		
	}


	/*=====================================
	=       INSERTAR LISTA DE PRECIOS     =
	=======================================*/
	static public function MdlInsertarListaPrecios($table1,$table2,$idEmpresa,$idProducto,$nombreLista,$precio,$costo,$margen,$porcentaje) {
		$stmt = Connexion::connect()->prepare("INSERT INTO $table1 (id_producto, id_lista, precio, costo, margen, porcentaje) 
												VALUES 
												($idProducto, 
												(SELECT idtbl_listas_precio FROM $table2
												where nombre='$nombreLista' and idempresa=$idEmpresa and activo='si'), 
												$precio, $costo, $margen, $porcentaje);
		
											");
		//return $stmt;
		if($stmt->execute()){
			return "ok";
		} else {
			return $stmt->errorInfo();
			//return "error";
		}

		$stmt -> close();
		$stmt =null;
	}

	/*=====================================
	=     ACTUALIZAR LISTAS DE PRECIOS    =
	=======================================*/
	static public function MdlActualizarListaPrecios($table,$id,$nombre,$precio,$costo,$margen,$porcentaje) {
		$stmt = Connexion::connect()->prepare("UPDATE $table  
											SET precio = '$precio', costo = '$costo', margen = '$margen' 
											WHERE (idtbl_listas_precios_equipos = '$id');
											");
		//return $stmt;
		if($stmt->execute()){
			return "ok";
		} else {
			return $stmt->errorInfo()[2];
		}

		$stmt -> close();
		$stmt =null;
									
	}


	/*==================================
	=          CARGAR COSTOS           =
	====================================*/ 
	static public function MdlCargarCostos($table1,$table2,$sku, $idEmpresa, $tipoCosto) {
		$stmt = Connexion::connect()->prepare("SELECT a.nombre,ifnull(b.ultimo_costo,0) as ultimoCosto FROM
											(SELECT * FROM $table1 WHERE sku = $sku AND id_empresa = $idEmpresa AND tipo_costo = '$tipoCosto') AS a
											LEFT JOIN 
											(SELECT * FROM $table2 WHERE id_empresa = $idEmpresa) AS b ON b.codigo = a.sku;");
		$stmt -> execute();
		return $stmt -> fetchAll();
		// return $stmt;

		$stmt -> close();
		$stmt =null;
	
		
	}

	/*==================================
	=       CARGAR TIPO DE COSTO       =
	====================================*/
	static public function MdlCargarTipoCostos($table, $idEmpresa, $sku) {
		$stmt = Connexion::connect()->prepare("SELECT tipo_costo 
												FROM  $table
												WHERE sku=$sku AND id_empresa=$idEmpresa");
		$stmt -> execute();
		return $stmt -> fetchAll();
		// return $stmt;

		$stmt -> close();
		$stmt =null;
	}

	/*==============================
	=     CAMBIAR TIPO DE COSTO    =
	================================*/
	static public function MlCambiarTipoCostos($table, $idEmpresa, $sku, $tipoCosto) {
		$stmt = Connexion::connect()->prepare("UPDATE $table 
												SET tipo_costo = '$tipoCosto' 
												WHERE sku = $sku AND id_empresa=$idEmpresa;
											");
		//return $stmt;
		if($stmt->execute()){
			return "ok";
		} else {
			return $stmt->errorInfo()[2];
		}

		$stmt -> close();
		$stmt =null;
	}


	/*================================
  	=    VERIFICAR CODIGO PRODUCTO   =
 	=================================*/
	static public function MdlVerificarCodProductos($table, $idEmpresa, $sku) {
		$stmt = Connexion::connect()->prepare("SELECT sku,nombre FROM $table WHERE sku=$sku AND id_empresa=$idEmpresa;");
		$stmt -> execute();

		//return $stmt;
		return $stmt -> fetch();
		

		$stmt -> close();

		$stmt =null;
	}

	/*==================================
	=    VERIFICAR LISTAS DE PRECIOS   =
	====================================*/
	static public function MdlVerificarListasPrecios($table, $idEmpresa) {
		$stmt = Connexion::connect()->prepare("SELECT idtbl_listas_precio,nombre FROM $table where idempresa = $idEmpresa AND activo='si';");

		$stmt -> execute();

		//return $stmt;
		return $stmt -> fetch();
		

		$stmt -> close();

		$stmt =null;
	}


	/*================================
	=   INSERTAR LISTA DE PRODUCTOS  =
	=================================*/

	static public function MdlInsertarListaProductos($idEmpresa, $table1, $listaProductos) {

		$query = '';
		
		$listaProductos = json_decode($listaProductos,true);

		//return json_encode($listaProductos[2]['NOMBRE']);
		$sku = "";
		$nombre = "";
		$cabys = "";
		$unidadMedida = "";
		$cantidad = "";
		$tipoProd = "";

		for ($i = 0; $i < count($listaProductos)-1; $i++) {

			$sku = json_encode($listaProductos[$i]['SKU']);
			$nombre = str_replace('"','',json_encode($listaProductos[$i]['NOMBRE']));
			$cabys = json_encode($listaProductos[$i]['CABYS']);
			$unidadMedida = json_encode($listaProductos[$i]['UNIDAD DE MEDIDA']);
			$cantidad = json_encode($listaProductos[$i]['CANTIDAD']);
			$tarifaIva = json_encode($listaProductos[$i]['TARIFA IVA']);
			$tipoProd = json_encode($listaProductos[$i]['TIPO']);
			$query .= "INSERT IGNORE INTO $table1(sku, impuestos, nombre, cabys, id_empresa, tarifa_iva, activo, unidad_medida, cantidad, tipo) 
						VALUES('$sku',
								'1', 
								'$nombre', 
								'$cabys', 
								'$idEmpresa', 
								'$tarifaIva',
								'Si',
								'$unidadMedida', 
								'$cantidad',
								'$tipoProd');\n";

		}
		$stmt = Connexion::connect()->prepare($query);

		 //return 'ok';
		if($stmt->execute()){
			return 'ok';
		} else {
			return $stmt->errorInfo()[2];
		}

		$stmt -> close();
		$stmt =null;
	}
}