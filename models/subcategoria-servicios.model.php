<?php

require_once "connexion.php";

class SubCategoriaserviciosModel{


	/*============================================= 
=                 EDIT CATEGORIA                =
=============================================*/

static public function MdlEditarSubCategoriaServicio($table, $data) { 



	$stmt = Connexion::connect()->prepare("UPDATE $table SET nombre = :nombre,palabra_clave = :palabra_clave where codigo = :codigo");  

		$stmt->bindParam(":codigo",$data["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":palabra_clave",$data["palabra_clave"], PDO::PARAM_STR);

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
=                 LOAD SUBCATEGORIA               =
=============================================*/

	static public function MdlCargarSubCategoriaClientesEditar($table, $item, $value) {


			/* echo "<script>console.log('SELECT * FROM " . $table . " where ". $item . " = ". $value . "' );</script>";*/



			$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt -> close();

		$stmt =null;


}

		/*=============================================
=                 LOAD CATEGORIA               =
=============================================*/

	static public function Mdlcargarcartegorias($table) {

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE activo = 'Si'");

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

			return "error";
		}

		$stmt -> close();

		$stmt =null;
}



	/*=============================================
=                 ADD CATEGORIA SERVICIO                =
=============================================*/

	static public function MdlAgregarSubCategoriaServicio($table, $data) {

		//idtbl_clientes, codigo, nombre, nombre_contacto, tipo_id, cedula, regimen, telefono, mail, provincia, canton, distrito, latitud, longitud, activo

		$stmt = Connexion::connect()->prepare("INSERT INTO $table(codigo,nombre,palabra_clave,activo,user) VALUES (:codigo,:nombre,:palabra_clave,:activo,:user)");

		$stmt->bindParam(":codigo",$data["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":palabra_clave",$data["palabra_clave"], PDO::PARAM_STR);
		$stmt->bindParam(":activo",$data["activo"], PDO::PARAM_STR);
		$stmt->bindParam(":user",$data["user"], PDO::PARAM_STR);
		

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
=                 UPDATE CODIGO                =
=============================================*/

static public function MdlActualizarCodigoSubCategoriaServicio($table, $data) { 

	$stmt = Connexion::connect()->prepare("UPDATE $table AS dest,
    (
        SELECT
           LPAD((idtbl_tipo_servicios), 4, 0) as col1
        FROM
            $table
        WHERE
           nombre = :nombre
    ) AS src
SET
    dest.codigo = `src`.col1
WHERE
    dest.nombre = :nombre");  




		$stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);		
	
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

	static public function MdlCargarSubCategorias($table, $item, $value) {

	$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt -> close(); 

		$stmt =null;

}


	/*=============================================
=                 CARGAR CATEGORIAS SERVICIOS                =
=============================================*/

	static public function MdlCargarSubCategoriaServicios($table) {

			

			$stmt = Connexion::connect()->prepare("SELECT * FROM  $table");

			$stmt -> execute();

			return $stmt -> fetchAll();

/*return $stmt;	
*/

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
	

				$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ");

				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();

				$stmt -> close();

				$stmt =null;
	}

	/*=============================================
	=                 SEARCH DISTRITOS            =
	=============================================*/
	static public function Mdldistritos($table, $item, $value) {
	

				$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ");

				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();

				$stmt -> close();

				$stmt =null;
	}

	


}





