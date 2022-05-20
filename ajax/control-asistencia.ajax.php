<?php


require_once "../models/control-asistencia.model.php";
require_once "../controllers/control-asistencia.controller.php";

class AjaxControlAsistencia{


 
	public $cedEmpleado;

	public function ajaxCargarIDEmpleado(){

		session_start();
	 $id_empresa= $_SESSION['id_empresa'];

		$item = "cedula";

		$value = $this->cedEmpleado;

		$response = controladorControlAsistencia::ctrCargarIDEmpleados($item, $value,$id_empresa);

		echo json_encode($response);

		// echo $id_empresa;

	}
 
	public $IDempresa;
	public $IDempleado;

	public function ajaxValidarRegistros(){

		$empresa = $this->IDempresa;
		$idempleado = $this->IDempleado;

		$response = controladorControlAsistencia::ctrValidarRegistros($empresa, $idempleado);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}


}



if(isset($_POST["cedEmpleado"])){

	$value = new AjaxControlAsistencia();

	$value -> cedEmpleado = $_POST["cedEmpleado"];

	$value -> ajaxCargarIDEmpleado();

}


if(isset($_POST["IDempresa"])){

	$load = new AjaxControlAsistencia();

	$load -> IDempresa = $_POST["IDempresa"];
	$load -> IDempleado = $_POST["IDempleado"];

	$load -> ajaxValidarRegistros();

}




	