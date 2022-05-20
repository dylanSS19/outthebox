<?php

require_once "connexion.php";

class reporteVentasDthModel
{

    /*=============================================
    = Cargar coordinador asociado al vendedor       =
    =============================================*/

    public static function MdlCargarConvenios($table) {

        $stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE representante <> 'N/A' and saldo <> 0 ");

// return $stmt;

        $stmt->execute();

        return $stmt->fetchAll();
        // return $stmt;

        $stmt->close();

        $stmt = null;

        $stmt->execute();

    }

/*=============================================
= Cargar coordinador asociado al vendedor       =
=============================================*/

    public static function MdlCargarCoordinador($table, $id_usuario) {

        $stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE user ='$id_usuario' ");

// return $stmt;

        $stmt->execute();

        return $stmt->fetch();
        // return $stmt;

        $stmt->close();

        $stmt = null;

        $stmt->execute();

    }

    /*=============================================
    = Cargar ventas  =
    =============================================*/

    public static function MdlCargarVentas($table, $table1, $startDate, $endDate, $coordinador) {

        $stmt = Connexion::connect()->prepare("SELECT
													a.fecha,
													IFNULL(b.dth, 0) AS dth,
													IFNULL(c.internet, 0) AS internet,
													IFNULL(f.pospago, 0) AS pospago,
													b.fecha_ingreso,
													IFNULL(d.gpon, 0) AS gpon
													FROM
													(SELECT
														fecha
													FROM
														$table
													WHERE
														$table.fecha BETWEEN '$startDate' AND '$endDate'
													GROUP BY $table.fecha) AS a
														LEFT JOIN
													(SELECT
														DATE(fecha_ingreso) as fecha_ingreso, IFNULL(COUNT(idtbl_codigo_validacion), 0) AS dth
													FROM
														$table1
													WHERE
														DATE($table1.fecha_ingreso) BETWEEN '$startDate' AND '$endDate' AND estado = 'Usado' and canal = 'DTH' and coordinador LIKE '$coordinador'
													GROUP BY DATE($table1.fecha_ingreso)) b ON b.fecha_ingreso = a.fecha
														LEFT JOIN
													(SELECT
														DATE(fecha_ingreso) as fecha_ingreso, IFNULL(COUNT(idtbl_codigo_validacion), 0) AS internet
													FROM
														$table1
													WHERE
														DATE($table1.fecha_ingreso) BETWEEN '$startDate' AND '$endDate' AND estado = 'Usado' and canal = 'INTERNET' and coordinador LIKE '$coordinador'
													GROUP BY DATE($table1.fecha_ingreso)) c ON c.fecha_ingreso = a.fecha
														LEFT JOIN
													(SELECT
														DATE(fecha_ingreso) as fecha_ingreso, IFNULL(COUNT(idtbl_codigo_validacion), 0) AS gpon
													FROM
														$table1
													WHERE
														DATE($table1.fecha_ingreso) BETWEEN '$startDate' AND '$endDate' AND estado = 'Usado' and canal = 'GPON' and coordinador LIKE '$coordinador'
													GROUP BY DATE($table1.fecha_ingreso)) d ON d.fecha_ingreso = a.fecha
														LEFT JOIN
													(SELECT
														DATE(fecha_ingreso) as fecha_ingreso, IFNULL(COUNT(idtbl_codigo_validacion), 0) AS pospago
													FROM
														$table1
													WHERE
														DATE($table1.fecha_ingreso)  BETWEEN '$startDate' AND '$endDate' AND estado = 'Usado' and canal = 'POSPAGO' and coordinador LIKE '$coordinador'
													GROUP BY DATE($table1.fecha_ingreso)) f ON f.fecha_ingreso = a.fecha
													ORDER BY a.fecha;
												");

        $stmt->execute();

        return $stmt->fetchAll();

        //return $stmt;

        $stmt->close();

        $stmt = null;

    }

/*=============================================
= Cargar ventas detalle x coordinador  =
=============================================*/

    public static function MdlcargarDatosDetalleVentasXGrupo($table1, $table2, $table3, $table4, $table5, $table6, $table7, $table8, $table9, $item, $value) {

        if (isset($_GET["startDate"]) && $_GET["startDate"] != "null") {

            $startDate = $_GET["startDate"];

            $endDate = $_GET["endDate"];

        } else {

            date_default_timezone_set('America/Costa_Rica');

            $today = date('Y-m-d');

            $startDate = date('Y-m-01', strtotime($today));

            $endDate = date('Y-m-t', strtotime($today));

        };

        $stmt = Connexion::connect()->prepare("SELECT DISTINCTROW
    a.nombre,a.representante,a.sub_tipo,a.zona,ifnull(b.dth,0) as dth,ifnull(c.internet,0) as internet,ifnull(d.pospago,0) as pospago,ifnull(e.gpon,0) as gpon,(ifnull(b.dth,0) + ifnull(c.internet,0) + ifnull(d.pospago,0) + ifnull(e.gpon,0)) as total

    FROM
    (SELECT DISTINCTROW
                idtblvendedores,$table1.nombre,$table1.representante,$table1.sub_tipo,$table1.zona
            FROM
                 $table2,  $table1
            WHERE $table1.activo='Si' AND
                $table1.idzona IN ('$value')) AS a
    LEFT JOIN
    (SELECT DISTINCTROW
          vendedor, IFNULL(COUNT(idtbl_ventas_calle_dth), 0) AS dth
    FROM
         $table4
    WHERE
        fecha_venta BETWEEN '$startDate' and '$endDate'
            AND $table4.vendedor IN (SELECT DISTINCT
                idtblvendedores
            FROM
                 $table2,  $table1
            WHERE
                $table1.idzona IN ('$value'))
    GROUP BY  $table4.vendedor) b ON b.vendedor = a.idtblvendedores


       LEFT JOIN
    (SELECT DISTINCTROW
          vendedor, IFNULL(COUNT(idtbl_informe_internet), 0) AS internet
    FROM
         $table5
    WHERE
        fecha_venta BETWEEN '$startDate' and '$endDate'
            AND $table5.vendedor IN (SELECT DISTINCT
                idtblvendedores
            FROM
                 $table2,  $table1
            WHERE
                $table1.idzona IN ('$value'))
    GROUP BY   $table5.vendedor) c ON c.vendedor = a.idtblvendedores
    LEFT JOIN
    (SELECT DISTINCTROW
          gestor, IFNULL(COUNT(idtblinforme), 0) AS pospago
    FROM
         $table6
    WHERE
        fecha_venta BETWEEN '$startDate' and '$endDate' AND tienda REGEXP '^[0-9]+$'
            AND  $table6.gestor IN (SELECT DISTINCT
                idtblvendedores
            FROM
                 $table2,  $table1
            WHERE
                $table1.idzona IN ('$value'))
    GROUP BY  $table6.gestor) d ON d.gestor = a.idtblvendedores
           LEFT JOIN
    (SELECT DISTINCTROW
          vendedor, IFNULL(COUNT(idtblinforme_gpon), 0) AS gpon
    FROM
        $table8
    WHERE
        fecha_contrato BETWEEN '$startDate' and '$endDate'
            AND $table8.vendedor IN (SELECT DISTINCT
                idtblvendedores
            FROM
                 $table2,  $table1
            WHERE
                $table1.idzona IN ('$value'))
    GROUP BY $table8.vendedor) e ON e.vendedor = a.idtblvendedores
    ;");

        $stmt->execute();
       // return $stmt;
        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

/*=============================================
=             Cargar ventas DTH                     =
=============================================*/

    public static function MdlCargarVentasDTH($table1, $table4, $usuario, $startDate, $endDate, $vendedor) {

        if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

            if ($vendedor == "null") {

                $stmt = Connexion::connect()->prepare(" SELECT count(idtbl_ventas_calle_dth) as Cantidad
FROM
    $table4,
    $table1
WHERE $table1.idtblvendedores = $table4.vendedor and
    fecha_venta BETWEEN '$startDate' AND '$endDate'  ");

                $stmt->execute();

                return $stmt->fetch();
                // return $stmt;

                $stmt->close();

                $stmt = null;

            } else {

                $stmt = Connexion::connect()->prepare(" SELECT count(idtbl_ventas_calle_dth) as Cantidad
FROM
    $table4,
    $table1
WHERE $table1.idtblvendedores = $table4.vendedor and
    fecha_venta BETWEEN '$startDate' AND '$endDate'  AND $table1.coordinador = (select coordinador from $table1 where user = '$usuario')");

                $stmt->execute();

                return $stmt->fetch();
                // return $stmt;

                $stmt->close();

                $stmt = null;

            }

        } else {

            $stmt = Connexion::connect()->prepare(" SELECT count(idtbl_ventas_calle_dth) as Cantidad
FROM
    $table4,
    $table1
WHERE $table1.idtblvendedores = $table4.vendedor and
    fecha_venta BETWEEN '$startDate' AND '$endDate'  AND $table1.coordinador = (select coordinador from $table1 where user = '$usuario')");

            $stmt->execute();

            return $stmt->fetch();
            // return $stmt;

            $stmt->close();

            $stmt = null;

        }

    }

/*=============================================
=             Cargar ventas DTH x coordinador     =
=============================================*/

    public static function MdlCargarVentasDTHCoordinador($table1, $startDate, $endDate, $coordinador) {

        $stmt = Connexion::connect()->prepare("SELECT
											IFNULL(COUNT(idtbl_codigo_validacion), 0) AS dth
											FROM
											$table1
											WHERE
											DATE($table1.fecha_ingreso) BETWEEN '$startDate' AND '$endDate' AND estado = 'Usado' and canal = 'DTH'
											and coordinador like '$coordinador'
											");

        $stmt->execute();

        return $stmt->fetch();
        //return $stmt;

        $stmt->close();

        $stmt = null;

    }

/*=============================================
=             Cargar ventas INTERNET                     =
=============================================*/

    public static function MdlCargarVentasInternet($table1, $table5, $usuario, $startDate, $endDate, $vendedor) {

        if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

            if ($vendedor == "null") {

                $stmt = Connexion::connect()->prepare("SELECT count(idtbl_informe_internet) AS Cantidad
FROM
    $table1,
    $table5
WHERE
          $table1.idtblvendedores = $table5.vendedor
        AND fecha_venta BETWEEN '$startDate' AND '$endDate'");

                $stmt->execute();

                return $stmt->fetch();
                // return $stmt;

                $stmt->close();

                $stmt = null;

            } else {

                $stmt = Connexion::connect()->prepare("SELECT count(idtbl_informe_internet) AS Cantidad
FROM
    $table1,
    $table5
WHERE
          $table1.idtblvendedores = $table5.vendedor
        AND fecha_venta BETWEEN '$startDate' AND '$endDate'
        AND  $table1.coordinador = (select coordinador from  $table1 where user = '$usuario')");

                $stmt->execute();

                return $stmt->fetch();
                // return $stmt;

                $stmt->close();

                $stmt = null;

            }

        } else {

            $stmt = Connexion::connect()->prepare("SELECT count(idtbl_informe_internet) AS Cantidad
FROM
    $table1,
    $table5
WHERE
          $table1.idtblvendedores = $table5.vendedor
        AND fecha_venta BETWEEN '$startDate' AND '$endDate'
        AND  $table1.coordinador = (select coordinador from  $table1 where user = '$usuario')");

            $stmt->execute();

            return $stmt->fetch();
            // return $stmt;

            $stmt->close();

            $stmt = null;

        }

    }

/*=============================================
=             Cargar ventas INTERNET                     =
=============================================*/

    public static function MdlCargarVentasInternetcoordinador($table1, $startDate, $endDate, $coordinador) {

        $stmt = Connexion::connect()->prepare("SELECT
											IFNULL(COUNT(idtbl_codigo_validacion), 0) AS INTERNET
											FROM
											$table1
											WHERE
											DATE($table1.fecha_ingreso) BETWEEN '$startDate' AND '$endDate' AND estado = 'Usado' and canal = 'INTERNET'
											and coordinador like '$coordinador'
											");
        $stmt->execute();

        return $stmt->fetch();
        // return $stmt;

        $stmt->close();

        $stmt = null;

    }

/*=============================================
=             Cargar ventas Pospago                     =
=============================================*/

    public static function MdlCargarVentaspospago($table1, $table6, $usuario, $startDate, $endDate, $vendedor) {

        if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

            if ($vendedor == "null") {

                $stmt = Connexion::connect()->prepare("SELECT count(idtblinforme) AS Cantidad
FROM
    $table6,
    $table1
WHERE
$table1.idtblvendedores = $table6.gestor AND
    fecha_venta BETWEEN '$startDate' AND '$endDate' and tienda REGEXP '^[0-9]+$' ");

                $stmt->execute();

                return $stmt->fetch();
                // return $stmt;

                $stmt->close();

                $stmt = null;

            } else {

                $stmt = Connexion::connect()->prepare("SELECT count(idtblinforme) AS Cantidad
FROM
    $table6,
    $table1
WHERE
$table1.idtblvendedores = $table6.gestor AND
    fecha_venta BETWEEN '$startDate' AND '$endDate' AND $table1.coordinador = (select coordinador from $table1 where user = '$usuario') and tienda REGEXP '^[0-9]+$'");

                $stmt->execute();

                return $stmt->fetch();
                // return $stmt;

                $stmt->close();

                $stmt = null;

            }

        } else {

            $stmt = Connexion::connect()->prepare("SELECT count(idtblinforme) AS Cantidad
FROM
    $table6,
    $table1
WHERE
$table1.idtblvendedores = $table6.gestor and
    fecha_venta BETWEEN '$startDate' AND '$endDate'  AND $table1.coordinador = (select coordinador from $table1 where user = '$usuario') and tienda REGEXP '^[0-9]+$'");

            $stmt->execute();

            return $stmt->fetch();
            // return $stmt;

            $stmt->close();

            $stmt = null;

        }

    }

/*=============================================
= Cargar ventas Pospago x coordinador     =
=============================================*/

    public static function MdlCargarVentasPospagocoordinador($table1, $startDate, $endDate, $coordinador) {

        $stmt = Connexion::connect()->prepare("SELECT
											IFNULL(COUNT(idtbl_codigo_validacion), 0) AS POSPAGO
											FROM
											$table1
											WHERE
											DATE($table1.fecha_ingreso) BETWEEN '$startDate' AND '$endDate' AND estado = 'Usado' and canal = 'POSPAGO'
											and coordinador like '$coordinador'
											");
        $stmt->execute();

        return $stmt->fetch();
        // return $stmt;

        $stmt->close();

        $stmt = null;

    }

/*=============================================
=             Cargar ventas activaciones     =
=============================================*/

    public static function MdlCargarVentaactivaciones($table1, $table7, $usuario, $startDate, $endDate, $vendedor) {

        if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

            if ($vendedor == "null") {

                $stmt = Connexion::connect()->prepare("SELECT count(idtblinforme_gpon) AS Cantidad
FROM
    $table7,
    $table1
WHERE
$table1.idtblvendedores = $table7.vendedor and
    fecha_contrato  BETWEEN '$startDate' AND '$endDate' ");

                $stmt->execute();

                return $stmt->fetch();
                // return $stmt;

                $stmt->close();

                $stmt = null;

            } else {

                $stmt = Connexion::connect()->prepare("SELECT count(idtblinforme_gpon) AS Cantidad
FROM
    $table7,
    $table1
WHERE
$table1.idtblvendedores = $table7.vendedor and
    fecha_contrato  BETWEEN '$startDate' AND '$endDate' AND $table1.coordinador = (select coordinador from $table1 where user = '$usuario')");

                $stmt->execute();

                return $stmt->fetch();
                // return $stmt;

                $stmt->close();

                $stmt = null;

            }

        }

    }

/*=============================================
= Cargar ventas activaciones por coordinador =
=============================================*/

    public static function MdlCargarVentaGPONcoordinadores($table1, $startDate, $endDate, $coordinador) {

        $stmt = Connexion::connect()->prepare("SELECT
											IFNULL(COUNT(idtbl_codigo_validacion), 0) AS GPON
											FROM
											$table1
											WHERE
											DATE($table1.fecha_ingreso) BETWEEN '$startDate' AND '$endDate' AND estado = 'usado' and canal = 'GPON'
											and coordinador like '$coordinador'
											");

        $stmt->execute();

        return $stmt->fetch();
        // return $stmt;

        $stmt->close();

        $stmt = null;

    }

/*=============================================
=             Cargar metas DTH     =
=============================================*/

    public static function Mdlmetasdth($table, $table2, $table3, $firstday, $lastday, $vendedor) {

        if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

            if ($vendedor == "null") {

                $stmt = Connexion::connect()->prepare("SELECT
    $table.nombre,
    SUM($table.cantidad) as Total
FROM
    $table
WHERE
         $table.nombre IN ('DTH' , 'INTERNET', 'GPON', 'POSPAGO')
        AND $table.fecha_desde BETWEEN '$firstday' AND '$lastday'
GROUP BY $table.nombre;");

                $stmt->execute();

                return $stmt->fetchAll();

                // return $stmt;

                $stmt->close();

                $stmt = null;

            } else {

                $stmt = Connexion::connect()->prepare("SELECT
    $table.nombre,
    SUM($table.cantidad) as Total
FROM
    $table
WHERE
         $table.nombre IN ('DTH' , 'INTERNET', 'GPON', 'POSPAGO')
        AND $table.fecha_desde BETWEEN '$firstday' AND '$lastday' and id_grupo in(select idtbl_zonas from $table2  where coordinador ='$vendedor'  and activo='Si')
GROUP BY $table.nombre");

                $stmt->execute();

                return $stmt->fetchAll();
                // return $stmt;

                $stmt->close();

                $stmt = null;

            }

        } else {

            $stmt = Connexion::connect()->prepare("SELECT
    $table.nombre,
    SUM($table.cantidad) as Total
FROM
    $table
WHERE
    $table.nombre IN ('DTH' , 'INTERNET', 'GPON', 'POSPAGO')
        AND $table.fecha_desde BETWEEN '$firstday' AND '$lastday'
        AND id_grupo IN (SELECT
            idtbl_zonas
        FROM
            $table2,
            $table3
        WHERE
            user = '$vendedor'
                AND $table2.activo = 'Si')
GROUP BY $table.nombre");

            $stmt->execute();

            return $stmt->fetchAll();

            // return $stmt;

            $stmt->close();

            $stmt = null;

        }

    }

/*=============================================
=  Cargar total de ventas 1 play     =
=============================================*/

    public static function Mdlventas_DTH_metas($table, $table2, $table3, $table4, $firstday, $lastday, $vendedor) {

        if ($vendedor == "null") {

            $stmt = Connexion::connect()->prepare("SELECT
    'DTH', COUNT(idtbl_ventas_calle_dth) AS Cantidad
FROM
    $table
WHERE
    fecha_venta BETWEEN '$firstday' AND '$lastday'
        AND $table.vendedor IN (SELECT DISTINCT
            idtblvendedores
        FROM
            $table2,
            $table3
        WHERE
            $table2.idzona IN (SELECT
                    idtbl_zonas
                FROM
                    $table3,
                    $table2
                WHERE
                   $table3.activo = 'Si' and idzona=idtbl_zonas));");

            $stmt->execute();

            return $stmt->fetch();

            // return $stmt;

            $stmt->close();

            $stmt = null;

        } else {

            $stmt = Connexion::connect()->prepare("SELECT
    'DTH', COUNT(idtbl_ventas_calle_dth) AS Cantidad
FROM
    $table
WHERE
    fecha_venta BETWEEN '$firstday' AND '$lastday'
        AND $table.vendedor IN (SELECT DISTINCT
            idtblvendedores
        FROM
            $table2,
            $table3
        WHERE
            $table2.idzona IN (SELECT
                    idtbl_zonas
                FROM
                    $table3,
                    $table2
                WHERE
                    user = '$vendedor' AND $table3.activo = 'Si' and idzona=idtbl_zonas));");

            $stmt->execute();

            return $stmt->fetch();
            // return $stmt;

            $stmt->close();

            $stmt = null;

        }

    }

/*=============================================
=  Cargar total de ventas internet individual     =
=============================================*/

    public static function Mdlventas_internet_individual($table, $table2, $table3, $firstday, $lastday, $vendedor) {

        if ($vendedor == "null") {

            $stmt = Connexion::connect()->prepare("SELECT
    'INTERNET', COUNT(idtbl_informe_internet) AS Cantidad
FROM
   $table
WHERE
    fecha_venta BETWEEN '$firstday' AND '$lastday'
        AND $table.vendedor IN (SELECT DISTINCT
            idtblvendedores
        FROM
           $table2,
            $table3
        WHERE
            $table2.idzona IN (SELECT
                    idtbl_zonas
                FROM
                    $table3,
                    $table2
                WHERE
                     $table2.activo = 'Si' and idzona=idtbl_zonas))");

            $stmt->execute();

            return $stmt->fetch();
            // return $stmt;

            $stmt->close();

            $stmt = null;

        } else {

            $stmt = Connexion::connect()->prepare("SELECT
    'INTERNET', COUNT(idtbl_informe_internet) AS Cantidad
FROM
    $table
WHERE
    fecha_venta BETWEEN '$firstday' AND '$lastday'
        AND $table.vendedor IN (SELECT DISTINCT
            idtblvendedores
        FROM
            $table2,
            $table3
        WHERE
            $table2.idzona IN (SELECT
                    idtbl_zonas
                FROM
                    $table3,
                    $table2
                WHERE
                    user = '$vendedor' AND $table3.activo = 'Si' and idzona=idtbl_zonas))");

            $stmt->execute();

            return $stmt->fetch();

            // return $stmt;

            $stmt->close();

            $stmt = null;

        }

    }

/*=============================================
=  Cargar total de ventas pospago      =
=============================================*/

    public static function Mdlventas_pospago($table, $table2, $table3, $firstday, $lastday, $vendedor) {

        if ($vendedor == "null") {

            $stmt = Connexion::connect()->prepare("SELECT
    'POSPAGO', COUNT(idtblinforme) AS Cantidad
FROM
    $table
WHERE
    fecha_venta BETWEEN '$firstday' AND '$lastday' AND tienda REGEXP '^[0-9]+$'
        AND  $table.gestor IN (SELECT DISTINCT
            idtblvendedores
        FROM
            $table2,
            $table3
        WHERE
            $table2.idzona IN (SELECT
                    idtbl_zonas
                FROM
                    $table3,
                    $table2
                WHERE
                     $table3.activo = 'Si' and idzona=idtbl_zonas))");

            $stmt->execute();

            return $stmt->fetch();
            // return $stmt;

            $stmt->close();

            $stmt = null;

        } else {

            $stmt = Connexion::connect()->prepare("SELECT
    'POSPAGO', COUNT(idtblinforme) AS Cantidad
FROM
    $table
WHERE
    fecha_venta BETWEEN '$firstday' AND '$lastday' AND tienda REGEXP '^[0-9]+$'
        AND  $table.gestor IN (SELECT DISTINCT
            idtblvendedores
        FROM
            $table2,
            $table3
        WHERE
            $table2.idzona IN (SELECT
                    idtbl_zonas
                FROM
                    $table3,
                    $table2
                WHERE
                     user = '$vendedor' AND $table3.activo = 'Si' and idzona=idtbl_zonas))");

            $stmt->execute();

            return $stmt->fetch();
            // return $stmt;

            $stmt->close();

            $stmt = null;

        }

    }

/*=============================================
=  Cargar total de ventas GPON      =
=============================================*/

    public static function Mdlventas_gpon($table, $table2, $table3, $firstday, $lastday, $vendedor) {

        if ($vendedor == "null") {

            $stmt = Connexion::connect()->prepare("SELECT
												'GPON', COUNT(idtblinforme_gpon) AS Cantidad
												FROM
												$table
												WHERE
												fecha_contrato BETWEEN '$firstday' AND '$lastday'
												AND  $table.vendedor IN (SELECT DISTINCT
												idtblvendedores
												FROM
												$table2,
												$table3
												WHERE
												$table2.idzona IN (SELECT
												idtbl_zonas
												FROM
												$table3,
												$table2
												WHERE
												$table3.activo = 'Si' and idzona=idtbl_zonas))");

            $stmt->execute();

            return $stmt->fetch();
            // return $stmt;

            $stmt->close();

            $stmt = null;

        } else {

            $stmt = Connexion::connect()->prepare("SELECT
    'GPON', COUNT(idtblinforme_gpon) AS Cantidad
FROM
    $table
WHERE
    fecha_contrato BETWEEN '$firstday' AND '$lastday'
        AND  $table.vendedor IN (SELECT DISTINCT
            idtblvendedores
        FROM
            $table2,
            $table3
        WHERE
            $table2.idzona IN (SELECT
                    idtbl_zonas
                FROM
                    $table3,
                    $table2
                WHERE
                     user = '$vendedor' AND $table3.activo = 'Si' and idzona=idtbl_zonas))");

            $stmt->execute();

            return $stmt->fetch();
            // return $stmt;

            $stmt->close();

            $stmt = null;

        }

    }

/*=============================================
=               Cargar coordinador        =
=============================================*/

    public static function MdlCargarCoordinadores($table) {

        $stmt = Connexion::connect()->prepare("SELECT * FROM  $table where activo = 'Si' and sub_tipo = '1. Coordinador' order by nombre asc");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

        $stmt->execute();

    }

    /*=============================================
    = Cargar coordinador asociado al vendedor       =
    =============================================*/

    public static function MdlCargarCoordinadoresXusuario($table, $usuario) {

        $stmt = Connexion::connect()->prepare("SELECT * FROM  $table where activo = 'Si' and sub_tipo = '1. Coordinador' and user = '$usuario' order by nombre");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

        $stmt->execute();

    }

    /*=============================================
    = Cargar coordinador asociado al vendedor       =
    =============================================*/

    public static function MdlCargarVentasTotales($table, $table1, $startDate, $endDate) {

        /*$stmt = Connexion::connect()->prepare("SELECT distinctrow a.idtbl_zonas,a.coordinador,a.nombre,a.representante,a.zona as division,a.placa,ifnull(b.dth,0) as dth,ifnull(c.internet,0) as internet,ifnull(d.pospago,0) as pospago,ifnull(e.gpon,0) as gpon,(ifnull(b.dth,0) + ifnull(c.internet,0) + ifnull(d.pospago,0) + ifnull(e.gpon,0)) as total, a.activo
        from (select $table.nombre,$table.coordinador,$table.zona,placa,idtbl_zonas,representante,$table.activo  from $table,$table2,$table6 where $table2.coordinador=$table6.nombre and $table6.activo='Si' and sub_tipo like '1.%' and idzona=idtbl_zonas and departamento='DTH' group by $table.nombre
        UNION
        select $table.nombre,$table.coordinador,$table.zona,placa,idtbl_zonas,$table2.representante,$table.activo  from $table1,$table2,$table where vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$startDate' and '$endDate' group by $table.nombre
        UNION
        select $table.nombre,$table.coordinador,$table.zona,placa,idtbl_zonas,$table2.representante,$table.activo  from $table3,$table2,$table where vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$startDate' and '$endDate' group by $table.nombre
        UNION
        select $table.nombre,$table.coordinador,$table.zona,placa,idtbl_zonas,$table2.representante,$table.activo from $table4,$table2,$table where tienda REGEXP '^[0-9]+$'  and gestor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$startDate' and '$endDate' group by $table.nombre
        UNION
        select $table.nombre,$table.coordinador,$table.zona,placa,idtbl_zonas,$table2.representante,$table.activo  from $table5,$table2,$table where  vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_contrato between '$startDate' and '$endDate' group by $table.nombre ) as a
        left join(select $table.nombre as zona1,ifnull(count(idtbl_ventas_calle_dth),0) as dth,$table2.representante  from $table1,$table2,$table where vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$startDate' and '$endDate' group by $table.nombre) b ON b.zona1 = a.nombre and a.representante=b.representante
        left join(select $table.nombre as zona1,ifnull(count(idtbl_informe_internet),0) as internet,$table2.representante  from $table3,$table2,$table where vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$startDate' and '$endDate' group by $table.nombre) c ON c.zona1 = a.nombre and a.representante=c.representante
        left join(select $table.nombre as zona1,ifnull(count(idtblinforme),0) as pospago,$table2.representante  from $table4,$table2,$table where tienda REGEXP '^[0-9]+$'  and gestor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$startDate' and '$endDate' group by $table.nombre) d ON d.zona1 = a.nombre and a.representante=d.representante
        left join(select $table.nombre as zona1,ifnull(count(idtblinforme_gpon),0) as gpon,$table2.representante  from $table5,$table2,$table where  vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_contrato between '$startDate' and '$endDate' group by $table.nombre) e ON e.zona1 = a.nombre and a.representante=e.representante;"); */

        /*
        $stmt = Connexion::connect()->prepare("SELECT distinctrow a.tipopago,a.movil,a.placa,a.coordinador,ifnull(b.dth,0) as dth,ifnull(c.internet,0) as internet,ifnull(d.pospago,0) as pospago,ifnull(e.gpon,0) as gpon,(ifnull(b.dth,0) + ifnull(c.internet,0) + ifnull(d.pospago,0) + ifnull(e.gpon,0)) as total
        from (select digitalsat.tbl_vehiculos.movil,tbl_vehiculos.placa,tbl_zonas.coordinador,tipopago  from digitalsat.tbl_vehiculos,digitalsat.tbl_zonas where tbl_zonas.placa=idtbl_vehiculos and tbl_zonas.activo='Si' and departamento='DTH'  group by digitalsat.tbl_vehiculos.movil ) as a
        left join(select digitalsat.tbl_vehiculos.movil,ifnull(count(idtbl_ventas_calle_dth),0) as dth  from digitalsat.tbl_ventas_calle_dth,digitalsat.tblvendedores,digitalsat.tbl_zonas,digitalsat.tbl_vehiculos where tbl_zonas.placa=idtbl_vehiculos and vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$startDate' and '$endDate' group by tbl_vehiculos.movil) b ON b.movil = a.movil
        left join(select digitalsat.tbl_vehiculos.movil,ifnull(count(idtbl_informe_internet),0) as internet,digitalsat.tblvendedores.representante  from digitalsat.tbl_informe_internet,digitalsat.tblvendedores,digitalsat.tbl_zonas,digitalsat.tbl_vehiculos where tbl_zonas.placa=idtbl_vehiculos and vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$startDate' and '$endDate' group by tbl_vehiculos.movil) c ON c.movil = a.movil
        left join(select digitalsat.tbl_vehiculos.movil,ifnull(count(idtblinforme),0) as pospago,digitalsat.tblvendedores.representante  from callcenter.tblinforme,digitalsat.tblvendedores,digitalsat.tbl_zonas,digitalsat.tbl_vehiculos where tbl_zonas.placa=idtbl_vehiculos and tienda REGEXP '^[0-9]+$'  and gestor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$startDate' and '$endDate' group by tbl_vehiculos.movil) d ON d.movil = a.movil
        left join(select digitalsat.tbl_vehiculos.movil,ifnull(count(idtblinforme_gpon),0) as gpon,digitalsat.tblvendedores.representante  from digitalsat.tblinforme_gpon,digitalsat.tblvendedores,digitalsat.tbl_zonas,digitalsat.tbl_vehiculos where tbl_zonas.placa=idtbl_vehiculos and vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_contrato between '$startDate' and '$endDate' group by tbl_vehiculos.movil) e ON e.movil = a.movil ;");
         */

        $stmt = Connexion::connect()->prepare("SELECT distinctrow a.movil,a.placa,ifnull(b.tipopago,0) as tipopago,ifnull(b.coordinador,0) as coordinador,ifnull(c.dth,0) as dth,ifnull(d.pospago,0) as pospago,
												ifnull(e.internet,0) as internet,ifnull(f.gpon,0) as gpon,ifnull(c.dth,0) +ifnull(d.pospago,0) +ifnull(e.internet,0)+ifnull(f.gpon,0) as total
												from (select $table.movil,tbl_vehiculos.placa  from $table  group by $table.movil ) as a
												left join
												(SELECT coordinador,movil,tipopago FROM $table1 where fecha_ingreso BETWEEN '$startDate' AND '$endDate' group by movil) as b on b.movil=a.movil
												left join
												(SELECT movil,count(movil) as dth FROM $table1 where fecha_ingreso BETWEEN '$startDate' AND '$endDate' and canal='DTH'
												and estado='Usado' group by movil) as c on c.movil=a.movil
												left join
												(SELECT movil,count(movil) as pospago FROM $table1 where fecha_ingreso BETWEEN '$startDate' AND '$endDate'
												and canal='POSPAGO' and estado='Usado' group by movil) as d on d.movil=a.movil
												left join
												(SELECT movil,count(movil) as internet FROM $table1 where fecha_ingreso BETWEEN '$startDate' AND '$endDate'
												and canal='INTERNET' and estado='Usado' group by movil) as e on e.movil=a.movil
												left join
												(SELECT movil,count(movil) as gpon FROM $table1 where fecha_ingreso BETWEEN '$startDate' AND '$endDate'
												and canal='GPON' and estado='Usado' group by movil) as f on f.movil=a.movil;
												");

        $stmt->execute();

        /*return $stmt -> fetchAll();*/

        return $stmt;

        $stmt->close();

        $stmt = null;

        $stmt->execute();

    }

    public static function MdlCargarVentasTotalesCompararTablas($table, $table1, $table2, $table3, $table4, $table5, $table6, $Vardesde1, $Varhasta1, $Vardesde2, $Varhasta2) {

        $stmt = Connexion::connect()->prepare("SELECT a.idtbl_zonas,a.coordinador,a.nombre,a.representante,a.zona as division,a.placa,ifnull(b.dth,0) as dth,ifnull(c.internet,0) as internet,ifnull(d.pospago,0) as pospago,ifnull(e.gpon,0) as gpon,(ifnull(b.dth,0) + ifnull(c.internet,0) + ifnull(d.pospago,0) + ifnull(e.gpon,0)) as total,ifnull(f.dth2,0) as dth2,ifnull(g.internet2,0) as internet2,ifnull(h.pospago2,0) as pospago2,ifnull(i.gpon2,0) as gpon2,(ifnull(f.dth2,0) + ifnull(g.internet2,0) + ifnull(h.pospago2,0) + ifnull(i.gpon2,0)) as total2
      from  (select $table.nombre,$table.coordinador,$table.zona,placa,idtbl_zonas,representante,$table.activo  from $table,$table2,$table6 where $table2.coordinador=$table6.nombre and $table6.activo='Si' and sub_tipo like '1.%' and idzona=idtbl_zonas and departamento='DTH' group by $table.nombre
			UNION
			select $table.nombre,$table.coordinador,$table.zona,placa,idtbl_zonas,$table2.representante,$table.activo  from $table1,$table2,$table where vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$Vardesde1' and '$Varhasta2' group by $table.nombre
			UNION
            select $table.nombre,$table.coordinador,$table.zona,placa,idtbl_zonas,$table2.representante,$table.activo  from $table3,$table2,$table where vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$Vardesde1' and '$Varhasta2' group by $table.nombre
            UNION
            select $table.nombre,$table.coordinador,$table.zona,placa,idtbl_zonas,$table2.representante,$table.activo from $table4,$table2,$table where tienda REGEXP '^[0-9]+$'  and gestor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$Vardesde1' and '$Varhasta2' group by $table.nombre
            UNION
            select $table.nombre,$table.coordinador,$table.zona,placa,idtbl_zonas,$table2.representante,$table.activo  from $table5,$table2,$table where  vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_contrato between '$Vardesde1' and '$Varhasta2' group by $table.nombre ) as a
	  left join(select $table.nombre as zona1,ifnull(count(idtbl_ventas_calle_dth),0) as dth,$table2.representante   from $table1,$table2,$table where vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$Vardesde1' and '$Varhasta1' group by $table.nombre) b ON b.zona1 = a.nombre and a.representante=b.representante
      left join(select $table.nombre as zona1,ifnull(count(idtbl_informe_internet),0) as internet,$table2.representante   from $table3,$table2,$table where vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$Vardesde1' and '$Varhasta1' group by $table.nombre) c ON c.zona1 = a.nombre and a.representante=c.representante
	  left join(select $table.nombre as zona1,ifnull(count(idtblinforme),0) as pospago,$table2.representante   from $table4,$table2,$table where tienda REGEXP '^[0-9]+$'  and gestor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$Vardesde1' and '$Varhasta1' group by $table.nombre) d ON d.zona1 = a.nombre and a.representante=d.representante
      left join(select $table.nombre as zona1,ifnull(count(idtblinforme_gpon),0) as gpon,$table2.representante   from $table5,$table2,$table where  vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_contrato between '$Vardesde1' and '$Varhasta1' group by $table.nombre) e ON e.zona1 = a.nombre and a.representante=e.representante
       left join(select $table.nombre as zona1,ifnull(count(idtbl_ventas_calle_dth),0) as dth2,$table2.representante   from $table1,$table2,$table where vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$Vardesde2' and '$Varhasta2' group by $table.nombre) f ON f.zona1 = a.nombre and a.representante=f.representante
      left join(select $table.nombre as zona1,ifnull(count(idtbl_informe_internet),0) as internet2,$table2.representante   from $table3,$table2,$table where vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$Vardesde2' and '$Varhasta2' group by $table.nombre) g ON g.zona1 = a.nombre and a.representante=g.representante
	  left join(select $table.nombre as zona1,ifnull(count(idtblinforme),0) as pospago2,$table2.representante   from $table4,$table2,$table where tienda REGEXP '^[0-9]+$'  and gestor=idtblvendedores and idzona=idtbl_zonas AND fecha_venta between '$Vardesde2' and '$Varhasta2' group by $table.nombre) h ON h.zona1 = a.nombre and a.representante=h.representante
      left join(select $table.nombre as zona1,ifnull(count(idtblinforme_gpon),0) as gpon2,$table2.representante   from $table5,$table2,$table where  vendedor=idtblvendedores and idzona=idtbl_zonas AND fecha_contrato between '$Vardesde2' and '$Varhasta2'  group by $table.nombre) i ON i.zona1 = a.nombre and a.representante=i.representante;");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    = Cargar coordinador asociado al supervisor       =
    =============================================*/

    public static function MdlCargarVentasTotalesXSupervisores($table, $table1, $startDate, $endDate) {

        $stmt = Connexion::connect()->prepare("SELECT distinctrow a.supervisor,IFNULL(c.dth,0) AS dth,IFNULL(d.pospago,0) AS pospago,
												IFNULL(e.internet,0) AS internet,IFNULL(f.gpon,0) AS gpon,
												IFNULL(c.dth,0) +IFNULL(d.pospago,0) +IFNULL(e.internet,0)+IFNULL(f.gpon,0) AS total
												FROM (SELECT nombre AS supervisor FROM $table
												WHERE canal='DTH' AND activo='Si' ) AS a
												LEFT JOIN
												(SELECT supervisor,count(supervisor) AS dth FROM $table1
												WHERE fecha_ingreso BETWEEN '$startDate' AND '$endDate' AND canal='DTH'
												AND estado='Usado' GROUP BY supervisor) AS c on c.supervisor=a.supervisor
												LEFT JOIN
												(SELECT supervisor,count(supervisor) AS pospago FROM $table1
												WHERE fecha_ingreso BETWEEN '$startDate' AND '$endDate' AND canal='POSPAGO' AND estado='Usado'
												GROUP BY supervisor) AS d on d.supervisor=a.supervisor
												LEFT JOIN
												(SELECT supervisor,count(supervisor) AS internet FROM $table1
												WHERE fecha_ingreso BETWEEN '$startDate' AND '$endDate' AND canal='INTERNET' AND estado='Usado'
												GROUP BY supervisor) AS e on e.supervisor=a.supervisor
												LEFT JOIN
												(SELECT supervisor,count(supervisor) AS gpon FROM $table1
												WHERE fecha_ingreso BETWEEN '$startDate' AND '$endDate' AND canal='GPON' AND estado='Usado'
												GROUP BY supervisor) AS f on f.supervisor=a.supervisor;"
        );

        $stmt->execute();

        //return $stmt -> fetchAll();

        return $stmt;

        $stmt->close();

        $stmt = null;

        $stmt->execute();

    }

/*=============================================
=       Cargar todos los vendedores                    =
=============================================*/

    public static function MdlCargarVendedores($table) {

        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where  activo = 'Si' and user <> '9999' order by nombre");

        $stmt->execute();

        return $stmt->fetchAll();

        // return $stmt;

        $stmt->close();

        $stmt = null;

    }

/*=============================================
= CARGAR TODOS LOS VENDEDORES DE ESE COORDINADOR                     =
=============================================*/

    public static function MdlCargarCoordinadores_2($table, $usuario) {

        $stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE $table.coordinador = (SELECT coordinador FROM $table where user = '$usuario') and activo = 'Si' and user <> '9999' order by nombre");

        $stmt->execute();

        return $stmt->fetchAll();
        // return $stmt;

        $stmt->close();

        $stmt = null;

    }

/*=============================================
= CARGAR EL VENDEDOR                    =
=============================================*/

    public static function MdlCargarVendedor($table, $usuario) {

        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where user = '$usuario' and activo = 'Si' and user <> '9999' order by nombre");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    public static function MdlCargarVentasAnuales($año) {

        $stmt = Connexion::connect()->prepare("SELECT distinctrow y.mes,IFNULL(c.dth,0) as dth,IFNULL(d.pospago,0) as pospago,IFNULL(e.internet,0)
												as internet,IFNULL(f.gpon,0) as gpon,IFNULL(c.dth,0) +IFNULL(d.pospago,0) +IFNULL(e.internet,0)+IFNULL(f.gpon,0) as total
												FROM (SELECT MONTH(fecha) as fecha,MONTHNAME(fecha) as fechames FROM callcenter.tbl_fechas
												group by MONTH(fecha) ) as a
												left join
												(SELECT MONTH(fecha_ingreso) as fechames,COUNT(idtbl_codigo_validacion) as dth
												FROM digitalsat.tbl_codigo_validacion
												where fecha_ingreso LIKE '$año%' and canal='DTH' and estado='Usado'
												group by MONTH(fecha_ingreso)) as c on c.fechames=a.fecha
												left join
												(SELECT MONTH(fecha_ingreso) as fechames,COUNT(idtbl_codigo_validacion) as pospago
												FROM digitalsat.tbl_codigo_validacion
												where fecha_ingreso LIKE '$año%' and canal='POSPAGO' and estado='Usado'
												group by MONTH(fecha_ingreso)) as d on d.fechames=a.fecha
												left join
												(SELECT MONTH(fecha_ingreso) as fechames,COUNT(idtbl_codigo_validacion) as internet
												FROM digitalsat.tbl_codigo_validacion where fecha_ingreso LIKE '$año%'
												and canal='INTERNET' and estado='Usado'
												group by MONTH(fecha_ingreso)) as e on e.fechames=a.fecha
												left join
												(SELECT MONTH(fecha_ingreso) as fechames,COUNT(idtbl_codigo_validacion) as gpon
												FROM digitalsat.tbl_codigo_validacion
												where fecha_ingreso LIKE '$año%' and canal='GPON' and estado='Usado'
												group by MONTH(fecha_ingreso)) as f on f.fechames=a.fecha
												inner join
												(SELECT mes,numero FROM callcenter.tbl_meses) as y on a.fecha = y.numero;"
        );

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    public static function MdlCargarinicioUsuarioRutas($table, $usuario, $fecha) {

        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where usuario = '$usuario' and fecha like '$fecha%'");

        $stmt->execute();

        return $stmt->fetch();

        // return $stmt;

        $stmt->close();

        $stmt = null;

    }

	static public function MdlCargarInicioCierreRutas($table, $table2, $table3, $startDate, $endDate) {

		$usuario = $_SESSION["id"];
		
		
		
		if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor" ){
		
			$stmt = Connexion::connect()->prepare("SELECT 
												e.nombre AS coordinador,
												IFNULL(a.placa, 'N/A') AS placa,
												IFNULL(a.fecha, '2001-01-01') AS fechainicio,
												IFNULL(b.fecha, '2001-01-01') AS fechafinal,
												IF(a.fecha IS NULL,
													'No Creado',
													IF(b.tipo = 'Cierre',
														'Cerrado',
														'Abierto')) AS Estado,
												IFNULL(a.usuario, 'N/A') AS usuario,
												IFNULL(a.kilometraje, 0) AS kilo_inicio,
												IFNULL(b.kilometraje, 0) AS kilo_cierre,
												IF(b.kilometraje = '0',
													'0',
													b.kilometraje - a.kilometraje) AS recorrido,
												IFNULL(a.latitud, '') AS latitud,
												IFNULL(a.personas, 0) AS personas
											FROM
												(SELECT 
													user, nombre
												FROM
													digitalsat.tblvendedores
												WHERE
													activo = 'Si'
														AND sub_tipo = '1. Coordinador') AS e
													LEFT JOIN
												(SELECT 
													$table.placa,
														fecha,
														$table.tipo,
														$table2.nombre AS coordinador,
														$table.usuario,
														kilometraje,
														latitud,
														personas
												FROM
													$table, $table2
												WHERE
													user = usuario
														AND fecha BETWEEN '$startDate 00:00:00' AND '$endDate 12:59:59'
														AND $table.tipo = 'Inicio'
												GROUP BY user) AS a ON a.usuario = e.user
													LEFT JOIN
												(SELECT 
													$table.placa,
														fecha,
														$table.tipo,
														$table2.nombre AS coordinador,
														$table.usuario,
														kilometraje
												FROM
													$table, $table2
												WHERE
													user = usuario
														AND fecha BETWEEN '$startDate 00:00:00' AND '$endDate 12:59:59'
														AND $table.tipo = 'Cierre'
												GROUP BY user) AS b ON b.usuario = e.user 
											UNION SELECT 
												f.nombre AS coordinador,
												IFNULL(c.placa, 'N/A') AS placa,
												IFNULL(c.fecha, '2001-01-01') AS fechainicio,
												IFNULL(d.fecha, '2001-01-01') AS fechafinal,
												IF(c.fecha IS NULL,
													'No Creado',
													IF(d.tipo = 'Cierre',
														'Cerrado',
														'Abierto')) AS Estado,
												IFNULL(c.usuario, 'N/A') AS usuario,
												IFNULL(c.kilometraje, 0) AS kilo_inicio,
												IFNULL(d.kilometraje, 0) AS kilo_cierre,
												IF(d.kilometraje = '0',
													'0',
													d.kilometraje - c.kilometraje) AS recorrido,
												IFNULL(c.latitud, '') AS latitud,
												IFNULL(c.personas, 0) AS personas
											FROM
												(SELECT 
													usuario, nombre
												FROM
													digitalsat.tbltecnicos
												WHERE
													activo = 'Si'
														AND tipo = 'Instalador Propio') AS f
													LEFT JOIN
												(SELECT 
													$table.placa,
														fecha,
														$table.tipo,
														$table3.nombre AS coordinador,
														$table.usuario,
														kilometraje,
														latitud,
														personas
												FROM
													$table, $table3
												WHERE
													$table.usuario = $table3.usuario
														AND fecha BETWEEN '$startDate 00:00:00' AND '$endDate 12:59:59'
														AND $table.tipo = 'Inicio'
												GROUP BY usuario) AS c ON c.usuario = f.usuario
													LEFT JOIN
												(SELECT 
													$table.placa,
														fecha,
														$table.tipo,
														$table3.nombre AS coordinador,
														$table.usuario,
														kilometraje
												FROM
													$table, $table3
												WHERE
													$table.usuario = $table3.usuario
														AND fecha BETWEEN '$startDate 00:00:00' AND '$endDate 12:59:59'
														AND $table.tipo = 'Cierre'
												GROUP BY usuario) AS d ON d.usuario = f.usuario;");
		
		
						
			$stmt -> execute();
		
			//return $stmt -> fetchAll();
		
			return $stmt;
		
			$stmt -> close();
		
			$stmt =null;
		
		}else{
		
		
			$stmt = Connexion::connect()->prepare("SELECT 
												a.placa,
												a.fecha AS fechainicio,
												IF(b.tipo = 'Cierre',
													'Cerrado',
													'Abierto') AS Estado,
												a.coordinador,
												a.usuario,
												a.kilometraje AS kilo_inicio,
												IFNULL(b.kilometraje, 0) AS kilo_cierre,
												IF(b.kilometraje = '0',
													a.kilometraje - b.kilometraje,
													'0') AS recorrido,
												IFNULL(a.latitud, '') AS latitud,
												a.personas
											FROM
												(SELECT 
													$table.placa,
														fecha,
														$table.tipo,
														$table2.nombre AS coordinador,
														$table.usuario,
														kilometraje,
														latitud,
														personas
												FROM
													$table, $table2
												WHERE
													user = usuario
														AND fecha BETWEEN '$startDate 00:00:00' AND '$endDate 12:59:59'
														AND $table.tipo = 'Inicio'
														AND $table.usuario = '$usuario') AS a
													LEFT JOIN
												(SELECT 
													$table.placa,
														fecha,
														$table.tipo,
														$table2.nombre AS coordinador,
														$table.usuario,
														kilometraje
												FROM
													$table, $table2
												WHERE
													user = usuario
														AND fecha BETWEEN '$startDate 00:00:00' AND '$endDate 12:59:59'
														AND $table.tipo = 'Cierre'
														AND $table.usuario = '$usuario') AS b ON a.usuario = b.usuario 
											UNION SELECT 
												c.placa,
												c.fecha AS fechainicio,
												IF(d.tipo = 'Cierre',
													'Cerrado',
													'Abierto') AS Estado,
												c.coordinador,
												c.usuario,
												c.kilometraje AS kilo_inicio,
												IFNULL(d.kilometraje, 0) AS kilo_cierre,
												IF(d.kilometraje = '0',
													c.kilometraje - d.kilometraje,
													'0') AS recorrido,
												IFNULL(c.latitud, '') AS latitud,
												c.personas
											FROM
												(SELECT 
													$table.placa,
														fecha,
														$table.tipo,
														$table3.nombre AS coordinador,
														$table.usuario,
														kilometraje,
														latitud,
														personas
												FROM
													$table, $table3
												WHERE
													$table.usuario = $table3.usuario
														AND fecha BETWEEN '$startDate 00:00:00' AND '$endDate 12:59:59'
														AND $table.tipo = 'Inicio'
														AND $table3.usuario = '$usuario') AS c
													LEFT JOIN
												(SELECT 
													$table.placa,
														fecha,
														$table.tipo,
														$table3.nombre AS coordinador,
														$table.usuario,
														kilometraje
												FROM
													$table, $table3
												WHERE
													$table.usuario = $table3.usuario
														AND fecha BETWEEN '$startDate 00:00:00' AND '$endDate 12:59:59'
														AND $table.tipo = 'Cierre'
														AND $table3.usuario = '$usuario') AS d ON c.usuario = d.usuario;
														");
						
			$stmt -> execute();
		
			return $stmt -> fetchAll();
		
			//return $stmt;
			$stmt -> close();
		
			$stmt =null;
		
		}
		
		
	}


	/*===================================
	=      INSERTAR APERTURA DE RUTA    =
	====================================*/

	static public function MdlInsertarAperturaRuta($table, $data) {
 

		$db = Connexion::connect();
		
		$stmt = $db->prepare("INSERT INTO $table(placa, kilometraje, tipo, usuario, fecha, latitud, longitud, personas, idplaca,kilometros_recorridos) 
								VALUES (:placa, :kilometraje, :tipo, :usuario, :fecha, :latitud, :longitud, :personas, :idplaca, :kilometros_recorridos)");
		
		$stmt->bindParam(":placa",$data["placa"], PDO::PARAM_STR);
		$stmt->bindParam(":kilometraje",$data["kilometraje"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo",$data["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$data["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha",$data["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":latitud",$data["latitud"], PDO::PARAM_STR);
		$stmt->bindParam(":longitud",$data["longitud"], PDO::PARAM_STR);
		$stmt->bindParam(":personas",$data["personas"], PDO::PARAM_STR);		
		$stmt->bindParam(":idplaca",$data["idplaca"], PDO::PARAM_STR);	
		$stmt->bindParam(":kilometros_recorridos",$data["kilometros_recorridos"], PDO::PARAM_STR);	
		
				
		if($stmt->execute()){
			return $db->lastInsertId();
		}
		
		else{
			return $stmt->errorInfo()[2];
		}
		
		$stmt -> close();
		
		$stmt =null;
		
	}


	/*================================
	=     INSERTAR FOTO DE RUTA      =
	=================================*/

	static public function MdlInsertarFotoRuta($table,$data) {

		$stmt = Connexion::connect()->prepare("UPDATE $table SET foto_kilometraje = :foto_kilometraje, ruta_externa = :ruta_externa 
												where idtbl_apertura_rutas = :idtbl_apertura_rutas ");

		$stmt->bindParam(":foto_kilometraje",$data["foto_kilometraje"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta_externa",$data["ruta_externa"], PDO::PARAM_STR);
		$stmt->bindParam(":idtbl_apertura_rutas",$data["id_ruta"], PDO::PARAM_STR);
		
		if($stmt->execute()){
			return "ok";
		} else {
			return $stmt->errorInfo()[2];
		}
		$stmt -> close();
		$stmt =null;
	}


	/*==============================
	=   CARGAR DATOS DE APERTURA   =
	===============================*/

	static public function MdlCargarDatosApertura($table, $usuario_id, $fecha) {

		$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE usuario = '$usuario_id' AND fecha 
												BETWEEN '$fecha 01:00:00' AND '$fecha 12:59:59' and tipo = 'Inicio'");

		$stmt -> execute();

		return $stmt -> fetchAll();
		// return $stmt;

		$stmt -> close();

		$stmt =null;
	}

	/*==============================
	=  CARGAR DATOS DE VENTAS DTH  =
	===============================*/

	static public function MdlCargarDatosVentas_dth($table1, $table2, $tableZona, $usuario_id, $fecha_nueva) {

		$stmt = Connexion::connect()->prepare("SELECT 
													IFNULL(COUNT(idtbl_ventas_calle_dth), 0)
												FROM
													$table2
												WHERE
													fecha_venta = '$fecha_nueva'
														AND $table2.vendedor IN (SELECT DISTINCT
															idtblvendedores
														FROM
															$table1,
															$tableZona
														WHERE
															$table1.idzona IN (SELECT 
																	idtbl_zonas
																FROM
																	$tableZona,
																	$table1
																WHERE
																	$table1.user = '$usuario_id'
																		AND $tableZona.activo = 'Si'
																		AND idzona = idtbl_zonas))");
	
		$stmt -> execute();
	
		return $stmt -> fetch();
	
		//return $stmt;
	
		$stmt -> close();
	
		$stmt =null;
	}

 	/*=======================================
	=   CARGAR DATOS DE VENTAS DE INTERNET  =
	========================================*/

	static public function MdlCargarDatosVentas_internet($table1, $table5, $tableZona, $usuario_id, $fecha_nueva) {

		$stmt = Connexion::connect()->prepare("SELECT 
												IFNULL(COUNT(idtbl_informe_internet), 0)
											FROM
												$table5
											WHERE
												fecha_venta = '$fecha_nueva'
													AND $table5.vendedor IN (SELECT DISTINCT
														idtblvendedores
													FROM
														$table1,
														$tableZona
													WHERE
														$table1.idzona IN (SELECT 
																idtbl_zonas
															FROM
																$tableZona,
																$table1
															WHERE
																$table1.user = '$usuario_id'
																	AND $tableZona.activo = 'Si'
																	AND idzona = idtbl_zonas))
											");
	
		$stmt -> execute();
	
		return $stmt -> fetch();
	
		// return $stmt;
	
		$stmt -> close();
	
		$stmt =null;
	}


	/*==========================================
	=     CARGAR DATOS DE VENTAS POSPAGO       =
	==========================================*/

	static public function MdlCargarDatosVentas_pospago($table1, $table4, $tableZona, $usuario_id, $fecha_nueva) {

		$stmt = Connexion::connect()->prepare("SELECT 
													IFNULL(COUNT(idtblinforme), 0)
												FROM
													$table4
												WHERE
													tienda REGEXP '^[0-9]+$'
														AND fecha_venta = '$fecha_nueva'
														AND $table4.gestor IN (SELECT DISTINCT
															idtblvendedores
														FROM
															$table1,
															$tableZona
														WHERE
															$table1.idzona IN (SELECT 
																	idtbl_zonas
																FROM
																	$tableZona,
																	$table1
																WHERE
																	$table1.user = '$usuario_id'
																		AND $tableZona.activo = 'Si'
																		AND idzona = idtbl_zonas))");
	
		$stmt -> execute();
	
		return $stmt -> fetch();
	
		// return $stmt;
	
		$stmt -> close();
	
		$stmt =null;
	}

	static public function MdlCargarDatosVentas_gpon($table1, $table3, $tableZona, $usuario_id, $fecha_nueva) {

		$stmt = Connexion::connect()->prepare("SELECT 
													IFNULL(COUNT(idtblinforme_gpon), 0)
												FROM
													$table3
												WHERE
													fecha_contrato = '$fecha_nueva'
														AND $table3.vendedor IN (SELECT DISTINCT
															idtblvendedores
														FROM
															$table1,
															$tableZona
														WHERE
															$table1.idzona IN (SELECT 
																	idtbl_zonas
																FROM
																	$tableZona,
																	$table1
																WHERE
																	$table1.user = '$usuario_id'
																		AND $tableZona.activo = 'Si'
																		AND idzona = idtbl_zonas))");
	
		$stmt -> execute();
	
		return $stmt -> fetch();
	
		// return $stmt;
	
		$stmt -> close();
	
		$stmt =null;
	
	
	}

	static public function MdlActualizarRuta($table,$data) {

		$stmt = Connexion::connect()->prepare("UPDATE $table SET kilometraje = :kilometraje,fecha_actualizacion = :fecha_actualizacion,
												usuario_actualizacion = :usuario_actualizacion 
												where idtbl_apertura_rutas = :idtbl_apertura_rutas ");

		$stmt->bindParam(":kilometraje",$data["kilometraje"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_actualizacion",$data["fecha_actualizacion"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_actualizacion",$data["usuario_actualizacion"], PDO::PARAM_STR);

		$stmt->bindParam(":idtbl_apertura_rutas",$data["idtbl_apertura_rutas"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


	}


    /*=====================================
    =      CARGAR INFORMACION DE RUTAS    =
    ======================================*/

    static public function MdlCargarInformacionRutas($table, $table2, $placa, $fecha) {

        $fecha_final = date("Y-m-d", strtotime($fecha));
        
        $stmt = Connexion::connect()->prepare("SELECT a.*, b.nombre as usuario FROM $table a left join $table2 b on b.user = a.usuario 
                                               where placa = '$placa' and fecha like '$fecha_final%' and a.tipo = 'Inicio'");
                        
        $stmt -> execute();
        
        return $stmt -> fetch();
        
        // return $stmt;
        
        $stmt -> close();
        
        $stmt =null;
    }
        

    /*===================================
    =      CARGAR INCIO DE RUTAS        =
    ====================================*/

    static public function MdlCargarInicioRutas($table, $id_usuario, $fecha) {

        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where usuario = '$id_usuario' and fecha between '$fecha 00:00:00' and '$fecha 12:59:59' 
                                                and tipo = 'Inicio' order by idtbl_apertura_rutas desc limit 1");
            
        $stmt -> execute();

        return $stmt -> fetch();

        // return $stmt;

        $stmt -> close();

        $stmt =null;
    }


    /*==========================================
    =    CARGAR INFORMACION CIERRE DE RUTAS    =
    ===========================================*/

    static public function MdlCargarInformacionCierreRutas($table, $placa_cierre, $fecha_cierre) {


        $fecha_final = date("Y-m-d", strtotime($fecha_cierre));
        
        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where placa = '$placa_cierre' and fecha like '$fecha_final%' and tipo = 'Cierre'");
                        
        $stmt -> execute();
        
        return $stmt -> fetch();
        
        // return $stmt;
        
        $stmt -> close();
        
        $stmt =null;
    }



    /*=======================================
    =     CARGAR INFORMACION POR PLACA      =
    =======================================*/

    static public function MdlCargarInformacionPlaca($table, $table2,$table3,$table4,$id_usuario_vehiculo,$rol) {

        if($rol=="Instalador"){
            $stmt = Connexion::connect()->prepare("SELECT idtbl_vehiculos,$table3.placa from $table4,$table3 where $table4.placa =idtbl_vehiculos and  usuario='$id_usuario_vehiculo'");

        }else{
            $stmt = Connexion::connect()->prepare("SELECT idtbl_vehiculos,$table3.placa from $table, $table2,$table3 where $table.placa =idtbl_vehiculos and  idtbl_zonas=idzona and  user='$id_usuario_vehiculo'");

        }
    
        $stmt -> execute();

        return $stmt -> fetch();

        //return $stmt;

        $stmt -> close();

        $stmt =null;
    }

    
    /*=======================================
    =      CARGAR KILOMETRAJE DE MOVILES    =
    =======================================*/

    static public function MdlCargarKmMoviles($fechaHoy, $fechaInicio, $fechaAyer, $table1, $table2) {

        $stmt = Connexion::connect()->prepare("SELECT a.movil, a.placa, IFNULL(b.fecha,'SIN APERTURA') AS fecha, a.meta, 
                                            IFNULL(b.kilometros_recorridos,'SIN CIERRE') AS kmhoy, IFNULL(c.kmhastaayer,0) AS kmhastaayer 
                                            FROM 
                                            (SELECT placa,movil,meta 
                                            FROM $table1) AS a
                                            LEFT JOIN 
                                            (SELECT placa,fecha,kilometros_recorridos 
                                            FROM $table2 
                                            WHERE fecha='$fechaHoy') AS b ON b.placa = a.placa
                                             LEFT JOIN
                                            (SELECT placa, SUM(kilometros_recorridos) AS kmhastaayer 
                                            FROM $table2 
                                            WHERE fecha BETWEEN '$fechaInicio' AND '$fechaAyer' GROUP BY placa) AS c
                                            ON c.placa = a.placa
                                            GROUP BY a.placa;
                                            ");

        $stmt->execute();
        
        return $stmt->fetchAll();
        //return $stmt;

        $stmt -> close();
        $stmt =null;
    }


}
