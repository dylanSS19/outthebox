<?php
 
require_once "connexion.php";

class ClientesMasivosModel{


		static public function MdlIngresarClientesMasivo($table, $id_empresa, $Nombre, $tipo_cedula, $cedula, $correo, $telefono, $provincia, $canton, $distrito, $direccion, $Tipo_lista, $nombre_fantasia) { 

			$stmt = Connexion::connect()->prepare("INSERT INTO $table(id_empresa, Nombre, tipo_cedula, cedula, correo, telefono, provincia, canton, distrito, direccion, Tipo_lista, nombre_fantasia) VALUES(:id_empresa, :Nombre, :tipo_cedula, :cedula, :correo, :telefono, :provincia, :canton, :distrito, :direccion, :Tipo_lista, :nombre_fantasia)");

		
		$stmt->bindParam(":id_empresa",$id_empresa, PDO::PARAM_STR);
		$stmt->bindParam(":Nombre",$Nombre, PDO::PARAM_STR);
		$stmt->bindParam(":tipo_cedula",$tipo_cedula, PDO::PARAM_STR);
		$stmt->bindParam(":cedula",$cedula, PDO::PARAM_STR);
		$stmt->bindParam(":correo",$correo, PDO::PARAM_STR);
		$stmt->bindParam(":telefono",$telefono, PDO::PARAM_STR);
		$stmt->bindParam(":provincia",$provincia, PDO::PARAM_STR);
		$stmt->bindParam(":canton",$canton, PDO::PARAM_STR);
		$stmt->bindParam(":distrito",$distrito, PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$direccion, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo_lista",$Tipo_lista, PDO::PARAM_STR);
		$stmt->bindParam(":nombre_fantasia",$nombre_fantasia, PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;

		} 

		static public function MdlCargarListasPrecio($table, $table2, $id_empresa) { 

			$stmt = Connexion::connect()->prepare("SELECT a.* FROM empresas.tbl_listas_precio a inner join empresas.tbl_empresas b on a.idempresa = b.idtbl_empresas where b.id_cliente = '$id_empresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}

		static public function MdlClientesMasivo($table, $id_empresa) { 

			$stmt = Connexion::connect()->prepare("SELECT idtbl_empresas_clientes, id_empresa, Nombre, if(tipo_cedula = '01', 'Fisico', if(tipo_cedula = '02', 'Juridico', if(tipo_cedula = '03', 'Dimex / Nite', if(tipo_cedula = 'Pasaporte', 'Pasaporte', '')))) as tipo_cedula, cedula, correo, direccion, nombre_fantasia FROM $table where id_empresa = '$id_empresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}

}