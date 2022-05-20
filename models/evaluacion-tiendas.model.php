<?php

require_once "connexion.php";

class EvaluacionTiendasModel {


    static public function MdlEvaluacionTiendas($fechaInicio, $fechaAntier, $fechaAyer, $fechaHoy, $tabla1, $tabla2, $tabla3, $tabla4, $tabla5, $tabla6) {
        $stmt = Connexion::connect()->prepare("SELECT a.nombre,a.hora_inicio,ifnull(time(b.hora),'SIN APERTURA') as hora, 
                                            if(time(b.hora) is null,'NO',if(time(b.hora)>a.hora_inicio,'NO','SI'))  as estado,
                                            ifnull(c.cantidad,0) as 'meta pospago',ifnull(d.pospago,0) as 'pospagohoy',
                                            ifnull(e.pospago,0) as 'pospagoayer',ifnull(f.total,0) as pendientes,
                                            if(ifnull(f.total,0)=0,'Si','No') as 'estado pendientes',ifnull(g.cantidad,0) as 'meta recaudacion',
                                            ifnull(h.recaudacion,0) as 'recaudacionhoy',ifnull(i.recaudacion,0) as 'recaudacionayer',
                                            ifnull(j.cantidad,0) as 'meta llave',ifnull(k.llave,0) as 'llavehoy',ifnull(l.llave,0) as 'llaveayer' 
                                            FROM
                                            (SELECT idtbl_tiendas as idtienda,nombre,hora_inicio FROM $tabla1 where operativa='Si' and estadistica='Si' ) as a
                                            left join (SELECT tienda,hora 
                                            FROM $tabla2 
                                            WHERE DATE(hora) = CURDATE() AND motivo = '1') as b on a.idtienda=b.tienda
                                            LEFT JOIN
                                            (SELECT id_tienda,cantidad 
                                            FROM empresas.tbl_metas_tiendas 
                                            WHERE id_empresa = 10 AND fecha_desde = '$fechaInicio' AND nombre = 'POSPAGO' 
                                            GROUP BY id_tienda) AS c ON c.id_tienda = a.idtienda
                                            LEFT JOIN
                                            (SELECT tienda,count(idtblinforme) as pospago 
                                            FROM $tabla3 
                                            WHERE DATE(fecha_venta) = '$fechaHoy' 
                                            GROUP BY tienda) AS d ON d.tienda = a.nombre
                                            LEFT JOIN
                                            (SELECT tienda,count(idtblinforme) as pospago 
                                            FROM $tabla3 
                                            WHERE DATE(fecha_venta) BETWEEN '$fechaInicio' AND '$fechaAyer' 
                                            GROUP BY tienda) AS e ON e.tienda = a.nombre
                                            LEFT JOIN
                                            (SELECT a.tienda,count(a.tienda) as total 
                                            FROM
                                            (SELECT tienda,codigo_barras 
                                            FROM $tabla3 
                                            WHERE DATE(fecha_venta) BETWEEN '$fechaAntier' AND '$fechaHoy' 
                                            AND tienda not REGEXP '^[0-9]+$'  
                                            AND codigo_barras NOT IN
                                            (SELECT codigo_barras FROM $tabla6)
                                            UNION
                                            SELECT tienda,codigo_barras 
                                            FROM $tabla4,$tabla5 
                                            WHERE tbldth.solicitud =tbldth2.solicitud 
                                            AND  DATE(fecha_venta) BETWEEN '$fechaAntier' AND '$fechaHoy' 
                                            AND tienda NOT REGEXP '^[0-9]+$' AND codigo_barras NOT IN
                                            (SELECT codigo_barras FROM $tabla6)) as a 
                                            GROUP BY tienda)  as f on f.tienda=a.nombre
                                            LEFT JOIN
                                            (SELECT id_tienda,cantidad 
                                            FROM empresas.tbl_metas_tiendas 
                                            WHERE id_empresa = 10 AND fecha_desde = '$fechaInicio' 
                                            AND nombre = 'RECAUDACIONES' 
                                            GROUP BY id_tienda) AS g ON g.id_tienda = a.idtienda
                                            LEFT JOIN
                                            (SELECT tienda,sum(monto) as recaudacion 
                                            FROM callcenter.tbl_recaudacion 
                                            WHERE DATE(fecha_ingreso) = '$fechaHoy' 
                                            GROUP BY tienda) AS h ON h.tienda = a.nombre
                                            LEFT JOIN
                                            (SELECT tienda,sum(monto) as recaudacion 
                                            FROM callcenter.tbl_recaudacion 
                                            WHERE DATE(fecha_ingreso) BETWEEN '$fechaInicio' AND '$fechaAyer' 
                                            GROUP BY tienda) AS i ON i.tienda = a.nombre
                                            LEFT JOIN
                                            (SELECT id_tienda,cantidad 
                                            FROM empresas.tbl_metas_tiendas 
                                            WHERE id_empresa = 10 AND fecha_desde = '$fechaInicio' 
                                            AND nombre = 'META LLAVE' 
                                            GROUP BY id_tienda) AS j ON j.id_tienda = a.idtienda
                                            LEFT JOIN
                                            (SELECT tienda,count(idtblinforme) AS llave 
                                            FROM $tabla3 
                                            WHERE DATE(fecha_venta) = '$fechaHoy' AND monto_renta >= '13000' 
                                            AND tipo_venta NOT IN ('FONATEL','IFI') 
                                            GROUP BY tienda) AS k ON k.tienda = a.nombre
                                            LEFT JOIN
                                            (SELECT tienda,count(idtblinforme) AS llave 
                                            FROM $tabla3 
                                            WHERE DATE(fecha_venta) BETWEEN '$fechaInicio' AND '$fechaAyer' 
                                            AND monto_renta >= '13000' 
                                            AND tipo_venta NOT IN ('FONATEL','IFI') 
                                            GROUP BY tienda) AS l ON l.tienda = a.nombre;
                                            ");

        $stmt->execute();
        return $stmt -> fetchAll();
        //return $stmt;
    }
}


?>