<?php

require_once "connexion.php";

class  RecuperarContrasenaFrm1Model{

/*=============================================
= CARGAR NUMERO DE TELEFONO DEL CLIENTE             =
=============================================*/

	static public function MdlCargarTelefonoCliente($table,$value) {


$stmt = Connexion::connect()->prepare("SELECT ifnull(telefono , 0) FROM $table WHERE telefono = '$value' ");

			$stmt -> execute();

			return $stmt -> fetch();
			// return $stmt;	

		$stmt -> close();

		$stmt =null;

}


/*=============================================
= CARGAR NUMERO DE TELEFONO DEL CLIENTE             =
=============================================*/

	static public function MdlCargarUsuarioCliente($table, $value) {

		$stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
			SELECT *
			FROM $table
			WHERE nombre =  '$value'), 1, 0)");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;	

		$stmt -> close();

		$stmt =null;

}


/*=============================================
= INGRESAR CODIGO VALIDACION           =
=============================================*/

	static public function MdlAgregarCodigoValidacion($table, $usuario, $codigo) {


$stmt = Connexion::connect()->prepare("UPDATE $table SET Codigo_recuperacion = '$codigo' WHERE nombre = '$usuario' and privilegios LIKE '%Cliente%'");

		if($stmt->execute()){


			return "OK";
		}

		else{

			return  $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;

}



static public function MdlValidarCorreo($table, $usuario, $correoValid) {


	$stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
		SELECT *
		FROM $table
		WHERE nombre =  '$usuario' AND Correo = '$correoValid'), 1, 0)");

		$stmt -> execute();

		return $stmt -> fetchAll();
		// return $stmt;	

	$stmt -> close();

	$stmt =null;

}

static public function MdlValidarCorreoVacio($table, $usuario) {


	$stmt = Connexion::connect()->prepare("SELECT  IF(correo IS NULL or correo = '', 'empty', correo) as correo from $table where nombre = '$usuario'");

		$stmt -> execute();

		return $stmt -> fetchAll();
		// return $stmt;	

	$stmt -> close();

	$stmt =null;

}

	static public function MdlModificarCorreo($table, $addusuario, $addCorreo) {


			$stmt = Connexion::connect()->prepare("UPDATE $table SET Correo = '$addCorreo' WHERE nombre = '$addusuario'");
	
				if($stmt->execute()){
		
					return "ok";

				}else{
		
					return  $stmt->errorInfo()[2];
				}
		
				$stmt -> close();		
				$stmt =null;
	
	}

	static public function MdlModificarCodigoAct($table, $CodigoAct, $SendUser) {


		$stmt = Connexion::connect()->prepare("UPDATE $table SET Codigo_recuperacion = '$CodigoAct' WHERE nombre = '$SendUser'");

			if($stmt->execute()){
	
				return "ok";

			}else{
	
				return  $stmt->errorInfo()[2];
			}
	
			$stmt -> close();		
			$stmt =null;

}

}