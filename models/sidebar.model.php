<?php
  
require_once "connexion.php";

class sidebarModel{

		static public function MdlCargarModulos($table) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where html ='Si' order by secuencia asc");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;
 
			$stmt -> close();

		    $stmt =null;

		}
		
		static public function MdlCargarSubModulos($table, $idModulo) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idModulo in ($idModulo)  order by secuencia asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

			// return $stmt;

			$stmt -> close();

		    $stmt =null;

		}

		static public function MdlUsuariosModulos($table, $usuario, $empresa) { 

			$stmt = Connexion::connect()->prepare("SELECT modulos FROM $table where id_usuario = '$usuario'  and id_empresa = '$empresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();

			// return $stmt;

			$stmt -> close();

		    $stmt =null;

		}

		static public function MdlUsuariosInvitadosModulos($table, $usuario) { 

			$stmt = Connexion::connect()->prepare("SELECT modulos FROM $table where idtbluser_2 = '$usuario'");

			$stmt -> execute();

			return $stmt -> fetchAll();

			// return $stmt;

			$stmt -> close();

		    $stmt =null;

		}


		// 
		static public function MdlIDSubModulo($table, $subMod, $modulos) { 

			$modulos = implode(",", $modulos);

			$stmt = Connexion::connect()->prepare("SELECT idtbl_subModulos_outthebox FROM $table where nombreArchivo = '$subMod' and idtbl_subModulos_outthebox in ($modulos)");

			// $stmt = Connexion::connect()->prepare("SELECT idtbl_subModulos_outthebox FROM $table where nombreArchivo = '$subMod'");


			$stmt -> execute();

			return $stmt -> fetchAll();

			// return $stmt;

			$stmt -> close();

		    $stmt =null;

		}

 
		static public function MdlCargarRolUsuario($table, $idUser) { 

			$stmt = Connexion::connect()->prepare("SELECT privilegios FROM $table where idtbluser_2 = '$idUser'");

			$stmt -> execute();

			return $stmt -> fetchAll();

			// return $stmt;

			$stmt -> close();

		    $stmt =null;

		}

		static public function MdlCargarSubmodulosUser($table, $idUser, $empresa) { 

			$stmt = Connexion::connect()->prepare("SELECT modulos FROM $table where id_usuario = '$idUser' and id_empresa = '$empresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();

			// return $stmt;

			$stmt -> close();

		    $stmt =null;

		}

		static public function MdlCargarModulosCliente($table, $empresa) { 

			$stmt = Connexion::connect()->prepare("SELECT privilegio FROM $table where idtbl_clientes = '$empresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();

			// return $stmt;

			$stmt -> close();

		    $stmt =null;

		}


		static public function MdlCargarPlanesClientes($table, $empresa) { 

			$stmt = Connexion::connect()->prepare("SELECT idtbl_clientes_planes, fecha_fin, idPlan, nombrePlan, cantDocumentos, estado, fechaCreacion FROM $table where  cliente = '$empresa' and estado = 'Aceptado'");

			$stmt -> execute();

			return $stmt -> fetchAll();

			// return $stmt;

			$stmt -> close();

		    $stmt =null;

		}

		static public function MdlCargarPlanes($table, $idPlan) { 

			$stmt = Connexion::connect()->prepare("SELECT modulos FROM $table where  idtbl_categoria_planes = '$idPlan' and estado = 'Activo'");

			$stmt -> execute();

			return $stmt -> fetchAll();

			// return $stmt;

			$stmt -> close();

		    $stmt =null;

		}


		static public function MdlCargarCantFacturas($table, $empresa, $fechaDesde, $fechaHasta){ 

			$stmt = Connexion::connect()->prepare("SELECT count(idtbl_sistema_facturacion_facturas) as cantFact FROM $table where id_compania = '$empresa' and fecha_factura between '$fechaDesde 00:00:00' and '$fechaHasta 23:59:59'");

			$stmt -> execute();

			return $stmt -> fetchAll();

			// return $stmt;

			$stmt -> close();

		    $stmt =null;

		}

}