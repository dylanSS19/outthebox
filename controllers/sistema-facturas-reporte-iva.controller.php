<?php

class ReporteIvaController{

    static public function ctrCargarIva($idempresa, $fechaDesde, $FechaHasta){

       $table = "empresas.tbl_sistema_facturacion_facturas"; 	
       $table2 = "empresas.tbl_sucursal_".$idempresa;
       $table3 = "empresas.tbl_sistema_facturacion_detalle_facturas";

		$response = ReporteIvaModel::MdlCargarIva($table, $table2, $table3, $idempresa, $fechaDesde, $FechaHasta);		

		return $response;

	}

    static public function ctrCargarCompras($idempresa, $fechaDesde, $FechaHasta){

        $table = "empresas.tbl_sistema_facturacion_Factura_gastos"; 	
        $table2 = "empresas.tbl_clientes";
        $table3 = "empresas.tbl_sistema_facturacion_detalle_Factura_gastos";
 
         $response = ReporteIvaModel::MdlCargarCompras($table, $table2, $table3, $idempresa, $fechaDesde, $FechaHasta);		
 
         return $response;
 
     }

     static public function ctrCargarDatosEmpresa($idempresa){

        $table = "empresas.tbl_clientes"; 	

         $response = ReporteIvaModel::MdlCargarDatosEmpresa($table, $idempresa);		
 
         return $response;
 
     }

     static public function ctrCargarResumenIvaFacturas($idempresa, $fechaDesde, $FechaHasta){

        $table = "empresas.tbl_sistema_facturacion_facturas"; 	
        $table2 = "empresas.tbl_sistema_facturacion_detalle_facturas";
 
         $response = ReporteIvaModel::MdlCargarResumenIvaFacturas($table, $table2, $idempresa, $fechaDesde, $FechaHasta);		
 
         return $response;
 
     }

     static public function ctrCargarResumenGastosFacturas($idempresa, $Cedulaempresa, $fechaDesde, $FechaHasta){

        $table = "empresas.tbl_sistema_facturacion_Factura_gastos"; 	
        $table2 = "empresas.tbl_sistema_facturacion_detalle_Factura_gastos";
 
         $response = ReporteIvaModel::MdlCargarResumenGastosFacturas($table, $table2, $idempresa, $Cedulaempresa, $fechaDesde, $FechaHasta);		
 
         return $response;
 
     }

}