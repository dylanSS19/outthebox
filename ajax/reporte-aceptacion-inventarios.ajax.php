<?php

require_once "../controllers/aceptacion-inventarios.controller.php";
require_once "../models/aceptacion-inventarios.model.php";

class AjaxAceptacionInventarios{

	/*=============================================
	=                  CARGAR DETALLE CARGO                =
	=============================================*/
	
	public $iddetalleaceptacioncargo;
	
	public function ajaxCargarDetalleCargo(){

		$item = "movimiento_numero";

		$value = $this->iddetalleaceptacioncargo;

		$response = controladorAceptacionInventarios::ctrCargarCargosDetalle($item, $value);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}


		/*=============================================
	=                  CARGAR DETALLE MOVIMIENTO                =
	=============================================*/
	
	public $iddetalleaceptacionmovimiento;
	
	public function ajaxCargarDetalleMovimiento(){

		$item = "movimiento_numero";

		$value = $this->iddetalleaceptacionmovimiento;

		$response = controladorAceptacionInventarios::ctrCargarMovimientosDetalle($item, $value);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}


	public $idaceptacioncargo;
	
	public function ajaxAceptarCargo(){


			$value = $this->idaceptacioncargo;

		$response = controladorAceptacionInventarios::ctrAceptarCargos($value);

		echo $response;

		/*echo "HOLA";*/ 

	}


		public $idaceptacionmovimiento;
	
	public function ajaxAceptarMovimiento(){


			$value = $this->idaceptacionmovimiento;

		$response = controladorAceptacionInventarios::ctrAceptarMovimientos($value);

		echo $response;

		/*echo "HOLA";*/ 

	}



}

	/*=============================================
	=                  LOAD GPS LACATION USER OBJECT                =
	=============================================*/
if(isset($_POST["iddetalleaceptacioncargo"])){

	$value = new AjaxAceptacionInventarios();

	$value -> iddetalleaceptacioncargo = $_POST["iddetalleaceptacioncargo"];

	$value -> ajaxCargarDetalleCargo();

}

if(isset($_POST["iddetalleaceptacionmovimiento"])){

	$value = new AjaxAceptacionInventarios();

	$value -> iddetalleaceptacionmovimiento = $_POST["iddetalleaceptacionmovimiento"];

	$value -> ajaxCargarDetalleMovimiento();

}

if(isset($_POST["idaceptacioncargo"])){

	$value = new AjaxAceptacionInventarios();

	$value -> idaceptacioncargo = $_POST["idaceptacioncargo"];

	$value -> ajaxAceptarCargo();

}

if(isset($_POST["idaceptacionmovimiento"])){

	$value = new AjaxAceptacionInventarios();

	$value -> idaceptacionmovimiento = $_POST["idaceptacionmovimiento"];

	$value -> ajaxAceptarMovimiento();

}




	