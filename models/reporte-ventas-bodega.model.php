<?php

require_once "connexion.php";

class ReporteVentasBodegaModel {


    /***************************************
     *                                     *
     *        INICIO CARGAR BODEGAS        *
     *                                     *
     **************************************/

    static public function MdlCargarBodega($table,  $table1, $table2, $table3) {
        $stmt = Connexion::connect()->prepare("SELECT tbl_bodegas.nombre as ruta
                                                FROM masivos.tbl_bodegas, masivos.tbl_rutas, masivos.tbl_cedes, digitalsat.tbl_supervisores
                                                WHERE ruta = 'Si'
                                                    AND tbl_bodegas.nombre NOT LIKE '%activa%'
                                                    AND tbl_bodegas.nombre NOT LIKE '%free%'
                                                    AND id_bodega = idtbl_bodegas
                                                    AND id_sede = idtbl_cedes
                                                    AND id_supervisor = idtbl_supervisores;
                                            ");

        $stmt -> execute();
        return $stmt -> fetchAll();
        // return $stmt;
        $stmt -> close();
        $stmt =null;
    }


    /***************************************
     *                                     *
     *          FIN CARGAR BODEGAS         *
     *                                     *
     **************************************/


    

     /***************************************
     *                                     *
     *             INICIO METAS            *
     *                                     *
     **************************************/
    static public function MdlMetas($fechaInicial,$fechaFin, $fechaDia,$fechaAyer) {
        $stmt = Connexion::connect()->prepare("SELECT 
                                                    a.nombre,
                                                    IFNULL(c.venta, 0) AS venta,
                                                    IFNULL(b.cantidad, 0) AS meta,
                                                    IFNULL(d.venta, 0) AS ventaMensual
                                                FROM
                                                    (SELECT 
                                                        tbl_bodegas.nombre,
                                                            tbl_rutas.codigo,
                                                            tbl_rutas.descripcion,
                                                            persona,
                                                            tbl_supervisores.nombre AS supervisor
                                                    FROM
                                                        masivos.tbl_bodegas, masivos.tbl_rutas, masivos.tbl_cedes, digitalsat.tbl_supervisores
                                                    WHERE
                                                        ruta = 'Si'
                                                            AND id_bodega = idtbl_bodegas
                                                            AND id_sede = idtbl_cedes
                                                            AND id_supervisor = idtbl_supervisores
                                                            AND tbl_bodegas.nombre NOT LIKE '%activa%'
                                                            AND tbl_bodegas.nombre NOT LIKE '%free%'
                                                            ) AS a
                                                        left join(
                                                        SELECT 
                                                            sede,
                                                            tbl_metas_masivos.cantidad
                                                    FROM
                                                    empresas.tbl_metas_masivos
                                                    WHERE
                                                            id_empresa = 10
                                                            AND fecha_desde = '$fechaInicial'
                                                            AND tbl_metas_masivos.nombre = 'Tiempo Aire Electronico'
                                                            group by sede) as b on b.sede = a.nombre
                                                        LEFT JOIN
                                                    (SELECT 
                                                        created_by, SUM(tbl_bill_item_details.total) AS venta
                                                    FROM
                                                        masivos.tbl_bill, masivos.tbl_bill_item_details
                                                    WHERE
                                                        invoiceStatus = 'Aceptado'
                                                            AND is_canceled = 0
                                                            AND tbl_bill_item_details.consecutive_number = tbl_bill.consecutive_number
                                                            AND invoice_date LIKE '$fechaDia'
                                                            AND (name LIKE 'Recarga%'
                                                            OR name LIKE 'Tarjeta%')
                                                    GROUP BY created_by) AS c ON c.created_by = a.nombre
                                                        LEFT JOIN
                                                    (SELECT 
                                                        created_by, SUM(tbl_bill_item_details.total) AS venta
                                                    FROM
                                                        masivos.tbl_bill, masivos.tbl_bill_item_details
                                                    WHERE
                                                        invoiceStatus = 'Aceptado'
                                                            AND is_canceled = 0
                                                            AND tbl_bill_item_details.consecutive_number = tbl_bill.consecutive_number
                                                            AND invoice_date BETWEEN '$fechaInicial' AND '$fechaAyer'
                                                            AND (name LIKE 'Recarga%'
                                                            OR name LIKE 'Tarjeta%')
                                                    GROUP BY created_by) AS d ON d.created_by = a.nombre;
                                                ");

        	
		$stmt -> execute();

		return $stmt -> fetchAll();
		//return $stmt;

		$stmt -> close();

		$stmt =null;
    }

    /***************************************
     *                                     *
     *             FIN METAS               *
     *                                     *
     **************************************/

    /***************************************
     *                                     *
     *         INICIO VISITA DIARIA        *
     *                                     *
     **************************************/

    static public function MdlVisitadiaria($fechaInicio,$fechaDia,$dia_hoy) {
        $stmt = Connexion::connect()->prepare("SELECT 
                                                a.nombre,
                                                IF((IFNULL(h.total, 0) / IFNULL(b.cantidad, 0)) * 100 > 85,
                                                    'Si',
                                                    'No') AS 'porcentaje'
                                            FROM
                                                (SELECT 
                                                    tbl_bodegas.nombre,
                                                        tbl_rutas.codigo,
                                                        tbl_rutas.descripcion,
                                                        persona,
                                                        tbl_supervisores.nombre AS supervisor
                                                FROM
                                                    masivos.tbl_bodegas, masivos.tbl_rutas, masivos.tbl_cedes, digitalsat.tbl_supervisores
                                                WHERE
                                                    ruta = 'Si'
                                                        AND id_bodega = idtbl_bodegas
                                                        AND id_sede = idtbl_cedes
                                                        AND id_supervisor = idtbl_supervisores
                                                        AND tbl_bodegas.nombre NOT LIKE '%activa%'
                                                        AND tbl_bodegas.nombre NOT LIKE '%free%'
                                                        ) AS a
                                                    LEFT JOIN
                                                (SELECT 
                                                    COUNT(id_ruta) AS cantidad, id_ruta
                                                FROM
                                                    masivos.tbl_clientes
                                                WHERE
                                                    activo = 'Si'
                                                        AND dia_visita LIKE '%$dia_hoy%'
                                                GROUP BY id_ruta) AS b ON b.id_ruta = a.codigo
                                                    LEFT JOIN
                                                (SELECT 
                                                    created_by, COUNT(DISTINCT (client_id)) AS total
                                                FROM
                                                    masivos.tbl_bill, masivos.tbl_bill_item_details
                                                WHERE
                                                    invoiceStatus = 'Aceptado'
                                                        AND is_canceled = 0
                                                        AND tbl_bill_item_details.consecutive_number = tbl_bill.consecutive_number
                                                        AND invoice_date LIKE '$fechaDia'
                                                GROUP BY created_by) AS h ON h.created_by = a.nombre;");

                                                $stmt -> execute();

                                                return $stmt -> fetchAll();
                                                //return $stmt;
                                        
                                                $stmt -> close();
                                        
                                                $stmt =null;
    }


     /***************************************
     *                                     *
     *          FIN VISITA DIARIA          *
     *                                     *
     **************************************/



     /***************************************
     *                                     *
     *         INICIO VISITA CLIENTE       *
     *                                     *
     **************************************/

    static public function MdlVisitaCliente ($fechaInicio,$fechaDia,$dia) {
        $stmt = Connexion::connect()->prepare("SELECT 
                                                    a.nombre,
                                                    IFNULL(b.cantidad, 0) AS Xvisitar,
                                                    IFNULL(h.compra, 0) + IFNULL(i.nocompra, 0) AS visita,
                                                    IF(((IFNULL(h.compra, 0) + IFNULL(i.nocompra, 0)) / IFNULL(b.cantidad, 0.1)) * 100 >= 100,
                                                        'Si',
                                                        'No') AS 'porcentaje'
                                                FROM
                                                    (SELECT 
                                                        tbl_bodegas.nombre,
                                                            tbl_rutas.codigo,
                                                            tbl_rutas.descripcion,
                                                            persona,
                                                            tbl_supervisores.nombre AS supervisor
                                                    FROM
                                                        masivos.tbl_bodegas, masivos.tbl_rutas, masivos.tbl_cedes, digitalsat.tbl_supervisores
                                                    WHERE
                                                        ruta = 'Si'
                                                            AND id_bodega = idtbl_bodegas
                                                            AND id_sede = idtbl_cedes
                                                            AND id_supervisor = idtbl_supervisores
                                                            AND tbl_bodegas.nombre NOT LIKE '%activa%'
                                                            AND tbl_bodegas.nombre NOT LIKE '%free%') AS a
                                                        LEFT JOIN
                                                    (SELECT 
                                                        COUNT(id_ruta) AS cantidad, id_ruta
                                                    FROM
                                                        masivos.tbl_clientes
                                                    WHERE
                                                        activo = 'Si'
                                                            AND dia_visita LIKE '%$dia%'
                                                    GROUP BY id_ruta) AS b ON b.id_ruta = a.codigo
                                                        LEFT JOIN
                                                    (SELECT 
                                                        created_by, COUNT(DISTINCT (client_id)) AS compra
                                                    FROM
                                                        masivos.tbl_bill, masivos.tbl_bill_item_details
                                                    WHERE
                                                        invoiceStatus = 'Aceptado'
                                                            AND is_canceled = 0
                                                            AND tbl_bill_item_details.consecutive_number = tbl_bill.consecutive_number
                                                            AND invoice_date LIKE '$fechaDia'
                                                    GROUP BY created_by) AS h ON h.created_by = a.nombre
                                                        LEFT JOIN
                                                    (SELECT 
                                                        ruta, COUNT(DISTINCT (cliente)) AS nocompra
                                                    FROM
                                                        masivos.tbl_motivo_no_compra
                                                    WHERE
                                                        DATE(fecha) = '$fechaDia'
                                                    GROUP BY ruta) AS i ON i.ruta = a.nombre;"
                                            );
    

                                                $stmt -> execute();

                                                return $stmt -> fetchAll();
                                                //return $stmt;
                                        
                                                $stmt -> close();
                                        
                                                $stmt =null;
    }

     /***************************************
     *                                     *
     *          FIN VISITA CLIENTE         *
     *                                     *
     **************************************/



    /***************************************
     *                                     *
     *       INICIO META NUEVO CLIENTE     *
     *                                     *
     **************************************/

    static public function MdlMetaNuevoCliente($fechaInicio,$fechaFin,$fechaAyer,$fechaHoy) {
        $stmt = Connexion::connect()->prepare(" SELECT 
                                                    a.nombre,
                                                    IFNULL(b.cantidad, 0) AS meta,
                                                    IFNULL(c.cantidadayer, 0) AS cantidadayer,
                                                    IFNULL(d.cantidadhoy, 0) AS cantidadhoy
                                                FROM
                                                    (SELECT 
                                                        tbl_bodegas.nombre,
                                                            tbl_rutas.codigo,
                                                            tbl_rutas.descripcion,
                                                            persona,
                                                            tbl_supervisores.nombre AS supervisor
                                                    FROM
                                                        masivos.tbl_bodegas, masivos.tbl_rutas, masivos.tbl_cedes, digitalsat.tbl_supervisores
                                                    WHERE
                                                        ruta = 'Si'
                                                            AND id_bodega = idtbl_bodegas
                                                            AND id_sede = idtbl_cedes
                                                            AND id_supervisor = idtbl_supervisores
                                                            AND tbl_bodegas.nombre NOT LIKE '%activa%'
                                                            AND tbl_bodegas.nombre NOT LIKE '%free%') AS a
                                                        LEFT JOIN
                                                        (SELECT 
                                                            sede,
                                                            tbl_metas_masivos.cantidad
                                                    FROM
                                                    empresas.tbl_metas_masivos
                                                    WHERE
                                                            id_empresa = 10
                                                            AND fecha_desde = '$fechaInicio'
                                                            AND tbl_metas_masivos.nombre = 'Clientes Nuevos'
                                                            group by sede) as b on b.sede = a.nombre
                                                        left join
                                                    (SELECT 
                                                        COUNT(a.client_id) AS cantidadayer, a.created_by
                                                    FROM
                                                        (SELECT 
                                                        client_id, created_by, COUNT(client_id)
                                                    FROM
                                                        masivos.tbl_bill
                                                    WHERE
                                                        invoiceStatus = 'Aceptado'
                                                            AND is_canceled = 0
                                                            AND invoice_date BETWEEN '$fechaInicio' AND '$fechaAyer'
                                                            AND tbl_bill.subtotal >= '5000'
                                                            AND client_id IN (SELECT 
                                                                idtbl_clientes
                                                            FROM
                                                                masivos.tbl_clientes
                                                            WHERE
                                                                activo = 'Si'
                                                                    AND fecha_creacion BETWEEN '$fechaInicio' AND ',$fechaFin')
                                                    GROUP BY client_id
                                                    HAVING COUNT(client_id) > 2) AS a
                                                    GROUP BY created_by) AS c ON c.created_by = a.nombre
                                                        LEFT JOIN
                                                    (SELECT 
                                                        COUNT(a.client_id) AS cantidadhoy, a.created_by
                                                    FROM
                                                        (SELECT 
                                                        client_id, created_by, COUNT(client_id)
                                                    FROM
                                                        masivos.tbl_bill
                                                    WHERE
                                                        invoiceStatus = 'Aceptado'
                                                            AND is_canceled = 0
                                                            AND invoice_date LIKE '$fechaHoy'
                                                            AND tbl_bill.subtotal >= '5000'
                                                            AND client_id IN (SELECT 
                                                                idtbl_clientes
                                                            FROM
                                                                masivos.tbl_clientes
                                                            WHERE
                                                                activo = 'Si'
                                                                    AND fecha_creacion BETWEEN '$fechaInicio' AND ',$fechaFin')
                                                    GROUP BY client_id
                                                    HAVING COUNT(client_id) > 2) AS a
                                                    GROUP BY created_by) AS d ON d.created_by = a.nombre;"
                                            
                                            );

                                            $stmt -> execute();

                                            return $stmt -> fetchAll();
                                            //return $stmt;
                                    
                                            $stmt -> close();
                                    
                                            $stmt =null;
    }

     /***************************************
     *                                     *
     *       FIN META NUEVO CLIENTE     *
     *                                     *
     **************************************/

}


?>