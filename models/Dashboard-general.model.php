<?php

require_once "connexion.php";

class DashboardGeneralModel{

        static public function MdlCargarVActualDth($table, $fechaDesde, $fechaHasta) {
        
            $stmt = Connexion::connect()->prepare("SELECT ifnull(count(idtbl_ventas_calle_dth),0) as Total from $table where fecha_venta between '$fechaDesde' and '$fechaHasta'");
            
            $stmt -> execute();

            /*return $stmt;*/

            return $stmt -> fetchAll();

            $stmt -> close();

            $stmt =null;

    }

    static public function MdlCargarVActualInternet($table, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT ifnull(count(idtbl_informe_internet),0) as Total from $table where fecha_venta between '$fechaDesde' and '$fechaHasta'");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarVActualPospago($table, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT ifnull(count(idtblinforme),0) as Total from $table where tienda REGEXP '^[0-9]+$' and fecha_venta between '$fechaDesde' and '$fechaHasta'");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarVActualPospagoTiendas($table, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT 
        ifnull(COUNT(contrato),0) as Total
    FROM
            $table
    WHERE
        fecha_venta BETWEEN '$fechaDesde' AND '$fechaHasta'
            AND tienda NOT LIKE '%GPON%'
            AND tienda NOT LIKE '%DTH%'
            AND tienda NOT LIKE '%MASIVO%'
            AND tienda NOT LIKE '%CALL CENTER%'
            AND tienda NOT LIKE '%CEDI%'
            AND tienda NOT LIKE '%ACTIVADORES%'
            AND estado IN ('Criticado' , 'Completado')
            AND tienda REGEXP '[a-zA-Z]'");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarVActualRecaudacionTiendas($table, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT ifnull(sum(monto),0) from $table where  fecha_ingreso between '$fechaDesde' and  '$fechaHasta'  and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%'");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarVActualActivacionTiendas($table, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT ifnull(count(tipo_operacion),0) from $table where fecha between '$fechaDesde' and  '$fechaHasta' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%'");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarVActualMetaLLaveTiendas($table, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT ifnull(count(idtblinforme),0) as Total from $table where tienda REGEXP '[a-zA-Z]' and fecha_venta between '$fechaDesde' and  '$fechaHasta' and monto_renta >= '13000' and tipo_venta NOT in ('FONATEL','IFI')");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarVActualKitsMasivo($table, $table2, $table3, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT 
        ifnull( SUM($table2.total),0) AS kits
    FROM
    $table,
    $table2,
    $table3
    WHERE
    $table2.consecutive_number = $table.consecutive_number
            AND invoice_date BETWEEN '$fechaDesde' AND '$fechaHasta'
            AND is_canceled = '0'
            AND invoiceStatus = 'Aceptado'
            AND code = sku
            AND familia LIKE 'PRE PA%'");
        
        $stmt -> execute();

        // return $stmt;

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarVActualTaeMasivo($table, $table2, $table3, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT 
        ifnull( SUM($table2.total),0) AS tae
    FROM
    $table,
    $table2,
    $table3
    WHERE
    $table2.consecutive_number = $table.consecutive_number
            AND invoice_date BETWEEN '$fechaDesde' AND '$fechaHasta'
            AND is_canceled = '0'
            AND invoiceStatus = 'Aceptado'
            AND code = sku
            AND familia IN ('TAE' , 'RASPABLES')");
        
        $stmt -> execute();

        // return $stmt;

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarVActualTaeMetaMensual($table, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT 
       ifnull(SUM(cantidad),0)
    FROM
    $table
    WHERE
            fecha_desde = '$fechaDesde'
            AND nombre IN ('Tiempo Aire Electronico')
    GROUP BY nombre
    ORDER BY nombre ASC");
        
        $stmt -> execute();

        // return $stmt;

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarVActualKitsMetaMensual($table, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT 
        ifnull(SUM(cantidad),0)
    FROM
    $table
    WHERE
            fecha_desde = '$fechaDesde'
            AND nombre IN ('Kits')
    GROUP BY nombre
    ORDER BY nombre ASC");
        
        $stmt -> execute();

        // return $stmt;

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarVActualActivaciones($table, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT 
        COUNT(gestor) AS activacion
    FROM
    $table
    WHERE
        tipo_operacion = 'activacion'
            AND fecha_venta BETWEEN '$fechaDesde' AND '$fechaHasta'");
        
        $stmt -> execute();

        // return $stmt;

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarVActualActivacionesMetaMensual($table, $fechaDesde, $fechaHasta) {
        
        $stmt = Connexion::connect()->prepare("SELECT 
       ifnull(SUM(cantidad),0)
    FROM
    $table
    WHERE
            fecha_desde = '$fechaDesde'
            AND nombre IN ('Activaciones')
    GROUP BY nombre
    ORDER BY nombre ASC");
        
        $stmt -> execute();

        // return $stmt;

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }


}

