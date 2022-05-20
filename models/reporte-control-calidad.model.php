<?php

require_once "connexion.php";

class ReporteControlCalidadModel {


    /*=====================================
    =          OBTENER REPORTE            =
    =        CONTROL DE CALIDAD           =
    ======================================*/

    static public function MdlGetReporte($table1, $table2, $table3, $table4, $table5, $table6, $table7) {
        $stmt = Connexion::connect()->prepare("SELECT y.mes,a.internet+ifnull(b.gpon,0) + c.dth+d.pospago+e.dth AS 'total cartera',
                                                        ifnull(cantidad,0) AS 'total actualizado',ifnull(cantidad2,0) AS 'total atendido',
                                                        ifnull(cantidad3,0) AS 'total no atendido' FROM
                                                        (SELECT COUNT(idtbl_informe_internet) AS internet,
                                                        MONTH(fecha_venta) AS fecha
                                                        FROM
                                                        $table1
                                                        WHERE
                                                        fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                        GROUP BY MONTH(fecha_venta))as a
                                                        LEFT JOIN
                                                        (SELECT COUNT(idtblinforme_gpon) AS gpon,
                                                        MONTH(fecha_contrato) AS fecha
                                                        FROM
                                                        $table2
                                                        WHERE
                                                        fecha_contrato >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                        GROUP BY MONTH(fecha_contrato)) as b on a.fecha=b.fecha
                                                        LEFT JOIN   
                                                        (SELECT COUNT(idtbl_ventas_calle_dth) AS dth,
                                                        MONTH(fecha_venta) AS fecha
                                                        FROM
                                                        $table3
                                                        WHERE
                                                        fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                        GROUP BY MONTH(fecha_venta)) as c on a.fecha=c.fecha

                                                        LEFT JOIN
                                                        (SELECT COUNT(idtblinforme) AS pospago,
                                                        MONTH(fecha_venta) AS fecha
                                                        FROM
                                                        $table4
                                                        WHERE
                                                        fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                        GROUP BY MONTH(fecha_venta)) as d on a.fecha=d.fecha
                                                        LEFT JOIN 
                                                        (SELECT COUNT(idtbldth) AS dth,
                                                        MONTH(fecha_venta) AS fecha
                                                        FROM
                                                        $table5
                                                        WHERE
                                                        fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                        GROUP BY MONTH(fecha_venta)) as e on a.fecha=e.fecha
                                                        LEFT JOIN 
                                                        (SELECT 
                                                        COUNT(idtbl_actualizacion_pagos) AS cantidad,
                                                        MONTH(fecha_venta) AS fecha
                                                        FROM
                                                        $table6
                                                        WHERE
                                                        fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                        GROUP BY MONTH(fecha_venta)) AS f on a.fecha=f.fecha
                                                        LEFT JOIN
                                                        (SELECT 
                                                        COUNT(idtbl_actualizacion_pagos) AS cantidad2,
                                                        MONTH(fecha_venta) AS fecha
                                                        FROM
                                                        $table6
                                                        WHERE
                                                        fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                        AND idtbl_actualizacion_pagos IN (SELECT 
                                                                id_registro
                                                        FROM
                                                        $table7
                                                        WHERE
                                                                estado = 'OK')
                                                        GROUP BY MONTH(fecha_venta)) AS g ON a.fecha = g.fecha
                                                        LEFT JOIN
                                                        (SELECT 
                                                        COUNT(idtbl_actualizacion_pagos) AS cantidad3,
                                                        MONTH(fecha_venta) AS fecha
                                                        FROM
                                                        $table6
                                                        WHERE
                                                        fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                        AND idtbl_actualizacion_pagos NOT IN (SELECT 
                                                                id_registro
                                                        FROM
                                                        $table7
                                                        WHERE
                                                                estado = 'OK')
                                                        GROUP BY MONTH(fecha_venta)) AS h ON a.fecha = h.fecha
                                                        INNER JOIN
                                                        (select mes,numero from callcenter.tbl_meses) as y on a.fecha = y.numero 
                                                        ;");

	$stmt -> execute();
        
        
	return $stmt->fetchall();

        $stmt -> close();

	$stmt =null;

       
    }

    /*=====================================
    =          OBTENER REPORTE            =
    =         CONTROL DE PAGOS            =
    ======================================*/

    static public function MdlGetReportePagos($table1, $table2, $table3, $table4, $table5, $table6) {
        $stmt = Connexion::connect() -> prepare("SELECT y.mes as mes, a.internet+ifnull(b.gpon,0) + c.dth+d.pospago+e.dth AS 'total cartera',
                                                IFNULL(g.cantidadpago0,0) AS cantidadpago0,
                                                ifnull(h.cantidadpago1,0) as cantidadpago1,ifnull(i.cantidadpago2,0) as cantidadpago2,
                                                ifnull(j.cantidadpago3,0) as cantidadpago3, ifnull(k.cantidadpago4,0) as cantidadpago4,
                                                ifnull(l.cantidadpago5,0) as cantidadpago5, ifnull(m.cantidadpago6,0) as cantidadpago6
                                                FROM
                                                (SELECT COUNT(idtbl_informe_internet) AS internet,
                                                MONTH(fecha_venta) AS fecha
                                                FROM
                                                $table1
                                                WHERE
                                                fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                GROUP BY MONTH(fecha_venta))as a
                                                LEFT JOIN
                                                (SELECT COUNT(idtblinforme_gpon) AS gpon,
                                                MONTH(fecha_contrato) AS fecha
                                                FROM
                                                $table2
                                                WHERE
                                                fecha_contrato >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                GROUP BY MONTH(fecha_contrato)) as b on a.fecha=b.fecha
                                                LEFT JOIN   
                                                (SELECT COUNT(idtbl_ventas_calle_dth) AS dth,
                                                MONTH(fecha_venta) AS fecha
                                                FROM
                                                $table3
                                                WHERE
                                                fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                GROUP BY MONTH(fecha_venta)) as c on a.fecha=c.fecha

                                                LEFT JOIN
                                                (SELECT COUNT(idtblinforme) AS pospago,
                                                MONTH(fecha_venta) AS fecha
                                                FROM
                                                $table4
                                                WHERE
                                                fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                GROUP BY MONTH(fecha_venta)) as d on a.fecha=d.fecha
                                                LEFT JOIN 
                                                (SELECT COUNT(idtbldth) AS dth,
                                                MONTH(fecha_venta) AS fecha
                                                FROM
                                                $table5
                                                WHERE
                                                fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                GROUP BY MONTH(fecha_venta)) as e on a.fecha=e.fecha
                                                LEFT JOIN 
                                                (SELECT COUNT(idtbl_actualizacion_pagos) AS cantidadpago0,
                                                MONTH(fecha_venta) AS fecha2
                                                FROM $table6
                                                WHERE fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                AND cantidad_pagos=0
                                                GROUP BY MONTH(fecha_venta)) AS g ON a.fecha = g.fecha2
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_actualizacion_pagos) AS cantidadpago1,
                                                MONTH(fecha_venta) AS fecha3
                                                FROM $table6
                                                WHERE fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                AND cantidad_pagos=1
                                                GROUP BY MONTH(fecha_venta)) AS h ON a.fecha = h.fecha3
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_actualizacion_pagos) AS cantidadpago2,
                                                MONTH(fecha_venta) AS fecha4
                                                FROM $table6
                                                WHERE fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                AND cantidad_pagos=2
                                                GROUP BY MONTH(fecha_venta)) AS i ON a.fecha = i.fecha4
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_actualizacion_pagos) AS cantidadpago3,
                                                MONTH(fecha_venta) AS fecha5
                                                FROM $table6
                                                WHERE fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                AND cantidad_pagos=3
                                                GROUP BY MONTH(fecha_venta)) AS j ON a.fecha = j.fecha5
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_actualizacion_pagos) AS cantidadpago4,
                                                MONTH(fecha_venta) AS fecha6
                                                FROM $table6
                                                WHERE fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                AND cantidad_pagos=4
                                                GROUP BY MONTH(fecha_venta)) AS k ON a.fecha = k.fecha6
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_actualizacion_pagos) AS cantidadpago5,
                                                MONTH(fecha_venta) AS fecha7
                                                FROM $table6
                                                WHERE fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                AND cantidad_pagos=5
                                                GROUP BY MONTH(fecha_venta)) AS l ON a.fecha = l.fecha7
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_actualizacion_pagos) AS cantidadpago6,
                                                MONTH(fecha_venta) AS fecha8
                                                FROM $table6
                                                WHERE fecha_venta >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
                                                AND cantidad_pagos=6
                                                GROUP BY MONTH(fecha_venta)) AS m ON a.fecha = m.fecha8
                                                inner join 
                                                (select mes,numero from callcenter.tbl_meses) as y on a.fecha = y.numero 
                                                ;");
        
        $stmt -> execute();


                
        
	     return $stmt -> fetchAll();

        $stmt -> close();

	    $stmt =null;
    }

    
}



?>