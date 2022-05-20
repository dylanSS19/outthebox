<?php
 
class ReportPedidosController{


	static public function ctrCargarFacturas($IDempresa, $StarDate, $EndDate, $ruta){

        $table = "empresas.tbl_factura"; 	

         $response = ReportPedidosModel::MdlCargarFacturas($table, $IDempresa, $StarDate, $EndDate, $ruta);	

         return $response;

    }


	static public function ctrCargarDetalleFacturas($IDfactura){

        $table = "empresas.tbl_detalle_factura"; 	

         $response = ReportPedidosModel::MdlCargarDetalleFacturas($table, $IDfactura);	

         return $response;

    }

}