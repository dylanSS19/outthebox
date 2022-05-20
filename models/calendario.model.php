<?php

require_once "connexion.php";

class CalendarioModel{

 
		/*=============================================
=                 ADD FECHA                =
=============================================*/

	static public function MdlInsertFechaCalendario($table, $titulo, $inicio, $fin,$allday ,$backgroundColor ,$borderColor, $empresa, $user ) {

		//idtbl_calendario, empresa, titulo, inicio, fin, allday, backgroundColor, borderColor, editable, user, fecha_creacion, tipo

		$stmt = Connexion::connect()->prepare("INSERT INTO $table(empresa,titulo,inicio,fin,allday,backgroundColor,borderColor,user) VALUES (:empresa,:titulo,:inicio,:fin,:allday,:backgroundColor,:borderColor,:user)");

		$stmt->bindParam(":empresa",$empresa, PDO::PARAM_STR);
		$stmt->bindParam(":titulo",$titulo, PDO::PARAM_STR);
		$stmt->bindParam(":inicio",$inicio, PDO::PARAM_STR);	
		$stmt->bindParam(":fin",$fin, PDO::PARAM_STR);
		$stmt->bindParam(":allday",$allday, PDO::PARAM_STR);
		$stmt->bindParam(":backgroundColor",$backgroundColor, PDO::PARAM_STR);
		$stmt->bindParam(":borderColor",$borderColor, PDO::PARAM_STR);
		$stmt->bindParam(":user",$user, PDO::PARAM_STR);

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
	=                 SEARCH CALENDARIO            =
	=============================================*/
	static public function MdlCargarCalendario($table, $idempresa) {
	

				$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE empresa ='$idempresa' ");
				
				$stmt -> execute();

				/*return $stmt;*/

				return $stmt -> fetchAll();

				$stmt -> close();

				$stmt =null;
	}

		/*=============================================
	=                 UPDATE FECHA CALENDARIO            =
	=============================================*/
	static public function MdlUpdateFechaCalendario($table, $id, $inicio, $fin) {
	
	$stmt = Connexion::connect()->prepare("UPDATE $table SET inicio = :inicio,fin = :fin where idtbl_calendario = :id");  

		$stmt->bindParam(":id", $id, PDO::PARAM_STR);

		$stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);

		$stmt->bindParam(":fin", $fin, PDO::PARAM_STR);

		if($stmt->execute()){


			return "ok";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;
	}

	static public function MdlAgregarFotos($table, $ruta, $id_evento) {
	
		$stmt = Connexion::connect()->prepare("INSERT INTO $table (id_evento, ruta) VALUES (:id_evento, :ruta)");  
	
			$stmt->bindParam(":ruta", $ruta, PDO::PARAM_STR);
	
			$stmt->bindParam(":id_evento", $id_evento, PDO::PARAM_STR);
	
			if($stmt->execute()){
	
	
				return "ok";
			}
	
			else{
	
				return "error";
			}
	
			$stmt -> close();
	
			$stmt =null;
		}

		static public function MdlCargarUltimaFoto($table, $idevento) {
	

			$stmt = Connexion::connect()->prepare("SELECT count(*) FROM $table WHERE id_evento ='$idevento' ");
			
			$stmt -> execute();

			/*return $stmt;*/

			return $stmt -> fetch();

			$stmt -> close();

			$stmt =null;
}

static public function MdlCargarFotosEventos($table, $idevento) {
	

	$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE id_evento ='$idevento' ");
	
	$stmt -> execute();

	/*return $stmt;*/

	return $stmt -> fetchAll();

	$stmt -> close();

	$stmt =null;
}

static public function MdlAgregarComentarios($table, $nombres, $comentarios, $id_eventos) {
	

	$stmt = Connexion::connect()->prepare("INSERT INTO $table (id_evento, comentario, usuario) VALUES (:id_evento, :comentario, :usuario)");
	
		$stmt->bindParam(":comentario", $comentarios, PDO::PARAM_STR);
	
		$stmt->bindParam(":id_evento", $id_eventos, PDO::PARAM_STR);

		$stmt->bindParam(":usuario", $nombres, PDO::PARAM_STR);
	
		if($stmt->execute()){
	
			return "ok";

		}
	
		else{
	
			return $stmt->errorInfo()[2];
		
		}
	
			$stmt -> close();
	
			$stmt =null;
}



static public function MdlCargarComentarios($table, $idevento) {
	

	$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE id_evento ='$idevento' order by fecha_comentario asc ");
	
	$stmt -> execute();

	/*return $stmt;*/

	return $stmt -> fetchAll();

	$stmt -> close();

	$stmt =null;
}


static public function MdlCargarReacciones($table, $table2, $id_eventos) {
	

	$stmt = Connexion::connect()->prepare("SELECT reacciones FROM $table
	WHERE idtbl_calendario = '$id_eventos'
	UNION
	SELECT IFNULL(count(id_evento), 0) FROM $table2
	WHERE id_evento = '$id_eventos'");
	
	$stmt -> execute();

	// return $stmt;

	return $stmt -> fetchAll();

	$stmt -> close();

	$stmt =null;
}

static public function MdlCargarDatosEvento($table, $id_eventos) {
	

	$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_calendario = '$id_eventos'");
	
	$stmt -> execute();

	// return $stmt;

	return $stmt -> fetchAll();

	$stmt -> close();

	$stmt =null;
}

static public function MdlModificarDatosEvento($table, $id_eventos, $nombre, $detalle, $inicio, $fin, $tipo, $allday , $ubicacion, $limite, $lat, $lon) {
	
	$stmt = Connexion::connect()->prepare("UPDATE $table SET inicio='$inicio', fin='$fin', titulo='$nombre', detalle_evento='$detalle', allday='$allday', tipo='$tipo', Ubicacion='$ubicacion', limite_invitados='$limite', lat='$lat', lon='$lon'  where idtbl_calendario ='$id_eventos'");
		
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





