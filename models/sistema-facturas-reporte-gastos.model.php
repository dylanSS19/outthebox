<?php

require_once "connexion.php";

class ReporteGastosModel{
 

    static public function MdlCargarGastos($table, $table2, $idempresa, $fechaDesde, $FechaHasta) { 

        $stmt = Connexion::connect()->prepare("SELECT a.* FROM $table a inner join $table2 b on a.cedulaReceptor = b.cedula where b.idtbl_clientes = '$idempresa' and a.fechaEmision between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt;

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarGastosDetalle($table, $DetalleFac) { 

        $stmt = Connexion::connect()->prepare("SELECT nombre, ifnull(codigo, 0) as codigo, ifnull(cantidad, 0) as cantidad, ifnull(precioUnidad, 0) as precioUnidad, ifnull(subTotal, 0) as subTotal, ifnull(descuento, 0) as descuento, ifnull(iva, 0) as iva, ifnull(total, 0) as total FROM empresas.tbl_sistema_facturacion_detalle_Factura_gastos Where idFactura = '$DetalleFac'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt;

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarDatosFacturaGasto($table, $idFactura) { 

        $stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE idtbl_sistema_facturacion_Factura_gastos = '$idFactura'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt;

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarDatosFactura($table, $table2, $idFactura) { 

        $stmt = Connexion::connect()->prepare("SELECT b.contrasena_facturacion,b.usuario_facturacion,b.idtbl_clientes,b.cedula,a.tipoCedEmisor,a.cedulaEmisor, DATE_FORMAT(a.fechaEmision, '%Y-%m-%d') as fechaEmision, TIME(a.fechaEmision) as horaEmision, a.totalIva, a.totalComprobante FROM $table a inner join $table2 b on a.cedulaReceptor = b.cedula where  a.idtbl_sistema_facturacion_Factura_gastos = '$idFactura' order by idtbl_clientes desc limit 1");

        $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt;

        $stmt -> close();

        $stmt =null;

    }


}