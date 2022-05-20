<?php

 
 
class CrearFactController{


    static public function ctrCargarPrecioProductos($empresa, $listPrecio, $listTope){

       $table = "empresas.tbl_productos";    
       $table2 = "empresas.tbl_precios_equipos"; 
       $table3 = "empresas.tbl_impuestos";    
       $table4 = "empresas.tbl_tarifa_impuestos"; 
       $table5 = " empresas.tbl_unidades_medida_hacienda"; 

        $response = CrearFactModel::MdlCargarPrecioProductos($table, $table2, $table3, $table4, $table5, $empresa, $listPrecio, $listTope); 

        return $response;


    }  

    static public function ctrCargarPrecioProductosXid( $listPrecio, $listTope, $IdProd){

        $table = "empresas.tbl_productos";    
        $table2 = "empresas.tbl_precios_equipos"; 
        $table3 = "empresas.tbl_impuestos";    
        $table4 = "empresas.tbl_tarifa_impuestos"; 
        $table5 = " empresas.tbl_unidades_medida_hacienda"; 
       
         $response = CrearFactModel::MdlCargarPrecioProductosXid($table, $table2, $table3, $table4, $table5, $listPrecio, $listTope, $IdProd); 
 
         return $response;
 
 
     } 


     static public function ctrCargarListaPrecios($id_empresa){

        $table = "empresas.tbl_listas_precio";    

         $response = CrearFactModel::MdlCargarListaPrecios($table, $id_empresa); 
 
         return $response;
 
     } 

     static public function ctrCargarClientes($id_empresa){

        $table = "empresas.tbl_clientes";    

         $response = CrearFactModel::MdlCargarClientes($table, $id_empresa); 
 
         return $response;
 
     } 

     static public function ctrCargarDatosClientes($id_cliente){

        $table = "empresas.tbl_clientes";    

         $response = CrearFactModel::MdlCargarDatosClientes($table, $id_cliente); 
 
         return $response;
 
     } 

     static public function ctrCargarRutas($usuario, $Idempresa){

        $table = "empresas.tbl_rutas";    

         $response = CrearFactModel::MdlCargarCargarRutas($table, $usuario, $Idempresa); 
 
         return $response;
 
     } 

     static public function ctrCargarBodega($idBodega){

        $table = "empresas.tbl_bodegas";    

         $response = CrearFactModel::MdlCargarCargarBodega($table, $idBodega); 
 
         return $response;
 
     } 

     static public function ctrCargarInvetarioStock($bodega_ID, $producto){

        $table = "empresas.tbl_inventario";    

         $response = CrearFactModel::MdlCargarInvetarioStock($table, $bodega_ID, $producto); 
 
         return $response;
 
     } 

     static public function ctrCargarProductosCel($Lprecio, $Ltope){

        $table = "empresas.tbl_productos";    
        $table2 = "empresas.tbl_precios_equipos"; 
        $table3 = "empresas.tbl_impuestos";    
        $table4 = "empresas.tbl_tarifa_impuestos"; 
        $table5 = " empresas.tbl_unidades_medida_hacienda";   

         $response = CrearFactModel::MdlCargarProductosCel($table, $table2, $table3, $table4, $table5, $Lprecio, $Ltope); 
 
         return $response;
 
     } 
     
     static public function ctrInsertFactura($fecha, $tipo_pago, $tipo_documento, $cedula, $nombre, $correo, $direccion, $telefono, $usuario, $estado, $numero_consecutivo, $clave, $estado_hacienda, $id_empresa, $ruta, $tipo, $fecha_emision){

        $table = "empresas.tbl_factura";    


         $response = CrearFactModel::MdlInsertFactura($table, $fecha, $tipo_pago, $tipo_documento, $cedula, $nombre, $correo, $direccion, $telefono, $usuario, $estado, $numero_consecutivo, $clave, $estado_hacienda, $id_empresa, $ruta, $tipo, $fecha_emision); 
 
         return $response;
 
     } 

     static public function ctrInsertDetalleFactura($id_factura, $descripcion, $cantidad, $precio_unitario, $descuento, $descuento_aplicado, $impuesto, $total, $tasa_cambio, $cabys, $sku){

        $table = "empresas.tbl_detalle_factura";    


         $response = CrearFactModel::MdlInsertDetalleFactura($table, $id_factura, $descripcion, $cantidad, $precio_unitario, $descuento, $descuento_aplicado, $impuesto, $total, $tasa_cambio, $cabys, $sku); 
 
         return $response;
 
     } 
 
 
     static public function ctrModificarTotalesFactura($EditarFactId, $Editarsubtotal, $Editartotal, $Editartotal_iva, $Editardescuento){

        $table = "empresas.tbl_factura";    


         $response = CrearFactModel::MdlModificarTotalesFactura($table, $EditarFactId, $Editarsubtotal, $Editartotal, $Editartotal_iva, $Editardescuento); 
 
         return $response;
 
     } 

     static public function ctrCargarUltimoStock($bodegaStock, $skuProd){

        $table = "empresas.tbl_inventario";    


         $response = CrearFactModel::MdlCargarUltimoStock($table, $bodegaStock, $skuProd); 
 
         return $response;
 
     } 


     static public function ctrCargarEstadoCredito($cedulaProveedor, $idEmpresa){

        $table = "empresas.tbl_cuentas_cobrar";    

         $response = CrearFactModel::MdlCargarEstadoCredito($table, $cedulaProveedor, $idEmpresa); 
 
         return $response;
 
     } 

     static public function ctrInsertFacCredito($consecutivo, $clave_Hacienda, $fechaFac, $tipo_Factura, $ced_proveedor, $comentario, $monto_exento, $monto_base, $porcentaje_iva, $iva, $descuentoFac, $totalFac, $dias_credito, $fecha_vencimiento, $usuarioFac, $saldo, $estadoFac, $factura, $empresa){

        $table = "empresas.tbl_cuentas_cobrar";    

         $response = CrearFactModel::MdlInsertFacCredito($table, $consecutivo, $clave_Hacienda, $fechaFac, $tipo_Factura, $ced_proveedor, $comentario, $monto_exento, $monto_base, $porcentaje_iva, $iva, $descuentoFac, $totalFac, $dias_credito, $fecha_vencimiento, $usuarioFac, $saldo, $estadoFac, $factura, $empresa); 
 
         return $response;
 
     } 
     
     static public function ctrInsertMovimientoInventario($idFacturaMov, $consecutivoMov, $tipo_movimientoMov, $codigoMov, $productoMov, $stockMov, $cantidadMov, $costo_promedioMov, $origenMov, $destinoMov, $usuarioMov, $estadoMov, $comentarioMov, $bodegaMov, $totalMov , $fecha_ingresoMov){

        $table = "empresas.tbl_inventario";    

         $response = CrearFactModel::MdlInsertMovimientoInventario($table, $idFacturaMov, $consecutivoMov, $tipo_movimientoMov, $codigoMov, $productoMov, $stockMov, $cantidadMov, $costo_promedioMov, $origenMov, $destinoMov, $usuarioMov, $estadoMov, $comentarioMov, $bodegaMov, $totalMov , $fecha_ingresoMov); 
 
         return $response;
 
     } 

     static public function ctrCargarSucursal($empresaSucursal){

        $table = "empresas.tbl_sucursal_".$empresaSucursal;    
        $table2 = "empresas.tbl_cajas_".$empresaSucursal;  

         $response = CrearFactModel::MdlCargarSucursal($table, $table2); 
 
         return $response;
 
     } 
     
     
}