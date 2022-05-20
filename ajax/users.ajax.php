<?php
 
require_once "../controllers/users.controller.php";
require_once "../models/users.model.php";

class AjaxUsers{

	/*=============================================
	=                  EDIT USERS                 =
	=============================================*/
	
	public $userId;
	
	public function ajaxUserEdit(){

		$item = "id";

		$value = $this->userId;

		$response = UserController::ctrLoadUsers($item, $value);

		echo json_encode($response);

	}

		/*=============================================
	=                  ACTIVATE USER                 =
	=============================================*/

	public $userIdActivate;
	public $userStatus;

	public function ajaxActivateUser(){

		$table = "tbl_users";

		$item1 = "status";

		$value1 = $this->userStatus;

		$item2 = "id";

		$value2 = $this->userIdActivate;

		$response = UsersModel::MdlActivateUser($table, $item1, $value1, $item2, $value2);



		
	}

  /*=============================================
	=                  VALIDATE USER                 =
	=============================================*/

	public $userName;

	public function ajaxValidateUser(){

		$item = "user_name";

		$value = $this->userName;

		$response = UserController::ctrLoadUsers($item, $value);

		echo json_encode($response);

	}

	 /*=============================================
	=                  LOAD SALE MAN                 =
	=============================================*/

	public $varTypeVendedor;

	public function ajaxLoadSaleMan(){

		$item = null;

		$value = null;

	$response = UserController::ctrShowSalesMan($item, $value);

		echo json_encode($response);

	}

		 /*=============================================
	=                  LOAD TECH MAN                 =
	=============================================*/

	public $varTypeTecnico;

	public function ajaxLoadTechMan(){

		$item = null;

		$value = null;

	$response = UserController::ctrShowtechnicians($item, $value);

		echo json_encode($response);

	}

	/*=============================================
	=                   UPDATE USER USER                =
	=============================================*/

	public $varUSer;

	public $varIdUSer;

	public $varId;

	public function ajaxUpdateUser(){

		$value = $this->varUSer;
		
		$value1 =$this->varId;

		$value2 =$this->varIdUSer;

	$response = UserController::ctrUpdateUserUser($value, $value1, $value2);

		echo ($response);

	}

/*=============================================
	=                   UPDATE GPS LOCATION USER                =
	=============================================*/


	public $user_id;

	public $lat;

	public $lng;

	public function ajaxUpdateGPGLocation(){

		
		$value = $this->user_id;

		
		$value2 = $this->lat;

		
		$value3 = $this->lng;

	    date_default_timezone_set('America/Costa_Rica');

		$day = date('Y-m-d');

		$hour = date('H-i-s');

		$currentDate = $day. ' ' .$hour;
		

	$response = UserController::ctrUpdateGPSLocation($value, $value2,  $value3, $currentDate);

		echo ($response);



	}



	/*=============================================
	=                   LOAD GPS LACATION USER                =
	=============================================*/

	public $loadgps;

	public function ajaxLoadGPSLocationUser(){

	
	$response = UserController::ctrShowGPSLocation();

		echo json_encode($response);

	}


	public $correoRegistro;

	public function ajaxExistenciaRegistro(){

		$correo = $this->correoRegistro;

	$response = UserController::ctrExistenciaRegistro($correo);

		echo json_encode($response);

	}

	public $correoIngreso;

	public function ajaxExistencia(){

		$correo = $this->correoIngreso;

	$response = UserController::ctrExistencia($correo);

		echo $response;

	}
  
	public $nombrePerfil;
	public $foto;
	public $nombre;
	public $correoUsuario;
	public $pass;
	public function ajaxAgregarUsuario(){

		$nombrePerfil = $this->nombrePerfil;
		//$foto = $this->foto;
		//$nombre = $this->nombre;
		$correo = $this->correoUsuario;
		$password = $this->pass;

		$response = UserController::ctrAgregarUsuario($nombrePerfil, $correo,$password);

		echo json_encode($response);

	}


	public $emailV;
	public function ajaxVerificarUsuario(){

		$correo = $this->emailV;
		$response = UserController::ctrVerificarUsuario($correo);

		echo json_encode($response);
	}


	public $idUsuario;
	public $imgUsuario;
	public function ajaxAgregarImagenUsuario() {
		$idUsuario = $this->idUsuario;
		$imgUsuario = $this->imgUsuario;

		$response = UserController::guardarNuevaImagen($imgUsuario,$idUsuario);
		
		echo json_encode($response);
	}
	

