<?php

require_once "connexion.php";

class UsersModel{


	/*=============================================
=                 SHOW USERS                =
=============================================*/

	static public function MdlShowUsersPrivileges($table, $item, $value) {

			

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

	


		$stmt -> close();

		$stmt =null;

}

	/*=============================================
=                 SHOW SALE MAN ROLE                =
=============================================*/

	static public function MdlShowSaleManRole($table, $item, $value) {

			

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;

}

/*=============================================
=                 SHOW USERS                =
=============================================*/

	static public function MdlShowUsers($table, $item, $value) {

		if($item != null){

	

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		} else {

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table");

					$stmt -> execute();

			return $stmt -> fetchAll();


		}


		$stmt -> close();

		$stmt =null;

}

	/*=============================================
=                 SHOW GPS LOCATION                =
=============================================*/

	static public function MdlShowGPSLocation($table) {			

		$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE last_seen > NOW() - INTERVAL 2 HOUR");
			
		$stmt -> execute();

		return $stmt -> fetchALL();

		$stmt -> close();

		$stmt =null;

}


/*=============================================
=                 UPDATE GPS LOCATION             =
=============================================*/

static public function MdlUpdateGPSLocation($table, $value, $value2,  $value3,  $currentDate) { 



	$stmt = Connexion::connect()->prepare("UPDATE $table SET lat = :lat,lon = :lon,last_seen = :last_seen where idtbluser_2 = :idtbluser_2");  

		$stmt->bindParam(":idtbluser_2", $value, PDO::PARAM_STR);

		$stmt->bindParam(":lat", $value2, PDO::PARAM_STR);

		$stmt->bindParam(":lon", $value3, PDO::PARAM_STR);

		$stmt->bindParam(":last_seen", $currentDate, PDO::PARAM_STR);			


		if($stmt->execute()){


			return "ok";
		}

		else{

			return "error";
		}

		$stmt -> close();

		$stmt =null;

}


/*=============================================
=                 EDIT UPDATE USER             =
=============================================*/

static public function MdlUpdateUserUser($table, $value, $value1, $value2) { 



	$stmt = Connexion::connect()->prepare("UPDATE $table SET usuario = :usuario,id_usuario = :id_usuario where idtbluser_2 = :idtbluser_2");  

		$stmt->bindParam(":usuario", $value, PDO::PARAM_STR);

		$stmt->bindParam(":id_usuario", $value2, PDO::PARAM_STR);

		$stmt->bindParam(":idtbluser_2", $value1, PDO::PARAM_STR);		

		if($stmt->execute()){


			return "ok";
		}

		else{

			return "error";
		}

		$stmt -> close();

		$stmt =null;

}

/*=============================================
=                 SHOW TECHNICIAN                =
=============================================*/

	static public function MdlShowTechnicians($table, $item, $value) {


if($item != null){

	//echo("<script>console.log('TECH: " . "NOT" . "');</script>");

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

				$stmt -> execute();

			return $stmt -> fetchALL();

		}else{

			//echo("<script>console.log('TECH: " . "NULL" . "');</script>");

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table where activo='Si' order by nombre asc");

			$stmt -> execute();

			return $stmt -> fetchALL();

		}



		$stmt -> close();

		$stmt =null;

}




/*=============================================
=                 SHOW TECHNICIAN                =
=============================================*/

	static public function MdlLoadTechnicians($table, $item, $value) {


			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

		    $stmt -> execute();

			return $stmt -> fetch();		

			$stmt -> close();

			$stmt =null;

}

/*=============================================
=                 SHOW TECHNICIAN ADMIN             =
=============================================*/

	static public function MdlLoadTechniciansAdmin($table, $item, $value) {


			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

		    $stmt -> execute();

			return $stmt -> fetch();		

			$stmt -> close();

			$stmt =null;

}

/*=============================================
=                 SHOW TECHNICIAN HOME          =
=============================================*/

	static public function MdlShowTechniciansHome($table, $item, $value) {
/*
	echo("<script>console.log('ITE1: " . $item . "');</script>");

echo("<script>console.log('value1: " . $value . "');</script>");

echo("<script>console.log('SELECT * FROM " . $table . " WHERE " . $item . " = " . $value . " ');</script>");*/

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

				$stmt -> execute();

			return $stmt -> fetchAll();



		$stmt -> close();

		$stmt =null;

}




/*=============================================

=                 SHOW SALESMAN                =
=============================================*/

	static public function MdlShowSalesManm($table, $item, $value) {

		if($item != null){

	//echo("<script>console.log('TECH: " . "NOT" . "');</script>");

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

				$stmt -> execute();

			return $stmt -> fetch();

		}else{


			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table where activo='Si' order by nombre asc");

			$stmt -> execute();

			return $stmt -> fetchALL();

		}


		$stmt -> close();

		$stmt =null;

}

/*=============================================
=                 SHOW SALESMAN                =
=============================================*/

