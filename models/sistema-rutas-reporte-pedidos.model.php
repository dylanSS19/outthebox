<?php
 
require_once "connexion.php";

class ReportPedidosModel{

		static public function MdlCargarFacturas($table, $IDempresa, $StarDate, $EndDate, $ruta) { 

			$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_empresa = '$IDempresa' and fecha between '$StarDate 00:00:00' and '$EndDate 23:59:59' and ruta like '$ruta' order by estado");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

    }

    static public function MdlCargarDetalleFacturas($table, $IDfactura) { 

        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_factura = '$IDfactura'");

        $stmt -> execute();

        return $stmt -> fetchAll();
        // return $stmt;

        $stmt -> close();

    $stmt =null;

}



}