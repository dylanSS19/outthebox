<?php
 
class emitirFacturasFactController{


	static public function ctrCargarDetalleFactura($idFactura){

     $table = 'empresas.tbl_facturacion_emitir_facturas_detalle';

     $response = emitirFacturasFactModel::MdlCargarDetalleFactura($table, $idFactura);		

     return $response;

    }

    static public function ctrCargarFactura($idFactura){

        $table = 'empresas.tbl_facturacion_emitir_facturas';
   
        $response = emitirFacturasFactModel::MdlCargarFactura($table, $idFactura);		
   
        return $response;
   
       }

       static public function ctrModificarDatosFactura($conse, $clave, $estado, $idfact){

        $table = 'empresas.tbl_facturacion_emitir_facturas';
   
        $response = emitirFacturasFactModel::MdlModificarDatosFactura($table, $conse, $clave, $estado, $idfact);		
   
        return $response;
   
       }

}