	static public function MdlShowSalesManm2($table, $item, $value) {

		if($item != null){

	//echo("<script>console.log('TECH: " . "NOT" . "');</script>");

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

				$stmt -> execute();

			return $stmt -> fetchAll();

		}else{


			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table where activo='Si' order by nombre asc");

			$stmt -> execute();

			return $stmt -> fetchALL();

		}


		$stmt -> close();

		$stmt =null;

}




/*=============================================
=                 ADD USERS                =
=============================================*/

	static public function MdlAddUser($table, $data) {

		$stmt = Connexion::connect()->prepare("INSERT INTO $table(name,user_name,password,profile,picture) VALUES (:name,:user_name,:password,:profile,:picture)");

		$stmt->bindParam(":name",$data["name"], PDO::PARAM_STR);
		$stmt->bindParam(":user_name",$data["user_name"], PDO::PARAM_STR);
		$stmt->bindParam(":password",$data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":profile",$data["profile"], PDO::PARAM_STR);
		$stmt->bindParam(":picture",$data["route"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		}

		else{

			return "error";
		}

		$stmt -> close();

		$stmt =null;


}

/*=============================================
=                 EDIT USERS                =
=============================================*/

static public function MdlEditUser($table, $data) { 


//idtbluser_2, nombre, pass_perfil, privilegios, status, usuario, id_usuario, lat, lon, last_seen, intentos_fallidos, Codigo_recuperacion, nombre_perfil, img_perfil

	$stmt = Connexion::connect()->prepare("UPDATE $table SET  pass = :pass, img_perfil = :img_perfil, nombre_perfil = :nombre_perfil where nombre = :nombre");  

		$stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);		
		$stmt->bindParam(":pass",$data["pass"], PDO::PARAM_STR);
		$stmt->bindParam(":img_perfil",$data["img_perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_perfil",$data["nombre_perfil"], PDO::PARAM_STR);


		if($stmt->execute()){


			return "ok";
		}

		else{

			return "error";
		}

		$stmt -> close();

		$stmt =null;

}

/*=============================================
=                 ACTIVATE USERS                =
=============================================*/

static public function MdlActivateUser($table, $item1, $value1, $item2, $value2){

	$stmt = Connexion::connect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":".$item1,$value1, PDO::PARAM_STR);		
		$stmt->bindParam(":".$item2,$value2, PDO::PARAM_STR);	

		if($stmt->execute()){


			return "ok";
		}

		else{

			return "error";
		}

		$stmt -> close();

		$stmt =null;
}

/*=============================================
=                DELETE USERS                =
=============================================*/

static public function MdlDeleteUser($table, $data){

		$stmt = Connexion::connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt->bindParam(":id",$data, PDO::PARAM_STR);		
	
		if($stmt->execute()){


			return "ok";
		}

		else{

			return "error";
		}

		$stmt -> close();

		$stmt =null;


}

static public function MdlLoadvalidusers($table, $user) {


	$stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
	 SELECT *
	 FROM $table
	 WHERE nombre LIKE '%$user%'), 1, 0)");

	$stmt -> execute();

	return $stmt -> fetch();		

	$stmt -> close();

	$stmt =null;

}


/*=============================================
=                 SHOW TECHNICIAN                =
=============================================*/

static public function MdlLoadusers($table, $user) {


	$stmt = Connexion::connect()->prepare("SELECT intentos_fallidos FROM $table WHERE nombre LIKE '%$user%'");

	$stmt -> execute();

	return $stmt -> fetch();		

	$stmt -> close();

	$stmt =null;

}

/*=============================================
=                 ACTIVATE USERS                =
=============================================*/

static public function MdlupdateAttemptsuser($table, $newintentos, $user){

$stmt = Connexion::connect()->prepare("UPDATE $table SET intentos_fallidos = '$newintentos' WHERE nombre LIKE '%$user%'");	

	if($stmt->execute()){


		return "ok";
	}

	else{

		return "error";
	}

	$stmt -> close();

	$stmt =null;
}

/*=============================================
=                 ACTIVATE USERS                =
=============================================*/

static public function Mdlupdatestatussuser($table, $user){

$stmt = Connexion::connect()->prepare("UPDATE $table SET status = 'Desabilitado' WHERE nombre LIKE '%$user%'");	

	if($stmt->execute()){


		return "ok";
	}

	else{

		return "error";
	}

	$stmt -> close();

	$stmt =null;
}


static public function MdlExistencia($table, $correo) {

	$stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
	 SELECT *
	 FROM $table
	 WHERE nombre LIKE '%$correo%'), 1, 0)");
	 
	$stmt -> execute();

	return $stmt -> fetch();		

	$stmt -> close();

	$stmt =null;

}

