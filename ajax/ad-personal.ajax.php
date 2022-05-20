<?php

require_once "../controllers/ad-personal.controller.php";
require_once "../models/ad-personal.model.php";
require_once "../models/salida-empleados.model.php";
require_once "../controllers/salida-empleados.controller.php";

class AjaxAdPersonal{

	/*=============================================
	=                  CARGAR SERVICIOS                =
	=============================================*/
	
	public $varempleado;
	
	public function ajaxCargarSalariosEmpleados(){

			session_start();
     	$id_empresa= $_SESSION['id_empresa'];

		$item = "cedula";

		$value = $this->varempleado;

		$response = controladorAdPersonal::ctrCargarSalariosEmpleados($item, $value,$id_empresa);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}

		public $varconcepto;
	
		public function ajaxCargarVariablesConceptos(){

			session_start();
     	$id_empresa= $_SESSION['id_empresa'];

		$item = "idtbl_conceptos";

		$value = $this->varconcepto;

		$response = controladorAdPersonal::ctrCargarVariablesConceptos($item, $value,$id_empresa);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}



		public $idnomina;
	
		public function ajaxCargarFechasNominas(){

			session_start();
     	$id_empresa= $_SESSION['id_empresa'];

		$item = "idtbl_consecutivo_nomina";

		$value = $this->idnomina;

		$response = controladorAdPersonal::ctrCargarFechasNominas($item, $value,$id_empresa);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}


	public $cedEmpleado;

	public function ajaxCargarCorreoEmpleado(){

		session_start();
	 $id_empresa= $_SESSION['id_empresa'];

		$item = "cedula";

		$value = $this->cedEmpleado;

		$response = controladorSalidaEmpleado::ctrCargarCorreoEmpleado($item, $value,$id_empresa);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}

}

	/*=============================================
	=                  LOAD GPS LACATION USER OBJECT                =
	=============================================*/
if(isset($_POST["varempleado"])){

	$value = new AjaxAdPersonal();

	$value -> varempleado = $_POST["varempleado"];

	$value -> ajaxCargarSalariosEmpleados();

}

if(isset($_POST["varconcepto"])){

	$value = new AjaxAdPersonal();

	$value -> varconcepto = $_POST["varconcepto"];

	$value -> ajaxCargarVariablesConceptos();

}

if(isset($_POST["idnomina"])){

	$value = new AjaxAdPersonal();

	$value -> idnomina = $_POST["idnomina"];

	$value -> ajaxCargarFechasNominas();

}

if(isset($_POST["cedEmpleado"])){

	$value = new AjaxAdPersonal();

	$value -> cedEmpleado = $_POST["cedEmpleado"];

	$value -> ajaxCargarCorreoEmpleado();

}



	