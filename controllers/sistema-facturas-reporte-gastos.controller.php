<?php

class ReporteGastosController{

    static public function ctrCargarGastos($idempresa, $fechaDesde, $FechaHasta){

       $table = "empresas.tbl_sistema_facturacion_Factura_gastos"; 	
       $table2 = "empresas.tbl_clientes";

		$response = ReporteGastosModel::MdlCargarGastos($table, $table2, $idempresa, $fechaDesde, $FechaHasta);		

		return $response;

	}

    static public function ctrCargarGastosDetalle($DetalleFac){

        $table = "empresas.tbl_sistema_facturacion_detalle_Factura_gastos"; 	

 
         $response = ReporteGastosModel::MdlCargarGastosDetalle($table, $DetalleFac);		
 
         return $response;
 
     }

    static public function ctrCargarDatosFacturaGasto($idFactura){

        $table = "empresas.tbl_sistema_facturacion_Factura_gastos"; 	

         $response = ReporteGastosModel::MdlCargarDatosFacturaGasto($table, $idFactura);		
 
         return $response;
 
     }


     static public function ctrCargarDatosFactura($idFactura){

        $table = "empresas.tbl_sistema_facturacion_Factura_gastos"; 	
        $table2 = "empresas.tbl_clientes";

         $response = ReporteGastosModel::MdlCargarDatosFactura($table, $table2, $idFactura);		
 
         return $response;
 
     }

}