static public function MdlAgregarUsuario($table,$nombrePerfil,$correo,$password) {

	$stmt = Connexion::connect()->prepare("INSERT INTO $table(nombre, pass, privilegios, status, usuario, id_usuario,intentos_fallidos,nombre_perfil,modulos,img_perfil) 
										VALUES (:nombre, :pass, :privilegios, :status, :usuario, :id_usuario, :intentos_fallidos, :nombre_perfil, :modulos, :img_perfil)");

	$estado = "Disponible";
	$privilegio = "Invitado";
	$usuario = "N/A";
	$idusuario = 0;
	$intentosFallidos = 0;
	$modulos = "[]";
	$imgPerfil = "";
	
	$stmt->bindParam(":nombre",$correo, PDO::PARAM_STR);
	$stmt->bindParam(":pass",$password, PDO::PARAM_STR);
	$stmt->bindParam(":privilegios",$privilegio, PDO::PARAM_STR);
	$stmt->bindParam(":status",$estado, PDO::PARAM_STR);
	$stmt->bindParam(":usuario",$usuario, PDO::PARAM_STR);
	$stmt->bindParam(":id_usuario",$idusuario, PDO::PARAM_STR);
	$stmt->bindParam(":intentos_fallidos",$intentosFallidos, PDO::PARAM_STR);
	$stmt->bindParam(":nombre_perfil",$nombrePerfil, PDO::PARAM_STR);
	$stmt->bindParam(":modulos",$modulos, PDO::PARAM_STR);
	$stmt->bindParam(":img_perfil",$imgPerfil, PDO::PARAM_STR);
	
	
	//$stmt->bindParam(":img_perfil",$foto, PDO::PARAM_STR);

	if($stmt->execute()){

		return "ok";
	}

	else{

		return $stmt->errorInfo()[2];
	}

	$stmt -> close();

	$stmt =null;


}

 
static public function MdlCargarEmpresasUsuarios($table, $idusuario) { 

	$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_usuario = '$idusuario'");

	$stmt -> execute();

	return $stmt -> fetchAll();
	// return $stmt;

	$stmt -> close();

$stmt =null;

}


static public function MdlCargarTablaTiendas($table, $value) {

	$stmt = Connexion::connect()->prepare("SELECT tabla_tiendas,privilegio,id_empresa,tabla_dth FROM  $table WHERE idtbl_clientes= '$value'");

	$stmt -> execute();

	return $stmt -> fetchAll();

$stmt -> close();

$stmt =null;

}





	/***********************************
	 *  VALIDAR QUE NO EXISTA USUARIO  *
	 ***********************************/

	static public function MdlValidarNuevoUsuario($table, $correo) {

		$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE nombre='$correo';");
		
		$stmt -> execute();
		return $stmt -> fetch();

		$stmt -> close();
		$stmt =null;
	}

	/***********************************
	 *     AGREGAR FOTO DE USUARIO     *
	 ***********************************/

	static public function MdlAgregarImagenUsuario($table, $data) { 
	
		$stmt = Connexion::connect()->prepare("UPDATE $table SET  img_perfil = :img_perfil where idtbluser_2 = :idtbluser_2");  
	
		$stmt->bindParam(":img_perfil",$data["img_perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":idtbluser_2",$data["idUsuario"], PDO::PARAM_STR);
	
		if($stmt->execute()){
			return "ok";
		} else {
			return "error";
		}
	
		$stmt -> close();
	
		$stmt =null;
	
	}


	static public function MdlAgregarUsuarioFacebook($table, $id, $foto, $nombre, $correo) {

		$stmt = Connexion::connect()->prepare("INSERT INTO $table(nombre, pass, privilegios, status, nombre_perfil, img_perfil, Correo, modulos) VALUES (:nombre, :pass, :privilegios, :status, :nombre_perfil, :img_perfil, :Correo , :modulos)");
	
		$estado = "Disponible";
		$privilegio = "Invitado";
		$modulos = '["34"]';
		$stmt->bindParam(":nombre",$correo, PDO::PARAM_STR);
		$stmt->bindParam(":pass",$id, PDO::PARAM_STR);
		$stmt->bindParam(":privilegios",$privilegio, PDO::PARAM_STR);
		$stmt->bindParam(":status",$estado, PDO::PARAM_STR);
		$stmt->bindParam(":nombre_perfil",$nombre, PDO::PARAM_STR);
		$stmt->bindParam(":img_perfil",$foto, PDO::PARAM_STR);
		$stmt->bindParam(":Correo",$correo, PDO::PARAM_STR);
		$stmt->bindParam(":modulos",$modulos, PDO::PARAM_STR);

	
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

