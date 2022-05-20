<?php

require_once "connexion.php";

class HomeModel{


	/*=============================================
=                 CARGAR cATEGORIAS SERVICIOS                =
=============================================*/

	static public function MdlCargarCategoriaServicios($table) {

			

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE activo = 'Si'");

			$stmt -> execute();

			return $stmt -> fetchAll();

/*return $stmt;	
*/

		$stmt -> close();

		$stmt =null;

}



static public function MdlCargarIdempresa($table, $value) {

			

	$stmt = Connexion::connect()->prepare("SELECT id_empresa FROM  $table WHERE idtbl_clientes = '$value'");

	$stmt -> execute();

	return $stmt -> fetchAll();

/*return $stmt;	
*/

$stmt -> close();

$stmt =null;

}

	/*=============================================
=                 CARGAR SUB TIPOS SERVICIOS                =
=============================================*/

	static public function MdlCargarSubTipoServicios($table,$item, $value) {

			

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item= '$value' and activo = 'Si'");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt =null;

}

	/*=============================================
=                 CARGAR  SERVICIOS                =
=============================================*/

	static public function MdlCargarServicios($table,$item, $value) {

			

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item= '$value' and activo = 'Si'");

			$stmt -> execute();

			return $stmt -> fetchAll();

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

			static public function MdlcargarDatosEmpresa($table, $id_empresa) {

				$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE idtbl_clientes = '$id_empresa'");				

				$stmt -> execute();

				return $stmt->fetchAll();

				// return $stmt;

				$stmt -> close();

				$stmt =null;

	}


}





