<?php


require_once "connexion.php";

class ClientesModel{
 
 
/*=============================================
=                 EDIT CLIENT                =
=============================================*/

static public function MdlEditarClientes($table, $data) { 

	$stmt = Connexion::connect()->prepare("UPDATE $table SET nombre_ficticio = :nombre_ficticio, nombre = :nombre, tipo_personeria = :tipo_personeria, cedula = :cedula, direccion = :direccion, regimen = :regimen, telefono = :telefono, email = :email, provincia = :provincia, canton = :canton, distrito = :distrito, pin_p12 = :pin_p12, pin_p12_prueba = :pin_p12_prueba, usuario_token = :usuario_token, contrasena_token = :contrasena_token, usuario_token_prueba = :usuario_token_prueba, contrasena_token_prueba = :contrasena_token_prueba, ruta_12 = :ruta_12, ruta_12_prueba = :ruta_12_prueba where idtbl_clientes = :idtbl_clientes");  

		$stmt->bindParam(":idtbl_clientes",$data["idtbl_clientes"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_ficticio",$data["nombre_ficticio"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_personeria",$data["tipo_personeria"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula",$data["cedula"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$data["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":regimen",$data["regimen"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono",$data["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email",$data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":provincia",$data["provincia"], PDO::PARAM_STR);
	    $stmt->bindParam(":canton",$data["canton"], PDO::PARAM_STR);
		$stmt->bindParam(":distrito",$data["distrito"], PDO::PARAM_STR);
		$stmt->bindParam(":pin_p12",$data["pin_p12"], PDO::PARAM_STR);
		$stmt->bindParam(":pin_p12_prueba",$data["pin_p12_prueba"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_token",$data["usuario_token"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena_token",$data["contrasena_token"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_token_prueba",$data["usuario_token_prueba"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena_token_prueba",$data["contrasena_token_prueba"], PDO::PARAM_STR);
		// $stmt->bindParam(":privilegio",$data["privilegio"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta_12",$data["ruta_12"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta_12_prueba",$data["ruta_12_prueba"], PDO::PARAM_STR);


		if($stmt->execute()){


			return "OK";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;

}

		/*=============================================
=                 LOAD EDIT CLIENTS                =
=============================================*/

	static public function MdlCargarClientesEditar($table, $item, $value) {


			/* echo "<script>console.log('SELECT * FROM " . $table . " where ". $item . " = ". $value . "' );</script>";*/



			$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt -> close();

		$stmt =null;

  
}

		/*=============================================
		=                 LOAD  users                =
		=============================================*/

	static public function MdlCargarUsuarios($table , $idusuario) {

			/* echo "<script>console.log('SELECT * FROM " . $table . " where ". $item . " = ". $value . "' );</script>";*/

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbluser_2 like '$idusuario'");

			$stmt -> execute();

			return $stmt -> fetchAll();

			$stmt -> close();

		$stmt =null;


}

	/*=============================================
=                 ACTIVATE Clients                =
=============================================*/

static public function MdlActivateUser($table, $item1, $value1, $item2, $value2){

	$stmt = Connexion::connect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":".$item1,$value1, PDO::PARAM_STR);		
		$stmt->bindParam(":".$item2,$value2, PDO::PARAM_STR);	

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
	=                 ADD CLIENTE                =
	=============================================*/

	static public function MdlAgregarCLiente($table, $data) {

		 $db = Connexion::connect();

		// $stmt = $db->prepare("INSERT INTO $table(codigo, nombre_ficticio, nombre, tipo_personeria, cedula, id_empresa, direccion, regimen, telefono, email, provincia, canton, distrito, latitud, longitud, activo, id_usuario, pin_p12, pin_p12_prueba, usuario_token, contrasena_token, usuario_facturacion, contrasena_facturacion, usuario_token_prueba, contrasena_token_prueba, privilegio) VALUES (:codigo, :nombre_ficticio, :nombre, :tipo_personeria, :cedula,  :id_empresa, :direccion, :regimen, :telefono, :email, :provincia, :canton, :distrito, :latitud, :longitud, :activo, :id_usuario, :pin_p12, :pin_p12_prueba, :usuario_token, :contrasena_token, :usuario_facturacion, :contrasena_facturacion, :usuario_token_prueba, :contrasena_token_prueba, :privilegio)");
		$stmt = $db->prepare("INSERT INTO $table(codigo, nombre_ficticio, nombre, tipo_personeria, cedula, id_empresa, direccion, regimen, telefono, email, provincia, canton, distrito, latitud, longitud, activo, id_usuario, usuario_facturacion, contrasena_facturacion, privilegio, serviciosInteres) VALUES (:codigo, :nombre_ficticio, :nombre, :tipo_personeria, :cedula,  :id_empresa, :direccion, :regimen, :telefono, :email, :provincia, :canton, :distrito, :latitud, :longitud, :activo, :id_usuario, :usuario_facturacion, :contrasena_facturacion, :privilegio, :serviciosInteres)");


		$stmt->bindParam(":codigo",$data["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_ficticio",$data["nombre_ficticio"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_personeria",$data["tipo_personeria"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula",$data["cedula"], PDO::PARAM_STR);
		$stmt->bindParam(":id_empresa",$data["id_empresa"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$data["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":regimen",$data["regimen"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono",$data["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email",$data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":provincia",$data["provincia"], PDO::PARAM_STR);
	    $stmt->bindParam(":canton",$data["canton"], PDO::PARAM_STR);
		$stmt->bindParam(":distrito",$data["distrito"], PDO::PARAM_STR);
		$stmt->bindParam(":latitud",$data["latitud"], PDO::PARAM_STR);
		$stmt->bindParam(":longitud",$data["longitud"], PDO::PARAM_STR);
		$stmt->bindParam(":activo",$data["activo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario",$data["id_usuario"], PDO::PARAM_STR);	
		// $stmt->bindParam(":pin_p12",$data["pin_p12"], PDO::PARAM_STR);
	    // $stmt->bindParam(":pin_p12_prueba",$data["pin_p12_prueba"], PDO::PARAM_STR);
		// $stmt->bindParam(":usuario_token",$data["usuario_token"], PDO::PARAM_STR);
		// $stmt->bindParam(":contrasena_token",$data["contrasena_token"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_facturacion",$data["usuario_facturacion"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena_facturacion",$data["contrasena_facturacion"], PDO::PARAM_STR);
		// $stmt->bindParam(":usuario_token_prueba",$data["usuario_token_prueba"], PDO::PARAM_STR);
		// $stmt->bindParam(":contrasena_token_prueba",$data["contrasena_token_prueba"], PDO::PARAM_STR);
		$stmt->bindParam(":privilegio",$data["privilegio"], PDO::PARAM_STR);
		$stmt->bindParam(":serviciosInteres",$data["serviciosInteres"], PDO::PARAM_STR);

		


		if($stmt->execute()){

			return $db->lastInsertId();
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


}


/*=============================================
=                 ADD CLIENTE                =
=============================================*/

	static public function MdlAgregarUsuario($table, $data) {


 $db = Connexion::connect();


		$stmt = $db->prepare("INSERT INTO $table(nombre, pass, privilegios, status, usuario, lat, lon, nombre_perfil, Correo) VALUES (:nombre, :pass, :privilegios, :status, :usuario, :lat, :lon, :nombre_perfil, :Correo)");

		$stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":pass",$data["pass"], PDO::PARAM_STR);
		$stmt->bindParam(":privilegios",$data["privilegios"], PDO::PARAM_STR);
		$stmt->bindParam(":status",$data["status"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$data["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":lat",$data["lat"], PDO::PARAM_STR);
		$stmt->bindParam(":lon",$data["lon"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_perfil",$data["nombre_perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":Correo",$data["correo"], PDO::PARAM_STR);
		if($stmt->execute()){

			return $db->lastInsertId();
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


}


/*=============================================
=                 ADD EMPRESA                =
=============================================*/

	static public function MdlAgregarEmpresa($table, $data) {


 $db = Connexion::connect();


		$stmt = $db->prepare("INSERT INTO $table(nombre_ficticio, nombre, cedula, direccion, telefono) VALUES (:nombre_ficticio, :nombre, :cedula, :direccion, :telefono)");

		$stmt->bindParam(":nombre_ficticio",$data["nombre_ficticio"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula",$data["cedula"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono",$data["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$data["direccion"], PDO::PARAM_STR);
	
		if($stmt->execute()){

			return $db->lastInsertId();
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


}


static public function MdlEditarEmpresa($table, $idcliente, $idempresa){

	$db = Connexion::connect();
   
		   $stmt = $db->prepare("update $table set id_cliente = '$idcliente' where idtbl_empresas = '$idempresa'");
   	   
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
=   ADD EMPRESAs por usuario               =
=============================================*/

	static public function MdlAgregarUsuarioxEmpresa($table, $data) {


 $db = Connexion::connect();


		$stmt = $db->prepare("INSERT INTO $table(id_usuario, id_empresa, Nombre, modulos) VALUES (:id_usuario, :id_empresa, :Nombre, :modulos)");

		$stmt->bindParam(":id_usuario",$data["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":id_empresa",$data["id_empresa"], PDO::PARAM_STR);
		$stmt->bindParam(":Nombre",$data["Nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":modulos",$data["modulos"], PDO::PARAM_STR);

		
	
		if($stmt->execute()){

			return "OK";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


}


/*=============================================
=   ADD ULTIMO CONSECUTIVO EMPRESA           =
=============================================*/

	static public function MdlAgregarUltimoConseFacturaEmpresa($idempresa) {

 		$db = Connexion::connect();

		$stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_sucursal_$idempresa(
  idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id_factura int DEFAULT NULL,
  ultimo_consecutivo int DEFAULT NULL,
  sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");
		
	
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
=   ADD ULTIMO CONSECUTIVO EMPRESA           =
=============================================*/

static public function MdlAgregarUltimoConseFacturaCompraEmpresa($idempresa) {

	$db = Connexion::connect();

   $stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_fc_sucursal_$idempresa(
idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_factura int DEFAULT NULL,
ultimo_consecutivo int DEFAULT NULL,
sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");
   

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
=   ADD ULTIMO CONSECUTIVO TIQUETES EMPRESA           =
=============================================*/

	static public function MdlAgregarUltimoConseTiqueteEmpresa($idempresa) {

 		$db = Connexion::connect();

		$stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_te_sucursal_$idempresa(
  idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id_factura int DEFAULT NULL,
  ultimo_consecutivo int DEFAULT NULL,
  sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");
	
	
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
=   ADD ULTIMO CONSECUTIVO TIQUETES EMPRESA           =
=============================================*/

	static public function MdlAgregarUltimoConseNcreditoEmpresa($idempresa) {

 		$db = Connexion::connect();

		$stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_nc_sucursal_$idempresa(
  idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id_factura int DEFAULT NULL,
  ultimo_consecutivo int DEFAULT NULL,
  sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL, 
  UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");
	
	
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
=   ADD ULTIMO CONSECUTIVO TIQUETES EMPRESA           =
=============================================*/

	static public function MdlAgregarUltimoConseNdebitoEmpresa($idempresa) {

 		$db = Connexion::connect();

		$stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_nd_sucursal_$idempresa(
  idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id_factura int DEFAULT NULL,
  ultimo_consecutivo int DEFAULT NULL,
  sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");
	
	
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
=   ADD ULTIMO CONSECUTIVO EMPRESA           =
=============================================*/

	static public function MdlAgregarUltimoConseFacturaPEmpresa($idempresa) {

 		$db = Connexion::connect();

		$stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_p_sucursal_$idempresa(
  idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id_factura int DEFAULT NULL,
  ultimo_consecutivo int DEFAULT NULL,
  sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");
		
	
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
=   ADD ULTIMO CONSECUTIVO EMPRESA           =
=============================================*/

static public function MdlAgregarUltimoConseFacturaCompraPEmpresa($idempresa) {

	$db = Connexion::connect();

   $stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_fc_p_sucursal_$idempresa(
idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_factura int DEFAULT NULL,
ultimo_consecutivo int DEFAULT NULL,
sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");
   

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
=   ADD ULTIMO CONSECUTIVO TIQUETES EMPRESA           =
=============================================*/

	static public function MdlAgregarUltimoConseTiquetePEmpresa($idempresa) {

 		$db = Connexion::connect();

		$stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_tep_sucursal_$idempresa(
  idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id_factura int DEFAULT NULL,
  ultimo_consecutivo int DEFAULT NULL,
  sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");
	
	
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
=   ADD ULTIMO CONSECUTIVO TIQUETES EMPRESA           =
=============================================*/

	static public function MdlAgregarUltimoConseNcreditoPEmpresa($idempresa) {

 		$db = Connexion::connect();

		$stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_ncp_sucursal_$idempresa(
  idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id_factura int DEFAULT NULL,
  ultimo_consecutivo int DEFAULT NULL,
  sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL, 
  UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");
	
	
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
=   ADD ULTIMO CONSECUTIVO TIQUETES EMPRESA           =
=============================================*/

	static public function MdlAgregarUltimoConseNdebitoPEmpresa($idempresa) {

 		$db = Connexion::connect();

		$stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_ndp_sucursal_$idempresa(
  idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id_factura int DEFAULT NULL,
  ultimo_consecutivo int DEFAULT NULL,
  sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");
	
	
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
=   ADD ULTIMO CONSECUTIVO TIQUETES EMPRESA           =
=============================================*/

static public function MdlAgregarUltimoConseMensReceptorEmpresa($idempresa) {

	$db = Connexion::connect();

   $stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_mr_sucursal_$idempresa(
idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_factura int DEFAULT NULL,
ultimo_consecutivo int DEFAULT NULL,
sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");


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
=   ADD ULTIMO CONSECUTIVO TIQUETES EMPRESA           =
=============================================*/

static public function MdlAgregarUltimoConseMensReceptorPempresa($idempresa) {

	$db = Connexion::connect();

   $stmt = $db->prepare("CREATE TABLE empresas.tbl_ultimo_consecutivo_mrp_sucursal_$idempresa(
idtbl_ultimo_consecutivo_sucursal int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_factura int DEFAULT NULL,
ultimo_consecutivo int DEFAULT NULL,
sucursal varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
caja varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
random  varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
UNIQUE KEY `ultimo_consecutivo_UNIQUE` (`ultimo_consecutivo`,`sucursal`,`caja`))");


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
=                 UPDATE CODIGO                =
=============================================*/

static public function MdlActualizarCodigoCLiente($table, $data) { 

	$stmt = Connexion::connect()->prepare("UPDATE $table AS dest,
    (
        SELECT
           LPAD((idtbl_clientes), 4, 0) as col1
        FROM
            $table
        WHERE
           cedula = :cedula
    ) AS src
SET
    dest.codigo = `src`.col1
WHERE
    dest.cedula = :cedula");  




		$stmt->bindParam(":cedula",$data["cedula"], PDO::PARAM_STR);		
	
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
=                 CARGAR CEDULAS              =
=============================================*/

	static public function MdlCargarCedulas($table, $item, $value) {

	$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt -> close(); 

		$stmt =null;

}

 
/*=============================================
=                 CARGAR TIPOS SERVICIOS      =
=============================================*/

	static public function MdlCargarClientes($table1, $table2, $empresa) {

			

			$stmt = Connexion::connect()->prepare("SELECT distinctrow a.idtbl_clientes, a.nombre_ficticio, a.nombre, a.cedula, a.email, a.activo, a.privilegio FROM $table1 a inner join $table2 b on a.idtbl_clientes = b.id_empresa where a.idtbl_clientes LIKE '$empresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();

// return $stmt;	


		$stmt -> close();

		$stmt =null;

}

	/*=============================================
	=                 SEARCH PROVINCIAS            =
	=============================================*/

		static public function Mdlprovincias($table) {

		 

				$stmt = Connexion::connect()->prepare("SELECT * FROM $table ");

				//$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();

				$stmt -> close();

				$stmt =null;

	}
		/*=============================================
	=                 SEARCH CANTONES            =
	=============================================*/

		static public function Mdlcantones($table, $item, $value) {
	
   
				$stmt = Connexion::connect()->prepare("SELECT distinctrow * FROM $table WHERE $item = :$item order by nombre asc");

				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();
				// return $stmt;

				$stmt -> close();

				$stmt =null;
	}

	/*=============================================
	=                 SEARCH DISTRITOS            =
	=============================================*/
	static public function Mdldistritos($table, $item, $value, $value2) {
	
 
				$stmt = Connexion::connect()->prepare("SELECT distinctrow * FROM $table WHERE $item = :$item and provincia = '$value2' order by nombre asc");

				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();

				$stmt -> close();

				$stmt =null;
	}

	
	/*=============================================
	=     MODIFICAR RUTA P12         =
	=============================================*/

	static public function MdlAgregarRuta($table, $id_cliente, $ruta1, $ruta2, $ruta3) {
	

		if($ruta2 == "0"){


				$stmt = Connexion::connect()->prepare("UPDATE $table set ruta_12 = '$ruta1', logo = '$ruta3' WHERE idtbl_clientes = '$id_cliente'");

				$stmt -> execute();

				return $stmt -> fetchAll();

				$stmt -> close();

				$stmt =null;


		}else{


				$stmt = Connexion::connect()->prepare("UPDATE $table set ruta_12 = '$ruta1', ruta_12_prueba = '$ruta2', logo = '$ruta3' WHERE idtbl_clientes = '$id_cliente'");

				$stmt -> execute();

				return $stmt -> fetchAll();

				$stmt -> close();

				$stmt =null;


		}


	}


/*=============================================
=                 ADD CLIENTE                =
=============================================*/

	static public function MdlAgregarUltimoConse($table, $data) {


 $db = Connexion::connect();


		$stmt = $db->prepare("INSERT INTO $table(id_factura, ultimo_consecutivo, sucursal, caja) VALUES (:id_factura, :ultimo_consecutivo, :sucursal, :caja)");

		$stmt->bindParam(":id_factura",$data["id_factura"], PDO::PARAM_STR);
		$stmt->bindParam(":ultimo_consecutivo",$data["ultimo_consecutivo"], PDO::PARAM_STR);
		$stmt->bindParam(":sucursal",$data["sucursal"], PDO::PARAM_STR);
		$stmt->bindParam(":caja",$data["caja"], PDO::PARAM_STR);	
	
		if($stmt->execute()){

			return $db->lastInsertId();
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


}

static public function MdlCargarPlanes($table) {

	$stmt = Connexion::connect()->prepare("SELECT * FROM $table");

	$stmt -> execute();

	return $stmt -> fetchAll();

	$stmt -> close();

$stmt =null;


}


static public function MdlEditarPrivilegiosUsuario($table, $data) { 

	$stmt = Connexion::connect()->prepare("UPDATE $table SET privilegios = :privilegios where idtbluser_2 = :idtbluser_2");  

		$stmt->bindParam(":privilegios",$data["privilegios"], PDO::PARAM_STR);
		$stmt->bindParam(":idtbluser_2",$data["idUsuario"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "OK";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;

}



}




