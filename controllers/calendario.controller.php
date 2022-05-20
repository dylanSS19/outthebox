<?php

 

class CalendarioController{



	/*=============================================
=           CARGAR CEDULAS     =
=============================================*/
static public function ctrCargarCalendario($idempresa){

       $table = "empresas.tbl_calendario"; 	

		$response = CalendarioModel::MdlCargarCalendario($table, $idempresa);		

		return $response;

	}





}
 