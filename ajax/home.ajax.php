<?php

require_once "../controllers/home.controller.php";
require_once "../models/home.model.php";

class AjaxHome{

	/*=============================================
	=                  CARGAR SERVICIOS                =
	=============================================*/
	
	public $subtipo;
	
	public function ajaxCargarServicios(){

		$item = "id_subcategoria_servicio";

		$value = $this->subtipo;

		$response = HomeController::ctrCargarServicios($item, $value);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}

		
/*=============================================
=           CARGAR SESSION VARIABLE                =
=============================================*/
	
	public $varempresa;
	public $varnomEmpresa;
	public $varSubMod;
	
	public function ajaxCargarSessionVariable(){

		 session_start();

    $value = $this->varempresa;
    $nombre = $this->varnomEmpresa;
    $varSubMod = $this->varSubMod;

	

    $_SESSION['empresa'] = $value;
	$_SESSION['VarNombreEmpresa'] = $nombre;
	$_SESSION['subModulos'] = $varSubMod;
	

	$table="empresas.tbl_clientes";

	$response = HomeModel::MdlCargarTablaTiendas($table, $value);

	$nombre=json_encode($response[0][0]);
	$privempresa=json_encode($response[0][1]);
	$id_empresa=json_encode($response[0][2]);
	$nombredth=json_encode($response[0][3]);
    $id_empresa=str_replace('"', '', $id_empresa);

    // echo("<script>console.log('homeModel:".$response."');</script>");


	$_SESSION['tabla_tiendas'] = $nombre;
	$_SESSION['privempresa'] = $privempresa;
	$_SESSION['id_empresa'] = $id_empresa;
	

    echo $nombre .' '.$nombredth.' '. $id_empresa;

	}

	/*=============================================
=           CARGAR DATOS PERFIL                =
=============================================*/
	
	public $varempresaProfile;
	
	public function ajaxCargarDatosPefil(){

		if (isset($_SESSION['previous'])) {
   if (basename($_SERVER['PHP_SELF']) != $_SESSION['previous']) {
        session_destroy();
        ### or alternatively, you can use this for specific variables:
        ### unset($_SESSION['varname']);
   }
}

    $value = $this->varempresaProfile;

	$table="empresas.tbluser_2";

	$response = HomeModel::MdlCargarDatosPerfil($table, $value);

    echo json_encode ($response);

	}


	
}

if(isset($_POST["varempresaProfile"])){

	$subtipo = new AjaxHome();

	$subtipo -> varempresaProfile = $_POST["varempresaProfile"];

	$subtipo -> ajaxCargarDatosPefil();

}


	/*=============================================
	=                  LOAD GPS LACATION USER OBJECT                =
	=============================================*/
if(isset($_POST["subtipo"])){

	$subtipo = new AjaxHome();

	$subtipo -> subtipo = $_POST["subtipo"];

	$subtipo -> ajaxCargarServicios();

}

if(isset($_POST["varnomEmpresa"])){

	$subtipo = new AjaxHome();

	$subtipo -> varempresa = $_POST["varempresa"];
	$subtipo -> varnomEmpresa = $_POST["varnomEmpresa"];
	$subtipo -> varSubMod = $_POST["varSubMod"];

	$subtipo -> ajaxCargarSessionVariable();

}

	