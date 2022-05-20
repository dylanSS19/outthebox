<?php
 
class EmisionFacturasController{


	static public function ctrCargarFacturas($data){

        $table = "empresas.tbl_facturacion_emitir_facturas"; 	

         $response = EmisionFacturasModel::MdlCargarFacturas($table, $data);	

         return $response;

    }

 
	static public function CargarFacturasXruta($data){

        $table = "empresas.tbl_facturacion_emitir_facturas"; 	

         $response = EmisionFacturasModel::MdlCargarFacturasXruta($table, $data);	

         return $response;

    }
 
	static public function Cargarutas(){

        $table = "empresas.tbl_rutas_empresas"; 	

         $response = EmisionFacturasModel::MdlCargarrutas($table);	

         return $response;

    }


    static public function CargarutasXusuario($idUsuario){

        $table = "empresas.tbl_rutas_empresas"; 	

         $response = EmisionFacturasModel::MdlCargarrutasXusuario($table, $idUsuario);	

         return $response;

    }


    static public function Cargausuariorutas($idUsuario){

        $table = "empresas.tbl_rutas_empresas"; 	

        $response = EmisionFacturasModel::MdlCargarusuariorutas($table, $idUsuario);	

        return $response;

    }

    static public function ctrModificarEstadoFactura($idFactura){

        $table = "empresas.tbl_facturacion_emitir_facturas"; 	

        $response = EmisionFacturasModel::MdlModificarEstadoFactura($table, $idFactura);	

        return $response;

    }

    static public function ctrAgregarFactura($data){

        $table = "empresas.tbl_facturacion_emitir_facturas"; 	

        $response = EmisionFacturasModel::MdlAgregarFactura($table, $data);	

        return $response;

    }

    static public function ctrAgregarDetalleFactura($data){

        $table = "empresas.tbl_facturacion_emitir_facturas_detalle"; 	

        $response = EmisionFacturasModel::MdlAgregarDetalleFactura($table, $data);	

        return $response;

    }

    static public function ctrCargarDatosFactura($idFactura){

        $table = "empresas.tbl_facturacion_emitir_facturas"; 	

        $response = EmisionFacturasModel::MdlCargarDatosFactura($table, $idFactura);	

        return $response;

    }

    static public function ctrCargarDatosDetalleFactura($idFactura){

        $table = "empresas.tbl_facturacion_emitir_facturas_detalle"; 	

        $response = EmisionFacturasModel::MdlCargarDatosDetalleFactura($table, $idFactura);	

        return $response;

    }

}