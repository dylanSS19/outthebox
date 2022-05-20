<?php

class controladorClientesMasivos {

    /*================================
    =    CARGAR LISTA DEL REPORTE    =
    =================================*/
    static public function ctrIngresarClientesMasivo($id_empresa, $Nombre, $tipo_cedula, $cedula, $correo, $telefono, $provincia, $canton, $distrito, $direccion, $Tipo_lista, $nombre_fantasia) {
   
        $table = "empresas.tbl_empresas_clientes";

		$response = ClientesMasivosModel::MdlIngresarClientesMasivo($table, $id_empresa, $Nombre, $tipo_cedula, $cedula, $correo, $telefono, $provincia, $canton, $distrito, $direccion, $Tipo_lista, $nombre_fantasia);		

		return $response;
        
    }

    static public function ctrCargarListasPrecio($id_empresa) {
   
        $table = "empresas.tbl_listas_precio";
        $table2 = "empresas.tbl_empresas";

		$response = ClientesMasivosModel::MdlCargarListasPrecio($table, $table2, $id_empresa);		

		return $response;
        
    }

    static public function ctrCargarClientesMasivo($id_empresa) {
   
        $table = "empresas.tbl_empresas_clientes";

		$response = ClientesMasivosModel::MdlClientesMasivo($table, $id_empresa);		

		return $response;      
    }

}