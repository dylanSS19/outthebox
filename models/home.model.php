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

	/*=============================================
=                 CARGAR  TABLA TIENDAS                =
=============================================*/

	static public function MdlCargarTablaTiendas($table, $value) {

			

			$stmt = Connexion::connect()->prepare("SELECT tabla_tiendas,privilegio,id_empresa,tabla_dth FROM  $table WHERE idtbl_clientes= '$value'");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt =null;

}

	/*=============================================
=                 CARGAR  TABLA TIENDAS                =
=============================================*/

	static public function MdlCargarDatosPerfil($table, $value) {

			

			$stmt = Connexion::connect()->prepare("SELECT nombre_perfil,img_perfil FROM  $table WHERE idtbluser_2= '$value'");

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;

}



}