	/*=============================================
=      INGRESO DE USUARIOS CON FACEBOOK  =
=============================================*/
	public $idperfil;
	public $fotoFacebook;
	public $nombreFacebook;
	public $correoUsario;
	public function ajaxAgregarUsuarioFacebook(){

		$id = $this->idperfil;
		$foto = $this->fotoFacebook;
		$nombre = $this->nombreFacebook;
		$correo = $this->correoUsario;

	$response = UserController::ctrAgregarUsuarioFacebook($id, $foto, $nombre, $correo);

		echo $response;

	}



}



	/*=============================================
	=                  LOAD GPS LACATION USER OBJECT                =
	=============================================*/
if(isset($_POST["loadgps"])){

	$gps = new AjaxUsers();

	$gps -> loadgps = $_POST["loadgps"];

	$gps -> ajaxLoadGPSLocationUser();

}



	/*=============================================
	=                  UPDATE USER USER OBJECT                =
	=============================================*/
if(isset($_POST["varUSer"])){

	$edit = new AjaxUsers();

	$edit -> varUSer = $_POST["varUSer"];

	$edit -> varIdUSer = $_POST["varIdUSer"];

	$edit -> varId = $_POST["varId"];

	$edit -> ajaxUpdateUser();

}

	/*=============================================
	=   UPDATE GPS LOCATION OBJECT                =
	=============================================*/
if(isset($_POST["user_id"])){

	$gps= new AjaxUsers();

	$gps -> user_id = $_POST["user_id"];

	$gps -> lat = $_POST["lat"];

	$gps -> lng = $_POST["lng"];

	$gps -> ajaxUpdateGPGLocation();

}



	/*=============================================
	=                  LOAD SALES MAN OBJECT                =
	=============================================*/
if(isset($_POST["varTypeVendedor"])){

	$sale= new AjaxUsers();

	$sale -> ajaxLoadSaleMan();

}


	/*=============================================
	=                  LOAD TECH MAN OBJECT                =
	=============================================*/
if(isset($_POST["varTypeTecnico"])){

	$sale= new AjaxUsers();

	$sale -> ajaxLoadTechMan();

}





	/*=============================================
	=                  EDIT USER OBJECT                =
	=============================================*/
if(isset($_POST["userId"])){

	$edit = new AjaxUsers();

	$edit -> userId = $_POST["userId"];

	$edit -> ajaxUserEdit();

}

	/*=============================================
	=       ACTIVATE USER OBJECT                =
	=============================================*/
if(isset($_POST["userStatus"])){

		$userStatus = new AjaxUsers();

		$userStatus -> userIdActivate = $_POST["userId"];

		$userStatus -> userStatus = $_POST["userStatus"];

		$userStatus -> ajaxActivateUser();

}

	/*=============================================
	=       VALIDATE USER OBJECT                =
	=============================================*/

	if(isset($_POST["userValidate"])){

		$valUser = new AjaxUsers();

		$valUser -> userName = $_POST["userValidate"];

		$valUser -> ajaxValidateUser();
	}
	

	
if(isset($_POST["correoIngreso"])){

	$gps = new AjaxUsers();

	$gps -> correoIngreso = $_POST["correoIngreso"];

	$gps -> ajaxExistencia();

}
 
if(isset($_POST["correoRegistro"])){

	$gps = new AjaxUsers();

	$gps -> correoRegistro = $_POST["correoRegistro"];

	$gps -> ajaxExistenciaRegistro();

}

if(isset($_POST["nombrePerfil"])){

	$gps = new AjaxUsers();

	$gps -> nombrePerfil = $_POST["nombrePerfil"];
	$gps -> correoUsuario = $_POST["correo"];
	$gps -> pass = $_POST["password"];
	//$gps -> foto = $_POST["foto"];

	$gps -> ajaxAgregarUsuario();

}

if(isset($_POST["emailV"])) {
	$ajx = new AjaxUsers();
	$ajx -> emailV = $_POST["emailV"];
	$ajx -> ajaxVerificarUsuario();

}

if (isset($_POST["idUsuario"])) {
	$ajx = new AjaxUsers();
	$ajx -> idUsuario = $_POST["idUsuario"];
	$ajx -> imgUsuario = $_FILES["imgUsuario"];
	$ajx -> ajaxAgregarImagenUsuario();
}


/*=============================================
=      INGRESO DE USUARIOS CON FACEBOOK  =
=============================================*/
if(isset($_POST["idperfil"])){

	$gps = new AjaxUsers();

	$gps -> idperfil = $_POST["idperfil"];
	$gps -> correoUsario = $_POST["correo"];
	$gps -> nombreFacebook = $_POST["nombre"];
	$gps -> fotoFacebook = $_POST["foto"];

	$gps -> ajaxAgregarUsuarioFacebook();

}


