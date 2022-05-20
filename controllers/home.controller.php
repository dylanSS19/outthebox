<?php

$nameTech="";

class HomeController{


/*=============================================
=                 CARGAR TIPOS SERVICIOS      =
=============================================*/

	static public function ctrCargarCategoriaServicios(){

        $table = "`upee-cr`.tbl_categoria_servicios";

		$response = HomeModel::MdlCargarCategoriaServicios($table);

		return $response;

	} 

	/*=============================================
=                 CARGAR SUB TIPOS SERVICIOS      =
=============================================*/

	static public function ctrCargarSubTipoServicios($item, $value){

        $table = "`upee-cr`.tbl_sub_categoria_servicios";

		$response = HomeModel::MdlCargarSubTipoServicios($table,$item, $value);

		return $response;

	} 


	/*=============================================
=                 CARGAR SERVICIOS      =
=============================================*/

	static public function ctrCargarServicios($item, $value){

        $table = "`upee-cr`.tbl_servicios";

		$response = HomeModel::MdlCargarServicios($table,$item, $value);

		return $response;

	} 





}
