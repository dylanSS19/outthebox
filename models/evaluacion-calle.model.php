<?php

require_once "connexion.php";

class EvaluacionCalleModel { 

    /***********************************
     *   CARGAR DATOS KILOMETROS META  *
     ***********************************/

    public static function MdlCargarKmMeta($fechaInicio,$fechaAyer,$fechaDia, $table1,$table2,$table3) {
        $stmt = Connexion::connect()->prepare("SELECT a.movil, a.placa, IFNULL(b.fecha,'SIN APERTURA') AS fecha, d.cantidad, 
                                            IFNULL(b.kilometros_recorridos,'0') AS kmhoy, IFNULL(c.kmhastaayer,0) AS kmhastaayer,
                                            (IFNULL(b.kilometros_recorridos,0) + IFNULL(c.kmhastaayer,0)) AS kmTotal FROM 
                                            (SELECT idtbl_vehiculos,placa,movil 
                                            FROM $table1) AS a
                                            LEFT JOIN 
                                            (SELECT placa,fecha,kilometros_recorridos 
                                            FROM $table2 
                                            WHERE fecha = '$fechaDia') AS b ON b.placa = a.placa
                                            LEFT JOIN
                                            (SELECT placa, SUM(kilometros_recorridos) AS kmhastaayer 
                                            FROM $table2 
                                            WHERE fecha BETWEEN '$fechaInicio' AND '$fechaAyer' GROUP BY placa) AS c
                                            ON c.placa = a.placa
                                            LEFT JOIN
                                            (SELECT idtbl_metas_dth,nombre,fecha_desde,cantidad,id_grupo
                                            FROM $table3
                                            WHERE fecha_desde = '$fechaInicio' and nombre = 'KILOMETRAJE') AS d
                                            ON d.id_grupo = a.idtbl_vehiculos
                                            GROUP BY a.placa;
        ");

        $stmt->execute();
        return $stmt->fetchAll();
        // return $stmt;

        $stmt->close();
        $stmt = null;
    }

    /*************************************
     *    CARGAR DATOS VENDIDOS Y METAS  *
     ************************************/

    public static function MdlCargarMetas($table1,$table2,$table3,$fechaInicio,$fechaAyer,$fechaDia) {
        $stmt = Connexion::connect()->prepare("SELECT a.idtbl_vehiculos,a.movil,ifnull(b.cantidad,0) AS cantidadInternet,ifnull(f.vendInternet,0) AS vendInternet,ifnull(j.vendHoyInternet,0) as vendHoyInternet,
                                                ifnull(c.cantidad,0) AS cantidadGpon,ifnull(g.vendGpon,0) AS vendGpon,ifnull(k.vendHoyGpon,0) as vendHoyGpon,ifnull(d.cantidad,0) AS cantidadDth,
                                                ifnull(h.vendDth,0) AS vendDth,ifnull(l.vendHoyDth,0) as vendHoyDth,ifnull(e.cantidad,0) AS cantidadPospago,ifnull(i.vendPospago,0) AS vendPospago,
                                                ifnull(m.vendHoyPospago,0) as vendHoyPospago
                                                FROM
                                                (SELECT idtbl_vehiculos, movil FROM $table1) AS a
                                                LEFT JOIN 
                                                (SELECT nombre, cantidad, fecha_desde, id_grupo 
                                                FROM $table2 
                                                WHERE nombre='INTERNET' AND fecha_desde = '$fechaInicio') AS b ON b.id_grupo = a.idtbl_vehiculos
                                                LEFT JOIN 
                                                (SELECT nombre, cantidad, fecha_desde, id_grupo 
                                                FROM $table2 
                                                WHERE nombre='GPON' AND fecha_desde = '$fechaInicio') AS c ON c.id_grupo = a.idtbl_vehiculos
                                                LEFT JOIN 
                                                (SELECT nombre, cantidad, fecha_desde, id_grupo 
                                                FROM $table2 
                                                WHERE nombre='DTH' AND fecha_desde = '$fechaInicio') AS d ON d.id_grupo = a.idtbl_vehiculos
                                                LEFT JOIN 
                                                (SELECT nombre, cantidad, fecha_desde, id_grupo 
                                                FROM $table2 
                                                WHERE nombre='POSPAGO' AND fecha_desde = '$fechaInicio') AS e ON e.id_grupo = a.idtbl_vehiculos
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_codigo_validacion) AS vendInternet,canal,movil,fecha_ingreso 
                                                FROM $table3 
                                                WHERE canal = 'INTERNET' AND fecha_ingreso BETWEEN '$fechaInicio' and '$fechaAyer' AND estado = 'USADO' 
                                                GROUP BY movil) AS f ON f.movil  = a.movil
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_codigo_validacion) AS vendGpon,canal,movil,fecha_ingreso 
                                                FROM $table3 
                                                WHERE canal = 'GPON' AND fecha_ingreso BETWEEN '$fechaInicio' and '$fechaAyer' AND estado = 'USADO' 
                                                GROUP BY movil) AS g ON g.movil  = a.movil
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_codigo_validacion) AS vendDth,canal,movil,fecha_ingreso 
                                                FROM $table3 
                                                WHERE canal = 'DTH' AND fecha_ingreso BETWEEN '$fechaInicio' and '$fechaAyer' AND estado = 'USADO' 
                                                GROUP BY movil) AS h ON h.movil  = a.movil
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_codigo_validacion) AS vendPospago,canal,movil,fecha_ingreso 
                                                FROM $table3 
                                                WHERE canal = 'POSPAGO' AND fecha_ingreso BETWEEN '$fechaInicio' and '$fechaAyer' AND estado = 'USADO' 
                                                GROUP BY movil) AS i ON i.movil  = a.movil
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_codigo_validacion) AS vendHoyInternet,canal,movil,fecha_ingreso 
                                                FROM $table3 
                                                WHERE canal = 'INTERNET' AND fecha_ingreso = '$fechaDia' AND estado = 'USADO' 
                                                GROUP BY movil) AS j ON j.movil  = a.movil
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_codigo_validacion) AS vendHoyGpon,canal,movil,fecha_ingreso 
                                                FROM $table3 
                                                WHERE canal = 'GPON' AND fecha_ingreso = '$fechaDia' AND estado = 'USADO' 
                                                GROUP BY movil) AS k ON k.movil  = a.movil
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_codigo_validacion) AS vendHoyDth,canal,movil,fecha_ingreso 
                                                FROM $table3 
                                                WHERE canal = 'DTH' AND fecha_ingreso = '$fechaDia' AND estado = 'USADO' 
                                                GROUP BY movil) AS l ON l.movil  = a.movil
                                                LEFT JOIN
                                                (SELECT COUNT(idtbl_codigo_validacion) AS vendHoyPospago,canal,movil,fecha_ingreso 
                                                FROM $table3 
                                                WHERE canal = 'POSPAGO' AND fecha_ingreso = '$fechaDia' AND estado = 'USADO' 
                                                GROUP BY movil) AS m ON m.movil  = a.movil;        
                                                ");

        $stmt->execute();
        //return $stmt;
        return $stmt->fetchAll();

        $stmt->close();
        $stmt = null;
    }

}
?>