<?php
 
require_once "connexion.php";

class ReporteClientesModel{


/*============================================= 
=          CARGAR EMPRESAS X USUARIO   =
=============================================*/

		static public function MdlCargarClientesXempresa($table, $idempresa) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_empresa = '$idempresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}



		static public function MdlAgregarCliente($table, $id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $tipoLista) { 

			$stmt = Connexion::connect()->prepare("INSERT INTO $table(id_empresa, Nombre, tipo_cedula, cedula, correo, telefono, provincia, canton, distrito, direccion, Tipo_lista) VALUES(:id_empresa, :Nombre, :tipo_cedula, :cedula, :correo, :telefono, :provincia, :canton, :distrito, :direccion, :Tipo_lista)");

		
		$stmt->bindParam(":id_empresa",$id_empresa, PDO::PARAM_STR);
		$stmt->bindParam(":Nombre",$nombreC, PDO::PARAM_STR);
		$stmt->bindParam(":tipo_cedula",$tipo_CedulaC, PDO::PARAM_STR);
		$stmt->bindParam(":cedula",$cedulaC, PDO::PARAM_STR);
		$stmt->bindParam(":correo",$correoC, PDO::PARAM_STR);
		$stmt->bindParam(":telefono",$telefonoC, PDO::PARAM_STR);
		$stmt->bindParam(":provincia",$provinciaC, PDO::PARAM_STR);
		$stmt->bindParam(":canton",$CantonC, PDO::PARAM_STR);
		$stmt->bindParam(":distrito",$distritoC, PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$direccionC, PDO::PARAM_STR);
		$stmt->bindParam(":Tipo_lista",$tipoLista, PDO::PARAM_STR);
		//return $stmt;
		if($stmt->execute()){

			return "ok";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;

		}



		static public function MdlValCedula($table, $id_empresaV, $cedulaV) { 

			$stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
             SELECT *
             FROM $table
             WHERE id_empresa =  '$id_empresaV' AND cedula = '$cedulaV'), 1, 0)");

			$stmt->execute();

			return $stmt->fetch();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}

		static public function MdlCargarClienteXid($table, $client) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_empresas_clientes = '$client'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}


		static public function MdlEditarClientes($table, $id_clienteE, $nombreCE, $cedulaCE, $tipo_CedulaCE, $correoCE, $telefonoCE, $provinciaCE, $CantonCE, $distritoCE, $direccionCE, $tipoListaCE) { 

			$stmt = Connexion::connect()->prepare("update $table set Nombre= '$nombreCE', tipo_cedula= '$tipo_CedulaCE', cedula= '$cedulaCE', correo= '$correoCE', telefono= '$telefonoCE', provincia= '$provinciaCE', canton= '$CantonCE', distrito= '$distritoCE', direccion= '$direccionCE', Tipo_lista='$tipoListaCE'  where idtbl_empresas_clientes = '$id_clienteE'");

		
		if($stmt->execute()){

			return "ok";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;

		}


	/*===================================
	=        CARGAR LISTAS PRECIOS      =
	====================================*/
	static public function MdlCargarListasPrecios($table, $idEmpresa){
		$stmt = Connexion::connect()->prepare("SELECT idtbl_listas_precio,nombre FROM $table WHERE idempresa=$idEmpresa AND activo='Si';");

		$stmt -> execute();

		return $stmt -> fetchAll();
		// return $stmt;

		$stmt -> close();

		$stmt =null;
	}
}