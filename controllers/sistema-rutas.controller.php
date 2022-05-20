<?php


class RutasController{

			/*=============================================
=                   CARGAR CLIENTES EDITAR              =
=============================================*/

	static public function ctrCargarClientesRuta($idRuta, $diaVis){

       $table = "empresas.tbl_empresas_clientes"; 	
      
		$response = RutasModel::mdlCargarClientesRuta($table, $idRuta, $diaVis);	

		return $response;


	} 

 
	static public function ctrCargarIDruta($idusuario){

        $table = "empresas.tbl_rutas"; 	
       
         $response = RutasModel::mdlCargarIDruta($table, $idusuario);	
 
         return $response;
 
 
     } 

     static public function ctrInsertNocompraRuta($comentario, $ruta, $cliente, $longitud, $latitud){

        $table = "empresas.tbl_clientes_no_compra"; 	
       
         $response = RutasModel::mdlInsertNocompraRuta($table, $comentario, $ruta, $cliente, $longitud, $latitud);	
 
         return $response;
 
 
     } 

     



}