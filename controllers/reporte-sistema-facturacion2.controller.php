<?php



class ReporteFacturasController{

	/*=============================================
	=        CARGAR FACTURAS             =
	=============================================*/

		static public function ctrCargarFacturas($id_empresa, $fechaDesde, $fechaHasta, $consecutivo, $cedula, $estado, $tipoDoc){

	       $table = "empresas.tbl_sistema_facturacion_facturas"; 

	      
			$response = ReporteFacturasModel::MdlCargarFacturas($table, $id_empresa, $fechaDesde, $fechaHasta, $consecutivo, $cedula, $estado, $tipoDoc);	

			return $response;

		} 
 
	/*=============================================
	=        CARGAR EMPRESAS X USUARIO             =
	=============================================*/

		static public function ctrCargarEmpresasUsuarios($idusuario){

	       $table = "empresas.tbl_empresas_usuarios"; 	
	      
			$response = ReporteFacturasModel::MdlCargarEmpresasUsuarios($table, $idusuario);	

			return $response;

		} 


	/*=============================================
	=        CARGAR DETALLE FACTURAS             =
	=============================================*/

		static public function ctrDetalleFactura($idFactura){

	       $table = "empresas.tbl_sistema_facturacion_detalle_facturas"; 	
	      
			$response = ReporteFacturasModel::MdlDetalleFactura($table, $idFactura);	

			return $response;

		} 




			/*=============================================
	=        CARGAR DETALLE FACTURAS             =
	=============================================*/

		static public function ctrCargarFacturaXid($idFactura){

			$table = "empresas.tbl_sistema_facturacion_facturas"; 

			$response = ReporteFacturasModel::MdlCargarFacturaXid($table, $idFactura);	

			return $response;

		} 



	/*=============================================
	=        CARGAR  FACTURAS             =
	=============================================*/

		static public function ctrFactura($idFactura){

	       $table = "empresas.tbl_sistema_facturacion_facturas"; 	
	      
			$response = ReporteFacturasModel::MdlFactura($table, $idFactura);	

			return $response;

		} 


}