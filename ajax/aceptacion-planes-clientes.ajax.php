<?php

require_once "../controllers/aceptacion-planes-clientes.controller.php";
require_once "../models/aceptacion-planes-clientes.model.php";

class AjaxAceptacionPlanes{

	/*=============================================
	=                  CARGAR SERVICIOS                =
	=============================================*/
	
	public $idPlanCliente;
	
	public function ajaxCargarDatosPlan(){


		$idPlanCliente = $this->idPlanCliente;

		$response = controladorAceptacionPlanes::ctrCargarPlanesID($idPlanCliente);

		echo json_encode($response);

	}

    public $AceptarSuscrip;
    public $modulos;
    public $empresa;
	
	public function ajaxAceptarSuscripcion(){


		$AceptarSuscrip = $this->AceptarSuscrip;
		$modulos = $this->modulos;
		$empresa = $this->empresa;

		$response = controladorAceptacionPlanes::ctrAceptarSuscripcion($AceptarSuscrip, $modulos, $empresa);

		echo $response;

	}

}


if(isset($_POST["idPlanCliente"])){

	$load = new AjaxAceptacionPlanes();

	$load -> idPlanCliente = $_POST["idPlanCliente"];

	$load -> ajaxCargarDatosPlan();

}

if(isset($_POST["AceptarSuscrip"])){

	$update = new AjaxAceptacionPlanes();

	$update -> AceptarSuscrip = $_POST["AceptarSuscrip"];
	$update -> modulos = $_POST["modulos"];
	$update -> empresa = $_POST["empresa"];


	$update -> ajaxAceptarSuscripcion();

}