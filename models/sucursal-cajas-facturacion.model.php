<?php
 
require_once "connexion.php";

class SucursalesCajasModel{
  
	/*=============================================
	=                 LOAD SUBCATEGORIA               =
	=============================================*/

		static public function MdlCargarSucursal($table, $table2) {


				$stmt = Connexion::connect()->prepare("SELECT a.nombre,a.idsucursal,b.nombre as caja,b.idcaja FROM $table a left join $table2 b on a.idtbl_sucursal = b.idsucursal");			

				$stmt -> execute();

				return $stmt -> fetchAll();

				// return $stmt;

				$stmt -> close();

			$stmt =null;


	}
 


	/*=============================================
			=  CARGAR SUCURSALES X EMPRESA        =
	=============================================*/

		static public function MdlCargarSucursalxEmpresa($table) {

				$stmt = Connexion::connect()->prepare("SELECT * FROM $table");			

				$stmt -> execute();

				return $stmt -> fetchAll();

				$stmt -> close();

			$stmt =null;


	}


		/*=============================================
		=  CREAR TABLA SUCURSALES POR EMPRESA          =
		=============================================*/

	static public function MdlCrearSucursal($idempresa) {

		 		$db = Connexion::connect();

				$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS empresas.tbl_sucursal_$idempresa(
		  idtbl_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		  nombre varchar(100) DEFAULT NULL,
		  idsucursal varchar(10) DEFAULT NULL)");
			
			
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
		=  CREAR TABLA SUCURSALES POR EMPRESA          =
		=============================================*/

	static public function MdlCrearCajas($idempresa) {

		 		$db = Connexion::connect();

				$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS empresas.tbl_cajas_$idempresa(
		  idtbl_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		  nombre varchar(100) DEFAULT NULL,
		  idcaja varchar(10) DEFAULT NULL,
		  idsucursal varchar(10) DEFAULT NULL,
		  valInventario varchar(2) DEFAULT'Si' NULL,
		  bodega varchar(10) DEFAULT NULL,
		  formasPago varchar(2) DEFAULT NULL,
		  horaInicio TIME NULL ,
		  horaCierre TIME NULL ,
		  aperturaCaja varchar(2) DEFAULT NULL)");
			
			
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
=        INSERTAR DATOS DE LA SUCURSAL       =
=============================================*/

	static public function MdlAgregarSucursal($table, $data) {


 		$db = Connexion::connect();


		$stmt = $db->prepare("INSERT INTO $table(nombre, idsucursal) VALUES (:nombre, :idsucursal)");

		$stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":idsucursal",$data["idsucursal"], PDO::PARAM_STR);
			
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
=        INSERTAR DATOS DE LA SUCURSAL       =
=============================================*/

	static public function MdlAgregarCajas($table, $data) {


 		$db = Connexion::connect();


		$stmt = $db->prepare("INSERT INTO $table(nombre, idcaja, idsucursal) VALUES (:nombre, :idcaja, :idsucursal)");

		$stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":idcaja",$data["idcaja"], PDO::PARAM_STR);
		$stmt->bindParam(":idsucursal",$data["idsucursal"], PDO::PARAM_STR);
			
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
	=  VALIDAR QUE LA SUCURSAL NO EXISTA      =
	=============================================*/

		static public function MdlValSucursales($table, $value) {

				$stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
             SELECT *
             FROM $table
             WHERE idsucursal = '$value'), 'no', 'ok')");			

				$stmt -> execute();

				return $stmt -> fetch();

				$stmt -> close();

			$stmt =null;


	}


	/*=============================================
	=  VALIDAR QUE LA CAJAS NO EXISTA      =
	=============================================*/

		static public function MdlValCajas($table, $value,  $value2) {

				$stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
             SELECT *
             FROM $table
             WHERE idcaja = '$value' and idsucursal = '$value2'), 'no', 'ok')");			

				$stmt -> execute();

				return $stmt -> fetch();

				$stmt -> close();

			$stmt =null;


	}




	/*=============================================
			=  CARGAR SUCURSALES       =
	=============================================*/

		static public function MdlCSucursalesID($table, $idsucursal) {

				$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_sucursal = '$idsucursal'");			

				$stmt -> execute();

				return $stmt -> fetch();

				$stmt -> close();

			$stmt =null;


	}


		/*=============================================
		= INSERTAR ULTIMO CONSECUTIVO DE LAS FACTURAS =
		=============================================*/

	static public function MdlAgregarUltimoConse($table, $data) {

 		$db = Connexion::connect();

		$stmt = $db->prepare("INSERT INTO $table(id_factura, ultimo_consecutivo, sucursal, caja, tipo, id_empresa) VALUES (:id_factura, :ultimo_consecutivo, :sucursal, :caja, :tipo, :id_empresa)");

		$stmt->bindParam(":id_factura",$data["id_factura"], PDO::PARAM_STR);
		$stmt->bindParam(":ultimo_consecutivo",$data["ultimo_consecutivo"], PDO::PARAM_STR);
		$stmt->bindParam(":sucursal",$data["sucursal"], PDO::PARAM_STR);
		$stmt->bindParam(":caja",$data["caja"], PDO::PARAM_STR);	
		$stmt->bindParam(":tipo",$data["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_empresa",$data["id_empresa"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


}


static public function MdlCargarUltimoConse($table, $Searchtipo, $SearchSucursal, $SearchCaja, $Searchempresa) {

	$stmt = Connexion::connect()->prepare("SELECT ifnull(max(ultimo_consecutivo),0) FROM $table where sucursal = '$SearchSucursal' and caja = '$SearchCaja' and tipo = '$Searchtipo' and id_empresa = '$Searchempresa'");			

	$stmt -> execute();

	// return $stmt;

	return $stmt -> fetchAll();

	$stmt -> close();

$stmt =null;


}


}