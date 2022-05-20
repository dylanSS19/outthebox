<?php

require_once "../controllers/agregar-empleados.controller.php";
require_once "../models/agregar-empleados.model.php";

class AjaxAgregarEmpleados{

	/*=============================================
	=                  CARGAR SERVICIOS                =
	=============================================*/
	
	public $varempleado;
	
	public function ajaxCargarCedulaEmpleado(){

			session_start();
     	$id_empresa= $_SESSION['id_empresa'];

		$item = "cedula";

		$value = $this->varempleado;

		$response = controladorAgregarEmpleado::ctrCargarEmpleados($item, $value,$id_empresa);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}

	public $varDepartamento;
	
	public function ajaxCargarPuestos(){

			session_start();
     	$id_empresa= $_SESSION['id_empresa'];

		$item = "id_departamento";

		$value = $this->varDepartamento;

		$response = controladorAgregarEmpleado::ctrCargarPuestos($item, $value,$id_empresa);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}



}

	/*=============================================
	=                  LOAD GPS LACATION USER OBJECT                =
	=============================================*/
if(isset($_POST["varempleado"])){

	$value = new AjaxAgregarEmpleados();

	$value -> varempleado = $_POST["varempleado"];

	$value -> ajaxCargarCedulaEmpleado();

}

if(isset($_POST["varDepartamento"])){

	$value = new AjaxAgregarEmpleados();

	$value -> varDepartamento = $_POST["varDepartamento"];

	$value -> ajaxCargarPuestos();

}





	