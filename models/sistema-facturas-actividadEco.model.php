<?php
 
require_once "connexion.php";

class ActividadEconomicaModel{

		static public function MdlCargarActividad($table) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}

		static public function MdlCargarActividadesEconomicas($table, $idempresa) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_empresa = '$idempresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}

		static public function MdlActividadesEconomicas($table, $idempresa, $codigoActividad, $nombreActividad) { 

			$stmt = Connexion::connect()->prepare("INSERT INTO $table(id_empresa, codigo, nombre) VALUES(:id_empresa, :codigo, :nombre)");

		
		$stmt->bindParam(":id_empresa",$idempresa, PDO::PARAM_STR);
		$stmt->bindParam(":codigo",$codigoActividad, PDO::PARAM_STR);
		$stmt->bindParam(":nombre",$nombreActividad, PDO::PARAM_STR);

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