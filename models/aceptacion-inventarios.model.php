 <?php

require_once "connexion.php";

class AceptacionInventariosModel{
 

	/*=============================================
=                 CARGAR CARGOS                =
=============================================*/

	static public function MdlCargarCargos($table) {



$stmt = Connexion::connect()->prepare("SELECT DISTINCTROW movimiento_numero,tipo,fecha,tienda_entrega,tienda_recibe, user FROM $table WHERE tipo = 'Cargo' AND estado = 'En Revision'");
		
			

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt =null;

}



	/*=============================================
=                 CARGAR CARGOS DETALLE           =
=============================================*/

	static public function MdlCargarCargosDetalle($table,$item, $value) {



$stmt = Connexion::connect()->prepare("SELECT serie,equipo FROM $table WHERE tipo = 'Cargo' AND $item = '$value'");
		
			

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt =null;

}


	/*=============================================
=                 CARGAR CARGOS DETALLE           =
=============================================*/

	static public function MdlCargarMovimientosDetalle($table,$item, $value) {



$stmt = Connexion::connect()->prepare("SELECT serie,equipo FROM $table WHERE tipo = 'Movimiento' AND $item = '$value'");
		
			

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt =null;

}


	/*=============================================
=                 ACEPTAR CARGOS                =
=============================================*/

	static public function MdlAceptarCargos($table,$table2,$value) {



$stmt = Connexion::connect()->prepare("update $table set estado='Aceptado' where serie in(select serie from  $table2 where movimiento_numero = '$value' And tipo = 'Cargo'); Update
        $table2
    set  estado='Aceptado'
WHERE
        movimiento_numero = '$value'
        And tipo = 'Cargo';");


		
	
		if($stmt->execute()){


			return "ok";
		}else{

			return "error";
		}

		$stmt -> close();

		$stmt =null;

}

	/*=============================================
=                 ACEPTAR MOVIMIENTOS                =
=============================================*/

	static public function MdlAceptarMovimientos($table,$table2,$table3,$value) {



		$stmt = Connexion::connect()->prepare("SELECT distinct tienda_recibe from  $table3 where movimiento_numero = '$value' And tipo = 'Movimiento' limit 1;");


			$stmt -> execute();

		$tienda = $stmt -> fetch();


		$tienda= json_encode($tienda[0]);

		$tienda=str_replace('"', '', $tienda);

		
	


$stmt = Connexion::connect()->prepare("update $table set estado='En Transito',tienda='$tienda' where serie in(select serie from  $table2 where movimiento_numero = '$value' And tipo = 'Movimiento'); Update
        $table2
    set  estado='En Transito'
WHERE
        movimiento_numero = '$value'
        And tipo = 'Movimiento';");


	
	
		if($stmt->execute()){


			return "ok";
		}else{

			return "error";
		}

		$stmt -> close();

		$stmt =null;

}

	/*=============================================
=                 CARGAR MOVIMIENTOS                =
=============================================*/

	static public function MdlCargarMovimientos($table) {



$stmt = Connexion::connect()->prepare("SELECT DISTINCTROW movimiento_numero,tipo,fecha,tienda_entrega,tienda_recibe, user FROM $table WHERE tipo = 'Movimiento' AND estado = 'En Revision'");
		
			

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt =null;

}


	



}





