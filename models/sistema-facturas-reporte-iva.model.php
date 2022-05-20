<?php

require_once "connexion.php";

class ReporteIvaModel{
 

    static public function MdlCargarIva($table, $table2, $table3, $idempresa, $fechaDesde, $FechaHasta) { 

        $stmt = Connexion::connect()->prepare("SELECT   a.idtbl_sistema_facturacion_facturas as idtbl_facturas,a.fecha_factura as fecha,a.nombre as Origen,a.estado_factura as estado,a.nombre_cliente as nombre,a.tipo_doc,a.condicion_venta as tipo_pago ,a.consecutivo,a.clave,ifnull(b.exento,0) as exento,ifnull(c.base,0) as base,
        ifnull(d.iva_uno,0) as iva_uno,ifnull(e.iva_dos,0) as iva_dos,ifnull(f.iva_cuatro,0) as iva_cuatro,ifnull(g.iva_ocho,0) as iva_ocho,ifnull(h.iva_trece,0) as iva_trece,a.total,a.referencia as afecta,id_compania as id_empresa from(SELECT 
            idtbl_sistema_facturacion_facturas,
             fecha_factura,
             $table2.nombre,
           estado_factura,
           nombre_cliente,
           if(tipo_documento='01','Factura Electronica',if(tipo_documento='02','Nota Debito',if(tipo_documento='03','Nota Credito',if(tipo_documento='04','Ticket Electronico','NC')))) as tipo_doc,
            consecutivo,
                clave,if(tipo_documento in('01','02','04'),total,total*-1) as total,referencia,id_compania ,if(condicion_venta='01','Contado',if(condicion_venta='02','Credito','')) as condicion_venta
        FROM
        $table,
        $table2
        WHERE
        sucursal=idsucursal and
            id_compania = $idempresa
                AND fecha_factura between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and estado_factura='Aceptado'  order by  $table2.nombre,fecha_factura) as a
                left join 
                (select id_factura,if(tipo_documento in('01','02','04'),sum($table3.subtotal * tipo_cambio),sum($table3.subtotal * tipo_cambio)*-1) as exento from $table, $table3 where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa' AND fecha_factura between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tasa_Impuesto=0 group by id_factura) as b on b.id_factura=a.idtbl_sistema_facturacion_facturas
                left join 
                (select id_factura,if(tipo_documento in('01','02','04'),sum($table3.subtotal * tipo_cambio),sum($table3.subtotal * tipo_cambio)*-1) as base from $table, $table3 where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'  AND fecha_factura between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tasa_Impuesto<>0 group by id_factura) as c on c.id_factura=a.idtbl_sistema_facturacion_facturas
                left join 
                (select id_factura,if(tipo_documento in('01','02','04'),sum($table3.impuesto * tipo_cambio),sum($table3.impuesto * tipo_cambio)*-1) as iva_uno from $table, $table3 where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa' AND fecha_factura between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tasa_Impuesto=1 group by id_factura) as d on d.id_factura=a.idtbl_sistema_facturacion_facturas
                left join 
                (select id_factura,if(tipo_documento in('01','02','04'),sum($table3.impuesto * tipo_cambio),sum($table3.impuesto * tipo_cambio)*-1) as iva_dos from $table, $table3 where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa' AND fecha_factura between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tasa_Impuesto=2 group by id_factura) as e on e.id_factura=a.idtbl_sistema_facturacion_facturas
                left join 
                (select id_factura,if(tipo_documento in('01','02','04'),sum($table3.impuesto * tipo_cambio),sum($table3.impuesto * tipo_cambio)*-1) as iva_cuatro from $table, $table3 where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa' AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=4 group by id_factura) as f on f.id_factura=a.idtbl_sistema_facturacion_facturas
                left join 
                (select id_factura,if(tipo_documento in('01','02','04'),sum($table3.impuesto * tipo_cambio),sum($table3.impuesto * tipo_cambio)*-1) as iva_ocho from $table, $table3 where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'  AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=8 group by id_factura) as g on g.id_factura=a.idtbl_sistema_facturacion_facturas
                left join 
                (select id_factura,if(tipo_documento in('01','02','04'),sum($table3.impuesto * tipo_cambio),sum($table3.impuesto * tipo_cambio)*-1) as iva_trece from $table, $table3 where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'  AND fecha_factura between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tasa_Impuesto=13 group by id_factura) as h on h.id_factura=a.idtbl_sistema_facturacion_facturas
                order by origen,fecha");

        $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt;

        $stmt -> close();

        $stmt =null;

    }



    static public function MdlCargarCompras($table, $table2, $table3, $idempresa, $fechaDesde, $FechaHasta) { 

        $stmt = Connexion::connect()->prepare("SELECT a.idtbl_sistema_facturacion_Factura_gastos,  a.fechaEmision, a.Proveedor, a.Cedula_Proveedor, a.tipo_doc, a.consecutivo, a.clave, a.condicion_venta, ifnull(b.exento,0) as exento,ifnull(c.base,0) as base,ifnull(d.iva_uno,0) as iva_uno,ifnull(e.iva_dos,0) as iva_dos,ifnull(f.iva_cuatro,0) as iva_cuatro,ifnull(g.iva_ocho,0) as iva_ocho,ifnull(h.iva_trece,0) as iva_trece, ifnull(a.total,0) as total, a.categoria FROM (
            SELECT idtbl_sistema_facturacion_Factura_gastos, 
            fechaEmision, 
            nombreEmisor as Proveedor, 
            cedulaEmisor as Cedula_Proveedor,
             if(tipo_doc='01','Factura Electronica',if(tipo_doc='02','Nota Debito',if(tipo_doc='03','Nota Credito',if(tipo_doc='04','Ticket Electronico','NC')))) as tipo_doc,
             consecutivo,
             clave,
             if(tipo_doc in('01','02','04'),totalComprobante,totalComprobante*-1) as total,
             if(condicionVenta='01','Contado',if(condicionVenta='02','Credito','')) as condicion_venta,
             categoria
            FROM  $table  a inner join $table2 b on a.cedulaReceptor = b.cedula
            WHERE procesado = 'Si' 
            AND estadoProcesado = 'Aceptado' 
            AND fechaEmision between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59'
            and idtbl_clientes = '$idempresa'
            ORDER BY fechaEmision asc) as a
            left join 
            (SELECT  idFactura, if(tipo_doc in('01','02','04'),sum($table3.subTotal * tipoCambio),sum($table3.subTotal * tipoCambio)*-1) as exento FROM $table3, $table where idtbl_sistema_facturacion_Factura_gastos = idFactura and fechaEmision between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tarifaIva=0  and procesado = 'Si' and estadoProcesado = 'Aceptado' group by idFactura) as b on a.idtbl_sistema_facturacion_Factura_gastos = b.idFactura
            left join 
            (SELECT  idFactura, if(tipo_doc in('01','02','04'),sum($table3.subTotal * tipoCambio),sum($table3.subTotal * tipoCambio)*-1) as base FROM $table3, $table where idtbl_sistema_facturacion_Factura_gastos = idFactura and fechaEmision between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tarifaIva<>0  and procesado = 'Si' and estadoProcesado = 'Aceptado' group by idFactura) as c on a.idtbl_sistema_facturacion_Factura_gastos = c.idFactura
            left join 
            (SELECT  idFactura, if(tipo_doc in('01','02','04'),sum($table3.subTotal * tipoCambio),sum($table3.subTotal * tipoCambio)*-1) as iva_uno FROM $table3, $table where idtbl_sistema_facturacion_Factura_gastos = idFactura and fechaEmision between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tarifaIva=1  and procesado = 'Si' and estadoProcesado = 'Aceptado' group by idFactura) as d on a.idtbl_sistema_facturacion_Factura_gastos = d.idFactura
            left join 
            (SELECT  idFactura, if(tipo_doc in('01','02','04'),sum($table3.subTotal * tipoCambio),sum($table3.subTotal * tipoCambio)*-1) as iva_dos FROM $table3, $table where idtbl_sistema_facturacion_Factura_gastos = idFactura and fechaEmision between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tarifaIva=2  and procesado = 'Si' and estadoProcesado = 'Aceptado' group by idFactura) as e on a.idtbl_sistema_facturacion_Factura_gastos = e.idFactura
            left join 
            (SELECT  idFactura, if(tipo_doc in('01','02','04'),sum($table3.subTotal * tipoCambio),sum($table3.subTotal * tipoCambio)*-1) as iva_cuatro FROM $table3, $table where idtbl_sistema_facturacion_Factura_gastos = idFactura and fechaEmision between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tarifaIva=4  and procesado = 'Si' and estadoProcesado = 'Aceptado' group by idFactura) as f on a.idtbl_sistema_facturacion_Factura_gastos = f.idFactura
            left join 
            (SELECT  idFactura, if(tipo_doc in('01','02','04'),sum($table3.subTotal * tipoCambio),sum($table3.subTotal * tipoCambio)*-1) as iva_ocho FROM $table3, $table where idtbl_sistema_facturacion_Factura_gastos = idFactura and fechaEmision between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tarifaIva=8  and procesado = 'Si' and estadoProcesado = 'Aceptado' group by idFactura) as g on a.idtbl_sistema_facturacion_Factura_gastos = g.idFactura
            left join 
            (SELECT  idFactura, if(tipo_doc in('01','02','04'),sum($table3.subTotal * tipoCambio),sum($table3.subTotal * tipoCambio)*-1) as iva_trece FROM $table3, $table where idtbl_sistema_facturacion_Factura_gastos = idFactura and fechaEmision between '$fechaDesde 00:00:00' and '$FechaHasta 23:59:59' and tarifaIva=13  and procesado = 'Si' and estadoProcesado = 'Aceptado' group by idFactura) as h on a.idtbl_sistema_facturacion_Factura_gastos = h.idFactura");

        $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt;

        $stmt -> close();

        $stmt =null;

    }


    static public function MdlCargarDatosEmpresa($table, $idempresa) { 

        $stmt = Connexion::connect()->prepare("SELECT nombre_ficticio, nombre, cedula, direccion, telefono, logo from $table where idtbl_clientes = '$idempresa'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt;

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarResumenIvaFacturas($table, $table2, $idempresa, $fechaDesde, $FechaHasta) { 

        $stmt = Connexion::connect()->prepare("SELECT a.tipo,ifnull(a.exentas,0) as exentasservicios,ifnull(a.gravadas,0) as gravadasservicios,ifnull(a.iva,0) as ivaservicios,ifnull(a.total,0) as totalservicios,ifnull(b.exentas,0) as exentasbienes,ifnull(b.gravadas,0) as gravadasbienes,ifnull(b.iva,0) as ivabienes,ifnull(b.total,0) as totalbienes,ifnull(c.exentas,0) as exentasnosujetas,ifnull(c.gravadas,0) as gravadasnosujetas,ifnull(c.iva,0) as ivanosujetas,ifnull(c.total,0) as totalnosujetas   from
        (select 'EXENTO'  as Tipo, sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as exentas,0 as gravadas,0 as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=0 and estado_factura='Aceptado' and categoria='Servicio') as a
        left join
        (select 'EXENTO'  as Tipo, sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as exentas,0 as gravadas,0 as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=0 and estado_factura='Aceptado' and categoria='Bien') as b on a.tipo = b.tipo
        left join
        (select 'EXENTO'  as Tipo, sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as exentas,0 as gravadas,0 as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=0 and estado_factura='Aceptado' and categoria='No Sujeto') as c on a.tipo = c.tipo
        
        UNION
        select a.tipo,ifnull(a.exentas,0) as exentasservicios,ifnull(a.gravadas,0) as gravadasservicios,ifnull(a.iva,0) as ivaservicios,ifnull(a.total,0) as totalservicios,ifnull(b.exentas,0) as exentasbienes,ifnull(b.gravadas,0) as gravadasbienes,ifnull(b.iva,0) as ivabienes,ifnull(b.total,0) as totalbienes,ifnull(c.exentas,0) as exentasnosujetas,ifnull(c.gravadas,0) as gravadasnosujetas,ifnull(c.iva,0) as ivanosujetas,ifnull(c.total,0) as totalnosujetas   from
        (select '1%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=1 and estado_factura='Aceptado' and categoria='Servicio') as a
        left join
        (select '1%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=1 and estado_factura='Aceptado' and categoria='Bien') as b on a.tipo = b.tipo
        left join
        (select '1%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=1 and estado_factura='Aceptado' and categoria='No Sujeto') as c on a.tipo = c.tipo
        UNION
        select a.tipo,ifnull(a.exentas,0) as exentasservicios,ifnull(a.gravadas,0) as gravadasservicios,ifnull(a.iva,0) as ivaservicios,ifnull(a.total,0) as totalservicios,ifnull(b.exentas,0) as exentasbienes,ifnull(b.gravadas,0) as gravadasbienes,ifnull(b.iva,0) as ivabienes,ifnull(b.total,0) as totalbienes,ifnull(c.exentas,0) as exentasnosujetas,ifnull(c.gravadas,0) as gravadasnosujetas,ifnull(c.iva,0) as ivanosujetas,ifnull(c.total,0) as totalnosujetas   from
        (select '2%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=2 and estado_factura='Aceptado' and categoria='Servicio') as a
        left join
        (select '2%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=2 and estado_factura='Aceptado' and categoria='Bien') as b on a.tipo = b.tipo
        left join
        (select '2%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=2 and estado_factura='Aceptado' and categoria='No Sujeto') as c on a.tipo = c.tipo
        
        UNION
        select a.tipo,ifnull(a.exentas,0) as exentasservicios,ifnull(a.gravadas,0) as gravadasservicios,ifnull(a.iva,0) as ivaservicios,ifnull(a.total,0) as totalservicios,ifnull(b.exentas,0) as exentasbienes,ifnull(b.gravadas,0) as gravadasbienes,ifnull(b.iva,0) as ivabienes,ifnull(b.total,0) as totalbienes,ifnull(c.exentas,0) as exentasnosujetas,ifnull(c.gravadas,0) as gravadasnosujetas,ifnull(c.iva,0) as ivanosujetas,ifnull(c.total,0) as totalnosujetas   from
        (select '4%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=4 and estado_factura='Aceptado' and categoria='Servicio') as a
        left join
        (select '4%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=4 and estado_factura='Aceptado' and categoria='Bien') as b on a.tipo = b.tipo
        left join
        (select '4%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '2021-12-01 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=4 and estado_factura='Aceptado' and categoria='No Sujeto') as c on a.tipo = c.tipo
        
        UNION
        select a.tipo,ifnull(a.exentas,0) as exentasservicios,ifnull(a.gravadas,0) as gravadasservicios,ifnull(a.iva,0) as ivaservicios,ifnull(a.total,0) as totalservicios,ifnull(b.exentas,0) as exentasbienes,ifnull(b.gravadas,0) as gravadasbienes,ifnull(b.iva,0) as ivabienes,ifnull(b.total,0) as totalbienes,ifnull(c.exentas,0) as exentasnosujetas,ifnull(c.gravadas,0) as gravadasnosujetas,ifnull(c.iva,0) as ivanosujetas,ifnull(c.total,0) as totalnosujetas   from
        (select '8%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=8 and estado_factura='Aceptado' and categoria='Servicio') as a
        left join
        (select '8%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=8 and estado_factura='Aceptado' and categoria='Bien') as b on a.tipo = b.tipo
        left join
        (select '8%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=8 and estado_factura='Aceptado' and categoria='No Sujeto') as c on a.tipo = c.tipo
        
        UNION
        select a.tipo,ifnull(a.exentas,0) as exentasservicios,ifnull(a.gravadas,0) as gravadasservicios,ifnull(a.iva,0) as ivaservicios,ifnull(a.total,0) as totalservicios,ifnull(b.exentas,0) as exentasbienes,ifnull(b.gravadas,0) as gravadasbienes,ifnull(b.iva,0) as ivabienes,ifnull(b.total,0) as totalbienes,ifnull(c.exentas,0) as exentasnosujetas,ifnull(c.gravadas,0) as gravadasnosujetas,ifnull(c.iva,0) as ivanosujetas,ifnull(c.total,0) as totalnosujetas   from
        (select '13%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=13 and estado_factura='Aceptado' and categoria='Servicio') as a
        left join
        (select '13%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=13 and estado_factura='Aceptado' and categoria='Bien') as b on a.tipo = b.tipo
        left join
        (select '13%'  as Tipo, 0 as exentas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.subtotal*tipo_cambio)* -1,0)) as gravadas,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.impuesto*tipo_cambio)* -1,0)) as iva,sum(if(tipo_documento in('01','02','04'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio),0)) + sum(if(tipo_documento in('03'),(tbl_sistema_facturacion_detalle_facturas.total*tipo_cambio)*-1,0)) as total from empresas.tbl_sistema_facturacion_facturas,empresas.tbl_sistema_facturacion_detalle_facturas where idtbl_sistema_facturacion_facturas=id_factura and id_compania = '$idempresa'     AND fecha_factura between '$fechaDesde 00:00:01' and '$FechaHasta 23:59:59' and tasa_Impuesto=13 and estado_factura='Aceptado' and categoria='No Sujeto') as c on a.tipo = c.tipo");

        $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt;

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarResumenGastosFacturas($table, $table2, $idempresa, $Cedulaempresa, $fechaDesde, $FechaHasta) { 

        $stmt = Connexion::connect()->prepare("SELECT 
        a.tipo,
        IFNULL(a.exentas, 0) AS exentasNOSUJETAS,
        IFNULL(a.gravadas, 0) AS subtotalNOSUJETAS,
        IFNULL(a.iva, 0) AS ivaNOSUJETAS,
        IFNULL(a.total, 0) AS totalNOSUJETAS,
        IFNULL(b.exentas, 0) AS exentasSERVICIOS,
        IFNULL(b.gravadas, 0) AS subtotalSERVICIOS,
        IFNULL(b.iva, 0) AS ivaSERVICIOS,
        IFNULL(b.total, 0) AS totalSERVICIOS,
        IFNULL(c.exentas, 0) AS exentasBIENES,
        IFNULL(c.gravadas, 0) AS subtotalBIENES,
        IFNULL(c.iva, 0) AS ivaBIENES,
        IFNULL(c.total, 0) AS totalBIENES
    FROM
        (SELECT 
            'EXENTO' AS Tipo,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS exentas,
                0 AS gravadas,
                0 AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='NO SUJETAS'
                AND  tarifaIva = 0) AS a
                LEFT JOIN
                 (SELECT 
            'EXENTO' AS Tipo,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS exentas,
                0 AS gravadas,
                0 AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='SERVICIOS'
                AND  tarifaIva = 0) AS b ON a.tipo=b.tipo
                 LEFT JOIN
                 (SELECT 
            'EXENTO' AS Tipo,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS exentas,
                0 AS gravadas,
                0 AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='BIENES'
                AND  tarifaIva = 0) AS c ON c.tipo=b.tipo
    UNION SELECT 
         a.tipo,
        IFNULL(a.exentas, 0) AS exentasNOSUJETAS,
        IFNULL(a.gravadas, 0) AS subtotalNOSUJETAS,
        IFNULL(a.iva, 0) AS ivaNOSUJETAS,
        IFNULL(a.total, 0) AS totalNOSUJETAS,
        IFNULL(b.exentas, 0) AS exentasSERVICIOS,
        IFNULL(b.gravadas, 0) AS subtotalSERVICIOS,
        IFNULL(b.iva, 0) AS ivaSERVICIOS,
        IFNULL(b.total, 0) AS totalSERVICIOS,
        IFNULL(c.exentas, 0) AS exentasBIENES,
        IFNULL(c.gravadas, 0) AS subtotalBIENES,
        IFNULL(c.iva, 0) AS ivaBIENES,
        IFNULL(c.total, 0) AS totalBIENES
    FROM
        (SELECT 
            '1%' AS Tipo,
                0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
           idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='NO SUJETAS'
                AND  tarifaIva = 1) AS a
                LEFT JOIN
                 (SELECT 
            '1%' AS Tipo,
               0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='SERVICIOS'
                AND  tarifaIva = 1) AS b ON a.tipo=b.tipo
                 LEFT JOIN
                 (SELECT 
            '1%' AS Tipo,
               0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
       FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='BIENES'
                AND  tarifaIva = 1) AS c ON c.tipo=b.tipo
    UNION SELECT 
        a.tipo,
        IFNULL(a.exentas, 0) AS exentasNOSUJETAS,
        IFNULL(a.gravadas, 0) AS subtotalNOSUJETAS,
        IFNULL(a.iva, 0) AS ivaNOSUJETAS,
        IFNULL(a.total, 0) AS totalNOSUJETAS,
        IFNULL(b.exentas, 0) AS exentasSERVICIOS,
        IFNULL(b.gravadas, 0) AS subtotalSERVICIOS,
        IFNULL(b.iva, 0) AS ivaSERVICIOS,
        IFNULL(b.total, 0) AS totalSERVICIOS,
        IFNULL(c.exentas, 0) AS exentasBIENES,
        IFNULL(c.gravadas, 0) AS subtotalBIENES,
        IFNULL(c.iva, 0) AS ivaBIENES,
        IFNULL(c.total, 0) AS totalBIENES
    FROM
        (SELECT 
            '2%' AS Tipo,
                0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
          idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='NO SUJETAS'
                AND  tarifaIva = 2) AS a
                LEFT JOIN
                 (SELECT 
            '2%' AS Tipo,
               0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='SERVICIOS'
                AND  tarifaIva = 2) AS b ON a.tipo=b.tipo
                 LEFT JOIN
                 (SELECT 
            '2%' AS Tipo,
               0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
       FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='BIENES'
                AND  tarifaIva = 2) AS c ON c.tipo=b.tipo
    UNION SELECT 
        a.tipo,
        IFNULL(a.exentas, 0) AS exentasNOSUJETAS,
        IFNULL(a.gravadas, 0) AS subtotalNOSUJETAS,
        IFNULL(a.iva, 0) AS ivaNOSUJETAS,
        IFNULL(a.total, 0) AS totalNOSUJETAS,
        IFNULL(b.exentas, 0) AS exentasSERVICIOS,
        IFNULL(b.gravadas, 0) AS subtotalSERVICIOS,
        IFNULL(b.iva, 0) AS ivaSERVICIOS,
        IFNULL(b.total, 0) AS totalSERVICIOS,
        IFNULL(c.exentas, 0) AS exentasBIENES,
        IFNULL(c.gravadas, 0) AS subtotalBIENES,
        IFNULL(c.iva, 0) AS ivaBIENES,
        IFNULL(c.total, 0) AS totalBIENES
    FROM
        (SELECT 
            '4%' AS Tipo,
                0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
      idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='NO SUJETAS'
                AND  tarifaIva = 4) AS a
                LEFT JOIN
                 (SELECT 
            '4%' AS Tipo,
               0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='SERVICIOS'
                AND  tarifaIva = 4) AS b ON a.tipo=b.tipo
                 LEFT JOIN
                 (SELECT 
            '4%' AS Tipo,
             0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
          FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='BIENES'
                AND  tarifaIva = 4) AS c ON c.tipo=b.tipo
                
    UNION SELECT 
        a.tipo,
        IFNULL(a.exentas, 0) AS exentasNOSUJETAS,
        IFNULL(a.gravadas, 0) AS subtotalNOSUJETAS,
        IFNULL(a.iva, 0) AS ivaNOSUJETAS,
        IFNULL(a.total, 0) AS totalNOSUJETAS,
        IFNULL(b.exentas, 0) AS exentasSERVICIOS,
        IFNULL(b.gravadas, 0) AS subtotalSERVICIOS,
        IFNULL(b.iva, 0) AS ivaSERVICIOS,
        IFNULL(b.total, 0) AS totalSERVICIOS,
        IFNULL(c.exentas, 0) AS exentasBIENES,
        IFNULL(c.gravadas, 0) AS subtotalBIENES,
        IFNULL(c.iva, 0) AS ivaBIENES,
        IFNULL(c.total, 0) AS totalBIENES
    FROM
        (SELECT 
            '8%' AS Tipo,
                0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
       idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='NO SUJETAS'
                AND  tarifaIva = 8) AS a
                LEFT JOIN
                 (SELECT 
            '8%' AS Tipo,
             0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
         FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='SERVICIOS'
                AND  tarifaIva = 8) AS b ON a.tipo=b.tipo 
                 LEFT JOIN
                 (SELECT 
            '8%' AS Tipo,
         0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
          FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='BIENES'
                AND  tarifaIva = 8) AS c ON c.tipo=b.tipo
    UNION SELECT 
        a.tipo,
        IFNULL(a.exentas, 0) AS exentasNOSUJETAS,
        IFNULL(a.gravadas, 0) AS subtotalNOSUJETAS,
        IFNULL(a.iva, 0) AS ivaNOSUJETAS,
        IFNULL(a.total, 0) AS totalNOSUJETAS,
        IFNULL(b.exentas, 0) AS exentasSERVICIOS,
        IFNULL(b.gravadas, 0) AS subtotalSERVICIOS,
        IFNULL(b.iva, 0) AS ivaSERVICIOS,
        IFNULL(b.total, 0) AS totalSERVICIOS,
        IFNULL(c.exentas, 0) AS exentasBIENES,
        IFNULL(c.gravadas, 0) AS subtotalBIENES,
        IFNULL(c.iva, 0) AS ivaBIENES,
        IFNULL(c.total, 0) AS totalBIENES
    FROM
        (SELECT 
            '13%' AS Tipo,
                0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'),(tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
        FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
    idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='NO SUJETAS'
                AND  tarifaIva = 13) AS a
                LEFT JOIN
                 (SELECT 
            '13%' AS Tipo,
          0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
           FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='SERVICIOS'
                AND  tarifaIva = 13) AS b ON a.tipo=b.tipo
                LEFT JOIN
                 (SELECT 
            '13%' AS Tipo,
             0 AS exentas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.subTotal*tipoCambio) * - 1, 0)) AS gravadas,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.iva*tipoCambio) * - 1, 0)) AS iva,
                SUM(IF( tipo_doc IN ('01' , '02', '04', '08'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio), 0)) + SUM(IF( tipo_doc IN ('03'), (tbl_sistema_facturacion_detalle_Factura_gastos.total*tipoCambio) * - 1, 0)) AS total
       FROM
            empresas.tbl_sistema_facturacion_Factura_gastos, empresas.tbl_sistema_facturacion_detalle_Factura_gastos
        WHERE
            idtbl_sistema_facturacion_Factura_gastos = idFactura
                AND cedulaReceptor = '$Cedulaempresa'
                AND procesado = 'Si'
                AND estadoProcesado LIKE 'Acept%'
                AND fechaEmision BETWEEN '$fechaDesde 00:00:01' AND '$FechaHasta 23:59:59' and categoria='BIENES'
                AND  tarifaIva = 13) AS c ON c.tipo=b.tipo");

        $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt;

        $stmt -> close();

        $stmt =null;

    }


}