<?php

require_once "connexion.php";

class InicioFacturacionModel{


    static public function MdlCargarTopClientes($table,$fechaInicio, $fechaFin, $empresa) { 


        $stmt = Connexion::connect()->prepare("SELECT 
        tbl_sistema_facturacion_facturas.nombre_cliente,
        SUM(tbl_sistema_facturacion_facturas.subtotal) as total
    FROM
        empresas.tbl_sistema_facturacion_facturas
    WHERE
        fecha_factura BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59'
            AND estado_factura = 'Aceptado'
                  AND id_compania = '".$empresa."'
            AND estado_anulacion = 'No'
            and tipo_documento in(01,04)
    GROUP BY nombre_cliente
    ORDER BY SUM(tbl_sistema_facturacion_facturas.subtotal) DESC
    LIMIT 5");  

            $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }
 
    static public function MdlCargarTopProductos($table, $table2, $fechaInicio, $fechaFin, $empresa) { 

        $stmt = Connexion::connect()->prepare("SELECT 
        $table2.nombre,
        SUM($table2.subtotal) as subtotal
    FROM
        $table,
        $table2
    WHERE
        fecha_factura BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59'
            AND estado_factura = 'Aceptado'
            AND id_factura = idtbl_sistema_facturacion_facturas
            AND id_compania = '$empresa'
            AND estado_anulacion = 'No'
            and tipo_documento in(01,04)
    GROUP BY codigo
    ORDER BY SUM($table2.subtotal) DESC
    LIMIT 5");  

            $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarCompVentas($table, $table2, $table3, $fechaInicio, $fechaFin, $empresa) { 

        $stmt = Connexion::connect()->prepare("SELECT a.mes,ifnull(c.total,0) as totalañoanterior,ifnull(b.total,0) as totalañoactual from
        (SELECT mes FROM $table3) as a
        left join(
        SELECT 
            MONTHNAME(fecha_factura) as mes, SUM(subtotal) as total
        FROM
            $table
        WHERE
            tipo_documento IN (01 , 04)
                AND estado_anulacion <> 'Total'
                AND estado_factura = 'Aceptado'
                AND id_compania = '$empresa'
                AND fecha_factura LIKE '".$fechaInicio."-%'
                 group by MONTHNAME(fecha_factura)) as b  on a.mes=b.mes
                left join(
        SELECT 
            MONTHNAME(fecha_factura) as mes, SUM(subtotal) as total
        FROM
            $table
        WHERE
            tipo_documento IN (01 , 04)
                AND estado_anulacion <> 'Total'
                AND estado_factura = 'Aceptado'
                AND id_compania = '$empresa'
                AND fecha_factura LIKE '".$fechaFin."-%'
                 group by MONTHNAME(fecha_factura)) as c  on a.mes=c.mes");  

            $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarFacturas($table, $fechaInicio, $fechaFin, $empresa) { 


        $stmt = Connexion::connect()->prepare("SELECT ifnull(COUNT(idtbl_sistema_facturacion_facturas), 0) as cantidad FROM $table WHERE id_compania = '$empresa' AND tipo_documento = '01' AND fecha_factura BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59'");  

            $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargartiquetes($table, $fechaInicio, $fechaFin, $empresa) { 


        $stmt = Connexion::connect()->prepare("SELECT ifnull(COUNT(idtbl_sistema_facturacion_facturas), 0) as cantidad FROM $table WHERE id_compania = '$empresa' AND tipo_documento = '04' AND fecha_factura BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59'");  

            $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarNotasC($table, $fechaInicio, $fechaFin, $empresa) { 


        $stmt = Connexion::connect()->prepare("SELECT ifnull(COUNT(idtbl_sistema_facturacion_facturas), 0) as cantidad FROM $table WHERE id_compania = '$empresa' AND tipo_documento = '03' AND fecha_factura BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59'");  

            $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarNotasD($table, $fechaInicio, $fechaFin, $empresa) { 


        $stmt = Connexion::connect()->prepare("SELECT ifnull(COUNT(idtbl_sistema_facturacion_facturas), 0) as cantidad FROM $table WHERE id_compania = '$empresa' AND tipo_documento = '02' AND fecha_factura BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59'");  

            $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarPorcentXmes($table, $fechaInicio1, $fechaFin2, $fechaInicio3, $fechaFin4, $empresa) { 


        $stmt = Connexion::connect()->prepare("SELECT ifnull(SUM(subtotal), 0) AS total FROM
        $table
    WHERE
        tipo_documento IN (01 , 04)
            AND estado_anulacion <> 'Total'
            AND estado_factura = 'Aceptado'
            AND id_compania = '$empresa'
            AND fecha_factura BETWEEN '".$fechaFin2." 00:00:00' AND '".$fechaInicio1." 23:59:59'
            UNION 
        SELECT ifnull(SUM(subtotal), 0) AS total  FROM
        $table
    WHERE
        tipo_documento IN (01 , 04)
            AND estado_anulacion <> 'Total'
            AND estado_factura = 'Aceptado'
             AND id_compania = '$empresa'
            AND fecha_factura BETWEEN '".$fechaFin4." 00:00:00' AND '".$fechaInicio3." 23:59:59'");  

            $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt ;

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarPorcentXSemanas($table, $empresa) { 


        $stmt = Connexion::connect()->prepare("select a.semana,ifnull(c.total,0) as totalañoactual ,ifnull(b.total,0) as totalañoanterior from
        (SELECT semana FROM empresas.tbl_semanas where semana BETWEEN (weekofyear(CURDATE()- INTERVAL 3 MONTH) ) and (weekofyear(CURDATE()))) as a
        left join(
        SELECT 
            weekofyear(fecha_factura) as semana, SUM(subtotal) as total
        FROM
            empresas.tbl_sistema_facturacion_facturas
        WHERE
            tipo_documento IN (01 , 04)
                AND estado_anulacion <> 'Total'
                AND estado_factura = 'Aceptado'
                AND id_compania = '$empresa'
                AND fecha_factura BETWEEN ((CURDATE()- INTERVAL 1 year) - INTERVAL 3 MONTH) and (CURDATE()- INTERVAL 1 year) group by weekofyear(fecha_factura)) as b  on a.semana=b.semana
                left join(
        SELECT 
            weekofyear(fecha_factura) as semana, SUM(subtotal) as total
        FROM
            empresas.tbl_sistema_facturacion_facturas
        WHERE
            tipo_documento IN (01 , 04)
                AND estado_anulacion <> 'Total'
                AND estado_factura = 'Aceptado'
                AND id_compania = '$empresa'
                AND fecha_factura BETWEEN ((CURDATE()) - INTERVAL 3 MONTH) and (CURDATE()) group by weekofyear(fecha_factura)) as c  on a.semana=c.semana");  

            $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt ;

        $stmt -> close();

        $stmt =null;

    }

}