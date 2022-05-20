<?php

require_once "../controllers/salida-empleados.controller.php";
require_once "../models/salida-empleados.model.php";

class AjaxSalidaEmpleados{

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

		public $cedulaEmpleado;
	
	public function ajaxCargarCorreo(){

			session_start();
     	$id_empresa= $_SESSION['id_empresa'];

		$item = "id_departamento";

		$value = $this->cedulaEmpleado;

		//$response = controladorAgregarEmpleado::ctrCargarPuestos($item, $value,$id_empresa);

		echo json_encode($value);

		/*echo "HOLA";*/ 

	}



}

	/*=============================================
	=                  LOAD GPS LACATION USER OBJECT                =
	=============================================*/
if(isset($_POST["varempleado"])){

	$value = new AjaxSalidaEmpleados();

	$value -> varempleado = $_POST["varempleado"];

	$value -> ajaxCargarCedulaEmpleado();

}

if(isset($_POST["varDepartamento"])){

	$value = new AjaxSalidaEmpleados();

	$value -> varDepartamento = $_POST["varDepartamento"];

	$value -> ajaxCargarPuestos();

}



if(isset($_POST["cedulaEmpleado"])){

	$value = new AjaxSalidaEmpleados();

	$value -> cedulaEmpleado = $_POST["cedulaEmpleado"];

	$value -> ajaxCargarCorreo();

}




	