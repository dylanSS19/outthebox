<?php

require_once "connexion.php";

class CrearFactModel{


    static public function MdlCargarPrecioProductos($table, $table2, $table3, $table4, $table5, $empresa, $listPrecio, $listTope) {
        
        $stmt = Connexion::connect()->prepare("SELECT 
        a.idtbl_equipos,
        a.sku,
        a.nombre,
        a.cabys,
        c.codigo_impuesto,
        d.codigo_tarifa,
        d.tarifa_iva,
        e.unidad as unidad_medida,
        b.$listPrecio as precio_unidad,
        b.$listTope as tope_descuento
    FROM
            $table a
            INNER JOIN
            $table2 b ON a.idtbl_equipos = b.id_producto
            INNER JOIN
            $table3 c ON a.impuestos = c.codigo_impuesto
            INNER JOIN
            $table4 d ON a.tarifa_iva = d.codigo_tarifa
            INNER JOIN 
            $table5 e ON a.unidad_medida = e.idtbl_unidades_medida_hacienda
    where   a.id_empresa = '$empresa'");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
    }

    static public function MdlCargarPrecioProductosXid($table, $table2, $table3, $table4,  $table5, $listPrecio, $listTope, $IdProd) {
        
        $stmt = Connexion::connect()->prepare("SELECT 
        a.idtbl_equipos,
        a.sku,
        a.nombre,
        a.cabys,
        c.codigo_impuesto,
        d.codigo_tarifa,
        d.tarifa_iva,
        e.unidad as unidad_medida,
        b.$listPrecio as precio_unidad,
        b.$listTope as tope_descuento
    FROM
            $table a
            INNER JOIN
            $table2 b ON a.idtbl_equipos = b.id_producto
            INNER JOIN
            $table3 c ON a.impuestos = c.codigo_impuesto
            INNER JOIN
            $table4 d ON a.tarifa_iva = d.codigo_tarifa
            INNER JOIN 
            $table5 e ON a.unidad_medida = e.idtbl_unidades_medida_hacienda
    where    a.idtbl_equipos = '$IdProd'");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
    }


    static public function MdlCargarListaPrecios($table, $id_empresa) {
        
        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where idempresa = '$id_empresa'");
        
        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
    }

    
    static public function MdlCargarClientes($table, $id_empresa) {
        
        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_empresa = '$id_empresa'");
        
        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
    }


    static public function MdlCargarDatosClientes($table, $id_cliente) {
        
        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_clientes = '$id_cliente'");
        
        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
    }
    

    
    static public function MdlCargarCargarRutas($table, $usuario, $Idempresa) {
        
        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where usuario like '$usuario' and id_empresa = '$Idempresa'");
        
        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
    }

    static public function MdlCargarCargarBodega($table, $idBodega) {
        
        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where idtbl_bodegas = '$idBodega'");
        
        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
    }


    static public function MdlCargarInvetarioStock($table,  $bodega_ID, $producto) {
        
        $stmt = Connexion::connect()->prepare("SELECT total , stock FROM $table where bodega = '$bodega_ID' AND codigo = '$producto'  order by idtbl_inventario desc limit 1");
        
        $stmt -> execute();

        return $stmt -> fetchAll();

        // return $stmt;

        $stmt -> close();

        $stmt =null;
    }


    static public function MdlCargarProductosCel($table, $table2, $table3, $table4,  $table5, $Lprecio, $Ltope) {
        
        $stmt = Connexion::connect()->prepare("SELECT 
        a.idtbl_equipos,
        a.sku,
        a.nombre,
        a.cabys,
        c.codigo_impuesto,
        d.codigo_tarifa,
        d.tarifa_iva,
        e.descripcion as unidad_medida,
        b.$Lprecio as precio_unidad,
        b.$Ltope as tope_descuento
    FROM
            $table a
            INNER JOIN
            $table2 b ON a.idtbl_equipos = b.id_producto
            INNER JOIN
            $table3 c ON a.impuestos = c.codigo_impuesto
            INNER JOIN
            $table4 d ON a.tarifa_iva = d.codigo_tarifa
            INNER JOIN 
            $table5 e ON a.unidad_medida = e.idtbl_unidades_medida_hacienda");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
    }


    static public function MdlInsertFactura($table, $fecha, $tipo_pago, $tipo_documento, $cedula, $nombre, $correo, $direccion, $telefono, $usuario, $estado, $numero_consecutivo, $clave, $estado_hacienda, $id_empresa, $ruta, $tipo, $fecha_emision) {

        $db = Connexion::connect();

		$stmt = $db->prepare("INSERT INTO $table(fecha, tipo_pago, tipo_documento, cedula, nombre, correo, telefono, direccion, usuario, estado, numero_consecutivo, clave, estado_hacienda, id_empresa, ruta, tipo, fecha_emision) VALUES (:fecha, :tipo_pago, :tipo_documento, :cedula, :nombre, :correo, :telefono, :direccion, :usuario, :estado, :numero_consecutivo, :clave, :estado_hacienda, :id_empresa, :ruta, :tipo, :fecha_emision)");

		$stmt->bindParam(":fecha",$fecha, PDO::PARAM_STR);
		$stmt->bindParam(":tipo_pago",$tipo_pago, PDO::PARAM_STR);
		$stmt->bindParam(":tipo_documento",$tipo_documento, PDO::PARAM_STR);
        $stmt->bindParam(":cedula",$cedula, PDO::PARAM_STR);
		$stmt->bindParam(":nombre",$nombre, PDO::PARAM_STR);
		$stmt->bindParam(":correo",$correo, PDO::PARAM_STR);
        $stmt->bindParam(":telefono",$telefono, PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$direccion, PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$usuario, PDO::PARAM_STR);
		$stmt->bindParam(":estado",$estado, PDO::PARAM_STR);
		$stmt->bindParam(":numero_consecutivo",$numero_consecutivo, PDO::PARAM_STR);
        $stmt->bindParam(":clave",$clave, PDO::PARAM_STR);
		$stmt->bindParam(":estado_hacienda",$estado_hacienda, PDO::PARAM_STR);
		$stmt->bindParam(":id_empresa",$id_empresa, PDO::PARAM_STR);
		$stmt->bindParam(":ruta",$ruta, PDO::PARAM_STR);
		$stmt->bindParam(":tipo",$tipo, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_emision",$fecha_emision, PDO::PARAM_STR);


		if($stmt->execute()){

			return $db->lastInsertId();
		}else{
     
            return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


}


static public function MdlInsertDetalleFactura($table, $id_factura, $descripcion, $cantidad, $precio_unitario, $descuento, $descuento_aplicado, $impuesto, $total, $tasa_cambio, $cabys, $sku) {

    $db = Connexion::connect();

    $stmt = $db->prepare("INSERT INTO $table (id_factura, descripcion, cantidad, precio_unitario, descuento, descuento_aplicado, impuesto, total, tasa_cambio, cabys, sku) VALUES (:id_factura, :descripcion, :cantidad, :precio_unitario, :descuento, :descuento_aplicado, :impuesto, :total, :tasa_cambio, :cabys, :sku)");

    $stmt->bindParam(":id_factura",$id_factura, PDO::PARAM_STR);
    $stmt->bindParam(":descripcion",$descripcion, PDO::PARAM_STR);
    $stmt->bindParam(":cantidad",$cantidad, PDO::PARAM_STR);
    $stmt->bindParam(":precio_unitario",$precio_unitario, PDO::PARAM_STR);
    $stmt->bindParam(":descuento",$descuento, PDO::PARAM_STR);
    $stmt->bindParam(":descuento_aplicado",$descuento_aplicado, PDO::PARAM_STR);
    $stmt->bindParam(":impuesto",$impuesto, PDO::PARAM_STR);
    $stmt->bindParam(":total",$total, PDO::PARAM_STR);
    $stmt->bindParam(":tasa_cambio",$tasa_cambio, PDO::PARAM_STR);
    $stmt->bindParam(":cabys",$cabys, PDO::PARAM_STR);
    $stmt->bindParam(":sku",$sku, PDO::PARAM_STR);
    


    if($stmt->execute()){

        return "ok";
    }else{
 
        return $stmt->errorInfo()[2];
    }

    $stmt -> close();

    $stmt =null;


}


    static public function MdlModificarTotalesFactura($table, $EditarFactId, $Editarsubtotal, $Editartotal, $Editartotal_iva, $Editardescuento) { 

        $stmt = Connexion::connect()->prepare("UPDATE $table SET subtotal ='$Editarsubtotal', total ='$Editartotal', total_iva ='$Editartotal_iva', descuento ='$Editardescuento'  WHERE idtbl_factura = '$EditarFactId'");

        
    if($stmt->execute()){

        return "ok";
    }

    else{

        return $stmt->errorInfo()[2];
    }

    $stmt -> close();

    $stmt =null;

    }

    

    static public function MdlCargarUltimoStock($table, $bodegaStock , $skuProd) {
        
        $stmt = Connexion::connect()->prepare("SELECT stock, total FROM $table where codigo = '$skuProd' and bodega = '$bodegaStock' order by idtbl_inventario desc limit 1");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
    }


    static public function MdlCargarEstadoCredito($table, $cedulaProveedor, $idEmpresa) {
        
        $stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
            SELECT *
            FROM $table
            WHERE cedula_proveedor = '$cedulaProveedor' AND id_empresa = '$idEmpresa' and estado = 'Pendiente'), 1, 0)");
        
        $stmt -> execute();

        // return $stmt;

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
    }

    static public function MdlInsertFacCredito($table, $consecutivo, $clave_Hacienda, $fechaFac, $tipo_Factura, $ced_proveedor, $comentario, $monto_exento, $monto_base, $porcentaje_iva, $iva, $descuentoFac, $totalFac, $dias_credito, $fecha_vencimiento, $usuarioFac, $saldo, $estadoFac, $factura, $empresa) {

        $db = Connexion::connect();
    
        $stmt = $db->prepare("INSERT INTO $table (numero_consecutivo, clave, tipo_documento, fecha, cedula_proveedor, descripcion, monto_exento, monto_base, porcentaje_iva, iva, descuento, total, dias_credito, fecha_vencimiento, usuario, saldo, estado, id_factura, id_empresa) VALUES (:numero_consecutivo, :clave, :tipo_documento, :fecha, :cedula_proveedor, :descripcion, :monto_exento, :monto_base, :porcentaje_iva, :iva, :descuento, :total, :dias_credito, :fecha_vencimiento, :usuario, :saldo, :estado, :id_factura, :id_empresa)");
    
        $stmt->bindParam(":numero_consecutivo",$consecutivo, PDO::PARAM_STR);
        $stmt->bindParam(":clave",$clave_Hacienda, PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento",$tipo_Factura, PDO::PARAM_STR);
        $stmt->bindParam(":fecha",$fechaFac, PDO::PARAM_STR);
        $stmt->bindParam(":cedula_proveedor",$ced_proveedor, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion",$comentario, PDO::PARAM_STR);
        $stmt->bindParam(":monto_exento",$monto_exento, PDO::PARAM_STR);
        $stmt->bindParam(":monto_base",$monto_base, PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje_iva",$porcentaje_iva, PDO::PARAM_STR);
        $stmt->bindParam(":iva",$iva, PDO::PARAM_STR);
        $stmt->bindParam(":descuento",$descuentoFac, PDO::PARAM_STR);
        $stmt->bindParam(":total",$totalFac, PDO::PARAM_STR);
        $stmt->bindParam(":dias_credito",$dias_credito, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento",$fecha_vencimiento, PDO::PARAM_STR);
        $stmt->bindParam(":usuario",$usuarioFac, PDO::PARAM_STR);
        $stmt->bindParam(":saldo",$saldo, PDO::PARAM_STR);
        $stmt->bindParam(":estado",$estadoFac, PDO::PARAM_STR);
        $stmt->bindParam(":id_factura",$factura, PDO::PARAM_STR);
        $stmt->bindParam(":id_empresa",$empresa, PDO::PARAM_STR);

        if($stmt->execute()){
    
            return "ok";
        }else{
     
            return $stmt->errorInfo()[2];
        }
    
        $stmt -> close();
    
        $stmt =null;
    
    
    }

    static public function MdlInsertMovimientoInventario($table, $idFacturaMov, $consecutivoMov, $tipo_movimientoMov, $codigoMov, $productoMov, $stockMov, $cantidadMov, $costo_promedioMov, $origenMov, $destinoMov, $usuarioMov, $estadoMov, $comentarioMov, $bodegaMov, $totalMov , $fecha_ingresoMov) {

        $db = Connexion::connect();

		$stmt = $db->prepare("INSERT INTO $table(movimiento_numero, consecutivo, tipo_movimiento, codigo, producto, stock, cantidad, costo_promedio, origen, destino, total, fecha_ingreso, usuario, estado, comentario, bodega) VALUES (:movimiento_numero, :consecutivo, :tipo_movimiento, :codigo, :producto, :stock, :cantidad, :costo_promedio, :origen, :destino, :total, :fecha_ingreso, :usuario, :estado, :comentario, :bodega)");

		$stmt->bindParam(":movimiento_numero",$idFacturaMov, PDO::PARAM_STR);
		$stmt->bindParam(":consecutivo",$consecutivoMov, PDO::PARAM_STR);
		$stmt->bindParam(":tipo_movimiento",$tipo_movimientoMov, PDO::PARAM_STR);
        $stmt->bindParam(":codigo",$codigoMov, PDO::PARAM_STR);
		$stmt->bindParam(":producto",$productoMov, PDO::PARAM_STR);
		$stmt->bindParam(":stock",$stockMov, PDO::PARAM_STR);
        $stmt->bindParam(":cantidad",$cantidadMov, PDO::PARAM_STR);
		$stmt->bindParam(":costo_promedio",$costo_promedioMov, PDO::PARAM_STR);
		$stmt->bindParam(":origen",$origenMov, PDO::PARAM_STR);
		$stmt->bindParam(":destino",$destinoMov, PDO::PARAM_STR);
		$stmt->bindParam(":total",$totalMov, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ingreso",$fecha_ingresoMov, PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$usuarioMov, PDO::PARAM_STR);
		$stmt->bindParam(":estado",$estadoMov, PDO::PARAM_STR);
		$stmt->bindParam(":comentario",$comentarioMov, PDO::PARAM_STR);
		$stmt->bindParam(":bodega",$bodegaMov, PDO::PARAM_STR);
   
		if($stmt->execute()){

			return $db->lastInsertId();
		}else{
     
            return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


}

static public function MdlCargarSucursal($table, $table2) {
        
    $stmt = Connexion::connect()->prepare("SELECT a.idsucursal as Sucursal, idcaja as Caja FROM $table a inner join $table2 b on a.idtbl_sucursal = b.idsucursal where a.nombre = 'Empresarial'");
    
    $stmt -> execute();

    // return $stmt;

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt =null;
}



}