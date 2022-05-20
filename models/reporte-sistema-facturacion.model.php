<?php
 
require_once "connexion.php";

class ReporteFacturasModel{
 
		/*============================================= 
		=                 CARGAR FACTURAS               =
		=============================================*/
 
		static public function MdlCargarFacturas($table, $id_empresa, $fechaDesde, $fechaHasta, $consecutivo, $clave, $cedula, $estado, $tipoDoc) { 

$where = "";
if($id_empresa == ""){

date_default_timezone_set('America/Costa_Rica');

$fechaDesde = date('Y-m-d');
$fechaHasta = date('Y-m-d');

$where = "fecha_factura  BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59'";

}else{

$where .= "id_compania = '$id_empresa' ";

}if($fechaDesde == "" || $fechaHasta == ""){

date_default_timezone_set('America/Costa_Rica');

$fechaDesde = date('Y-m-d');
$fechaHasta = date('Y-m-d');

$where .= "AND fecha_factura  BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59' ";

}else{

$where .= "AND fecha_factura  BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59' ";
	
}if($consecutivo == ""){


}else{

$where .= "AND consecutivo like '%".$consecutivo."%' ";
	
}if($clave == ""){



}else{

$where .= "AND clave = '$clave' ";
	
}if($cedula == ""){



}else{

$where .= "AND cedula_cliente = '$cedula' ";
	
}if($estado == ""){



}else{

$where .= "AND estado_factura like '$estado' ";
	
}if($tipoDoc == ""){



}else{

$where .= "AND tipo_documento = '$tipoDoc' ";
	
}

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE $where ");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}
 
  
/*============================================= 
=          CARGAR EMPRESAS X USUARIO   =
=============================================*/

		static public function MdlCargarEmpresasUsuarios($table, $idusuario) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_usuario = '$idusuario'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}



/*============================================= 
=          CARGAR DETALLE FACTURAS  =
=============================================*/

		static public function MdlDetalleFactura($table, $idFactura) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_factura = '$idFactura'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}




/*============================================= 
=          CARGAR  FACTURAS  =
=============================================*/

		static public function MdlCargarFacturaXid($table, $idFactura) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_sistema_facturacion_facturas = '$idFactura'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}


/*============================================= 
=          CARGAR  FACTURAS  =
=============================================*/

		static public function MdlFactura($table, $idFactura) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_sistema_facturacion_facturas = '$idFactura'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}

		static public function MdlCargarDatosEmpresa($table, $idEmpresa) { 

			$stmt = Connexion::connect()->prepare("SELECT idtbl_clientes, cedula, usuario_facturacion, contrasena_facturacion FROM $table where idtbl_clientes = '$idEmpresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}

}